<div class="edgtf-team edgtf-item-space <?php echo esc_attr($team_member_layout) ?>">
	<div class="edgtf-team-inner">
		<?php if (get_the_post_thumbnail($member_id) !== '') { ?>
			<div class="edgtf-team-image">
                <a itemprop="url" href="<?php echo esc_url(get_the_permalink($member_id)) ?>">
                    <?php echo get_the_post_thumbnail($member_id, 'full'); ?>
                </a>
			</div>
		<?php } ?>
		<div class="edgtf-team-info">
            <div class="edgtf-team-title-holder">
                <h4 itemprop="name" class="edgtf-team-name entry-title">
                    <a itemprop="url" href="<?php echo esc_url(get_the_permalink($member_id)) ?>"><?php echo esc_html($title) ?></a>
                </h4>

                <?php if (!empty($position)) { ?>
                    <h6 class="edgtf-team-position"><?php echo esc_html($position); ?></h6>
                <?php } ?>
            </div>
			<?php if (!empty($excerpt)) { ?>
				<div class="edgtf-team-text">
					<div class="edgtf-team-text-inner">
						<div class="edgtf-team-description">
							<p itemprop="description" class="edgtf-team-excerpt"><?php echo esc_html($excerpt); ?></p>
						</div>
					</div>
				</div>
			<?php } ?>
			<div class="edgtf-team-social-holder-between">
				<div class="edgtf-team-social">
					<div class="edgtf-team-social-inner">
						<div class="edgtf-team-social-wrapp">
							<?php foreach ($team_social_icons as $team_social_icon) {
								echo wp_kses_post($team_social_icon);
							} ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>