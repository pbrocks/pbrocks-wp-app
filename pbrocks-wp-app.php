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

require __DIR__ . '/data-basics.php';

add_action( 'init', 'pbrocks_wp_app_init' );
/**
 * Registers the block using the metadata loaded from the
 * `block.json` file.
 *
 * Behind the scenes, it registers also all assets so they
 * can be enqueued through the block editor in the
 * corresponding context.
 *
 * @see https://developer.wordpress.org/reference/functions/register_block_type/
 */
function pbrocks_wp_app_init() {
	register_block_type( __DIR__ . '/build/some-starter' );
	register_block_type( __DIR__ . '/build/first-app' );
}

add_filter( 'block_categories_all', 'pbrocks_wp_app_register_block_categories', 10, 2 );
/**
 * Register block categories
 *
 * @param  array          $categories The block categories that exist on site.
 * @param  WP_Post object $post Types of posts registered on site.
 * @return array  The updated block categories.
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

add_action( 'admin_menu', 'pbrocks_wp_app_admin_menu' );
/**
 * [pbrocks_wp_app_admin_menu description]
 *
 * Creates an admin page and places it high in dashboard menus.
 *
 * @return void
 */
function pbrocks_wp_app_admin_menu() {
	add_menu_page(
		__( 'PBrocks First WP App', 'pbrocks-wp-app' ),
		__( 'PBrocks First WP App', 'pbrocks-wp-app' ),
		'manage_options',
		'pbrocks-first-wp-app',
		'pbrocks_wp_app_admin_menu_callback',
		'dashicons-schedule',
		3
	);
}

/**
 * Provides the HTML structure for the admin page where our app's data will land.
 *
 * @return void HTML string output to the browser.
 */
function pbrocks_wp_app_admin_menu_callback() {
	  echo '<div class="wrap">';

	echo '<h2>' . ucwords( preg_replace( '/_+/', ' ', __FUNCTION__ ) ) . '</h2>';
	echo '<p class="description">Starter info inserts the date into this page. We will add posts. If you don\'t have posts, you may want to import the xml file in this app\'s folder.</p>';
	echo '<h3>This site\'s Posts</h3>';
	echo '<div class="outer-wrap">';
	echo '<div id="pbrocks-first-test">innerHTML = Date</div>';
	echo '<div id="pbrocks-first-wp-app"></div>';
	echo '</div>';
	echo '</div>';
	?>
	<script type="text/javascript">
		document.addEventListener('readystatechange', event => {
			if (event.target.readyState === 'interactive') {
				insertFormattedDate( new Date());
				displayDate(new Date(2026, 6, 26));
			}
			else if (event.target.readyState === 'complete') {
				displayDate(new Date());
			}
		});
		function insertDate() {
			document.getElementById('pbrocks-first-test').innerHTML = Date();
		}
		function insertFormattedDate(date) {
			var year = date.getFullYear();

			var month = (1 + date.getMonth()).toString();
			month = month.length > 1 ? month : '0' + month;

			var day = date.getDate().toString();
			day = day.length > 1 ? day : '0' + day;

			document.getElementById('pbrocks-first-test').innerHTML =  month + '/' + day + '/' + year;
		}

		function displayDate(date) {
			document.getElementById('pbrocks-first-test').innerHTML = formatTheDate(date);
		}

		function formatTheDate(date='') {
			const options = { weekday: 'long', year: 'numeric', month: 'long', day: 'numeric' };
			let today  = new Date(date);

			console.log(today.toLocaleDateString('en-US'));

			// Saturday, September 17, 2016
			console.log(today.toLocaleDateString('en-US', options));

			// शनिवार, 17 सितंबर 2016
			console.log(today.toLocaleDateString('hi-IN', options));
			return today.toLocaleDateString('en-US', options);
		}
	</script>

	<?php
}


