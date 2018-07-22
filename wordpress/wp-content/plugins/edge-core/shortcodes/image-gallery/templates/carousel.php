<?php
$i    = 0;
$rand = rand(0,1000);
?>
<div class="edgtf-image-gallery <?php echo esc_attr($holder_classes); ?>">
	<div class="edgtf-ig-slider edgtf-owl-slider" <?php echo aalto_edge_get_inline_attrs($slider_data); ?>>
		<?php foreach ($images as $image) { ?>
			<div class="edgtf-ig-image">
				<?php if ($image_behavior === 'lightbox') { ?>
					<a itemprop="image" class="edgtf-ig-lightbox edgtf-block-drag-link" href="<?php echo esc_url($image['url']); ?>" data-rel="prettyPhoto[image_gallery_pretty_photo-<?php echo esc_attr($rand); ?>]" title="<?php echo esc_attr($image['title']); ?>">
				<?php } else if ($image_behavior === 'custom-link' && !empty($custom_links)) { ?>
					<a itemprop="url" class="edgtf-ig-custom-link edgtf-block-drag-link" href="<?php echo esc_url($custom_links[$i++]); ?>" target="<?php echo esc_attr($custom_link_target); ?>" title="<?php echo esc_attr($image['title']); ?>">
				<?php } ?>
					<?php if(is_array($image_size) && count($image_size)) :
						echo aalto_edge_generate_thumbnail($image['image_id'], null, $image_size[0], $image_size[1]);
					else:
						echo wp_get_attachment_image($image['image_id'], $image_size);
					endif; ?>
				<?php if ($image_behavior === 'lightbox' || $image_behavior === 'custom-link') { ?>
					</a>
				<?php } ?>
			</div>
		<?php } ?>
	</div>
</div>