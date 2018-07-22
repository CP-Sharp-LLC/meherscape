<div class="edgtf-team edgtf-item-space <?php echo esc_attr($team_member_layout) ?>">
    <div class="edgtf-team-inner <?php echo esc_attr($skin); ?>">
        <?php if (get_the_post_thumbnail($member_id) !== '') { ?>
            <div class="edgtf-team-info-tb" <?php echo aalto_edge_get_inline_attrs($this_object->getParallaxDataReverse($params)); ?>>
                <div class="edgtf-team-info-tc">
                    <div class="edgtf-team-title-holder">
                        <h4 itemprop="name" class="edgtf-team-name entry-title">
                            <a itemprop="url" href="<?php echo esc_url(get_the_permalink($member_id)) ?>"><?php echo esc_html($title) ?></a>
                        </h4>
				        <?php if (!empty($position)) { ?>
                            <h6 class="edgtf-team-position"><?php echo esc_html($position); ?></h6>
				        <?php } ?>
                    </div>
					<?php if (is_array($team_social_icons) && count($team_social_icons)) { ?>
	                    <div class="edgtf-team-social-holder-between">
	                        <div class="edgtf-team-social">
	                            <div class="edgtf-team-social-inner">
	                                <div class="edgtf-team-social-wrapp">
						                <?php foreach($team_social_icons as $team_social_icon) {
							                echo wp_kses_post($team_social_icon);
						                } ?>
	                                </div>
	                            </div>
	                        </div>
	                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="edgtf-team-bg" <?php echo aalto_edge_get_inline_style($bg_image); ?>></div>
            <div class="edgtf-team-image"  <?php echo aalto_edge_get_inline_attrs($this_object->getParallaxData($params)); ?>>
                <?php echo get_the_post_thumbnail($member_id); ?>
            </div>
        <?php } ?>
    </div>
</div>