<?php

if (!function_exists('entropia_edge_include_title_types_before_load')) {
    /**
     * Load's all title types before load files by going through all folders that are placed directly in title types folder.
     * Functions from this files before-load are used to set all hooks and variables before global options map are init
     */
    function entropia_edge_include_title_types_before_load() {
        foreach (glob(EDGE_FRAMEWORK_MODULES_ROOT_DIR . '/title/types/*/before-load.php') as $module_load) {
            include_once $module_load;
        }
    }

    add_action('entropia_edge_action_options_map', 'entropia_edge_include_title_types_before_load', 1); // 1 is set to just be before title option map init
}

if ( ! function_exists( 'entropia_edge_include_title_types' ) ) {
	/**
	 * Load's all title types by going through all folders that are placed directly in title types folder
	 */
	function entropia_edge_include_title_types() {
		foreach ( glob( EDGE_FRAMEWORK_MODULES_ROOT_DIR . '/title/types/*/load.php' ) as $module_load ) {
			include_once $module_load;
		}
	}
	
	add_action('entropia_edge_action_options_map', 'entropia_edge_include_title_types', 1); // 1 is set to just be before title option map init
}

if ( ! function_exists( 'entropia_edge_get_title' ) ) {
	/**
	 * Loads title area template
	 */
	function entropia_edge_get_title() {
		$page_id              = entropia_edge_get_page_id();
		$show_title_area_meta = entropia_edge_get_meta_field_intersect( 'show_title_area', $page_id ) == 'yes' ? true : false;
		$show_title_area      = apply_filters( 'entropia_edge_filter_show_title_area', $show_title_area_meta );
		
		if ( $show_title_area ) {
			$type_meta     = entropia_edge_get_meta_field_intersect( 'title_area_type', $page_id );
			$type          = ! empty( $type_meta ) ? $type_meta : 'standard';
			$template_path = apply_filters( 'entropia_edge_filter_title_template_path', $template_path = 'types/' . $type . '/templates/' . $type . '-title' );
			$module        = apply_filters( 'entropia_edge_filter_title_module', $module = 'title' );
			$layout        = apply_filters( 'entropia_edge_filter_title_layout', $layout = '' );
			
			$title_tag_meta = entropia_edge_get_meta_field_intersect( 'title_area_title_tag', $page_id );
			$title_tag      = (! empty( $title_tag_meta ) && $title_tag_meta !== 'custom-size') ? $title_tag_meta : 'h1';
			
			$subtitle_tag_meta = entropia_edge_get_meta_field_intersect( 'title_area_subtitle_tag', $page_id );
			$subtitle_tag      = ! empty( $subtitle_tag_meta ) ? $subtitle_tag_meta : 'h6';
			
			$parameters = array(
				'holder_classes'  => entropia_edge_get_title_holder_classes(),
				'holder_styles'   => entropia_edge_get_title_holder_styles(),
				'holder_data'     => entropia_edge_get_title_holder_data(),
				'wrapper_styles'  => entropia_edge_get_title_wrapper_styles(),
				'title_image'     => entropia_edge_get_title_background_image(),
				'title'           => entropia_edge_get_title_text(),
				'title_tag'       => $title_tag,
				'title_styles'    => entropia_edge_get_title_styles(),
				'subtitle'        => entropia_edge_subtitle_text(),
				'subtitle_tag'    => $subtitle_tag,
				'subtitle_styles' => entropia_edge_get_subtitle_styles(),
			);
			$parameters = apply_filters( 'entropia_edge_filter_title_area_params', $parameters );
			
			entropia_edge_get_module_template_part( $template_path, $module, $layout, $parameters );
		}
	}
}

if ( ! function_exists( 'entropia_edge_get_title_holder_classes' ) ) {
	/**
	 * Function that adds classes to title holder div
	 */
	function entropia_edge_get_title_holder_classes() {
		$page_id            = entropia_edge_get_page_id();
		$title_type_meta    = entropia_edge_get_meta_field_intersect( 'title_area_type', $page_id );
		$title_type         = ! empty( $title_type_meta ) ? $title_type_meta : 'standard';
		$title_in_grid_meta = entropia_edge_get_meta_field_intersect( 'title_area_in_grid', $page_id );
		$title_img          = entropia_edge_get_meta_field_intersect( 'title_area_background_image', $page_id );
		$title_img_behavior = entropia_edge_get_meta_field_intersect( 'title_area_background_image_behavior', $page_id );
		$title_vertical_alignment = entropia_edge_get_meta_field_intersect( 'title_area_vertical_alignment', $page_id );
		$title_tag_meta = entropia_edge_get_meta_field_intersect( 'title_area_title_tag', $page_id );
		
		$classes = array();
		
		$classes[] = 'edgtf-' . $title_type . '-type';
		
		if ( $title_in_grid_meta === 'no' ) {
			$classes[] = 'edgtf-title-full-width';
		}
		
		if ( ! empty( $title_vertical_alignment ) ) {
			$classes[] = 'edgtf-title-va-' . $title_vertical_alignment;
		}
		
		if ( ! empty( $title_img ) && $title_img_behavior !== 'hide' ) {
			$classes[] = 'edgtf-preload-background';
			$classes[] = 'edgtf-has-bg-image';
			
			if ( ! empty( $title_img_behavior ) ) {
				$classes[] = 'edgtf-bg-' . $title_img_behavior;
			}
			
			if ( $title_img_behavior === 'parallax-zoom-out' ) {
				$classes[] = 'edgtf-bg-parallax';
			}
		}

		if ( ! empty( $title_tag_meta ) && $title_tag_meta === 'custom-size' ) {
			$classes[] = 'edgtf-title-custom-size';
		}
		
		return implode( ' ', apply_filters( 'entropia_edge_filter_title_holder_classes', $classes ) );
	}
}

