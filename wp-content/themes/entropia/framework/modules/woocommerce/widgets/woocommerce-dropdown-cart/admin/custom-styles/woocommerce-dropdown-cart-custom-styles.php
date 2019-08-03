<?php

if ( ! function_exists( 'entropia_edge_dropdown_cart_icon_styles' ) ) {
	/**
	 * Generates styles for dropdown cart icon
	 */
	function entropia_edge_dropdown_cart_icon_styles() {
		$icon_color       = entropia_edge_options()->getOptionValue( 'dropdown_cart_icon_color' );
		$icon_hover_color = entropia_edge_options()->getOptionValue( 'dropdown_cart_hover_color' );
		
		if ( ! empty( $icon_color ) ) {
			echo entropia_edge_dynamic_css( '.edgtf-shopping-cart-holder .edgtf-header-cart a', array( 'color' => $icon_color ) );
		}
		
		if ( ! empty( $icon_hover_color ) ) {
			echo entropia_edge_dynamic_css( '.edgtf-shopping-cart-holder .edgtf-header-cart a:hover', array( 'color' => $icon_hover_color ) );
		}
	}
	
	add_action( 'entropia_edge_action_style_dynamic', 'entropia_edge_dropdown_cart_icon_styles' );
}

if ( ! function_exists( 'entropia_edge_dropdown_cart_background_image' ) ) {
	/**
	 * Generates styles for dropdown cart
	 */
	function entropia_edge_dropdown_cart_background_image() {
		$background_image  = entropia_edge_options()->getOptionValue( 'dropdown_cart_background_image' );

		if ( ! empty( $background_image ) ) {
			$background_image_style = array(
				'background-image'    => 'url(' . esc_url( $background_image ) . ')',
				'background-repeat'   => 'no-repeat',
				'background-position' => '0 0',
				'background-color' => 'transparent',
			);
		}

		echo entropia_edge_dynamic_css( '.edgtf-shopping-cart-dropdown', $background_image_style );
	}

	add_action( 'entropia_edge_action_style_dynamic', 'entropia_edge_dropdown_cart_background_image' );
}