<?php
/**
 * BuddyPress Groups Widgets
 *
 * @package BuddyPress
 * @subpackage GroupsWidgets
 * @since 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Register widgets for poll activity graph.
 *
 * @since 1.0.0
 */
function bpolls_register_poll_graph_widgets() {
	add_action( 'widgets_init', function() { register_widget( 'BP_Poll_Activity_Graph_Widget' ); } );
}
add_action( 'bp_register_widgets', 'bpolls_register_poll_graph_widgets' );