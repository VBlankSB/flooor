<?php
/**
 * Securize Wordpress
 *
 * Custom functions that act independently of the theme templates
 *
 * @package Flooor
 */

/**
 * Hide Login Errors (if you don't have Secupress pro version)
 *=========================================================================================
 */
add_filter('login_errors', create_function('$a', "return null;"));

/**
 * Remove theme Editor
 *=========================================================================================
 * To update your files it's better to use FTP Client like Filezilla
 * Or WPCLI with SSH
 * Better to put this security in wp-config.php (added by Secupress freemium, so comment if you use Secupress)
 */
define( 'DISALLOW_FILE_EDIT', true );

/**
 * Removes from head unnecessary things added by default by WP CORE
 *=========================================================================================
 * 1. Don't need support for Windows Live Writer
 * 2. Don't need the API to edit post from external services and clients
 * 3. Supprime le flux general des articles
 * 4. Supprime les flux complémentaires des articles comme les catégories ...
 * 5. Supprime la balise contenant l'attribut rel=index. ?? pas présent
 * 6. supprime le shortlink ?? pas présent
 * 7. No need “shortlink” into document head that will look like http://example.com/?p=ID ?? pas présent
 * 8 & 9. Removes a link to the next and previous post from the document header. This could be theoretically beneficial, but it introduces more problems than it solves. Please note that this has nothing to deal with the “next/previous” post that you may want to add at the end of each post. ?? pas présent sauf si on utilise Yoast ou SeoPress
 * 10. Supprime le lien vers le post parent
 */
if ( ! function_exists( 'flooor_cleanup_setup' ) ) :
	function flooor_cleanup_setup () {
		// Removes WP version from head
		remove_action('wp_head', 'wp_generator');

		// Removes some links
		remove_action( 'wp_head', 'wlwmanifest_link' ); /* 1 */
		remove_action( 'wp_head', 'rsd_link' ); /* 2 */

		remove_action( 'wp_head', 'feed_links', 2 ); /* 3 */
		remove_action( 'wp_head', 'feed_links_extra', 3 ); /* 4 */

		remove_action( 'wp_head', 'index_rel_link' ); /* 5 */

		remove_action( 'wp_head', 'wp_shortlink_wp_head', 10, 0 ); /* 6 */
		remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 ); /* 7 */

		remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 ); /* 8 */
		remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); /* 9 */

		remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); /* 10 */

		// Removes from the RSS feeds : the generator name
		add_filter('the_generator', '__return_false');

		// Removes from the RSS feeds : comments feed Link Since WP 4.4.0
		add_filter( 'feed_links_show_comments_feed', '__return_false' );

	}
endif;
add_action('after_setup_theme', 'flooor_cleanup_setup');
