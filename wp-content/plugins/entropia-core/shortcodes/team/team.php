<?php
namespace EntropiaCore\CPT\Shortcodes\Team;

use EntropiaCore\lib;

class Team implements lib\ShortcodeInterface {
	private $base;

	public function __construct() {
		$this->base = 'edgtf_team';

		add_action('vc_before_init', array($this, 'vcMap'));
	}
	
	public function getBase() {
		return $this->base;
	}
	
	public function vcMap() {
		$team_social_icons_array = array();
		
		for ( $x = 1; $x < 6; $x ++ ) {
			$teamIconCollections = entropia_edge_icon_collections()->getCollectionsWithSocialIcons();
			foreach ( $teamIconCollections as $collection_key => $collection ) {
				
				$team_social_icons_array[] = array(
					'type'       => 'dropdown',
					'heading'    => esc_html__( 'Social Icon ', 'entropia-core' ) . $x,
					'param_name' => 'team_social_' . $collection->param . '_' . $x,
					'value'      => $collection->getSocialIconsArrayVC(),
					'dependency' => Array( 'element' => 'team_social_icon_pack', 'value' => array( $collection_key ) )
				);
			}
			
			$team_social_icons_array[] = array(
				'type'       => 'textfield',
				'heading'    => esc_html__( 'Social Icon ', 'entropia-core' ) . $x . esc_html__( ' Link', 'entropia-core' ),
				'param_name' => 'team_social_icon_' . $x . '_link',
				'dependency' => array(
					'element' => 'team_social_icon_pack',
					'value'   => entropia_edge_icon_collections()->getIconCollectionsKeys()
				)
			);
			
			$team_social_icons_array[] = array(
				'type'       => 'dropdown',
				'heading'    => esc_html__( 'Social Icon ', 'entropia-core' ) . $x . esc_html__( ' Target', 'entropia-core' ),
				'param_name' => 'team_social_icon_' . $x . '_target',
				'value'      => array(
					esc_html__( 'Same Window', 'entropia-core' ) => '_self',
					esc_html__( 'New Window', 'entropia-core' )  => '_blank'
				),
				'dependency' => Array( 'element' => 'team_social_icon_' . $x . '_link', 'not_empty' => true )
			);
		}
		
		if ( function_exists( 'vc_map' ) ) {
			vc_map(
				array(
					'name'                      => esc_html__( 'Team', 'entropia-core' ),
					'base'                      => $this->base,
					'category'                  => esc_html__( 'by ENTROPIA', 'entropia-core' ),
					'icon'                      => 'icon-wpb-team extended-custom-icon',
					'allowed_container_element' => 'vc_row',
					'params'                    => array_merge(
						array(
							array(
								'type'        => 'dropdown',
								'param_name'  => 'type',
								'heading'     => esc_html__( 'Type', 'entropia-core' ),
								'value'       => array(
									esc_html__( 'Info Below Image', 'entropia-core' )    => 'info-below-image',
									esc_html__( 'Info On Image Hover', 'entropia-core' ) => 'info-on-image'
								),
								'save_always' => true
							),
							array(
								'type'       => 'dropdown',
								'param_name' => 'skin',
								'heading'    => esc_html__( 'Skin', 'entropia-core' ),
								'value'      => array(
									esc_html__( 'Default', 'entropia-core' ) => '',
									esc_html__( 'Dark', 'entropia-core' )   => 'edgtf-dark-skin',
								),
								'save_always' => true
							),
							array(
								'type'       => 'attach_image',
								'param_name' => 'team_image',
								'heading'    => esc_html__( 'Image', 'entropia-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'team_name',
								'heading'    => esc_html__( 'Name', 'entropia-core' )
							),
							array(
								'type'        => 'dropdown',
								'param_name'  => 'team_name_tag',
								'heading'     => esc_html__( 'Name Tag', 'entropia-core' ),
								'value'       => array_flip( entropia_edge_get_title_tag( true ) ),
								'save_always' => true,
								'dependency'  => array( 'element' => 'team_name', 'not_empty' => true )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'team_name_color',
								'heading'    => esc_html__( 'Name Color', 'entropia-core' ),
								'dependency' => array( 'element' => 'team_name', 'not_empty' => true )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'team_position',
								'heading'    => esc_html__( 'Position', 'entropia-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'team_position_color',
								'heading'    => esc_html__( 'Position Color', 'entropia-core' ),
								'dependency' => array( 'element' => 'team_position', 'not_empty' => true )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'team_text',
								'heading'    => esc_html__( 'Text', 'entropia-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'team_text_color',
								'heading'    => esc_html__( 'Text Color', 'entropia-core' ),
								'dependency' => array( 'element' => 'team_text', 'not_empty' => true )
							),
							array(
								'type'        => 'dropdown',
								'param_name'  => 'enable_separator',
								'heading'     => esc_html__( 'Enable Separator', 'entropia-core' ),
								'value'       => array (
									esc_html__( 'No', 'entropia-core' )    => 'no',
									esc_html__( 'Yes', 'entropia-core' ) => 'yes'
								),
								'save_always' => true,
							),
							array(
								'type'        => 'dropdown',
								'param_name'  => 'separator_border_style',
								'heading'     => esc_html__( 'Style', 'entropia-core' ),
								'value'       => array(
									esc_html__( 'Default', 'entropia-core' ) => '',
									esc_html__( 'Dashed', 'entropia-core' )  => 'dashed',
									esc_html__( 'Solid', 'entropia-core' )   => 'solid',
									esc_html__( 'Dotted', 'entropia-core' )  => 'dotted'
								),
								'dependency' => array( 'element' => 'enable_separator', 'value' => array( 'yes' ) ),
								'group'      => esc_html__( 'Separator Style', 'entropia-core' )
							),
							array(
								'type'       => 'colorpicker',
								'param_name' => 'separator_color',
								'heading'    => esc_html__( 'Color', 'entropia-core' ),
								'dependency' => array( 'element' => 'enable_separator', 'value' => array( 'yes' ) ),
								'group'      => esc_html__( 'Separator Style', 'entropia-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'separator_width',
								'heading'    => esc_html__( 'Width (px or %)', 'entropia-core' ),
								'dependency' => array( 'element' => 'enable_separator', 'value' => array( 'yes' ) ),
								'group'      => esc_html__( 'Separator Style', 'entropia-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'separator_thickness',
								'heading'    => esc_html__( 'Thickness (px)', 'entropia-core' ),
								'dependency' => array( 'element' => 'enable_separator', 'value' => array( 'yes' ) ),
								'group'      => esc_html__( 'Separator Style', 'entropia-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'separator_top_margin',
								'heading'    => esc_html__( 'Top Margin (px or %)', 'entropia-core' ),
								'dependency' => array( 'element' => 'enable_separator', 'value' => array( 'yes' ) ),
								'group'      => esc_html__( 'Separator Style', 'entropia-core' )
							),
							array(
								'type'       => 'textfield',
								'param_name' => 'separator_bottom_margin',
								'heading'    => esc_html__( 'Bottom Margin (px or %)', 'entropia-core' ),
								'dependency' => array( 'element' => 'enable_separator', 'value' => array( 'yes' ) ),
								'group'      => esc_html__( 'Separator Style', 'entropia-core' )
							),
							array(
								'type'        => 'dropdown',
								'param_name'  => 'team_social_icon_pack',
								'heading'     => esc_html__( 'Social Icon Pack', 'entropia-core' ),
								'value'       => array_merge( array( '' => '' ), entropia_edge_icon_collections()->getIconCollectionsVCExclude( 'linea_icons' ) ),
								'save_always' => true
							),
						),
						$team_social_icons_array
					)
				)
			);
		}
	}
	
	public function render( $atts, $content = null ) {
		$args = array(
			'type'                    => 'info-below-image',
			'skin'                    => '',
			'team_image'              => '',
			'team_name'               => '',
			'team_name_tag'           => 'h4',
			'team_name_color'         => '',
			'team_position'           => '',
			'team_position_color'     => '',
			'team_text'               => '',
			'team_text_color'         => '',
			'enable_separator'        => 'yes',
			'separator_border_style'  => '',
			'separator_color'         => '',
			'separator_width'         => '',
			'separator_thickness'     => '',
			'separator_top_margin'    => '',
			'separator_bottom_margin' => '',
			'team_social_icon_pack'   => ''
		);
		
		$team_social_icons_form_fields = array();
		$number_of_social_icons        = 5;
		
		for ( $x = 1; $x <= $number_of_social_icons; $x ++ ) {
			
			foreach ( entropia_edge_icon_collections()->iconCollections as $collection_key => $collection ) {
				$team_social_icons_form_fields[ 'team_social_' . $collection->param . '_' . $x ] = '';
			}
			
			$team_social_icons_form_fields[ 'team_social_icon_' . $x . '_link' ]   = '';
			$team_social_icons_form_fields[ 'team_social_icon_' . $x . '_target' ] = '';
		}
		
		$args = array_merge( $args, $team_social_icons_form_fields );
		
		$params = shortcode_atts( $args, $atts );
		
		$params['number_of_social_icons'] = 5;
		
		$params['type']                 = ! empty( $params['type'] ) ? $params['type'] : $args['type'];
		$params['holder_classes']       = $this->getHolderClasses( $params );
		$params['team_name_tag']        = ! empty( $params['team_name_tag'] ) ? $params['team_name_tag'] : $args['team_name_tag'];
		$params['team_social_icons']    = $this->getTeamSocialIcons( $params );
		$params['team_name_styles']     = $this->getTeamNameStyles( $params );
		$params['team_position_styles'] = $this->getTeamPositionStyles( $params );
		$params['separator_parameters']   = $this->getSeparatorParams( $params );
		$params['team_text_styles']     = $this->getTeamTextStyles( $params );
		
		//Get HTML from template based on type of team
		$html = entropia_core_get_shortcode_module_template_part( 'templates/' . $params['type'], 'team', '', $params );
		
		return $html;
	}
	
	private function getHolderClasses( $params ) {
		$holderClasses = array();
		
		$holderClasses[] = ! empty( $params['type'] ) ? 'edgtf-team-' . $params['type'] : '';
		$holderClasses[] = ! empty( $params['skin'] ) ? $params['skin'] : '';

		return implode( ' ', $holderClasses );
	}
	
	private function getTeamSocialIcons( $params ) {
		extract( $params );
		$social_icons = array();
		
		if ( $team_social_icon_pack !== '' ) {
			
			$icon_pack                    = entropia_edge_icon_collections()->getIconCollection( $team_social_icon_pack );
			$team_social_icon_type_label  = 'team_social_' . $icon_pack->param;
			$team_social_icon_param_label = $icon_pack->param;
			
			for ( $i = 1; $i <= $params['number_of_social_icons']; $i ++ ) {
				
				$team_social_icon   = ${$team_social_icon_type_label . '_' . $i};
				$team_social_link   = ${'team_social_icon_' . $i . '_link'};
				$team_social_target = ${'team_social_icon_' . $i . '_target'};
				
				if ( $team_social_icon !== '' ) {
					
					$team_icon_params                                  = array();
					$team_icon_params['icon_pack']                     = $team_social_icon_pack;
					$team_icon_params[ $team_social_icon_param_label ] = $team_social_icon;
					$team_icon_params['link']                          = ( $team_social_link !== '' ) ? $team_social_link : '';
					$team_icon_params['target']                        = ( $team_social_target !== '' ) ? $team_social_target : '';
					
					$social_icons[] = entropia_edge_execute_shortcode( 'edgtf_icon', $team_icon_params );
				}
			}
		}
		
		return $social_icons;
	}
	
	private function getTeamNameStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['team_name_color'] ) ) {
			$styles[] = 'color: ' . $params['team_name_color'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getTeamPositionStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['team_position_color'] ) ) {
			$styles[] = 'color: ' . $params['team_position_color'];
		}
		
		return implode( ';', $styles );
	}
	
	private function getTeamTextStyles( $params ) {
		$styles = array();
		
		if ( ! empty( $params['team_text_color'] ) ) {
			$styles[] = 'color: ' . $params['team_text_color'];
		}
		
		return implode( ';', $styles );
	}

	private function getSeparatorParams( $params ) {
		$separator_params = array();

		if ( ! empty( $params['separator_border_style'] ) ) {
			$separator_params['border_style'] = $params['separator_border_style'];
		}

		if ( ! empty( $params['separator_color'] ) ) {
			$separator_params['color'] = $params['separator_color'];
		}

		if ( ! empty( $params['separator_width'] ) ) {
			$separator_params['width'] = $params['separator_width'];
		}

		if ( ! empty( $params['separator_thickness'] ) ) {
			$separator_params['thickness'] = $params['separator_thickness'];
		}

		if ( ! empty( $params['separator_top_margin'] ) ) {
			$separator_params['top_margin'] = $params['separator_top_margin'];
		}

		if ( ! empty( $params['separator_bottom_margin'] ) ) {
			$separator_params['bottom_margin'] = $params['separator_bottom_margin'];
		}

		return $separator_params;
	}
}