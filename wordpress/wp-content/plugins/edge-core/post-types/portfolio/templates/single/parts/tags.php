<?php
$tags = wp_get_post_terms(get_the_ID(), 'portfolio-tag');
$tag_names = array();

if(is_array($tags) && count($tags)) : ?>
    <div class="edgtf-ps-info-item edgtf-ps-tags">
        <h5 class="edgtf-ps-info-title"><?php esc_html_e('Tags:', 'edge-core'); ?></h5>
        <?php foreach($tags as $tag) { ?>
            <a itemprop="url" class="edgtf-ps-info-tag" href="<?php echo esc_url(get_term_link($tag->term_id)); ?>"><?php echo esc_html($tag->name); ?></a>
        <?php } ?>
    </div>
<?php endif; ?>