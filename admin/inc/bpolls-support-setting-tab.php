<?php
/**
 * Faqs support template file.
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="bpolls-support-setting">
	<div class="bpolls-tab-header">
		<h3><?php esc_html_e( 'FAQ(s) ', 'buddypress-polls' ); ?></h3>
	</div>
	<div class="bpolls-faqs-block-parent-contain">
		<div class="bpolls-faqs-block-contain">
			<div class="bpolls-faq-row border">
				<div class="bpolls-admin-col-12">
					<button class="bpolls-accordion">
						<?php esc_html_e( 'Does This plugin requires BuddyPress?', 'buddypress-polls' ); ?>
					</button>
					<div class="bpolls-panel">
						<p> 
							<?php esc_html_e( 'Yes, It needs you to have BuddyPress installed and activated.', 'buddypress-polls' ); ?>
						</p>
					</div>
				</div>
			</div>
			<div class="bpolls-faq-row border">
				<div class="bpolls-admin-col-12">
					<button class="bpolls-accordion">
						<?php esc_html_e( 'What to expect when installing and activating BuddyPress Polls?', 'buddypress-polls' ); ?>
					</button>
					<div class="bpolls-panel">
						<p> 
							<?php esc_html_e( 'After activating plugin a poll icon is added to the post box in activity stream, user profiles and even in groups.', 'buddypress-polls' ); ?>
						</p>
					</div>
				</div>
			</div>
			<div class="bpolls-faq-row border">	
				<div class="bpolls-admin-col-12">
					<button class="bpolls-accordion">
						<?php esc_html_e( 'What is the use of Multi select polls setting provided under general settings section?' ); ?>
					</button>
					<div class="bpolls-panel">
						<p> 
							<?php esc_html_e( 'When creating a poll users can set either a single select poll – users can pick just one answer or multiple select poll – users can pick more than one answer.', 'buddypress-polls' ); ?>
						</p>
					</div>
				</div>
			</div>	
			<div class="bpolls-faq-row border">	
				<div class="bpolls-admin-col-12">
					<button class="bpolls-accordion">
						<?php esc_html_e( 'How is Case Matching setting useful?' ); ?>
					</button>
					<div class="bpolls-panel">
						<p> 
							<?php esc_html_e( 'The [Case Matching] setting provides two option Case Sensitive and Case Insensitive. Case Sensitive filters keywords with strich case matching and is not recommended while Case Insensitive setting capture more words while filtering.', 'buddypress-polls' ); ?>
						</p>
						<p> 
							<?php esc_html_e( 'We recommend users to use Case Insensitive matching.', 'buddypress-polls' ); ?>
						</p>
					</div>
				</div>
			</div>	
			<div class="bpolls-faq-row border">	
				<div class="bpolls-admin-col-12">
					<button class="bpolls-accordion">
						<?php esc_html_e( 'How is Strict Filtering setting useful?' ); ?>
					</button>
					<div class="bpolls-panel">
						<p> 
							<?php esc_html_e( 'The [Strict Filtering] with strict mode on does not filter embedded keywords.', 'buddypress-polls' ); ?>
						</p>
						<p> 
							<?php esc_html_e( 'We recommend users to use Strict Filtering ON mode.', 'buddypress-polls' ); ?>
						</p>
					</div>
				</div>
			</div>	
			</div>
		</div>
	</div>
</div>