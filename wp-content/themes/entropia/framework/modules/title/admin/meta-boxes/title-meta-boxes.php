<?php

if ( ! function_exists( 'entropia_edge_get_title_types_meta_boxes' ) ) {
	function entropia_edge_get_title_types_meta_boxes() {
		$title_type_options = apply_filters( 'entropia_edge_filter_title_type_meta_boxes', $title_type_options = array( '' => esc_html__( 'Default', 'entropia' ) ) );
		
		return $title_type_options;
	}
}

foreach ( glob( EDGE_FRAMEWORK_MODULES_ROOT_DIR . '/title/types/*/admin/meta-boxes/*.php' ) as $meta_box_load ) {
	include_once $meta_box_load;
}

if ( ! function_exists( 'entropia_edge_map_title_meta' ) ) {
	function entropia_edge_map_title_meta() {
		$title_type_meta_boxes = entropia_edge_get_title_types_meta_boxes();
		
		$title_meta_box = entropia_edge_create_meta_box(
			array(
				'scope' => apply_filters( 'entropia_edge_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'title_meta' ),
				'title' => esc_html__( 'Title', 'entropia' ),
				'name'  => 'title_meta'
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_show_title_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'entropia' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'entropia' ),
				'parent'        => $title_meta_box,
				'options'       => entropia_edge_get_yes_no_select_array()
			)
		);
		
			$show_title_area_meta_container = entropia_edge_add_admin_container(
				array(
					'parent'          => $title_meta_box,
					'name'            => 'edgtf_show_title_area_meta_container',
					'dependency' => array(
						'hide' => array(
							'edgtf_show_title_area_meta' => 'no'
						)
					)
				)
			);
		
				entropia_edge_create_meta_box_field(
					array(
						'name'          => 'edgtf_title_area_type_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area Type', 'entropia' ),
						'description'   => esc_html__( 'Choose title type', 'entropia' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => $title_type_meta_boxes
					)
				);
		
				entropia_edge_create_meta_box_field(
					array(
						'name'          => 'edgtf_title_area_in_grid_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Area In Grid', 'entropia' ),
						'description'   => esc_html__( 'Set title area content to be in grid', 'entropia' ),
						'options'       => entropia_edge_get_yes_no_select_array(),
						'parent'        => $show_title_area_meta_container
					)
				);
		
				entropia_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_title_area_height_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Height', 'entropia' ),
						'description' => esc_html__( 'Set a height for Title Area', 'entropia' ),
						'parent'      => $show_title_area_meta_container,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px'
						)
					)
				);
				
				entropia_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_title_area_background_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Background Color', 'entropia' ),
						'description' => esc_html__( 'Choose a background color for title area', 'entropia' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				entropia_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_title_area_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'entropia' ),
						'description' => esc_html__( 'Choose an Image for title area', 'entropia' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
				entropia_edge_create_meta_box_field(
					array(
						'name'          => 'edgtf_title_area_background_image_behavior_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Behavior', 'entropia' ),
						'description'   => esc_html__( 'Choose title area background image behavior', 'entropia' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''                    => esc_html__( 'Default', 'entropia' ),
							'hide'                => esc_html__( 'Hide Image', 'entropia' ),
							'responsive'          => esc_html__( 'Enable Responsive Image', 'entropia' ),
							'responsive-disabled' => esc_html__( 'Disable Responsive Image', 'entropia' ),
							'parallax'            => esc_html__( 'Enable Parallax Image', 'entropia' ),
							'parallax-zoom-out'   => esc_html__( 'Enable Parallax With Zoom Out Image', 'entropia' ),
							'parallax-disabled'   => esc_html__( 'Disable Parallax Image', 'entropia' )
						)
					)
				);
				
				entropia_edge_create_meta_box_field(
					array(
						'name'          => 'edgtf_title_area_vertical_alignment_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Vertical Alignment', 'entropia' ),
						'description'   => esc_html__( 'Specify title area content vertical alignment', 'entropia' ),
						'parent'        => $show_title_area_meta_container,
						'options'       => array(
							''              => esc_html__( 'Default', 'entropia' ),
							'header-bottom' => esc_html__( 'From Bottom of Header', 'entropia' ),
							'window-top'    => esc_html__( 'From Window Top', 'entropia' )
						)
					)
				);
				
				entropia_edge_create_meta_box_field(
					array(
						'name'          => 'edgtf_title_area_title_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Title Tag', 'entropia' ),
						'options'       => entropia_edge_get_title_tag( true , array('custom-size' => esc_html__( 'Custom Size', 'entropia' ))),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				entropia_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_title_text_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Title Color', 'entropia' ),
						'description' => esc_html__( 'Choose a color for title text', 'entropia' ),
						'parent'      => $show_title_area_meta_container
					)
				);
				
				entropia_edge_create_meta_box_field(
					array(
						'name'          => 'edgtf_title_area_subtitle_meta',
						'type'          => 'text',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Text', 'entropia' ),
						'description'   => esc_html__( 'Enter your subtitle text', 'entropia' ),
						'parent'        => $show_title_area_meta_container,
						'args'          => array(
							'col_width' => 6
						)
					)
				);
		
				entropia_edge_create_meta_box_field(
					array(
						'name'          => 'edgtf_title_area_subtitle_tag_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Subtitle Tag', 'entropia' ),
						'options'       => entropia_edge_get_title_tag( true, array( 'p' => 'p' ) ),
						'parent'        => $show_title_area_meta_container
					)
				);
				
				entropia_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_subtitle_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Subtitle Color', 'entropia' ),
						'description' => esc_html__( 'Choose a color for subtitle text', 'entropia' ),
						'parent'      => $show_title_area_meta_container
					)
				);
		
		/***************** Additional Title Area Layout - start *****************/
		
		do_action( 'entropia_edge_action_additional_title_area_meta_boxes', $show_title_area_meta_container );
		
		/***************** Additional Title Area Layout - end *****************/
		
	}
	
	add_action( 'entropia_edge_action_meta_boxes_map', 'entropia_edge_map_title_meta', 60 );
}