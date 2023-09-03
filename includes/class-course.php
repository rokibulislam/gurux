<?php
/**
 * Course
 *
 * @author Kamrul
 * @package GuruX
 */

namespace GuruX;

/**
 * Course class
 * 
 * @package GuruX
 */ 
class Course {

	/**
	 * Constructor
	 */
	public function __construct() {

		add_action( 'add_meta_boxes', array( $this, 'add_meta_box' ) );

		add_action( 'save_post', array( $this, 'save_meta' ), 10, 2 );

		add_filter( "manage_course_posts_columns", array( $this, 'add_column' ), 10, 1 );
		add_action( "manage_course_posts_custom_column", array( $this, 'custom_column' ), 10, 2 );

		add_action( 'wp_ajax_gurux_delete_dashboard_course', array( $this, 'delete_dashboard_course' ) );

		add_action( 'template_redirect', array( $this, 'enroll_now' ) );
		add_action( 'init', array( $this, 'mark_course_complete' ) );


		add_action( 'before_delete_post', array( $this, 'delete_associated_enrollment' ) );
		add_filter( 'posts_where', array( $this, 'restrict_media' ) );
	}

	/**
	 * Restrict Media
	 * 
	 * @param string $where
	 * 
	 * @return $string
	 */
	public function restrict_media( $where ) {

		return $where;
	}

	/**
	 * Delete Enrollment
	 * 
	 * @return void
	 */
	public function delete_associated_enrollment() {

	}

	/**
	 * Mark Course Complete
	 * 
	 * @return void
	 */
	public function mark_course_complete() {

	}

	/**
	 * Enroll Now
	 * 
	 * @return void
	 */
	public function enroll_now() {

	}

	/**
	 * Delete From Dashboard
	 * 
	 * @return void
	 */
	public function delete_dashboard_course() {

	}

	/**
	 * Add Meta Box
	 * 
	 * @return void
	 */
	public function add_meta_box() {
		add_meta_box( 'gurux-course-topics', __( 'Course Builder', 'gurux' ), array( $this, 'course_meta_box' ), 'course', 'advanced', 'default' );
	}

	/**
	 * Save Meta Box
	 * 
	 * @return void
	 */
	public function save_meta( $post_ID, $post ) {
		
	}

	/**
	 * Course Meta Box
	 * 
	 * @return void
	 */
	public function course_meta_box() {
		echo "course meta box";
	}

	/**
	 * Add Column
	 * 
	 * @return void
	 */
	public function add_column( $columns ) {

		return $columns;
	}

	/**
	 * Custom Column
	 * 
	 * @return void
	 */
	public function custom_column( $column, $post_id ) {

	}
}
