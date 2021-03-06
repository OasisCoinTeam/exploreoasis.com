<?php

if ( ! function_exists( 'entropia_edge_load_widget_class' ) ) {
    /**
     * Loades widget class file.
     */
    function entropia_edge_load_widget_class() {
        include_once EDGE_FRAMEWORK_MODULES_ROOT_DIR . '/widgets/lib/widget-class.php';
    }

    add_action( 'entropia_edge_action_before_options_map', 'entropia_edge_load_widget_class' );
}

if ( ! function_exists( 'entropia_edge_load_modules' ) ) {
	/**
	 * Loades all modules by going through all folders that are placed directly in modules folder
	 * and loads load.php file in each. Hooks to entropia_edge_action_after_options_map action
	 *
	 * @see http://php.net/manual/en/function.glob.php
	 */
	function entropia_edge_load_modules() {
		foreach ( glob( EDGE_FRAMEWORK_ROOT_DIR . '/modules/*/load.php' ) as $module_load ) {
			include_once $module_load;
		}
	}
	
	add_action( 'entropia_edge_action_before_options_map', 'entropia_edge_load_modules' );
}

if ( ! function_exists( 'entropia_edge_load_widgets' ) ) {
	/**
	 * Loades all widgets by going through all folders that are placed directly in widgets folder
	 * and loads load.php file in each. Hooks to entropia_edge_action_after_options_map action
	 */
	function entropia_edge_load_widgets() {
		
		foreach ( glob( EDGE_FRAMEWORK_ROOT_DIR . '/modules/widgets/*/load.php' ) as $widget_load ) {
			include_once $widget_load;
		}
		
		include_once EDGE_FRAMEWORK_MODULES_ROOT_DIR . '/widgets/lib/widget-loader.php';
	}
	
	add_action( 'entropia_edge_action_before_options_map', 'entropia_edge_load_widgets' );
}