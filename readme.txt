=== WP Original Media Path ===
Contributors: rvola
Donate link: https://www.paypal.me/rvola
Tags: media, upload, path, subdomain
Requires PHP: 7.4
Requires at least: 3.5
Stable tag: 2.4.3
Tested up to: 7.1
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Change the location for the uploads folder for WordPress

== Description ==

WordPress still stores the location of the uploads folder and its URL, but has hidden these two settings since version 3.5. This plugin brings them back, with safeguards.

Install, activate, then open **Settings > WP Original Media Path** and enter the URL you want. The folder follows.

= What for? =

* **Serve your media from a subdomain**, for example `https://media.example.com`.
* **Rename the folder**, for example `https://example.com/media` instead of `wp-content/uploads`.
* **Work locally with the production images.** On a local copy of a site, enter the production URL (`https://www.example.com/wp-content/uploads`): images show up without downloading the uploads folder.

= How it works =

The folder and its URL are easy to mix up: files stored in one place, looked for in another. Here you only enter the URL, and the folder follows. The settings page shows, with your own values, where the files go.

* **A URL on your site's domain**: `https://example.com/media` stores files in the `media` folder at the root of your site. Nothing else to set up.
* **Another domain or a subdomain**: it must point to the right folder of this server, shown on the settings page. `https://media.example.com` keeps the files in `wp-content/uploads`: point the subdomain to that folder. With a path (`https://cdn.example.com/media`), the `media` folder is created at the root of your site: point the domain to that root.
* **An empty URL** brings back the WordPress default.
* Expert mode lets you enter the folder and the URL yourself (absolute path, protocol-relative URL…).
* Files already uploaded are never moved.

On a multisite network, only super admins can change these settings, site by site. Enter URLs from the network root (`https://example.com/media`, even for `https://example.com/site-b`). WordPress adds `/sites/ID` to the folder and URL of each sub-site, so two sites never share a folder.

[GitHub](https://github.com/rvola/wp-original-media-path) | [Donate](https://www.paypal.me/rvola)

== Installation ==

1. Back up your site (files and database).
2. Install and activate the plugin, then open **Settings > WP Original Media Path**.
3. Enter the new URL and save.

= Update the existing media =

The plugin changes where new files go. Media already uploaded keep their old URL in your content, so on a site that already has media:

1. Move the content of the old folder to the new one, shown under the field ("File on this server").
2. Replace the old URL with the new one in the database. With WP-CLI, preview first, then run:

`wp search-replace 'https://example.com/wp-content/uploads' 'https://example.com/media' --dry-run`
`wp search-replace 'https://example.com/wp-content/uploads' 'https://example.com/media'`

WP-CLI also updates serialized data (widgets, page builders). On a multisite network, add `--network`.

== Frequently Asked Questions ==

= Does it work with a CDN? =

Yes with a "pull" CDN, which copies the files from your site: enter the CDN URL. No with a storage service (Amazon S3…) that files must be sent to: WordPress always stores uploads on this server.

= Images do not display =

Under the field, the example shows the URL of an image and its file on this server: that URL must open that file. Check that the folder is writable and, for another domain, that it points to the folder shown on the page.

= On a local copy, my new uploads do not display =

That is expected when the URL points to production: files uploaded locally are stored locally.

= My site is broken =

Empty the URL field and save: WordPress uses its default folder again.

= Can I use WP-CLI? =

Yes, with the core options: `wp option update upload_url_path 'https://media.example.com'` and `wp option update upload_path 'wp-content/uploads'`. The values are then used as they are, as in expert mode.

= What happens when I deactivate or uninstall the plugin? =

Deactivating keeps your settings: WordPress keeps using them. Uninstalling brings back the WordPress default, on every site of a network. Files are never moved.

== Changelog ==

[All releases on GitHub](https://github.com/rvola/wp-original-media-path/releases)
