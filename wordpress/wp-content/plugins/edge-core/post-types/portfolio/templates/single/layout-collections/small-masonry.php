<?php
$masonry_classes = '';
$number_of_columns = aalto_edge_get_meta_field_intersect('portfolio_single_masonry_columns_number');
if(!empty($number_of_columns)) {
	$masonry_classes .= ' edgtf-ps-'.$number_of_columns.'-columns';
}
$space_between_items = aalto_edge_get_meta_field_intersect('portfolio_single_masonry_space_between_items');
if(!empty($space_between_items)) {
	$masonry_classes .= ' edgtf-'.$space_between_items.'-space';
}
?>
<div class="edgtf-grid-row">
	<div class="edgtf-grid-col-8">
		<div class="edgtf-ps-image-holder edgtf-ps-masonry-images <?php echo esc_attr($masonry_classes); ?>">
			<div class="edgtf-ps-image-inner edgtf-outer-space">
				<div class="edgtf-ps-grid-sizer"></div>
				<div class="edgtf-ps-grid-gutter"></div>
				<?php
				$media = edgtf_core_get_portfolio_single_media();
				
				if(is_array($media) && count($media)) : ?>
					<?php foreach($media as $single_media) : ?>
						<div class="edgtf-ps-image edgtf-item-space <?php echo esc_attr($single_media['holder_classes']); ?>">
							<?php edgtf_core_get_portfolio_single_media_html($single_media); ?>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="edgtf-grid-col-4">
		<div class="edgtf-ps-info-holder edgtf-ps-info-sticky-holder">
			<?php
			//get portfolio content section
			edgtf_core_get_cpt_single_module_template_part('templates/single/parts/content', 'portfolio', $item_layout);
			
			//get portfolio custom fields section
			edgtf_core_get_cpt_single_module_template_part('templates/single/parts/custom-fields', 'portfolio', $item_layout);
			
			//get portfolio categories section
			edgtf_core_get_cpt_single_module_template_part('templates/single/parts/categories', 'portfolio', $item_layout);
			
			//get portfolio date section
			edgtf_core_get_cpt_single_module_template_part('templates/single/parts/date', 'portfolio', $item_layout);
			
			//get portfolio tags section
			edgtf_core_get_cpt_single_module_template_part('templates/single/parts/tags', 'portfolio', $item_layout);
			
			//get portfolio share section
			edgtf_core_get_cpt_single_module_template_part('templates/single/parts/social', 'portfolio', $item_layout);
			?>
		</div>
	</div>
</div>