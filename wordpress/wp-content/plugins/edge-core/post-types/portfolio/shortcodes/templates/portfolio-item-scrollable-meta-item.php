<div class="edgtf-ptf-list-showcase-meta-item">
    <?php if ($additional_data == 'year'){ ?>
        <span class="edgtf-ptf-meta-item-date-year"><?php the_time('Y'); ?></span>
    <?php }
    else {
        print $category_html;
    } ?>
    <<?php echo esc_attr($title_tag)?> class="edgtf-ptf-meta-item-title">
    <a href="<?php echo esc_url($this_object->getItemLink()); ?>" target="<?php echo esc_attr($this_object->getItemLinkTarget()); ?>"><?php the_title(); ?></a>
</<?php echo esc_attr($title_tag)?>>
<h6 class="edgtf-ptf-view-holder">
    <a href="<?php echo esc_url($this_object->getItemLink()); ?>" target="<?php echo esc_attr($this_object->getItemLinkTarget()); ?>">
    	<span class="edgtf-btn-arrow">
            <svg version="1.1" id="btn-arrow-<?php echo rand();?>" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                 width="18px" height="4px" viewBox="0 0 18 4" enable-background="new 0 0 18 4" xml:space="preserve">
            	<polyline fill="none" stroke="#323232" stroke-miterlimit="10" points="0,3.508 16.809,3.508 13.686,0.342 "/>
            </svg>
        </span>
    </a>
</h6>
</div>