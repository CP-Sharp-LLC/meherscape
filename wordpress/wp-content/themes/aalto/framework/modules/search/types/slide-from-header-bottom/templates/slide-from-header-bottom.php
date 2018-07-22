<div class="edgtf-slide-from-header-bottom-holder">
	<form action="<?php echo esc_url( home_url( '/' ) ); ?>" method="get">
		<div class="edgtf-form-holder">
			<input type="text" placeholder="<?php esc_html_e( 'Search', 'aalto' ); ?>" name="s" class="edgtf-search-field" autocomplete="off" />
			<button type="submit" class="edgtf-search-submit"><?php echo aalto_edge_icon_collections()->renderIcon( 'icon_search', 'font_elegant' ); ?></button>
		</div>
	</form>
</div>