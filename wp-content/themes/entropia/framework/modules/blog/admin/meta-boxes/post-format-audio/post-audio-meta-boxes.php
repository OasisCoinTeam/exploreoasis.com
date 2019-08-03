<?php

if ( ! function_exists( 'entropia_edge_map_post_audio_meta' ) ) {
	function entropia_edge_map_post_audio_meta() {
		$audio_post_format_meta_box = entropia_edge_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Audio Post Format', 'entropia' ),
				'name'  => 'post_format_audio_meta'
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_audio_type_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Audio Type', 'entropia' ),
				'description'   => esc_html__( 'Choose audio type', 'entropia' ),
				'parent'        => $audio_post_format_meta_box,
				'default_value' => 'social_networks',
				'options'       => array(
					'social_networks' => esc_html__( 'Audio Service', 'entropia' ),
					'self'            => esc_html__( 'Self Hosted', 'entropia' )
				)
			)
		);
		
		$edgtf_audio_embedded_container = entropia_edge_add_admin_container(
			array(
				'parent' => $audio_post_format_meta_box,
				'name'   => 'edgtf_audio_embedded_container'
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_post_audio_link_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio URL', 'entropia' ),
				'description' => esc_html__( 'Enter audio URL', 'entropia' ),
				'parent'      => $edgtf_audio_embedded_container,
				'dependency' => array(
					'show' => array(
						'edgtf_audio_type_meta' => 'social_networks'
					)
				)
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_post_audio_custom_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Audio Link', 'entropia' ),
				'description' => esc_html__( 'Enter audio link', 'entropia' ),
				'parent'      => $edgtf_audio_embedded_container,
				'dependency' => array(
					'show' => array(
						'edgtf_audio_type_meta' => 'self'
					)
				)
			)
		);
	}
	
	add_action( 'entropia_edge_action_meta_boxes_map', 'entropia_edge_map_post_audio_meta', 23 );
}