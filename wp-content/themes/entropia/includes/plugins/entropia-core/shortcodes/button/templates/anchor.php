<?php if($button_animation_3d !='') {
    $parent_styles = $button_styles;
    $holder_styles = $button_holder_styles;
} else {
    $parent_styles = array_merge($button_styles,$button_holder_styles);
    $holder_styles = '';
};
?>

<a itemprop="url" href="<?php echo esc_url($link); ?>" target="<?php echo esc_attr($target); ?>" <?php echo entropia_edge_get_inline_style($parent_styles); ?> <?php entropia_edge_class_attribute($button_classes); ?> <?php echo entropia_edge_get_inline_attrs($button_data); ?> <?php echo entropia_edge_get_inline_attrs($button_custom_attrs); ?>>
    <span class="edgtf-btn-background-holder" <?php echo entropia_edge_get_inline_style($holder_styles); ?> ></span>
    <span class="edgtf-btn-text"><?php echo esc_html($text); ?></span>
    <?php echo entropia_edge_icon_collections()->renderIcon($icon, $icon_pack); ?>
</a>