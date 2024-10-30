<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       dangngocbinh.com
 * @since      1.0.0
 *
 * @package    Mobi_Actionbar
 * @subpackage Mobi_Actionbar/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Mobi_Actionbar
 * @subpackage Mobi_Actionbar/includes
 * @author     Dang Ngoc Binh <dangngocbinh.dnb@gmail.com>
 */
class Mobi_Actionbar_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'mobi-actionbar',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
