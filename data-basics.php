<?php
/**
 *
 */


add_action( 'admin_menu', 'data_basics_admin_menu' );
// add_action( 'admin_enqueue_scripts', 'load_custom_wp_admin_scripts' );
/**
 * Create a new admin page.
 */
function data_basics_admin_menu() {
			// Create a new admin page for our app.
	add_menu_page(
		__( 'My first Gutenberg app', 'gutenberg' ),
		__( 'My first Gutenberg app', 'gutenberg' ),
		'manage_options',
		'my-first-gutenberg-app',
		function () {
			echo '
			<h2>Pages</h2>
			<div id="my-first-gutenberg-app">my-first-gutenberg-app</div>
		';
		},
		'dashicons-schedule',
		3
	);
}

/**
 * Enqueue admin assets for this example.
 *
 * @param string $hook The current admin page.
 */
function load_custom_wp_admin_scripts( $hook ) {
	// Load only on ?page=my-first-gutenberg-app.
	if ( 'toplevel_page_my-first-gutenberg-app' !== $hook ) {
		// return;
	}
	$asset_file['dependencies'] = '';
	$asset_file['version'] = '3.2';
	// Load the required WordPress packages.

	// Automatically load dependencies and version.
	// $asset_file = include plugin_dir_path( __FILE__ ) . 'index.asset.php';

	// Enqueue CSS dependencies.
	// foreach ( $asset_file['dependencies'] as $style ) {
	// wp_enqueue_style( $style );
	// }

	// Load our app.js.
	wp_register_script(
		'data-basics-esnext',
		plugins_url( 'data-basics.js', __FILE__ ),
		$asset_file['dependencies'],
		$asset_file['version'],
		true,
	);
	wp_enqueue_script( 'data-basics-esnext' );

	// Load our style.css.
	// wp_register_style(
	// 'data-basics-esnext',
	// plugins_url( 'style.css', __FILE__ ),
	// null,
	// $asset_file['version'],
	// );
	// wp_enqueue_style( 'data-basics-esnext' );
}
