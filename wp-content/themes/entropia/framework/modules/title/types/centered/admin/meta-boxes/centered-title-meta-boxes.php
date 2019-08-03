<?php

if ( ! function_exists( 'entropia_edge_centered_title_type_options_meta_boxes' ) ) {
	function entropia_edge_centered_title_type_options_meta_boxes( $show_title_area_meta_container ) {
		
		entropia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_subtitle_side_padding_meta',
				'type'        => 'text',
				'label'       => esc_html__( 'Subtitle Side Padding', 'entropia' ),
				'description' => esc_html__( 'Set left/right padding for subtitle area', 'entropia' ),
				'parent'      => $show_title_area_meta_container,
				'args'        => array(
					'col_width' => 2,
					'suffix'    => 'px or %'
				)
			)
		);
	}
	
	add_action( 'entropia_edge_action_additional_title_area_meta_boxes', 'entropia_edge_centered_title_type_options_meta_boxes', 5 );
}