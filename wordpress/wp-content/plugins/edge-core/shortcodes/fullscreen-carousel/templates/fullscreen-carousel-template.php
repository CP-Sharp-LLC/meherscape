<div <?php aalto_edge_class_attribute($holder_classes); ?>>
    <?php if(!empty($carousel_items)) { ?>
		<div class="edgtf-fsc-next-trigger"></div>
		<div class="edgtf-fsc-inner">
			<?php $i = 1; ?>
	            <?php foreach($carousel_items as $item):?>
	            	<div class="edgtf-fsc-item" data-index="<?php echo esc_attr($i); ?>">
	            		<div class="edgtf-fsc-item-text-holder">
	            			<div class="edgtf-fsc-item-text-holder-inner">          			
		            			<div class="edgtf-fsc-item-text-holder-table">          			
			            			<div class="edgtf-fsc-item-text-holder-cell">          			
				                		<?php if(!empty($item['item_title'])) { ?>
					                		<div class="edgtf-fsc-item-title-holder">
					                			<a href="<?php echo esc_url($item['item_link']); ?>" target="$items_link_target">
						                			<h1 class="edgtf-fsc-item-title"><?php echo esc_attr($item['item_title']); ?></h1>
						                		</a>
					                		</div>
				                		<?php } ?>
				                		<div class="edgtf-fsc-btn-holder">
					                		<?php if(!empty($item['item_link'])) { ?>
				    							<?php echo aalto_edge_get_button_html(array(
				    								'link' => $item['item_link'],
				    								'text' => $item['item_link_text'],
				    								'target' => $items_link_target,
				    								'type' => 'simple',
				    		                        'size' => 'large',
				    		                        'enable_arrow' => 'yes',
				    		                        'custom_class' => 'edgtf-fsc-btn'
				    							)); ?>
					                		<?php } ?>
				                		</div>
				                	</div>
			                	</div>
		                	</div>
		            	</div>
		            	<div class="edgtf-fsc-item-image-holder">
			            	<?php 
			                	$bgrnd_img_style = '';

			            		if(!empty($item['item_image'])) {
			                		$bgrnd_img_style .= "background-image: url(" . wp_get_attachment_url($item['item_image']) . ");"; 
			                	}
			            	?>
		            		<div class="edgtf-fsc-item-image" <?php echo aalto_edge_get_inline_style($bgrnd_img_style); ?>></div>
		            	</div>
	            	</div>
            	<?php $i++; ?>
            <?php endforeach; ?>
		</div>
	    <?php if ($enable_progress_indicator == 'yes') { ?>
		    <div class="edgtf-fsc-indicator-holder">
			    <?php foreach ($carousel_items as $indicator): ?>
			        <span class="edgtf-fsc-indicator-bullet"></span>
			    <?php endforeach; ?>
			</div>
	    <?php } ?>
    <?php } ?>
</div>