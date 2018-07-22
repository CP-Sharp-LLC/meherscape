<div class="edgtf-fullscreen-search-holder">
	<div class="edgtf-fullscreen-logo-holder">
		<?php aalto_edge_get_logo();?>
	</div>
	<a class="edgtf-fullscreen-search-close" href="javascript:void(0)">
		<?php aalto_edge_icon_collections()->getSearchClose('linear_icons', false); ?>
	</a>
	<div class="edgtf-fullscreen-search-table">
		<div class="edgtf-fullscreen-search-cell">
			<div class="edgtf-fullscreen-search-inner">
				<form action="<?php echo esc_url( home_url( '/' ) ); ?>" class="edgtf-fullscreen-search-form" method="get">
					<div class="edgtf-form-holder">
						<div class="edgtf-form-holder-inner">
							<div class="edgtf-field-holder">
								<input type="text" placeholder="<?php esc_html_e( 'TYPE YOUR SEARCH', 'aalto' ); ?>" name="s" class="edgtf-search-field" autocomplete="off"/>
							</div>
							<button type="submit" class="edgtf-search-submit"><?php aalto_edge_icon_collections()->getSearchIcon('linear_icons', false); ?></button>
							<div class="edgtf-line"></div>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>