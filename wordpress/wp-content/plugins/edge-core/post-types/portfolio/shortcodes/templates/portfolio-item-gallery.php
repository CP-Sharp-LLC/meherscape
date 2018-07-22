<?php
$media = edgtf_core_get_portfolio_single_media();
?>
<article class="edgtf-pl-item edgtf-item-space <?php echo esc_attr($this_object->getArticleClasses($params)); ?>">
    <div class="edgtf-pl-item-inner">
        <?php echo edgtf_core_get_cpt_shortcode_module_template_part('portfolio', 'layout-collections/'.$item_style, '', $params); ?>

        <?php if(is_array($media) && count($media) > 0) : ?>
            <?php echo edgtf_core_get_cpt_shortcode_module_template_part('portfolio', 'parts/image-gallery', '', $params); ?>
        <?php endif; ?>
    </div>
</article>