<?php
/**
 * Student
 *
 * @author Kamrul
 * @package GuruX
 */

namespace GuruX;

/**
 * rewrite rules class
 * 
 * @package GuruX
 */ 
class Rewrites {

    /**
     * Store query variable
     * 
     * @var array
     */ 
    public $query_vars = [];
    
    /**
     * Hook into the functions
     * 
     * @return void
     */
    public function __construct() {
        add_action( 'init', [ $this, 'register_rule' ] );
        add_filter( 'query_vars', [ $this, 'register_query_var' ] );
    }

    /**
     * Register the rewrite rule
     *
     * @return void
     */
    public function register_rule() {
        $this->query_vars = apply_filters(
            'gurux_query_var_filter', [
                'courses',
                'new-course',
                'orders',
                'settings',
            ]
        );

        foreach ( $this->query_vars as $var ) {
            add_rewrite_endpoint( $var, EP_PAGES );
        }

        do_action( 'gurux_rewrite_rules_loaded' );
    }


    /**
     * Register the query var
     *
     * @param array $vars
     *
     * @return array
     */
    public function register_query_var( $vars ) {
        foreach ( $this->query_vars as $var ) {
            $vars[] = $var;
        }

        return $vars;
    }
}
