<?php
$share_type = isset($share_type) ? $share_type : 'list';
?>
<?php if(entropia_edge_options()->getOptionValue('enable_social_share') === 'yes' && entropia_edge_options()->getOptionValue('enable_social_share_on_post') === 'yes') { ?>
    <div class="edgtf-blog-share">
        <span class="edgtf-post-info-share-label">
            <?php echo esc_html__('Share:', 'entropia'); ?>
        </span>
        <?php echo entropia_edge_get_social_share_html(array('type' => $share_type)); ?>
    </div>
<?php } ?>