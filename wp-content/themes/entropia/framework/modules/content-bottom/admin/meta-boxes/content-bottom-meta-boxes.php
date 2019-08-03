<?php

if ( ! function_exists( 'entropia_edge_map_content_bottom_meta' ) ) {
	function entropia_edge_map_content_bottom_meta() {
		
		$content_bottom_meta_box = entropia_edge_create_meta_box(
			array(
				'scope' => apply_filters( 'entropia_edge_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'content_bottom_meta' ),
				'title' => esc_html__( 'Content Bottom', 'entropia' ),
				'name'  => 'content_bottom_meta'
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_enable_content_bottom_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Enable Content Bottom Area', 'entropia' ),
				'description'   => esc_html__( 'This option will enable Content Bottom area on pages', 'entropia' ),
				'parent'        => $content_bottom_meta_box,
				'options'       => entropia_edge_get_yes_no_select_array()
			)
		);
		
		$show_content_bottom_meta_container = entropia_edge_add_admin_container(
			array(
				'parent'          => $content_bottom_meta_box,
				'name'            => 'edgtf_show_content_bottom_meta_container',
				'dependency' => array(
					'show' => array(
						'edgtf_enable_content_bottom_area_meta' => 'yes'
					)
				)
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_content_bottom_sidebar_custom_display_meta',
				'type'          => 'selectblank',
				'default_value' => '',
				'label'         => esc_html__( 'Sidebar to Display', 'entropia' ),
				'description'   => esc_html__( 'Choose a content bottom sidebar to display', 'entropia' ),
				'options'       => entropia_edge_get_custom_sidebars(),
				'parent'        => $show_content_bottom_meta_container,
				'args'          => array(
					'select2' => true
				)
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'type'          => 'select',
				'name'          => 'edgtf_content_bottom_in_grid_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Display in Grid', 'entropia' ),
				'description'   => esc_html__( 'Enabling this option will place content bottom in grid', 'entropia' ),
				'options'       => entropia_edge_get_yes_no_select_array(),
				'parent'        => $show_content_bottom_meta_container
			)
		);

		entropia_edge_create_meta_box_field(
			array(
				'type'          => 'select',
				'name'          => 'edgtf_content_bottom_fullheight_meta',
				'default_value' => '',
				'label'         => esc_html__( 'Full Height', 'entropia' ),
				'description'   => esc_html__( 'Enabling this option will place content bottom in full height', 'entropia' ),
				'options'       => entropia_edge_get_yes_no_select_array(),
				'parent'        => $show_content_bottom_meta_container
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'type'        => 'color',
				'name'        => 'edgtf_content_bottom_background_color_meta',
				'label'       => esc_html__( 'Background Color', 'entropia' ),
				'description' => esc_html__( 'Choose a background color for content bottom area', 'entropia' ),
				'parent'      => $show_content_bottom_meta_container
			)
		);

        entropia_edge_create_meta_box_field(
                array(
                        'type'        => 'image',
                        'name'        => 'edgtf_content_bottom_background_image_meta',
                        'label'       => esc_html__( 'Background Image', 'entropia' ),
                        'description' => esc_html__( 'Choose a background image for content bottom area', 'entropia' ),
                        'parent'      => $show_content_bottom_meta_container
                )
        );
	}
	
	add_action( 'entropia_edge_action_meta_boxes_map', 'entropia_edge_map_content_bottom_meta', 71 );
}