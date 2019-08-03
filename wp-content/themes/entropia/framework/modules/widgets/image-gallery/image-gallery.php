<?php

class EntropiaEdgeClassImageGalleryWidget extends EntropiaEdgeClassWidget {
	public function __construct() {
		parent::__construct(
			'edgtf_image_gallery_widget',
			esc_html__( 'Entropia Image Gallery Widget', 'entropia' ),
			array( 'description' => esc_html__( 'Add image gallery element to widget areas', 'entropia' ) )
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		$this->params = array(
			array(
				'type'  => 'textfield',
				'name'  => 'extra_class',
				'title' => esc_html__( 'Custom CSS Class', 'entropia' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'widget_bottom_margin',
				'title' => esc_html__( 'Widget Bottom Margin (px)', 'entropia' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'widget_title',
				'title' => esc_html__( 'Widget Title', 'entropia' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'widget_title_bottom_margin',
				'title' => esc_html__( 'Widget Title Bottom Margin (px)', 'entropia' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'type',
				'title'   => esc_html__( 'Gallery Type', 'entropia' ),
				'options' => array(
					'grid'   => esc_html__( 'Image Grid', 'entropia' ),
					'slider' => esc_html__( 'Slider', 'entropia' )
				)
			),
			array(
				'type'        => 'textfield',
				'name'        => 'images',
				'title'       => esc_html__( 'Image ID\'s', 'entropia' ),
				'description' => esc_html__( 'Add images id for your image gallery widget, separate id\'s with comma', 'entropia' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'image_size',
				'title'       => esc_html__( 'Image Size', 'entropia' ),
				'description' => esc_html__( 'Enter image size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height). Leave empty to use "thumbnail" size', 'entropia' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'enable_image_shadow',
				'title'   => esc_html__( 'Enable Image Shadow', 'entropia' ),
				'options' => entropia_edge_get_yes_no_select_array()
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'image_behavior',
				'title'   => esc_html__( 'Image Behavior', 'entropia' ),
				'options' => array(
					''            => esc_html__( 'None', 'entropia' ),
					'lightbox'    => esc_html__( 'Open Lightbox', 'entropia' ),
					'custom-link' => esc_html__( 'Open Custom Link', 'entropia' ),
					'zoom'        => esc_html__( 'Zoom', 'entropia' ),
					'grayscale'   => esc_html__( 'Grayscale', 'entropia' )
				)
			),
			array(
				'type'        => 'textarea',
				'name'        => 'custom_links',
				'title'       => esc_html__( 'Custom Links', 'entropia' ),
				'description' => esc_html__( 'Delimit links by comma', 'entropia' )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'custom_link_target',
				'title'   => esc_html__( 'Custom Link Target', 'entropia' ),
				'options' => entropia_edge_get_link_target_array()
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'number_of_columns',
				'title'   => esc_html__( 'Number of Columns', 'entropia' ),
				'options' => entropia_edge_get_number_of_columns_array( false, array( 'six' ) )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'space_between_columns',
				'title'   => esc_html__( 'Space Between Items', 'entropia' ),
				'options' => entropia_edge_get_space_between_items_array()
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'slider_navigation',
				'title'   => esc_html__( 'Enable Slider Navigation Arrows', 'entropia' ),
				'options' => entropia_edge_get_yes_no_select_array( false )
			),
			array(
				'type'    => 'dropdown',
				'name'    => 'slider_pagination',
				'title'   => esc_html__( 'Enable Slider Pagination', 'entropia' ),
				'options' => entropia_edge_get_yes_no_select_array( false )
			)
		);
	}
	
	public function widget( $args, $instance ) {
		if ( ! is_array( $instance ) ) {
			$instance = array();
		}
		
		$extra_class      = ! empty( $instance['extra_class'] ) ? $instance['extra_class'] : '';
		$instance['type'] = ! empty( $instance['type'] ) ? $instance['type'] : 'grid';
		
		//prepare variables
		$params = '';
		
		//is instance empty?
		if ( is_array( $instance ) && count( $instance ) ) {
			//generate shortcode params
			foreach ( $instance as $key => $value ) {
				$params .= " $key='$value' ";
			}
		}
		
		$widget_styles = array();
		if ( isset( $instance['widget_bottom_margin'] ) && $instance['widget_bottom_margin'] !== '' ) {
			$widget_styles[] = 'margin-bottom: ' . entropia_edge_filter_px( $instance['widget_bottom_margin'] ) . 'px';
		}
		
		$widget_title_styles = array();
		if ( isset( $instance['widget_title_bottom_margin'] ) && $instance['widget_title_bottom_margin'] !== '' ) {
			$widget_title_styles[] = 'margin-bottom: ' . entropia_edge_filter_px( $instance['widget_title_bottom_margin'] ) . 'px';
		}
		?>
		
		<div class="widget edgtf-image-gallery-widget <?php echo esc_html( $extra_class ); ?>" <?php echo entropia_edge_get_inline_style( $widget_styles ); ?>>
			<?php
			if ( ! empty( $instance['widget_title'] ) ) {
				if ( ! empty( $widget_title_styles ) ) {
					$args['before_title'] = entropia_edge_widget_modified_before_title( $args['before_title'], $widget_title_styles ) ;
				}
				
				echo wp_kses_post( $args['before_title'] ) . esc_html( $instance['widget_title'] ) . wp_kses_post( $args['after_title'] );
			}
			echo do_shortcode( "[edgtf_image_gallery $params]" ); // XSS OK
			?>
		</div>
		<?php
	}
}