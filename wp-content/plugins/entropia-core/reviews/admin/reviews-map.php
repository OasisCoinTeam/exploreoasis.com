<?php

if ( ! function_exists( 'entropia_core_reviews_map' ) ) {
	function entropia_core_reviews_map() {
		
		$reviews_panel = entropia_edge_add_admin_panel(
			array(
				'title' => esc_html__( 'Reviews', 'entropia-core' ),
				'name'  => 'panel_reviews',
				'page'  => '_page_page'
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'parent'      => $reviews_panel,
				'type'        => 'text',
				'name'        => 'reviews_section_title',
				'label'       => esc_html__( 'Reviews Section Title', 'entropia-core' ),
				'description' => esc_html__( 'Enter title that you want to show before average rating on your page', 'entropia-core' ),
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'parent'      => $reviews_panel,
				'type'        => 'textarea',
				'name'        => 'reviews_section_subtitle',
				'label'       => esc_html__( 'Reviews Section Subtitle', 'entropia-core' ),
				'description' => esc_html__( 'Enter subtitle that you want to show before average rating on your page', 'entropia-core' ),
			)
		);
	}
	
	add_action( 'entropia_edge_action_additional_page_options_map', 'entropia_core_reviews_map', 75 ); //one after elements
}