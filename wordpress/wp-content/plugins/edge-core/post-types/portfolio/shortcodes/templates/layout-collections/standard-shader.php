<?php echo edgtf_core_get_cpt_shortcode_module_template_part('portfolio', 'parts/image', $item_style, $params); ?>

<div class="edgtf-pli-text-holder">
	<div class="edgtf-pli-text-wrapper">
		<div class="edgtf-pli-text">
			<?php	echo edgtf_core_get_cpt_shortcode_module_template_part('portfolio', 'parts/category', $item_style, $params);?>

			<?php echo edgtf_core_get_cpt_shortcode_module_template_part('portfolio', 'parts/title', $item_style, $params); ?>

			<?php	echo edgtf_core_get_cpt_shortcode_module_template_part('portfolio', 'parts/images-count', $item_style, $params);?>

			<?php echo edgtf_core_get_cpt_shortcode_module_template_part('portfolio', 'parts/excerpt', $item_style, $params); ?>
			<div class="edgtf-pli-text-read-more-button">
				<a itemprop="url" href="<?php echo esc_url($this_object->getItemLink()); ?>" target="_self" class="edgtf-btn edgtf-btn-medium edgtf-btn-simple edgtf-pli-button">
					<svg version="1.1" id="btn-arrow-<?php echo rand();?>" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
						 width="18px" height="4px" viewBox="0 0 18 4" enable-background="new 0 0 18 4" xml:space="preserve">
                <polyline fill="none" stroke="#323232" stroke-miterlimit="10" points="0,3.508 16.809,3.508 13.686,0.342 "/>
                </svg>
				</a>
			</div>
		</div>
	</div>
</div>