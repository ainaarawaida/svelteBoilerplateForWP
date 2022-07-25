<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              svelteBoilerplate
 * @since             1.0.0
 * @package           Svelteboilerplate
 *
 * @wordpress-plugin
 * Plugin Name:       svelteBoilerplate
 * Plugin URI:        svelteBoilerplate
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Luqman Nordin
 * Author URI:        svelteBoilerplate
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       svelteboilerplate
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'SVELTEBOILERPLATE_VERSION', '1.0.0' );
define( 'SVELTEBOILERPLATE_PATH', plugin_dir_path( __FILE__ ) );
define( 'SVELTEBOILERPLATE_URL', plugins_url('svelteboilerplate') );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-svelteboilerplate-activator.php
 */
function activate_svelteboilerplate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-svelteboilerplate-activator.php';
	Svelteboilerplate_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-svelteboilerplate-deactivator.php
 */
function deactivate_svelteboilerplate() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-svelteboilerplate-deactivator.php';
	Svelteboilerplate_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_svelteboilerplate' );
register_deactivation_hook( __FILE__, 'deactivate_svelteboilerplate' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-svelteboilerplate.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_svelteboilerplate() {

	$plugin = new Svelteboilerplate();
	$plugin->run();

}
run_svelteboilerplate();
