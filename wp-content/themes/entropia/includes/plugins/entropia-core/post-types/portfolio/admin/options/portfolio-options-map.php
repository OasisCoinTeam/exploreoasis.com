<?php

if ( ! function_exists( 'entropia_edge_portfolio_options_map' ) ) {
	function entropia_edge_portfolio_options_map() {
		
		entropia_edge_add_admin_page(
			array(
				'slug'  => '_portfolio',
				'title' => esc_html__( 'Portfolio', 'entropia-core' ),
				'icon'  => 'fa fa-camera-retro'
			)
		);
		
		$panel_archive = entropia_edge_add_admin_panel(
			array(
				'title' => esc_html__( 'Portfolio Archive', 'entropia-core' ),
				'name'  => 'panel_portfolio_archive',
				'page'  => '_portfolio'
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'name'        => 'portfolio_archive_number_of_items',
				'type'        => 'text',
				'label'       => esc_html__( 'Number of Items', 'entropia-core' ),
				'description' => esc_html__( 'Set number of items for your portfolio list on archive pages. Default value is 12', 'entropia-core' ),
				'parent'      => $panel_archive,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'name'          => 'portfolio_archive_number_of_columns',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'entropia-core' ),
				'default_value' => 'four',
				'description'   => esc_html__( 'Set number of columns for your portfolio list on archive pages. Default value is Four columns', 'entropia-core' ),
				'parent'        => $panel_archive,
				'options'       => entropia_edge_get_number_of_columns_array( false, array( 'one', 'six' ) )
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'name'          => 'portfolio_archive_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'entropia-core' ),
				'description'   => esc_html__( 'Set space size between portfolio items for your portfolio list on archive pages. Default value is normal', 'entropia-core' ),
				'default_value' => 'normal',
				'options'       => entropia_edge_get_space_between_items_array(),
				'parent'        => $panel_archive
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'name'          => 'portfolio_archive_image_size',
				'type'          => 'select',
				'label'         => esc_html__( 'Image Proportions', 'entropia-core' ),
				'default_value' => 'landscape',
				'description'   => esc_html__( 'Set image proportions for your portfolio list on archive pages. Default value is landscape', 'entropia-core' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'full'      => esc_html__( 'Original', 'entropia-core' ),
					'landscape' => esc_html__( 'Landscape', 'entropia-core' ),
					'portrait'  => esc_html__( 'Portrait', 'entropia-core' ),
					'square'    => esc_html__( 'Square', 'entropia-core' )
				)
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'name'          => 'portfolio_archive_item_layout',
				'type'          => 'select',
				'label'         => esc_html__( 'Item Style', 'entropia-core' ),
				'default_value' => 'standard-shader',
				'description'   => esc_html__( 'Set item style for your portfolio list on archive pages. Default value is Standard - Shader', 'entropia-core' ),
				'parent'        => $panel_archive,
				'options'       => array(
					'standard-shader' => esc_html__( 'Standard - Shader', 'entropia-core' ),
					'gallery-overlay' => esc_html__( 'Gallery - Overlay', 'entropia-core' )
				)
			)
		);
		
		$panel = entropia_edge_add_admin_panel(
			array(
				'title' => esc_html__( 'Portfolio Single', 'entropia-core' ),
				'name'  => 'panel_portfolio_single',
				'page'  => '_portfolio'
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_template',
				'type'          => 'select',
				'label'         => esc_html__( 'Portfolio Type', 'entropia-core' ),
				'default_value' => 'small-images',
				'description'   => esc_html__( 'Choose a default type for Single Project pages', 'entropia-core' ),
				'parent'        => $panel,
				'options'       => array(
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
			)
		);
		
		/***************** Gallery Layout *****************/
		
		$portfolio_gallery_container = entropia_edge_add_admin_container(
			array(
				'parent'          => $panel,
				'name'            => 'portfolio_gallery_container',
				'dependency' => array(
					'show' => array(
						'portfolio_single_template'  => array(
							'gallery',
							'small-gallery'
						)
					)
				)
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_gallery_columns_number',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'entropia-core' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for portfolio gallery type', 'entropia-core' ),
				'parent'        => $portfolio_gallery_container,
				'options'       => entropia_edge_get_number_of_columns_array( false, array( 'one', 'five', 'six' ) )
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_gallery_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'entropia-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio gallery type', 'entropia-core' ),
				'default_value' => 'normal',
				'options'       => entropia_edge_get_space_between_items_array(),
				'parent'        => $portfolio_gallery_container
			)
		);
		
		/***************** Gallery Layout *****************/
		
		/***************** Masonry Layout *****************/
		
		$portfolio_masonry_container = entropia_edge_add_admin_container(
			array(
				'parent'          => $panel,
				'name'            => 'portfolio_masonry_container',
				'dependency' => array(
					'show' => array(
						'portfolio_single_template'  => array(
							'masonry',
							'small-masonry'
						)
					)
				)
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_masonry_columns_number',
				'type'          => 'select',
				'label'         => esc_html__( 'Number of Columns', 'entropia-core' ),
				'default_value' => 'three',
				'description'   => esc_html__( 'Set number of columns for portfolio masonry type', 'entropia-core' ),
				'parent'        => $portfolio_masonry_container,
				'options'       => entropia_edge_get_number_of_columns_array( false, array( 'one', 'five', 'six' ) )
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_masonry_space_between_items',
				'type'          => 'select',
				'label'         => esc_html__( 'Space Between Items', 'entropia-core' ),
				'description'   => esc_html__( 'Set space size between columns for portfolio masonry type', 'entropia-core' ),
				'default_value' => 'normal',
				'options'       => entropia_edge_get_space_between_items_array(),
				'parent'        => $portfolio_masonry_container
			)
		);
		
		/***************** Masonry Layout *****************/
		
		entropia_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'show_title_area_portfolio_single',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'entropia-core' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single projects', 'entropia-core' ),
				'parent'        => $panel,
				'options'       => array(
					''    => esc_html__( 'Default', 'entropia-core' ),
					'yes' => esc_html__( 'Yes', 'entropia-core' ),
					'no'  => esc_html__( 'No', 'entropia-core' )
				),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_lightbox_images',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Lightbox for Images', 'entropia-core' ),
				'description'   => esc_html__( 'Enabling this option will turn on lightbox functionality for projects with images', 'entropia-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_lightbox_videos',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Lightbox for Videos', 'entropia-core' ),
				'description'   => esc_html__( 'Enabling this option will turn on lightbox functionality for YouTube/Vimeo projects', 'entropia-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_enable_categories',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Categories', 'entropia-core' ),
				'description'   => esc_html__( 'Enabling this option will enable category meta description on single projects', 'entropia-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_hide_date',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Date', 'entropia-core' ),
				'description'   => esc_html__( 'Enabling this option will enable date meta on single projects', 'entropia-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_sticky_sidebar',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Sticky Side Text', 'entropia-core' ),
				'description'   => esc_html__( 'Enabling this option will make side text sticky on Single Project pages. This option works only for Full Width Images, Small Images, Small Gallery and Small Masonry portfolio types', 'entropia-core' ),
				'parent'        => $panel,
				'default_value' => 'yes'
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_comments',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Show Comments', 'entropia-core' ),
				'description'   => esc_html__( 'Enabling this option will show comments on your page', 'entropia-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_hide_pagination',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Hide Pagination', 'entropia-core' ),
				'description'   => esc_html__( 'Enabling this option will turn off portfolio pagination functionality', 'entropia-core' ),
				'parent'        => $panel,
				'default_value' => 'no'
			)
		);
		
		$container_navigate_category = entropia_edge_add_admin_container(
			array(
				'name'            => 'navigate_same_category_container',
				'parent'          => $panel,
				'dependency' => array(
					'hide' => array(
						'portfolio_single_hide_pagination'  => array(
							'yes'
						)
					)
				)
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'name'          => 'portfolio_single_nav_same_category',
				'type'          => 'yesno',
				'label'         => esc_html__( 'Enable Pagination Through Same Category', 'entropia-core' ),
				'description'   => esc_html__( 'Enabling this option will make portfolio pagination sort through current category', 'entropia-core' ),
				'parent'        => $container_navigate_category,
				'default_value' => 'no'
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'name'        => 'portfolio_single_slug',
				'type'        => 'text',
				'label'       => esc_html__( 'Portfolio Single Slug', 'entropia-core' ),
				'description' => esc_html__( 'Enter if you wish to use a different Single Project slug (Note: After entering slug, navigate to Settings -> Permalinks and click "Save" in order for changes to take effect)', 'entropia-core' ),
				'parent'      => $panel,
				'args'        => array(
					'col_width' => 3
				)
			)
		);
	}
	
	add_action( 'entropia_edge_action_options_map', 'entropia_edge_portfolio_options_map', entropia_edge_set_options_map_position( 'portfolio' ) );
}