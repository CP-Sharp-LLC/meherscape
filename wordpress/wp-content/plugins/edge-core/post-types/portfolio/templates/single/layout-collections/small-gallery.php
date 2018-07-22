<?php
$gallery_classes = '';
$number_of_columns = aalto_edge_get_meta_field_intersect('portfolio_single_gallery_columns_number');
if(!empty($number_of_columns)) {
	$gallery_classes .= ' edgtf-ps-'.$number_of_columns.'-columns';
}
$space_between_items = aalto_edge_get_meta_field_intersect('portfolio_single_gallery_space_between_items');
if(!empty($space_between_items)) {
	$gallery_classes .= ' edgtf-'.$space_between_items.'-space';
}
?>
<div class="edgtf-grid-row">
	<div class="edgtf-grid-col-8">
		<div class="edgtf-ps-image-holder edgtf-ps-gallery-images <?php echo esc_attr($gallery_classes); ?>">
			<div class="edgtf-ps-image-inner edgtf-outer-space">
				<?php
				$media = edgtf_core_get_portfolio_single_media();
				
				if(is_array($media) && count($media)) : ?>
					<?php foreach($media as $single_media) : ?>
						<div class="edgtf-ps-image edgtf-item-space">
							<?php edgtf_core_get_portfolio_single_media_html($single_media); ?>
						</div>
					<?php endforeach; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<div class="edgtf-grid-col-4">
		<div class="edgtf-ps-info-holder">
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