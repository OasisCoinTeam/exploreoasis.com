<?php

if ( ! function_exists( 'entropia_edge_search_opener_icon_size' ) ) {
	function entropia_edge_search_opener_icon_size() {
		$icon_size = entropia_edge_options()->getOptionValue( 'header_search_icon_size' );
		
		if ( ! empty( $icon_size ) ) {
			echo entropia_edge_dynamic_css( '.edgtf-search-opener', array(
				'font-size' => entropia_edge_filter_px( $icon_size ) . 'px'
			) );
		}
	}
	
	add_action( 'entropia_edge_action_style_dynamic', 'entropia_edge_search_opener_icon_size' );
}

if ( ! function_exists( 'entropia_edge_search_opener_icon_colors' ) ) {
	function entropia_edge_search_opener_icon_colors() {
		$icon_color       = entropia_edge_options()->getOptionValue( 'header_search_icon_color' );
		$icon_hover_color = entropia_edge_options()->getOptionValue( 'header_search_icon_hover_color' );
		
		if ( ! empty( $icon_color ) ) {
			echo entropia_edge_dynamic_css( '.edgtf-search-opener', array(
				'color' => $icon_color
			) );
		}
		
		if ( ! empty( $icon_hover_color ) ) {
			echo entropia_edge_dynamic_css( '.edgtf-search-opener:hover', array(
				'color' => $icon_hover_color
			) );
		}
	}
	
	add_action( 'entropia_edge_action_style_dynamic', 'entropia_edge_search_opener_icon_colors' );
}

if ( ! function_exists( 'entropia_edge_search_opener_text_styles' ) ) {
	function entropia_edge_search_opener_text_styles() {
		$item_styles = entropia_edge_get_typography_styles( 'search_icon_text' );
		
		$item_selector = array(
			'.edgtf-search-icon-text'
		);
		
		echo entropia_edge_dynamic_css( $item_selector, $item_styles );
		
		$text_hover_color = entropia_edge_options()->getOptionValue( 'search_icon_text_color_hover' );
		
		if ( ! empty( $text_hover_color ) ) {
			echo entropia_edge_dynamic_css( '.edgtf-search-opener:hover .edgtf-search-icon-text', array(
				'color' => $text_hover_color
			) );
		}
	}
	
	add_action( 'entropia_edge_action_style_dynamic', 'entropia_edge_search_opener_text_styles' );
}


if ( ! function_exists( 'entropia_edge_search_fullscreen_background_image' ) ) {
	/**
	 * Generates styles for dropdown cart
	 */
	function entropia_edge_search_fullscreen_background_image() {
		$background_image  = entropia_edge_options()->getOptionValue( 'search_background_image' );

		if ( ! empty( $background_image ) ) {
			$background_image_style = array(
				'background-image'    => 'url(' . esc_url( $background_image ) . ')'
			);
		}

		echo entropia_edge_dynamic_css( '.edgtf-fullscreen-search-holder .edgtf-fullscreen-search-table', $background_image_style );
	}

	add_action( 'entropia_edge_action_style_dynamic', 'entropia_edge_search_fullscreen_background_image' );
}