<?php

if ( ! function_exists( 'entropia_edge_get_hide_dep_for_header_standard_meta_boxes' ) ) {
	function entropia_edge_get_hide_dep_for_header_standard_meta_boxes() {
		$hide_dep_options = apply_filters( 'entropia_edge_filter_header_standard_hide_meta_boxes', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'entropia_edge_header_standard_meta_map' ) ) {
	function entropia_edge_header_standard_meta_map( $parent ) {
		$hide_dep_options = entropia_edge_get_hide_dep_for_header_standard_meta_boxes();
		
		entropia_edge_create_meta_box_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'edgtf_set_menu_area_position_meta',
				'default_value'   => '',
				'label'           => esc_html__( 'Choose Menu Area Position', 'entropia' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'entropia' ),
				'options'         => array(
					''       => esc_html__( 'Default', 'entropia' ),
					'left'   => esc_html__( 'Left', 'entropia' ),
					'right'  => esc_html__( 'Right', 'entropia' ),
					'center' => esc_html__( 'Center', 'entropia' )
				),
				'dependency' => array(
					'hide' => array(
						'edgtf_header_type_meta'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'entropia_edge_action_additional_header_area_meta_boxes_map', 'entropia_edge_header_standard_meta_map' );
}