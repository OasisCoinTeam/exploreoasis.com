<?php

if ( ! function_exists( 'entropia_edge_set_additional_hide_dep_options_for_fixed_header' ) ) {
	/**
	 * This function is used to set dependency values for fixed header panel in global option if sticky header behavior is set
	 */
	function entropia_edge_set_additional_hide_dep_options_for_fixed_header( $hide_dep_options ) {
		$hide_dep_options[] = 'sticky-header-on-scroll-up';
		$hide_dep_options[] = 'sticky-header-on-scroll-down-up';
		
		return $hide_dep_options;
	}
	
	add_filter( 'entropia_edge_filter_fixed_header_additional_hide_global_option', 'entropia_edge_set_additional_hide_dep_options_for_fixed_header' );
}