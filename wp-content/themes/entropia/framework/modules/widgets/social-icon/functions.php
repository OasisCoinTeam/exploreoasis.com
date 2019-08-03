<?php

if ( ! function_exists( 'entropia_edge_register_social_icon_widget' ) ) {
	/**
	 * Function that register social icon widget
	 */
	function entropia_edge_register_social_icon_widget( $widgets ) {
		$widgets[] = 'EntropiaEdgeClassSocialIconWidget';
		
		return $widgets;
	}
	
	add_filter( 'entropia_edge_filter_register_widgets', 'entropia_edge_register_social_icon_widget' );
}