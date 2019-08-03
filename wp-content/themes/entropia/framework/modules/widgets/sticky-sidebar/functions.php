<?php

if ( ! function_exists( 'entropia_edge_register_sticky_sidebar_widget' ) ) {
	/**
	 * Function that register sticky sidebar widget
	 */
	function entropia_edge_register_sticky_sidebar_widget( $widgets ) {
		$widgets[] = 'EntropiaEdgeClassStickySidebar';
		
		return $widgets;
	}
	
	add_filter( 'entropia_edge_filter_register_widgets', 'entropia_edge_register_sticky_sidebar_widget' );
}