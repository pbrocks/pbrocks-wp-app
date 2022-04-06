<?php
/**
 * Plugin Name:       PBrocks WP App
 * Description:       Sample code written with ESNext standard and JSX support.
 * Requires at least: 5.8
 * Requires PHP:      7.0
 * Version:           0.1.1
 * Author:            The WordPress Contributors & pbrocks
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       pbrocks-wp-app
 *
 * @package           create_block
 */

defined( 'ABSPATH' ) || exit;

add_action( 'init', 'pbrocks_wp_app_init' );
/**
 * Registers the block using the metadata loaded from the `block.json` file.
 * Behind the scenes, it registers also all assets so they can be enqueued
 * through the block editor in the corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function pbrocks_wp_app_init() {
	register_block_type( __DIR__ . '/build/some-tabs' );
	register_block_type( __DIR__ . '/build/first-app' );
}

add_filter( 'block_categories_all', 'pbrocks_wp_app_register_block_categories', 10, 2 );
/**
 * Register NASA block category
 *
 * @param  [type] $categories [description]
 * @param  [type] $post       [description]
 * @return [type]             [description]
 */
function pbrocks_wp_app_register_block_categories( $categories, $post ) {
	$pbrocks_wp_apps   = array(
		'slug'  => 'pbrocks-wp-apps',
		'title' => __( 'PBrocks WP Apps', 'pbrocks-wp-app' ),
		'icon'  => 'admin-home',
	);
	$pbrocks_wp_blocks = array(
		'slug'  => 'pbrocks-wp-blocks',
		'title' => __( 'PBrocks WP Blocks Panel', 'pbrocks-wp-app' ),
		'icon'  => 'editor-kitchensink',
	);
	array_unshift( $categories, $pbrocks_wp_blocks );
	array_unshift( $categories, $pbrocks_wp_apps );
	return $categories;
}
