<?php
if ( ! function_exists( 'entropia_core_add_testimonials_shortcode' ) ) {
	function entropia_core_add_testimonials_shortcode( $shortcodes_class_name ) {
		$shortcodes = array(
			'EntropiaCore\CPT\Shortcodes\Testimonials\Testimonials'
		);
		
		$shortcodes_class_name = array_merge( $shortcodes_class_name, $shortcodes );
		
		return $shortcodes_class_name;
	}
	
	add_filter( 'entropia_core_filter_add_vc_shortcode', 'entropia_core_add_testimonials_shortcode' );
}

if ( ! function_exists( 'entropia_core_set_testimonials_icon_class_name_for_vc_shortcodes' ) ) {
	/**
	 * Function that set custom icon class name for testimonials shortcode to set our icon for Visual Composer shortcodes panel
	 */
	function entropia_core_set_testimonials_icon_class_name_for_vc_shortcodes( $shortcodes_icon_class_array ) {
		$shortcodes_icon_class_array[] = '.icon-wpb-testimonials';
		
		return $shortcodes_icon_class_array;
	}
	
	add_filter( 'entropia_core_filter_add_vc_shortcodes_custom_icon_class', 'entropia_core_set_testimonials_icon_class_name_for_vc_shortcodes' );
}