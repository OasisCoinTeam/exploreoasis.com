<?php

if ( ! function_exists( 'entropia_edge_footer_options_map' ) ) {
	function entropia_edge_footer_options_map() {

		entropia_edge_add_admin_page(
			array(
				'slug'  => '_footer_page',
				'title' => esc_html__( 'Footer', 'entropia' ),
				'icon'  => 'fa fa-sort-amount-asc'
			)
		);

		$footer_panel = entropia_edge_add_admin_panel(
			array(
				'title' => esc_html__( 'Footer', 'entropia' ),
				'name'  => 'footer',
				'page'  => '_footer_page'
			)
		);

		entropia_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'footer_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Footer in Grid', 'entropia' ),
				'description'   => esc_html__( 'Enabling this option will place Footer content in grid', 'entropia' ),
				'parent'        => $footer_panel
			)
		);

        entropia_edge_add_admin_field(
            array(
                'type'          => 'yesno',
                'name'          => 'uncovering_footer',
                'default_value' => 'no',
                'label'         => esc_html__( 'Uncovering Footer', 'entropia' ),
                'description'   => esc_html__( 'Enabling this option will make Footer gradually appear on scroll', 'entropia' ),
                'parent'        => $footer_panel,
            )
        );

		entropia_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_top',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Footer Top', 'entropia' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Top area', 'entropia' ),
				'parent'        => $footer_panel,
			)
		);
		
		$show_footer_top_container = entropia_edge_add_admin_container(
			array(
				'name'       => 'show_footer_top_container',
				'parent'     => $footer_panel,
				'dependency' => array(
					'show' => array(
						'show_footer_top' => 'yes'
					)
				)
			)
		);

		entropia_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns',
				'parent'        => $show_footer_top_container,
				'default_value' => '3 3 3 3',
				'label'         => esc_html__( 'Footer Top Columns', 'entropia' ),
				'description'   => esc_html__( 'Choose number of columns for Footer Top area', 'entropia' ),
				'options'       => array(
					'12' => '1',
					'6 6' => '2',
					'4 4 4' => '3',
                    '3 3 6' => '3 (25% + 25% + 50%)',
					'3 3 3 3' => '4'
				)
			)
		);

		entropia_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_top_columns_alignment',
				'default_value' => 'left',
				'label'         => esc_html__( 'Footer Top Columns Alignment', 'entropia' ),
				'description'   => esc_html__( 'Text Alignment in Footer Columns', 'entropia' ),
				'options'       => array(
					''       => esc_html__( 'Default', 'entropia' ),
					'left'   => esc_html__( 'Left', 'entropia' ),
					'center' => esc_html__( 'Center', 'entropia' ),
					'right'  => esc_html__( 'Right', 'entropia' )
				),
				'parent'        => $show_footer_top_container,
			)
		);

		entropia_edge_add_admin_field(
			array(
				'name'        => 'footer_top_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'entropia' ),
				'description' => esc_html__( 'Set background color for top footer area', 'entropia' ),
				'parent'      => $show_footer_top_container
			)
		);

		entropia_edge_add_admin_field(
			array(
				'parent'        => $show_footer_top_container,
				'name'          => 'footer_top_background_image',
				'type'          => 'image',
				'label'         => esc_html__( 'Background Image', 'entropia' ),
				'description'   => esc_html__( 'Choose the background image for top footer area.', 'entropia' ),
			)
		);

		entropia_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'show_footer_bottom',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Show Footer Bottom', 'entropia' ),
				'description'   => esc_html__( 'Enabling this option will show Footer Bottom area', 'entropia' ),
				'parent'        => $footer_panel,
			)
		);

		$show_footer_bottom_container = entropia_edge_add_admin_container(
			array(
				'name'            => 'show_footer_bottom_container',
				'parent'          => $footer_panel,
				'dependency' => array(
					'show' => array(
						'show_footer_bottom'  => 'yes'
					)
				)
			)
		);

		entropia_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'footer_bottom_columns',
				'default_value' => '6 6',
				'label'         => esc_html__( 'Footer Bottom Columns', 'entropia' ),
				'description'   => esc_html__( 'Choose number of columns for Footer Bottom area', 'entropia' ),
				'options'       => array(
					'12' => '1',
					'6 6' => '2',
					'4 4 4' => '3'
				),
				'parent'        => $show_footer_bottom_container,
			)
		);

		entropia_edge_add_admin_field(
			array(
				'name'        => 'footer_bottom_background_color',
				'type'        => 'color',
				'label'       => esc_html__( 'Background Color', 'entropia' ),
				'description' => esc_html__( 'Set background color for bottom footer area', 'entropia' ),
				'parent'      => $show_footer_bottom_container
			)
		);

		entropia_edge_add_admin_field(
			array(
				'parent'        => $show_footer_bottom_container,
				'name'          => 'footer_bottom_background_image',
				'type'          => 'image',
				'label'         => esc_html__( 'Background Image', 'entropia' ),
				'description'   => esc_html__( 'Choose the background image for bottom footer area.', 'entropia' ),
			)
		);
	}

	add_action( 'entropia_edge_action_options_map', 'entropia_edge_footer_options_map', entropia_edge_set_options_map_position( 'footer' ) );
}