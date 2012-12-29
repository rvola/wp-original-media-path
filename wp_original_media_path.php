<?php
/*
Plugin Name: WP Original Media Path
Description: Restore the fields to change the url and file upload
Version: 1.0.0
Date : 27/12/2012
Author: studio RVOLA
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

function rwp_omp_activation() {
	if (get_option('upload_path') == '' || get_option('upload_url_path') == '') {
		update_option('upload_url_path','SUBDOMAIN FOR MEDIA',true);
		update_option('upload_path','PATH FOR DOSSIER',true);
		wp_redirect(admin_url('options-media.php'));exit();
	}
}
register_activation_hook( __FILE__, 'rwp_omp_activation');