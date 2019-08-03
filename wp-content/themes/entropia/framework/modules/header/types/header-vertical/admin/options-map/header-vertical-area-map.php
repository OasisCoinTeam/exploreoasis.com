<?php

if ( ! function_exists( 'entropia_edge_get_hide_dep_for_header_vertical_area_options' ) ) {
	function entropia_edge_get_hide_dep_for_header_vertical_area_options() {
		$hide_dep_options = apply_filters( 'entropia_edge_filter_header_vertical_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'entropia_edge_header_vertical_options_map' ) ) {
	function entropia_edge_header_vertical_options_map( $panel_header ) {
		$hide_dep_options = entropia_edge_get_hide_dep_for_header_vertical_area_options();
		
		$vertical_area_container = entropia_edge_add_admin_container_no_style(
			array(
				'parent'          => $panel_header,
				'name'            => 'header_vertical_area_container',
				'dependency' => array(
					'hide' => array(
						'header_options'  => $hide_dep_options
					)
				)
			)
		);
		
		entropia_edge_add_admin_section_title(
			array(
				'parent' => $vertical_area_container,
				'name'   => 'menu_area_style',
				'title'  => esc_html__( 'Vertical Area Style', 'entropia' )
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'name'        => 'vertical_header_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'entropia' ),
				'description' => esc_html__( 'Set background color for vertical menu', 'entropia' ),
				'parent'      => $vertical_area_container
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'name'          => 'vertical_header_background_image',
				'type'          => 'image',
				'default_value' => '',
				'label'         => esc_html__( 'Background Image', 'entropia' ),
				'description'   => esc_html__( 'Set background image for vertical menu', 'entropia' ),
				'parent'        => $vertical_area_container
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'parent'        => $vertical_area_container,
				'type'          => 'yesno',
				'name'          => 'vertical_header_shadow',
				'default_value' => 'no',
				'label'         => esc_html__( 'Shadow', 'entropia' ),
				'description'   => esc_html__( 'Set shadow on vertical header', 'entropia' ),
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'parent'        => $vertical_area_container,
				'type'          => 'yesno',
				'name'          => 'vertical_header_border',
				'default_value' => 'no',
				'label'         => esc_html__( 'Vertical Area Border', 'entropia' ),
				'description'   => esc_html__( 'Set border on vertical area', 'entropia' )
			)
		);
		
		$vertical_header_shadow_border_container = entropia_edge_add_admin_container(
			array(
				'parent'          => $vertical_area_container,
				'name'            => 'vertical_header_shadow_border_container',
				'dependency' => array(
					'hide' => array(
						'vertical_header_border'  => 'no'
					)
				)
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'parent'        => $vertical_header_shadow_border_container,
				'type'          => 'color',
				'name'          => 'vertical_header_border_color',
				'default_value' => '',
				'label'         => esc_html__( 'Border Color', 'entropia' ),
				'description'   => esc_html__( 'Set border color for vertical area', 'entropia' ),
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'parent'        => $vertical_area_container,
				'type'          => 'yesno',
				'name'          => 'vertical_header_center_content',
				'default_value' => 'no',
				'label'         => esc_html__( 'Center Content', 'entropia' ),
				'description'   => esc_html__( 'Set content in vertical center', 'entropia' ),
			)
		);
		
		do_action( 'entropia_edge_header_vertical_area_additional_options', $panel_header );
	}
	
	add_action( 'entropia_edge_action_additional_header_menu_area_options_map', 'entropia_edge_header_vertical_options_map' );
}