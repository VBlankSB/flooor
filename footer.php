<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flooor
 */

?>

	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<small>&copy; <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?>
      <?php printf( esc_html__( 'by %1$s', 'flooor' ), '<a href="https://pixiscreen.fr" rel="designer">VBlank</a>' ); ?>
      <span class="sep"> | </span>
      <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'flooor' ) ); ?>"><?php printf( esc_html__( 'Powered by %s', 'flooor' ), 'WordPress' ); ?></a></small>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
