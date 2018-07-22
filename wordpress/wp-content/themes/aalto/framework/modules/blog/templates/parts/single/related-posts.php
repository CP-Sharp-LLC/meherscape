<?php
$show_related = aalto_edge_options()->getOptionValue('blog_single_related_posts') == 'yes' ? true : false;
$related_post_number = aalto_edge_sidebar_layout() === 'no-sidebar' ? 4 : 3;
$related_posts_options = array(
    'posts_per_page' => $related_post_number
);
$related_posts = aalto_edge_get_blog_related_post_type(get_the_ID(), $related_posts_options);
$related_posts_image_size = isset($related_posts_image_size) ? $related_posts_image_size : 'full';
?>
<?php if($show_related) { ?>
    <div class="edgtf-related-posts-holder clearfix">
        <div class="edgtf-related-posts-holder-inner">
            <?php if ( $related_posts && $related_posts->have_posts() ) : ?>
                <div class="edgtf-related-posts-title">
                    <h4><?php esc_html_e('RELATED POSTS', 'aalto' ); ?></h4>
                </div>
                <div class="edgtf-related-posts-inner clearfix">
                    <?php while ( $related_posts->have_posts() ) : $related_posts->the_post(); ?>
                        <div class="edgtf-related-post">
                            <div class="edgtf-related-post-inner">
                                <div class="edgtf-related-post-image">
                                    <?php if (has_post_thumbnail()) { ?>
                                        <a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                             <?php the_post_thumbnail($related_posts_image_size); ?>
                                        </a>
                                    <?php }	?>
                                </div>
                                <h4 itemprop="name" class="entry-title edgtf-post-title"><a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
                                <div class="edgtf-post-info">
                                    <?php aalto_edge_get_module_template_part('templates/parts/post-info/date', 'blog', '', $params); ?>
                                    <?php aalto_edge_get_module_template_part('templates/parts/post-info/author', 'blog', '', $params); ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif;
            wp_reset_postdata();
            ?>
        </div>
    </div>
<?php } ?>