<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Flooor
 */

get_header(); ?>
<div class="container">

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title">
					<?php
					/* translators: %$: the client request */
					printf( esc_html__( 'Search Results for: %s', 'flooor' ), '<span>' . get_search_query() . '</span>' );
					?>
				</h1>

				<?php global $wp_query; ?>
				<p class="num-result">
					<?php
					/* translators: %$: the number request results */
					printf( esc_html__( 'We have found %s results', 'flooor' ), $wp_query->found_posts );
					?>
				</p>
			</header><!-- .page-header -->

			<?php
			while ( have_posts() ) : the_post();

				/**
				 * Run the loop for the search to output the results.
				 * If you want to overload this in a child theme then include a file
				 * called content-search.php and that will be used instead.
				 */
				get_template_part( 'template-parts/content', 'search' );

			endwhile;

			the_posts_navigation();

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif; ?>

		</main><!-- #main -->
	</section><!-- #primary -->

<?php get_sidebar(); ?>

</div><!-- .container -->

<?php get_footer();
