<?php

if ( ! function_exists( 'entropia_edge_map_general_meta' ) ) {
	function entropia_edge_map_general_meta() {
		
		$general_meta_box = entropia_edge_create_meta_box(
			array(
				'scope' => apply_filters( 'entropia_edge_filter_set_scope_for_meta_boxes', array( 'page', 'post' ), 'general_meta' ),
				'title' => esc_html__( 'General', 'entropia' ),
				'name'  => 'general_meta'
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		entropia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_page_slider_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Slider Shortcode', 'entropia' ),
				'description' => esc_html__( 'Paste your slider shortcode here', 'entropia' ),
				'parent'      => $general_meta_box
			)
		);
		
		/***************** Slider Layout - begin **********************/
		
		/***************** Content Layout - begin **********************/
		
		entropia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_page_content_behind_header_meta',
				'type'          => 'yesno',
				'default_value' => 'no',
				'label'         => esc_html__( 'Always put content behind header', 'entropia' ),
				'description'   => esc_html__( 'Enabling this option will put page content behind page header', 'entropia' ),
				'parent'        => $general_meta_box
			)
		);
		
		$edgtf_content_padding_group = entropia_edge_add_admin_group(
			array(
				'name'        => 'content_padding_group',
				'title'       => esc_html__( 'Content Styles', 'entropia' ),
				'description' => esc_html__( 'Define styles for Content area', 'entropia' ),
				'parent'      => $general_meta_box
			)
		);
		
			$edgtf_content_padding_row = entropia_edge_add_admin_row(
				array(
					'name'   => 'edgtf_content_padding_row',
					'parent' => $edgtf_content_padding_group
				)
			);
			
				entropia_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_page_background_color_meta',
						'type'        => 'colorsimple',
						'label'       => esc_html__( 'Page Background Color', 'entropia' ),
						'parent'      => $edgtf_content_padding_row
					)
				);
				
				entropia_edge_create_meta_box_field(
					array(
						'name'          => 'edgtf_page_background_image_meta',
						'type'          => 'imagesimple',
						'label'         => esc_html__( 'Page Background Image', 'entropia' ),
						'parent'        => $edgtf_content_padding_row
					)
				);
				
				entropia_edge_create_meta_box_field(
					array(
						'name'          => 'edgtf_page_background_repeat_meta',
						'type'          => 'selectsimple',
						'default_value' => '',
						'label'         => esc_html__( 'Page Background Image Repeat', 'entropia' ),
						'options'       => entropia_edge_get_yes_no_select_array(),
						'parent'        => $edgtf_content_padding_row
					)
				);

				entropia_edge_create_meta_box_field(
					array(
						'name'          => 'edgtf_page_background_remove_background_meta',
						'type'          => 'selectsimple',
						'default_value' => '',
						'label'         => esc_html__( 'Page Remove Background Image', 'entropia' ),
						'options'       => entropia_edge_get_yes_no_select_array(),
						'parent'        => $edgtf_content_padding_row
					)
				);
		
			$edgtf_content_padding_row_1 = entropia_edge_add_admin_row(
				array(
					'name'   => 'edgtf_content_padding_row_1',
					'next'   => true,
					'parent' => $edgtf_content_padding_group
				)
			);
		
				entropia_edge_create_meta_box_field(
					array(
						'name'   => 'edgtf_page_content_padding',
						'type'   => 'textsimple',
						'label'  => esc_html__( 'Content Padding (eg. 10px 5px 10px 5px)', 'entropia' ),
						'parent' => $edgtf_content_padding_row_1,
						'args'        => array(
							'col_width' => 4
						)
					)
				);
				
				entropia_edge_create_meta_box_field(
					array(
						'name'    => 'edgtf_page_content_padding_mobile',
						'type'    => 'textsimple',
						'label'   => esc_html__( 'Content Padding for mobile (eg. 10px 5px 10px 5px)', 'entropia' ),
						'parent'  => $edgtf_content_padding_row_1,
						'args'        => array(
							'col_width' => 4
						)
					)
				);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_initial_content_width_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Initial Width of Content', 'entropia' ),
				'description'   => esc_html__( 'Choose the initial width of content which is in grid (Applies to pages set to "Default Template" and rows set to "In Grid")', 'entropia' ),
				'parent'        => $general_meta_box,
				'options'       => array(
					''                => esc_html__( 'Default', 'entropia' ),
                    'edgtf-grid-1100' => esc_html__( '1100px', 'entropia' ),
					'edgtf-grid-1300' => esc_html__( '1300px', 'entropia' ),
					'edgtf-grid-1200' => esc_html__( '1200px', 'entropia' ),
					'edgtf-grid-1000' => esc_html__( '1000px', 'entropia' ),
					'edgtf-grid-800'  => esc_html__( '800px', 'entropia' )
				)
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_page_grid_space_meta',
				'type'        => 'select',
				'default_value' => '',
				'label'       => esc_html__( 'Grid Layout Space', 'entropia' ),
				'description' => esc_html__( 'Choose a space between content layout and sidebar layout for your page', 'entropia' ),
				'options'     => entropia_edge_get_space_between_items_array( true ),
				'parent'      => $general_meta_box
			)
		);
		
		/***************** Content Layout - end **********************/
		
		/***************** Boxed Layout - begin **********************/
		
		entropia_edge_create_meta_box_field(
			array(
				'name'    => 'edgtf_boxed_meta',
				'type'    => 'select',
				'label'   => esc_html__( 'Boxed Layout', 'entropia' ),
				'parent'  => $general_meta_box,
				'options' => entropia_edge_get_yes_no_select_array()
			)
		);
		
			$boxed_container_meta = entropia_edge_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'boxed_container_meta',
					'dependency' => array(
						'hide' => array(
							'edgtf_boxed_meta' => array( '', 'no' )
						)
					)
				)
			);
		
				entropia_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_page_background_color_in_box_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Page Background Color', 'entropia' ),
						'description' => esc_html__( 'Choose the page background color outside box', 'entropia' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				entropia_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_boxed_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Image', 'entropia' ),
						'description' => esc_html__( 'Choose an image to be displayed in background', 'entropia' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				entropia_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_boxed_pattern_background_image_meta',
						'type'        => 'image',
						'label'       => esc_html__( 'Background Pattern', 'entropia' ),
						'description' => esc_html__( 'Choose an image to be used as background pattern', 'entropia' ),
						'parent'      => $boxed_container_meta
					)
				);
				
				entropia_edge_create_meta_box_field(
					array(
						'name'          => 'edgtf_boxed_background_image_attachment_meta',
						'type'          => 'select',
						'default_value' => '',
						'label'         => esc_html__( 'Background Image Attachment', 'entropia' ),
						'description'   => esc_html__( 'Choose background image attachment', 'entropia' ),
						'parent'        => $boxed_container_meta,
						'options'       => array(
							''       => esc_html__( 'Default', 'entropia' ),
							'fixed'  => esc_html__( 'Fixed', 'entropia' ),
							'scroll' => esc_html__( 'Scroll', 'entropia' )
						)
					)
				);
		
		/***************** Boxed Layout - end **********************/
		
		/***************** Passepartout Layout - begin **********************/
		
		entropia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_paspartu_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Passepartout', 'entropia' ),
				'description'   => esc_html__( 'Enabling this option will display passepartout around site content', 'entropia' ),
				'parent'        => $general_meta_box,
				'options'       => entropia_edge_get_yes_no_select_array(),
			)
		);
		
			$paspartu_container_meta = entropia_edge_add_admin_container(
				array(
					'parent'          => $general_meta_box,
					'name'            => 'edgtf_paspartu_container_meta',
					'dependency' => array(
						'hide' => array(
							'edgtf_paspartu_meta'  => array('','no')
						)
					)
				)
			);
		
				entropia_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_paspartu_color_meta',
						'type'        => 'color',
						'label'       => esc_html__( 'Passepartout Color', 'entropia' ),
						'description' => esc_html__( 'Choose passepartout color, default value is #ffffff', 'entropia' ),
						'parent'      => $paspartu_container_meta
					)
				);
				
				entropia_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_paspartu_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Passepartout Size', 'entropia' ),
						'description' => esc_html__( 'Enter size amount for passepartout', 'entropia' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
		
				entropia_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_paspartu_responsive_width_meta',
						'type'        => 'text',
						'label'       => esc_html__( 'Responsive Passepartout Size', 'entropia' ),
						'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (tablets and mobiles view)', 'entropia' ),
						'parent'      => $paspartu_container_meta,
						'args'        => array(
							'col_width' => 2,
							'suffix'    => 'px or %'
						)
					)
				);
				
				entropia_edge_create_meta_box_field(
					array(
						'parent'        => $paspartu_container_meta,
						'type'          => 'select',
						'default_value' => '',
						'name'          => 'edgtf_disable_top_paspartu_meta',
						'label'         => esc_html__( 'Disable Top Passepartout', 'entropia' ),
						'options'       => entropia_edge_get_yes_no_select_array(),
					)
				);
		
				entropia_edge_create_meta_box_field(
					array(
						'parent'        => $paspartu_container_meta,
						'type'          => 'select',
						'default_value' => '',
						'name'          => 'edgtf_enable_fixed_paspartu_meta',
						'label'         => esc_html__( 'Enable Fixed Passepartout', 'entropia' ),
						'description'   => esc_html__( 'Enabling this option will set fixed passepartout for your screens', 'entropia' ),
						'options'       => entropia_edge_get_yes_no_select_array(),
					)
				);
		
		/***************** Passepartout Layout - end **********************/
		
		/***************** Smooth Page Transitions Layout - begin **********************/
		
		entropia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_smooth_page_transitions_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Smooth Page Transitions', 'entropia' ),
				'description'   => esc_html__( 'Enabling this option will perform a smooth transition between pages when clicking on links', 'entropia' ),
				'parent'        => $general_meta_box,
				'options'       => entropia_edge_get_yes_no_select_array()
			)
		);
		
			$page_transitions_container_meta = entropia_edge_add_admin_container(
				array(
					'parent'     => $general_meta_box,
					'name'       => 'page_transitions_container_meta',
					'dependency' => array(
						'hide' => array(
							'edgtf_smooth_page_transitions_meta' => array( '', 'no' )
						)
					)
				)
			);
		
				entropia_edge_create_meta_box_field(
					array(
						'name'        => 'edgtf_page_transition_preloader_meta',
						'type'        => 'select',
						'label'       => esc_html__( 'Enable Preloading Animation', 'entropia' ),
						'description' => esc_html__( 'Enabling this option will display an animated preloader while the page content is loading', 'entropia' ),
						'parent'      => $page_transitions_container_meta,
						'options'     => entropia_edge_get_yes_no_select_array()
					)
				);
		
				$page_transition_preloader_container_meta = entropia_edge_add_admin_container(
					array(
						'parent'     => $page_transitions_container_meta,
						'name'       => 'page_transition_preloader_container_meta',
						'dependency' => array(
							'hide' => array(
								'edgtf_page_transition_preloader_meta' => array( '', 'no' )
							)
						)
					)
				);
				
					entropia_edge_create_meta_box_field(
						array(
							'name'   => 'edgtf_smooth_pt_bgnd_color_meta',
							'type'   => 'color',
							'label'  => esc_html__( 'Page Loader Background Color', 'entropia' ),
							'parent' => $page_transition_preloader_container_meta
						)
					);
					
					$group_pt_spinner_animation_meta = entropia_edge_add_admin_group(
						array(
							'name'        => 'group_pt_spinner_animation_meta',
							'title'       => esc_html__( 'Loader Style', 'entropia' ),
							'description' => esc_html__( 'Define styles for loader spinner animation', 'entropia' ),
							'parent'      => $page_transition_preloader_container_meta
						)
					);
					
					$row_pt_spinner_animation_meta = entropia_edge_add_admin_row(
						array(
							'name'   => 'row_pt_spinner_animation_meta',
							'parent' => $group_pt_spinner_animation_meta
						)
					);
					
					entropia_edge_create_meta_box_field(
						array(
							'type'    => 'selectsimple',
							'name'    => 'edgtf_smooth_pt_spinner_type_meta',
							'label'   => esc_html__( 'Spinner Type', 'entropia' ),
							'parent'  => $row_pt_spinner_animation_meta,
							'options' => array(
								''                      => esc_html__( 'Default', 'entropia' ),
								'rotate_circles'        => esc_html__( 'Rotate Circles', 'entropia' ),
								'pulse'                 => esc_html__( 'Pulse', 'entropia' ),
								'double_pulse'          => esc_html__( 'Double Pulse', 'entropia' ),
								'cube'                  => esc_html__( 'Cube', 'entropia' ),
								'rotating_cubes'        => esc_html__( 'Rotating Cubes', 'entropia' ),
								'stripes'               => esc_html__( 'Stripes', 'entropia' ),
								'wave'                  => esc_html__( 'Wave', 'entropia' ),
								'two_rotating_circles'  => esc_html__( '2 Rotating Circles', 'entropia' ),
								'five_rotating_circles' => esc_html__( '5 Rotating Circles', 'entropia' ),
								'atom'                  => esc_html__( 'Atom', 'entropia' ),
								'clock'                 => esc_html__( 'Clock', 'entropia' ),
								'mitosis'               => esc_html__( 'Mitosis', 'entropia' ),
								'lines'                 => esc_html__( 'Lines', 'entropia' ),
								'fussion'               => esc_html__( 'Fussion', 'entropia' ),
								'wave_circles'          => esc_html__( 'Wave Circles', 'entropia' ),
								'pulse_circles'         => esc_html__( 'Pulse Circles', 'entropia' )
							)
						)
					);
					
					entropia_edge_create_meta_box_field(
						array(
							'type'   => 'colorsimple',
							'name'   => 'edgtf_smooth_pt_spinner_color_meta',
							'label'  => esc_html__( 'Spinner Color', 'entropia' ),
							'parent' => $row_pt_spinner_animation_meta
						)
					);
					
					entropia_edge_create_meta_box_field(
						array(
							'name'        => 'edgtf_page_transition_fadeout_meta',
							'type'        => 'select',
							'label'       => esc_html__( 'Enable Fade Out Animation', 'entropia' ),
							'description' => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'entropia' ),
							'options'     => entropia_edge_get_yes_no_select_array(),
							'parent'      => $page_transitions_container_meta
						
						)
					);
		
		/***************** Smooth Page Transitions Layout - end **********************/
		
		/***************** Comments Layout - begin **********************/
		
		entropia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_page_comments_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Show Comments', 'entropia' ),
				'description' => esc_html__( 'Enabling this option will show comments on your page', 'entropia' ),
				'parent'      => $general_meta_box,
				'options'     => entropia_edge_get_yes_no_select_array()
			)
		);
		
		/***************** Comments Layout - end **********************/
	}
	
	add_action( 'entropia_edge_action_meta_boxes_map', 'entropia_edge_map_general_meta', 10 );
}

