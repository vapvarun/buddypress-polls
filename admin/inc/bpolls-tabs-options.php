<?php
/**
 *
 * This template file is used for fetching desired options page file at admin settings.
 *
 * @package    Buddypress_Polls
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$admin_tabs = filter_input( INPUT_GET, 'tab' ) ? filter_input( INPUT_GET, 'tab' ) : 'welcome';
if ( isset( $admin_tabs ) ) {
	$bpolls_tab = $admin_tabs;
} else {
	$bpolls_tab = 'welcome';
}

bpolls_include_setting_tabs( $bpolls_tab );

/**
 *
 * Function to select desired file for tab option.
 *
 * @param string $bpolls_tab The current tab string.
 */
function bpolls_include_setting_tabs( $bpolls_tab ) {

	switch ( $bpolls_tab ) {
		case 'welcome':
			include 'bpolls-welcome-page.php';
			break;
		case 'general':
			include 'bpolls-general-setting-tab.php';
			break;
		case 'support':
			include 'bpolls-support-setting-tab.php';
			break;
		case 'wbpoll_setting':
			include 'wbpolls-setting-tab.php';
			break;
		case 'notifications':
			include 'notifications-tab.php';
			break;
		case 'email_notification_settings':
			include 'email-notification-settings-tab.php';
			break;
		default:
			include 'bpolls-welcome-page.php';
			break;
	}

}

