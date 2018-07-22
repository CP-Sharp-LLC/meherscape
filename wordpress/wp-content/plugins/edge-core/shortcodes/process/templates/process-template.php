<div class="edgtf-process-holder <?php echo esc_attr( $holder_classes ); ?>">
	<div class="edgtf-mark-horizontal-holder">
		<?php for ( $i = 1; $i <= $number_of_items; $i ++ ) { ?>
			<div class="edgtf-process-mark">
				<div class="edgtf-process-line"></div>
				<div class="edgtf-process-circle"><?php echo esc_attr( $i ); ?></div>
			</div>
		<?php } ?>
	</div>
	<div class="edgtf-mark-vertical-holder">
		<?php for ( $i = 1; $i <= $number_of_items; $i ++ ) { ?>
			<div class="edgtf-process-mark">
				<div class="edgtf-process-line"></div>
				<div class="edgtf-process-circle"><?php echo esc_attr( $i ); ?></div>
			</div>
		<?php } ?>
	</div>
	<div class="edgtf-process-inner">
		<?php echo do_shortcode( $content ); ?>
	</div>
</div>