<?php

namespace RVOLA\WPOMP;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Rules for the two core options `upload_path` and `upload_url_path`.
 *
 * WordPress still reads both options in `_wp_upload_dir()`, it only hides their fields since 3.5.
 * This class is the single place that cleans them, derives the folder from the URL and decides
 * who may change them.
 */
final class UploadPath
{
    public const PATH_OPTION = 'upload_path';
    public const URL_OPTION = 'upload_url_path';
    public const MODE_OPTION = 'wpomp_mode';

    private const ALLOWED_SCHEMES = ['http', 'https'];
    private const DEFAULT_SUBFOLDER = '/uploads';

    /**
     * Whether the plugin can work on this install.
     *
     * Networks created before WordPress 3.5 still use the ms-files.php rewriting: core then forces
     * every upload URL to `/files`, so the URL option has no effect there.
     *
     * @return bool
     */
    public static function isSupported(): bool
    {
        return !(is_multisite() && get_site_option('ms_files_rewriting'));
    }

    /**
     * Capability required to change the uploads folder.
     *
     * On a network, a site administrator could aim the folder at another site's files, or anywhere
     * on the server: like core (Network Admin > Sites > Edit > Settings), only super admins may.
     *
     * @return string
     */
    public static function capability(): string
    {
        return is_multisite() ? 'manage_network_options' : 'manage_options';
    }

    /**
     * Whether expert mode is on: both fields are then entered by hand.
     *
     * @return bool
     */
    public static function isExpert(): bool
    {
        return (bool) get_option(self::MODE_OPTION);
    }

    /**
     * Cleans the URL before it is saved.
     *
     * Simple mode keeps an http(s) URL whose path only holds folder-safe characters, so that the
     * folder derived from it matches the URL exactly. An invalid URL keeps the saved value.
     *
     * @param mixed $value Submitted value, already trimmed by options.php.
     *
     * @return string
     */
    public static function sanitizeUrl(mixed $value): string
    {
        $url = is_string($value) ? $value : '';

        if ($url === '') {
            return '';
        }

        if (self::isExpert()) {
            return untrailingslashit(sanitize_url($url));
        }

        $parts = wp_parse_url($url);
        $scheme = strtolower($parts['scheme'] ?? '');
        $host = strtolower($parts['host'] ?? '');

        if ($host === '' || !in_array($scheme, self::ALLOWED_SCHEMES, true)) {
            add_settings_error(
                self::URL_OPTION,
                'invalid_url',
                esc_html__('Enter a full URL, starting with https://', 'wp-original-media-path'),
            );

            return (string) get_option(self::URL_OPTION);
        }

        $port = isset($parts['port']) ? ':' . $parts['port'] : '';

        // parse_url() mangles some UTF-8 bytes (`É` becomes `_`): accents go before, on the path only.
        $folder = self::cleanFolder((string) wp_parse_url(remove_accents($url), PHP_URL_PATH));

        return untrailingslashit(sanitize_url($scheme . '://' . $host . $port . '/' . $folder));
    }

    /**
     * Cleans the folder before it is saved.
     *
     * Registered after the URL, so in simple mode the URL read here is the one just saved.
     *
     * @param mixed $value Submitted value, already trimmed by options.php and stripped of tags by core.
     *
     * @return string
     */
    public static function sanitizePath(mixed $value): string
    {
        if (!self::isExpert()) {
            return self::fromUrl((string) get_option(self::URL_OPTION));
        }

        return is_string($value) ? untrailingslashit($value) : (string) get_option(self::PATH_OPTION);
    }

    /**
     * Folder matching a URL, relative to ABSPATH as core expects it.
     *
     * @param string $url Cleaned URL.
     *
     * @return string Empty for the core default.
     */
    public static function fromUrl(string $url): string
    {
        $folder = self::siteFolder($url);

        return $folder === '' ? '' : self::homeFromAbspath() . $folder;
    }

    /**
     * Core default folder when both options are empty, before the `/sites/ID` of a network.
     *
     * @return string
     */
    public static function defaultFolder(): string
    {
        return WP_CONTENT_DIR . self::DEFAULT_SUBFOLDER;
    }

    /**
     * Core default URL when both options are empty, before the `/sites/ID` of a network.
     *
     * @return string
     */
    public static function defaultUrl(): string
    {
        return content_url(self::DEFAULT_SUBFOLDER);
    }

    /**
     * Folder path as the folder option expects it: relative to ABSPATH, with `../` when WordPress has
     * its own folder (Bedrock: `../app/uploads`).
     *
     * @param string $path Server folder.
     *
     * @return string The full path for a folder outside the site.
     */
    public static function fromAbspath(string $path): string
    {
        $fromWordpress = self::relativeTo($path, ABSPATH);

        if ($fromWordpress !== null) {
            return $fromWordpress;
        }

        $fromSite = self::relativeTo($path, self::siteRoot());

        return $fromSite === null ? $path : self::homeFromAbspath() . $fromSite;
    }

