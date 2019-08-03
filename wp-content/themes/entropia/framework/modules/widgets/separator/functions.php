<?php

if ( ! function_exists( 'entropia_edge_register_separator_widget' ) ) {
	/**
	 * Function that register separator widget
	 */
	function entropia_edge_register_separator_widget( $widgets ) {
		$widgets[] = 'EntropiaEdgeClassSeparatorWidget';
		
		return $widgets;
	}
	
	add_filter( 'entropia_edge_filter_register_widgets', 'entropia_edge_register_separator_widget' );
}