<div class="edgtf-social-links-holder">
    <?php foreach ($single_link as $single_link_item) { ?>
        <div class="edgtf-single-social-link-holder">
            <?php if(!empty($single_link_item['link'])) { ?>
                <a href="<?php echo esc_url($single_link_item['link']); ?>" class="edgtf-social-link" <?php echo aalto_edge_get_inline_style($link_styles); ?>>
                    <?php echo esc_html($single_link_item['link_text']); ?>
                </a>
            <?php } ?>
        </div>
    <?php } ?>
</div>