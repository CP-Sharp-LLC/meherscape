<?php if(aalto_edge_options()->getOptionValue('portfolio_single_hide_date') === 'yes') : ?>
    <div class="edgtf-ps-info-item edgtf-ps-date">
        <h5 class="edgtf-ps-info-title"><?php esc_html_e('Date:', 'edge-core'); ?></h5>
        <p itemprop="dateCreated" class="edgtf-ps-info-date entry-date updated"><?php the_time(get_option('date_format')); ?></p>
        <meta itemprop="interactionCount" content="UserComments: <?php echo get_comments_number(aalto_edge_get_page_id()); ?>"/>
    </div>
<?php endif; ?>