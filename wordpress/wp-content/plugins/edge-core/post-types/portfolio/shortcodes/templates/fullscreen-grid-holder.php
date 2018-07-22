<div class="edgtf-fullscreen-portfolio-grid-holder <?php echo esc_attr($holder_classes); ?>" <?php echo esc_attr($holder_data);?>>
	<div class="edgtf-fpg-holder-inner">
		<?php
			if($query_results->have_posts()):
				$image_html = '';
				while ( $query_results->have_posts() ) : $query_results->the_post();
					echo edgtf_core_get_cpt_shortcode_module_template_part('portfolio', 'portfolio-item-grid', '', $params);
					$image_html .=edgtf_core_get_cpt_shortcode_module_template_part('portfolio', 'parts/image-url', '', $params);;
				endwhile;
			else:
				echo edgtf_core_get_cpt_shortcode_module_template_part('portfolio', 'parts/posts-not-found');
			endif;
		
			wp_reset_postdata();
		?>
	</div>
	<div class="edgtf-fpg-image-holder">
		<?php echo ($image_html); ?>
	</div>
</div>