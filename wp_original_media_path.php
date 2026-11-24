<?php
/*
Plugin Name:            WP Original Media Path
Plugin URI:             https://github.com/rvola/wp-original-media-path

Description:            Change the location for the uploads folder for WordPress

Version:                2.4.3
Revision:               2026-08-17
Creation:               2013-01-06

Author:                 RVOLA
Author URI:             https://rvola.com

Text Domain:            wp-original-media-path
Domain Path:            /languages/

Tested up to:           7.1
Requires at least:      5.9
Requires PHP:           8.0

License:		        GPLv3-or-later
License URI:	        https://www.gnu.org/licenses/gpl-3.0
*/

namespace RVOLA\WPOMP;

if (!defined('ABSPATH')) {
    exit;
}

require_once __DIR__ . '/class/UploadPath.php';
require_once __DIR__ . '/class/Settings.php';

register_activation_hook(__FILE__, [Settings::class, 'activate']);

add_filter('upload_dir', [UploadPath::class, 'resolveDotSegments']);

new Settings(__FILE__);
