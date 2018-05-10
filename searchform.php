<?php
/**
 * Template for displaying search forms in Flooor
 *
 * @package Flooor
 */

$unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo $unique_id; // WPCS: XSS ok. ?>">
		<span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'floor-pixiscreen' ); ?></span>
	</label>
	<input type="search" id="<?php echo $unique_id; // WPCS: XSS ok. ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'floor-pixiscreen' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-submit" aria-label="Soumettre la recherche de votre mot clé dans le site"><span class="genericon genericon-search"></span></button>
</form>
