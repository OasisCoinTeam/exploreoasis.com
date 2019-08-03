<?php

if ( ! function_exists( 'entropia_edge_sticky_header_styles' ) ) {
	/**
	 * Generates styles for sticky haeder
	 */
	function entropia_edge_sticky_header_styles() {
		$background_color        = entropia_edge_options()->getOptionValue( 'sticky_header_background_color' );
		$background_transparency = entropia_edge_options()->getOptionValue( 'sticky_header_transparency' );
		$border_color            = entropia_edge_options()->getOptionValue( 'sticky_header_border_color' );
		$header_height           = entropia_edge_options()->getOptionValue( 'sticky_header_height' );
		
		if ( ! empty( $background_color ) ) {
			$header_background_color              = $background_color;
			$header_background_color_transparency = 1;
			
			if ( $background_transparency !== '' ) {
				$header_background_color_transparency = $background_transparency;
			}
			
			echo entropia_edge_dynamic_css( '.edgtf-page-header .edgtf-sticky-header .edgtf-sticky-holder', array( 'background-color' => entropia_edge_rgba_color( $header_background_color, $header_background_color_transparency ) ) );
		}
		
		if ( ! empty( $border_color ) ) {
			echo entropia_edge_dynamic_css( '.edgtf-page-header .edgtf-sticky-header .edgtf-sticky-holder', array( 'border-color' => $border_color ) );
		}
		
		if ( ! empty( $header_height ) ) {
			$height = entropia_edge_filter_px( $header_height ) . 'px';
			
			echo entropia_edge_dynamic_css( '.edgtf-page-header .edgtf-sticky-header', array( 'height' => $height ) );
			echo entropia_edge_dynamic_css( '.edgtf-page-header .edgtf-sticky-header .edgtf-logo-wrapper a', array( 'max-height' => $height ) );
		}
		
		$sticky_container_selector = '.edgtf-sticky-header .edgtf-sticky-holder .edgtf-vertical-align-containers';
		$sticky_container_styles   = array();
		$container_side_padding    = entropia_edge_options()->getOptionValue( 'sticky_header_side_padding' );
		
		if ( $container_side_padding !== '' ) {
			if ( entropia_edge_string_ends_with( $container_side_padding, 'px' ) || entropia_edge_string_ends_with( $container_side_padding, '%' ) ) {
				$sticky_container_styles['padding-left']  = $container_side_padding;
				$sticky_container_styles['padding-right'] = $container_side_padding;
			} else {
				$sticky_container_styles['padding-left']  = entropia_edge_filter_px( $container_side_padding ) . 'px';
				$sticky_container_styles['padding-right'] = entropia_edge_filter_px( $container_side_padding ) . 'px';
			}
			
			echo entropia_edge_dynamic_css( $sticky_container_selector, $sticky_container_styles );
		}
		
		// sticky menu style
		
		$menu_item_styles = entropia_edge_get_typography_styles( 'sticky' );
		
		$menu_item_selector = array(
			'.edgtf-main-menu.edgtf-sticky-nav > ul > li > a'
		);
		
		echo entropia_edge_dynamic_css( $menu_item_selector, $menu_item_styles );
		
		
		$hover_color = entropia_edge_options()->getOptionValue( 'sticky_hovercolor' );
		
		$menu_item_hover_styles = array();
		if ( ! empty( $hover_color ) ) {
			$menu_item_hover_styles['color'] = $hover_color;
		}
		
		$menu_item_hover_selector = array(
			'.edgtf-main-menu.edgtf-sticky-nav > ul > li:hover > a',
			'.edgtf-main-menu.edgtf-sticky-nav > ul > li.edgtf-active-item > a'
		);
		
		echo entropia_edge_dynamic_css( $menu_item_hover_selector, $menu_item_hover_styles );
	}
	
	add_action( 'entropia_edge_action_style_dynamic', 'entropia_edge_sticky_header_styles' );
}