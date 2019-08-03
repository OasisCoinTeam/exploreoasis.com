<?php

if ( ! function_exists( 'entropia_edge_footer_top_general_styles' ) ) {
	/**
	 * Generates general custom styles for footer top area
	 */
	function entropia_edge_footer_top_general_styles() {
		$item_styles      = array();
		$background_color = entropia_edge_options()->getOptionValue( 'footer_top_background_color' );
		$background_image = entropia_edge_options()->getOptionValue( 'footer_top_background_image' );

		if ( ! empty( $background_color ) ) {
			$item_styles['background-color'] = $background_color;
		}

		if ( ! empty( $background_image ) ) {
			$item_styles['background-image'] = 'url(' . esc_url( $background_image ) . ')';
		}

		echo entropia_edge_dynamic_css( '.edgtf-page-footer .edgtf-footer-top-holder', $item_styles );
	}
	
	add_action( 'entropia_edge_action_style_dynamic', 'entropia_edge_footer_top_general_styles' );
}

if ( ! function_exists( 'entropia_edge_footer_bottom_general_styles' ) ) {
	/**
	 * Generates general custom styles for footer bottom area
	 */
	function entropia_edge_footer_bottom_general_styles() {
		$item_styles      = array();
		$background_color = entropia_edge_options()->getOptionValue( 'footer_bottom_background_color' );
		$background_image = entropia_edge_options()->getOptionValue( 'footer_bottom_background_image' );

		if ( ! empty( $background_color ) ) {
			$item_styles['background-color'] = $background_color;
		}

		if ( ! empty( $background_image ) ) {
			$item_styles['background-image'] = 'url(' . esc_url( $background_image ) . ')';
		}
		
		echo entropia_edge_dynamic_css( '.edgtf-page-footer .edgtf-footer-bottom-holder', $item_styles );
	}
	
	add_action( 'entropia_edge_action_style_dynamic', 'entropia_edge_footer_bottom_general_styles' );
}