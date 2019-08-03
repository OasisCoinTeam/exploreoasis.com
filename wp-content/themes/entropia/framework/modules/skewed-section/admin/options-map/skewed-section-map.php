<?php

if ( ! function_exists( 'entropia_edge_skewed_section_options_map' ) ) {
	function entropia_edge_skewed_section_options_map() {

		entropia_edge_add_admin_page(
			array(
				'slug'  => '_skewed_section_page',
				'title' => esc_html__('Skewed Section', 'entropia'),
				'icon'  => 'fa fa-indent'
			)
		);

		$skewed_section_panel = entropia_edge_add_admin_panel(
			array(
				'title' => esc_html__('Skewed Section', 'entropia'),
				'name'  => 'skewed_section',
				'page'  => '_skewed_section_page'
			)
		);

		entropia_edge_add_admin_field(
			array(
				'parent'      => $skewed_section_panel,
				'type'        => 'textarea',
				'name'        => 'skewed_section_general_svg_path',
				'label'       => esc_html__('Skewed Section SVG', 'entropia'),
				'description' => esc_html__('Enter your Skewed Section SVG here. Please remove version and id attributes from your SVG because of HTML validation', 'entropia'),
			)
		);

		entropia_edge_add_admin_field(
			array(
				'parent'      => $skewed_section_panel,
				'type'        => 'textarea',
				'name'        => 'skewed_section_row_top_svg_path',
				'label'       => esc_html__('Skewed Section On Row Top Edge SVG', 'entropia'),
				'description' => esc_html__('Enter your Skewed Section SVG here. Please remove version and id attributes from your SVG because of HTML validation', 'entropia'),
			)
		);

		entropia_edge_add_admin_field(
			array(
				'parent'      => $skewed_section_panel,
				'type'        => 'textarea',
				'name'        => 'skewed_section_row_bottom_svg_path',
				'label'       => esc_html__('Skewed Section On Row Bottom Edge SVG', 'entropia'),
				'description' => esc_html__('Enter your Skewed Section Bottom SVG here. Please remove version and id attributes from your SVG because of HTML validation', 'entropia'),
			)
		);

		entropia_edge_add_admin_field(
			array(
				'name'          => 'disable_skewed_section_on_mobile',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Disable Skewed Section On Row on Mobile Devices', 'entropia' ),
				'description'   => esc_html__( 'This option will disable Row Skew Section on Mobile Devices', 'entropia' ),
				'parent'        => $skewed_section_panel
			)
		);
		
	}

	add_action('entropia_edge_action_options_map', 'entropia_edge_skewed_section_options_map', entropia_edge_set_options_map_position( 'skewed-section' ) );
}


