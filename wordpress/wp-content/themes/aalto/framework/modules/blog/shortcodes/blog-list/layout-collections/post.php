<li class="edgtf-bl-item edgtf-item-space clearfix">
	<div class="edgtf-bli-inner">
		<?php if ( $post_info_image == 'yes' ) {
			aalto_edge_get_module_template_part( 'templates/parts/media', 'blog', '', $params );
		} ?>
        <div class="edgtf-bli-content">
	        <?php aalto_edge_get_module_template_part( 'templates/parts/title', 'blog', '', $params );
            if ($post_info_section == 'yes') { ?>
                <div class="edgtf-bli-info">
	                <?php
                        if ( $post_info_author == 'yes' ) {
                            aalto_edge_get_module_template_part( 'templates/parts/post-info/author', 'blog', '', $params );
                        }
                        if ( $post_info_category == 'yes' ) {
                            aalto_edge_get_module_template_part( 'templates/parts/post-info/category', 'blog', '', $params );
                        }
		                if ( $post_info_date == 'yes' ) {
			                aalto_edge_get_module_template_part( 'templates/parts/post-info/date', 'blog', '', $params );
		                }
		                if ( $post_info_comments == 'yes' ) {
			                aalto_edge_get_module_template_part( 'templates/parts/post-info/comments', 'blog', '', $params );
		                }
		                if ( $post_info_like == 'yes' ) {
			                aalto_edge_get_module_template_part( 'templates/parts/post-info/like', 'blog', '', $params );
		                }
		                if ( $post_info_share == 'yes' ) {
			                aalto_edge_get_module_template_part( 'templates/parts/post-info/share', 'blog', '', $params );
		                }
	                ?>
                </div>
            <?php } ?>
	
	        <div class="edgtf-bli-excerpt">
		        <?php aalto_edge_get_module_template_part( 'templates/parts/excerpt', 'blog', '', $params ); ?>
		        <?php aalto_edge_get_module_template_part( 'templates/parts/post-info/read-more', 'blog', '', $params ); ?>
	        </div>
        </div>
	</div>
</li>