if ( ! function_exists( 'entropia_edge_get_title_holder_styles' ) ) {
	/**
	 * Function that adds inline styles to title holder div
	 */
	function entropia_edge_get_title_holder_styles() {
		$page_id              = entropia_edge_get_page_id();
		$title_height         = entropia_edge_get_title_area_height();
		$title_bg_color       = entropia_edge_get_meta_field_intersect( 'title_area_background_color', $page_id );
		$title_image          = entropia_edge_get_meta_field_intersect( 'title_area_background_image', $page_id );
		$title_image_behavior = entropia_edge_get_meta_field_intersect( 'title_area_background_image_behavior', $page_id );
		
		$styles = array();
		
		if ( ! empty( $title_height ) ) {
			$styles[] = 'height: ' . $title_height . 'px';
		}
		
		if ( ! empty( $title_bg_color ) ) {
			$styles[] = 'background-color: ' . $title_bg_color;
		}
		
		if ( ! empty( $title_image ) && $title_image_behavior !== 'hide' ) {
			$styles[] = 'background-image:url(' . esc_url( $title_image ) . ');';
		}
		
		return implode( ';', $styles );
	}
}

if ( ! function_exists( 'entropia_edge_get_title_holder_data' ) ) {
	/**
	 * Function that adds data attributes to title holder div
	 */
	function entropia_edge_get_title_holder_data() {
		$page_id            = entropia_edge_get_page_id();
		$title_height       = entropia_edge_get_title_area_height();
		$title_img          = entropia_edge_get_meta_field_intersect( 'title_area_background_image', $page_id );
		$title_img_behavior = entropia_edge_get_meta_field_intersect( 'title_area_background_image_behavior', $page_id );
		
		$data = array();
		
		if ( ! empty( $title_height ) ) {
			$data['data-height'] = $title_height;
		}
		
		if ( ! empty( $title_img ) && $title_img_behavior === 'parallax-zoom-out' ) {
			$attachment_dimensions = entropia_edge_get_image_dimensions( $title_img );
			
			if ( ! empty( $attachment_dimensions['width'] ) ) {
				$data['data-background-width'] = esc_attr( $attachment_dimensions['width'] );
			}
		}
		
		return apply_filters( 'entropia_edge_filter_title_holder_data', $data );
	}
}

if ( ! function_exists( 'entropia_edge_get_title_wrapper_styles' ) ) {
	/**
	 * Function that adds inline styles to title wrapper div
	 */
	function entropia_edge_get_title_wrapper_styles() {
		$page_id                  = entropia_edge_get_page_id();
		$title_height             = entropia_edge_get_title_area_height();
		$title_content_padding    = entropia_edge_get_title_content_padding();
		$title_img_behavior       = entropia_edge_get_meta_field_intersect( 'title_area_background_image_behavior', $page_id );
		$title_vertical_alignment = entropia_edge_get_meta_field_intersect( 'title_area_vertical_alignment', $page_id );
		
		$styles = array();
		
		if ( $title_vertical_alignment === 'header-bottom' ) {
			
			if ( $title_img_behavior !== 'responsive' ) {
				
				if ( ! empty( $title_content_padding ) ) {
					$styles[] = 'height: ' . ( $title_height - $title_content_padding ) . 'px';
				} else {
					$styles[] = 'height: ' . $title_height . 'px';
				}
			}
			
			if ( ! empty( $title_content_padding ) ) {
				$styles[] = 'padding-top: ' . $title_content_padding . 'px';
			}
		}
		
		return implode( ';', $styles );
	}
}

