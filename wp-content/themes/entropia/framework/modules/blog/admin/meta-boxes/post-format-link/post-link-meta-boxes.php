<?php

if ( ! function_exists( 'entropia_edge_map_post_link_meta' ) ) {
	function entropia_edge_map_post_link_meta() {
		$link_post_format_meta_box = entropia_edge_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Link Post Format', 'entropia' ),
				'name'  => 'post_format_link_meta'
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_post_link_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Link', 'entropia' ),
				'description' => esc_html__( 'Enter link', 'entropia' ),
				'parent'      => $link_post_format_meta_box
			)
		);

        entropia_edge_create_meta_box_field(
            array(
                'name'        => 'edgtf_post_link_bg_image_meta',
                'type'        => 'image',
                'label'       => esc_html__( 'Link Background Image', 'entropia' ),
                'description' => esc_html__( 'Upload background image for link', 'entropia' ),
                'parent'      => $link_post_format_meta_box
            )
        );
	}
	
	add_action( 'entropia_edge_action_meta_boxes_map', 'entropia_edge_map_post_link_meta', 24 );
}