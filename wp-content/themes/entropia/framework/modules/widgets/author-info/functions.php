<?php

if ( ! function_exists( 'entropia_edge_register_author_info_widget' ) ) {
	/**
	 * Function that register author info widget
	 */
	function entropia_edge_register_author_info_widget( $widgets ) {
		$widgets[] = 'EntropiaEdgeClassAuthorInfoWidget';
		
		return $widgets;
	}
	
	add_filter( 'entropia_edge_filter_register_widgets', 'entropia_edge_register_author_info_widget' );
}