if ( ! function_exists( 'entropia_edge_get_title_background_image' ) ) {
	/**
	 * Function that return background image data if background image is set
	 */
	function entropia_edge_get_title_background_image() {
		$page_id            = entropia_edge_get_page_id();
		$title_img          = entropia_edge_get_meta_field_intersect( 'title_area_background_image', $page_id );
		$title_img_behavior = entropia_edge_get_meta_field_intersect( 'title_area_background_image_behavior', $page_id );
		
		$image = array();
		
		if ( ! empty( $title_img ) && $title_img_behavior !== 'hide' ) {
			$image_id = entropia_edge_get_attachment_id_from_url( $title_img );
			$alt      = ! empty( $image_id ) ? get_post_meta( $image_id, '_wp_attachment_image_alt', true ) : '';
			
			$image['src'] = $title_img;
			$image['alt'] = ! empty( $alt ) ? esc_html( $alt ) : esc_html__( 'Image Alt', 'entropia' );
		}
		
		return $image;
	}
}

if ( ! function_exists( 'entropia_edge_get_title_area_height' ) ) {
	/**
	 * Function that returns title area height
	 **/
	function entropia_edge_get_title_area_height() {
		$page_id           = entropia_edge_get_page_id();
		$title_height_meta = entropia_edge_get_meta_field_intersect( 'title_area_height', $page_id );
		$title_height      = ! empty( $title_height_meta ) ? intval( $title_height_meta ) : apply_filters( 'entropia_edge_filter_title_area_default_height_value', 370 );
		
		return apply_filters( 'entropia_edge_filter_title_area_height', $title_height );
	}
}

if ( ! function_exists( 'entropia_edge_get_title_content_padding' ) ) {
	/**
	 * Function that returns title content padding
	 **/
	function entropia_edge_get_title_content_padding() {
		$title_content_padding = apply_filters( 'entropia_edge_filter_title_content_padding', 0 );
		
		return intval( $title_content_padding );
	}
}

if ( ! function_exists( 'entropia_edge_get_title_text' ) ) {
	/**
	 * Function that returns current page title text
	 */
	function entropia_edge_get_title_text() {
		$page_id = entropia_edge_get_page_id();
		$title   = get_the_title( $page_id );
		
		if ( ( is_home() && is_front_page() ) || is_singular( 'post' ) ) {
			$title = get_option( 'blogname' );
		} elseif ( is_tag() ) {
			$title = single_term_title( '', false ) . esc_html__( ' Tag', 'entropia' );
		} elseif ( is_date() ) {
			$title = get_the_time( 'F Y' );
		} elseif ( is_author() ) {
			$title = esc_html__( 'Author:', 'entropia' ) . " " . get_the_author();
		} elseif ( is_category() ) {
			$title = single_cat_title( '', false );
		} elseif ( is_archive() ) {
			$title = esc_html__( 'Archive', 'entropia' );
		} elseif ( is_search() ) {
			$title = esc_html__( 'Search results for: ', 'entropia' ) . get_search_query();
		} elseif ( is_404() ) {
			$title_404 = entropia_edge_options()->getOptionValue( '404_title' );
			$title     = ! empty( $title_404 ) ? $title_404 : esc_html__( '404 - Page not found', 'entropia' );
		}
		
		return apply_filters( 'entropia_edge_filter_title_text', $title );
	}
}

if ( ! function_exists( 'entropia_edge_get_title_styles' ) ) {
	/**
	 * Function that adds inline styles to page title
	 */
	function entropia_edge_get_title_styles() {
		$page_id = entropia_edge_get_page_id();
		$color   = get_post_meta( $page_id, 'edgtf_title_text_color_meta', true );
		
		$styles = array();
		
		if ( ! empty( $color ) ) {
			$styles[] = 'color: ' . esc_attr( $color );
		}
		
		return implode( ';', $styles );
	}
}

if ( ! function_exists( 'entropia_edge_subtitle_text' ) ) {
	/**
	 * Function that echoes subtitle text.
	 */
	function entropia_edge_subtitle_text() {
		$page_id       = entropia_edge_get_page_id();
		$subtitle_meta = get_post_meta( $page_id, 'edgtf_title_area_subtitle_meta', true );
		$subtitle      = ! empty( $subtitle_meta ) ? $subtitle_meta : '';
		
		return apply_filters( 'entropia_edge_filter_subtitle_title_text', $subtitle );
	}
}

if ( ! function_exists( 'entropia_edge_get_subtitle_styles' ) ) {
	/**
	 * Function that adds inline styles to page subtitle
	 */
	function entropia_edge_get_subtitle_styles() {
		$page_id      = entropia_edge_get_page_id();
		$color        = get_post_meta( $page_id, 'edgtf_subtitle_color_meta', true );
		$side_padding = get_post_meta( $page_id, 'edgtf_subtitle_side_padding_meta', true );
		
		$styles = array();
		
		if ( ! empty( $color ) ) {
			$styles[] = 'color: ' . $color;
		}
		
		if ( $side_padding !== '' ) {
			if ( entropia_edge_string_ends_with( $side_padding, '%' ) || entropia_edge_string_ends_with( $side_padding, 'px' ) ) {
				$styles[] = 'padding: 0 ' . $side_padding;
			} else {
				$styles[] = 'padding: 0 ' . intval( $side_padding ) . 'px';
			}
		}
		
		return implode( ';', $styles );
	}
}