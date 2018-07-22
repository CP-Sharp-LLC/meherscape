<?php do_action('aalto_edge_before_page_header'); ?>

<header class="edgtf-page-header">
    <?php do_action('aalto_edge_after_page_header_html_open'); ?>

    <?php if($show_fixed_wrapper) : ?>
    <div class="edgtf-fixed-wrapper">
        <?php endif; ?>

        <div class="edgtf-menu-area">
            <?php do_action('aalto_edge_after_header_menu_area_html_open'); ?>

            <?php if($menu_area_in_grid) : ?>
            <div class="edgtf-grid">
                <?php endif; ?>

                <div class="edgtf-vertical-align-containers">
                    <div class="edgtf-position-left"><!--
				 --><div class="edgtf-position-left-inner">
                            <a href="javascript:void(0)" class="edgtf-fullscreen-menu-opener">
							<span class="edgtf-fm-lines">
								<span class="edgtf-line"></span>
								<span class="edgtf-line"></span>
								<span class="edgtf-line"></span>
							</span>
                            </a>
                        </div>
                    </div>
                    <div class="edgtf-position-center">
                        <div class="edgtf-position-center-inner">
                            <?php if(!$hide_logo) {
                                aalto_edge_get_logo();
                            } ?>
                        </div>
                    </div>
                    <div class="edgtf-position-right"><!--
				 --><div class="edgtf-position-right-inner">
                            <?php aalto_edge_get_header_widget_menu_area(); ?>
                        </div>
                    </div>
                </div>

                <?php if($menu_area_in_grid) : ?>
            </div>
        <?php endif; ?>
        </div>

        <?php if($show_fixed_wrapper) { ?>
    </div>
<?php } ?>

    <?php if($show_sticky) {
        aalto_edge_get_sticky_header('minimal', 'header/types/header-minimal');
    } ?>

    <?php do_action('aalto_edge_before_page_header_html_close'); ?>
</header>