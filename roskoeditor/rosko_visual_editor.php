<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://trajcheroshkoski.com/
 * @since             1.0.0
 * @package           rosko_visual_editor
 *
 * @wordpress-plugin
 * Plugin Name:       Rosko Visual Editor
 * Plugin URI:        https://wordpress.org/plugins/rosko-visual-editor/
 * Description:       Drag and Drop Visual editor with 10 available modules for easy development of any site.
 * Version:           1.1.1
 * Author:            Trajche Roshkoski
 * Author URI:        https://trajcheroshkoski.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       rosko-visual-editor
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-rosko-visual-editor-activator.php
 */
function activate_rosko_visual_editor() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/rosko-visual-editor-activator.php';
	Rosko_Visual_Editor_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-rosko-visual-editor-deactivator.php
 */
function deactivate_rosko_visual_editor() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/rosko-visual-editor-deactivator.php';
	Rosko_Visual_Editor_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_rosko_visual_editor' );
register_deactivation_hook( __FILE__, 'deactivate_rosko_visual_editor' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-rosko-visual-editor.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_rosko_visual_editor() {

	$plugin = new Rosko_Visual_Editor();
	$plugin->rve_run();

}
run_rosko_visual_editor();
