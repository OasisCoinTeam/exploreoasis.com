<?php
$blog_single_navigation = entropia_edge_options()->getOptionValue('blog_single_navigation') === 'no' ? false : true;
$blog_navigation_through_same_category = entropia_edge_options()->getOptionValue('blog_navigation_through_same_category') === 'no' ? false : true;
?>
<?php if($blog_single_navigation){ ?>
	<div class="edgtf-blog-single-navigation">
		<div class="edgtf-blog-single-navigation-inner clearfix">
			<?php
				/* Single navigation section - SETTING PARAMS */
				$post_navigation = array(
					'prev' => array(
						'mark' => '<span class="edgtf-blog-single-nav-mark ion-ios-arrow-thin-left"></span>',
						'label' => '<span class="edgtf-blog-single-nav-label">'.esc_html__('Prev.', 'entropia').'</span>'
					),
					'next' => array(
						'mark' => '<span class="edgtf-blog-single-nav-mark ion-ios-arrow-thin-right"></span>',
						'label' => '<span class="edgtf-blog-single-nav-label">'.esc_html__('Next', 'entropia').'</span>'
					)
				);
			
				if($blog_navigation_through_same_category){
					if(get_previous_post(true) !== ""){
						$post_navigation['prev']['post'] = get_previous_post(true);
					}
					if(get_next_post(true) !== ""){
						$post_navigation['next']['post'] = get_next_post(true);
					}
				} else {
					if(get_previous_post() !== ""){
						$post_navigation['prev']['post'] = get_previous_post();
					}
					if(get_next_post() !== ""){
						$post_navigation['next']['post'] = get_next_post();
					}
				}

				/* Single navigation section - RENDERING */
            foreach (array('prev', 'next') as $nav_type) {
                if (isset($post_navigation[$nav_type]['post'])) { ?>
                    <?php $edgtf_nav_class = get_the_post_thumbnail($post_navigation[$nav_type]['post']->ID) == '' ? 'edgtf-no-nav-image' : '';  ?>
                    <a itemprop="url" class="edgtf-blog-single-<?php echo esc_attr($nav_type); ?> <?php echo esc_attr($edgtf_nav_class); ?>" href="<?php echo get_permalink($post_navigation[$nav_type]['post']->ID); ?>">
                        <?php echo get_the_post_thumbnail($post_navigation[$nav_type]['post']->ID, 'entropia_edge_navigation'); ?>
                        <?php echo wp_kses($post_navigation[$nav_type]['label'], array('span' => array('class' => true))); ?>
                    </a>
                <?php }
            }
			?>
		</div>
	</div>
<?php } ?>