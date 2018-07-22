<div class="edgtf-progress-bar <?php echo esc_attr($holder_classes); ?>">
	<<?php echo esc_attr($title_tag); ?> class="edgtf-pb-title-holder" <?php echo aalto_edge_inline_style($title_styles); ?>>
		<span class="edgtf-pb-title"><?php echo esc_html($title); ?></span>
	</<?php echo esc_attr($title_tag); ?>>
	<div class="edgtf-pb-content-holder" <?php echo aalto_edge_inline_style($inactive_bar_style); ?>>
		<div data-percentage=<?php echo esc_attr($percent); ?> class="edgtf-pb-content" <?php echo aalto_edge_inline_style($active_bar_style); ?>>
            <h6 class="edgtf-pb-percent" <?php echo aalto_edge_inline_style($title_styles); ?>>0</h6>
        </div>
	</div>
</div>