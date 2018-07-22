<div class="edgtf-section-title-holder <?php echo esc_attr($holder_classes); ?>" <?php echo aalto_edge_get_inline_style($holder_styles); ?>>
	<?php if ($type == 'vertical-lines'){?>
        <span class="edgtf-st-vertical-top" <?php echo aalto_edge_get_inline_style($lines_styles); ?>></span>
	<?php }
	    elseif ($type == 'square'){ ?>
        <div class="edgtf-st-square-holder" <?php echo aalto_edge_get_inline_style($square_styles); ?>>
            <span class="line-top"></span>
            <span class="line-right"></span>
            <span class="line-bottom"></span>
            <span class="line-left"></span>
            <span class="line-mask" <?php echo aalto_edge_get_inline_style($mask_styles); ?>></span>
    <?php } ?>
	<div class="edgtf-st-inner">
        <?php if(!empty($title)) { ?>
            <div class="edgtf-st-title-holder">
                <<?php echo esc_attr($title_tag); ?> class="edgtf-st-title" <?php echo aalto_edge_get_inline_style($title_styles); ?>>
                    <?php echo wp_kses($title, array('br' => true, 'span' => array('class' => true))); ?>
                </<?php echo esc_attr($title_tag); ?>>
            </div>
		<?php } ?>
		<?php if(!empty($text)) { ?>
            <div class="edgtf-st-text-holder">
    			<<?php echo esc_attr($text_tag); ?> class="edgtf-st-text" <?php echo aalto_edge_get_inline_style($text_styles); ?>>
    				<?php echo wp_kses($text, array('br' => true)); ?>
    			</<?php echo esc_attr($text_tag); ?>>
            </div>
		<?php } ?>
	</div>
    <?php
        if($type == 'square') { ?>
            </div>
    <?php }
        elseif ($type == 'vertical-lines'){?>
        <span class="edgtf-st-vertical-bottom" <?php echo aalto_edge_get_inline_style($lines_styles); ?>></span>
    <?php }?>
</div>