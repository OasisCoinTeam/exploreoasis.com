<?php

if ( ! function_exists( 'entropia_edge_get_content_bottom_area' ) ) {
	/**
	 * Loads content bottom area HTML with all needed parameters
	 */
	function entropia_edge_get_content_bottom_area() {
		$parameters = array();
		
		//Current page id
		$id = entropia_edge_get_page_id();
		
		//is content bottom area enabled for current page?
		$parameters['content_bottom_area'] = entropia_edge_get_meta_field_intersect( 'enable_content_bottom_area', $id );
		
		if ( $parameters['content_bottom_area'] === 'yes' ) {
			
			//Sidebar for content bottom area
			$parameters['content_bottom_area_sidebar'] = entropia_edge_get_meta_field_intersect( 'content_bottom_sidebar_custom_display', $id );
			//Content bottom area in grid
			$parameters['grid_class'] = ( entropia_edge_get_meta_field_intersect( 'content_bottom_in_grid', $id ) ) === 'yes' ? 'edgtf-grid' : 'edgtf-full-width';
			//Content bottom area in full height
			$parameters['full_height_class'] = ( entropia_edge_get_meta_field_intersect( 'content_bottom_fullheight', $id ) ) === 'yes' ? 'edgtf-fullheight' : '';
			
			$parameters['content_bottom_style'] = array();
			
			//Content bottom area background color
			$background_color = entropia_edge_get_meta_field_intersect( 'content_bottom_background_color', $id );
            $background_image = entropia_edge_get_meta_field_intersect( 'content_bottom_background_image', $id );
			if ( $background_color !== '' ) {
				$parameters['content_bottom_style'][] = 'background-color: ' . $background_color;
			}
            if ( $background_image !== '' ) {
                $parameters['content_bottom_style'][] = 'background-image: url(' . $background_image . ')';
            }
			
			if ( is_active_sidebar( $parameters['content_bottom_area_sidebar'] ) ) {
				entropia_edge_get_module_template_part( 'templates/content-bottom-area', 'content-bottom', '', $parameters );
			}
		}
	}
	
	add_action( 'entropia_edge_action_before_footer_content', 'entropia_edge_get_content_bottom_area' );
}