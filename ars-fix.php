<?php
/*
Plugin Name: Custom Styles Plugin
Plugin URI: https://github.com/madrakas/ars-fix
Description: A plugin to insert custom CSS and JS code to a WordPress blog.
Version: 1.0
Author: Arvydas Šimbelis
Author URI: https://github.com/madrakas/
License: GPL2
License URI: http://www.gnu.org/licenses/gpl-2.0.txt
Text Domain: ars-fix-plugin
*/

function add_css() {
    wp_enqueue_style('ars-fix-style', plugin_dir_url(__FILE__) . 'ars-fix.css');
}
add_action('wp_head', 'add_css');

function add_js() {
    wp_enqueue_script('ars-fix-script', plugin_dir_url(__FILE__) . 'ars-fix.js');
}
add_action('wp_head', 'add_js');

