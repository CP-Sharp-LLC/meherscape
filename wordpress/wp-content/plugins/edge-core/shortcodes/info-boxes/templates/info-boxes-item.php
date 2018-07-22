<div class="edgtf-info-boxes-inner">
    <div class="edgtf-info-boxes-holder <?php echo esc_attr($holder_inner_classes); ?>">
        <div class="edgtf-ib-inner edgtf-ib-front" <?php echo aalto_edge_get_inline_style($image); ?>>
            <div class="edgtf-ib-text-holder">
                <div class="edgtf-ib-text-inner">
	                <?php if(!empty($title)) { ?>
	                	<<?php echo esc_attr($title_tag); ?> class="edgtf-ib-title" <?php echo aalto_edge_get_inline_style($title_front_styles); ?>>
	                    	<?php echo esc_html($title); ?>
	                    </<?php echo esc_attr($title_tag); ?>>
	                <?php } ?>
                </div>
            </div>
        </div>
        <div class="edgtf-ib-inner edgtf-ib-back">
            <div class="edgtf-ib-text-holder">
                <div class="edgtf-ib-text-inner">
	                <?php if(!empty($title)) { ?>
	                	<<?php echo esc_attr($title_tag); ?> class="edgtf-ib-title" <?php echo aalto_edge_get_inline_style($title_styles); ?>>
	                    	<?php echo esc_html($title); ?>
	                    </<?php echo esc_attr($title_tag); ?>>
	                <?php } ?>
                <?php if(!empty($text)) { ?>
                    <p class="edgtf-ib-text" <?php echo aalto_edge_get_inline_style($text_styles); ?>><?php echo esc_html($text); ?></p>
                <?php }
                if(!empty($link)){
					echo aalto_edge_get_button_html($button_params);
				} ?>
                </div>
            </div>
        </div>
    </div>
</div>