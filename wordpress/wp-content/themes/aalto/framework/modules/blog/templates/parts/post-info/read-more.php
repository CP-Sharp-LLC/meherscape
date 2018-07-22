<?php if ( ! aalto_edge_post_has_read_more() && ! post_password_required() ) { ?>
	<div class="edgtf-post-read-more-button">
		<?php
		if ( aalto_edge_core_plugin_installed() ) {
			echo aalto_edge_get_button_html(array(
			'type' => 'simple',
			'enable_arrow' => 'yes',
			'show_text_on_hover' => 'yes',
			'link' => get_the_permalink(),
			'text' => esc_html__('Read More', 'aalto')
		));
		} else { ?>
			<a itemprop="url" href="<?php echo esc_attr( get_the_permalink() ); ?>" target="_self" class="edgtf-btn edgtf-btn-medium edgtf-btn-simple edgtf-btn-with-arrow edgtf-btn-text-on-hover">
				<span class="edgtf-btn-text"><?php echo esc_html__( 'Read More', 'aalto' ); ?></span>
                <span class="edgtf-btn-arrow">
                <svg version="1.1" id="Layer_2" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="18px" height="4px" viewBox="0 0 18 4" enable-background="new 0 0 18 4" xml:space="preserve"><polyline fill="none" stroke="#323232" stroke-miterlimit="10" points="0,3.508 16.809,3.508 13.686,0.342 "></polyline></svg></span>
            </a>
        <?php } ?>
	</div>
<?php } ?>