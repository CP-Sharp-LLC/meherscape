<article class="edgtf-fpg-item">
	<div class="edgtf-fpg-item-inner">
		<div class="edgtf-fpg-item-table">
			<div class="edgtf-fpg-item-table-cell">
				<?php echo edgtf_core_get_cpt_shortcode_module_template_part('portfolio', 'parts/category', '', $params); ?>

				<?php echo edgtf_core_get_cpt_shortcode_module_template_part('portfolio', 'parts/title', '', $params); ?>
			</div>
		</div>
		
		<a itemprop="url" class="edgtf-fpgi-link edgtf-block-drag-link" href="<?php echo esc_url($this_object->getItemLink()); ?>" target="<?php echo esc_attr($this_object->getItemLinkTarget()); ?>"></a>
	</div>
</article>