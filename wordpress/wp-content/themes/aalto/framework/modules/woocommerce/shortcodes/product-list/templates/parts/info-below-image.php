<?php
$item_classes           = $this_object->getItemClasses( $params );
$shader_styles          = $this_object->getShaderStyles( $params );
$text_wrapper_styles    = $this_object->getTextWrapperStyles( $params );
$params['title_styles'] = $this_object->getTitleStyles( $params );
?>
<div class="edgtf-pli edgtf-item-space <?php echo esc_html( $item_classes ); ?>">
	<div class="edgtf-pli-inner">
		<div class="edgtf-pli-image">
			<?php aalto_edge_get_module_template_part( 'templates/parts/image', 'woocommerce', '', $params ); ?>
		</div>
		<div class="edgtf-pli-text" <?php echo aalto_edge_get_inline_style( $shader_styles ); ?>>
			<div class="edgtf-pli-text-outer">
				<div class="edgtf-pli-text-inner">
					<?php aalto_edge_get_module_template_part( 'templates/parts/add-to-cart', 'woocommerce', '', $params ); ?>
				</div>
			</div>
		</div>
		<a class="edgtf-pli-link" itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"></a>
	</div>
	<div class="edgtf-pli-text-wrapper" <?php echo aalto_edge_get_inline_style( $text_wrapper_styles ); ?>>
		<?php aalto_edge_get_module_template_part( 'templates/parts/title', 'woocommerce', '', $params ); ?>

		<?php aalto_edge_get_module_template_part( 'templates/parts/price', 'woocommerce', '', $params ); ?>
		
		<?php aalto_edge_get_module_template_part( 'templates/parts/category', 'woocommerce', '', $params ); ?>
		
		<?php aalto_edge_get_module_template_part( 'templates/parts/excerpt', 'woocommerce', '', $params ); ?>
		
		<?php aalto_edge_get_module_template_part( 'templates/parts/rating', 'woocommerce', '', $params ); ?>
	</div>
</div>