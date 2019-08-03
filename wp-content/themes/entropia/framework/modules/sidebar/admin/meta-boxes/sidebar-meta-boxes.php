<?php

if ( ! function_exists( 'entropia_edge_map_sidebar_meta' ) ) {
	function entropia_edge_map_sidebar_meta() {
		$edgtf_sidebar_meta_box = entropia_edge_create_meta_box(
			array(
				'scope' => apply_filters( 'entropia_edge_filter_set_scope_for_meta_boxes', array( 'page' ), 'sidebar_meta' ),
				'title' => esc_html__( 'Sidebar', 'entropia' ),
				'name'  => 'sidebar_meta'
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_sidebar_layout_meta',
				'type'        => 'select',
				'label'       => esc_html__( 'Sidebar Layout', 'entropia' ),
				'description' => esc_html__( 'Choose the sidebar layout', 'entropia' ),
				'parent'      => $edgtf_sidebar_meta_box,
                'options'       => entropia_edge_get_custom_sidebars_options( true )
			)
		);
		
		$edgtf_custom_sidebars = entropia_edge_get_custom_sidebars();
		if ( count( $edgtf_custom_sidebars ) > 0 ) {
			entropia_edge_create_meta_box_field(
				array(
					'name'        => 'edgtf_custom_sidebar_area_meta',
					'type'        => 'selectblank',
					'label'       => esc_html__( 'Choose Widget Area in Sidebar', 'entropia' ),
					'description' => esc_html__( 'Choose Custom Widget area to display in Sidebar"', 'entropia' ),
					'parent'      => $edgtf_sidebar_meta_box,
					'options'     => $edgtf_custom_sidebars,
					'args'        => array(
						'select2' => true
					)
				)
			);
		}
	}
	
	add_action( 'entropia_edge_action_meta_boxes_map', 'entropia_edge_map_sidebar_meta', 31 );
}