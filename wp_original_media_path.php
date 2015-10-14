<?php
/*
Plugin Name: 	WP Original Media Path
Plugin URI: 	http://wordpress.org/plugins/wp-original-media-path/

Description: 	Restore the fields to change the url and file upload | <a href="http://wordpress.org/plugins/wp-original-media-path/faq/" target="_blank">FAQ</a> | <a href="http://wordpress.org/plugins/wp-original-media-path/installation/" target="_blank">How to Configure</a>
License:		GPLv2 or later

Version: 		1.5.1
Creation:		2013-01-06
Revision:		2015-10-14

Author:			RVOLA
Author URI:		http://rvola.com

Domain Path: /languages/
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

if(!defined('ABSPATH')) exit;

register_activation_hook(__FILE__, array('WPOMP', 'Activation'));
add_action('plugins_loaded', array('WPOMP', 'Load'), 10);

class WPOMP {

	private $_PLUGIN_NAME = "WP Original Media Path";

	private static $_instance = null;
	public static function Load() {
		if(is_null(self::$_instance)) {
			$class = __CLASS__;
			self::$_instance = new $class;
		}
		return self::$_instance;
	}

	/**
	 * __construct function.
	 *
	 * @access public
	 */
	public function __construct() {

		/*Localization*/
		add_action('init', array($this, 'il18n'), 10);

		/*Settings Links*/
		add_filter("plugin_action_links_".plugin_basename(__FILE__), array($this, 'SettingLink'), 10, 1);
		/*Menu*/
		add_action('admin_menu', array($this, 'SubMenu'), 10);

		/*Register Sections*/
		add_action('admin_init', array($this, 'RegisterSections'), 10);
		/*Register Fields*/
		add_action('admin_init', array($this, 'RegisterFields'), 10);
		/*Add Fields*/
		add_action('admin_init', array($this, 'AddFields'), 10);

	}

	/* -------------------------------------------------------- */

	/**
	 * Activation function.
	 *
	 * @access public
	 * @static
	 */
	public static function Activation() {
		if (get_option('upload_path') == '' || get_option('upload_url_path') == '') {
			$upload_dir = wp_upload_dir();
			update_option('upload_path', 'wp-content/uploads', true);
			update_option('upload_url_path', $upload_dir['baseurl'], true);
		}
	}

	/* -------------------------------------------------------- */

	/**
	 * in18 function.
	 *
	 * @access public
	 * @static
	 */
	public static function il18n(){
		load_plugin_textdomain('wpomp', false, dirname(plugin_basename(__FILE__)).'/languages/');
	}

	/* -------------------------------------------------------- */

	/**
	 * SettingLink function.
	 *
	 * @access public
	 * @param mixed $links
	 * @return $links
	 */
	public function SettingLink($links) {
		array_unshift(
			$links,
			sprintf(
				'<a href="%1$s">%2$s</a>',
				admin_url('admin.php?page=wpomp-options'),
				__('Settings')
			)
		);
		return $links;
	}

	/**
	 * SubMenu function.
	 *
	 * @access public
	 */
	public function SubMenu() {
		add_submenu_page(
			'options-general.php',
			$this->_PLUGIN_NAME,
			$this->_PLUGIN_NAME,
			'manage_options',
			'wpomp-options',
			array($this, 'OptionsPages')
		);
	}

	/**
	 * OptionsPages function.
	 *
	 * @access public
	 */
	public function OptionsPages() {
		include(dirname(__FILE__).'/wpomp-options.php');
	}

	/* -------------------------------------------------------- */

	/**
	 * RegisterSections function.
	 *
	 * @access public
	 */
	public function RegisterSections() {
		add_settings_section(
			'wpomp_section_main',
			__('Uploading Files'),
			null,
			'wpomp_pages'
		);
	}

	/**
	 * RegisterFields function.
	 *
	 * @access public
	 */
	public function RegisterFields() {
		register_setting('wpomp_fields', 'upload_path');
		register_setting('wpomp_fields', 'upload_url_path');
	}

	/**
	 * AddFields function.
	 *
	 * @access public
	 */
	public function AddFields() {

		$fields_tab = array(
			'upload_path'     => array(
				'id'             => 'upload_path',
				'title'          => __('Store uploads in this folder'),
				'description'    => __('Default is <code>wp-content/uploads</code>'),
			),
			'upload_url_path' => array(
				'id'             => 'upload_url_path',
				'title'          => __('Full URL path to files'),
				'description'    => null,
			),
		);

		foreach($fields_tab as $id => $field){
			add_settings_field(
				$id,
				$field['title'],
				array($this, 'InputFields'),
				'wpomp_pages',
				'wpomp_section_main',
				$field
			);
		}
	}

	/**
	 * InputFields function.
	 *
	 * @access public
	 * @param mixed $field
	 */
	public function InputFields($field) {

		printf(
			'<input name="%1$s" type="text" id="%1$s" value="%2$s" class="regular-text code" />',
			$field['id'],
			get_option($field['id'])
		);

		printf(
			'<p class="description">%s</p>',
			$field['description']
		);
	}

}