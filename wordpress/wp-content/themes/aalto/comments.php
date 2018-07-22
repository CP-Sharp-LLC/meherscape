<?php
if ( post_password_required() ) {
	return;
}

if ( comments_open() || get_comments_number() ) { ?>
	<div class="edgtf-comment-holder clearfix" id="comments">
		<?php if ( have_comments() ) { ?>
			<div class="edgtf-comment-holder-inner">
				<div class="edgtf-comments-title">
					<h4><?php esc_html_e( 'Comments', 'aalto' ); ?></h4>
				</div>
				<div class="edgtf-comments">
					<ul class="edgtf-comment-list">
						<?php wp_list_comments( array_unique( array_merge( array( 'callback' => 'aalto_edge_comment' ), apply_filters( 'aalto_edge_comments_callback', array() ) ) ) ); ?>
					</ul>
				</div>
			</div>
		<?php } ?>
		<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) { ?>
			<p><?php esc_html_e( 'Sorry, the comment form is closed at this time.', 'aalto' ); ?></p>
		<?php } ?>
	</div>
	<?php
		$edgtf_commenter = wp_get_current_commenter();
		$edgtf_req       = get_option( 'require_name_email' );
		$edgtf_aria_req  = ( $edgtf_req ? " aria-required='true'" : '' );
		
		$edgtf_args = array(
			'id_form'              => 'commentform',
			'id_submit'            => 'submit_comment',
			'title_reply'          => esc_html__( 'Post a Comment', 'aalto' ),
			'title_reply_before'   => '<h4  id="reply-title" class="comment-reply-title">',
			'title_reply_after'    => '</h4>',
			'title_reply_to'       => esc_html__( 'Post a Reply to %s', 'aalto' ),
			'cancel_reply_link'    => esc_html__( 'cancel reply', 'aalto' ),
			'label_submit'         => esc_html__( 'Submit', 'aalto' ),
			'comment_field'        => apply_filters( 'aalto_edge_comment_form_textarea_field', '<textarea id="comment" placeholder="' . esc_html__( 'Write your comment...', 'aalto' ) . '" name="comment" cols="45" rows="4" aria-required="true"></textarea>' ),
			'comment_notes_before' => '',
			'comment_notes_after'  => '',
			'fields'               => apply_filters( 'aalto_edge_comment_form_default_fields', array(
				'author' => '<input id="author" name="author" placeholder="' . esc_html__( 'Name', 'aalto' ) . '" type="text" value="' . esc_attr( $edgtf_commenter['comment_author'] ) . '"' . $edgtf_aria_req . ' />',
				'email'  => '<input id="email" name="email" placeholder="' . esc_html__( 'Email', 'aalto' ) . '" type="text" value="' . esc_attr( $edgtf_commenter['comment_author_email'] ) . '"' . $edgtf_aria_req . ' />'
			) )
		);
		
	if ( get_comment_pages_count() > 1 ) { ?>
		<div class="edgtf-comment-pager">
			<p><?php paginate_comments_links(); ?></p>
		</div>
	<?php } ?>

    <?php
    $edgtf_show_comment_form = apply_filters('aalto_edge_show_comment_form_filter', true);
    if($edgtf_show_comment_form) {
    ?>
        <div class="edgtf-comment-form">
            <div class="edgtf-comment-form-inner">
                <?php comment_form( $edgtf_args ); ?>
            </div>
        </div>
    <?php } ?>
<?php } ?>	