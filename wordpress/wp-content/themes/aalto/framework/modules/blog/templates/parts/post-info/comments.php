<?php if(comments_open()) { ?>
	<div class="edgtf-post-info-comments-holder">
		<a itemprop="url" class="edgtf-post-info-comments" href="<?php comments_link(); ?>" target="_self">
			<?php comments_number('0 ' . esc_html__('Comments','aalto'), '1 '.esc_html__('Comment','aalto'), '% '.esc_html__('Comments','aalto') ); ?>
		</a>
	</div>
<?php } ?>