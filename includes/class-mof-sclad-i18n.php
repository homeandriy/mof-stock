<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://webbooks.com.ua/portfolio
 * @since      1.0.0
 *
 * @package    Mof_Sclad
 * @subpackage Mof_Sclad/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Mof_Sclad
 * @subpackage Mof_Sclad/includes
 * @author     Andrii Beznosko <homeandriy@gmail.com>
 */
class Mof_Sclad_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'mof-sclad',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
