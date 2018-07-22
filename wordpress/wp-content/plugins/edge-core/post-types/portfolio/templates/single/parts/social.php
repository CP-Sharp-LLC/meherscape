<?php if(aalto_edge_options()->getOptionValue('enable_social_share') == 'yes' && aalto_edge_options()->getOptionValue('enable_social_share_on_portfolio-item') == 'yes') : ?>
    <div class="edgtf-ps-info-item edgtf-ps-social-share">
        <?php echo aalto_edge_get_social_share_html() ?>
    </div>
<?php endif; ?>