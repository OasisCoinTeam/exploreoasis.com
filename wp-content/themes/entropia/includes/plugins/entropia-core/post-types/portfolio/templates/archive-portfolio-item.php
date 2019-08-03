<?php
get_header();
entropia_edge_get_title();
do_action( 'entropia_edge_action_before_main_content' ); ?>
<div class="edgtf-container edgtf-default-page-template">
	<?php do_action( 'entropia_edge_action_after_container_open' ); ?>
	<div class="edgtf-container-inner clearfix">
		<?php
			$entropia_taxonomy_id   = get_queried_object_id();
			$entropia_taxonomy_type = is_tax( 'portfolio-tag' ) ? 'portfolio-tag' : 'portfolio-category';
			$entropia_taxonomy      = ! empty( $entropia_taxonomy_id ) ? get_term_by( 'id', $entropia_taxonomy_id, $entropia_taxonomy_type ) : '';
			$entropia_taxonomy_slug = ! empty( $entropia_taxonomy ) ? $entropia_taxonomy->slug : '';
			$entropia_taxonomy_name = ! empty( $entropia_taxonomy ) ? $entropia_taxonomy->taxonomy : '';
			
			entropia_core_get_archive_portfolio_list( $entropia_taxonomy_slug, $entropia_taxonomy_name );
		?>
	</div>
	<?php do_action( 'entropia_edge_action_before_container_close' ); ?>
</div>
<?php get_footer(); ?>
