<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://prodev.lt
 * @since      1.0.0
 *
 * @package    Services_Pro
 * @subpackage Services_Pro/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Services_Pro
 * @subpackage Services_Pro/admin
 * @author     Romas D. <hello@prodev.lt>
 */
class Services_Pro_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Services_Pro_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Services_Pro_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/services-pro-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Services_Pro_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Services_Pro_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/services-pro-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function acf_settings_path()
	{
		return plugin_dir_path(dirname(__FILE__)) . 'includes' . DIRECTORY_SEPARATOR . 'acf';
	}

	public function acf_settings_dir($dir)
	{
		// @todo

		return $dir;
	}

	public function query_vars($query_vars)
	{
		$query_vars[] = 'category';
		$query_vars[] = 'service';

		return $query_vars;
	}

	public function init()
	{
		if( function_exists('acf_add_options_page') ) {
			acf_add_options_page([
				'page_title' 	=> 'Services Pro options',
				'menu_title'	=> 'Services Pro',
				'capability'	=> 'edit_posts',
			]);
		}

		$options_general = get_field('services_pro_general', 'option');

		add_rewrite_rule(
			$options_general['base_slug'] . '/([A-Za-z0-9-]+)/([A-Za-z0-9-]+)/?$',
			'index.php?category=$matches[1]&service=$matches[2]',
			'top' );
	}

	public function template_include($template)
	{
		$category = get_query_var('category');
		$service = get_query_var('service');

		if (!empty($category) && !empty($service)) {
			return plugin_dir_path(dirname(__FILE__)) . 'public' . DIRECTORY_SEPARATOR . 'partials' . DIRECTORY_SEPARATOR . 'single-service.php';
		}

		return $template;
	}
}
