<div class="edgtf-link-section-holder <?php echo esc_attr($holder_classes); ?>">
    <div class="edgtf-link-section-title-holder">
        <h2 class="edgtf-link-section-title" <?php echo aalto_edge_get_inline_style($title_styles); ?>>
    		<?php if(!empty($title)) {
    			echo wp_kses_post( $title );
    		} ?>
        </h2>
    </div>
    <?php foreach ($single_link as $single_link_item) { ?>
        <div class="edgtf-single-link-section-holder">
            <?php if(!empty($single_link_item['link'])) { ?>
                <a href="<?php echo esc_url($single_link_item['link']); ?>" class="edgtf-link-section" >
                    <div class="edgtf-single-link-title-holder">
                        <h5 class="edgtf-single-link-title" <?php echo aalto_edge_get_inline_style($link_styles); ?>>
                            <?php echo esc_html($single_link_item['link_text']); ?>
                        </h5>
                    </div>
                </a>
            <?php } ?>
        </div>
    <?php } ?>
</div>