<?php
/**
 * Instructor
 *
 * @author Kamrul
 * @package GuruX
 */

namespace GuruX;

if( ! class_exists( 'WP_List_Table' ) ) {
    require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );
}

/**
 * Instructor Class
 * 
 * @package GuruX
 */
class Instructor extends \WP_List_Table {

	/**
	 * Constructor
	 */
	public function __construct() {

	}

	protected function get_views() {

	}

	/**
	 * No Items
	 * 
	 */
	public function no_items() {

	}

	/**
	 * Get Columns
	 *
	 * @return array
	 */
	public function get_columns() {

	}

	/**
	 * Prepare items
	 *
	 * @return void
	 */
	public function prepare_items() {

	}

	/**
	 * Column default
	 *
	 * @param array  $item item.
	 * @param string $column_name column_name.
	 *
	 * @return array
	 */
	public function column_default( $item, $column_name ) {

	}

	/**
	 * Get column cb
	 *
	 * @param array $item item.
	 *
	 * @return string
	 */
	public function column_cb( $item ) {

	}

	/**
	 * column action
	 *
	 * @return void|string
	 */
	public function column_actions( $item ) {

	}

	/**
	 * Process bulk action
	 *
	 * @return void
	 */
	public function process_bulk_action() {

	}

	/**
	 * Get sortable columns
	 *
	 * @return array
	 */
	public function get_sortable_columns() {

	}

	/**
	 * Bulk actions
	 *
	 * @return array
	 */
	public function get_bulk_actions() {

	}
}
