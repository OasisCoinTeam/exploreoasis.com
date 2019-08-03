<?php

if ( ! function_exists( 'entropia_edge_sidebar_options_map' ) ) {
	function entropia_edge_sidebar_options_map() {
		
		entropia_edge_add_admin_page(
			array(
				'slug'  => '_sidebar_page',
				'title' => esc_html__( 'Sidebar Area', 'entropia' ),
				'icon'  => 'fa fa-indent'
			)
		);
		
		$sidebar_panel = entropia_edge_add_admin_panel(
			array(
				'title' => esc_html__( 'Sidebar Area', 'entropia' ),
				'name'  => 'sidebar',
				'page'  => '_sidebar_page'
			)
		);
		
		entropia_edge_add_admin_field( array(
			'name'          => 'sidebar_layout',
			'type'          => 'select',
			'label'         => esc_html__( 'Sidebar Layout', 'entropia' ),
			'description'   => esc_html__( 'Choose a sidebar layout for pages', 'entropia' ),
			'parent'        => $sidebar_panel,
			'default_value' => 'no-sidebar',
            'options'       => entropia_edge_get_custom_sidebars_options()
		) );
		
		$entropia_custom_sidebars = entropia_edge_get_custom_sidebars();
		if ( count( $entropia_custom_sidebars ) > 0 ) {
			entropia_edge_add_admin_field( array(
				'name'        => 'custom_sidebar_area',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'entropia' ),
				'description' => esc_html__( 'Choose a sidebar to display on pages. Default sidebar is "Sidebar"', 'entropia' ),
				'parent'      => $sidebar_panel,
				'options'     => $entropia_custom_sidebars,
				'args'        => array(
					'select2' => true
				)
			) );
		}
	}
	
	add_action( 'entropia_edge_action_options_map', 'entropia_edge_sidebar_options_map', entropia_edge_set_options_map_position( 'sidebar' ) );
}