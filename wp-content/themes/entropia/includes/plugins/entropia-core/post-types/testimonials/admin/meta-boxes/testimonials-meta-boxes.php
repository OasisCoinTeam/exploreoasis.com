<?php

if ( ! function_exists( 'entropia_core_map_testimonials_meta' ) ) {
	function entropia_core_map_testimonials_meta() {
		$testimonial_meta_box = entropia_edge_create_meta_box(
			array(
				'scope' => array( 'testimonials' ),
				'title' => esc_html__( 'Testimonial', 'entropia-core' ),
				'name'  => 'testimonial_meta'
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_testimonial_title',
				'type'        => 'text',
				'label'       => esc_html__( 'Title', 'entropia-core' ),
				'description' => esc_html__( 'Enter testimonial title', 'entropia-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_testimonial_text',
				'type'        => 'text',
				'label'       => esc_html__( 'Text', 'entropia-core' ),
				'description' => esc_html__( 'Enter testimonial text', 'entropia-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_testimonial_author',
				'type'        => 'text',
				'label'       => esc_html__( 'Author', 'entropia-core' ),
				'description' => esc_html__( 'Enter author name', 'entropia-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_testimonial_author_position',
				'type'        => 'text',
				'label'       => esc_html__( 'Author Position', 'entropia-core' ),
				'description' => esc_html__( 'Enter author job position', 'entropia-core' ),
				'parent'      => $testimonial_meta_box,
			)
		);
	}
	
	add_action( 'entropia_edge_action_meta_boxes_map', 'entropia_core_map_testimonials_meta', 95 );
}