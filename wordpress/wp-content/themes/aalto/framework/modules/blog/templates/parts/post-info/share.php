<?php
$share_type = isset($share_type) ? $share_type : 'list';
?>
<?php if(aalto_edge_options()->getOptionValue('enable_social_share') === 'yes' && aalto_edge_options()->getOptionValue('enable_social_share_on_post') === 'yes') { ?>
    <div class="edgtf-blog-share">
        <h4><?php echo wp_kses_post('SHARE', 'aalto');?></h4>
        <?php echo aalto_edge_get_social_share_html(array('type' => $share_type)); ?>
    </div>
<?php } ?>