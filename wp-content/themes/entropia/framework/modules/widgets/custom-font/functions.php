<?php

if ( ! function_exists( 'entropia_edge_register_custom_font_widget' ) ) {
	/**
	 * Function that register custom font widget
	 */
	function entropia_edge_register_custom_font_widget( $widgets ) {
		$widgets[] = 'EntropiaEdgeClassCustomFontWidget';
		
		return $widgets;
	}
	
	add_filter( 'entropia_edge_filter_register_widgets', 'entropia_edge_register_custom_font_widget' );
}