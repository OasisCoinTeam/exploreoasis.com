<?php

if ( ! function_exists( 'entropia_core_team_meta_box_functions' ) ) {
	function entropia_core_team_meta_box_functions( $post_types ) {
		$post_types[] = 'team-member';
		
		return $post_types;
	}
	
	add_filter( 'entropia_edge_filter_meta_box_post_types_save', 'entropia_core_team_meta_box_functions' );
	add_filter( 'entropia_edge_filter_meta_box_post_types_remove', 'entropia_core_team_meta_box_functions' );
}

if ( ! function_exists( 'entropia_core_team_scope_meta_box_functions' ) ) {
	function entropia_core_team_scope_meta_box_functions( $post_types ) {
		$post_types[] = 'team-member';
		
		return $post_types;
	}
	
	add_filter( 'entropia_edge_filter_set_scope_for_meta_boxes', 'entropia_core_team_scope_meta_box_functions' );
}

if ( ! function_exists( 'entropia_core_team_enqueue_meta_box_styles' ) ) {
	function entropia_core_team_enqueue_meta_box_styles() {
		global $post;
		
		if ( $post->post_type == 'team-member' ) {
			wp_enqueue_style( 'edgtf-jquery-ui', get_template_directory_uri() . '/framework/admin/assets/css/jquery-ui/jquery-ui.css' );
		}
	}
	
	add_action( 'entropia_edge_action_enqueue_meta_box_styles', 'entropia_core_team_enqueue_meta_box_styles' );
}

if ( ! function_exists( 'entropia_core_register_team_cpt' ) ) {
	function entropia_core_register_team_cpt( $cpt_class_name ) {
		$cpt_class = array(
			'EntropiaCore\CPT\Team\TeamRegister'
		);
		
		$cpt_class_name = array_merge( $cpt_class_name, $cpt_class );
		
		return $cpt_class_name;
	}
	
	add_filter( 'entropia_core_filter_register_custom_post_types', 'entropia_core_register_team_cpt' );
}

// Load team shortcodes
if ( ! function_exists( 'entropia_core_include_team_shortcodes_files' ) ) {
	/**
	 * Loades all shortcodes by going through all folders that are placed directly in shortcodes folder
	 */
	function entropia_core_include_team_shortcodes_files() {
		foreach ( glob( ENTROPIA_CORE_CPT_PATH . '/team/shortcodes/*/load.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
	}
	
	add_action( 'entropia_core_action_include_shortcodes_file', 'entropia_core_include_team_shortcodes_files' );
}

if ( ! function_exists( 'entropia_core_get_single_team' ) ) {
	/**
	 * Loads holder template for doctor single
	 */
	function entropia_core_get_single_team() {
		$team_member_id = get_the_ID();
		
		$params = array(
			'sidebar_layout' => entropia_edge_sidebar_layout(),
			'position'       => get_post_meta( $team_member_id, 'edgtf_team_member_position', true ),
			'birth_date'     => get_post_meta( $team_member_id, 'edgtf_team_member_birth_date', true ),
			'email'          => get_post_meta( $team_member_id, 'edgtf_team_member_email', true ),
			'phone'          => get_post_meta( $team_member_id, 'edgtf_team_member_phone', true ),
			'address'        => get_post_meta( $team_member_id, 'edgtf_team_member_address', true ),
			'education'      => get_post_meta( $team_member_id, 'edgtf_team_member_education', true ),
			'resume'         => get_post_meta( $team_member_id, 'edgtf_team_member_resume', true ),
			'social_icons'   => entropia_core_single_team_social_icons( $team_member_id ),
		);
		
		entropia_core_get_cpt_single_module_template_part( 'templates/single/holder', 'team', '', $params );
	}
}

if ( ! function_exists( 'entropia_core_single_team_social_icons' ) ) {
	function entropia_core_single_team_social_icons( $id ) {
		$social_icons = array();
		
		for ( $i = 1; $i < 6; $i ++ ) {
			$team_icon_pack = get_post_meta( $id, 'edgtf_team_member_social_icon_pack_' . $i, true );
			if ( $team_icon_pack !== '' ) {
				$team_icon_collection = entropia_edge_icon_collections()->getIconCollection( get_post_meta( $id, 'edgtf_team_member_social_icon_pack_' . $i, true ) );
				$team_social_icon     = get_post_meta( $id, 'edgtf_team_member_social_icon_pack_' . $i . '_' . $team_icon_collection->param, true );
				$team_social_link     = get_post_meta( $id, 'edgtf_team_member_social_icon_' . $i . '_link', true );
				$team_social_target   = get_post_meta( $id, 'edgtf_team_member_social_icon_' . $i . '_target', true );
				
				if ( $team_social_icon !== '' ) {
					$team_icon_params                                 = array();
					$team_icon_params['icon_pack']                    = $team_icon_pack;
					$team_icon_params[ $team_icon_collection->param ] = $team_social_icon;
					$team_icon_params['link']                         = ! empty( $team_social_link ) ? $team_social_link : '';
					$team_icon_params['target']                       = ! empty( $team_social_target ) ? $team_social_target : '_self';
					
					$social_icons[] = entropia_edge_execute_shortcode( 'edgtf_icon', $team_icon_params );
				}
			}
		}
		
		return $social_icons;
	}
}

if ( ! function_exists( 'entropia_core_get_team_category_list' ) ) {
	function entropia_core_get_team_category_list( $category = '' ) {
		$number_of_columns = 3;
		
		$params = array(
			'number_of_columns' => $number_of_columns
		);
		
		if ( ! empty( $category ) ) {
			$params['category'] = $category;
		}
		
		$html = entropia_edge_execute_shortcode( 'edgtf_team_list', $params );
		
		print $html;
	}
}

if ( ! function_exists( 'entropia_core_add_team_to_search_types' ) ) {
	function entropia_core_add_team_to_search_types( $post_types ) {
		$post_types['team-member'] = esc_html__( 'Team Member', 'entropia-core' );
		
		return $post_types;
	}
	
	add_filter( 'entropia_edge_filter_search_post_type_widget_params_post_type', 'entropia_core_add_team_to_search_types' );
}