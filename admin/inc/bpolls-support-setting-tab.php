<?php
/**
 * Faqs support template file.
 *
 * @package    Buddypress_Polls
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>

<div class="wbcom-tab-content">
<div class="wbcom-faq-adming-setting">
	<div class="wbcom-admin-title-section">
		<h3><?php esc_html_e( 'Frequently Asked Questions', 'buddypress-polls' ); ?></h3>
	</div>	
<div class="wbcom-faq-admin-settings-block">
<div id="wbcom-faq-settings-section">
		<div class="wbcom-faq-block-contain">
			<div class="wbcom-faq-admin-row">
				<div class="wbcom-faq-section-row">
					<button class="wbcom-faq-accordion">
						<?php esc_html_e( 'Does this plugin require BuddyPress?', 'buddypress-polls' ); ?>
					</button>
					<div class="wbcom-faq-panel">
						<p>
							<?php esc_html_e( 'No, BuddyPress Polls does not require BuddyPress to be installed or activated.', 'buddypress-polls' ); ?>
						</p>
					</div>
				</div>
			</div>
			<div class="wbcom-faq-admin-row">
				<div class="wbcom-faq-section-row">
					<button class="wbcom-faq-accordion">
						<?php esc_html_e( 'What should I expect after installing and activating BuddyPress Polls?', 'buddypress-polls' ); ?>
					</button>
					<div class="wbcom-faq-panel">
						<p>
							<?php esc_html_e( 'Once activated, a poll icon will appear in the post box within the activity stream, user profiles, and groups', 'buddypress-polls' ); ?>
						</p>
						<p>
							<?php esc_html_e( 'Post a question for others to vote. BuddyPress Polls plugin allows you and your community to create polls in posts. The polls can be placed in the main activity stream, in users’ profiles and even in groups.', 'buddypress-polls' ); ?>
						</p>
					</div>
				</div>
			</div>
			<div class="wbcom-faq-admin-row">
				<div class="wbcom-faq-section-row">
					<button class="wbcom-faq-accordion">
						<?php esc_html_e( 'What is the purpose of the Multi-Select Polls setting under General Settings?', 'buddypress-polls' ); ?>
					</button>
					<div class="wbcom-faq-panel">
						<p>
							<?php esc_html_e( 'This setting lets users choose whether polls allow a single answer (single-select) or multiple answers (multi-select).', 'buddypress-polls' ); ?>
						</p>
					</div>
				</div>
			</div>
			<div class="wbcom-faq-admin-row">
				<div class="wbcom-faq-section-row">
					<button class="wbcom-faq-accordion">
						<?php esc_html_e( 'What is the use of Hide results setting provided under general settings section?', 'buddypress-polls' ); ?>
					</button>
					<div class="wbcom-faq-panel">
						<p>
							<?php esc_html_e( 'With hide results setting enabled users can\'t see the poll results before voting. They can see the results once they vote on the poll.', 'buddypress-polls' ); ?>
						</p>
						<p>
							<?php esc_html_e( 'With hide results setting disabled users can see the poll results before voting.', 'buddypress-polls' ); ?>
						</p>
					</div>
				</div>
			</div>
			<div class="wbcom-faq-admin-row">
				<div class="wbcom-faq-section-row">
					<button class="wbcom-faq-accordion">
						<?php esc_html_e( 'What is the Poll Closing Date & Time setting under General Settings?', 'buddypress-polls' ); ?>
					</button>
					<div class="wbcom-faq-panel">
						<p>
							<?php esc_html_e( 'When enabled, users can set a closing date and time for polls.', 'buddypress-polls' ); ?>
						</p>
						<p>
							<?php esc_html_e( 'When disabled, polls remain open indefinitely.', 'buddypress-polls' ); ?>
						</p>
					</div>
				</div>
			</div>
			<div class="wbcom-faq-admin-row">
				<div class="wbcom-faq-section-row">
					<button class="wbcom-faq-accordion">
						<?php esc_html_e( 'How can I show the poll activity graph in the sidebar?', 'buddypress-polls' ); ?>
					</button>
					<div class="wbcom-faq-panel">
						<p>
							<?php esc_html_e( 'Use the “BuddyPress Poll Activity Graph” widget provided by the plugin to display poll activity graphs in the sidebar.', 'buddypress-polls' ); ?>
						</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</div>
</div>
