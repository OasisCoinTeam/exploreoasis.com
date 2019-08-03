<?php

class EntropiaEdgeClassSideAreaOpener extends EntropiaEdgeClassWidget {
	public function __construct() {
		parent::__construct(
			'edgtf_side_area_opener',
			esc_html__( 'Entropia Side Area Opener', 'entropia' ),
			array( 'description' => esc_html__( 'Display a "hamburger" icon that opens the side area', 'entropia' ) )
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		$this->params = array(
			array(
				'type'        => 'colorpicker',
				'name'        => 'icon_color',
				'title'       => esc_html__( 'Side Area Opener Color', 'entropia' ),
				'description' => esc_html__( 'Define color for side area opener', 'entropia' )
			),
			array(
				'type'        => 'colorpicker',
				'name'        => 'icon_hover_color',
				'title'       => esc_html__( 'Side Area Opener Hover Color', 'entropia' ),
				'description' => esc_html__( 'Define hover color for side area opener', 'entropia' )
			),
			array(
				'type'        => 'textfield',
				'name'        => 'widget_margin',
				'title'       => esc_html__( 'Side Area Opener Margin', 'entropia' ),
				'description' => esc_html__( 'Insert margin in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'entropia' )
			),
			array(
				'type'  => 'textfield',
				'name'  => 'widget_title',
				'title' => esc_html__( 'Side Area Opener Title', 'entropia' )
			)
		);
	}
	
	public function widget( $args, $instance ) {
		$classes = array(
			'edgtf-side-menu-button-opener',
			'edgtf-icon-has-hover'
		);
		
		$classes[] = entropia_edge_get_icon_sources_class( 'side_area', 'edgtf-side-menu-button-opener' );

		$styles = array();
		if ( ! empty( $instance['icon_color'] ) ) {
			$styles[] = 'color: ' . $instance['icon_color'] . ';';
		}
		if ( ! empty( $instance['widget_margin'] ) ) {
			$styles[] = 'margin: ' . $instance['widget_margin'];
		}
		?>
		
		<a <?php entropia_edge_class_attribute( $classes ); ?> <?php echo entropia_edge_get_inline_attr( $instance['icon_hover_color'], 'data-hover-color' ); ?> href="javascript:void(0)" <?php entropia_edge_inline_style( $styles ); ?>>
			<?php if ( ! empty( $instance['widget_title'] ) ) { ?>
				<h5 class="edgtf-side-menu-title"><?php echo esc_html( $instance['widget_title'] ); ?></h5>
			<?php } ?>
			<span class="edgtf-side-menu-icon">
				<?php echo entropia_edge_get_icon_sources_html( 'side_area' ); ?>
            </span>
		</a>
	<?php }
}