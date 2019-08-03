<?php

if ( ! function_exists( 'entropia_core_map_portfolio_meta' ) ) {
	function entropia_core_map_portfolio_meta() {
		global $entropia_edge_global_Framework;
		
		$entropia_pages = array();
		$pages      = get_pages();
		foreach ( $pages as $page ) {
			$entropia_pages[ $page->ID ] = $page->post_title;
		}
		
		//Portfolio Images
		
		$entropia_portfolio_images = new EntropiaEdgeClassMetaBox( 'portfolio-item', esc_html__( 'Portfolio Images (multiple upload)', 'entropia-core' ), '', '', 'portfolio_images' );
		$entropia_edge_global_Framework->edgtMetaBoxes->addMetaBox( 'portfolio_images', $entropia_portfolio_images );
		
		$entropia_portfolio_image_gallery = new EntropiaEdgeClassMultipleImages( 'edgtf-portfolio-image-gallery', esc_html__( 'Portfolio Images', 'entropia-core' ), esc_html__( 'Choose your portfolio images', 'entropia-core' ) );
		$entropia_portfolio_images->addChild( 'edgtf-portfolio-image-gallery', $entropia_portfolio_image_gallery );
		
		//Portfolio Single Upload Images/Videos 
		
		$entropia_portfolio_images_videos = entropia_edge_create_meta_box(
			array(
				'scope' => array( 'portfolio-item' ),
				'title' => esc_html__( 'Portfolio Images/Videos (single upload)', 'entropia-core' ),
				'name'  => 'edgtf_portfolio_images_videos'
			)
		);
		entropia_edge_add_repeater_field(
			array(
				'name'        => 'edgtf_portfolio_single_upload',
				'parent'      => $entropia_portfolio_images_videos,
				'button_text' => esc_html__( 'Add Image/Video', 'entropia-core' ),
				'fields'      => array(
					array(
						'type'        => 'select',
						'name'        => 'file_type',
						'label'       => esc_html__( 'File Type', 'entropia-core' ),
						'options' => array(
							'image' => esc_html__('Image','entropia-core'),
							'video' => esc_html__('Video','entropia-core'),
						)
					),
					array(
						'type'        => 'image',
						'name'        => 'single_image',
						'label'       => esc_html__( 'Image', 'entropia-core' ),
						'dependency' => array(
							'show' => array(
								'file_type'  => 'image'
							)
						)
					),
					array(
						'type'        => 'select',
						'name'        => 'video_type',
						'label'       => esc_html__( 'Video Type', 'entropia-core' ),
						'options'	  => array(
							'youtube' => esc_html__('YouTube', 'entropia-core'),
							'vimeo' => esc_html__('Vimeo', 'entropia-core'),
							'self' => esc_html__('Self Hosted', 'entropia-core'),
						),
						'dependency' => array(
							'show' => array(
								'file_type'  => 'video'
							)
						)
					),
					array(
						'type'        => 'text',
						'name'        => 'video_id',
						'label'       => esc_html__( 'Video ID', 'entropia-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => array('youtube','vimeo')
							)
						)
					),
					array(
						'type'        => 'text',
						'name'        => 'video_mp4',
						'label'       => esc_html__( 'Video mp4', 'entropia-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => 'self'
							)
						)
					),
					array(
						'type'        => 'image',
						'name'        => 'video_cover_image',
						'label'       => esc_html__( 'Video Cover Image', 'entropia-core' ),
						'dependency' => array(
							'show' => array(
								'file_type' => 'video',
								'video_type'  => 'self'
							)
						)
					)
				)
			)
		);
		
		//Portfolio Additional Sidebar Items
		
		$entropia_additional_sidebar_items = entropia_edge_create_meta_box(
			array(
				'scope' => array( 'portfolio-item' ),
				'title' => esc_html__( 'Additional Portfolio Sidebar Items', 'entropia-core' ),
				'name'  => 'portfolio_properties'
			)
		);

		entropia_edge_add_repeater_field(
			array(
				'name'        => 'edgtf_portfolio_properties',
				'parent'      => $entropia_additional_sidebar_items,
				'button_text' => esc_html__( 'Add New Item', 'entropia-core' ),
				'fields'      => array(
					array(
						'type'        => 'text',
						'name'        => 'item_title',
						'label'       => esc_html__( 'Item Title', 'entropia-core' ),
					),
					array(
						'type'        => 'text',
						'name'        => 'item_text',
						'label'       => esc_html__( 'Item Text', 'entropia-core' )
					),
					array(
						'type'        => 'text',
						'name'        => 'item_url',
						'label'       => esc_html__( 'Enter Full URL for Item Text Link', 'entropia-core' )
					)
				)
			)
		);
	}
	
	add_action( 'entropia_edge_action_meta_boxes_map', 'entropia_core_map_portfolio_meta', 40 );
}