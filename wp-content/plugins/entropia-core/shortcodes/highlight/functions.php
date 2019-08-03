<?php

if ( ! function_exists( 'entropia_core_add_highlight_shortcodes' ) ) {
	function entropia_core_add_highlight_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'EntropiaCore\CPT\Shortcodes\Highlight\Highlight'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'entropia_core_filter_add_vc_shortcode', 'entropia_core_add_highlight_shortcodes' );
}