<div class="edgtf-pl-holder <?php echo esc_attr( $holder_classes ) ?>" <?php echo wp_kses($holder_data, array('data')); ?>>
	<?php if($query_result->have_posts()){ ?>
	<?php echo aalto_edge_get_woo_shortcode_module_template_part('templates/parts/categories-filter', 'product-list', '', $params); ?>
    <div class="edgtf-prl-loading">
        <span class="edgtf-prl-loading-msg"><?php esc_html_e('Loading...', 'aalto') ?></span>
    </div>
	<div class="edgtf-pl-outer edgtf-outer-space">
		<div class="edgtf-pl-sizer"></div>
		<div class="edgtf-pl-gutter"></div>
		<?php while ( $query_result->have_posts() ) : $query_result->the_post();
			echo aalto_edge_get_woo_shortcode_module_template_part( 'templates/parts/' . $info_position, 'product-list', '', $params );
		endwhile;
		?>
    </div>
		<?php } else {
			aalto_edge_get_module_template_part( 'templates/parts/no-posts', 'woocommerce', '', $params );
        }
		wp_reset_postdata();
		?>
</div>