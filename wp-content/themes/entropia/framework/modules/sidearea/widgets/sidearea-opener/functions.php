<?php

if ( ! function_exists( 'entropia_edge_register_sidearea_opener_widget' ) ) {
	/**
	 * Function that register sidearea opener widget
	 */
	function entropia_edge_register_sidearea_opener_widget( $widgets ) {
		$widgets[] = 'EntropiaEdgeClassSideAreaOpener';
		
		return $widgets;
	}
	
	add_filter( 'entropia_edge_filter_register_widgets', 'entropia_edge_register_sidearea_opener_widget' );
}