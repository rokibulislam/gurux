<?php

/**
 * Plugin Name: GuruX
 * Description: A plugin for an Multivendor online store.
 * Author: Kamrul Islam
 * Author URI: https://profiles.wordpress.org/rajib00002/
 * Version: 1.0.0
 * License: GPL2
 * Text Domain: multistorex
 * Domain Path: /languages/
 */

/*
	Copyright (C) Year  Author  Email

	This program is free software; you can redistribute it and/or modify
	it under the terms of the GNU General Public License, version 2, as
	published by the Free Software Foundation.

	This program is distributed in the hope that it will be useful,
	but WITHOUT ANY WARRANTY; without even the implied warranty of
	MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	GNU General Public License for more details.

	You should have received a copy of the GNU General Public License
	along with this program; if not, write to the Free Software
	Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA
*/

// don't call the file directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * MultiStoreX class
 *
 * @class MultiStoreX The class that holds the entire MultiStoreX plugin
 *
 */

final class GuruX {

	/**
	 * GuruX version.
	 *
	 * @var string
	 */
	public $version = '1.0.0';

	/**
	 * Holds various class instances
	 *
	 * @var array
	 */
	private $container = [];

	/**
	 * The single instance of the class.
	 *
	 * @var GuruX
	 */
	private static $instance = null;


	/**
	 * Constructor
	 *
	 */
	private function __construct() {
		$this->define_constants();
		$this->includes();

		register_activation_hook( __FILE__, [ $this, 'activate' ] );
		register_deactivation_hook( __FILE__, [ $this, 'deactivate' ] );


		add_action( 'woocommerce_flush_rewrite_rules', [ $this, 'flush_rewrite_rules' ] );

		add_action( 'plugins_loaded', [ $this, 'init_plugin' ], 11 );
	}

	/**
	 * Initializes the MultiStoreX class
	 *
	 * @return object
	 */
	public static function init() {
		if ( self::$instance === null ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	/**
	 * Magic Method getter to bypass referencing objects
	 *
	 * @return void
	 */
	public function __get( $prop ) {
		if ( array_key_exists( $prop, $this->container ) ) {
			return $this->container[ $prop ];
		}
	}

	/**
	 * Activation function
	 *
	 * @return @void
	 */
	public function activate() {
		$installer = new GuruX\Installer();
		$installer->create_setup();
		$this->flush_rewrite_rules();
	}

	/**
	 * Deactivation function
	 *
	 * @return void
	 */
	public function deactivate() {

	}

	/**
	 *  Define Constants
	 *
	 * @return void
	 */
	public function define_constants() {
		define( 'GuruX_PLUGIN_VERSION', $this->version );
		define( 'GuruX_FILE', __FILE__ );
		define( 'GuruX_DIR', __DIR__ );
		define( 'GuruX_INC_DIR', __DIR__ . '/includes' );
		define( 'GuruX_PLUGIN_ASSEST', plugins_url( 'assets', __FILE__ ) );
	}

	/**
	 * Load the plugin after Woocommerce is loaded
	 *
	 * @return void
	 */
	public function init_plugin() {
		$this->init_classes();
		$this->init_hooks();
	}

	/**
	 * Flush rewrite rules after multistorex is activated or woocommerce is activated
	 *
	 * @return void
	 */
	public function flush_rewrite_rules() {

		// fix rewrite rules
		if ( ! isset( $this->container['rewrite'] ) ) {
			$this->container['rewrite'] = new GuruX\Rewrites();
		}

		$this->container['rewrite']->register_rule();

		flush_rewrite_rules();
	}

	/**
	 * Include all the required files
	 *
	 * @return void
	 */
	public function includes() {

		require_once GuruX_INC_DIR . '/class-admin.php';
		require_once GuruX_INC_DIR . '/class-ajax.php';
		require_once GuruX_INC_DIR . '/class-assets.php';
		require_once GuruX_INC_DIR . '/class-category.php';
		require_once GuruX_INC_DIR . '/class-course.php';
		require_once GuruX_INC_DIR . '/class-frontend.php';

		require_once GuruX_INC_DIR . '/class-student.php';
		require_once GuruX_INC_DIR . '/class-instructor.php';
		require_once GuruX_INC_DIR . '/class-post-type.php';
		require_once GuruX_INC_DIR . '/class-rewrite.php';
		require_once GuruX_INC_DIR . '/class-template.php';
		require_once GuruX_INC_DIR . '/class-withdraw.php';


		require_once GuruX_INC_DIR . '/Installer/class-installer.php';
		require_once GuruX_INC_DIR . '/Settings/class-settings.php';
		require_once GuruX_INC_DIR . '/functions.php';
	}

	/**
	 * Init all the classes
	 *
	 * @return void
	 */
	public function init_classes() {
		if( is_admin() ) {
			new GuruX\Admin();
			new GuruX\CourseCategory();
			new GuruX\Course();
		}
		new GuruX\PostType();
		new GuruX\Ajax();
		new GuruX\Frontend();
		new GuruX\WithDraw();

		$this->container['assets']       = new GuruX\Assets();

		if ( ! isset( $this->container['rewrite'] ) ) {
			$this->container['rewrite'] = new GuruX\Rewrites();
		}
	}

	/**
	 * Hook into actions and filters.
	 *
	 * @return void
	 */
	public function init_hooks() {
		add_action( 'init', [ $this, 'localization_setup' ] );
	}

	/**
	 * Initialize plugin for localization
	 *
	 * @uses load_plugin_textdomain()
	 */
	public function localization_setup() {
		load_plugin_textdomain( 'gurux', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );
	}

	/**
	 * Get the plugin path.
	 *
	 * @return string
	 */
	public function plugin_path() {
		return untrailingslashit( plugin_dir_path( __FILE__ ) );
	}

	/**
	 * Get the template path.
	 *
	 * @return string
	 */
	public function template_path() {
		return apply_filters( 'multistorex_template_path', 'gurux/' );
	}
}

/**
 * Load Multistorx Plugin
 *
 * @return GuruX
 */
function gurux() {
	return GuruX::init();
}

gurux();
