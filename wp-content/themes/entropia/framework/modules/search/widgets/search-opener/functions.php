<?php

if ( ! function_exists( 'entropia_edge_register_search_opener_widget' ) ) {
	/**
	 * Function that register search opener widget
	 */
	function entropia_edge_register_search_opener_widget( $widgets ) {
		$widgets[] = 'EntropiaEdgeClassSearchOpener';
		
		return $widgets;
	}
	
	add_filter( 'entropia_edge_filter_register_widgets', 'entropia_edge_register_search_opener_widget' );
}