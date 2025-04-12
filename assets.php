<?php


/**
 * De-registers WordPress default
 *
 * @link https://developer.wordpress.org/reference/functions/wp_dequeue_style/
 */
add_action(
	'wp_enqueue_scripts',
	function () {
		wp_dequeue_style( 'wp-block-library' ); // WordPress block libaray styles
		wp_dequeue_style( 'global-styles' );// WordPress global styles generated from theme.json
	}
);




/**
 * Remove oEmbed-specific JavaScript from the front-end and back-end.
 *
 * @link https://developer.wordpress.org/reference/functions/wp_oembed_add_host_js/
 */
remove_action( 'wp_head', 'wp_oembed_add_host_js' );


/**
 * Remove WordPress version from scripts
 */
function remove_script_version( $src ) {
	global $wp_version;

	$parts = explode( "?ver=$wp_version", $src );
	return $parts[0];
}

add_filter( 'script_loader_src', 'remove_script_version', 15, 1 );
add_filter( 'style_loader_src', 'remove_script_version', 15, 1 );


/**
 * Remove type from style and script tags
 *
 * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
 */
add_action(
	'after_setup_theme',
	function () {
		add_theme_support( 'html5', array( 'script', 'style' ) );
	}
);
