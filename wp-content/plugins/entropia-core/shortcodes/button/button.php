<?php
namespace EntropiaCore\CPT\Shortcodes\Button;

use EntropiaCore\Lib;

class Button implements Lib\ShortcodeInterface {
	private $base;
	
	public function __construct() {
		$this->base = 'edgtf_button';
		
		add_action( 'vc_before_init', array( $this, 'vcMap' ) );
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Button', 'entropia-core' ),
					'base'                      => $this->base,
					'category'                  => esc_html__( 'by ENTROPIA', 'entropia-core' ),
					'icon'                      => 'icon-wpb-button extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array_merge(
						array(
							array(
								'type'        => 'textfield',
								'param_name'  => 'custom_class',
								'heading'     => esc_html__( 'Custom CSS Class', 'entropia-core' ),
								'description' => esc_html__( 'Style particular content element differently - add a class name and refer to it in custom CSS', 'entropia-core' )
							),
							array(
								'type'        => 'dropdown',
								'param_name'  => 'type',
								'heading'     => esc_html__( 'Type', 'entropia-core' ),
								'value'       => array(
									esc_html__( 'Solid', 'entropia-core' )   => 'solid',
									esc_html__( 'Outline', 'entropia-core' ) => 'outline',
									esc_html__( 'Simple', 'entropia-core' )  => 'simple'
								),
								'admin_label' => true
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'size',
								'heading'    => esc_html__( 'Size', 'entropia-core' ),
								'value'      => array(
									esc_html__( 'Default', 'entropia-core' ) => '',
									esc_html__( 'Small', 'entropia-core' )   => 'small',
									esc_html__( 'Medium', 'entropia-core' )  => 'medium',
									esc_html__( 'Large', 'entropia-core' )   => 'large',
									esc_html__( 'Huge', 'entropia-core' )    => 'huge'
								),
								'dependency' => array( 'element' => 'type', 'value' => array( 'solid', 'outline' ) )
							),
							array(
								'type'        => 'textfield',
								'param_name'  => 'text',
								'heading'     => esc_html__( 'Text', 'entropia-core' ),
								'value'       => esc_html__( 'Button Text', 'entropia-core' ),
								'save_always' => true,
								'admin_label' => true
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'link',
								'heading'    => esc_html__( 'Link', 'entropia-core' )
							),
							array(
								'type'        => 'dropdown',
								'param_name'  => 'target',
								'heading'     => esc_html__( 'Link Target', 'entropia-core' ),
								'value'       => array_flip( entropia_edge_get_link_target_array() ),
								'save_always' => true
							)
						),
						entropia_edge_icon_collections()->getVCParamsArray( array(), '', true ),
						array(
							array(
								'type'       => 'colorpicker',
								'param_name' => 'color',
								'heading'    => esc_html__( 'Color', 'entropia-core' ),
								'group'      => esc_html__( 'Design Options', 'entropia-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'hover_color',
								'heading'    => esc_html__( 'Hover Color', 'entropia-core' ),
								'group'      => esc_html__( 'Design Options', 'entropia-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'background_color',
								'heading'    => esc_html__( 'Background Color', 'entropia-core' ),
								'dependency' => array( 'element' => 'type', 'value' => array( 'solid' ) ),
								'group'      => esc_html__( 'Design Options', 'entropia-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'hover_background_color',
								'heading'    => esc_html__( 'Hover Background Color', 'entropia-core' ),
								'dependency' => array( 'element' => 'type', 'value' => array( 'solid', 'outline' ) ),
								'group'      => esc_html__( 'Design Options', 'entropia-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'border_color',
								'heading'    => esc_html__( 'Border Color', 'entropia-core' ),
								'dependency' => array( 'element' => 'type', 'value' => array( 'solid', 'outline' ) ),
								'group'      => esc_html__( 'Design Options', 'entropia-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'hover_border_color',
								'heading'    => esc_html__( 'Hover Border Color', 'entropia-core' ),
								'dependency' => array( 'element' => 'type', 'value' => array( 'solid', 'outline' ) ),
								'group'      => esc_html__( 'Design Options', 'entropia-core' )
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'button_animation_3d',
								'heading'    => esc_html__( 'Button 3D Animation', 'entropia-core' ),
								'value'      => array(
									esc_html__( 'No', 'entropia-core' ) => '',
									esc_html__( 'Yes', 'entropia-core' ) => 'yes',
								),
								'dependency' => array( 'element' => 'type', 'value' => array( 'solid' ) )
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'button_animation_shadow',
								'heading'    => esc_html__( 'Button Shadow Animation', 'entropia-core' ),
								'value'      => array(
									esc_html__( 'No', 'entropia-core' ) => '',
									esc_html__( 'Yes', 'entropia-core' ) => 'yes',
								),
								'dependency' => array( 'element' => 'type', 'value' => array( 'solid' ) )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'font_size',
								'heading'    => esc_html__( 'Font Size (px)', 'entropia-core' ),
								'group'      => esc_html__( 'Design Options', 'entropia-core' )
							),
							array(
								'type'        => 'dropdown',
								'param_name'  => 'font_weight',
								'heading'     => esc_html__( 'Font Weight', 'entropia-core' ),
								'value'       => array_flip( entropia_edge_get_font_weight_array( true ) ),
								'save_always' => true,
								'group'       => esc_html__( 'Design Options', 'entropia-core' )
							),
							array(
								'type'        => 'dropdown',
								'param_name'  => 'text_transform',
								'heading'     => esc_html__( 'Text Transform', 'entropia-core' ),
								'value'       => array_flip( entropia_edge_get_text_transform_array( true ) ),
								'save_always' => true
							),
							array(
								'type'        => 'textfield',
								'param_name'  => 'margin',
								'heading'     => esc_html__( 'Margin', 'entropia-core' ),
								'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'entropia-core' ),
								'group'       => esc_html__( 'Design Options', 'entropia-core' )
							),
							array(
								'type'        => 'textfield',
								'param_name'  => 'padding',
								'heading'     => esc_html__( 'Button Padding', 'entropia-core' ),
								'description' => esc_html__( 'Insert padding in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'entropia-core' ),
								'dependency'  => array( 'element' => 'type', 'value' => array( 'solid', 'outline' ) ),
								'group'       => esc_html__( 'Design Options', 'entropia-core' )
							)
						)
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$default_atts = array(
			'size'                   => '',
			'type'                   => 'solid',
			'text'                   => '',
			'link'                   => '',
			'target'                 => '_self',
			'color'                  => '',
			'hover_color'            => '',
			'background_color'       => '',
			'hover_background_color' => '',
			'border_color'           => '',
			'hover_border_color'     => '',
			'button_animation_3d'    => '',
			'button_animation_shadow'=> '',
			'font_size'              => '',
			'font_weight'            => '',
			'text_transform'         => '',
			'margin'                 => '',
			'padding'                => '',
			'custom_class'           => '',
			'html_type'              => 'anchor',
			'input_name'             => '',
			'custom_attrs'           => array()
		);
		$default_atts = array_merge( $default_atts, entropia_edge_icon_collections()->getShortcodeParams() );
		$params       = shortcode_atts( $default_atts, $atts );
		
		if ( $params['html_type'] !== 'input' ) {
			$iconPackName   = entropia_edge_icon_collections()->getIconCollectionParamNameByKey( $params['icon_pack'] );
			$params['icon'] = $iconPackName ? $params[ $iconPackName ] : '';
		}
		
		$params['size'] = ! empty( $params['size'] ) ? $params['size'] : 'medium';
		$params['type'] = ! empty( $params['type'] ) ? $params['type'] : 'solid';
		
		$params['link']   = ! empty( $params['link'] ) ? $params['link'] : '#';
		$params['target'] = ! empty( $params['target'] ) ? $params['target'] : $default_atts['target'];
		
		$params['button_classes']      = $this->getButtonClasses( $params );
		$params['button_custom_attrs'] = ! empty( $params['custom_attrs'] ) ? $params['custom_attrs'] : array();
		$params['button_styles']       = $this->getButtonStyles( $params );
        $params['button_holder_styles']       = $this->getButtonHolderStyles( $params );
		$params['button_data']         = $this->getButtonDataAttr( $params );
		
		return entropia_core_get_shortcode_module_template_part( 'templates/' . $params['html_type'], 'button', '', $params );
	}
	
	private function getButtonStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['color'] ) ) {
			$styles[] = 'color: ' . $params['color'];
		}
		
		//if ( ! empty( $params['background_color'] ) && $params['type'] !== 'outline' ) {
		//	$styles[] = 'background-color: ' . $params['background_color'];
		//}
		//
		//if ( ! empty( $params['border_color'] ) ) {
		//	$styles[] = 'border-color: ' . $params['border_color'];
		//}
		
		if ( ! empty( $params['font_size'] ) ) {
			$styles[] = 'font-size: ' . entropia_edge_filter_px( $params['font_size'] ) . 'px';
		}
		
		if ( ! empty( $params['font_weight'] ) && $params['font_weight'] !== '' ) {
			$styles[] = 'font-weight: ' . $params['font_weight'];
		}
		
		if ( ! empty( $params['text_transform'] ) ) {
			$styles[] = 'text-transform: ' . $params['text_transform'];
		}
		
		if ( $params['margin'] !== '' ) {
			$styles[] = 'margin: ' . $params['margin'];
		}
		
		if ( $params['padding'] !== '' ) {
			$styles[] = 'padding: ' . $params['padding'];
		}
		
		return $styles;
	}

    private function getButtonHolderStyles( $params ) {
        $styles = array();

        if ( ! empty( $params['background_color'] ) && $params['type'] !== 'outline' ) {
            $styles[] = 'background-color: ' . $params['background_color'];
        }

        if ( ! empty( $params['border_color'] ) ) {
            $styles[] = 'border-color: ' . $params['border_color'];
        }

        return $styles;
    }
	
	private function getButtonDataAttr( $params ) {
		$data = array();
		
		if ( ! empty( $params['hover_color'] ) ) {
			$data['data-hover-color'] = $params['hover_color'];
		}
		
		if ( ! empty( $params['hover_background_color'] ) ) {
			$data['data-hover-bg-color'] = $params['hover_background_color'];
		}
		
		if ( ! empty( $params['hover_border_color'] ) ) {
			$data['data-hover-border-color'] = $params['hover_border_color'];
		}
		
		return $data;
	}
	
	private function getButtonClasses( $params ) {
		$buttonClasses = array(
			'edgtf-btn',
			'edgtf-btn-' . $params['size'],
			'edgtf-btn-' . $params['type']
		);
		
		if ( ! empty( $params['hover_background_color'] ) ) {
			$buttonClasses[] = 'edgtf-btn-custom-hover-bg';
		}
		
		if ( ! empty( $params['hover_border_color'] ) ) {
			$buttonClasses[] = 'edgtf-btn-custom-border-hover';
		}
		
		if ( ! empty( $params['hover_color'] ) ) {
			$buttonClasses[] = 'edgtf-btn-custom-hover-color';
		}
		
		if ( ! empty( $params['icon'] ) ) {
			$buttonClasses[] = 'edgtf-btn-icon';
		}
		
		if ( ! empty( $params['button_animation_3d'] ) ) {
			$buttonClasses[] = 'edgtf-btn-animation-3d';
		}

		if ( ! empty( $params['button_animation_shadow'] ) ) {
			$buttonClasses[] = 'edgtf-btn-animation-shadow';
		}

		if ( ! empty( $params['custom_class'] ) ) {
			$buttonClasses[] = esc_attr( $params['custom_class'] );
		}
		
		return $buttonClasses;
	}
}