<?php

if ( ! function_exists( 'entropia_edge_woocommerce_options_map' ) ) {
	
	/**
	 * Add Woocommerce options page
	 */
	function entropia_edge_woocommerce_options_map() {
		
		entropia_edge_add_admin_page(
			array(
				'slug'  => '_woocommerce_page',
				'title' => esc_html__( 'Woocommerce', 'entropia' ),
				'icon'  => 'fa fa-shopping-cart'
			)
		);
		
		/**
		 * Product List Settings
		 */
		$panel_product_list = entropia_edge_add_admin_panel(
			array(
				'page'  => '_woocommerce_page',
				'name'  => 'panel_product_list',
				'title' => esc_html__( 'Product List', 'entropia' )
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'name'        => 'woo_list_grid_space',
				'type'        => 'select',
				'label'       => esc_html__( 'Grid Layout Space', 'entropia' ),
				'description' => esc_html__( 'Choose a space between content layout and sidebar layout for main shop page', 'entropia' ),
				'options'     => entropia_edge_get_space_between_items_array( true ),
				'parent'      => $panel_product_list
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'edgtf_woo_product_list_columns',
				'label'         => esc_html__( 'Product List Columns', 'entropia' ),
				'default_value' => 'edgtf-woocommerce-columns-3',
				'description'   => esc_html__( 'Choose number of columns for main shop page', 'entropia' ),
				'options'       => array(
					'edgtf-woocommerce-columns-3' => esc_html__( '3 Columns', 'entropia' ),
					'edgtf-woocommerce-columns-4' => esc_html__( '4 Columns', 'entropia' )
				),
				'parent'        => $panel_product_list,
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'edgtf_woo_product_list_columns_space',
				'label'         => esc_html__( 'Space Between Items', 'entropia' ),
				'description'   => esc_html__( 'Select space between items for product listing and related products on single product', 'entropia' ),
				'default_value' => 'normal',
				'options'       => entropia_edge_get_space_between_items_array(),
				'parent'        => $panel_product_list,
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'edgtf_woo_product_list_info_position',
				'label'         => esc_html__( 'Product Info Position', 'entropia' ),
				'default_value' => 'info_below_image',
				'description'   => esc_html__( 'Select product info position for product listing and related products on single product', 'entropia' ),
				'options'       => array(
					'info_below_image'    => esc_html__( 'Info Below Image', 'entropia' ),
					'info_on_image_hover' => esc_html__( 'Info On Image Hover', 'entropia' )
				),
				'parent'        => $panel_product_list,
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'type'          => 'text',
				'name'          => 'edgtf_woo_products_per_page',
				'label'         => esc_html__( 'Number of products per page', 'entropia' ),
				'description'   => esc_html__( 'Set number of products on shop page', 'entropia' ),
				'parent'        => $panel_product_list,
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'edgtf_products_list_title_tag',
				'label'         => esc_html__( 'Products Title Tag', 'entropia' ),
				'default_value' => 'h6',
				'options'       => entropia_edge_get_title_tag(),
				'parent'        => $panel_product_list,
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'woo_enable_percent_sign_value',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Percent Sign', 'entropia' ),
				'description'   => esc_html__( 'Enabling this option will show percent value mark instead of sale label on products', 'entropia' ),
				'parent'        => $panel_product_list
			)
		);
		
		/**
		 * Single Product Settings
		 */
		$panel_single_product = entropia_edge_add_admin_panel(
			array(
				'page'  => '_woocommerce_page',
				'name'  => 'panel_single_product',
				'title' => esc_html__( 'Single Product', 'entropia' )
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'show_title_area_woo',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'entropia' ),
				'description'   => esc_html__( 'Enabling this option will show title area on single post pages', 'entropia' ),
				'parent'        => $panel_single_product,
				'options'       => entropia_edge_get_yes_no_select_array(),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'edgtf_single_product_title_tag',
				'default_value' => 'h3',
				'label'         => esc_html__( 'Single Product Title Tag', 'entropia' ),
				'options'       => entropia_edge_get_title_tag(),
				'parent'        => $panel_single_product,
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'woo_number_of_thumb_images',
				'default_value' => '3',
				'label'         => esc_html__( 'Number of Thumbnail Images per Row', 'entropia' ),
				'options'       => array(
					'4' => esc_html__( 'Four', 'entropia' ),
					'3' => esc_html__( 'Three', 'entropia' ),
					'2' => esc_html__( 'Two', 'entropia' )
				),
				'parent'        => $panel_single_product
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'woo_set_thumb_images_position',
				'default_value' => 'on-left-side',
				'label'         => esc_html__( 'Set Thumbnail Images Position', 'entropia' ),
				'options'       => array(
					'below-image'  => esc_html__( 'Below Featured Image', 'entropia' ),
					'on-left-side' => esc_html__( 'On The Left Side Of Featured Image', 'entropia' )
				),
				'parent'        => $panel_single_product
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'woo_enable_single_product_zoom_image',
				'default_value' => 'no',
				'label'         => esc_html__( 'Enable Zoom Maginfier', 'entropia' ),
				'description'   => esc_html__( 'Enabling this option will show magnifier image on featured image hover', 'entropia' ),
				'parent'        => $panel_single_product,
				'options'       => entropia_edge_get_yes_no_select_array( false ),
				'args'          => array(
					'col_width' => 3
				)
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'woo_set_single_images_behavior',
				'default_value' => 'pretty-photo',
				'label'         => esc_html__( 'Set Images Behavior', 'entropia' ),
				'options'       => array(
					'pretty-photo' => esc_html__( 'Pretty Photo Lightbox', 'entropia' ),
					'photo-swipe'  => esc_html__( 'Photo Swipe Lightbox', 'entropia' )
				),
				'parent'        => $panel_single_product
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'type'          => 'select',
				'name'          => 'edgtf_woo_related_products_columns',
				'label'         => esc_html__( 'Related Products Columns', 'entropia' ),
				'default_value' => 'edgtf-woocommerce-columns-4',
				'description'   => esc_html__( 'Choose number of columns for related products on single product page', 'entropia' ),
				'options'       => array(
					'edgtf-woocommerce-columns-3' => esc_html__( '3 Columns', 'entropia' ),
					'edgtf-woocommerce-columns-4' => esc_html__( '4 Columns', 'entropia' )
				),
				'parent'        => $panel_single_product,
			)
		);

		do_action('entropia_edge_woocommerce_additional_options_map');
	}
	
	add_action( 'entropia_edge_action_options_map', 'entropia_edge_woocommerce_options_map', entropia_edge_set_options_map_position( 'woocommerce' ) );
}