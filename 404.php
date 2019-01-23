<?php
/**
 * Wintermute
 *
 * This file adds the 404 page to the Wintermute Theme.
 *
 * Template Name: 404 Page
 *
 * @package Wintermute
 * @author  Timm Nawrocki
 * @license GPL-2.0+
 * @link    https://github.com/accs-uaa/wintermute-genesis-theme
 */

//* Remove default loop
remove_action( 'genesis_loop', 'genesis_do_loop' );

add_action( 'genesis_loop', 'genesis_404' );

/**
 * This function outputs a 404 "Not Found" error message
 */
function genesis_404() {
?>
<h1 class="entry-title" style="margin-top:8px;"><?php _e( 'Page not found', 'genesis' ); ?></h1>
<div class="archive-page" style="width:100%;">
	<p>There's not much here, huh? The server has returned a 404 error, meaning that the page you're looking for was not found. You can use the search function in the page header to return a list of pages that match your keyword. A sitemap is provided below. It lists all core pages hosted on this site. Data portals, mapping applications, catalog items, and links to external resources are not listed here.</p>
	<h2 style="margin-top:20px;"><?php _e( 'Pages:', 'genesis' ); ?></h2>
	<ul class="sitemap-list">
		<?php wp_list_pages( 'title_li=' ); ?>
	</ul>
</div>
<?php
}
genesis();