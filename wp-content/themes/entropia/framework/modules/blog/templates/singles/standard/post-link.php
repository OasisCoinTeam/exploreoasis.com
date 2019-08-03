<?php
$link_img_meta = get_post_meta(get_the_ID(), "edgtf_post_link_bg_image_meta", true );
if ($link_img_meta !== '') {
	$bgimg = 'background-image: url('. esc_attr($link_img_meta) .')"';
}
else {
    $bgimg = '';
}
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="edgtf-post-content" <?php entropia_edge_inline_style($bgimg); ?>>
        <div class="edgtf-post-text">
            <div class="edgtf-post-text-inner">

                <div class="edgtf-post-text-main">
                    <div class="edgtf-post-mark">
                    </div>
                    <?php entropia_edge_get_module_template_part('templates/parts/post-type/link', 'blog', '', $part_params); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="edgtf-post-info-top">
        <?php entropia_edge_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
        <?php entropia_edge_get_module_template_part('templates/parts/post-info/author', 'blog', '', $part_params); ?>
    </div>
    <div class="edgtf-post-additional-content">
        <?php the_content(); ?>
    </div>
    <div class="edgtf-post-info-bottom clearfix">
        <div class="edgtf-post-info-bottom-left">
	        <?php if(entropia_edge_options()->getOptionValue('show_categories_area_blog') === 'yes') {
		        entropia_edge_get_module_template_part('templates/parts/post-info/category', 'blog', '', $part_params); }
	        ?>
            <?php entropia_edge_get_module_template_part('templates/parts/post-info/tags', 'blog', '', $part_params); ?>
        </div>
        <div class="edgtf-post-info-bottom-right">
            <?php entropia_edge_get_module_template_part('templates/parts/post-info/share', 'blog', '', $part_params); ?>
        </div>
    </div>
</article>