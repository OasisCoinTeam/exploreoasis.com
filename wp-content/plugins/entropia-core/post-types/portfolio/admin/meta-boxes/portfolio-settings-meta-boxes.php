<?php

if ( ! function_exists( 'entropia_core_map_portfolio_settings_meta' ) ) {
	function entropia_core_map_portfolio_settings_meta() {
		$meta_box = entropia_edge_create_meta_box( array(
			'scope' => 'portfolio-item',
			'title' => esc_html__( 'Portfolio Settings', 'entropia-core' ),
			'name'  => 'portfolio_settings_meta_box'
		) );
		
		entropia_edge_create_meta_box_field( array(
			'name'        => 'edgtf_portfolio_single_template_meta',
			'type'        => 'select',
			'label'       => esc_html__( 'Portfolio Type', 'entropia-core' ),
			'description' => esc_html__( 'Choose a default type for Single Project pages', 'entropia-core' ),
			'parent'      => $meta_box,
			'options'     => array(
				''                  => esc_html__( 'Default', 'entropia-core' ),
				'huge-images'       => esc_html__( 'Portfolio Full Width Images', 'entropia-core' ),
				'images'            => esc_html__( 'Portfolio Images', 'entropia-core' ),
				'small-images'      => esc_html__( 'Portfolio Small Images', 'entropia-core' ),
				'slider'            => esc_html__( 'Portfolio Slider', 'entropia-core' ),
				'small-slider'      => esc_html__( 'Portfolio Small Slider', 'entropia-core' ),
				'gallery'           => esc_html__( 'Portfolio Gallery', 'entropia-core' ),
				'small-gallery'     => esc_html__( 'Portfolio Small Gallery', 'entropia-core' ),
				'masonry'           => esc_html__( 'Portfolio Masonry', 'entropia-core' ),
				'small-masonry'     => esc_html__( 'Portfolio Small Masonry', 'entropia-core' ),
				'custom'            => esc_html__( 'Portfolio Custom', 'entropia-core' ),
				'full-width-custom' => esc_html__( 'Portfolio Full Width Custom', 'entropia-core' )
			)
		) );
		
		/***************** Gallery Layout *****************/
		
		$gallery_type_meta_container = entropia_edge_add_admin_container(
			array(
				'parent'          => $meta_box,
				'name'            => 'edgtf_gallery_type_meta_container',
				'dependency' => array(
					'show' => array(
						'edgtf_portfolio_single_template_meta'  => array(
							'gallery',
							'small-gallery'
						)
					)
				)
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_portfolio_single_gallery_columns_number_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'entropia-core' ),
				'default_value' => '',
				'description'   => esc_html__( 'Set number of columns for portfolio gallery type', 'entropia-core' ),
				'parent'        => $gallery_type_meta_container,
				'options'       => entropia_edge_get_number_of_columns_array( true, array( 'one', 'five', 'six' ) )
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_portfolio_single_gallery_space_between_items_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'entropia-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio gallery type', 'entropia-core' ),
				'default_value' => '',
				'options'       => entropia_edge_get_space_between_items_array( true ),
				'parent'        => $gallery_type_meta_container
			)
		);
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$masonry_type_meta_container = entropia_edge_add_admin_container(
			array(
				'parent'          => $meta_box,
				'name'            => 'edgtf_masonry_type_meta_container',
				'dependency' => array(
					'show' => array(
						'edgtf_portfolio_single_template_meta'  => array(
							'masonry',
							'small-masonry'
						)
					)
				)
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_portfolio_single_masonry_columns_number_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'entropia-core' ),
				'default_value' => '',
				'description'   => esc_html__( 'Set number of columns for portfolio masonry type', 'entropia-core' ),
				'parent'        => $masonry_type_meta_container,
				'options'       => entropia_edge_get_number_of_columns_array( true, array( 'one', 'five', 'six' ) )
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_portfolio_single_masonry_space_between_items_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'entropia-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio masonry type', 'entropia-core' ),
				'default_value' => '',
				'options'       => entropia_edge_get_space_between_items_array( true ),
				'parent'        => $masonry_type_meta_container
			)
		);
		
		/***************** Masonry Layout *****************/
		
		entropia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_show_title_area_portfolio_single_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'entropia-core' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single portfolio page', 'entropia-core' ),
				'parent'        => $meta_box,
				'options'       => entropia_edge_get_yes_no_select_array()
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'        => 'portfolio_info_top_padding',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio Info Top Padding', 'entropia-core' ),
				'description' => esc_html__( 'Set top padding for portfolio info elements holder. This option works only for Portfolio Images, Slider, Gallery and Masonry portfolio types', 'entropia-core' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3,
					'suffix'    => 'px'
				)
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'        => 'portfolio_external_link',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio External Link', 'entropia-core' ),
				'description' => esc_html__( 'Enter URL to link from Portfolio List page', 'entropia-core' ),
				'parent'      => $meta_box,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_portfolio_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Featured Image', 'entropia-core' ),
				'description' => esc_html__( 'Choose an image for Portfolio Lists shortcode where Hover Type option is Switch Featured Images', 'entropia-core' ),
				'parent'      => $meta_box
			)
		);

        entropia_edge_create_meta_box_field(
            array(
                'name'        => 'edgtf_portfolio_overlay_image_meta',
                'type'        => 'image',
                'label'       => esc_html__( 'Overlay Image', 'entropia-core' ),
                'description' => esc_html__( 'Choose an overlay pattern image for Portfolio Lists shortcode where Hover Type option is Overlay', 'entropia-core' ),
                'parent'      => $meta_box
            )
        );
		
		entropia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_portfolio_masonry_fixed_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Masonry - Image Fixed Proportion', 'entropia-core' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry type portfolio lists where image proportion is fixed', 'entropia-core' ),
				'default_value' => '',
				'parent'        => $meta_box,
				'options'       => array(
					''                   => esc_html__( 'Default', 'entropia-core' ),
					'small'              => esc_html__( 'Small', 'entropia-core' ),
					'large-width'        => esc_html__( 'Large Width', 'entropia-core' ),
					'large-height'       => esc_html__( 'Large Height', 'entropia-core' ),
					'large-width-height' => esc_html__( 'Large Width/Height', 'entropia-core' )
				)
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_portfolio_masonry_original_dimensions_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Dimensions for Masonry - Image Original Proportion', 'entropia-core' ),
				'description'   => esc_html__( 'Choose image layout when it appears in Masonry type portfolio lists where image proportion is original', 'entropia-core' ),
				'default_value' => '',
				'parent'        => $meta_box,
				'options'       => array(
					''            => esc_html__( 'Default', 'entropia-core' ),
					'large-width' => esc_html__( 'Large Width', 'entropia-core' )
				)
			)
		);
		
		$all_pages = array();
		$pages     = get_pages();
		foreach ( $pages as $page ) {
			$all_pages[ $page->ID ] = $page->post_title;
		}
		
		entropia_edge_create_meta_box_field(
			array(
				'name'        => 'portfolio_single_back_to_link',
				'type'        => 'select',
				'label'       => esc_html__( '"Back To" Link', 'entropia-core' ),
				'description' => esc_html__( 'Choose "Back To" page to link from portfolio Single Project page', 'entropia-core' ),
				'parent'      => $meta_box,
				'options'     => $all_pages,
				'args'        => array(
					'select2' => true
				)
			)
		);
	}
	
	add_action( 'entropia_edge_action_meta_boxes_map', 'entropia_core_map_portfolio_settings_meta', 41 );
}