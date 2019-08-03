<?php

if ( ! function_exists( 'entropia_edge_register_blog_list_widget' ) ) {
	/**
	 * Function that register blog list widget
	 */
	function entropia_edge_register_blog_list_widget( $widgets ) {
		$widgets[] = 'EntropiaEdgeClassBlogListWidget';
		
		return $widgets;
	}
	
	add_filter( 'entropia_edge_filter_register_widgets', 'entropia_edge_register_blog_list_widget' );
}