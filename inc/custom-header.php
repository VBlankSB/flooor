<?php
/**
 * Sample implementation of the Custom Header feature
 *
 * You can add an optional custom header image to header.php like so ...
 * Affiche l'image chargée via le customizer en plus de texte et description
 *
	<?php the_header_image_tag(); ?>
 *
 * Or like so ...
	<?php if ( get_header_image() ) : ?>
	   <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>"      height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	   </a>
	<?php endif; // End header image check. ?>
 *
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 *
 * @package Flooor
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses flooor_header_style()
 */
function flooor_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'flooor_custom_header_args', array(
		'default-image'          => '',
		'default-text-color'     => '000000',
		'width'                  => 1700,
		'height'                 => 400,
		'flex-height'            => false, // true pas de rognage possible
		'wp-head-callback'       => 'flooor_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'flooor_custom_header_setup' );

if ( ! function_exists( 'flooor_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog.
 *
 * @see flooor_custom_header_setup().
 */
function flooor_header_style() {
	$header_text_color = get_header_textcolor();

	/*
	 * If no custom options for text are set, let's bail.
	 * get_header_textcolor() options: Any hex value, 'blank' to hide text. Default: add_theme_support( 'custom-header' ).
	 */
	if ( get_theme_support( 'custom-header', 'default-text-color' ) === $header_text_color ) {
		return;
	}

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( ! display_header_text() ) :
	?>
		.site-branding {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that.
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo esc_attr( $header_text_color ); ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif;
