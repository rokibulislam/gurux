<?php
/**
 * Frontend
 *
 * @author Kamrul
 * @package GuruX
 */

namespace GuruX;

/**
 * Frotnend Class
 * 
 */
class Frontend {

	/**
	 * Constructor
	 */
	public function __construct() {
		add_shortcode( 'gurux-dashboard', array( $this, 'render_dashboard' ) );
	}

	/**
	 * Render Dashboard
	 * 
	 * @param $atts    array
	 * @param $content string
	 * 
	 */
	public function render_dashboard( $atts, $content ) {
		return "gurux dashboard";
	}
}
