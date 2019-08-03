<?php if(entropia_edge_options()->getOptionValue('portfolio_single_hide_date') === 'yes') : ?>
    <div class="edgtf-ps-info-item edgtf-ps-date">
	    <?php entropia_core_get_cpt_single_module_template_part('templates/single/parts/info-title', 'portfolio', '', array( 'title' => esc_attr__('Date:', 'entropia-core') ) ); ?>
        <p itemprop="dateCreated" class="edgtf-ps-info-date entry-date updated"><?php the_time(get_option('date_format')); ?></p>
        <meta itemprop="interactionCount" content="UserComments: <?php echo get_comments_number(entropia_edge_get_page_id()); ?>"/>
    </div>
<?php endif; ?>