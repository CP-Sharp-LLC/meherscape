<div class="edgtf-tabs-navigation-wrapper">
    <ul class="nav nav-tabs">
        <?php
        foreach (aalto_edge_options()->adminPages as $key => $page ) {
            $slug = "";
            if (!empty($page->slug)) $slug = "_tab".$page->slug;
            ?>
            <li<?php if ($page->slug == $tab) echo " class=\"active\""; ?>>
                <a href="<?php echo esc_url(get_admin_url().'admin.php?page=aalto_edge_theme_menu'.$slug); ?>">
                    <?php if($page->icon !== '') { ?>
                        <i class="<?php echo esc_attr($page->icon); ?> edgtf-tooltip edgtf-inline-tooltip left" data-placement="top" data-toggle="tooltip" title="<?php echo esc_attr($page->title); ?>"></i>
                    <?php } ?>
                    <span><?php echo esc_html($page->title); ?></span>
                </a>
            </li>
        <?php
        }
        ?>
        <?php if (aalto_edge_core_plugin_installed()) { ?>
			<li <?php if($is_backup_options_page) { echo "class='active'"; } ?>><a href="<?php echo esc_url(get_admin_url().'admin.php?page=aalto_edge_theme_menu_backup_options'); ?>"><i class="fa fa-database edgtf-tooltip edgtf-inline-tooltip left" data-placement="top" data-toggle="tooltip" title="<?php esc_html_e('Backup Options','aalto'); ?>"></i><span><?php esc_html_e('Backup Options','aalto'); ?></span></a></li>
			<li <?php if($is_import_page) { echo "class='active'"; } ?>><a href="<?php echo esc_url(get_admin_url().'admin.php?page=aalto_edge_theme_menu_tabimport'); ?>"><i class="fa fa-download edgtf-tooltip edgtf-inline-tooltip left" data-placement="top" data-toggle="tooltip" title="<?php esc_html_e('Import','aalto'); ?>"></i><span><?php esc_html_e('Import','aalto'); ?></span></a></li>
        <?php } ?>
    </ul>
</div>