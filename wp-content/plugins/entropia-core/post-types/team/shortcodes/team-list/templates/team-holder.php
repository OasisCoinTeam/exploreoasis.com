<div class="edgtf-team-list-holder edgtf-grid-list edgtf-disable-bottom-space <?php echo esc_attr($holder_classes); ?>" <?php echo entropia_edge_get_inline_attrs($data_attrs); ?>>
	<div class="edgtf-tl-inner edgtf-outer-space <?php echo esc_attr($inner_classes); ?>">
		<?php
			if($query_results->have_posts()):
				while ( $query_results->have_posts() ) : $query_results->the_post();
					$params['member_id'] = get_the_ID();
					echo entropia_edge_execute_shortcode('edgtf_team_member', $params);
				endwhile;
			else:
				esc_html_e( 'Sorry, no posts matched your criteria.', 'entropia-core' );
			endif;
		
			wp_reset_postdata();
		?>
	</div>
</div>