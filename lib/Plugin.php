<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the dashboard.
 *
 * @link       http://mobindev.ir
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
	private function setLocale() {
		$plugin_i18n = new I18n();
		$plugin_i18n->set_domain( $this->getName() );
		$plugin_i18n->load_plugin_textdomain();

	}

	/**
	 * Register all of the hooks related to the dashboard functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function defineAdminHooks() {

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function defineFrontendHooks() {

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
		$this->setLocale();
		$this->defineAdminHooks();
		$this->defineFrontendHooks();
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function getName() {
		return $this->pluginname;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Loader    Orchestrates the hooks of the plugin.
	 */
	public function getLoader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function getVrsion() {
		return $this->version;
	}

	public function getDir()
	{
		return untrailingslashit( plugin_dir_path( dirname( __FILE__ ) ) );
	}
	public function getUrl()
	{
		return plugin_dir_url(dirname(__FILE__));
	}

	public function getAssetsDir($file = '')
	{
		return plugin_dir_path(dirname(__FILE__)) . "assets/$file";
	}

	public function getDistUrl($file='')
	{
		return $this->getUrl() . "dist/$file";
	}

	public function getDistScriptsUrl($file='')
	{
		return $this->getUrl() . "dist/scripts/$file";
	}

	public function getDistStylesUrl($file='')
	{
		return $this->getUrl() . "dist/styles/$file";
	}

	protected function setUpdateChecker(){
		$plugin_slug = $this->getName().'/'.$this->getName().'.php';
		$plugin_path = trailingslashit( WP_PLUGIN_DIR ) . $plugin_slug;
		$updateChecker = PucFactory::buildUpdateChecker(
			'https://github.com/MobinDev/'.$this->getName().'/',
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
