<?php
/*
Plugin Name: 	WP Original Media Path
Plugin URI: 	https://wordpress.org/plugins/wp-original-media-path/

Description: 	Restore the fields to change the url and file upload | <a href="http://wordpress.org/plugins/wp-original-media-path/faq/" target="_blank">FAQ</a> | <a href="http://wordpress.org/plugins/wp-original-media-path/installation/" target="_blank">How to Configure</a>

License:		GPLv3
License URI:	https://www.gnu.org/licenses/gpl-3.0

Version: 		1.6.1
Revision:		2016-08-01
Creation:		2013-01-06

Author:			RVOLA
Author URI:		http://rvola.com

Domain Path: /languages/
Text Domain: wp-original-media-path

*/

/**
 *	Copyright (C) 2007-2016 studio RVOLA (email: hello@rvola.com)
 *
 *	This program is free software; you can redistribute it and/or
 *	modify it under the terms of the GNU General Public License
 *	as published by the Free Software Foundation; either version 2
 *	of the License, or (at your option) any later version.
 *
 *	This program is distributed in the hope that it will be useful,
 *	but WITHOUT ANY WARRANTY; without even the implied warranty of
 *	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *	GNU General Public License for more details.
 *
 *	You should have received a copy of the GNU General Public License
 *	along with this program; if not, write to the Free Software
 *	Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 */

if( ! defined( 'ABSPATH' ) ) exit;

register_activation_hook( __FILE__, array( 'WPOMP', 'activate' ) );
add_action( 'plugins_loaded', array( 'WPOMP', 'load' ), 10 );

final class WPOMP {

	const NAME = "WP Original Media Path";
	const I18N = "wp-original-media-path";

	/*--------------------------------------------------------- */

	private static $_instance = null;
	public static function load() {
		if( is_null( self::$_instance ) ) {
			$class = __CLASS__;
			self::$_instance = new $class;
		}
		return self::$_instance;
	}

	public function __construct() {

		$plugin_file = plugin_basename( __FILE__ );

		add_action( 'init', array( $this, 'loadTextDomain' ), 10 );
		add_filter( "plugin_action_links_{$plugin_file}", array( $this, 'linkPluginPage' ), 10, 1 );
		add_action( 'admin_menu', array( $this, 'linkSidebar' ), 10 );
		add_action( 'admin_init', array( $this, 'registerSections' ), 10 );
		add_action( 'admin_init', array( $this, 'registerFields' ), 10 );
		add_action( 'admin_init', array( $this, 'addFields' ), 10 );

	}

	/*--------------------------------------------------------- */

	public static function loadTextDomain() {
		load_plugin_textdomain( self::I18N, false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}

	/*--------------------------------------------------------- */

	public static function activate() {
		$upload_path	 = get_option( 'upload_path' );
		$upload_url_path = get_option( 'upload_url_path' );

		if (
			   isset( $upload_path ) && empty( $upload_path)
			&& isset( $upload_url_path ) && empty( $upload_url_path)
		){
			$upload_dir = wp_upload_dir();
			$folder = str_replace( home_url() . '/', '', $upload_dir['baseurl'] );

			update_option( 'upload_path', $folder, true );
			update_option( 'upload_url_path', $upload_dir['baseurl'], true );
		}

	}

	/*--------------------------------------------------------- */

	public function linkPluginPage($links) {
		array_unshift(
			$links,
			sprintf(
				'<a href="%1$s">%2$s</a>',
				admin_url( 'admin.php?page=wpomp-options' ),
				__( 'Settings' )
			)
		);
		return $links;
	}
	public function linkSidebar() {
		add_submenu_page(
			'options-general.php',
			self::NAME,
			self::NAME,
			'manage_options',
			'wpomp-options',
			array( $this, 'optionsPages' )
		);
	}

	/*--------------------------------------------------------- */

	public function optionsPages() {
		include( dirname( __FILE__ ) . '/wpomp-options.php' );
	}

	/*--------------------------------------------------------- */

	public function registerSections() {
		add_settings_section(
			'wpomp_section_main',
			__( 'Uploading Files' ),
			null,
			'wpomp_pages'
		);
	}
	public function registerFields() {
		register_setting( 'wpomp_fields', 'upload_path' );
		register_setting( 'wpomp_fields', 'upload_url_path' );
	}
	public function addFields() {
		$fields = array(

			'upload_path'     => array(
				'id'             => 'upload_path',
				'title'          => __( 'Store uploads in this folder' ),
				'description'    => sprintf( __( 'Default is %s' ), '<code>wp-content/uploads</code>' ),
			),
			'upload_url_path' => array(
				'id'             => 'upload_url_path',
				'title'          => __( 'Full URL path to files' ),
				'description'    => null,
			),
		);

		foreach($fields as $id => $field){
			add_settings_field(
				$id,
				$field['title'],
				array( $this, 'InputFields' ),
				'wpomp_pages',
				'wpomp_section_main',
				$field
			);
		}
	}
	public function inputFields($datafield) {
		printf(
			'<input name="%1$s" type="text" id="%1$s" value="%2$s" class="regular-text code" />',
			$datafield['id'],
			get_option( $datafield['id'] )
		);

		printf(
			'<p class="description">%s</p>',
			$datafield['description']
		);
	}

}
