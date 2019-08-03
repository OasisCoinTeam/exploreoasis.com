<?php

if ( ! function_exists( 'entropia_edge_logo_meta_box_map' ) ) {
	function entropia_edge_logo_meta_box_map() {
		
		$logo_meta_box = entropia_edge_create_meta_box(
			array(
				'scope' => apply_filters( 'entropia_edge_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'logo_meta' ),
				'title' => esc_html__( 'Logo', 'entropia' ),
				'name'  => 'logo_meta'
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_logo_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Default', 'entropia' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'entropia' ),
				'parent'      => $logo_meta_box
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_logo_image_dark_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Dark', 'entropia' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'entropia' ),
				'parent'      => $logo_meta_box
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_logo_image_light_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Light', 'entropia' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'entropia' ),
				'parent'      => $logo_meta_box
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_logo_image_sticky_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Sticky', 'entropia' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'entropia' ),
				'parent'      => $logo_meta_box
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_logo_image_mobile_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Logo Image - Mobile', 'entropia' ),
				'description' => esc_html__( 'Choose a default logo image to display ', 'entropia' ),
				'parent'      => $logo_meta_box
			)
		);
	}
	
	add_action( 'entropia_edge_action_meta_boxes_map', 'entropia_edge_logo_meta_box_map', 47 );
}