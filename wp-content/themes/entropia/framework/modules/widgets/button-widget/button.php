<?php

class EntropiaEdgeClassButtonWidget extends EntropiaEdgeClassWidget {
	public function __construct() {
		parent::__construct(
			'edgtf_button_widget',
			esc_html__( 'Entropia Button Widget', 'entropia' ),
			array( 'description' => esc_html__( 'Add button element to widget areas', 'entropia' ) )
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		$this->params = array(
			array(
				'type'    => 'dropdown',
				'name'    => 'type',
				'title'   => esc_html__( 'Type', 'entropia' ),
				'options' => array(
					'solid'   => esc_html__( 'Solid', 'entropia' ),
					'outline' => esc_html__( 'Outline', 'entropia' ),
					'simple'  => esc_html__( 'Simple', 'entropia' )
				)
			),
			array(
				'type'        => 'dropdown',
				'name'        => 'size',
				'title'       => esc_html__( 'Size', 'entropia' ),
				'options'     => array(
					'small'  => esc_html__( 'Small', 'entropia' ),
					'medium' => esc_html__( 'Medium', 'entropia' ),
					'large'  => esc_html__( 'Large', 'entropia' ),
					'huge'   => esc_html__( 'Huge', 'entropia' )
				),
				'description' => esc_html__( 'This option is only available for solid and outline button type', 'entropia' )
			),
			array(
				'type'    => 'textfield',
				'name'    => 'text',
				'title'   => esc_html__( 'Text', 'entropia' ),
				'default' => esc_html__( 'Button Text', 'entropia' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'link',
				'title' => esc_html__( 'Link', 'entropia' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'target',
				'title'   => esc_html__( 'Link Target', 'entropia' ),
				'options' => entropia_edge_get_link_target_array()
			),
			array(
				'type'  => 'colorpicker',
				'name'  => 'color',
				'title' => esc_html__( 'Color', 'entropia' )
			),
			array(
				'type'  => 'colorpicker',
				'name'  => 'hover_color',
				'title' => esc_html__( 'Hover Color', 'entropia' )
			),
			array(
				'type'        => 'colorpicker',
				'name'        => 'background_color',
				'title'       => esc_html__( 'Background Color', 'entropia' ),
				'description' => esc_html__( 'This option is only available for solid button type', 'entropia' )
			),
			array(
				'type'        => 'colorpicker',
				'name'        => 'hover_background_color',
				'title'       => esc_html__( 'Hover Background Color', 'entropia' ),
				'description' => esc_html__( 'This option is only available for solid button type', 'entropia' )
			),
			array(
				'type'        => 'colorpicker',
				'name'        => 'border_color',
				'title'       => esc_html__( 'Border Color', 'entropia' ),
				'description' => esc_html__( 'This option is only available for solid and outline button type', 'entropia' )
			),
			array(
				'type'        => 'colorpicker',
				'name'        => 'hover_border_color',
				'title'       => esc_html__( 'Hover Border Color', 'entropia' ),
				'description' => esc_html__( 'This option is only available for solid and outline button type', 'entropia' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'margin',
				'title'       => esc_html__( 'Margin', 'entropia' ),
				'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'entropia' )
			)
		);
	}
	
	public function widget( $args, $instance ) {
		$params = '';
		
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}
		
		// Filter out all empty params
		$instance = array_filter( $instance, function ( $array_value ) {
			return trim( $array_value ) != '';
		} );
		
		// Default values
		if ( ! isset( $instance['text'] ) ) {
			$instance['text'] = 'Button Text';
		}
		
		// Generate shortcode params
		foreach ( $instance as $key => $value ) {
			$params .= " $key='$value' ";
		}
		
		echo '<div class="widget edgtf-button-widget">';
			echo do_shortcode( "[edgtf_button $params]" ); // XSS OK
		echo '</div>';
	}
}