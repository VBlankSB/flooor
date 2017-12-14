<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Flooor
 */

/**
 * Prints HTML with meta information for the current post-date/time and author.
 *=========================================================================================
 */
if ( ! function_exists( 'flooor_posted_on' ) ) :

	function flooor_posted_on() {
		$time_string = '<time class="entry-date published" datetime="%1$s" itemprop="dateModified">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<span class="posted-on"><time class="entry-date published" datetime="%1$s" itemprop="datePublished">%2$s</time></span><span class="updated-on"><time class=" entry-date updated" itemprop="dateModified" datetime="%3$s">%4$s</time></span>';
		}

		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		// If you want to have a link on the date
		//---------------------------------------
		// if (is_single() ) :
		// $posted_on = sprintf(
		// 	esc_html_x( 'Posted on %s', 'post date', 'flooor' ),
		// 	$time_string
		// );
		// else :
		// $posted_on = sprintf(
		// 	esc_html_x( 'Posted on %s', 'post date', 'flooor' ),
		// 	'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		// );
		// endif;

		// Without linking on date
		//------------------------
		$posted_on = sprintf(
		 	esc_html_x( 'Posted on %s', 'post date', 'flooor' ),
		 	$time_string
		);

		// If you want to have a link on the author in case multiple author
		// ----------------------------------------------------------------
		// $byline = sprintf(
		// 	esc_html_x( 'by %s', 'post author', 'flooor' ),
		// 	'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		// );

		// Without link on author
		// ----------------------
		$byline = sprintf(
			esc_html_x( 'by %s', 'post author', 'flooor' ),
			'<span class="author vcard">'. esc_html( get_the_author() ) .'</span>'
		);

		echo '<span class="posted-on">' . $posted_on . '</span><span class="byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

	}

endif;

/**
 * Prints HTML with meta information for the categories, tags and comments.
 *=========================================================================================
 */
if ( ! function_exists( 'flooor_entry_footer' ) ) :

	function flooor_entry_footer() {
		// No category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', 'flooor' ) );
			if ( $categories_list && flooor_categorized_blog() ) {
				printf( '<span class="cat-links">' . esc_html__( 'Category %1$s', 'flooor' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html__( ', ', 'flooor' ) );
			if ( $tags_list ) {
				printf( '<span class="tag-links">' . esc_html__( 'Tagged %1$s', 'flooor' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
		}

		edit_post_link(
			sprintf(
				/* translators: %s: Name of current post */
				esc_html__( 'Edit %s', 'flooor' ),
				the_title( '<span class="screen-reader-text">"', '"</span>', false )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}

endif;

/**
 * Function used in 404.php to return categories to visitor if there is more than one category in the site
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function flooor_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'flooor_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'flooor_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so flooor_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so flooor_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in flooor_categorized_blog.
 */
function flooor_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'flooor_categories' );
}
add_action( 'edit_category', 'flooor_category_transient_flusher' );
add_action( 'save_post',     'flooor_category_transient_flusher' );
