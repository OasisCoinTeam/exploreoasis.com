<?php

if ( ! function_exists( 'entropia_edge_include_blog_shortcodes' ) ) {
	function entropia_edge_include_blog_shortcodes() {
		foreach ( glob( EDGE_FRAMEWORK_MODULES_ROOT_DIR . '/blog/shortcodes/*/load.php' ) as $shortcode_load ) {
			include_once $shortcode_load;
		}
	}
	
	if ( entropia_edge_core_plugin_installed() ) {
		add_action( 'entropia_core_action_include_shortcodes_file', 'entropia_edge_include_blog_shortcodes' );
	}
}
