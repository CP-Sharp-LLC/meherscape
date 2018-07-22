<div class="edgtf-fsis-item">
	<div class="edgtf-fsis-image" <?php aalto_edge_inline_style( $image_styles ); ?>>
		<div class="edgtf-fsis-image-wrapper">
			<div class="edgtf-fsis-image-inner">
				<?php if ( ! empty( $image_top ) ) { ?>
					<div class="edgtf-fsis-content-image edgtf-fsis-image-top">
						<?php echo wp_get_attachment_image( $image_top, 'full' ); ?>
					</div>
				<?php } ?>
				<?php if ( ! empty( $image_left ) ) { ?>
					<div class="edgtf-fsis-content-image edgtf-fsis-image-left">
						<?php echo wp_get_attachment_image( $image_left, 'full' ); ?>
					</div>
				<?php } ?>
				<?php if ( ! empty( $image_right ) ) { ?>
					<div class="edgtf-fsis-content-image edgtf-fsis-image-right">
						<?php echo wp_get_attachment_image( $image_right, 'full' ); ?>
					</div>
				<?php } ?>
				<?php if ( ! empty( $title ) ) { ?>
					<<?php echo esc_attr( $title_tag ); ?> class="edgtf-fsis-title" <?php echo aalto_edge_get_inline_style( $title_styles ); ?>><?php echo wp_kses( $title, array( 'br' => true ) ); ?></<?php echo esc_attr( $title_tag ); ?>>
				<?php } ?>
				<?php if ( ! empty( $subtitle ) ) { ?>
					<<?php echo esc_attr( $subtitle_tag ); ?> class="edgtf-fsis-subtitle" <?php echo aalto_edge_get_inline_style( $subtitle_styles ); ?>><?php echo wp_kses( $subtitle, array( 'br' => true ) ); ?></<?php echo esc_attr( $subtitle_tag ); ?>>
				<?php } ?>
			</div>
		</div>
	</div>
	<div class="edgtf-fsis-frame edgtf-fsis-frame-top"></div>
	<div class="edgtf-fsis-frame edgtf-fsis-frame-right"></div>
	<div class="edgtf-fsis-frame edgtf-fsis-frame-bottom"></div>
	<div class="edgtf-fsis-frame edgtf-fsis-frame-left"></div>
</div>