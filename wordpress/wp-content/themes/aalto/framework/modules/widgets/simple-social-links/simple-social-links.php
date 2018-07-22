<?php

class AaltoEdgeSimpleSocialLinksWidget extends AaltoEdgeWidget {
    public function __construct() {
        parent::__construct(
            'edgtf_simple_social_links_widget',
            esc_html__( 'Edge Simple Social Links Widget', 'aalto' ),
            array( 'description' => esc_html__( 'Add simple social links to widget areas', 'aalto' ) )
        );

        $this->setParams();
    }

    protected function setParams() {
        $this->params = array_merge(
            array(
                array(
                    'type'  => 'textfield',
                    'name'  => 'link',
                    'title' => esc_html__( 'Link', 'aalto' )
                ),
                array(
                    'type'    => 'dropdown',
                    'name'    => 'target',
                    'title'   => esc_html__( 'Target', 'aalto' ),
                    'options' => aalto_edge_get_link_target_array()
                ),
                array(
                    'type'  => 'textfield',
                    'name'  => 'link_text',
                    'title' => esc_html__( 'Link Text', 'aalto' )
                ),
                array(
                    'type'  => 'textfield',
                    'name'  => 'link_color',
                    'title' => esc_html__( 'Link Color', 'aalto' )
                ),
                array(
                    'type'  => 'textfield',
                    'name'  => 'link_font_size',
                    'title' => esc_html__( 'Link font size in px', 'aalto' )
                ),
                array(
                    'type'  => 'textfield',
                    'name'  => 'link_margin',
                    'title' => esc_html__( 'Enter Margin in top right bottom left format. Include px after value', 'aalto' )
                ),
            )
        );
    }

    public function widget( $args, $instance ) {
        if ( ! is_array( $instance ) ) {
            $instance = array();
        }

        $single_link_item_style = array();

        if(!empty($instance['link_color'])) {
            $single_link_item_style[] = 'color:'.$instance['link_color'];
        }

        if(!empty($instance['link_font_size'])) {
            $single_link_item_style[] = 'font-size:'.$instance['link_font_size'];
        }

        if(!empty($instance['link_margin'])) {
            $single_link_item_style[] = 'margin:'.$instance['link_margin'];
        } ?>

        <div class="edgtf-single-social-link-widget">
            <?php if(!empty($instance['link'])) { ?>
            <h6>
                <a href="<?php echo esc_url($instance['link']); ?>" class="edgtf-social-link" <?php echo aalto_edge_get_inline_style($single_link_item_style); ?>>
                    <?php echo esc_html($instance['link_text']); ?>
                </a>
            </h6>
            <?php } ?>
        </div>

<?php }
}

