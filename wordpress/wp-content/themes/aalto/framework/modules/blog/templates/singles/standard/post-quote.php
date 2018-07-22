<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <div class="edgtf-post-content">
        <div class="edgtf-post-text">
            <div class="edgtf-post-text-inner">
                <div class="edgtf-post-info-top">
	                <?php aalto_edge_get_module_template_part('templates/parts/post-info/author', 'blog', '', $part_params); ?>
	                <?php aalto_edge_get_module_template_part('templates/parts/post-info/category', 'blog', '', $part_params); ?>
	                <?php aalto_edge_get_module_template_part('templates/parts/post-info/date', 'blog', '', $part_params); ?>
                </div>
                <div class="edgtf-post-text-main">
                    <?php aalto_edge_get_module_template_part('templates/parts/post-type/quote', 'blog', '', $part_params); ?>
                </div>
            </div>
        </div>
    </div>
    <div class="edgtf-post-additional-content">
        <?php the_content(); ?>
    </div>
    <div class="edgtf-post-info-bottom clearfix">
        <div class="edgtf-post-info-bottom-left">
			<?php aalto_edge_get_module_template_part('templates/parts/post-info/share', 'blog', '', $part_params); ?>
        </div>
    </div>
</article>