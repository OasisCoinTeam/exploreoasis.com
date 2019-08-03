<?php

if ( ! function_exists( 'entropia_edge_map_woocommerce_meta' ) ) {
	function entropia_edge_map_woocommerce_meta() {
		
		$woocommerce_meta_box = entropia_edge_create_meta_box(
			array(
				'scope' => array( 'product' ),
				'title' => esc_html__( 'Product Meta', 'entropia' ),
				'name'  => 'woo_product_meta'
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_product_featured_image_size',
				'type'        => 'select',
				'label'       => esc_html__( 'Dimensions for Product List Shortcode', 'entropia' ),
				'description' => esc_html__( 'Choose image layout when it appears in Edge Product List - Masonry layout shortcode', 'entropia' ),
				'options'     => array(
					''                   => esc_html__( 'Default', 'entropia' ),
					'small'              => esc_html__( 'Small', 'entropia' ),
					'large-width'        => esc_html__( 'Large Width', 'entropia' ),
					'large-height'       => esc_html__( 'Large Height', 'entropia' ),
					'large-width-height' => esc_html__( 'Large Width Height', 'entropia' )
				),
				'parent'      => $woocommerce_meta_box
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_show_title_area_woo_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'entropia' ),
				'description'   => esc_html__( 'Disabling this option will turn off page title area', 'entropia' ),
				'options'       => entropia_edge_get_yes_no_select_array(),
				'parent'        => $woocommerce_meta_box
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_show_new_sign_woo_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Show New Sign', 'entropia' ),
				'description'   => esc_html__( 'Enabling this option will show new sign mark on product', 'entropia' ),
				'parent'        => $woocommerce_meta_box
			)
		);
	}
	
	add_action( 'entropia_edge_action_meta_boxes_map', 'entropia_edge_map_woocommerce_meta', 99 );
}