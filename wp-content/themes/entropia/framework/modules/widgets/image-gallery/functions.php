<?php

if ( ! function_exists( 'entropia_edge_register_image_gallery_widget' ) ) {
	/**
	 * Function that register image gallery widget
	 */
	function entropia_edge_register_image_gallery_widget( $widgets ) {
		$widgets[] = 'EntropiaEdgeClassImageGalleryWidget';
		
		return $widgets;
	}
	
	add_filter( 'entropia_edge_filter_register_widgets', 'entropia_edge_register_image_gallery_widget' );
}