<?php
/**
 * Admin
 *
 * @author Kamrul
 * @package GuruX
 */

namespace GuruX;

/**
 * Admin class
 *
 * @package MultiStoreX
 */
class Admin {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'add_admin_menu' ) );
	}

	/**
	 * Add menu in dashboard
	 *
	 * @return void
	 */
	public function add_admin_menu() {

		$slug          = 'gurux';
		$capability    = 'manage_options';

		$dashboard = add_menu_page( __( 'GuruX', 'gurux' ), __( 'GuruX', 'multistorex' ), $capability, $slug, array( $this, 'dashboard' ) );

		add_submenu_page( 'gurux', __( 'Students', 'gurux' ), __( 'Students', 'gurux' ), 'manage_options', 'gurux_students', array( $this, 'load_students_page' ) );
		add_submenu_page( 'gurux', __( 'Instructors', 'gurux' ), __( 'Instructors', 'gurux' ), 'manage_options', 'gurux_instructors', array( $this, 'load_instructors_page' ) );

		do_action( 'gurux_admin_menu' );

		add_submenu_page( 'gurux', __( 'Tools', 'gurux' ), __( 'Tools', 'gurux' ), 'manage_options', 'gurux_tools', array( $this, 'load_tools_page' ) );
		add_submenu_page( 'gurux', __( 'Settings', 'gurux' ), __( 'Settings', 'gurux' ), 'manage_options', 'gurux_settings', array( $this, 'load_settings_page' ) );
	}

	/**
	 * Load Dashboard
	 *
	 * @return void
	 */
	public function dashboard() {
		echo __( 'dashboard', 'gurux' );
	}

	/**
	 * Load Tools Page
	 *
	 * @return void
	 */
	public function load_tools_page() {
		echo __( 'Tools', 'gurux' );
	}

	/**
	 * Load Instrutor Page
	 *
	 * @return void
	 */
	public function load_instructors_page() {
		echo __( 'Instructors', 'gurux' );
	}

	/**
	 * Load Students Page
	 *
	 * @return void
	 */
	public function load_students_page() {
		echo __( 'Students', 'gurux' );
	}

	/**
	 * Load Settings Page
	 *
	 * @return void
	 */
	public function load_settings_page() {
		echo __( 'Settings', 'gurux' );
	}
}