if ( ! function_exists( 'entropia_edge_skewed_section_title_options_map' ) ) {
	function entropia_edge_skewed_section_title_options_map($show_title_area_container) {

		entropia_edge_add_admin_section_title(
			array(
				'parent' => $show_title_area_container,
				'name'   => 'skewed_section_container',
				'title'  => esc_html__( 'Skewed Section', 'entropia' )
			)
		);


		entropia_edge_add_admin_field(
			array(
				'name'          => 'enable_skewed_section_on_title_area',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Skewed Section', 'entropia' ),
				'description'   => esc_html__( 'This option will enable/disable Skew Section on Title Area', 'entropia' ),
				'parent'        => $show_title_area_container
			)
		);

		$show_skewed_section_title_area_container = entropia_edge_add_admin_container(
			array(
				'parent'          => $show_title_area_container,
				'name'            => 'show_skewed_section_title_area_container',
				'dependency' => array(
					'show' => array(
						'enable_skewed_section_on_title_area' => 'yes'
					)
				)
			)
		);

		entropia_edge_add_admin_field(
			array(
				'name'          => 'title_area_skewed_section_type',
				'type'          => 'select',
				'default_value' => 'outline',
				'label'         => esc_html__( 'Position', 'entropia' ),
				'description'   => esc_html__( 'Specify skewed section position', 'entropia' ),
				'parent'        => $show_skewed_section_title_area_container,
				'options'       => array(
					'outline' => esc_html__( 'Outline', 'entropia' ),
					'inset'    => esc_html__( 'Inset', 'entropia' )
				)
			)
		);

		entropia_edge_add_admin_field(
			array(
				'parent'      => $show_skewed_section_title_area_container,
				'type'        => 'textarea',
				'name'        => 'title_area_skewed_section_svg_path',
				'label'       => esc_html__('Skewed Section On Title Area SVG', 'entropia'),
				'description' => esc_html__('Enter your Section On Title Area SVG here. Please remove version and id attributes from your SVG because of HTML validation', 'entropia'),
			)
		);

		entropia_edge_add_admin_field(
			array(
				'parent'      => $show_skewed_section_title_area_container,
				'type'        => 'color',
				'name'        => 'title_area_skewed_section_svg_color',
				'label'       => esc_html__( 'Skewed Section Color', 'entropia' ),
				'description' => esc_html__( 'Choose a background color for Skewed Section', 'entropia' ),
			)
		);

		entropia_edge_add_admin_field(
			array(
				'name'          => 'disable_title_skewed_section_on_mobile',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Disable Title Skewed Section on Mobile Devices', 'entropia' ),
				'description'   => esc_html__( 'This option will disable Title Skew Section on Mobile Devices', 'entropia' ),
				'parent'        => $show_skewed_section_title_area_container
			)
		);


	}

	add_action('entropia_edge_action_additional_title_area_options_map', 'entropia_edge_skewed_section_title_options_map', 10, 1);
}


if ( ! function_exists( 'entropia_edge_skewed_section_header_options_map' ) ) {
	function entropia_edge_skewed_section_header_options_map($show_header_area_container) {

		entropia_edge_add_admin_section_title(
			array(
				'parent' => $show_header_area_container,
				'name'   => 'skewed_section_container',
				'title'  => esc_html__( 'Skewed Section', 'entropia' )
			)
		);

		entropia_edge_add_admin_field(
			array(
				'name'          => 'enable_skewed_section_on_header_area',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Skewed Section', 'entropia' ),
				'description'   => esc_html__( 'This option will enable/disable Skew Section on Header Area', 'entropia' ),
				'parent'        => $show_header_area_container
			)
		);

		$show_skewed_section_header_area_container = entropia_edge_add_admin_container(
			array(
				'parent'          => $show_header_area_container,
				'name'            => 'show_skewed_section_header_area_container',
				'dependency' => array(
					'show' => array(
						'enable_skewed_section_on_header_area' => 'yes'
					)
				)
			)
		);

		entropia_edge_add_admin_field(
			array(
				'parent'      => $show_skewed_section_header_area_container,
				'type'        => 'textarea',
				'name'        => 'header_area_skewed_section_svg_path',
				'label'       => esc_html__('Skewed Section On Header Area SVG', 'entropia'),
				'description' => esc_html__('Enter your Section On Header Area SVG here. Please remove version and id attributes from your SVG because of HTML validation', 'entropia'),
			)
		);

		entropia_edge_add_admin_field(
			array(
				'parent'      => $show_skewed_section_header_area_container,
				'type'        => 'color',
				'name'        => 'header_area_skewed_section_svg_color',
				'label'       => esc_html__( 'Skewed Section Color', 'entropia' ),
				'description' => esc_html__( 'Choose a background color for Skewed Section', 'entropia' ),
			)
		);

		entropia_edge_add_admin_field(
			array(
				'name'          => 'disable_header_skewed_section_on_mobile',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Disable Header Skewed Section on Touch Devices', 'entropia' ),
				'description'   => esc_html__( 'This option will disable Header Skew Section on Touch Devices', 'entropia' ),
				'parent'        => $show_skewed_section_header_area_container
			)
		);


	}

	add_action('entropia_edge_action_header_additional_options_map', 'entropia_edge_skewed_section_header_options_map', 10, 1);
}