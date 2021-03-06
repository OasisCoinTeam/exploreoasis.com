<?php

if ( ! function_exists( 'entropia_edge_include_mobile_header_menu' ) ) {
	function entropia_edge_include_mobile_header_menu( $menus ) {
		$menus['mobile-navigation'] = esc_html__( 'Mobile Navigation', 'entropia' );
		
		return $menus;
	}
	
	add_filter( 'entropia_edge_filter_register_headers_menu', 'entropia_edge_include_mobile_header_menu' );
}

if ( ! function_exists( 'entropia_edge_register_mobile_header_areas' ) ) {
	/**
	 * Registers widget areas for mobile header
	 */
	function entropia_edge_register_mobile_header_areas() {
		if ( entropia_edge_is_responsive_on() ) {
			register_sidebar(
				array(
					'id'            => 'edgtf-right-from-mobile-logo',
					'name'          => esc_html__( 'Mobile Header Widget Area', 'entropia' ),
					'description'   => esc_html__( 'Widgets added here will appear on the right hand side from the mobile logo on mobile header', 'entropia' ),
					'before_widget' => '<div id="%1$s" class="widget %2$s edgtf-right-from-mobile-logo">',
					'after_widget'  => '</div>'
				)
			);
		}
	}
	
	add_action( 'widgets_init', 'entropia_edge_register_mobile_header_areas' );
}

if ( ! function_exists( 'entropia_edge_mobile_header_class' ) ) {
	function entropia_edge_mobile_header_class( $classes ) {
		$classes[] = 'edgtf-default-mobile-header';
		
		$classes[] = 'edgtf-sticky-up-mobile-header';
		
		return $classes;
	}
	
	add_filter( 'body_class', 'entropia_edge_mobile_header_class' );
}

if ( ! function_exists( 'entropia_edge_get_mobile_header' ) ) {
	/**
	 * Loads mobile header HTML only if responsiveness is enabled
	 */
	function entropia_edge_get_mobile_header( $slug = '', $module = '' ) {
		if ( entropia_edge_is_responsive_on() ) {
			$mobile_menu_title = entropia_edge_options()->getOptionValue( 'mobile_menu_title' );
			$has_navigation    = has_nav_menu( 'main-navigation' ) || has_nav_menu( 'mobile-navigation' ) ? true : false;
			
			$parameters = array(
				'show_navigation_opener' => $has_navigation,
				'mobile_menu_title'      => $mobile_menu_title,
				'mobile_icon_class'		 => entropia_edge_get_mobile_navigation_icon_class()
			);

            $module = apply_filters('entropia_edge_filter_mobile_menu_module', 'header/types/mobile-header');
            $slug = apply_filters('entropia_edge_filter_mobile_menu_slug', '');
            $parameters = apply_filters('entropia_edge_filter_mobile_menu_parameters', $parameters);

            entropia_edge_get_module_template_part( 'templates/mobile-header', $module, $slug, $parameters );
		}
	}
	
	add_action( 'entropia_edge_action_after_wrapper_inner', 'entropia_edge_get_mobile_header', 20 );
}

if ( ! function_exists( 'entropia_edge_get_mobile_logo' ) ) {
	/**
	 * Loads mobile logo HTML. It checks if mobile logo image is set and uses that, else takes normal logo image
	 */
	function entropia_edge_get_mobile_logo() {
		$show_logo_image = entropia_edge_options()->getOptionValue( 'hide_logo' ) === 'yes' ? false : true;
		
		if ( $show_logo_image ) {
			$page_id       = entropia_edge_get_page_id();
			$header_height = entropia_edge_set_default_mobile_menu_height_for_header_types();
			
			$mobile_logo_image = entropia_edge_get_meta_field_intersect( 'logo_image_mobile', $page_id );
			
			//check if mobile logo has been set and use that, else use normal logo
			$logo_image = ! empty( $mobile_logo_image ) ? $mobile_logo_image : entropia_edge_get_meta_field_intersect( 'logo_image', $page_id );
			
			//get logo image dimensions and set style attribute for image link.
			$logo_dimensions = entropia_edge_get_image_dimensions( $logo_image );
			
			$logo_styles = '';
			if ( is_array( $logo_dimensions ) && array_key_exists( 'height', $logo_dimensions ) ) {
				$logo_height = $logo_dimensions['height'];
				$logo_styles = 'height: ' . intval( $logo_height / 2 ) . 'px'; //divided with 2 because of retina screens
			} else if ( ! empty( $header_height ) && empty( $logo_dimensions ) ) {
				$logo_styles = 'height: ' . intval( $header_height / 2 ) . 'px;'; //divided with 2 because of retina screens
			}
			
			//set parameters for logo
			$parameters = array(
				'logo_image'      => $logo_image,
				'logo_dimensions' => $logo_dimensions,
				'logo_styles'     => $logo_styles
			);
			
			entropia_edge_get_module_template_part( 'templates/mobile-logo', 'header/types/mobile-header', '', $parameters );
		}
	}
}

if ( ! function_exists( 'entropia_edge_get_mobile_nav' ) ) {
	/**
	 * Loads mobile navigation HTML
	 */
	function entropia_edge_get_mobile_nav() {
		entropia_edge_get_module_template_part( 'templates/mobile-navigation', 'header/types/mobile-header' );
	}
}

if ( ! function_exists( 'entropia_edge_mobile_header_per_page_js_var' ) ) {
    function entropia_edge_mobile_header_per_page_js_var( $perPageVars ) {
        $perPageVars['edgtfMobileHeaderHeight'] = entropia_edge_set_default_mobile_menu_height_for_header_types();

        return $perPageVars;
    }

    add_filter( 'entropia_edge_filter_per_page_js_vars', 'entropia_edge_mobile_header_per_page_js_var' );
}

if ( ! function_exists( 'entropia_edge_get_mobile_navigation_icon_class' ) ) {
	/**
	 * Loads mobile navigation icon class
	 */
	function entropia_edge_get_mobile_navigation_icon_class() {
		$classes = array(
			'edgtf-mobile-menu-opener'
		);
		
		$classes[] = entropia_edge_get_icon_sources_class( 'mobile_icon', 'edgtf-mobile-menu-opener' );

		return $classes;
	}
}