<?php do_action('aalto_edge_after_sticky_header'); ?>

<div class="edgtf-sticky-header">
    <?php do_action('aalto_edge_after_sticky_menu_html_open'); ?>
    <div class="edgtf-sticky-holder">
        <?php if ($sticky_header_in_grid) : ?>
        <div class="edgtf-grid">
            <?php endif; ?>
            <div class=" edgtf-vertical-align-containers">
                <div class="edgtf-position-left"><!--
				 --><div class="edgtf-position-left-inner">
                        <?php if (!$hide_logo) {
                            aalto_edge_get_logo('sticky');
                        } ?>
                    </div>
                </div>
                <div class="edgtf-position-right"><!--
				 --><div class="edgtf-position-right-inner">
                        <a href="javascript:void(0)" class="edgtf-fullscreen-menu-opener">
                            <span class="edgtf-fm-lines">
								<span class="edgtf-line"></span>
								<span class="edgtf-line"></span>
								<span class="edgtf-line"></span>
							</span>
                        </a>
                    </div>
                </div>
            </div>
            <?php if ($sticky_header_in_grid) : ?>
        </div>
    <?php endif; ?>
    </div>
</div>

<?php do_action('aalto_edge_after_sticky_header'); ?>
