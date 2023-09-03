<?php
/**
 * Assets
 *
 * @author Kamrul
 * @package GuruX
 */

namespace GuruX;

/**
 * Assets class
 * 
 * @package GuruX
 */ 
class Assets {

	/**
	 * constructor
	 * 
	 * @return void
	 */ 
	public function __construct() {
		add_action( 'init', [ $this, 'register_all_scripts' ], 10 );

		if ( is_admin() ) {
            add_action( 'admin_enqueue_scripts', [ $this, 'enqueue_admin_scripts' ], 10 );
        } else {
            add_action( 'wp_enqueue_scripts', [ $this, 'enqueue_front_scripts' ] );
        }
	}

	/**
	 * Register all GuruX scripts and styles
	 * 
	 * @return void
	 */ 
	public function register_all_scripts() {
        $styles  = $this->get_styles();
        $scripts = $this->get_scripts();

        $this->register_styles( $styles );
        $this->register_scripts( $scripts );
    }

    /**
     * Register all GuruX styles
     * 
     * @return array
     */ 
	public function get_styles() {
		$styles = [
            'gurux-style' => [
                'src'     => GuruX_PLUGIN_ASSEST . '/css/style.css',
                'version' => '1.0.0',
            ]
		];

		return $styles;
	}


	/**
	 * Getregistered scripts
	 * 
	 * @return array
	 */ 
	public function get_scripts() {
		$scripts = [
            'gurux-script' => [
                'src'     => GuruX_PLUGIN_ASSEST . '/js/script.js',
                'version' => '1.0.0',
            ]
		];


		return $scripts;
	}

	/**
	 * Register scripts
	 * 
	 * @param array $scripts
	 * 
	 * @return void
	 */ 
	public function register_scripts( $scripts ) {
        foreach ( $scripts as $handle => $script ) {
            $deps      = isset( $script['deps'] ) ? $script['deps'] : false;
            $in_footer = isset( $script['in_footer'] ) ? $script['in_footer'] : true;
            $version   = isset( $script['version'] ) ? $script['version'] : GuruX_PLUGIN_VERSION;

            wp_register_script( $handle, $script['src'], $deps, $version, $in_footer );
        }
	}

	/**
	 * Register styles
	 * 
	 * @param array $styles
	 * 
	 * @return void
	 */ 
	public function register_styles( $styles ) {
        foreach ( $styles as $handle => $style ) {
            $deps    = isset( $style['deps'] ) ? $style['deps'] : false;
            $version = isset( $style['version'] ) ? $style['version'] : GuruX_PLUGIN_VERSION;

            wp_register_style( $handle, $style['src'], $deps, $version );
        }
	}

	/**
	 * Enqueue the scripts
	 * 
	 * @param array $scripts
	 * 
	 * @return void
	 */ 
	public function enqueue_scripts( $scripts ) {
        foreach ( $scripts as $handle => $script ) {
            wp_enqueue_script( $handle );
        }
	}

	/**
	 * Enqueue the styles
	 * 
	 * @param array $styles
	 * 
	 * @return void
	 */ 
	public function enqueue_styles( $styles ) {
        
        foreach ( $styles as $handle => $script ) {
            wp_enqueue_style( $handle );
        }
	}

	/**
	 * Enqueue admin the scripts
	 * 
	 * @param string $hook
	 * 
	 * @return void
	 */ 
	public function enqueue_admin_scripts( $hook ) {

	}

	/**
	 * Enqueue frontend the styles
	 * 
	 * @return void
	 */ 
	public function enqueue_front_scripts() {
		wp_enqueue_style( 'gurux-style' );
	}
}
