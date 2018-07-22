<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<?php
	/**
	 * aalto_edge_header_meta hook
	 *
	 * @see aalto_edge_header_meta() - hooked with 10
	 * @see aalto_edge_user_scalable_meta - hooked with 10
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
	
	<div class="edgtf-wrapper edgtf-404-page">
		<div class="edgtf-wrapper-inner">
            <?php
            /**
             * aalto_edge_after_wrapper_inner hook
             *
             * @see aalto_edge_get_header() - hooked with 10
             * @see aalto_edge_get_mobile_header() - hooked with 20
             * @see aalto_edge_back_to_top_button() - hooked with 30
             * @see aalto_edge_get_header_minimal_full_screen_menu() - hooked with 40
             * @see aalto_edge_get_header_bottom_navigation() - hooked with 40
             */
            do_action( 'aalto_edge_after_wrapper_inner' );

            do_action('aalto_edge_before_main_content'); ?>
			
			<div class="edgtf-content" <?php aalto_edge_content_elem_style_attr(); ?>>
				<div class="edgtf-content-inner">
					<div class="edgtf-page-not-found">
						<?php
						$edgtf_title_image_404 = aalto_edge_options()->getOptionValue( '404_page_title_image' );
						$edgtf_title_404       = aalto_edge_options()->getOptionValue( '404_title' );
						$edgtf_subtitle_404    = aalto_edge_options()->getOptionValue( '404_subtitle' );
						$edgtf_text_404        = aalto_edge_options()->getOptionValue( '404_text' );
						$edgtf_button_label    = aalto_edge_options()->getOptionValue( '404_back_to_home' );
						$edgtf_button_style    = aalto_edge_options()->getOptionValue( '404_button_style' );
						
						if ( ! empty( $edgtf_title_image_404 ) ) { ?>
							<div class="edgtf-404-title-image">
								<img src="<?php echo esc_url( $edgtf_title_image_404 ); ?>" alt="<?php esc_html_e( '404 Title Image', 'aalto' ); ?>" />
							</div>
						<?php } ?>
						
						<h1 class="edgtf-404-title">
							<?php if ( ! empty( $edgtf_title_404 ) ) {
								echo esc_html( $edgtf_title_404 );
							} else {
								esc_html_e( '404', 'aalto' );
							} ?>
						</h1>
						
						<h2 class="edgtf-404-subtitle">
							<?php if ( ! empty( $edgtf_subtitle_404 ) ) {
								echo esc_html( $edgtf_subtitle_404 );
							} else {
								esc_html_e( 'Page not found', 'aalto' );
							} ?>
						</h2>
						
						<p class="edgtf-404-text">
							<?php if ( ! empty( $edgtf_text_404 ) ) {
								echo esc_html( $edgtf_text_404 );
							} else {
								esc_html_e( 'Oops! The page you are looking for does not exist. It might have been moved or deleted.', 'aalto' );
							} ?>
						</p>
						
						<?php
						$edgtf_params           = array();
						$edgtf_params['text']   = ! empty( $edgtf_button_label ) ? $edgtf_button_label : esc_html__( 'Go Back', 'aalto' );
						$edgtf_params['link']   = esc_url( home_url( '/' ) );
						$edgtf_params['target'] = '_self';
						$edgtf_params['size']   = 'large';
						
						if ( $edgtf_button_style == 'light-style' ) {
							$edgtf_params['custom_class'] = 'edgtf-btn-light-style';
						}

						if (shortcode_exists('edgtf_button')) {
							echo aalto_edge_execute_shortcode( 'edgtf_button', $edgtf_params );
						} else { ?>
						<a itemprop="url" href="<?php echo esc_url(home_url('/'))?>" target="_self" class="edgtf-btn edgtf-btn-large edgtf-btn-solid edgtf-btn-with-crosshair">
							<span class="edgtf-btn-lines edgtf-line-1" style="background-color: #999"></span>
							<span class="edgtf-btn-lines edgtf-line-2" style="background-color: #999"></span>
							<span class="edgtf-btn-lines edgtf-line-3" style="background-color: #999"></span>
							<span class="edgtf-btn-lines edgtf-line-4" style="background-color: #999"></span>
							<span class="edgtf-btn-text"><?php esc_html_e("Go Back",'aalto')?></span>
						</a>
						<?php } ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	<?php wp_footer(); ?>
</body>
</html>