<?php

if ( ! function_exists( 'entropia_edge_get_skewed_section_vc' ) ) {
	/**
	 * Loads Visual Composer Params
	 */
	function entropia_edge_get_skewed_section_vc() {

		vc_add_param( 'vc_row', array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Edge Skewed Section Effect on Row', 'entropia' ),
			'param_name' => 'enable_skewed_section_effect',
			'value'      => array(
				esc_html__( 'Disabled', 'entropia' )  => 'no',
				esc_html__( 'Enabled', 'entropia' ) => 'yes'
			),
			'group'      => esc_html__( 'Edge Settings', 'entropia' )
		) );

		vc_add_param( 'vc_row', array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Edge Skewed Section Effect Top', 'entropia' ),
			'param_name' => 'skewed_section_effect_top',
			'value'      => array(
				esc_html__( 'Disabled', 'entropia' )  => 'no',
				esc_html__( 'Enabled', 'entropia' ) => 'yes'
			),
			'dependency' => array( 'element' => 'enable_skewed_section_effect', 'value' => array( 'yes' ) ),
			'group'      => esc_html__( 'Edge Settings', 'entropia' )
		) );

		vc_add_param( 'vc_row', array(
			'type'       => 'dropdown',
			'heading'    => esc_html__( 'Edge Skewed Section Effect Bottom', 'entropia' ),
			'param_name' => 'skewed_section_effect_bottom',
			'value'      => array(
				esc_html__( 'Disabled', 'entropia' )  => 'no',
				esc_html__( 'Enabled', 'entropia' ) => 'yes'
			),
			'dependency' => array( 'element' => 'enable_skewed_section_effect', 'value' => array( 'yes' ) ),
			'group'      => esc_html__( 'Edge Settings', 'entropia' )
		) );
	}

	add_action( 'entropia_edge_additional_vc_row_params', 'entropia_edge_get_skewed_section_vc' );
}

if ( ! function_exists( 'entropia_edge_skewed_section_on_vc_row_top' ) ) {
	/**
	 * Loads html for skew section on top of the vc row
	 *
	 * @param $html
	 * @param $atts
	 *
	 * @return mixed
	 */
	function entropia_edge_skewed_section_on_vc_row_top( $html, $atts ) {

		$params = array();


		if ( isSet( $atts['enable_skewed_section_effect'] ) && $atts['enable_skewed_section_effect'] == 'yes' && isSet( $atts['skewed_section_effect_top'] ) && $atts['skewed_section_effect_top'] == 'yes' ) {

			// add additional class
			$params['additional_class'] = 'edgtf-top-skewed-section-effect';

			// get style for skewed section
			$skewed_section_effect_style = array();
			if ( isSet( $atts['simple_background_color'] ) && $atts['simple_background_color'] != "" ) {
				$skewed_section_effect_style[] = 'color: ' . $atts['simple_background_color'];
			}
			$params['skewed_section_effect_style'] = implode( ';', $skewed_section_effect_style );

			// get svg code
			$params['skewed_section_svg'] = entropia_edge_skewed_section_default_svg();
			if ( entropia_edge_options()->getOptionValue( 'skewed_section_row_top_svg_path' ) !== '' ) {
				$params['skewed_section_svg'] = entropia_edge_options()->getOptionValue( 'skewed_section_row_top_svg_path' );
			}

			$html .= entropia_edge_get_html_module_template_part( 'templates/skewed-section-template', 'skewed-section', '', $params );

		}

		return $html;

	}

	add_filter( 'entropia_edge_vc_after_wrapper_open', 'entropia_edge_skewed_section_on_vc_row_top', 10, 2 );
}


