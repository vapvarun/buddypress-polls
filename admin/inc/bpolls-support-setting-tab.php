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
						<?php esc_html_e( 'Does this plugin filter multiple keywords?', 'buddypress-polls' ); ?>
					</button>
					<div class="bpolls-panel">
						<p> 
							<?php esc_html_e( 'Yes, multiple keywords can be set to filter with the setting [Keywords to remove] provied under general tab.', 'buddypress-polls' ); ?>
						</p>
					</div>
				</div>
			</div>
			<div class="bpolls-faq-row border">	
				<div class="bpolls-admin-col-12">
					<button class="bpolls-accordion">
						<?php esc_html_e( 'Does this change the content in BuddyPress database?' ); ?>
					</button>
					<div class="bpolls-panel">
						<p> 
							<?php esc_html_e( 'No, the plugin filters the content to display on screen, buddypress database is unaffected from plugin changes.', 'buddypress-polls' ); ?>
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