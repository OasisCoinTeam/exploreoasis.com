<?php



if ( ! function_exists( 'entropia_edge_skewed_section_title_meta' ) ) {
	function entropia_edge_skewed_section_title_meta($show_title_area_container) {

		entropia_edge_add_admin_section_title(
			array(
				'parent' => $show_title_area_container,
				'name'   => 'skewed_section_container',
				'title'  => esc_html__( 'Skewed Section', 'entropia' )
			)
		);

		entropia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_enable_skewed_section_on_title_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Enable Skewed Section', 'entropia' ),
				'description'   => esc_html__( 'This option will enable/disable Skew Section on Title Area', 'entropia' ),
				'options'       => array(
					''    => esc_html__( 'Default', 'entropia' ),
					'yes' => esc_html__( 'Yes', 'entropia' ),
					'no'  => esc_html__( 'No', 'entropia' )
				),
				'parent'        => $show_title_area_container
			)
		);

		$show_skewed_section_title_area_container = entropia_edge_add_admin_container(
			array(
				'parent'          => $show_title_area_container,
				'name'            => 'show_skewed_section_title_area_container',
				'dependency' => array(
					'show' => array(
						'edgtf_enable_skewed_section_on_title_area_meta' => 'yes'
					)
				)
			)
		);

		entropia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_title_area_skewed_section_type_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Position', 'entropia' ),
				'description'   => esc_html__( 'Specify skewed section position', 'entropia' ),
				'parent'        => $show_skewed_section_title_area_container,
				'options'       => array(
					'' => esc_html__( 'Default', 'entropia' ),
					'outline' => esc_html__( 'Outline', 'entropia' ),
					'inset'    => esc_html__( 'Inset', 'entropia' )
				)
			)
		);

		entropia_edge_create_meta_box_field(
			array(
				'parent'      => $show_skewed_section_title_area_container,
				'type'        => 'textarea',
				'name'        => 'edgtf_title_area_skewed_section_svg_path_meta',
				'label'       => esc_html__('Skewed Section On Title Area SVG Path', 'entropia'),
				'description' => esc_html__('Enter your Section On Title Area SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'entropia'),
			)
		);

		entropia_edge_create_meta_box_field(
			array(
				'parent'      => $show_skewed_section_title_area_container,
				'type'        => 'color',
				'name'        => 'edgtf_title_area_skewed_section_svg_color_meta',
				'label'       => esc_html__( 'Skewed Section Color', 'entropia' ),
				'description' => esc_html__( 'Choose a background color for Skewed Section', 'entropia' ),
			)
		);


	}

	add_action('entropia_edge_action_additional_title_area_meta_boxes', 'entropia_edge_skewed_section_title_meta', 20, 1);
}


if ( ! function_exists( 'entropia_edge_skewed_section_header_meta' ) ) {
	function entropia_edge_skewed_section_header_meta($show_header_area_container) {

		entropia_edge_add_admin_section_title(
			array(
				'parent' => $show_header_area_container,
				'name'   => 'skewed_section_container',
				'title'  => esc_html__( 'Skewed Section', 'entropia' )
			)
		);

		entropia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_enable_skewed_section_on_header_area_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Enable Skewed Section', 'entropia' ),
				'description'   => esc_html__( 'This option will enable/disable Skew Section on Header Area', 'entropia' ),
				'options'       => array(
					''    => esc_html__( 'Default', 'entropia' ),
					'yes' => esc_html__( 'Yes', 'entropia' ),
					'no'  => esc_html__( 'No', 'entropia' )
				),
				'parent'        => $show_header_area_container
			)
		);

		$show_skewed_section_header_area_container = entropia_edge_add_admin_container(
			array(
				'parent'          => $show_header_area_container,
				'name'            => 'show_skewed_section_header_area_container',
				'dependency' => array(
					'show' => array(
						'edgtf_enable_skewed_section_on_header_area_meta' => 'yes'
					)
				)
			)
		);

		entropia_edge_create_meta_box_field(
			array(
				'parent'      => $show_skewed_section_header_area_container,
				'type'        => 'textarea',
				'name'        => 'edgtf_header_area_skewed_section_svg_path_meta',
				'label'       => esc_html__('Skewed Section On Header Area SVG Path', 'entropia'),
				'description' => esc_html__('Enter your Section On Header Area SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'entropia'),
			)
		);

		entropia_edge_create_meta_box_field(
			array(
				'parent'      => $show_skewed_section_header_area_container,
				'type'        => 'color',
				'name'        => 'edgtf_header_area_skewed_section_svg_color_meta',
				'label'       => esc_html__( 'Skewed Section Color', 'entropia' ),
				'description' => esc_html__( 'Choose a background color for Skewed Section', 'entropia' ),
			)
		);


	}

	add_action('entropia_edge_action_additional_header_area_meta_boxes_map', 'entropia_edge_skewed_section_header_meta', 20, 1);
}