if ( ! function_exists( 'entropia_edge_skewed_section_on_vc_row_bottom' ) ) {
	/**
	 * Loads html for skew section on bottom of the vc row
	 *
	 * @param $html
	 * @param $atts
	 *
	 * @return mixed
	 */
	function entropia_edge_skewed_section_on_vc_row_bottom( $html, $atts ) {

		if ( isSet( $atts['enable_skewed_section_effect'] ) && $atts['enable_skewed_section_effect'] == 'yes' && isSet( $atts['skewed_section_effect_bottom'] ) && $atts['skewed_section_effect_bottom'] == 'yes' ) {

			// add additional class
			$params['additional_class'] = 'edgtf-bottom-skewed-section-effect';

			// get style for skewed section
			$skewed_section_effect_style = array();
			if ( isSet( $atts['simple_background_color'] ) && $atts['simple_background_color'] != "" ) {
				$skewed_section_effect_style[] = 'color: ' . $atts['simple_background_color'];
			}
			$params['skewed_section_effect_style'] = implode( ';', $skewed_section_effect_style );

			// get svg code
			$params['skewed_section_svg'] = entropia_edge_skewed_section_default_svg();
			if ( entropia_edge_options()->getOptionValue( 'skewed_section_row_bottom_svg_path' ) !== '' ) {
				$params['skewed_section_svg'] = entropia_edge_options()->getOptionValue( 'skewed_section_row_bottom_svg_path' );
			}


			$html .= entropia_edge_get_html_module_template_part( 'templates/skewed-section-template', 'skewed-section', '', $params );

		}

		return $html;

	}

	add_filter( 'entropia_edge_vc_after_wrapper_open', 'entropia_edge_skewed_section_on_vc_row_bottom', 10, 2 );
}


if ( ! function_exists( 'entropia_edge_skewed_section_on_title' ) ) {
	/**
	 * Print html for skew section on title area
	 *
	 * @return mixed
	 */
	function entropia_edge_skewed_section_on_title() {

		$id                   = entropia_edge_get_page_id();
		$title_skewed_section = entropia_edge_get_meta_field_intersect( 'enable_skewed_section_on_title_area', $id );

		if ( $title_skewed_section == 'yes' ) {

			$params = array();

			// add additional class
			$params['additional_class'] = 'edgtf-title-skewed-section-effect';

			// inset or outline class - only for title
			if ( entropia_edge_get_meta_field_intersect( 'title_area_skewed_section_type', $id ) == 'inset' ) {
				$params['additional_class'] .= ' edgtf-title-inset-section-effect';
			}

			// get style for skewed section
			$skewed_section_effect_style = array();
			$title_skewed_section_color  = entropia_edge_get_meta_field_intersect( 'title_area_skewed_section_svg_color', $id );
			if ( $title_skewed_section_color !== "" ) {
				$skewed_section_effect_style[] = 'color: ' . $title_skewed_section_color;
			}
			$params['skewed_section_effect_style'] = implode( ';', $skewed_section_effect_style );

			// get svg code
			$params['skewed_section_svg'] = entropia_edge_skewed_section_default_svg();
			$title_skewed_section_svg     = entropia_edge_options()->getOptionValue( 'title_area_skewed_section_svg_path' );
			if ( $title_skewed_section_svg !== '' ) {
				$params['skewed_section_svg'] = $title_skewed_section_svg;
			}

			entropia_edge_get_module_template_part( 'templates/skewed-section-template', 'skewed-section', '', $params );

		}

	}

	add_action( 'entropia_edge_action_after_page_title', 'entropia_edge_skewed_section_on_title' );
}


if ( ! function_exists( 'entropia_edge_skewed_section_on_header' ) ) {
	/**
	 * Print html for skew section on title area
	 *
	 * @return mixed
	 */
	function entropia_edge_skewed_section_on_header() {

		$id                    = entropia_edge_get_page_id();
		$header_skewed_section = entropia_edge_get_meta_field_intersect( 'enable_skewed_section_on_header_area', $id );

		if ( $header_skewed_section == 'yes' ) {

			$params = array();

			// add additional class
			$params['additional_class'] = 'edgtf-header-skewed-section-effect';

			// get style for skewed section
			$skewed_section_effect_style = array();
			$header_skewed_section_color = entropia_edge_get_meta_field_intersect( 'header_area_skewed_section_svg_color', $id );
			if ( $header_skewed_section_color !== "" ) {
				$skewed_section_effect_style[] = 'color: ' . $header_skewed_section_color;
			}
			$params['skewed_section_effect_style'] = implode( ';', $skewed_section_effect_style );

			// get svg code
			$params['skewed_section_svg'] = entropia_edge_skewed_section_default_svg();
			$header_skewed_section_svg    = entropia_edge_options()->getOptionValue( 'header_area_skewed_section_svg_path' );
			if ( $header_skewed_section_svg !== '' ) {
				$params['skewed_section_svg'] = $header_skewed_section_svg;
			}

			entropia_edge_get_module_template_part( 'templates/skewed-section-template', 'skewed-section', '', $params );

		}

	}

	add_action( 'entropia_edge_action_before_mobile_header_html_close', 'entropia_edge_skewed_section_on_header' );
	add_action( 'entropia_edge_action_before_page_header_html_close', 'entropia_edge_skewed_section_on_header' );
}


