<?php

if ( ! function_exists( 'entropia_edge_portfolio_category_additional_fields' ) ) {
	function entropia_edge_portfolio_category_additional_fields() {
		
		$fields = entropia_edge_add_taxonomy_fields(
			array(
				'scope' => 'portfolio-category',
				'name'  => 'portfolio_category_options'
			)
		);
		
		entropia_edge_add_taxonomy_field(
			array(
				'name'   => 'edgtf_portfolio_category_image_meta',
				'type'   => 'image',
				'label'  => esc_html__( 'Category Image', 'entropia-core' ),
				'parent' => $fields
			)
		);
	}
	
	add_action( 'entropia_edge_action_custom_taxonomy_fields', 'entropia_edge_portfolio_category_additional_fields' );
}