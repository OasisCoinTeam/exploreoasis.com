<?php
$overlay_style = $this_object->getOverlayStyle($params);

echo entropia_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/image', $item_style, $params);

?>


<div class="edgtf-pli-text-holder" <?php entropia_edge_inline_style($overlay_style); ?>>
	<div class="edgtf-pli-text-wrapper">
		<div class="edgtf-pli-text">
			<?php echo entropia_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/title', $item_style, $params); ?>

			<?php echo entropia_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/category', $item_style, $params); ?>

			<?php echo entropia_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/images-count', $item_style, $params); ?>
			
			<?php echo entropia_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-list', 'parts/excerpt', $item_style, $params); ?>
		</div>
	</div>
</div>