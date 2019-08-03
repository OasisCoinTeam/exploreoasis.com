<?php

if ( ! function_exists( 'entropia_edge_get_search_types_options' ) ) {
    function entropia_edge_get_search_types_options() {
        $search_type_options = apply_filters( 'entropia_edge_filter_search_type_global_option', $search_type_options = array() );

        return $search_type_options;
    }
}

if ( ! function_exists( 'entropia_edge_search_options_map' ) ) {
	function entropia_edge_search_options_map() {
		
		entropia_edge_add_admin_page(
			array(
				'slug'  => '_search_page',
				'title' => esc_html__( 'Search', 'entropia' ),
				'icon'  => 'fa fa-search'
			)
		);
		
		$search_page_panel = entropia_edge_add_admin_panel(
			array(
				'title' => esc_html__( 'Search Page', 'entropia' ),
				'name'  => 'search_template',
				'page'  => '_search_page'
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'name'          => 'search_page_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Layout', 'entropia' ),
				'default_value' => 'in-grid',
				'description'   => esc_html__( 'Set layout. Default is in grid.', 'entropia' ),
				'parent'        => $search_page_panel,
				'options'       => array(
					'in-grid'    => esc_html__( 'In Grid', 'entropia' ),
					'full-width' => esc_html__( 'Full Width', 'entropia' )
				)
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'name'          => 'search_page_sidebar_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout', 'entropia' ),
				'description'   => esc_html__( "Choose a sidebar layout for search page", 'entropia' ),
				'default_value' => 'no-sidebar',
				'options'       => entropia_edge_get_custom_sidebars_options(),
				'parent'        => $search_page_panel
			)
		);
		
		$entropia_custom_sidebars = entropia_edge_get_custom_sidebars();
		if ( count( $entropia_custom_sidebars ) > 0 ) {
			entropia_edge_add_admin_field(
				array(
					'name'        => 'search_custom_sidebar_area',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Sidebar to Display', 'entropia' ),
					'description' => esc_html__( 'Choose a sidebar to display on search page. Default sidebar is "Sidebar"', 'entropia' ),
					'parent'      => $search_page_panel,
					'options'     => $entropia_custom_sidebars,
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
		
		$search_panel = entropia_edge_add_admin_panel(
			array(
				'title' => esc_html__( 'Search', 'entropia' ),
				'name'  => 'search',
				'page'  => '_search_page'
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'select',
				'name'          => 'search_type',
				'default_value' => 'fullscreen',
				'label'         => esc_html__( 'Select Search Type', 'entropia' ),
				'description'   => esc_html__( "Choose a type of Select search bar (Note: Slide From Header Bottom search type doesn't work with Vertical Header)", 'entropia' ),
				'options'       => entropia_edge_get_search_types_options()
			)
		);

		entropia_edge_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'select',
				'name'          => 'search_icon_source',
				'default_value' => 'icon_pack',
				'label'         => esc_html__( 'Select Search Icon Source', 'entropia' ),
				'description'   => esc_html__( 'Choose whether you would like to use icons from an icon pack or SVG icons', 'entropia' ),
				'options'       => entropia_edge_get_icon_sources_array( false, false )
			)
		);

		$search_icon_pack_container = entropia_edge_add_admin_container(
			array(
				'parent'          => $search_panel,
				'name'            => 'search_icon_pack_container',
				'dependency' => array(
					'show' => array(
						'search_icon_source' => 'icon_pack'
					)
				)
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'parent'        => $search_icon_pack_container,
				'type'          => 'select',
				'name'          => 'search_icon_pack',
				'default_value' => 'font_elegant',
				'label'         => esc_html__( 'Search Icon Pack', 'entropia' ),
				'description'   => esc_html__( 'Choose icon pack for search icon', 'entropia' ),
				'options'       => entropia_edge_icon_collections()->getIconCollectionsExclude( array( 'linea_icons', 'dripicons', 'simple_line_icons' ) )
			)
		);

		$search_svg_path_container = entropia_edge_add_admin_container(
			array(
				'parent'          => $search_panel,
				'name'            => 'search_icon_svg_path_container',
				'dependency' => array(
					'show' => array(
						'search_icon_source' => 'svg_path'
					)
				)
			)
		);

		entropia_edge_add_admin_field(
			array(
				'parent'      => $search_svg_path_container,
				'type'        => 'textarea',
				'name'        => 'search_icon_svg_path',
				'label'       => esc_html__( 'Search Icon SVG Path', 'entropia' ),
				'description' => esc_html__( 'Enter your search icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'entropia' ),
			)
		);

		entropia_edge_add_admin_field(
			array(
				'parent'      => $search_svg_path_container,
				'type'        => 'textarea',
				'name'        => 'search_close_icon_svg_path',
				'label'       => esc_html__( 'Search Close Icon SVG Path', 'entropia' ),
				'description' => esc_html__( 'Enter your search close icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'entropia' ),
			)
		);

        entropia_edge_add_admin_field(
            array(
                'type'          => 'select',
                'name'          => 'search_sidebar_columns',
                'parent'        => $search_panel,
                'default_value' => '3',
                'label'         => esc_html__( 'Search Sidebar Columns', 'entropia' ),
                'description'   => esc_html__( 'Choose number of columns for FullScreen search sidebar area', 'entropia' ),
                'options'       => array(
                    '1' => '1',
                    '2' => '2',
                    '3' => '3',
                ),
				'dependency' => array(
					'show' => array(
						'search_type' => apply_filters('search_sidebar_columns_dependency', $dependency_array = array())
					)
				)
            )
        );
		
		entropia_edge_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'yesno',
				'name'          => 'search_in_grid',
				'default_value' => 'yes',
				'label'         => esc_html__( 'Enable Grid Layout', 'entropia' ),
				'description'   => esc_html__( 'Set search area to be in grid. (Applied for Search covers header type).', 'entropia' ),
				'dependency' => array(
					'show' => array(
						'search_type' => apply_filters('search_in_grid_dependency', $dependency_array = array())
					)
				)
			)
		);

		entropia_edge_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'image',
				'name'          => 'search_background_image',
				'label'         => esc_html__( 'Background Image', 'entropia' ),
				'description'   => esc_html__( 'Choose the background image for fullscreen search.', 'entropia' ),
				'dependency' => array(
					'show' => array(
						'search_type' => apply_filters('search_background_image_dependency', $dependency_array = array())
					)
				)
			)
		);
		
		entropia_edge_add_admin_section_title(
			array(
				'parent' => $search_panel,
				'name'   => 'initial_header_icon_title',
				'title'  => esc_html__( 'Initial Search Icon in Header', 'entropia' )
			)
		);

		$search_icon_pack_icon_styles_container = entropia_edge_add_admin_container(
			array(
				'parent'          => $search_panel,
				'name'            => 'search_icon_pack_icon_styles_container',
				'dependency' => array(
					'show' => array(
						'search_icon_source' => 'icon_pack'
					)
				)
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'parent'        => $search_icon_pack_icon_styles_container,
				'type'          => 'text',
				'name'          => 'header_search_icon_size',
				'default_value' => '',
				'label'         => esc_html__( 'Icon Size', 'entropia' ),
				'description'   => esc_html__( 'Set size for icon', 'entropia' ),
				'args'          => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		$search_icon_color_group = entropia_edge_add_admin_group(
			array(
				'parent'      => $search_panel,
				'title'       => esc_html__( 'Icon Colors', 'entropia' ),
				'description' => esc_html__( 'Define color style for icon', 'entropia' ),
				'name'        => 'search_icon_color_group'
			)
		);
		
		$search_icon_color_row = entropia_edge_add_admin_row(
			array(
				'parent' => $search_icon_color_group,
				'name'   => 'search_icon_color_row'
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'   => 'colorsimple',
				'name'   => 'header_search_icon_color',
				'label'  => esc_html__( 'Color', 'entropia' )
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'parent' => $search_icon_color_row,
				'type'   => 'colorsimple',
				'name'   => 'header_search_icon_hover_color',
				'label'  => esc_html__( 'Hover Color', 'entropia' )
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'parent'        => $search_panel,
				'type'          => 'yesno',
				'name'          => 'enable_search_icon_text',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Search Icon Text', 'entropia' ),
				'description'   => esc_html__( "Enable this option to show 'Search' text next to search icon in header", 'entropia' )
			)
		);
		
		$enable_search_icon_text_container = entropia_edge_add_admin_container(
			array(
				'parent'          => $search_panel,
				'name'            => 'enable_search_icon_text_container',
				'dependency' => array(
					'show' => array(
						'enable_search_icon_text' => 'yes'
					)
				)
			)
		);
		
		$enable_search_icon_text_group = entropia_edge_add_admin_group(
			array(
				'parent'      => $enable_search_icon_text_container,
				'title'       => esc_html__( 'Search Icon Text', 'entropia' ),
				'name'        => 'enable_search_icon_text_group',
				'description' => esc_html__( 'Define style for search icon text', 'entropia' )
			)
		);
		
		$enable_search_icon_text_row = entropia_edge_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row'
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'parent' => $enable_search_icon_text_row,
				'type'   => 'colorsimple',
				'name'   => 'search_icon_text_color',
				'label'  => esc_html__( 'Text Color', 'entropia' )
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'parent' => $enable_search_icon_text_row,
				'type'   => 'colorsimple',
				'name'   => 'search_icon_text_color_hover',
				'label'  => esc_html__( 'Text Hover Color', 'entropia' )
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_font_size',
				'label'         => esc_html__( 'Font Size', 'entropia' ),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_line_height',
				'label'         => esc_html__( 'Line Height', 'entropia' ),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
		
		$enable_search_icon_text_row2 = entropia_edge_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row2',
				'next'   => true
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_text_transform',
				'label'         => esc_html__( 'Text Transform', 'entropia' ),
				'default_value' => '',
				'options'       => entropia_edge_get_text_transform_array()
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'fontsimple',
				'name'          => 'search_icon_text_google_fonts',
				'label'         => esc_html__( 'Font Family', 'entropia' ),
				'default_value' => '-1',
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_font_style',
				'label'         => esc_html__( 'Font Style', 'entropia' ),
				'default_value' => '',
				'options'       => entropia_edge_get_font_style_array(),
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row2,
				'type'          => 'selectblanksimple',
				'name'          => 'search_icon_text_font_weight',
				'label'         => esc_html__( 'Font Weight', 'entropia' ),
				'default_value' => '',
				'options'       => entropia_edge_get_font_weight_array(),
			)
		);
		
		$enable_search_icon_text_row3 = entropia_edge_add_admin_row(
			array(
				'parent' => $enable_search_icon_text_group,
				'name'   => 'enable_search_icon_text_row3',
				'next'   => true
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'parent'        => $enable_search_icon_text_row3,
				'type'          => 'textsimple',
				'name'          => 'search_icon_text_letter_spacing',
				'label'         => esc_html__( 'Letter Spacing', 'entropia' ),
				'default_value' => '',
				'args'          => array(
					'suffix' => 'px'
				)
			)
		);
	}
	
	add_action( 'entropia_edge_action_options_map', 'entropia_edge_search_options_map', entropia_edge_set_options_map_position( 'search' ) );
}