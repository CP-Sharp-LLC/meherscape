<div class="edgtf-process-item <?php echo esc_attr( $holder_classes ); ?>">
	<div class="edgtf-pi-content">
		<?php if(!empty($title)) { ?>
			<<?php echo esc_attr($title_tag); ?> class="edgtf-pi-title" <?php echo aalto_edge_get_inline_style($title_styles); ?>><?php echo esc_html($title); ?></<?php echo esc_attr($title_tag); ?>>
		<?php } ?>
		<?php if(!empty($text)) { ?>
			<p class="edgtf-pi-text" <?php echo aalto_edge_get_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
		<?php } ?>
	</div>
</div>