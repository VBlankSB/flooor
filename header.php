<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Flooor
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<!-- Rendre html5 fonctionnel sur IE6 a IE8 -->
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/lib/html5shiv.min.js"></script>
	<![endif]-->

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> role="document" itemscope="itemscope" itemtype="http://schema.org/WebPage">
<div id="page" class="site">
	<ul class="skip-list">
		<li><a class="skip-link" href="#main-navigation"><?php esc_html_e( 'Skip to navigation', 'flooor' ); ?></a></li>
		<li><a class="skip-link" href="#content"><?php esc_html_e( 'Skip to content', 'flooor' ); ?></a></li>
	</ul>

	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">

			<?php
			// Custom logo link to home, unnecessary to have link on site-title.
			if ( has_custom_logo() ) :
			?>
				<div class="site-logo"><?php the_custom_logo(); ?></div>

				<div class="bloc-title-desc">
					<?php if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title" itemprop="name"><?php bloginfo( 'name' ); ?></h1>
					<?php else : ?>
						<p class="site-title" itemprop="name"><?php bloginfo( 'name' ); ?></p>
					<?php
					endif;

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) :
					?>
						<p class="site-description" itemprop="description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
					<?php endif; ?>
				</div><!-- .bloc-title-desc -->

			<?php
			// Necessary to link to home on site-title.
			else :
			?>
				<div class="bloc-title-desc">
					<?php if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php else : ?>
						<p class="site-title" itemprop="name"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
					<?php
					endif;

					$description = get_bloginfo( 'description', 'display' );
					if ( $description || is_customize_preview() ) :
					?>
						<p class="site-description" itemprop="description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
					<?php endif; ?>
				</div><!-- .bloc-title-desc -->

			<?php endif; ?>
		</div><!-- .site-branding -->

		<nav id="main-navigation" class="site-navigation" role="navigation" aria-label='<?php esc_attr_e( 'Primary Menu ', 'flooor' ); ?>'>
			<span class="screen-reader-text"><?php esc_html_e( 'Primary Menu', 'flooor' ); ?></span>
			<!-- Accessibility : A menu burger must be a button https://make.wordpress.org/themes/handbook/review/accessibility/required/ -->
			<button id="burger-menu" class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><span class="genericon genericon-menu"></span><span class="screen-reader-text">Dropdown Menu</span></button>

			<!-- Menu Primary -->
			<?php
			if ( has_nav_menu( 'primary' ) ) {
				wp_nav_menu(
					array(
						'theme_location'  => 'primary',
						'container'       => 'div',
						'container_id'    => 'primary-menu',
						'container_class' => 'primary-menu',
						'menu_id'         => 'primary-menu-items',
						'menu_class'      => 'menu-items',
					)
				);
			}
			?>
		</nav><!-- #main-navigation -->

		<!-- Toujours avoir une search accessible : Par défaut ici dans le header -->
		<div id="search-container" class="search-box-wrapper">
			<?php get_search_form(); ?>
		</div>

		<!-- Menu Social pourrait être placé ailleurs par exemple dans le footer -->
		<?php
		if ( has_nav_menu( 'social' ) ) {
			wp_nav_menu(
				array(
					'theme_location'  => 'social',
					'container'       => 'div',
					'container_id'    => 'menu-social',
					'container_class' => 'menu-social',
					'menu_id'         => 'menu-social-items',
					'menu_class'      => 'menu-items',
					'depth'           => 1,
					'link_before'     => '<span class="screen-reader-text">',
					'link_after'      => '</span>',
					'fallback_cb'     => '',
				)
			);
		}
		?>

	</header><!-- #masthead -->

	<div id="content" class="site-content">
