<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.wbcomdesigns.com
 * @since             1.0.0
 * @package           Buddypress_Polls
 *
 * @wordpress-plugin
 * Plugin Name:       BuddyPress Polls
 * Plugin URI:        http://www.wbcomdesigns.com/plugins/
 * Description:       BuddyPress Polls plugin allows you and your community to create polls in posts. The polls can be placed in the main activity stream, in users’ profiles and even in groups.
 * Version:           1.0.0
 * Author:            wbcomdesigns
 * Author URI:        http://www.wbcomdesigns.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       buddypress-polls
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

if ( ! defined( 'BP_ENABLE_MULTIBLOG' ) ) {
	define( 'BP_ENABLE_MULTIBLOG', false );
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGINNAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-buddypress-polls-activator.php
 */
function activate_buddypress_polls() {
	global $wpdb;
	if ( function_exists( 'is_multisite' ) && is_multisite() ) {
		// check if it is a network activation - if so, run the activation function for each blog id.
		if ( ! is_plugin_active_for_network( 'buddypress/bp-loader.php' ) ) {
			add_action( 'network_admin_notices', 'bpolls_network_admin_notices' );
		}
		//Get all blog id's.
		$blogs = $wpdb->get_results(
			"
            SELECT blog_id
            FROM {$wpdb->blogs}
            WHERE site_id = '{$wpdb->siteid}'
            AND archived = '0'
            AND spam = '0'
            AND deleted = '0'
            "
		);
		foreach ( $blogs as $blog ) {
			if ( ! defined( 'BP_ROOT_BLOG' ) ) {
				define( 'BP_ROOT_BLOG', $blog->blog_id );
			}
			run_buddypress_polls();
			add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'bpolls_plugin_links' );
			bpolls_update_blog( $blog->blog_id );
		}
	} else {
		run_buddypress_polls();
		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'bpolls_plugin_links' );
		bpolls_update_blog();
	}
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-buddypress-polls-deactivator.php
 */
function deactivate_buddypress_polls() {
	if ( function_exists( 'is_multisite' ) && is_multisite() ) {
	}
}

register_activation_hook( __FILE__, 'activate_buddypress_polls' );
register_deactivation_hook( __FILE__, 'deactivate_buddypress_polls' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-buddypress-polls.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_buddypress_polls() {

	$plugin = new Buddypress_Polls();
	$plugin->run();

}

/**
 * Function to add plugin links.
 *
 * @param array $links Plugin action links array.
 */
function bpolls_plugin_links( $links ) {
	$bpolls_links = array(
		'<a href="' . admin_url( 'admin.php?page=buddypress_polls' ) . '">' . __( 'Settings', 'buddypress-polls' ) . '</a>',
		'<a href="https://wbcomdesigns.com/contact/" target="_blank">' . __( 'Support', 'buddypress-polls' ) . '</a>',
	);
	return array_merge( $links, $bpolls_links );
}

/**
 * Function to update blog.
 *
 * @param int $blog_id Blog id.
 */
function bpolls_update_blog( $blog_id = null ) {
	if ( $blog_id ) {
		switch_to_blog( $blog_id );
	}
	//do desired actions.
	if ( $blog_id ) {
		restore_current_blog();
	}
}

/**
 * Plugin notice while activiting on multisite.
 */
function bpolls_network_admin_notices() {
	$bpolls_plugin = 'BuddyPress Polls';
	$bp_plugin   = 'BuddyPress';

	echo '<div class="error"><p>'
	. sprintf( __( '%1$s is ineffective as it requires %2$s to be installed and active.', 'buddypress-polls' ), '<strong>' . $bpolls_plugin . '</strong>', '<strong>' . $bp_plugin . '</strong>' )
	. '</p></div>';
	if ( isset( $_GET['activate'] ) ) {
		unset( $_GET['activate'] );
	}
}

add_action( 'plugins_loaded', 'bpolls_plugin_init' );

/**
 * Function to check buddypress is active to enable disable plugin functionality.
 */
function bpolls_plugin_init() {
	if ( ! function_exists( 'is_plugin_active_for_network' ) ) {
		require_once ABSPATH . '/wp-admin/includes/plugin.php';
	}
	if ( ! is_plugin_active_for_network( 'buddypress/bp-loader.php' ) && ! in_array( 'buddypress/bp-loader.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
		add_action( 'admin_notices', 'bpolls_plugin_admin_notice' );
	} else {
		run_buddypress_polls();
		add_filter( 'plugin_action_links_' . plugin_basename( __FILE__ ), 'bpolls_plugin_links' );
	}
}

/**
 * Function to check buddypress is active to enable disable plugin functionality.
 */
function bpolls_plugin_admin_notice() {

	$bpolls_plugin = 'BuddyPress Polls';
	$bp_plugin   = 'BuddyPress';

	echo '<div class="error"><p>'
	. sprintf( __( '%1$s is ineffective as it requires %2$s to be installed and active.', 'buddypress-polls' ), '<strong>' . $bpolls_plugin . '</strong>', '<strong>' . $bp_plugin . '</strong>' )
	. '</p></div>';
	if ( isset( $_GET['activate'] ) ) {
		unset( $_GET['activate'] );
	}

}
