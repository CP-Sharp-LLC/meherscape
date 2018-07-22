<?php ?>
<div class="edgtf-portfolio-project-info-aalto-type">
    <?php
    $title_html = $this_object->getItemTitleHtml($params);
    $excerpt_html = $this_object->getItemExcerptHtml( $params );
    $image_html = $this_object->getItemImageHtml( $params );
    $second_image_html = $this_object->getItemSecondImageHtml($params); ?>

    <div class="edgtf-ppi-table-holder">
    <?php if($project_info_layout === 'info-right') { ?>
            <div class="edgtf-ppi-table-left">
                <?php
                print $image_html;
                ?>
            </div>
            <div class="edgtf-ppi-table-right edgtf-ppi-table-info-side">
                <?php
                    print $title_html;
                    print $excerpt_html;
                    print $second_image_html;
                ?>
            </div>
        <?php
    } else { ?>
        <div class="edgtf-ppi-table-left edgtf-ppi-table-info-side">
            <?php
            print $title_html;
            print $excerpt_html;
            print $second_image_html;
            ?>
        </div>
        <div class="edgtf-ppi-table-right">
            <?php
            print $image_html;
            ?>
        </div>
    <?php }
    ?>
    </div>
</div>