    /**
     * Folder of the site root matching a URL.
     *
     * The URL path is a folder of the site root: `https://example.com/media` stores in `media`.
     * A bare domain (`https://media.example.com`) keeps the core default folder.
     *
     * The root is the network one (the site itself outside multisite): sub-sites of a sub-folder
     * network share its files, and no rewrite rule maps `/site-b/media` to `/media`.
     *
     * @param string $url Cleaned URL.
     *
     * @return string Empty for a bare domain or an empty URL.
     */
    public static function siteFolder(string $url): string
    {
        $rootUrl = network_home_url();
        $folder = self::cleanFolder((string) wp_parse_url($url, PHP_URL_PATH));
        $homeFolder = self::cleanFolder((string) wp_parse_url($rootUrl, PHP_URL_PATH));
        $sameHost = self::isSiteHost($url);

        // A site in a sub-folder (https://example.com/blog): the URL path starts with it.
        if ($sameHost && $homeFolder !== '' && str_starts_with($folder . '/', $homeFolder . '/')) {
            $folder = ltrim(substr($folder, strlen($homeFolder)), '/');
        }

        return $folder;
    }

    /**
     * Whether a URL is on the site's own domain (the network one in multisite).
     *
     * Another domain or subdomain has to be pointed to the uploads folder on the server.
     *
     * @param string $url URL to test.
     *
     * @return bool
     */
    public static function isSiteHost(string $url): bool
    {
        return wp_parse_url($url, PHP_URL_HOST) === wp_parse_url(network_home_url(), PHP_URL_HOST);
    }

    /**
     * Resolves the `..` segments of the uploads folder, hooked on `upload_dir`.
     *
     * Core joins `upload_path` to ABSPATH as is, then `wp_mkdir_p()` refuses any new folder whose
     * path holds `../`: with WordPress in its own folder (Bedrock), every upload in a new month
     * folder would fail. The option keeps its relative value, so the database stays portable.
     *
     * @param array{path: string, url: string, subdir: string, basedir: string, baseurl: string, error: string|false} $uploads Uploads folder data.
     *
     * @return array{path: string, url: string, subdir: string, basedir: string, baseurl: string, error: string|false}
     */
    public static function resolveDotSegments(array $uploads): array
    {
        $uploads['path'] = self::withoutDotSegments($uploads['path']);
        $uploads['basedir'] = self::withoutDotSegments($uploads['basedir']);

        return $uploads;
    }

    /**
     * Restores the core default values, for the current site.
     *
     * Same order as the settings page: if the sanitize filters are hooked, the folder is then
     * derived from the URL already emptied.
     *
     * @return void
     */
    public static function reset(): void
    {
        delete_option(self::MODE_OPTION);
        update_option(self::URL_OPTION, '');
        update_option(self::PATH_OPTION, '');
    }

    /**
     * Keeps only folder-safe characters, and drops empty, `.` and `..` segments.
     *
     * @param string $path URL path.
     *
     * @return string Without leading or trailing slash.
     */
    private static function cleanFolder(string $path): string
    {
        $segments = [];

        foreach (explode('/', strtolower(remove_accents($path))) as $segment) {
            $segment = (string) preg_replace('/[^a-z0-9._-]/', '', $segment);

            if (trim($segment, '.') !== '') {
                $segments[] = $segment;
            }
        }

        return implode('/', $segments);
    }

    /**
     * Path without its `..` segments, each one removing the folder before it.
     *
     * Left as is when it has none, so other paths keep their exact form.
     *
     * @param string $path Folder path.
     *
     * @return string
     */
    private static function withoutDotSegments(string $path): string
    {
        $normalizedPath = wp_normalize_path($path);
        $segments = explode('/', $normalizedPath);

        if (!in_array('..', $segments, true)) {
            return $path;
        }

        $resolved = [];

        foreach ($segments as $segment) {
            $previous = end($resolved);
            $canGoUp = $previous !== false && $previous !== '' && $previous !== '..';

            if ($segment === '..' && $canGoUp) {
                array_pop($resolved);
            } else {
                $resolved[] = $segment;
            }
        }

        return implode('/', $resolved);
    }

    /**
     * Relative path from ABSPATH up to the site root.
     *
     * Empty when WordPress sits at the root. `../` when it has its own folder (Bedrock, or
     * siteurl ≠ home): core resolves the folder from ABSPATH, while the URL is read from the site root.
     * resolveDotSegments() then removes the `../` from the real path.
     *
     * @return string
     */
    private static function homeFromAbspath(): string
    {
        $homeRoot = self::siteRoot() . '/';
        $wordpressRoot = wp_normalize_path(ABSPATH);

        if ($homeRoot === $wordpressRoot || !str_starts_with($wordpressRoot, $homeRoot)) {
            return '';
        }

        $wordpressFolder = trim(substr($wordpressRoot, strlen($homeRoot)), '/');

        return str_repeat('../', substr_count($wordpressFolder, '/') + 1);
    }

    /**
     * Site root on the server (the folder of `home`), without trailing slash.
     *
     * @return string
     */
    private static function siteRoot(): string
    {
        require_once ABSPATH . 'wp-admin/includes/file.php';

        return untrailingslashit(wp_normalize_path(get_home_path()));
    }

    /**
     * Path relative to a root folder.
     *
     * @param string $path Server folder.
     * @param string $root Root folder.
     *
     * @return string|null Empty for the root itself, null for a folder outside of it.
     */
    private static function relativeTo(string $path, string $root): ?string
    {
        $normalizedPath = wp_normalize_path($path);
        $normalizedRoot = untrailingslashit(wp_normalize_path($root));

        if ($normalizedPath === $normalizedRoot) {
            return '';
        }

        return str_starts_with($normalizedPath, $normalizedRoot . '/')
            ? substr($normalizedPath, strlen($normalizedRoot) + 1)
            : null;
    }
}
