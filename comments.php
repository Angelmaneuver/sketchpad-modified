<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package sketchpad
 * @since   1.7.0
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */

if ( post_password_required() ) {
	return;
} ?>
<div id="comments" class="comments-area">
	<?php if ( ! comments_open() ) { ?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'sketchpad-modified' ); ?></p>
		<?php
		return;
	} // ! comments_open
	if ( have_comments() ) {
		?>
		<h3 class="comments-title">
			<?php
			echo esc_html(
				sprintf(
					/* translators: %1$s: comments number, %2$s: article title */
					_n( '%1$s Response to &ldquo;%2$s&rdquo;', '%1$s Responses to &ldquo;%2$s&rdquo;', get_comments_number(), 'sketchpad-modified' ),
					number_format_i18n( get_comments_number() ),
					get_the_title()
				)
			);
			?>
		</h3>
		<ol class="comment-list">
			<?php
			wp_list_comments(
				array(
					'style'      => 'ol',
					'reply_text' => __( 'Reply', 'sketchpad-modified' ),
					'login_text' => __( 'Log in to Reply', 'sketchpad-modified' ),
				)
			);
			?>
		</ol><!-- .comment-list -->
		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) { ?>
		<div class="pagination">
			<?php
			the_paginate_comments_links(
				array(
					'prev_text' => '&laquo;',
					'next_text' => '&raquo;',
				)
			);
			?>
			</div><!-- #comment-nav-below -->
			<?php
		} // Check for comment navigation
	} // have_comments
	comment_form(
		array(
			'comment_field'        => '<p class="comment-form-comment"><label for="comment">' . _x( 'Comment', 'noun', 'sketchpad-modified' ) . '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea></p>',
			'must_log_in'          => '<p class="must-log-in">' . sprintf( __( 'You must be ', 'sketchpad-modified' ) . '<a href="%s">' . __( 'logged in', 'sketchpad-modified' ) . '</a>' . __( ' to post a comment.', 'sketchpad-modified' ), wp_login_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p>',
			'logged_in_as'         => '<p class="logged-in-as">' . sprintf( __( 'Logged in as ', 'sketchpad-modified' ) . '<a href="%1$s">%2$s</a><a href="%3$s" title="' . __( 'Log out of this account', 'sketchpad-modified' ) . '">' . __( ' Log out?', 'sketchpad-modified' ) . '</a>', admin_url( 'profile.php' ), $user_identity, wp_logout_url( apply_filters( 'the_permalink', get_permalink() ) ) ) . '</p>',
			'comment_notes_before' => '<p class="comment-notes">' . __( 'Your email address will not be published.', 'sketchpad-modified' ) . '</p>',
			/* translators: %s: allowed tags and attributes string */
			'comment_notes_after'  => '<p class="form-allowed-tags">' . sprintf( __( 'You may use these ', 'sketchpad-modified' ) . '<abbr title="HyperText Markup Language">HTML</abbr>' . __( ' tags and attributes: %s', 'sketchpad-modified' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',
			'title_reply'          => __( 'Leave a Reply', 'sketchpad-modified' ),
			/* translators: %s: comment user name */
			'title_reply_to'       => __( 'Leave a Reply to %s', 'sketchpad-modified' ),
			'cancel_reply_link'    => __( 'Cancel reply', 'sketchpad-modified' ),
			'label_submit'         => __( 'Post Comment', 'sketchpad-modified' ),
		)
	);
	?>
</div><!-- #comments -->
