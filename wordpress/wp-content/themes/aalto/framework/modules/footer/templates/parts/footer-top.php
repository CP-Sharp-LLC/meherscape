<div class="edgtf-footer-top-holder">
	<div class="edgtf-footer-top-inner <?php echo esc_attr($footer_top_grid_class); ?>">
		<div class="edgtf-grid-row <?php echo esc_attr($footer_top_classes); ?>">
			<?php for($i = 1; $i <= $footer_top_columns; $i++) { ?>
				<div class="edgtf-column-content edgtf-grid-col-<?php echo esc_attr(12 / $footer_top_columns); ?>">
					<?php
						if(is_active_sidebar('footer_top_column_'.$i)) {
							dynamic_sidebar('footer_top_column_'.$i);
						}
					?>
				</div>
			<?php } ?>
		</div>
	</div>
</div>