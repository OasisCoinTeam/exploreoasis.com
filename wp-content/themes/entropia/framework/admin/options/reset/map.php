<?php

if ( ! function_exists( 'entropia_edge_reset_options_map' ) ) {
	/**
	 * Reset options panel
	 */
	function entropia_edge_reset_options_map() {
		
		entropia_edge_add_admin_page(
			array(
				'slug'  => '_reset_page',
				'title' => esc_html__( 'Reset', 'entropia' ),
				'icon'  => 'fa fa-retweet'
			)
		);
		
		$panel_reset = entropia_edge_add_admin_panel(
			array(
				'page'  => '_reset_page',
				'name'  => 'panel_reset',
				'title' => esc_html__( 'Reset', 'entropia' )
			)
		);
		
		entropia_edge_add_admin_field(
			array(
				'type'          => 'yesno',
				'name'          => 'reset_to_defaults',
				'default_value' => 'no',
				'label'         => esc_html__( 'Reset to Defaults', 'entropia' ),
				'description'   => esc_html__( 'This option will reset all Select Options values to defaults', 'entropia' ),
				'parent'        => $panel_reset
			)
		);
	}
	
	add_action( 'entropia_edge_action_options_map', 'entropia_edge_reset_options_map', entropia_edge_set_options_map_position( 'reset' ) );
}