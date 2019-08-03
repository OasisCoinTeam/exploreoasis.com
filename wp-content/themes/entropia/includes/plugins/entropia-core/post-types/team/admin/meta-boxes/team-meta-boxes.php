<?php

if ( ! function_exists( 'entropia_core_map_team_single_meta' ) ) {
	function entropia_core_map_team_single_meta() {
		
		$meta_box = entropia_edge_create_meta_box(
			array(
				'scope' => 'team-member',
				'title' => esc_html__( 'Team Member Info', 'entropia-core' ),
				'name'  => 'team_meta'
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_team_member_position',
				'type'        => 'text',
				'label'       => esc_html__( 'Position', 'entropia-core' ),
				'description' => esc_html__( 'The members\'s role within the team', 'entropia-core' ),
				'parent'      => $meta_box
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_team_member_birth_date',
				'type'        => 'date',
				'label'       => esc_html__( 'Birth date', 'entropia-core' ),
				'description' => esc_html__( 'The members\'s birth date', 'entropia-core' ),
				'parent'      => $meta_box
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_team_member_email',
				'type'        => 'text',
				'label'       => esc_html__( 'Email', 'entropia-core' ),
				'description' => esc_html__( 'The members\'s email', 'entropia-core' ),
				'parent'      => $meta_box
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_team_member_phone',
				'type'        => 'text',
				'label'       => esc_html__( 'Phone', 'entropia-core' ),
				'description' => esc_html__( 'The members\'s phone', 'entropia-core' ),
				'parent'      => $meta_box
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_team_member_address',
				'type'        => 'text',
				'label'       => esc_html__( 'Address', 'entropia-core' ),
				'description' => esc_html__( 'The members\'s addres', 'entropia-core' ),
				'parent'      => $meta_box
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_team_member_education',
				'type'        => 'text',
				'label'       => esc_html__( 'Education', 'entropia-core' ),
				'description' => esc_html__( 'The members\'s education', 'entropia-core' ),
				'parent'      => $meta_box
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_team_member_resume',
				'type'        => 'file',
				'label'       => esc_html__( 'Resume', 'entropia-core' ),
				'description' => esc_html__( 'Upload members\'s resume', 'entropia-core' ),
				'parent'      => $meta_box
			)
		);
		
		for ( $x = 1; $x < 6; $x ++ ) {
			
			$social_icon_group = entropia_edge_add_admin_group(
				array(
					'name'   => 'edgtf_team_member_social_icon_group' . $x,
					'title'  => esc_html__( 'Social Link ', 'entropia-core' ) . $x,
					'parent' => $meta_box
				)
			);
			
			$social_row1 = entropia_edge_add_admin_row(
				array(
					'name'   => 'edgtf_team_member_social_icon_row1' . $x,
					'parent' => $social_icon_group
				)
			);
			
			entropia_edge_icon_collections()->getIconsMetaBoxOrOption(
				array(
					'label'            => esc_html__( 'Icon ', 'entropia-core' ) . $x,
					'parent'           => $social_row1,
					'name'             => 'edgtf_team_member_social_icon_pack_' . $x,
					'defaul_icon_pack' => '',
					'type'             => 'meta-box',
					'field_type'       => 'simple'
				)
			);
			
			$social_row2 = entropia_edge_add_admin_row(
				array(
					'name'   => 'edgtf_team_member_social_icon_row2' . $x,
					'parent' => $social_icon_group
				)
			);
			
			entropia_edge_create_meta_box_field(
				array(
					'type'            => 'textsimple',
					'label'           => esc_html__( 'Link', 'entropia-core' ),
					'name'            => 'edgtf_team_member_social_icon_' . $x . '_link',
					'parent'          => $social_row2,
					'dependency' => array(
						'hide' => array(
							'edgtf_team_member_social_icon_pack_'. $x  => ''
						)
					)
				)
			);
			
			entropia_edge_create_meta_box_field(
				array(
					'type'            => 'selectsimple',
					'label'           => esc_html__( 'Target', 'entropia-core' ),
					'name'            => 'edgtf_team_member_social_icon_' . $x . '_target',
					'options'         => entropia_edge_get_link_target_array(),
					'parent'          => $social_row2,
					'dependency' => array(
						'hide' => array(
							'edgtf_team_member_social_icon_' . $x . '_link'  => ''
						)
					)
				)
			);
		}
	}
	
	add_action( 'entropia_edge_action_meta_boxes_map', 'entropia_core_map_team_single_meta', 46 );
}