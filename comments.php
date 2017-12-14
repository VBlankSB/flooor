<?php
/**
 * The template for displaying comments
 *
 * This is the template that displays the area of the page that contains both
 * the current comments and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Flooor
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php
	// You can start editing here -- including this comment!
	if ( have_comments() ) : ?>
		<h2 class="comments-title">
			<?php
				printf( // WPCS: XSS OK.
					esc_html( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'flooor' ) ),
					number_format_i18n( get_comments_number() ),
					'<span>' . get_the_title() . '</span>'
				);
			?>
		</h2><!-- .comments-title -->

		<ol class="comment-list">
			<?php
			// @link https://codex.wordpress.org/Function_Reference/wp_list_comments
				wp_list_comments( array(
					'style'      => 'ol',
					'short_ping' => false, // Set to False or True ???
					'avatar_size' => 56,
					'callback' => 'flooor_custom_comment' // Modify outpout of comment with custom function See : inc/template-functions.php and learn more on @link https://digwp.com/2010/02/custom-comments-html-output/
				) );
			?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
		<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
			<span class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'flooor' ); ?></span>
			<div class="nav-links">

				<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'flooor' ) ); ?></div>
				<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'flooor' ) ); ?></div>

			</div><!-- .nav-links -->
		</nav><!-- #comment-nav-below -->
		<?php
		endif; // Check for comment navigation.

	endif; // Check for have_comments().


	// If comments are closed and there are comments, let's leave a little note, shall we?
	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) : ?>

		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'flooor' ); ?></p>
	<?php
	endif;
	// Need to have title_reply with p not h3 !!!!
	// https://developer.wordpress.org/reference/functions/comment_form/
	$comments_args = array(
		// Change the title of the reply section
      'title_reply' => __( 'Something to add ?  Your turn !', 'flooor' ),
		// modify h3 to p
			'title_reply_before' => '<p id="reply-title" class="comment-reply-title">',
			'title_reply_after' => '</p>',
		// Change the title of send button
      'label_submit' => __( 'Send', 'flooor' ),
	);
	comment_form($comments_args);
	?>

</div><!-- #comments -->
