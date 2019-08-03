<?php

if ( ! function_exists( 'entropia_edge_register_header_standard_type' ) ) {
	/**
	 * This function is used to register header type class for header factory file
	 */
	function entropia_edge_register_header_standard_type( $header_types ) {
		$header_type = array(
			'header-standard' => 'EntropiaEdgeNamespace\Modules\Header\Types\HeaderStandard'
		);
		
		$header_types = array_merge( $header_types, $header_type );
		
		return $header_types;
	}
}

if ( ! function_exists( 'entropia_edge_init_register_header_standard_type' ) ) {
	/**
	 * This function is used to wait header-function.php file to init header object and then to init hook registration function above
	 */
	function entropia_edge_init_register_header_standard_type() {
		add_filter( 'entropia_edge_filter_register_header_type_class', 'entropia_edge_register_header_standard_type' );
	}
	
	add_action( 'entropia_edge_action_before_header_function_init', 'entropia_edge_init_register_header_standard_type' );
}