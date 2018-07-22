<div class="edgtf-pfs-image-holder-item" <?php aalto_edge_inline_style($this_object->getItemBackgroundImage())?>>
	<div class="edgtf-pfs-text-holder">
		<div class="edgtf-pfs-text-holder-inner">
			<h1 class="edgtf-pfs-item-desc"><?php echo esc_html($this_object->getItemDescription())?></h1>
			<?php 
				echo aalto_edge_get_button_html(array(
					'type' => 'simple',
					'link' => get_the_permalink(),
					'size' => 'large',
					'text' => esc_html__('View Project', 'edge-core'),
					'enable_arrow' => 'yes'
				));
			?>
		</div>
	</div>
</div>