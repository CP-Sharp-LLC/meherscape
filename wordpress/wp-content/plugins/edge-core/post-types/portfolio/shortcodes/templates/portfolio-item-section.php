<article class="edgtf-section-item">
	<div class="edgtf-section-item-inner" <?php aalto_edge_inline_style($item_holder_style);?>>
		<?php if ($content_width == 'in-grid') { ?>
			<div class="edgtf-grid">
		<?php } ?>
			<div class="edgtf-section-item-table">
				<div class="edgtf-section-item-table-cell edgtf-section-item-title">
					<?php echo edgtf_core_get_cpt_shortcode_module_template_part('portfolio', 'parts/title', '', $params); ?>
				</div>
				<div class="edgtf-section-item-table-cell edgtf-section-item-category">
					<?php echo edgtf_core_get_cpt_shortcode_module_template_part('portfolio', 'parts/category', '', $params); ?>
				</div>
				<div class="edgtf-section-item-table-cell edgtf-section-item-read-more">
					<?php 
						echo aalto_edge_get_button_html(array(
							'type' => 'simple',
							'link' => get_the_permalink(),
							'size' => 'large',
							'text' => esc_html__('View Project', 'edge-core'),
							'enable_arrow' => 'yes'
						));
					?>
				</div>
			</div>
			
		<?php if ($content_width == 'in-grid') { ?>
			</div>
		<?php } ?>
		<a itemprop="url" class="edgtf-section-link edgtf-block-drag-link" href="<?php echo esc_url($this_object->getItemLink()); ?>" target="<?php echo esc_attr($this_object->getItemLinkTarget()); ?>"></a>
	</div>
</article>