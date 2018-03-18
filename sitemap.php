<?php
/**
 * Wintermute
 *
 * This page modifies the archive page into a sitemap for the Wintermute theme. Replaces the archive functionality in the Genesis Framework.
 *
 * Template Name: Sitemap
 *
 * @package Wintermute
 * @author  Timm Nawrocki
 * @license GPL-2.0+
 */

//* Remove standard post content output
remove_action( 'genesis_post_content', 'genesis_do_post_content' );
remove_action( 'genesis_entry_content', 'genesis_do_post_content' );

add_action( 'genesis_entry_content', 'genesis_page_archive_content' );
add_action( 'genesis_post_content', 'genesis_page_archive_content' );

function genesis_page_archive_content() { ?>
<h1 class="entry-title" style="margin-top:8px;">Sitemap</h1>
<div class="archive-page" style="width:100%;">
	<p>This page provides a list of all core pages hosted on this site. Data portals, mapping applications, and catalog items are not listed here. You can also use the search box below to search for content within pages.</p>
	<?php
		get_search_form();
	?>
	<h3 style="margin-top:20px;"><?php _e( 'Pages:', 'genesis' ); ?></h3>
	<ul class="sitemap-list">
		<?php wp_list_pages( 'title_li=' ); ?>
	</ul>
</div>
<?php
}
genesis();
