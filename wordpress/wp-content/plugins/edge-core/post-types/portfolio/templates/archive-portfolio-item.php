<?php
get_header();
aalto_edge_get_title();
do_action( 'aalto_edge_before_main_content' ); ?>
<div class="edgtf-container edgtf-default-page-template">
	<?php do_action( 'aalto_edge_after_container_open' ); ?>
	<div class="edgtf-container-inner clearfix">
		<?php
			$edgtf_taxonomy_id = get_queried_object_id();
			$edgtf_taxonomy_type = is_tax( 'portfolio-tag' ) ? 'portfolio-tag' : 'portfolio-category';
			$edgtf_taxonomy = !empty($edgtf_taxonomy_id) ? get_term_by( 'id', $edgtf_taxonomy_id, $edgtf_taxonomy_type ) : '';
			$edgtf_taxonomy_slug = !empty($edgtf_taxonomy) ? $edgtf_taxonomy->slug : '';
			$edgtf_taxonomy_name = !empty($edgtf_taxonomy) ? $edgtf_taxonomy->taxonomy : '';
		
			edgtf_core_get_archive_portfolio_list($edgtf_taxonomy_slug, $edgtf_taxonomy_name);
		?>
	</div>
	<?php do_action( 'aalto_edge_before_container_close' ); ?>
</div>
<?php get_footer(); ?>