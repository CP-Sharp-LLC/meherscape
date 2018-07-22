<section class="edgtf-side-menu">
	<div class="edgtf-close-side-menu-holder">
		<a class="edgtf-close-side-menu" href="#" target="_self">
			<?php echo aalto_edge_icon_collections()->renderIcon( 'icon_close', 'font_elegant' ); ?>
		</a>
	</div>
	<?php if ( is_active_sidebar( 'sidearea' ) ) {
		dynamic_sidebar( 'sidearea' );
	} ?>
</section>