<?php

if ( ! function_exists( 'entropia_edge_search_body_class' ) ) {
	/**
	 * Function that adds body classes for different search types
	 *
	 * @param $classes array original array of body classes
	 *
	 * @return array modified array of classes
	 */
	function entropia_edge_search_body_class( $classes ) {
		$classes[] = 'edgtf-search-covers-header';
		
		return $classes;
	}
	
	add_filter( 'body_class', 'entropia_edge_search_body_class' );
}

if ( ! function_exists( 'entropia_edge_get_search' ) ) {
	/**
	 * Loads search HTML based on search type option.
	 */
	function entropia_edge_get_search() {
		entropia_edge_load_search_template();
	}
	
	add_action( 'entropia_edge_action_before_page_header_html_close', 'entropia_edge_get_search' );
	add_action( 'entropia_edge_action_before_mobile_header_html_close', 'entropia_edge_get_search' );
}

if ( ! function_exists( 'entropia_edge_load_search_template' ) ) {
	/**
	 * Loads search HTML based on search type option.
	 */
	function entropia_edge_load_search_template() {

		$search_in_grid   = entropia_edge_options()->getOptionValue( 'search_in_grid' ) == 'yes' ? true : false;
		
		$parameters = array(
			'search_in_grid'    		=> $search_in_grid,
			'search_close_icon_class' 	=> entropia_edge_get_search_close_icon_class()
		);
		
		entropia_edge_get_module_template_part( 'types/covers-header/templates/covers-header', 'search', '', $parameters );
	}
}