<input type="submit" name="<?php echo esc_attr($input_name); ?>" value="<?php echo esc_attr($text); ?>" <?php entropia_edge_inline_style(array_merge($button_styles,$button_holder_styles)); ?> <?php entropia_edge_class_attribute($button_classes); ?> <?php echo entropia_edge_get_inline_attrs($button_data); ?> <?php echo entropia_edge_get_inline_attrs($button_custom_attrs); ?> />