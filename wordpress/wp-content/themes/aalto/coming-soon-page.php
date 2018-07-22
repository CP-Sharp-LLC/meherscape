<?php
/*
Template Name: Coming Soon Page
*/
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php
	/**
	 * aalto_edge_header_meta hook
	 *
	 * @see aalto_edge_header_meta() - hooked with 10
	 * @see aalto_edge_user_scalable_meta() - hooked with 10
	 * @see edgtf_core_set_open_graph_meta - hooked with 10
	 */
	do_action( 'aalto_edge_header_meta' );
	
	wp_head(); ?>
</head>
<body <?php body_class(); ?> itemscope itemtype="http://schema.org/WebPage">
	<?php
	/**
	 * aalto_edge_after_body_tag hook
	 *
	 * @see aalto_edge_get_side_area() - hooked with 10
	 * @see aalto_edge_smooth_page_transitions() - hooked with 10
	 */
	do_action( 'aalto_edge_after_body_tag' ); ?>

	<div class="edgtf-wrapper">
		<div class="edgtf-wrapper-inner">
			<div class="edgtf-content">
				<div class="edgtf-content-inner">
					<?php get_template_part( 'slider' ); ?>
					<div class="edgtf-full-width">
						<div class="edgtf-full-width-inner">
							<?php do_action( 'aalto_edge_after_container_inner_open' ); ?>
							<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
								<?php the_content(); ?>
							<?php endwhile; endif; ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php wp_footer(); ?>
</body>
</html>