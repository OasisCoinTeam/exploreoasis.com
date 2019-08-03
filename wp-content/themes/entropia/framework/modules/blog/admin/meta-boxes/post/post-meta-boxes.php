<?php

/*** Post Settings ***/

if ( ! function_exists( 'entropia_edge_map_post_meta' ) ) {
	function entropia_edge_map_post_meta() {
		
		$post_meta_box = entropia_edge_create_meta_box(
			array(
				'scope' => array( 'post' ),
				'title' => esc_html__( 'Post', 'entropia' ),
				'name'  => 'post-meta'
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_show_title_area_blog_meta',
				'type'          => 'select',
				'default_value' => '',
				'label'         => esc_html__( 'Show Title Area', 'entropia' ),
				'description'   => esc_html__( 'Enabling this option will show title area on your single post page', 'entropia' ),
				'parent'        => $post_meta_box,
				'options'       => entropia_edge_get_yes_no_select_array()
			)
		);
		
		entropia_edge_create_meta_box_field(
			array(
				'name'          => 'edgtf_blog_single_sidebar_layout_meta',
				'type'          => 'select',
				'label'         => esc_html__( 'Sidebar Layout', 'entropia' ),
				'description'   => esc_html__( 'Choose a sidebar layout for Blog single page', 'entropia' ),
				'default_value' => '',
				'parent'        => $post_meta_box,
                'options'       => entropia_edge_get_custom_sidebars_options( true )
			)
		);
		
		$entropia_custom_sidebars = entropia_edge_get_custom_sidebars();
		if ( count( $entropia_custom_sidebars ) > 0 ) {
			entropia_edge_create_meta_box_field( array(
				'name'        => 'edgtf_blog_single_custom_sidebar_area_meta',
				'type'        => 'selectblank',
				'label'       => esc_html__( 'Sidebar to Display', 'entropia' ),
				'description' => esc_html__( 'Choose a sidebar to display on Blog single page. Default sidebar is "Sidebar"', 'entropia' ),
				'parent'      => $post_meta_box,
				'options'     => entropia_edge_get_custom_sidebars(),
				'args' => array(
					'select2' => true
				)
			) );
		}
		
		entropia_edge_create_meta_box_field(
			array(
				'name'        => 'edgtf_blog_list_featured_image_meta',
				'type'        => 'image',
				'label'       => esc_html__( 'Blog List Image', 'entropia' ),
				'description' => esc_html__( 'Choose an Image for displaying in blog list. If not uploaded, featured image will be shown.', 'entropia' ),
				'parent'      => $post_meta_box
			)
		);

		do_action('entropia_edge_action_blog_post_meta', $post_meta_box);
	}
	
	add_action( 'entropia_edge_action_meta_boxes_map', 'entropia_edge_map_post_meta', 20 );
}
