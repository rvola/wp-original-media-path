# WP Original Media Path

Change the location for the uploads folder for WordPress.

WordPress still stores the location of the uploads folder and its URL, but has hidden these two settings since version 3.5. This plugin brings them back, with safeguards: install, activate, enter the URL in **Settings > WP Original Media Path**.

- Serve your media from a subdomain (`https://media.example.com`).
- Rename the folder (`https://example.com/media`).
- Work locally with the production images, without downloading the uploads folder.

Installation, how it works and FAQ: [plugin page on WordPress.org](https://wordpress.org/plugins/wp-original-media-path/).

## Development

```bash
composer install
composer run phpstan     # PHPStan, level 8
composer run php_check   # PHP compatibility
composer run pot         # Translation template (WP-CLI)
```

## License

GPLv3, see [LICENSE.txt](LICENSE.txt). [Donate](https://www.paypal.me/rvola)
