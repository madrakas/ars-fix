<?php
/*
* Plugin Name: ARS Fix - Insert custom CSS, JS and PHP code
* Plugin URI: https://github.com/madrakas/ars-fix
* Description: A plugin to insert custom CSS and JS code to a WordPress blog.
* Version: 1.0.0
* Author: Arvydas Šimbelis
* Author URI: https://github.com/madrakas/
* License: MIT
* Text Domain: ars-fix-plugin
* Domain Path: /languages
* Network: true
* GitHub Plugin URI: https://github.com/madrakas/ars-fix
*/


function add_css() {
    wp_enqueue_style('ars-fix-style', plugin_dir_url(__FILE__) . 'assets/ars-fix.css');
}
add_action('wp_head', 'add_css');

function add_js() {
    wp_enqueue_script('ars-fix-script', plugin_dir_url(__FILE__) . 'assets/ars-fix.js');
}
add_action('wp_head', 'add_js');

require_once plugin_dir_path(__FILE__) . 'inc/ars-fix-functions.php';

add_action('admin_init', 'my_plugin_check_for_updates');
function my_plugin_check_for_updates() {
    if (is_admin()) {
        $current_version = '1.0.0'; // Replace with your current plugin version
        $response = wp_remote_get('https://api.github.com/repos/madrakas/ars-fix/releases/latest');
        if (is_wp_error($response)) {
            return;
        }
        $data = json_decode(wp_remote_retrieve_body($response));
        if ($data && version_compare($current_version, $data->tag_name, '<')) {
            $new_version = $data->tag_name;
            $update_url = $data->html_url;
            $message = sprintf(__('There is a new version of My Plugin available. Please update to version %s.'), $new_version);
            $message .= ' ' . sprintf(__('View the <a href="%s">changelog</a> or <a href="%s">update now</a>.'), $update_url, $update_url);
            printf('<div class="notice notice-info is-dismissible"><p>%s</p></div>', $message);
            $message .= ' ' . sprintf(__('View the <a href="%s">changelog</a> or <a href="%s">update now</a>.'), $update_url, wp_nonce_url(self_admin_url('update.php?action=upgrade-plugin&plugin=ars-fix/ars-fix.php'), 'upgrade-plugin_ars-fix/ars-fix.php'));
        }
    }
}

?>