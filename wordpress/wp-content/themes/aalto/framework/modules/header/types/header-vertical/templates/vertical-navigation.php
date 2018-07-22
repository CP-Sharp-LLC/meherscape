<?php do_action('aalto_edge_before_top_navigation'); ?>
<div class="edgtf-vertical-menu-outer">
	<nav class="edgtf-vertical-menu edgtf-vertical-dropdown-on-click">
		<?php
			wp_nav_menu(array(
				'theme_location'  => 'vertical-navigation',
				'container'       => '',
				'container_class' => '',
				'menu_class'      => '',
				'menu_id'         => '',
				'fallback_cb'     => 'top_navigation_fallback',
				'link_before'     => '<span>',
				'link_after'      => '</span>',
				'walker'          => new AaltoEdgeTopNavigationWalker()
			));
		?>
	</nav>
</div>
<?php do_action('aalto_edge_after_top_navigation'); ?>