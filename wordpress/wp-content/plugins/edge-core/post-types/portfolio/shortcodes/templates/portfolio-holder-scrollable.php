<div class="edgtf-portfolio-list-holder <?php echo esc_attr($holder_classes); ?>" <?php echo wp_kses($holder_data, array('data')); ?>>
    <div class="edgtf-pl-inner edgtf-outer-space clearfix">
        <?php
        if($query_results->have_posts()):

            $counter = 0;
            $scrollable_item = '-meta-item';
            $thumb_html = ''; ?>

            <div class="edgtf-ptf-list-showcase-meta">
            <div class="edgtf-ptf-list-showcase-meta-inner">
            <div class="edgtf-ptf-list-showcase-meta-items-holder">

            <?php while ( $query_results->have_posts() ) : $query_results->the_post();

                echo edgtf_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-item', 'scrollable-meta-item', $params);

                $thumb_html .= edgtf_core_get_cpt_shortcode_module_template_part('portfolio','portfolio-item', 'scrollable-preview-item','', $params);

            endwhile; ?>

                </div> <!-- close .edgtf-ptf-list-showcase-meta-items-holder -->
                </div> <!-- close .edgtf-ptf-list-showcase-meta-inner -->
                </div> <!-- close .edgtf-ptf-list-showcase-meta -->
                <div class="edgtf-ptf-list-showcase-preview">
                <?php print $thumb_html; ?>
                </div> <!-- close .edgtf-ptf-list-showcase-preview -->

        <?php else:
            echo edgtf_core_get_cpt_shortcode_module_template_part('portfolio', 'parts/posts-not-found');
        endif;

        wp_reset_postdata();
        ?>
    </div>
</div>