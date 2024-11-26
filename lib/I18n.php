<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       http://mobindev.ir
 * @since      1.0.0
 *
 * @package    PluginName
 * @subpackage PluginName/includes
 */

namespace MobinDev\Plugin_Name;

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    PluginName
 * @subpackage PluginName/includes
 * @author     Seyed Mobin Avazolhayat <mobin733@gmail.com>
 */
class I18n {

	private Plugin $plugin;

	public function __construct($plugin)
	{
		$this->plugin = $plugin;
		$plugin->getLoader()->add_action( 'init', [$this, 'load_plugin_textdomain'], 0);
	}

	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {
		$locale = determine_locale();
		$domain = $this->plugin->getName();
		/**
		 * Filter to adjust the WooCommerce locale to use for translations.
		 */
		$locale = apply_filters( 'plugin_locale', $locale, $domain ); // phpcs:ignore WooCommerce.Commenting.CommentHooks.MissingSinceComment

		unload_textdomain( $domain  );
		load_textdomain( $domain, WP_LANG_DIR . '/' . $domain . '/' . $domain . '-' . $locale . '.mo' );
		load_plugin_textdomain( $domain , false, $this->plugin->getDir() . '/languages/' );

		\load_plugin_textdomain(
			$domain,
			false,
			dirname( dirname( \plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}

}
