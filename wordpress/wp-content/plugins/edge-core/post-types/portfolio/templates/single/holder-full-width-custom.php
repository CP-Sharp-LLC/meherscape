<div class="edgtf-full-width">
    <div class="edgtf-full-width-inner">
		<?php do_action( 'aalto_edge_after_container_inner_open' ); ?>
        <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
			<div class="edgtf-portfolio-single-holder <?php echo esc_attr($holder_classes); ?>">
				<?php if(post_password_required()) {
					echo get_the_password_form();
				} else {
					do_action('aalto_edge_portfolio_page_before_content');
					
					edgtf_core_get_cpt_single_module_template_part('templates/single/layout-collections/'.$item_layout, 'portfolio', '', $params);
					
					do_action('aalto_edge_portfolio_page_after_content');
					?>
					
					<div class="edgtf-grid">
							<?php

							edgtf_core_get_cpt_single_module_template_part('templates/single/parts/comments', 'portfolio');

							?>
					</div>
				<?php } ?>
			</div>
		<?php endwhile; endif; ?>
	</div>
</div>