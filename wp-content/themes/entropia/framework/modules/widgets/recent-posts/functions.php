<?php

if ( ! function_exists( 'entropia_edge_register_recent_posts_widget' ) ) {
	/**
	 * Function that register search opener widget
	 */
	function entropia_edge_register_recent_posts_widget( $widgets ) {
		$widgets[] = 'EntropiaEdgeClassRecentPosts';
		
		return $widgets;
	}
	
	add_filter( 'entropia_edge_filter_register_widgets', 'entropia_edge_register_recent_posts_widget' );
}