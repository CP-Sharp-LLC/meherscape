<button type="submit" <?php aalto_edge_inline_style($button_styles); ?> <?php aalto_edge_class_attribute($button_classes); ?> <?php echo aalto_edge_get_inline_attrs($button_data); ?> <?php echo aalto_edge_get_inline_attrs($button_custom_attrs); ?>>
    <?php if($type == 'solid' && $show_crosshair == 'yes') {?>
        <?php $i = 1; while($i <= 4) { ?>
            <span class="edgtf-btn-lines edgtf-line-<?php echo esc_attr($i); ?>" <?php aalto_edge_inline_style($border_styles); ?>></span>
        <?php $i++; } ?>
    <?php } ?>
    <?php if (!empty($background_image)) {  ?>
        <div class="edgtf-btn-bg" <?php aalto_edge_inline_style($bg_styles); ?>></div>
    <?php } ?>
    <span class="edgtf-btn-text"><?php echo esc_html($text); ?></span>
    <?php if($enable_arrow == 'yes'){?>
        <span class="edgtf-btn-arrow">
            <svg version="1.1" id="btn-arrow-<?php echo rand();?>" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                 width="18px" height="4px" viewBox="0 0 18 4" enable-background="new 0 0 18 4" xml:space="preserve">
            	<polyline fill="none" stroke="#323232" stroke-miterlimit="10" points="0,3.508 16.809,3.508 13.686,0.342 "/>
            </svg>
        </span>
    <?php } else { ?>
        <?php echo aalto_edge_icon_collections()->renderIcon($icon, $icon_pack); ?>
    <?php } ?>
</button>