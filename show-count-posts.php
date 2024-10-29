<?php
/**
 * Plugin Name: Show number of views in Posts
 * Plugin URI: https://moashqar.com/show_count_posts
 * Description: A simple show number of views plugin for wordrpress.
 * Version: 1.0.0
 * Author: moashqar
 * Author URI: https://moashqar.000.pe/
 * Developer: Mohammed alashqar
 * Developer URI: https://github.com/msami23/
 * Text Domain: show-count-posts
 * Domain Path: /languages
 * License: GNU General Public License v3.0
 * License URI: http://www.gnu.org/licenses/gpl-3.0.html
 */

if ( !defined('ABSPATH' ))  exit;


//echo plugin_dir_url( __FILE__ ) . 'assets/css/posts-popluar-views.css';
define("ASSETS_DIR", plugin_dir_url(__FILE__ ) . 'assets');
function enqueue_files() {
	wp_enqueue_style('posts_popluar_css', ASSETS_DIR  . '/css/posts-popluar-views.css', array(), '1.0');
	wp_enqueue_script('show_count_js' , ASSETS_DIR  . '/js/show-count-posts.js' , array(), '1.0');
}
add_action('wp_enqueue_scripts', 'enqueue_files');

require_once ('inc/view-count-posts.php');
require_once ('admin/index.php');

