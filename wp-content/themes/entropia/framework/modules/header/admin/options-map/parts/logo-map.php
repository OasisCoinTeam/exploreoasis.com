<?php

if ( ! function_exists( 'entropia_edge_logo_options_map' ) ) {
	function entropia_edge_logo_options_map() {
		
		entropia_edge_add_admin_page(
			array(
				'slug'  => '_logo_page',
				'title' => esc_html__( 'Logo', 'entropia' ),
				'icon'  => 'fa fa-coffee'
			)
		);
		
		$panel_logo = entropia_edge_add_admin_panel(
			array(
				'page'  => '_logo_page',
				'name'  => 'panel_logo',
				'title' => esc_html__( 'Logo', 'entropia' )
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'parent'        => $panel_logo,
				'type'          => 'yesno',
				'name'          => 'hide_logo',
				'default_value' => 'no',
				'label'         => esc_html__( 'Hide Logo', 'entropia' ),
				'description'   => esc_html__( 'Enabling this option will hide logo image', 'entropia' )
			)
		);
		
		$hide_logo_container = entropia_edge_add_admin_container(
			array(
				'parent'          => $panel_logo,
				'name'            => 'hide_logo_container',
				'dependency' => array(
					'hide' => array(
						'hide_logo'  => 'yes'
					)
				)
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'name'          => 'logo_image',
				'type'          => 'image',
				'default_value' => EDGE_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Default', 'entropia' ),
				'parent'        => $hide_logo_container
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'name'          => 'logo_image_dark',
				'type'          => 'image',
				'default_value' => EDGE_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Dark', 'entropia' ),
				'parent'        => $hide_logo_container
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'name'          => 'logo_image_light',
				'type'          => 'image',
				'default_value' => EDGE_ASSETS_ROOT . "/img/logo_white.png",
				'label'         => esc_html__( 'Logo Image - Light', 'entropia' ),
				'parent'        => $hide_logo_container
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'name'          => 'logo_image_sticky',
				'type'          => 'image',
				'default_value' => EDGE_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Sticky', 'entropia' ),
				'parent'        => $hide_logo_container
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'name'          => 'logo_image_mobile',
				'type'          => 'image',
				'default_value' => EDGE_ASSETS_ROOT . "/img/logo.png",
				'label'         => esc_html__( 'Logo Image - Mobile', 'entropia' ),
				'parent'        => $hide_logo_container
			)
		);
	}
	
	add_action( 'entropia_edge_action_options_map', 'entropia_edge_logo_options_map', entropia_edge_set_options_map_position( 'logo' ) );
}