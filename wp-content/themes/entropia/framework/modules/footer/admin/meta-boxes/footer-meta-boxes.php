<?php

if ( ! function_exists( 'entropia_edge_map_footer_meta' ) ) {
	function entropia_edge_map_footer_meta() {
		
		$footer_meta_box = entropia_edge_create_meta_box(
			array(
				'scope' => apply_filters( 'entropia_edge_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'footer_meta' ),
				'title' => esc_html__( 'Footer', 'entropia' ),
				'name'  => 'footer_meta'
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_disable_footer_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Disable Footer for this Page', 'entropia' ),
				'description'   => esc_html__( 'Enabling this option will hide footer on this page', 'entropia' ),
				'options'       => entropia_edge_get_yes_no_select_array(),
				'parent'        => $footer_meta_box
			)
		);
		
		$show_footer_meta_container = entropia_edge_add_admin_container(
			array(
				'name'       => 'edgtf_show_footer_meta_container',
				'parent'     => $footer_meta_box,
				'dependency' => array(
					'hide' => array(
						'edgtf_disable_footer_meta' => 'yes'
					)
				)
			)
		);
		
			entropia_edge_create_meta_box_field(
				array(
					'name'          => 'edgtf_footer_in_grid_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Footer in Grid', 'entropia' ),
					'description'   => esc_html__( 'Enabling this option will place Footer content in grid', 'entropia' ),
					'options'       => entropia_edge_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
			
			entropia_edge_create_meta_box_field(
				array(
					'name'          => 'edgtf_uncovering_footer_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Uncovering Footer', 'entropia' ),
					'description'   => esc_html__( 'Enabling this option will make Footer gradually appear on scroll', 'entropia' ),
					'options'       => entropia_edge_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
		
			entropia_edge_create_meta_box_field(
				array(
					'name'          => 'edgtf_show_footer_top_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Show Footer Top', 'entropia' ),
					'description'   => esc_html__( 'Enabling this option will show Footer Top area', 'entropia' ),
					'options'       => entropia_edge_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
		
			entropia_edge_create_meta_box_field(
				array(
					'name'        => 'edgtf_footer_top_background_color_meta',
					'type'        => 'color',
					'label'       => esc_html__( 'Footer Top Background Color', 'entropia' ),
					'description' => esc_html__( 'Set background color for top footer area', 'entropia' ),
					'parent'      => $show_footer_meta_container,
					'dependency' => array(
						'show' => array(
							'edgtf_show_footer_top_meta' => array( '', 'yes' )
						)
					)
				)
			);

			entropia_edge_create_meta_box_field(
				array(
					'name'        => 'edgtf_footer_top_background_image_meta',
					'type'        => 'image',
					'label'       => esc_html__( 'Footer Top Background Image', 'entropia' ),
					'description' => esc_html__( 'Set background image for top footer area', 'entropia' ),
					'parent'      => $show_footer_meta_container,
					'dependency' => array(
						'show' => array(
							'edgtf_show_footer_top_meta' => array( '', 'yes' )
						)
					)
				)
			);
			
			entropia_edge_create_meta_box_field(
				array(
					'name'          => 'edgtf_show_footer_bottom_meta',
					'type'          => 'select',
					'default_value' => '',
					'label'         => esc_html__( 'Show Footer Bottom', 'entropia' ),
					'description'   => esc_html__( 'Enabling this option will show Footer Bottom area', 'entropia' ),
					'options'       => entropia_edge_get_yes_no_select_array(),
					'parent'        => $show_footer_meta_container
				)
			);
		
			entropia_edge_create_meta_box_field(
				array(
					'name'        => 'edgtf_footer_bottom_background_color_meta',
					'type'        => 'color',
					'label'       => esc_html__( 'Footer Bottom Background Color', 'entropia' ),
					'description' => esc_html__( 'Set background color for bottom footer area', 'entropia' ),
					'parent'      => $show_footer_meta_container,
					'dependency' => array(
						'show' => array(
							'edgtf_show_footer_bottom_meta' => array( '', 'yes' )
						)
					)
				)
			);

			entropia_edge_create_meta_box_field(
				array(
					'name'        => 'edgtf_footer_bottom_background_image_meta',
					'type'        => 'image',
					'label'       => esc_html__( 'Footer Bottom Background Image', 'entropia' ),
					'description' => esc_html__( 'Set background image for bottom footer area', 'entropia' ),
					'parent'      => $show_footer_meta_container,
					'dependency' => array(
						'show' => array(
							'edgtf_show_footer_bottom_meta' => array( '', 'yes' )
						)
					)
				)
			);
	}
	
	add_action( 'entropia_edge_action_meta_boxes_map', 'entropia_edge_map_footer_meta', 70 );
}