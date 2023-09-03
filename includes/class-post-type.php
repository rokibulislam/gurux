<?php
/**
 * PostType
 *
 * @author Kamrul
 * @package GuruX
 */

namespace GuruX;

/**
 * PostType class
 * 
 * @package GuruX
 */ 
class PostType {

	/**
	 * Constructor
	 */
	public function __construct() {
		
		add_filter( 'gutenberg_can_edit_post_type', array( $this, 'gutenberg_can_edit_post_type' ), 10, 2 );
		add_filter( 'use_block_editor_for_post_type', array( $this, 'gutenberg_can_edit_post_type' ), 10, 2 );

		add_action( 'init', array( $this, 'register_course_post_types' ) );
	}

	/**
	 * Gutenburg disalbe/enable for course post type
	 * 
	 * @return boolean
	 */
	public function gutenberg_can_edit_post_type( $can_edit, $post_type ) {
		return 'course' === $post_type ? false : $can_edit;
	}

	/**
	 * Register Course Post Type
	 * 
	 * @return void
	 */
	public function register_course_post_types() {
		
		$labels = array(
			'name'               => _x( 'Courses', 'post type general name', 'tutor' ),
			'singular_name'      => _x( 'Course', 'post type singular name', 'tutor' ),
			'menu_name'          => _x( 'Courses', 'admin menu', 'tutor' ),
			'name_admin_bar'     => _x( 'Course', 'add new on admin bar', 'tutor' ),
			'add_new'            => _x( 'Add New', 'tutor course add', 'tutor' ),
			'add_new_item'       => __( 'Add New Course', 'tutor' ),
			'new_item'           => __( 'New Course', 'tutor' ),
			'edit_item'          => __( 'Edit Course', 'tutor' ),
			'view_item'          => __( 'View Course', 'tutor' ),
			'all_items'          => __( 'Courses', 'tutor' ),
			'search_items'       => __( 'Search Courses', 'tutor' ),
			'parent_item_colon'  => __( 'Parent Courses:', 'tutor' ),
			'not_found'          => __( 'No courses found.', 'tutor' ),
			'not_found_in_trash' => __( 'No courses found in Trash.', 'tutor' ),
		);

		$args = array(
			'labels'             => $labels,
			'description'        => __( 'Description.', 'tutor' ),
			'public'             => true,
			'publicly_queryable' => true,
			// 'show_ui'                   => true,
			// 'show_in_menu'              => 'tutor',
			'query_var'          => true,
			'menu_icon'          => 'dashicons-book-alt',
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'taxonomies'         => array( 'course-category', 'course-tag' ),
			'supports'           => array( 'title', 'editor', 'thumbnail', 'excerpt', 'author' ),
			'show_in_rest'       => true,
		);

		register_post_type( 'course', $args );

		/**
		 * Taxonomy
		 */
		$cclabels = array(
			'name'                       => _x( 'Course Categories', 'taxonomy general name', 'tutor' ),
			'singular_name'              => _x( 'Category', 'taxonomy singular name', 'tutor' ),
			'search_items'               => __( 'Search Categories', 'tutor' ),
			'popular_items'              => __( 'Popular Categories', 'tutor' ),
			'all_items'                  => __( 'All Categories', 'tutor' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit Category', 'tutor' ),
			'update_item'                => __( 'Update Category', 'tutor' ),
			'add_new_item'               => __( 'Add New Category', 'tutor' ),
			'new_item_name'              => __( 'New Category Name', 'tutor' ),
			'separate_items_with_commas' => __( 'Separate categories with commas', 'tutor' ),
			'add_or_remove_items'        => __( 'Add or remove categories', 'tutor' ),
			'choose_from_most_used'      => __( 'Choose from the most used categories', 'tutor' ),
			'not_found'                  => __( 'No categories found.', 'tutor' ),
			'menu_name'                  => __( 'Course Categories', 'tutor' ),
		);

		$ccargs = array(
			'hierarchical'          => true,
			'labels'                => $cclabels,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'show_in_rest'          => true,
			'rewrite'               => array( 'slug' => 'course-category' ),
		);

		register_taxonomy( 'course-category', 'course', $ccargs );

		$ctlabels = array(
			'name'                       => _x( 'Tags', 'taxonomy general name', 'tutor' ),
			'singular_name'              => _x( 'Tag', 'taxonomy singular name', 'tutor' ),
			'search_items'               => __( 'Search Tags', 'tutor' ),
			'popular_items'              => __( 'Popular Tags', 'tutor' ),
			'all_items'                  => __( 'All Tags', 'tutor' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit Tag', 'tutor' ),
			'update_item'                => __( 'Update Tag', 'tutor' ),
			'add_new_item'               => __( 'Add New Tag', 'tutor' ),
			'new_item_name'              => __( 'New Tag Name', 'tutor' ),
			'separate_items_with_commas' => __( 'Separate Tags with commas', 'tutor' ),
			'add_or_remove_items'        => __( 'Add or remove Tags', 'tutor' ),
			'choose_from_most_used'      => __( 'Choose from the most used Tags', 'tutor' ),
			'not_found'                  => __( 'No Tags found.', 'tutor' ),
			'menu_name'                  => __( 'Tags', 'tutor' ),
		);

		$ctargs = array(
			'hierarchical'          => false,
			'labels'                => $ctlabels,
			'show_ui'               => true,
			'show_admin_column'     => true,
			'update_count_callback' => '_update_post_term_count',
			'query_var'             => true,
			'show_in_rest'          => true,
			'rewrite'               => array( 'slug' => 'course-tag' ),
		);

		register_taxonomy( 'course-tag', 'course', $ctargs );

	}
}
