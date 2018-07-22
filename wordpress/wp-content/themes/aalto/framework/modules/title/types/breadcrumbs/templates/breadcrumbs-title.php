<?php do_action('aalto_edge_before_page_title'); ?>

<div class="edgtf-title-holder <?php echo esc_attr($holder_classes); ?>" <?php aalto_edge_inline_style($holder_styles); ?> <?php echo aalto_edge_get_inline_attrs($holder_data); ?>>
	<?php if(!empty($title_image)) { ?>
		<div class="edgtf-title-image">
			<img itemprop="image" src="<?php echo esc_url($title_image['src']); ?>" alt="<?php echo esc_html($title_image['alt']); ?>" />
		</div>
	<?php } ?>
	<div class="edgtf-title-wrapper" <?php aalto_edge_inline_style($wrapper_styles); ?>>
		<div class="edgtf-title-inner">
			<div class="edgtf-grid">
				<?php aalto_edge_custom_breadcrumbs(); ?>
			</div>
	    </div>
	</div>
</div>

<?php do_action('aalto_edge_after_page_title'); ?>
