<?php

if ( ! function_exists( 'entropia_core_add_dropcaps_shortcodes' ) ) {
	function entropia_core_add_dropcaps_shortcodes( $shortcodes_class_name ) {
		$shortcodes = array(
			'EntropiaCore\CPT\Shortcodes\Dropcaps\Dropcaps'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'entropia_core_filter_add_vc_shortcode', 'entropia_core_add_dropcaps_shortcodes' );
}