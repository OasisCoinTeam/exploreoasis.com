<?php

class EntropiaEdgeClassSeparatorWidget extends EntropiaEdgeClassWidget {
	public function __construct() {
		parent::__construct(
			'edgtf_separator_widget',
			esc_html__( 'Entropia Separator Widget', 'entropia' ),
			array( 'description' => esc_html__( 'Add a separator element to your widget areas', 'entropia' ) )
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
					'normal'     => esc_html__( 'Normal', 'entropia' ),
					'full-width' => esc_html__( 'Full Width', 'entropia' )
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'position',
				'title'   => esc_html__( 'Position', 'entropia' ),
				'options' => array(
					'center' => esc_html__( 'Center', 'entropia' ),
					'left'   => esc_html__( 'Left', 'entropia' ),
					'right'  => esc_html__( 'Right', 'entropia' )
				)
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'border_style',
				'title'   => esc_html__( 'Style', 'entropia' ),
				'options' => array(
					'solid'  => esc_html__( 'Solid', 'entropia' ),
					'dashed' => esc_html__( 'Dashed', 'entropia' ),
					'dotted' => esc_html__( 'Dotted', 'entropia' )
				)
			),
			array(
				'type'  => 'colorpicker',
				'name'  => 'color',
				'title' => esc_html__( 'Color', 'entropia' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'width',
				'title' => esc_html__( 'Width (px or %)', 'entropia' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'thickness',
				'title' => esc_html__( 'Thickness (px)', 'entropia' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'top_margin',
				'title' => esc_html__( 'Top Margin (px or %)', 'entropia' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'bottom_margin',
				'title' => esc_html__( 'Bottom Margin (px or %)', 'entropia' )
			)
		);
	}
	
	public function widget( $args, $instance ) {
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}
		
		//prepare variables
		$params = '';
		
		//is instance empty?
		if ( is_array( $instance ) && count( $instance ) ) {
			//generate shortcode params
			foreach ( $instance as $key => $value ) {
				$params .= " $key='$value' ";
			}
		}
		
		echo '<div class="widget edgtf-separator-widget">';
			echo do_shortcode( "[edgtf_separator $params]" ); // XSS OK
		echo '</div>';
	}
}