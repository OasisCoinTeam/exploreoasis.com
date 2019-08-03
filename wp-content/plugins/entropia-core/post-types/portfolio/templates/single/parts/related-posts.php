<?php
$post_id = get_the_ID();
$related_posts = entropia_core_get_portfolio_single_related_posts($post_id);

?>
    <div class="edgtf-ps-related-posts-holder">

        <div class="edgtf-ps-related-posts-title">
            <h4><?php esc_html_e('Related Posts', 'entropia' ); ?></h4>
        </div>

        <div class="edgtf-ps-related-posts">
            <?php
	            if ( $related_posts && $related_posts->have_posts() ) :
	                while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
                        <div class="edgtf-ps-related-post">
			                <?php if(has_post_thumbnail()) { ?>
		                        <div class="edgtf-ps-related-image">
			                        <a itemprop="url" href="<?php the_permalink(); ?>">
                                        <?php echo entropia_edge_generate_thumbnail(get_post_thumbnail_id(), null, 752, 546) ?>
			                        </a>
	                            </div>
			                <?php } ?>
                            <div class="edgtf-ps-related-text-holder">
                                <div class="edgtf-ps-related-text">
                                    <h5 itemprop="name" class="edgtf-ps-related-title entry-title">
                                        <a itemprop="url" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h5>
                                    <?php $categories = wp_get_post_terms($post_id, 'portfolio-category'); ?>
                                    <?php if(!empty($categories)) { ?>
                                        <div class="edgtf-ps-related-categories">
                                            <?php foreach ($categories as $cat) { ?>
                                                <a itemprop="url" class="edgtf-ps-related-category" href="<?php echo esc_url(get_term_link($cat->term_id)); ?>"><?php echo esc_html($cat->name); ?></a>
                                            <?php } ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
	                <?php
	                endwhile;
	            endif;
            
                wp_reset_postdata();
            ?>
        </div>
    </div>
