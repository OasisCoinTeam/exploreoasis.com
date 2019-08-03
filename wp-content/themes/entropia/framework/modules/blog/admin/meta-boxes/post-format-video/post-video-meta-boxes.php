<?php

if ( ! function_exists( 'entropia_edge_map_post_video_meta' ) ) {
	function entropia_edge_map_post_video_meta() {
		$video_post_format_meta_box = entropia_edge_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Video Post Format', 'entropia' ),
				'name'  => 'post_format_video_meta'
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_video_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Video Type', 'entropia' ),
				'description'   => esc_html__( 'Choose video type', 'entropia' ),
				'parent'        => $video_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Video Service', 'entropia' ),
					'self'            => esc_html__( 'Self Hosted', 'entropia' )
				)
			)
		);
		
		$edgtf_video_embedded_container = entropia_edge_add_admin_container(
			array(
				'parent' => $video_post_format_meta_box,
				'name'   => 'edgtf_video_embedded_container'
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_post_video_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video URL', 'entropia' ),
				'description' => esc_html__( 'Enter Video URL', 'entropia' ),
				'parent'      => $edgtf_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'edgtf_video_type_meta' => 'social_networks'
					)
				)
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_post_video_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Video MP4', 'entropia' ),
				'description' => esc_html__( 'Enter video URL for MP4 format', 'entropia' ),
				'parent'      => $edgtf_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'edgtf_video_type_meta' => 'self'
					)
				)
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_post_video_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Video Image', 'entropia' ),
				'description' => esc_html__( 'Enter video image', 'entropia' ),
				'parent'      => $edgtf_video_embedded_container,
				'dependency' => array(
					'show' => array(
						'edgtf_video_type_meta' => 'self'
					)
				)
			)
		);
	}
	
	add_action( 'entropia_edge_action_meta_boxes_map', 'entropia_edge_map_post_video_meta', 22 );
}