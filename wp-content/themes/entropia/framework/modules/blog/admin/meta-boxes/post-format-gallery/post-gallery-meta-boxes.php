<?php

if ( ! function_exists( 'entropia_edge_map_post_gallery_meta' ) ) {
	
	function entropia_edge_map_post_gallery_meta() {
		$gallery_post_format_meta_box = entropia_edge_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Gallery Post Format', 'entropia' ),
				'name'  => 'post_format_gallery_meta'
			)
		);
		
		entropia_edge_add_multiple_images_field(
			array(
				'name'        => 'edgtf_post_gallery_images_meta',
				'label'       => esc_html__( 'Gallery Images', 'entropia' ),
				'description' => esc_html__( 'Choose your gallery images', 'entropia' ),
				'parent'      => $gallery_post_format_meta_box,
			)
		);
	}
	
	add_action( 'entropia_edge_action_meta_boxes_map', 'entropia_edge_map_post_gallery_meta', 21 );
}
