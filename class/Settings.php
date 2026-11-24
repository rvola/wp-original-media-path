<?php

namespace RVOLA\WPOMP;

if (!defined('ABSPATH')) {
    exit;
}

/**
 * Settings > WP Original Media Path: the only screen that edits the uploads folder and URL.
 */
final class Settings
{
    public const NAME = 'WP Original Media Path';

    private const SLUG = 'wpomp-options';
    private const GROUP = 'wpomp_fields';
    private const SECTION = 'wpomp_section_main';
    private const MEDIA_SCREEN = 'options-media.php';
    private const STYLE_HANDLE = 'wpomp';
    private const EXAMPLE_FILE = 'image.jpg';

    /**
     * Printed inline on Settings > Media and on the plugin page: no file, no cache to bust.
     */
    private const STYLE = <<<'CSS'
                      /* Settings > Media: the upload fields are edited on the plugin page (see lockMediaFields). */
                      .options-media-php .form-table tr:has(#upload_path),
                      .options-media-php .form-table tr:has(#upload_url_path) {
                          display: none;
                      }
                      /* Plugin page: the folder is only entered in expert mode, shown as soon as it is checked. */
                      .form-table:has(#wpomp_mode:not(:checked)) tr:has(#upload_path) {
                          display: none;
                      }
                      input.wpomp-text {
                          min-width: 40rem;
                      }
                      /* Mobile (core forms breakpoint): the field takes the screen width instead. */
                      @media (width <= 782px) {
                          input.wpomp-text {
                              min-width: 0;
                              width: 100%;
                          }
                      }
                      CSS;

    /**
     * @var string|false Hook suffix of the plugin page, false until it is added.
     */
    private string|false $pageHook = false;

    /**
     * @param string $pluginFile Main plugin file.
     */
    public function __construct(private string $pluginFile)
    {
        if (!UploadPath::isSupported()) {
            return;
        }

        add_action('admin_menu', [$this, 'addPage']);
        add_action('admin_init', [$this, 'registerSettings']);
        add_action('admin_enqueue_scripts', [$this, 'enqueueStyle']);

        add_filter('option_page_capability_' . self::GROUP, [UploadPath::class, 'capability']);
        add_filter('allowed_options', [$this, 'lockMediaFields'], 20);

        add_filter('plugin_action_links_' . plugin_basename($this->pluginFile), [$this, 'addSettingsLink']);
        add_filter('plugin_row_meta', [$this, 'addRowMeta'], 10, 2);
    }

    /**
     * Stops the activation on an unsupported install.
     *
     * @return void
     */
    public static function activate(): void
    {
        if (UploadPath::isSupported()) {
            return;
        }

        wp_die(
            esc_html__(
                'This plugin does not work on networks that still use the ms-files.php rewriting (created before WordPress 3.5).',
                'wp-original-media-path',
            ),
            esc_html(self::NAME),
            ['back_link' => true],
        );
    }

    /**
     * @return void
     */
    public function addPage(): void
    {
        $this->pageHook = add_options_page(
            self::NAME,
            self::NAME,
            UploadPath::capability(),
            self::SLUG,
            [$this, 'renderPage'],
        );
    }

    /**
     * Registers the options and their fields.
     *
     * The order matters: options.php saves a group in registration order, and the folder is
     * derived from the mode and the URL already saved.
     *
     * @return void
     */
    public function registerSettings(): void
    {
        register_setting(self::GROUP, UploadPath::MODE_OPTION, [
            'type' => 'boolean',
            'sanitize_callback' => 'rest_sanitize_boolean',
        ]);
        register_setting(self::GROUP, UploadPath::URL_OPTION, [
            'sanitize_callback' => [UploadPath::class, 'sanitizeUrl'],
        ]);
        register_setting(self::GROUP, UploadPath::PATH_OPTION, [
            'sanitize_callback' => [UploadPath::class, 'sanitizePath'],
        ]);

        add_settings_section(
            self::SECTION,
            esc_html__('Uploading Files', 'wp-original-media-path'),
            [$this, 'renderSectionIntro'],
            self::SLUG,
        );

        add_settings_field(
            UploadPath::URL_OPTION,
            esc_html__('Full URL path to files', 'wp-original-media-path'),
            [$this, 'renderUrlField'],
            self::SLUG,
            self::SECTION,
            ['label_for' => UploadPath::URL_OPTION],
        );
        add_settings_field(
            UploadPath::MODE_OPTION,
            esc_html__('Expert mode', 'wp-original-media-path'),
            [$this, 'renderModeField'],
            self::SLUG,
            self::SECTION,
            ['label_for' => UploadPath::MODE_OPTION],
        );
        add_settings_field(
            UploadPath::PATH_OPTION,
            esc_html__('Store uploads in this folder', 'wp-original-media-path'),
            [$this, 'renderPathField'],
            self::SLUG,
            self::SECTION,
            ['label_for' => UploadPath::PATH_OPTION],
        );
    }

    /**
     * Removes both options from Settings > Media.
     *
     * Core shows them there once they are not the default. This page stays the only way to change
     * them: same cleaning, same capability.
     *
     * @param array<string, string[]> $allowedOptions Options each settings group may save.
     *
     * @return array<string, string[]>
     */
    public function lockMediaFields(array $allowedOptions): array
    {
        if (isset($allowedOptions['media'])) {
            $allowedOptions['media'] = array_values(
                array_diff($allowedOptions['media'], [UploadPath::PATH_OPTION, UploadPath::URL_OPTION]),
            );
        }

        return $allowedOptions;
    }

    /**
     * Hides the core fields locked by lockMediaFields(), and the folder outside expert mode.
     *
     * @param string $hookSuffix Current admin screen.
     *
     * @return void
     */
    public function enqueueStyle(string $hookSuffix): void
    {
        if (!in_array($hookSuffix, [self::MEDIA_SCREEN, $this->pageHook], true)) {
            return;
        }

        wp_register_style(self::STYLE_HANDLE, false);
        wp_enqueue_style(self::STYLE_HANDLE);
        wp_add_inline_style(self::STYLE_HANDLE, self::STYLE);
    }

    /**
     * @return void
     */
    public function renderPage(): void
    {
        ?>
        <div class="wrap">
            <h1><?= esc_html(get_admin_page_title()) ?></h1>
            <p>
                <?php foreach ($this->links() as $label => $url) : ?>
                    <a href="<?= esc_url($url) ?>" class="button" target="_blank" rel="noopener"><?= $label ?></a>
                <?php endforeach; ?>
            </p>
            <form method="post" action="options.php">
                <?php
                settings_fields(self::GROUP);
                do_settings_sections(self::SLUG);
                submit_button();
                ?>
            </form>
        </div>
        <?php
    }

    /**
     * @return void
     */
    public function renderSectionIntro(): void
    {
        ?>
        <p><?= esc_html__(
                'Changing these settings does not move the files already uploaded.',
                'wp-original-media-path',
            ) ?></p>
        <?php
    }

    /**
     * @return void
     */
    public function renderUrlField(): void
    {
        $uploads = wp_upload_dir(null, false);
        ?>
        <input name="<?= esc_attr(UploadPath::URL_OPTION) ?>" id="<?= esc_attr(UploadPath::URL_OPTION) ?>" type="text"
               value="<?= esc_attr((string) get_option(UploadPath::URL_OPTION)) ?>"
               placeholder="<?= esc_attr(UploadPath::defaultUrl()) ?>" class="regular-text wpomp-text code">
        <p class="description">
            <?= esc_html__('Leave empty to use the WordPress default.', 'wp-original-media-path') ?>
        </p>
        <?php
        $this->renderExample($uploads['basedir'], $uploads['baseurl'], $uploads['subdir']);
    }

    /**
     * Where an image uploaded today goes with the current settings: its URL, its file, and the folder
     * another domain must point to. Built from the real uploads folder, so the help matches the site.
     *
     * @param string $basedir Current uploads folder.
     * @param string $baseurl Current uploads URL.
     * @param string $subdir Current year/month sub-folder, empty when disabled.
     *
     * @return void
     */
    private function renderExample(string $basedir, string $baseurl, string $subdir): void
    {
        $imageUrl = $baseurl . $subdir . '/' . self::EXAMPLE_FILE;
        $imagePath = $basedir . $subdir . '/' . self::EXAMPLE_FILE;
        $domainRoot = $this->domainRoot($basedir, $baseurl);
        ?>
        <p class="description">
            <?= esc_html__('With the current settings, an image uploaded today:', 'wp-original-media-path') ?>
            <br>
            <?php
            /* translators: %s: URL of an example image. */
            printf(esc_html__('URL: %s', 'wp-original-media-path'), $this->code($imageUrl));
            ?>
            <br>
            <?php
            /* translators: %s: server path of an example image. */
            printf(esc_html__('File on this server: %s', 'wp-original-media-path'), $this->code($imagePath));
            ?>
        </p>
        <?php if (!UploadPath::isSiteHost($baseurl)) : ?>
        <p class="description">
            <strong>
                <?php
                $domain = $this->code((string) wp_parse_url($baseurl, PHP_URL_HOST));

                if ($domainRoot === '') {
                    printf(
                    /* translators: %s: domain of the uploads URL. */
                        esc_html__(
                            '%s must point to this server, so that this URL serves this file.',
                            'wp-original-media-path',
                        ),
                        $domain,
                    );
                } else {
                    printf(
                    /* translators: 1: domain of the uploads URL, 2: folder on this server. */
                        esc_html__('%1$s must point to the %2$s folder of this server.', 'wp-original-media-path'),
                        $domain,
                        $this->code($domainRoot),
                    );
                }
                ?>
            </strong>
        </p>
    <?php endif; ?>
        <?php
    }

    /**
     * Server folder that the domain of the uploads URL must serve.
     *
     * The uploads folder minus the path of the uploads URL: `https://cdn.example.com/media` stored
     * in `/srv/site/media` gives `/srv/site`. Covers the `/sites/ID` that core adds on a network.
     *
     * @param string $basedir Current uploads folder.
     * @param string $baseurl Current uploads URL.
     *
     * @return string Empty when the folder does not end with the URL path (expert mode).
     */
    private function domainRoot(string $basedir, string $baseurl): string
    {
        $urlPath = trim((string) wp_parse_url($baseurl, PHP_URL_PATH), '/');

        if ($urlPath === '') {
            return $basedir;
        }

        return str_ends_with($basedir, '/' . $urlPath) ? substr($basedir, 0, -strlen('/' . $urlPath)) : '';
    }

    /**
     * @param string $text Value shown in the help.
     *
     * @return string Escaped value in a `<code>` tag.
     */
    private function code(string $text): string
    {
        return '<code>' . esc_html($text) . '</code>';
    }

    /**
     * Shown in expert mode only (see STYLE): in simple mode, sanitizePath() derives the folder from the URL.
     *
     * @return void
     */
    public function renderPathField(): void
    {
        ?>
        <input name="<?= esc_attr(UploadPath::PATH_OPTION) ?>" id="<?= esc_attr(UploadPath::PATH_OPTION) ?>" type="text"
               value="<?= esc_attr((string) get_option(UploadPath::PATH_OPTION)) ?>"
               placeholder="<?= esc_attr(UploadPath::fromAbspath(UploadPath::defaultFolder())) ?>"
               class="regular-text code">
        <p class="description">
            <?= esc_html__('Relative to the WordPress folder, or absolute.', 'wp-original-media-path') ?>
        </p>
        <?php
    }

    /**
     * @return void
     */
    public function renderModeField(): void
    {
        ?>
        <input name="<?= esc_attr(UploadPath::MODE_OPTION) ?>" id="<?= esc_attr(UploadPath::MODE_OPTION) ?>"
               type="checkbox"
               value="1" <?php checked(UploadPath::isExpert()); ?>>
        <span class="description">
            <?= esc_html__(
                'Enter the folder yourself, and keep the URL as typed (no automatic cleaning).',
                'wp-original-media-path',
            ) ?>
        </span>
        <?php
    }

    /**
     * Adds "Settings" to the plugin actions.
     *
     * @param string[] $links Plugin action links.
     *
     * @return string[]
     */
    public function addSettingsLink(array $links): array
    {
        if (current_user_can(UploadPath::capability())) {
            array_unshift(
                $links,
                sprintf(
                    '<a href="%1$s">%2$s</a>',
                    menu_page_url(self::SLUG, false),
                    esc_html__('Settings', 'wp-original-media-path'),
                ),
            );
        }

        return $links;
    }

    /**
     * Adds the help links under the plugin description.
     *
     * @param string[] $links Plugin row meta.
     * @param string $file Plugin file of the row.
     *
     * @return string[]
     */
    public function addRowMeta(array $links, string $file): array
    {
        if ($file !== plugin_basename($this->pluginFile)) {
            return $links;
        }

        foreach ($this->links() as $label => $url) {
            $links[] = sprintf('<a href="%1$s" target="_blank" rel="noopener">%2$s</a>', esc_url($url), $label);
        }

        return $links;
    }

    /**
     * Help links, shared by the plugin row and the settings page.
     *
     * @return array<string, string> Escaped label => URL.
     */
    private function links(): array
    {
        return [
            esc_html__('FAQ', 'wp-original-media-path') => 'https://wordpress.org/plugins/wp-original-media-path/faq/',
            esc_html__(
                'How to Configure',
                'wp-original-media-path',
            ) => 'https://wordpress.org/plugins/wp-original-media-path/installation/',
            esc_html__('Donate', 'wp-original-media-path') => 'https://www.paypal.me/rvola',
        ];
    }
}
