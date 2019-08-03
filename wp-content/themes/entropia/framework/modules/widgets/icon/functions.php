<?php

if ( ! function_exists( 'entropia_edge_register_icon_widget' ) ) {
	/**
	 * Function that register icon widget
	 */
	function entropia_edge_register_icon_widget( $widgets ) {
		$widgets[] = 'EntropiaEdgeClassIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'entropia_edge_filter_register_widgets', 'entropia_edge_register_icon_widget' );
}