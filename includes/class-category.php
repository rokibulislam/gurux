<?php
/**
 * CourseCategory
 *
 * @author Kamrul
 * @package GuruX
 */

namespace GuruX;

/**
 * CourseCategory class
 * 
 * @package GuruX
 */ 
class CourseCategory {

	/**
	 * Constructor
	 */
	public function __construct() {

		add_action( 'course-category_add_form_fields', array( $this, 'add_fields' ) );
		add_action( 'course-category_edit_form_fields',array( $this, 'edit_fields' ) );

		add_action( 'created_term', array( $this, 'save_fields' ), 10, 3 );
		add_action( 'edit_term', array( $this, 'save_fields' ), 10, 3 );

		add_filter( 'manage_edit-course-category_columns',  array( $this, 'category_columns' ) );
		add_filter( 'manage_course-category_custom_column', array( $this, 'category_column' ), 10, 3 );
	}

	/**
	 * Add Fields
	 * 
	 * @return void
	 */
	public function add_fields() {
		echo "thumbail";
	}

	/**
	 * Edit Fields
	 * 
	 * @return void
	 */
	public function edit_fields() {

	}

	/**
	 * Save Fields
	 * 
	 * @return void
	 */
	public function save_fields($term_id, $tt_id = '', $taxonomy = '') {

	}

	/**
	 * Add Category Columns
	 * 
	 * @return void
	 */
	public function category_columns($columns) {

		return $columns;
	}

	/**
	 * Save Category Column
	 * 
	 * @return void
	 */
	public function category_column( $columns, $column, $id ) {

	}
}
