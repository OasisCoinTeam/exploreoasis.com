<?php

if ( ! function_exists( 'entropia_edge_register_woocommerce_dropdown_cart_widget' ) ) {
	/**
	 * Function that register dropdown cart widget
	 */
	function entropia_edge_register_woocommerce_dropdown_cart_widget( $widgets ) {
		$widgets[] = 'EntropiaEdgeClassWoocommerceDropdownCart';
		
		return $widgets;
	}
	
	add_filter( 'entropia_edge_filter_register_widgets', 'entropia_edge_register_woocommerce_dropdown_cart_widget' );
}

if ( ! function_exists( 'entropia_edge_get_dropdown_cart_icon_class' ) ) {
	/**
	 * Returns dropdow cart icon class
	 */
	function entropia_edge_get_dropdown_cart_icon_class() {
		$classes = array(
			'edgtf-header-cart'
		);
		
		$classes[] = entropia_edge_get_icon_sources_class( 'dropdown_cart', 'edgtf-header-cart' );
		
		return $classes;
	}
}