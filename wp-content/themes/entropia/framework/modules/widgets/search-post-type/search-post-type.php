<?php

class EntropiaEdgeClassSearchPostType extends EntropiaEdgeClassWidget {
	public function __construct() {
		parent::__construct(
			'edgtf_search_post_type',
			esc_html__( 'Entropia Search Post Type', 'entropia' ),
			array( 'description' => esc_html__( 'Select post type that you want to be searched for', 'entropia' ) )
		);
		
		$this->setParams();
	}
	
	protected function setParams() {
		$post_types = apply_filters( 'entropia_edge_filter_search_post_type_widget_params_post_type', array( 'post' => esc_html__( 'Post', 'entropia' ) ) );
		
		$this->params = array(
			array(
				'type'        => 'dropdown',
				'name'        => 'post_type',
				'title'       => esc_html__( 'Post Type', 'entropia' ),
				'description' => esc_html__( 'Choose post type that you want to be searched for', 'entropia' ),
				'options'     => $post_types
			)
		);
	}
	
	public function widget( $args, $instance ) {
		$search_type_class = 'edgtf-search-post-type';
		$post_type         = $instance['post_type'];
		?>
		
		<div class="widget edgtf-search-post-type-widget">
			<div data-post-type="<?php echo esc_attr( $post_type ); ?>" <?php entropia_edge_class_attribute( $search_type_class ); ?>>
				<input class="edgtf-post-type-search-field" value="" placeholder="<?php esc_attr_e( 'Search here', 'entropia' ) ?>">
				<i class="edgtf-search-icon fa fa-search" aria-hidden="true"></i>
				<i class="edgtf-search-loading fa fa-spinner fa-spin edgtf-hidden" aria-hidden="true"></i>
			</div>
			<div class="edgtf-post-type-search-results"></div>
		</div>
	<?php }
}