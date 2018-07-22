<div class="edgtf-portfolio-section-holder <?php echo esc_attr($holder_classes); ?>" <?php echo esc_attr($holder_data);?>>
	<div class="edgtf-portfolio-section-holder-inner">
		<?php
			if($query_results->have_posts()):
				$image_html = '';
				while ( $query_results->have_posts() ) : $query_results->the_post();
					echo edgtf_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-item-section', '', $params);
					$image_html .=edgtf_core_get_cpt_shortcode_module_template_part('portfolio', 'parts/image-url', '', $params);;
				endwhile;
			else:
				echo edgtf_core_get_cpt_shortcode_module_template_part('portfolio', 'parts/posts-not-found');
			endif;
		
			wp_reset_postdata();
		?>
	</div>
	<div class="edgtf-portfolio-section-image-holder">
		<?php echo ($image_html); ?>
	</div>
</div>