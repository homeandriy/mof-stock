<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://webbooks.com.ua/portfolio
 * @since             1.0.0
 * @package           Mof_Sclad
 *
 *
 * @wordpress-plugin
 * Plugin Name:       Maintenance of equipment
 * Plugin URI:        https://webbooks.com.ua/plugins
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Andrii Beznosko
 * Author URI:        https://webbooks.com.ua/portfolio
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       mof-sclad
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
date_default_timezone_set('Europe/Kiev');
/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'MOF_SCLAD_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-mof-sclad-activator.php
 */
function activate_mof_sclad() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mof-sclad-activator.php';
	Mof_Sclad_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-mof-sclad-deactivator.php
 */
function deactivate_mof_sclad() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-mof-sclad-deactivator.php';
	Mof_Sclad_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_mof_sclad' );
register_deactivation_hook( __FILE__, 'deactivate_mof_sclad' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-mof-sclad.php';
require plugin_dir_path( __FILE__ ) . 'includes/core/MOF_User.php';
$_GLOBALS['mof_user'] = new MOF_User();


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_mof_sclad() {

	$plugin = new Mof_Sclad();
	$plugin->run();

}
run_mof_sclad();
