<?php
/**
 * Flooor functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Flooor
 */

if ( ! function_exists( 'flooor_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function flooor_setup() {
		/**
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on flooor, use a find and replace
		 * to change 'flooor' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'flooor', get_template_directory() . '/languages' );

		// Add Style of the theme in the TinyMCE visual editor to resemble the theme style.
		add_editor_style( array( 'assets/css/editor-style.css', 'assets/genericons/genericons.css' ) );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		/*
		 * This theme uses wp_nav_menu() in 2 locations.
		 */
		register_nav_menus( array(
			'primary' => esc_html__( 'Primary Menu', 'flooor' ),
			'social'  => esc_html__( 'Social Menu', 'flooor' ),
		) );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		) );

		// Add theme support for post formats.
		add_theme_support( 'post-formats', array( 'aside', 'gallery', 'link', 'quote', 'video', 'audio', 'image', 'status', 'chat' ) );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'flooor_custom_background_args', array(
			'default-color' => 'ffffff',
			'default-image' => '',
		) ) );

		// Allow upload logo image in the customizer
		// https://developer.wordpress.org/themes/functionality/custom-logo/ .
		add_theme_support( 'custom-logo', array(
			'height'      => 150,
			'width'       => 150,
			'flex-height' => true,
			'flex-width'  => true,
			'header-text' => array( 'site-title', 'site-description' ),
		) );

		/*
		 * Add theme support for selective refresh for widgets.
		 *
		 * @link https://developer.wordpress.org/themes/advanced-topics/customizer-api/#widgets-opting-in-to-selective-refresh
		 */
		add_theme_support( 'customize-selective-refresh-widgets' );

		// Add excerpt to pages.
		add_post_type_support( 'page', 'excerpt' );
	}
endif;
add_action( 'after_setup_theme', 'flooor_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 * this content_width value is for image attachment, post format like video ...
 *
 * @global int $content_width
 */
function flooor_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'flooor_content_width', 640 );
}
add_action( 'after_setup_theme', 'flooor_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function flooor_widgets_init() {
	// Define Sidebar Widget Area.
	register_sidebar( array(
		'name'          => esc_html__( 'Main sidebar', 'flooor' ),
		'id'            => 'main-sidebar',
		'description'   => esc_html__( 'Add widgets here for sidebar.', 'flooor' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'flooor_widgets_init' );

/**
 * Enqueue scripts and styles.
 * ===========================
 */

define( 'FLOOOR_VERSION', wp_get_theme()->get( 'Version' ) );

function flooor_scripts() {
	/* Styles : wp_enqueue_style( $handle, $src, $deps, $ver, $media )
		=================================================================*/
	// Load Theme Stylesheet.
	// wp_enqueue_style( 'flooor-style', get_stylesheet_uri() );
	// ou.
	wp_enqueue_style( 'flooor-style', get_template_directory_uri() . '/style.css', array(), FLOOOR_VERSION, 'all' );

	// Add Genericons font, used in the main stylesheet.
	wp_enqueue_style( 'genericons', get_template_directory_uri() . '/assets/genericons/genericons.css', array(), '3.0.3' );

	/* Scripts : wp_enqueue_script( $handle, $src, $deps, $ver, $in_footer ) */
	/*=======================================================================*/
	wp_enqueue_script( 'flying-focus', get_template_directory_uri() . '/assets/js/flying-focus.js', array(), '20151215', true );

	// @link https://github.com/wpaccessibility/a11ythemepatterns/blob/master/skip-link/functions.php
	wp_enqueue_script( 'flooor-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '20151215', true );

	// Add JS to pages with the comment form when is used.
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'flooor_scripts' );

/**
 *  Fonctions déportées pour faciliter la maintenance
 *  -------------------------------------------------
 */
/**
 * Securize WordPress
 * Later, it should be in a plugin
 */
require get_template_directory() . '/inc/securize-wordpress.php';

/**
 * Template functions for the theme
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