if ( ! function_exists( 'entropia_edge_container_background_style' ) ) {
	/**
	 * Function that return container style
	 */
	function entropia_edge_container_background_style( $style ) {
		$page_id      = entropia_edge_get_page_id();
		$class_prefix = entropia_edge_get_unique_page_class( $page_id, true );
		
		$container_selector = array(
			$class_prefix . ' .edgtf-content'
		);
		
		$container_class        = array();
		$page_background_color  = get_post_meta( $page_id, 'edgtf_page_background_color_meta', true );
		$page_background_image  = get_post_meta( $page_id, 'edgtf_page_background_image_meta', true );
		$page_background_repeat = get_post_meta( $page_id, 'edgtf_page_background_repeat_meta', true );
		$page_background_image_clear = get_post_meta( $page_id, 'edgtf_page_background_remove_background_meta', true );

		if ( ! empty( $page_background_color ) ) {
			$container_class['background-color'] = $page_background_color;
		}

		if($page_background_image_clear === 'yes') {
			$container_class['background-image'] = 'none';
		}

		if ( ! empty( $page_background_image ) && $page_background_image_clear !== 'yes') {
			$container_class['background-image'] = 'url(' . esc_url( $page_background_image ) . ')';
			
			if ( $page_background_repeat === 'yes' ) {
				$container_class['background-repeat']   = 'repeat';
				$container_class['background-position'] = '0 0';
			} else {
				$container_class['background-repeat']   = 'no-repeat';
				$container_class['background-position'] = 'center 0';
				$container_class['background-size']     = 'cover';
			}
		}
		
		$current_style = entropia_edge_dynamic_css( $container_selector, $container_class );
		$current_style = $current_style . $style;
		
		return $current_style;
	}
	
	add_filter( 'entropia_edge_filter_add_page_custom_style', 'entropia_edge_container_background_style' );
}