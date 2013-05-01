<?php
/*
Plugin Name: WP Original Media Path
Description: Restore the fields to change the url and file upload
Version: 1.2.0
Date : 06/01/2013
Revision : 01/05/2013
Author: RVOLA
Author URI: http://rvola.com
License: GPLv2 or later
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

function wpomp_activation() {
	if (get_option('upload_path') == '' || get_option('upload_url_path') == '') {
		update_option('upload_path', 'wp-content/uploads', true);
		update_option('upload_url_path', home_url().'/wp-content/uploads', true);
	}
}
register_activation_hook( __FILE__, 'wpomp_activation');

function wpomp_desactivation() {
	update_option('upload_path', '', true);
	update_option('upload_url_path', '', true);
}
register_deactivation_hook( __FILE__, 'wpomp_desactivation');

function wpomp_settings_link($links, $file) { 
	if ( $file == plugin_basename(dirname(__FILE__)).'/wp_original_media_path.php' ) {
	   $settings_link = '<a href="'.admin_url('options-media.php').'">'.__('Settings').'</a>'; 
	   array_unshift($links, $settings_link); 
	}
	return $links; 
}
add_filter("plugin_action_links", 'wpomp_settings_link', 10, 2 );