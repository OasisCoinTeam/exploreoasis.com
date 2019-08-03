<section class="edgtf-side-menu">
    <div class="edgtf-side-menu-inner-holder">
	<a <?php entropia_edge_class_attribute( $close_icon_classes ); ?> href="#">
		<?php echo entropia_edge_get_icon_sources_html( 'side_area', true ); ?>
	</a>
	<?php if ( is_active_sidebar( 'sidearea' ) ) {
		dynamic_sidebar( 'sidearea' );
	} ?>
    </div>
</section>