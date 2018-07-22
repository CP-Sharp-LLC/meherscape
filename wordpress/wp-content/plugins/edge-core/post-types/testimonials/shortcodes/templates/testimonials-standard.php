<div class="edgtf-testimonial-content edgtf-testimonials<?php echo esc_attr($current_id) ?>">
	<div class="edgtf-testimonial-content-inner">
		<div class="edgtf-testimonial-text-holder">
			<div class="edgtf-testimonial-text-inner">
				<?php if ( ! empty( $title ) ) { ?>
					<h4 class="edgtf-testimonial-title">
						<?php echo esc_html( $title ); ?>
					</h4>
				<?php }?>
				<?php if ( ! empty( $text ) ) { ?>
					<p class="edgtf-testimonial-text"><?php echo esc_html( $text ); ?></p>
				<?php } ?>
			</div>
			<span class="edgtf-testimonial-arrow"></span>
		</div>
		<div class="edgtf-testimonial-carousel-bottom">
			<?php if ( has_post_thumbnail() ) { ?>
				<div class="edgtf-testimonial-image">
					<?php echo get_the_post_thumbnail( get_the_ID(), array( 66, 66 ) ); ?>
				</div>
			<?php } ?>
			<?php if ( ! empty( $author ) ) { ?>
				<div class="edgtf-testimonial-author">
					<h5 class="edgtf-testimonials-author-name"><?php echo esc_html( $author ); ?></h5>
					<?php if ( ! empty( $position ) ) { ?>
						<h6 class="edgtf-testimonials-author-job"><?php echo esc_html( $position ); ?></h6>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
	</div>
</div>