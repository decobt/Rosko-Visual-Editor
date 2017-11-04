<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://wordpress.org/plugins/rosko-visual-editor/
 * @since      1.0.0
 *
 * @package    rosko_visual_editor
 * @subpackage rosko_visual_editor/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    rosko_visual_editor
 * @subpackage rosko_visual_editor/includes
 * @author     Trajche Roshkoski <roskoskitrajce@gmail.com>
 */
class Rosko_Visual_Editor_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'rosko_visual_editor',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
