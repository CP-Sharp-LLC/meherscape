<article class="edgtf-pfs-item swiper-slide">
	<div class="edgtf-pfs-item-inner">

		<div class="edgtf-pfs-order edgtf-pfs-item-table-cell">
			<?php echo esc_html($order.'.'); ?>
		</div>
		<div class="edgtf-pfs-title edgtf-pfs-item-table-cell">
			<?php echo edgtf_core_get_cpt_shortcode_module_template_part('portfolio', 'parts/title', '', $params); ?>
		</div>
		<div class="edgtf-pfs-category edgtf-pfs-item-table-cell">
			<?php echo edgtf_core_get_cpt_shortcode_module_template_part('portfolio', 'parts/category', '', $params); ?>
		</div>
	</div>
	<a itemprop="url" class="edgtf-pfs-link edgtf-block-drag-link" href="<?php echo esc_url($this_object->getItemLink()); ?>" target="<?php echo esc_attr($this_object->getItemLinkTarget()); ?>"></a>
</article>