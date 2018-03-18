<?php
/**
 * Wintermute
 *
 * This file adds functions to the Wintermute Theme.
 *
 * @package Wintermute
 * @author  Timm Nawrocki
 * @license GPL-2.0+
 */

// Start the engine.
include_once( get_template_directory() . '/lib/init.php' );

// Setup Theme.
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

// Set Localization (do not remove).
add_action( 'after_setup_theme', 'genesis_sample_localization_setup' );
function genesis_sample_localization_setup(){
	load_child_theme_textdomain( 'genesis-sample', get_stylesheet_directory() . '/languages' );
}

// Add the helper functions.
include_once( get_stylesheet_directory() . '/lib/helper-functions.php' );

// Add Image upload and Color select to WordPress Theme Customizer.
require_once( get_stylesheet_directory() . '/lib/customize.php' );

// Include Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/output.php' );

// Add WooCommerce support.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php' );

// Add the required WooCommerce styles and Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php' );

// Add the Genesis Connect WooCommerce notice.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php' );

// Child theme (do not remove).
define( 'CHILD_THEME_NAME', 'Wintermute' );
define( 'CHILD_THEME_URL', 'https://accs.uaa.alaska.edu' );
define( 'CHILD_THEME_VERSION', '1.0' );

// Enqueue Scripts and Styles.
add_action( 'wp_enqueue_scripts', 'genesis_sample_enqueue_scripts_styles' );
function genesis_sample_enqueue_scripts_styles() {

	wp_enqueue_style( 'genesis-sample-fonts', '//fonts.googleapis.com/css?family=Source+Sans+Pro:400,600,700', array(), CHILD_THEME_VERSION );
	wp_enqueue_style( 'dashicons' );

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'genesis-sample-responsive-menu', get_stylesheet_directory_uri() . "/js/responsive-menus{$suffix}.js", array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_localize_script(
		'genesis-sample-responsive-menu',
		'genesis_responsive_menu',
		genesis_sample_responsive_menu_settings()
	);

}

// Define our responsive menu settings.
function genesis_sample_responsive_menu_settings() {

	$settings = array(
		'mainMenu'          => __( 'Menu', 'genesis-sample' ),
		'menuIconClass'     => 'dashicons-before dashicons-menu',
		'subMenu'           => __( 'Submenu', 'genesis-sample' ),
		'subMenuIconsClass' => 'dashicons-before dashicons-arrow-down-alt2',
		'menuClasses'       => array(
			'combine' => array(
				'.nav-primary',
				'.nav-header',
			),
			'others'  => array(),
		),
	);

	return $settings;

}

// Add HTML5 markup structure.
add_theme_support( 'html5', array( 'caption', 'comment-form', 'comment-list', 'gallery', 'search-form' ) );

// Add Accessibility support.
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Add support for custom header.
add_theme_support( 'custom-header', array(
	'width'           => 875,
	'height'          => 200,
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'flex-height'     => true,
) );

// Add support for custom background.
add_theme_support( 'custom-background' );

// Add support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Add support for 3-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 3 );

// Add Image Sizes.
add_image_size( 'featured-image', 720, 400, TRUE );

// Rename primary and secondary navigation menus.
add_theme_support( 'genesis-menus', array( 'primary' => __( 'After Header Menu', 'genesis-sample' ), 'secondary' => __( 'Footer Menu', 'genesis-sample' ) ) );

// Reposition the secondary navigation menu.
remove_action( 'genesis_after_header', 'genesis_do_subnav' );
add_action( 'genesis_footer', 'genesis_do_subnav', 5 );

// Reduce the secondary navigation menu to one level depth.
add_filter( 'wp_nav_menu_args', 'genesis_sample_secondary_menu_args' );
function genesis_sample_secondary_menu_args( $args ) {

	if ( 'secondary' != $args['theme_location'] ) {
		return $args;
	}

	$args['depth'] = 1;

	return $args;

}

// Modify size of the Gravatar in the author box.
add_filter( 'genesis_author_box_gravatar_size', 'genesis_sample_author_box_gravatar' );
function genesis_sample_author_box_gravatar( $size ) {
	return 90;
}

// Modify size of the Gravatar in the entry comments.
add_filter( 'genesis_comment_list_args', 'genesis_sample_comments_gravatar' );
function genesis_sample_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;

	return $args;

}

//* Functions added specific to Wintermute Theme
//*----------------------------------------------------------------------------------------------

function my_theme_setup() {
	// Add support for wide images
	add_theme_support( 'align-full' );
}
add_action( 'after_setup_theme', 'my_theme_setup' );

// Change Favicon
add_filter( 'genesis_pre_load_favicon', 'new_icon' );
function new_icon( $icon) {
    $icon = '/favicon.ico';
    return $icon;
}

// Customize search form input box text
add_filter( 'genesis_search_text', 'sp_search_text' );
function sp_search_text( $text ) {
	return esc_attr( 'Search...' );
}

// Add Dashicon to search form button 
add_filter( 'genesis_search_button_text', 'wpsites_search_button_icon' );
function wpsites_search_button_icon( $text ) {
	return esc_attr( '&#xf179;' );
}

// Add custom footer
remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'sp_custom_footer' );
function sp_custom_footer() {
	?>
	<div class="site-footer-inner">
		<p>&copy; 2018 <a href="https://accs.uaa.alaska.edu">Alaska Center for Conservation Science</a>. This website was designed and is maintained by the University of Alaska Anchorage-<a href="http://accs.uaa.alaska.edu">Alaska Center for Conservation Science</a> (UAA-ACCS). UAA is accredited as an educational institution by the Northwest Commission on Colleges and Universities and is an EEO/AA employer.</p>
		<p><a href="mailto:twnawrocki@alaska.edu">Contact Website Administrator</a> | <a href="/sitemap/">Sitemap</a></p>
	</div>
	<?php
}

// Disable Visual Editor
add_filter('user_can_richedit' , create_function('' , 'return false;') , 50);

// Disable Add Media Button
add_action('admin_init', 'remove_all_media_buttons');
function remove_all_media_buttons() {
	remove_all_actions('media_buttons');
}

// Disable Quicktags in HTML Editor
add_filter('quicktags_settings', 'cyb_quicktags_settings');
function cyb_quicktags_settings( $qtInit  ) {
	//Set to emtpy string, empty array or false won't work. It must be set to ","
	$qtInit['buttons'] = ',';
	return $qtInit;
}

// Remove Admin Menus from Dashboard Sidebar
function remove_menus() 
	{
	global $submenu;
	remove_submenu_page ( 'themes.php', 'theme-editor.php' ); // Appearance-->Editor
}
add_action('admin_menu', 'remove_menus', 102);

add_action( 'genesis_before', 'prefix_remove_entry_header' );

/**
 * Remove Entry Header
 */
function prefix_remove_entry_header()
{

	if ( ! is_front_page() ) { return; }

	//* Remove the entry header markup (requires HTML5 theme support)
	remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_open', 5 );
	remove_action( 'genesis_entry_header', 'genesis_entry_header_markup_close', 15 );

	//* Remove the entry title (requires HTML5 theme support)
	remove_action( 'genesis_entry_header', 'genesis_do_post_title' );

	//* Remove the entry meta in the entry header (requires HTML5 theme support)
	remove_action( 'genesis_entry_header', 'genesis_post_info', 12 );

	//* Remove the post format image (requires HTML5 theme support)
	remove_action( 'genesis_entry_header', 'genesis_do_post_format_image', 4 );

}