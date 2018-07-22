<li class="edgtf-tl-item edgtf-item-space">
    <div class="edgtf-tli-inner">
        <div class="edgtf-tli-content">
            <div class="edgtf-twitter-content-left">
	            <a href="<?php echo esc_url( $twitter_api->getHelper()->getTweetProfileURL( $tweet ) ); ?>" target="_blank" itemprop="url">
	                <i class="edgtf-twitter-icon social_twitter"></i>
	            </a>
            </div>
            <div class="edgtf-twitter-content-right">
                <div class="edgtf-tweet-text">
                    <?php echo wp_kses_post( $twitter_api->getHelper()->getTweetText( $tweet ) ); ?>
                </div>
            </div>
        </div>
    </div>
</li>