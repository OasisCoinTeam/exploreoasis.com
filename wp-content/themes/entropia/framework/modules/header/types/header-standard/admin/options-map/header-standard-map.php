<?php

if ( ! function_exists( 'entropia_edge_get_hide_dep_for_header_standard_options' ) ) {
	function entropia_edge_get_hide_dep_for_header_standard_options() {
		$hide_dep_options = apply_filters( 'entropia_edge_filter_header_standard_hide_global_option', $hide_dep_options = array() );
		
		return $hide_dep_options;
	}
}

if ( ! function_exists( 'entropia_edge_header_standard_map' ) ) {
	function entropia_edge_header_standard_map( $parent ) {
		$hide_dep_options = entropia_edge_get_hide_dep_for_header_standard_options();
		
		entropia_edge_add_admin_field(
			array(
				'parent'          => $parent,
				'type'            => 'select',
				'name'            => 'set_menu_area_position',
				'default_value'   => 'right',
				'label'           => esc_html__( 'Choose Menu Area Position', 'entropia' ),
				'description'     => esc_html__( 'Select menu area position in your header', 'entropia' ),
				'options'         => array(
					'right'  => esc_html__( 'Right', 'entropia' ),
					'left'   => esc_html__( 'Left', 'entropia' ),
					'center' => esc_html__( 'Center', 'entropia' )
				),
				'dependency' => array(
					'hide' => array(
						'header_options'  => $hide_dep_options
					)
				)
			)
		);
	}
	
	add_action( 'entropia_edge_action_additional_header_menu_area_options_map', 'entropia_edge_header_standard_map' );
}