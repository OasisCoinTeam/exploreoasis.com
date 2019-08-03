<?php

if ( ! function_exists( 'entropia_edge_sidearea_options_map' ) ) {
	function entropia_edge_sidearea_options_map() {

        entropia_edge_add_admin_page(
            array(
                'slug'  => '_side_area_page',
                'title' => esc_html__('Side Area', 'entropia'),
                'icon'  => 'fa fa-indent'
            )
        );

        $side_area_panel = entropia_edge_add_admin_panel(
            array(
                'title' => esc_html__('Side Area', 'entropia'),
                'name'  => 'side_area',
                'page'  => '_side_area_page'
            )
        );

        entropia_edge_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'select',
                'name'          => 'side_area_type',
                'default_value' => 'side-menu-slide-from-right',
                'label'         => esc_html__('Side Area Type', 'entropia'),
                'description'   => esc_html__('Choose a type of Side Area', 'entropia'),
                'options'       => array(
                    'side-menu-slide-from-right'       => esc_html__('Slide from Right Over Content', 'entropia'),
                    'side-menu-slide-with-content'     => esc_html__('Slide from Right With Content', 'entropia'),
                    'side-area-uncovered-from-content' => esc_html__('Side Area Uncovered from Content', 'entropia'),
                ),
            )
        );

        entropia_edge_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'text',
                'name'          => 'side_area_width',
                'default_value' => '',
                'label'         => esc_html__('Side Area Width', 'entropia'),
                'description'   => esc_html__('Enter a width for Side Area (px or %). Default width: 405px.', 'entropia'),
                'args'          => array(
                    'col_width' => 3,
                )
            )
        );

        $side_area_width_container = entropia_edge_add_admin_container(
            array(
                'parent'     => $side_area_panel,
                'name'       => 'side_area_width_container',
                'dependency' => array(
                    'show' => array(
                        'side_area_type' => 'side-menu-slide-from-right',
                    )
                )
            )
        );

        entropia_edge_add_admin_field(
            array(
                'parent'        => $side_area_width_container,
                'type'          => 'color',
                'name'          => 'side_area_content_overlay_color',
                'default_value' => '',
                'label'         => esc_html__('Content Overlay Background Color', 'entropia'),
                'description'   => esc_html__('Choose a background color for a content overlay', 'entropia'),
            )
        );

        entropia_edge_add_admin_field(
            array(
                'parent'        => $side_area_width_container,
                'type'          => 'text',
                'name'          => 'side_area_content_overlay_opacity',
                'default_value' => '',
                'label'         => esc_html__('Content Overlay Background Transparency', 'entropia'),
                'description'   => esc_html__('Choose a transparency for the content overlay background color (0 = fully transparent, 1 = opaque)', 'entropia'),
                'args'          => array(
                    'col_width' => 3
                )
            )
        );

        entropia_edge_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'select',
                'name'          => 'side_area_icon_source',
                'default_value' => 'predefined',
                'label'         => esc_html__('Select Side Area Icon Source', 'entropia'),
                'description'   => esc_html__('Choose whether you would like to use icons from an icon pack or SVG icons', 'entropia'),
                'options'       => entropia_edge_get_icon_sources_array()
            )
        );

        $side_area_icon_pack_container = entropia_edge_add_admin_container(
            array(
                'parent'     => $side_area_panel,
                'name'       => 'side_area_icon_pack_container',
                'dependency' => array(
                    'show' => array(
                        'side_area_icon_source' => 'icon_pack'
                    )
                )
            )
        );

        entropia_edge_add_admin_field(
            array(
                'parent'        => $side_area_icon_pack_container,
                'type'          => 'select',
                'name'          => 'side_area_icon_pack',
                'default_value' => 'font_elegant',
                'label'         => esc_html__('Side Area Icon Pack', 'entropia'),
                'description'   => esc_html__('Choose icon pack for Side Area icon', 'entropia'),
                'options'       => entropia_edge_icon_collections()->getIconCollectionsExclude(array('linea_icons', 'dripicons', 'simple_line_icons'))
            )
        );

        $side_area_svg_icons_container = entropia_edge_add_admin_container(
            array(
                'parent'     => $side_area_panel,
                'name'       => 'side_area_svg_icons_container',
                'dependency' => array(
                    'show' => array(
                        'side_area_icon_source' => 'svg_path'
                    )
                )
            )
        );

        entropia_edge_add_admin_field(
            array(
                'parent'      => $side_area_svg_icons_container,
                'type'        => 'textarea',
                'name'        => 'side_area_icon_svg_path',
                'label'       => esc_html__('Side Area Icon SVG Path', 'entropia'),
                'description' => esc_html__('Enter your Side Area icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'entropia'),
            )
        );

        entropia_edge_add_admin_field(
            array(
                'parent'      => $side_area_svg_icons_container,
                'type'        => 'textarea',
                'name'        => 'side_area_close_icon_svg_path',
                'label'       => esc_html__('Side Area Close Icon SVG Path', 'entropia'),
                'description' => esc_html__('Enter your Side Area close icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'entropia'),
            )
        );

        $side_area_icon_style_group = entropia_edge_add_admin_group(
            array(
                'parent'      => $side_area_panel,
                'name'        => 'side_area_icon_style_group',
                'title'       => esc_html__('Side Area Icon Style', 'entropia'),
                'description' => esc_html__('Define styles for Side Area icon', 'entropia')
            )
        );

        $side_area_icon_style_row1 = entropia_edge_add_admin_row(
            array(
                'parent' => $side_area_icon_style_group,
                'name'   => 'side_area_icon_style_row1'
            )
        );

        entropia_edge_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row1,
                'type'   => 'colorsimple',
                'name'   => 'side_area_icon_color',
                'label'  => esc_html__('Color', 'entropia')
            )
        );

        entropia_edge_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row1,
                'type'   => 'colorsimple',
                'name'   => 'side_area_icon_hover_color',
                'label'  => esc_html__('Hover Color', 'entropia')
            )
        );

        $side_area_icon_style_row2 = entropia_edge_add_admin_row(
            array(
                'parent' => $side_area_icon_style_group,
                'name'   => 'side_area_icon_style_row2',
                'next'   => true
            )
        );

        entropia_edge_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row2,
                'type'   => 'colorsimple',
                'name'   => 'side_area_close_icon_color',
                'label'  => esc_html__('Close Icon Color', 'entropia')
            )
        );

        entropia_edge_add_admin_field(
            array(
                'parent' => $side_area_icon_style_row2,
                'type'   => 'colorsimple',
                'name'   => 'side_area_close_icon_hover_color',
                'label'  => esc_html__('Close Icon Hover Color', 'entropia')
            )
        );

        entropia_edge_add_admin_field(
            array(
                'parent'      => $side_area_panel,
                'type'        => 'color',
                'name'        => 'side_area_background_color',
                'label'       => esc_html__('Background Color', 'entropia'),
                'description' => esc_html__('Choose a background color for Side Area', 'entropia')
            )
        );

		entropia_edge_add_admin_field(
			array(
				'name'        => 'side_area_background_image',
				'type'        => 'image',
				'label'       => esc_html__( 'Background Image', 'entropia' ),
				'description' => esc_html__( 'Choose the background image for Side Area', 'entropia' ),
				'parent'      => $side_area_panel
			)
		);

        entropia_edge_add_admin_field(
            array(
                'parent'      => $side_area_panel,
                'type'        => 'text',
                'name'        => 'side_area_padding',
                'label'       => esc_html__('Padding', 'entropia'),
                'description' => esc_html__('Define padding for Side Area in format top right bottom left', 'entropia'),
                'args'        => array(
                    'col_width' => 3
                )
            )
        );

        entropia_edge_add_admin_field(
            array(
                'parent'        => $side_area_panel,
                'type'          => 'selectblank',
                'name'          => 'side_area_aligment',
                'default_value' => '',
                'label'         => esc_html__('Text Alignment', 'entropia'),
                'description'   => esc_html__('Choose text alignment for side area', 'entropia'),
                'options'       => array(
                    ''       => esc_html__('Default', 'entropia'),
                    'left'   => esc_html__('Left', 'entropia'),
                    'center' => esc_html__('Center', 'entropia'),
                    'right'  => esc_html__('Right', 'entropia')
                )
            )
        );
    }

    add_action('entropia_edge_action_options_map', 'entropia_edge_sidearea_options_map', entropia_edge_set_options_map_position( 'sidearea' ) );
}