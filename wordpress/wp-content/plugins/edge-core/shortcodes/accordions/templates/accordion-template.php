<<?php echo esc_attr($title_tag); ?> class="edgtf-accordion-title">
	<span class="edgtf-accordion-width">
		<span class="edgtf-tab-title"><?php echo esc_html($title); ?></span>
		<span class="edgtf-accordion-mark">
			<span class="edgtf_icon_plus lnr lnr-cross"></span>
		</span>
	</span>
</<?php echo esc_attr($title_tag); ?>>
<div class="edgtf-accordion-content">
	<div class="edgtf-accordion-content-inner">
		<div class="edgtf-accordion-width">
			<?php echo do_shortcode($content); ?>
		</div>
	</div>
</div>