<?php
/**
 * Additional features to allow styling the templates
 *
 * @package WordPress
 * @subpackage Flooor
 */

/**
 * Displays a post thumbnail with microdata
 *=========================================================================================
 *
 * Wraps the post thumbnail always in a div not in a link because and extend link is used on the title
 * See : data-expand-target and data-expand-link in template-parts/post/content.php
 * and in sass/components/ux.scss
 * @link https://codex.wordpress.org/fr:Marqueurs_de_Modele/the_post_thumbnail
 * @link https://www.seomix.fr/microformats-microdata-wordpress/
 */

if ( ! function_exists( 'flooor_post_thumbnail' ) ) :

    function flooor_post_thumbnail() {
    	if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
    	 	return;
    	} ?>

    	<div class="post-thumbnail">
    		<?php
    		global $post;
    		// gestion avancée des attributs
    			$attr_th = array(
    				'title'    => get_the_title(),
    				'itemprop'    => 'image',
    				'alt'        => '');
    			the_post_thumbnail( 'post-thumbnail', $attr_th );
    		// récupération de l’url de la miniature
    		$src = wp_get_attachment_image_src(
    		get_post_thumbnail_id($post->ID), 'thumbnail', false);
    		echo '<meta itemprop="thumbnailUrl" content="'.$src[0].'">'; ?>
    	</div><!-- .post-thumbnail -->

    	<?php
    }

endif;

/**
 * Modify the outpout of comments : Callback function for wp_list_comments
 *=========================================================================================
 *
 * Learn more on @link https://codex.wordpress.org/Function_Reference/wp_list_comments
 * Used in comments.php, easier to style the comments with it
 *
 */
if ( ! function_exists('flooor_custom_comment')) :

  function flooor_custom_comment( $comment, $args, $depth ) {
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    <?php if ( 'div' != $args['style'] ) : ?>
      <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php endif; ?>
    <span class="comment-author vcard">
      <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
      <?php printf( __( '<cite class="fn">%s</cite>', 'flooor' ), get_comment_author_link() ); ?>
    </span>
    <?php if ( $comment->comment_approved == '0' ) : ?>
      <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'flooor' ); ?></em>
      <br />
    <?php endif; ?>

    <span class="comment-meta commentmetadata">
      <?php
      $from = get_comment_time( 'U' );
      $to = current_time( 'timestamp' );
      $diff = (int) abs( $to - $from);
      if ( $diff >  MONTH_IN_SECONDS ) : ?>
          <span class="comment-date">
          <?php
          /* translators: 1: date, 2: time */
          printf( __('the %1$s at %2$s', 'flooor'), get_comment_date(),  get_comment_time() ); ?>
          </span>
      <?php else: ?>
          <span class="comment-since">
          <?php printf( _x( ', %s ago', '%s = human-readable time difference', 'flooor' ), human_time_diff( get_comment_time( 'U' ), current_time( 'timestamp' ) ) ); ?>
          </span>
      <?php endif; ?>
      <?php edit_comment_link( __( '(Edit)', 'flooor' ), '  ', '' ); ?>
    </span>

    <?php comment_text(); ?>

    <div class="reply">
      <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
    </div>
    <?php if ( 'div' != $args['style'] ) : ?>
    </div>
    <?php endif;
  }

endif;
