<div class="edgtf-section-title-holder <?php echo esc_attr($holder_classes); ?>" <?php echo entropia_edge_get_inline_style($holder_styles); ?>>
	<div class="edgtf-st-inner">
		<?php if(!empty($title)) { ?>
			<<?php echo esc_attr($title_tag); ?> class="edgtf-st-title" <?php echo entropia_edge_get_inline_style($title_styles); ?>>
				<?php echo wp_kses($title, array('br' => true, 'span' => array('class' => true))); ?>
			</<?php echo esc_attr($title_tag); ?>>
		<?php } ?>
	    <?php if($enable_separator === 'yes') {
            echo entropia_edge_execute_shortcode('edgtf_separator', $separator_parameters);
	    } ?>
		<?php if(!empty($text)) { ?>
			<<?php echo esc_attr($text_tag); ?> class="edgtf-st-text" <?php echo entropia_edge_get_inline_style($text_styles); ?>>
				<?php echo wp_kses($text, array('br' => true)); ?>
			</<?php echo esc_attr($text_tag); ?>>
		<?php } ?>
	</div>
</div>