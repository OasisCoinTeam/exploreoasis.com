<?php

if ( ! function_exists( 'entropia_edge_map_post_quote_meta' ) ) {
	function entropia_edge_map_post_quote_meta() {
		$quote_post_format_meta_box = entropia_edge_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Quote Post Format', 'entropia' ),
				'name'  => 'post_format_quote_meta'
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_post_quote_text_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Text', 'entropia' ),
				'description' => esc_html__( 'Enter Quote text', 'entropia' ),
				'parent'      => $quote_post_format_meta_box
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_post_quote_author_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Quote Author', 'entropia' ),
				'description' => esc_html__( 'Enter Quote author', 'entropia' ),
				'parent'      => $quote_post_format_meta_box
			)
		);

        entropia_edge_create_meta_box_field(
            array(
                'name'        => 'edgtf_post_quote_bg_image_meta',
                'type'        => 'image',
                'label'       => esc_html__( 'Quote Background Image', 'entropia' ),
                'description' => esc_html__( 'Upload background image for quote', 'entropia' ),
                'parent'      => $quote_post_format_meta_box
            )
        );
	}
	
	add_action( 'entropia_edge_action_meta_boxes_map', 'entropia_edge_map_post_quote_meta', 25 );
}