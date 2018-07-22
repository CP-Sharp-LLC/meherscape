<?php

aalto_edge_get_single_post_format_html($blog_single_type);

do_action('aalto_edge_after_article_content');

aalto_edge_get_module_template_part('templates/parts/single/author-info', 'blog');

aalto_edge_get_module_template_part('templates/parts/single/single-navigation', 'blog');

aalto_edge_get_module_template_part('templates/parts/single/related-posts', 'blog', '', $single_info_params);

aalto_edge_get_module_template_part('templates/parts/single/comments', 'blog');