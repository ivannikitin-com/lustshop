<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package lustshop
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}

$defaults = [
	'fields'               => [
		'author' => '<div class="form-group col-lg-6">
			<input class="form-control" id="author" name="author" placeholder="'. __( 'Name', 'lustshop' ) .'" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . $html_req . ' />
		</div>',
		'email'  => '<div class="form-group col-lg-6">
			<input class="form-control" id="email" name="email" placeholder="'. __( 'Email', 'lustshop' ) .'" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-describedby="email-notes"' . $aria_req . $html_req  . ' />
		</div>',
		'cookies' => '<div class="form-group d-none">'.
			 sprintf( '<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"%s />', $consent ) .'
			 <label for="wp-comment-cookies-consent">'. __( 'Save my name, email, and website in this browser for the next time I comment.' ) .'</label>
		</div>',        
	],
	'comment_field'        => '<div class="form-group col-lg-12">	
		<textarea class="form-control" id="comment" placeholder="' . __( 'Comment', 'lustshop' ) . '" name="comment" cols="45" rows="8"  aria-required="true" required="required"></textarea>
	</div>',
	'must_log_in'          => '<p class="must-log-in">' . 
		 sprintf( __( 'You must be <a href="%s">logged in</a> to post a comment.' ), wp_login_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '
	 </p>',
	'logged_in_as'         => '<p class="logged-in-as d-none">' . 
		 sprintf( __( '<a href="%1$s" aria-label="Logged in as %2$s. Edit your profile.">Logged in as %2$s</a>. <a href="%3$s">Log out?</a>' ), get_edit_user_link(), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink( $post_id ) ) ) ) . '
	 </p>',
	'comment_notes_before' => '<p class="comment-notes d-none">
		<span id="email-notes">' . __( 'Your email address will not be published.' ) . '</span>'. 
		( $req ? $required_text : '' ) . '
	</p>',
	'comment_notes_after'  => '',
	'id_form'              => 'commentform',
	'id_submit'            => 'submit',
	'class_form'           => 'form-row',
	'class_submit'         => 'wp-block-lustshop-button wp-block-lustshop-button--primary comments__button',
	'name_submit'          => 'submit',
	'title_reply'          => __( 'Leave a Reply' ),
	'title_reply_to'       => __( 'Leave a Reply to %s' ),
	'title_reply_before'   => '<h3 id="reply-title" class="comments__title">',
	'title_reply_after'    => '</h3>',
	'cancel_reply_before'  => ' <small>',
	'cancel_reply_after'   => '</small>',
	'cancel_reply_link'    => __( 'Cancel reply' ),
	'label_submit'         => __( 'Post Comment', 'lustshop' ),
	'submit_button'        => '<button name="%1$s" type="submit" id="%2$s" class="%3$s">%4$s</button>',
	'submit_field'         => '<p class="form-submit">%1$s %2$s</p>',
	'format'               => 'xhtml',
];

?>

<div id="comments" class="comments">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) :
		?>
		<h2 class="comments__title">
			<?php
			$lustshop_comment_count = get_comments_number();
				printf(
					/* translators: 1: title. */
					esc_html__( 'Comments %1$s', 'lustshop' ),
					'<span class="comments__title-number">(' . number_format_i18n( $lustshop_comment_count ) . ')</span>'
				);
			?>
		</h2><!-- .comments-title -->

		<?php the_comments_navigation(); ?>

		<ol class="comments__list">
			<?php
			wp_list_comments( array(
				'style'      => 'ul',
				'short_ping' => true,
				'avatar_size' => 73,
				'callback' => 'LustShop::comment_template'
			) );
			?>
		</ol><!-- .comment-list -->

		<?php
		the_comments_navigation();

		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() ) :
			?>
			<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'lustshop' ); ?></p>
			<?php
		endif;

	endif; // Check for have_comments().

	comment_form( $defaults );
	?>

</div><!-- #comments -->
