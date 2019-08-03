<?php

if ( ! function_exists( 'entropia_edge_disable_behaviors_for_header_vertical' ) ) {
	/**
	 * This function is used to disable sticky header functions that perform processing variables their used in js for this header type
	 */
	function entropia_edge_disable_behaviors_for_header_vertical( $allow_behavior ) {
		return false;
	}
	
	if ( entropia_edge_check_is_header_type_enabled( 'header-vertical', entropia_edge_get_page_id() ) ) {
		add_filter( 'entropia_edge_filter_allow_sticky_header_behavior', 'entropia_edge_disable_behaviors_for_header_vertical' );
		add_filter( 'entropia_edge_filter_allow_content_boxed_layout', 'entropia_edge_disable_behaviors_for_header_vertical' );
	}
}