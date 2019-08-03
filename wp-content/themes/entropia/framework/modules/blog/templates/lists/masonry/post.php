<?php
$post_classes[] = 'edgtf-item-space';
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
    <div class="edgtf-post-content">
        <div class="edgtf-post-heading">
            <?php entropia_edge_get_module_template_part('templates/parts/media', 'blog', $post_format, $part_params); ?>
        </div>
        <div class="edgtf-post-text">
            <div class="edgtf-post-text-inner">
                <div class="edgtf-post-info-top">
                    <?php entropia_edge_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
                    <?php entropia_edge_get_module_template_part('templates/parts/post-info/author', 'blog', '', $part_params); ?>
                </div>
                <div class="edgtf-post-text-main">
                    <?php entropia_edge_get_module_template_part('templates/parts/title', 'blog', '', $part_params); ?>
                    <?php entropia_edge_get_module_template_part('templates/parts/excerpt', 'blog', '', $part_params); ?>
                    <?php entropia_edge_get_module_template_part('templates/parts/post-info/read-more', 'blog', '', $part_params); ?>
                </div>
                <div class="edgtf-post-info-bottom clearfix">
                    <div class="edgtf-post-info-bottom-right">
                        <div class="edgtf-post-info-share-label">
                            <?php echo esc_html__('Share:', 'entropia'); ?>
                        </div>
                        <?php entropia_edge_get_module_template_part('templates/parts/post-info/share', 'blog', '', $part_params); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</article>