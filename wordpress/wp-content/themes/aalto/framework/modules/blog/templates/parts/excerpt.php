<?php
if(post_password_required()) {
	echo get_the_password_form();
} else {
	$excerpt_length = isset($params['excerpt_length']) ? $params['excerpt_length'] : '';
	$excerpt = aalto_edge_excerpt($excerpt_length);
	
	if(!empty($excerpt)) { ?>
		<div class="edgtf-post-excerpt-holder">
			<p itemprop="description" class="edgtf-post-excerpt">
				<?php echo wp_kses_post($excerpt); ?>
			</p>
		</div>
	<?php }
} ?>