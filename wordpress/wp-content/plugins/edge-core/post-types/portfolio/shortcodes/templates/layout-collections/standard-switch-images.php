<?php echo edgtf_core_get_cpt_shortcode_module_template_part('portfolio', 'parts/image', $item_style, $params); ?>

<div class="edgtf-pli-text-holder">
	<div class="edgtf-pli-text-wrapper">
		<div class="edgtf-pli-text">
			<?php echo edgtf_core_get_cpt_shortcode_module_template_part('portfolio', 'parts/title', $item_style, $params); ?>
			
			<?php echo edgtf_core_get_cpt_shortcode_module_template_part('portfolio', 'parts/category', $item_style, $params); ?>

			<?php echo edgtf_core_get_cpt_shortcode_module_template_part('portfolio', 'parts/images-count', $item_style, $params); ?>
			
			<?php echo edgtf_core_get_cpt_shortcode_module_template_part('portfolio', 'parts/excerpt', $item_style, $params); ?>
		</div>
	</div>
</div>