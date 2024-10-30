<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              dangngocbinh.com
 * @since             1.0.0
 * @package           Mobi_Actionbar
 *
 * @wordpress-plugin
 * Plugin Name:       Mobile Action Bar
 * Plugin URI:        http://thikshare.com
 * Description:       Easy Call To Action on Mobile 
 * Version:           1.0.0
 * Author:            Dang Ngoc Binh
 * Author URI:        dangngocbinh.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mobi-actionbar
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mobi-actionbar-activator.php
 */
function activate_mobi_actionbar() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mobi-actionbar-activator.php';
	Mobi_Actionbar_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mobi-actionbar-deactivator.php
 */
function deactivate_mobi_actionbar() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mobi-actionbar-deactivator.php';
	Mobi_Actionbar_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mobi_actionbar' );
register_deactivation_hook( __FILE__, 'deactivate_mobi_actionbar' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mobi-actionbar.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mobi_actionbar() {

	$plugin = new Mobi_Actionbar();
	$plugin->run();

}
run_mobi_actionbar();
