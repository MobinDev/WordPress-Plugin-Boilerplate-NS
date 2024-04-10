<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the dashboard.
 *
 * @link       http://example.com
 * @since      1.0.0
 *
 * @package    PluginName
 * @subpackage PluginName/includes
 */

namespace MobinDev\Plugin_Name;

use YahnisElsts\PluginUpdateChecker\v5\PucFactory;

/**
 * The core plugin class.
 *
 * This is used to define internationalization, dashboard-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    PluginName
 * @subpackage PluginName/includes
 * @author     Seyed Mobin Avazolhayat <mobin733@gmail.com>
 */
class Plugin {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      PluginName_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $pluginname    The string used to uniquely identify this plugin.
	 */
	protected $pluginname = 'plugin-name';

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version = '1.0.0';

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		$this->loader = new Loader();
	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the I18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new I18n();
		$plugin_i18n->set_domain( $this->get_name() );
		$plugin_i18n->load_plugin_textdomain();

	}

	/**
	 * Register all of the hooks related to the dashboard functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_frontend_hooks() {

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * Load the dependencies, define the locale, and set the hooks for the Dashboard and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_frontend_hooks();
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_name() {
		return $this->pluginname;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    PluginName_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}
	protected function setUpdateChecker(){
		$plugin_slug = $this->get_name().'/'.$this->get_name().'.php';
		$plugin_path = trailingslashit( WP_PLUGIN_DIR ) . $plugin_slug;
		$updateChecker = PucFactory::buildUpdateChecker(
			'https://github.com/MobinDev/'.$this->get_name().'/',
			//'https://github.com/Tie-Solution-GmbH/'.$this->get_name().'/',
			$plugin_path,
			$plugin_slug
		);
		
		//Set the branch that contains the stable release.
		$updateChecker->setBranch('master');
		
		//Optional: If you're using a private repository, specify the access token like this:
		$updateChecker->setAuthentication('');
	}

}
