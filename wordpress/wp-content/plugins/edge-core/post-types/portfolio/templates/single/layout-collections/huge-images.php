<div class="edgtf-grid-row">
    <div class="edgtf-grid-col-9">
        <div class="edgtf-ps-image-holder">
            <div class="edgtf-ps-image-inner">
                <?php
                $media = edgtf_core_get_portfolio_single_media();
                
                if(is_array($media) && count($media)) : ?>
                    <?php foreach($media as $single_media) : ?>
                        <div class="edgtf-ps-image">
                            <?php edgtf_core_get_portfolio_single_media_html($single_media); ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="edgtf-grid-col-3">
        <div class="edgtf-ps-info-holder edgtf-ps-info-sticky-holder">
            <?php
            //get portfolio content section
            edgtf_core_get_cpt_single_module_template_part('templates/single/parts/content', 'portfolio', $item_layout);
            
            //get portfolio custom fields section
            edgtf_core_get_cpt_single_module_template_part('templates/single/parts/custom-fields', 'portfolio', $item_layout);
            
            //get portfolio categories section
            edgtf_core_get_cpt_single_module_template_part('templates/single/parts/categories', 'portfolio', $item_layout);
            
            //get portfolio date section
            edgtf_core_get_cpt_single_module_template_part('templates/single/parts/date', 'portfolio', $item_layout);
            
            //get portfolio tags section
            edgtf_core_get_cpt_single_module_template_part('templates/single/parts/tags', 'portfolio', $item_layout);
            
            //get portfolio share section
            edgtf_core_get_cpt_single_module_template_part('templates/single/parts/social', 'portfolio', $item_layout);
            ?>
        </div>
    </div>
</div>