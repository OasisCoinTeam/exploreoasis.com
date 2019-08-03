<?php

if ( ! function_exists( 'entropia_core_map_masonry_gallery_meta' ) ) {
	function entropia_core_map_masonry_gallery_meta() {
		
		$masonry_gallery_meta_box = entropia_edge_create_meta_box(
			array(
				'scope' => array( 'masonry-gallery' ),
				'title' => esc_html__( 'Masonry Gallery General', 'entropia-core' ),
				'name'  => 'masonry_gallery_meta'
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_masonry_gallery_item_title_tag',
				'type'          => 'select',
				'default_value' => 'h4',
				'label'         => esc_html__( 'Title Tag', 'entropia-core' ),
				'parent'        => $masonry_gallery_meta_box,
				'options'       => entropia_edge_get_title_tag()
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'   => 'edgtf_masonry_gallery_item_text',
				'type'   => 'text',
				'label'  => esc_html__( 'Text', 'entropia-core' ),
				'parent' => $masonry_gallery_meta_box
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'   => 'edgtf_masonry_gallery_item_image',
				'type'   => 'image',
				'label'  => esc_html__( 'Custom Item Icon', 'entropia-core' ),
				'parent' => $masonry_gallery_meta_box
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'   => 'edgtf_masonry_gallery_item_link',
				'type'   => 'text',
				'label'  => esc_html__( 'Link', 'entropia-core' ),
				'parent' => $masonry_gallery_meta_box
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_masonry_gallery_item_link_target',
				'type'          => 'select',
				'default_value' => '_self',
				'label'         => esc_html__( 'Link Target', 'entropia-core' ),
				'parent'        => $masonry_gallery_meta_box,
				'options'       => entropia_edge_get_link_target_array()
			)
		);
		
		entropia_edge_add_admin_section_title( array(
			'name'   => 'edgtf_section_style_title',
			'parent' => $masonry_gallery_meta_box,
			'title'  => esc_html__( 'Masonry Gallery Item Style', 'entropia-core' )
		) );
		
		entropia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_masonry_gallery_item_size',
				'type'          => 'select',
				'default_value' => 'small',
				'label'         => esc_html__( 'Size', 'entropia-core' ),
				'parent'        => $masonry_gallery_meta_box,
				'options'       => array(
					'small'              => esc_html__( 'Small', 'entropia-core' ),
					'large-width'        => esc_html__( 'Large Width', 'entropia-core' ),
					'large-height'       => esc_html__( 'Large Height', 'entropia-core' ),
					'large-width-height' => esc_html__( 'Large Width/Height', 'entropia-core' )
				)
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_masonry_gallery_item_type',
				'type'          => 'select',
				'default_value' => 'standard',
				'label'         => esc_html__( 'Type', 'entropia-core' ),
				'parent'        => $masonry_gallery_meta_box,
				'options'       => array(
					'standard'    => esc_html__( 'Standard', 'entropia-core' ),
					'with-button' => esc_html__( 'With Button', 'entropia-core' ),
					'simple'      => esc_html__( 'Simple', 'entropia-core' )
				)
			)
		);
		
		$masonry_gallery_item_button_type_container = entropia_edge_add_admin_container_no_style(
			array(
				'name'            => 'masonry_gallery_item_button_type_container',
				'parent'          => $masonry_gallery_meta_box,
				'dependency' => array(
					'hide' => array(
						'edgtf_masonry_gallery_item_type'  => array( 'standard', 'simple' )
					)
				)
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'   => 'edgtf_masonry_gallery_button_label',
				'type'   => 'text',
				'label'  => esc_html__( 'Button Label', 'entropia-core' ),
				'parent' => $masonry_gallery_item_button_type_container
			)
		);
		
		$masonry_gallery_item_simple_type_container = entropia_edge_add_admin_container_no_style(
			array(
				'name'            => 'masonry_gallery_item_simple_type_container',
				'parent'          => $masonry_gallery_meta_box,
				'dependency' => array(
					'hide' => array(
						'edgtf_masonry_gallery_item_type'  => array( 'standard', 'with-button' )
					)
				)
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_masonry_gallery_simple_content_background_skin',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Content Background Skin', 'entropia-core' ),
				'parent'        => $masonry_gallery_item_simple_type_container,
				'options'       => array(
					'default' => esc_html__( 'Default', 'entropia-core' ),
					'light'   => esc_html__( 'Light', 'entropia-core' ),
					'dark'    => esc_html__( 'Dark', 'entropia-core' )
				)
			)
		);
	}
	
	add_action( 'entropia_edge_action_meta_boxes_map', 'entropia_core_map_masonry_gallery_meta', 45 );
}