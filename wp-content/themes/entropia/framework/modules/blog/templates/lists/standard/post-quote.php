<?php
$post_classes[] = 'edgtf-item-space';
$quote_img_meta = get_post_meta(get_the_ID(), "edgtf_post_quote_bg_image_meta", true );
if ($quote_img_meta !== '') {
	$bgimg = 'background-image: url('. esc_attr($link_img_meta) .')"';
}
else {
    $bgimg = '';
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class($post_classes); ?>>
    <div class="edgtf-post-content" <?php entropia_edge_inline_style($bgimg); ?>>
        <div class="edgtf-post-text">
            <div class="edgtf-post-text-inner">
                <div class="edgtf-post-text-main">
                    <?php entropia_edge_get_module_template_part('templates/parts/post-type/quote', 'blog', '', $part_params); ?>
                </div>
            </div>
        </div>
    </div>
</article>