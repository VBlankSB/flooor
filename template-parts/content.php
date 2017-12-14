<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Wordpress
 * @subpackage Flooor
 * @version 1.0
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> itemscope itemtype="http://schema.org/BlogPosting" role="article">

	<header class="entry-header" >
		<?php if ( has_post_thumbnail() ) :

			if ( is_single() ) : ?>
				<div class="thumbnail-and-title">
					<?php
					flooor_post_thumbnail();
					the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' );
					?>
				</div>
			<?php else: ?>
				<div class="thumbnail-and-title" data-expand-target>
					<?php
					flooor_post_thumbnail();
					the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark" itemprop="url" data-expand-link >', '</a></h2>' );
					?>
				</div>
			<?php endif; ?>

		<?php else:

			if ( is_single() ) :
				the_title( '<h1 class="entry-title" itemprop="headline">', '</h1>' );
			else:
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			endif; ?>

		<?php endif; ?>

		<div class="entry-meta">
			<?php if ( 'post' === get_post_type() ) : ?>

				<?php // Don't use flooor_posted_on();  in inc/template-tags.php for the moment !  ?>
				<!-- date published -->
				<span class="posted-on">
					<time class="entry-date published updated" datetime="<?php the_time(get_option('date_format')); ?>" itemprop="datePublished"><?php the_time(get_option('date_format')); ?></time>
				</span>
				<!-- date modified -->
				<?php if (get_the_modified_date() != get_the_date()) : ?>
				<span class="updated-on">
					<time datetime="<?php the_modified_time('c'); ?>" itemprop="dateModified"><?php the_modified_time('d F Y'); ?></time>
				</span>
				<?php endif; ?>

				<!-- the author -->
				<span class="author vcard">
					<?php echo get_the_author(); ?>
				</span>

			<?php endif; ?>
		</div><!-- END .entry-meta -->

	</header><!-- END .entry-header -->

	<?php // Si on est sur une page de commentaires on n'affiche que le résumé de l'article
	$cpage = get_query_var( 'cpage' );

	if ( is_singular() && $cpage > 0 ): ?>
		<div class="entry-summary" itemprop="articleExcerpt">
			<?php the_excerpt(); ?>
		</div><!-- .entry-content -->

	<?php // Si on est sur une page seule on affiche l'article
	elseif ( is_singular() ): ?>
		<div class="entry-content" itemprop="articleBody">
			<?php
				the_content();

				wp_link_pages( array(
					'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'flooor' ),
					'after'  => '</div>',
				) );
			?>
		</div><!-- .entry-content -->

	<?php // Sur la page home affichant les derniers articles du blog, toujours utiliser le résumé généré par l'extrait. NE PAS OUBLIER DE L'AJOUTER sinon extrait par défaut de 55 mots
	elseif ( is_home() ): ?>
		<div class="entry-summary" itemprop="articleExcerpt">
			<?php the_excerpt(); ?>
		</div><!-- .entry-content -->

	<?php // Sur les autres pages utiliser le contenu tronqué par le marqueur more NE PAS OUBLIER DE L'AJOUTER (NB: the_content() ne donnera ici que le début de l'article)
	else : ?>

		<div class="entry-summary" itemprop="articleExcerpt">
			<?php
				the_content( sprintf(
					__( 'Continue reading %s', 'flooor' ),
					the_title( '<span class="screen-reader-text">', '</span>', false )
				) );
			?>
		</div><!-- .entry-summary -->

	<?php endif; ?>

	<footer class="entry-footer">
		<?php // Don't use flooor_entry_footer(); in : inc/template-tags.php for the moment !  ?>

		<?php if ( 'post' === get_post_type() ) : ?>

			<!-- post-format -->
			<?php if ( has_post_format() ) : ?>
				<span class="entry-format">
				<?php
				$format = get_post_format();
				if ( current_theme_supports( 'post-formats', $format ) ) {
						printf( '%1$s<a href="%2$s">%3$s</a>',
						sprintf( '<span class="screen-reader-text">%s </span>', _x( 'Format', 'Used before post format.', 'flooor' ) ),
						esc_url( get_post_format_link( $format ) ),
						get_post_format_string( $format )
					);
				}?>
				</span>
			<?php endif; ?>

			<!-- category -->
			<?php if ( has_category() ) : ?>
				<span class="cat-links">
				<?php
				 $categories_list = get_the_category_list ( esc_html__( ', ', 'flooor' ) );
					if ( $categories_list ) {
						printf( $categories_list);
					}
				?>
				</span>
			<?php endif; ?>

			<!-- tags -->
			<?php if ( has_tag() ) : ?>
				<span class="tag-links">
				<?php
				 $tags_list = get_the_tag_list ( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'flooor' ) );
					if ( $tags_list ) {
						printf( $tags_list);
					}
				?>
				</span>
			<?php endif; ?>

			<!-- Comments number -->
			<?php if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
				<span class="comments-number">
				<?php //comments_number( 'no responses', 'one response', '% responses' ); ?>
				<?php printf( _nx( 'One Comment', '%1$s Comments', get_comments_number(), 'comments title', 'flooor' ), number_format_i18n( get_comments_number() ) ); ?>
				</span>
			<?php endif; ?>

			<!-- Edit link for admin for single page -->
			<?php if( is_singular() ) :
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'flooor' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			endif; ?>

		<?php endif; ?><!-- Only if it's a Post Type -->

	</footer><!-- .entry-footer -->
</article><!-- #post-## -->
