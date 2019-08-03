<?php

if ( ! function_exists( 'entropia_edge_content_bottom_options_map' ) ) {
	function entropia_edge_content_bottom_options_map() {
		
		$panel_content_bottom = entropia_edge_add_admin_panel(
			array(
				'page'  => '_page_page',
				'name'  => 'panel_content_bottom',
				'title' => esc_html__( 'Content Bottom Area Style', 'entropia' )
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'name'          => 'enable_content_bottom_area',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Content Bottom Area', 'entropia' ),
				'description'   => esc_html__( 'This option will enable Content Bottom area on pages', 'entropia' ),
				'parent'        => $panel_content_bottom
			)
		);
		
		$enable_content_bottom_area_container = entropia_edge_add_admin_container(
			array(
				'parent'          => $panel_content_bottom,
				'name'            => 'enable_content_bottom_area_container',
				'dependency' => array(
					'show' => array(
						'enable_content_bottom_area'  => 'yes'
					)
				)
			)
		);
		
		$entropia_custom_sidebars = entropia_edge_get_custom_sidebars();
		
		entropia_edge_add_admin_field(
			array(
				'type'          => 'selectblank',
				'name'          => 'content_bottom_sidebar_custom_display',
				'default_value' => '',
				'label'         => esc_html__( 'Widget Area to Display', 'entropia' ),
				'description'   => esc_html__( 'Choose a Content Bottom widget area to display', 'entropia' ),
				'options'       => $entropia_custom_sidebars,
				'parent'        => $enable_content_bottom_area_container
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'content_bottom_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Display in Grid', 'entropia' ),
				'description'   => esc_html__( 'Enabling this option will place Content Bottom in grid', 'entropia' ),
				'parent'        => $enable_content_bottom_area_container
			)
		);

		entropia_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'content_bottom_fullheight',
				'default_value' => 'no',
				'label'         => esc_html__( 'Full Height', 'entropia' ),
				'description'   => esc_html__( 'Enabling this option will place content bottom in full height', 'entropia' ),
				'parent'        => $enable_content_bottom_area_container
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'type'        => 'color',
				'name'        => 'content_bottom_background_color',
				'label'       => esc_html__( 'Background Color', 'entropia' ),
				'description' => esc_html__( 'Choose a background color for Content Bottom area', 'entropia' ),
				'parent'      => $enable_content_bottom_area_container
			)
		);

        entropia_edge_add_admin_field(
                array(
                        'type'        => 'image',
                        'name'        => 'content_bottom_background_imgage',
                        'label'       => esc_html__( 'Background Image', 'entropia' ),
                        'description' => esc_html__( 'Choose a background image for Content Bottom area', 'entropia' ),
                        'parent'      => $enable_content_bottom_area_container
                )
        );
	}
	
	add_action( 'entropia_edge_action_additional_page_options_map', 'entropia_edge_content_bottom_options_map' );
}