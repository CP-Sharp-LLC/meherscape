<?php if ( $query->have_posts() ) : while ( $query->have_posts() ) : $query->the_post(); ?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="edgtf-post-content">
	        <?php if ( has_post_thumbnail() ) { ?>
		        <div class="edgtf-post-image">
			        <a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
				        <?php the_post_thumbnail( 'thumbnail' ); ?>
			        </a>
		        </div>
	        <?php } ?>
	        <div class="edgtf-post-title-area <?php if ( ! has_post_thumbnail() ) { echo esc_attr( 'edgtf-no-thumbnail' ); } ?>">
		        <div class="edgtf-post-title-area-inner">
			        <h4 itemprop="name" class="edgtf-post-title entry-title">
				        <a itemprop="url" href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
			        </h4>
			        <?php
			        $edgtf_my_excerpt = get_the_excerpt();
		        	$content_exerpt = get_the_content();
			        
			        if ( ! empty( $edgtf_my_excerpt ) ) { ?>
				        <p itemprop="description" class="edgtf-post-excerpt"><?php echo wp_trim_words( esc_html( $edgtf_my_excerpt ), 30 ); ?></p>
			        <?php }  elseif ( ! empty($content_exerpt)) { ?>
				        <p itemprop="description" class="edgtf-post-excerpt"><?php echo wp_trim_words( esc_html( $content_exerpt ), 30 ); ?></p>
			        <?php }

			        if ( aalto_edge_core_plugin_installed() ) {
						echo aalto_edge_get_button_html(
							array(
								'link' => get_permalink(),
								'size' => 'small',
								'text' => esc_html__( 'Continue reading', 'aalto' )
							)
						);
					} else { ?>
						<a itemprop="url" class="edgtf-btn edgtf-btn-small edgtf-btn-solid" href="<?php the_permalink();?>" target="_self">
							<span class="edgtf-btn-text">
							<?php esc_html_e( 'Continue reading', 'aalto' ); ?>
							</span>
						</a>
					<?php }
					?>
		        </div>
	        </div>
        </div>
    </article>
<?php endwhile; ?>
<?php else: ?>
	<p class="edgtf-blog-no-posts"><?php esc_html_e( 'No posts were found.', 'aalto' ); ?></p>
<?php endif; ?>