<?php
/*
Plugin Name: WP Original Media Path
Plugin URI: http://wordpress.org/plugins/wp-original-media-path/
Description: Restore the fields to change the url and file upload | <a href="http://wordpress.org/plugins/wp-original-media-path/faq/" target="_blank">FAQ</a> | <a href="http://wordpress.org/plugins/wp-original-media-path/installation/" target="_blank">How to Configure</a>
Version: 1.4.1
Date : 06/01/2013
Revision : 22/09/2014
Author: RVOLA
Author URI: http://rvola.com
License: GPLv2 or later
Domain Path: /lang/
Text Domain: wpomp
*/

/*
This program is free software; you can redistribute it and/or
modify it under the terms of the GNU General Public License
as published by the Free Software Foundation; either version 2
of the License, or (at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
*/

/*Define*/
define('WPOMP_NAME', 'WP Original Media Path');

/*Activation*/
function wpomp_activation() {
	if (get_option('upload_path') == '' || get_option('upload_url_path') == '') {
		update_option('upload_path', 'wp-content/uploads', true);
		update_option('upload_url_path', home_url().'/wp-content/uploads', true);
	}
}
register_activation_hook( __FILE__, 'wpomp_activation');

/*Translate*/
load_plugin_textdomain('wpomp', false, dirname(plugin_basename(__FILE__)).'/lang/'); 

/*Link Settings in plugins lists*/
function wpomp_settings_link($links, $file) { 
	if ( $file == plugin_basename(dirname(__FILE__)).'/wp_original_media_path.php' ) {
	   $settings_link = '<a href="'.admin_url('options-general.php?page=wpomp-settings').'">'.__('Settings').'</a>'; 
	   array_unshift($links, $settings_link); 
	}
	return $links; 
}
add_filter("plugin_action_links", 'wpomp_settings_link', 10, 2 );

/*Link Submenu Page*/
function wpomp_settings_subpage() {
	add_submenu_page( 'options-general.php', WPOMP_NAME, WPOMP_NAME, 'manage_options', 'wpomp-settings', 'wpomp_settings_options' ); 
}
add_action('admin_menu', 'wpomp_settings_subpage');

/*Include admin page*/
include_once('wpomp-admin.php');