<?php

if ( ! function_exists( 'entropia_edge_register_button_widget' ) ) {
	/**
	 * Function that register button widget
	 */
	function entropia_edge_register_button_widget( $widgets ) {
		$widgets[] = 'EntropiaEdgeClassButtonWidget';
		
		return $widgets;
	}
	
	add_filter( 'entropia_edge_filter_register_widgets', 'entropia_edge_register_button_widget' );
}