<?php do_action('entropia_edge_action_before_page_header'); ?>

<aside class="edgtf-vertical-menu-area <?php echo esc_html($holder_class); ?>">
	<div class="edgtf-vertical-menu-area-inner">
		<div class="edgtf-vertical-area-background"></div>
		<?php if(!$hide_logo) {
			entropia_edge_get_logo();
		} ?>
		<?php entropia_edge_get_header_vertical_main_menu(); ?>
		<div class="edgtf-vertical-area-widget-holder">
			<?php entropia_edge_get_header_widget_area_one(); ?>
		</div>
	</div>
</aside>

<?php do_action('entropia_edge_action_after_page_header'); ?>