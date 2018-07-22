<?php aalto_edge_get_content_bottom_area(); ?>
</div> <!-- close div.content_inner -->
	</div>  <!-- close div.content -->
		<?php if($display_footer && ($display_footer_top || $display_footer_bottom)) { ?>
			<footer class="edgtf-page-footer">
				<?php
					if($display_footer_top) {
						aalto_edge_get_footer_top();
					}
					if($display_footer_bottom) {
						aalto_edge_get_footer_bottom();
					}
				?>
			</footer>
		<?php } ?>
	</div> <!-- close div.edgtf-wrapper-inner  -->
</div> <!-- close div.edgtf-wrapper -->
<?php wp_footer(); ?>
</body>
</html>