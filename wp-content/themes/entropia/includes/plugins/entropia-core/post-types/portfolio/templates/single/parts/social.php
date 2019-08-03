<?php if ( entropia_edge_options()->getOptionValue( 'enable_social_share' ) == 'yes' && entropia_edge_options()->getOptionValue( 'enable_social_share_on_portfolio_item' ) == 'yes' ) : ?>
	<div class="edgtf-ps-info-item edgtf-ps-social-share">
        <h5 class="edgtf-ps-info-title edgtf-ps-info-share-label">
            <?php echo esc_html__('Share:', 'entropia'); ?>
        </h5>
		<?php
		/**
		 * Available params type, icon_type and title
		 *
		 * Return social share html
		 */
		echo entropia_edge_get_social_share_html( array( 'type'  => 'list', 'title' => '' ) ); ?>
	</div>
<?php endif; ?>