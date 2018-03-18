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
<p>
<?php
printf( __( 'There\'s not much here, huh? The server has returned a 404 error, meaning that the page you\'re looking for was not found. You can use the search function below this paragraph to return a list of pages that match your keyword. A sitemap is positioned below the search bar. It lists all core pages hosted on this site. Data portals and mapping applications are not listed.', 'genesis' ), home_url() );
?>
</p>
<?php
get_search_form();
?>
&nbsp;
<div class="archive-page" style="width:100%;">
	<h3 style="margin-top:20px;"><?php _e( 'Pages:', 'genesis' ); ?></h3>
	<ul class="sitemap-list">
		<?php wp_list_pages( 'title_li=' ); ?>
	</ul>
</div>
<?php
}
genesis();