<?php

/**
 * Fired during plugin activation
 *
 * @link       dangngocbinh.com
 * @since      1.0.0
 *
 * @package    Mobi_Actionbar
 * @subpackage Mobi_Actionbar/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Mobi_Actionbar
 * @subpackage Mobi_Actionbar/includes
 * @author     Dang Ngoc Binh <dangngocbinh.dnb@gmail.com>
 */
class Mobi_Actionbar_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		update_option( 'mobi_actionbar_global_logo', '0' );
		update_option( 'mobi_actionbar_global_button_text', 'Buy Now' );
		update_option( 'mobi_actionbar_global_action_link', '#buynow' );

	}

}
