<?php
/**
 * Plugin Name:       Post Icon My
 * Description:       This is a short description of what the plugin does.
 * Version:           1.0
 * Author:            Stepan Melykh
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

error_reporting(E_ALL);

define('PLUGIN_NAME', "Post-Icon");
define('PLUGIN_VERSION', "1.0");


function post_icon_activation() {
	require_once 'inc/class-post-icon-activator.php';
	Post_icon_activator::activation();
}

function post_icon_deactivation() {
	require_once 'inc/class-post-icon-deactivator.php';
	Post_icon_deactivator::deactivation();
}

register_activation_hook( __FILE__, 'post_icon_activation' );
register_deactivation_hook( __FILE__, 'post_icon_deactivation' );

require plugin_dir_path( __FILE__ ) . 'inc/class-post-icon.php';

require plugin_dir_path( __FILE__ ) . 'inc/class-post-icon-admin.php';
$admin_styles = new Post_icon_Admin( PLUGIN_NAME, PLUGIN_VERSION );

function run_post_icon() {
	$post_icon = new Post_icon();
	$post_icon->post_icon_run();
}

run_post_icon();
?>