<?php

if ( ! function_exists( 'entropia_edge_set_search_fullscreen_global_option' ) ) {
    /**
     * This function set search type value for search options map
     */
    function entropia_edge_set_search_fullscreen_global_option( $search_type_options ) {
        $search_type_options['fullscreen'] = esc_html__( 'Fullscreen', 'entropia' );

        return $search_type_options;
    }

    add_filter( 'entropia_edge_filter_search_type_global_option', 'entropia_edge_set_search_fullscreen_global_option' );
}

if ( ! function_exists( 'entropia_edge_search_background_fullscreen' ) ) {
	/**
	 * Add dependency for 'search_background_image' field type
	 * @param $dependency_array
	 * * @return array modified array of dependecies
	 */
	function entropia_edge_search_background_fullscreen($dependency_array) {

		$dependency_array[] = 'fullscreen';

		return $dependency_array;
	}

	add_filter( 'search_background_image_dependency', 'entropia_edge_search_background_fullscreen' );
}