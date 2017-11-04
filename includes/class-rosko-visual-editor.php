<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://wordpress.org/plugins/rosko-visual-editor/
 * @since      1.0.0
 *
 * @package    rosko_visual_editor
 * @subpackage rosko_visual_editor/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    rosko_visual_editor
 * @subpackage rosko_visual_editor/includes
 * @author     Trajche Roshkoski <roskoskitrajce@gmail.com>
 */
class Rosko_Visual_Editor {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Plugin_Name_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_name = 'rosko_visual_editor';
		$this->version = '1.0.0';

		$this->rve_load_dependencies();
		$this->rve_set_locale();
		$this->rve_define_admin_hooks();
		$this->rve_define_public_hooks();
		
		//define image size that would be later used in the custom post types			
		add_image_size( 'gallery-thumb', 600, 400, true );
		add_image_size( 'staff-thumb', 500, 500, true );
		add_image_size( 'testimonials-thumb', 500, 500, true );
		add_image_size( 'slider-thumb', 1366, 500, true );

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Plugin_Name_Loader. Orchestrates the hooks of the plugin.
	 * - Plugin_Name_i18n. Defines internationalization functionality.
	 * - Plugin_Name_Admin. Defines all hooks for the admin area.
	 * - Plugin_Name_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function rve_load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/rosko-visual-editor-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/rosko-visual-editor-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/rosko-visual-editor-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/rosko-visual-editor-public.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/shortcodes-generator/rve-shortcodes-generator.php';
		
		$this->loader = new Rosko_Visual_Editor_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Plugin_Name_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function rve_set_locale() {

		$plugin_i18n = new Rosko_Visual_Editor_i18n();

		$this->loader->rve_add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function rve_define_admin_hooks() {

		$plugin_admin = new Rosko_Visual_Editor_Admin( $this->rve_get_plugin_name(), $this->rve_get_version() );

		$this->loader->rve_add_action( 'admin_enqueue_scripts', $plugin_admin, 'rve_admin_enqueue_styles' );
		$this->loader->rve_add_action( 'admin_enqueue_scripts', $plugin_admin, 'rve_admin_enqueue_scripts' );
		
		$this->loader->rve_add_action( 'admin_init', $plugin_admin, 'rve_set_user_metaboxes' );
		$this->loader->rve_add_action( 'add_meta_boxes', $plugin_admin, 'rve_add_custom_meta' );
		$this->loader->rve_add_action( 'save_post', $plugin_admin, 'rve_visual_editor_meta_save',1,2 );
		$this->loader->rve_add_action( 'wp_ajax_get_slider_posts', $plugin_admin, 'rve_get_slider_posts_callback' );
		
		$this->loader->rve_add_filter( 'the_content', $plugin_admin, 'rve_changeTheContent' );
		$this->loader->rve_add_filter( 'get_user_option_screen_layout_post', $plugin_admin, 'rve_change_layout_page' );
		$this->loader->rve_add_filter( 'get_user_option_screen_layout_page', $plugin_admin, 'rve_change_layout_page' );
		
		$this->loader->rve_add_filter( 'pre_post_title', $plugin_admin, 'rve_post_mask_empty' );
		$this->loader->rve_add_filter( 'pre_post_content', $plugin_admin, 'rve_post_mask_empty' );
		
		$this->loader->rve_add_filter( 'wp_insert_post_data', $plugin_admin, 'rve_post_unmask_empty' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function rve_define_public_hooks() {

		$plugin_public = new Rosko_Visual_Editor_Public( $this->rve_get_plugin_name(), $this->rve_get_version() );

		$this->loader->rve_add_action( 'wp_enqueue_scripts', $plugin_public, 'rve_public_enqueue_styles' );
		$this->loader->rve_add_action( 'wp_enqueue_scripts', $plugin_public, 'rve_public_enqueue_scripts' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function rve_run() {
		$this->loader->rve_loader_run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function rve_get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Plugin_Name_Loader    Orchestrates the hooks of the plugin.
	 */
	public function rve_get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function rve_get_version() {
		return $this->version;
	}

}
