<?php
    $parent_styles = $button_styles;
    $holder_styles = $button_holder_styles;
?>

<button type="submit" <?php echo entropia_edge_get_inline_style($parent_styles); ?> <?php entropia_edge_class_attribute($button_classes); ?> <?php echo entropia_edge_get_inline_attrs($button_data); ?> <?php echo entropia_edge_get_inline_attrs($button_custom_attrs); ?>>
    <span class="edgtf-btn-background-holder" <?php echo entropia_edge_get_inline_style($holder_styles); ?> ></span>
    <span class="edgtf-btn-text"><?php echo esc_html($text); ?></span>
    <?php echo entropia_edge_icon_collections()->renderIcon($icon, $icon_pack); ?>
</button>