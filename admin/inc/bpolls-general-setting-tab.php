<?php
/**
 *
 * This file is used for rendering and saving plugin general settings.
 *
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( is_multisite() && is_plugin_active_for_network( plugin_basename( __FILE__ ) ) ) {
	$bpolls_settings = get_site_option( 'bpolls_settings' );
} else {
	$bpolls_settings = get_site_option( 'bpolls_settings' );
}
?>
<form method="post" action="admin.php?action=update_network_options">
	<?php
	settings_fields( 'buddypress_polls_general' );
	do_settings_sections( 'buddypress_polls_general' );
	?>
	<table class="form-table">
		<tr>
			<th scope="row"><label for="blogname"><?php esc_html_e( 'Multi select polls', 'buddypress-profanity' ); ?></label></th>
			<td><input name='bpolls_settings[multiselect]' type='checkbox' class="regular-text" value='yes' <?php (isset($bpolls_settings['multiselect']))?checked($bpolls_settings['multiselect'],'yes'):''; ?>/>
			<p class="description" id="tagline-description"><?php esc_html_e( 'Enabled: users can cast more than one vote in each poll.', 'buddypress-polls' ); ?>
			</p>
			<p class="description" id="tagline-description"><?php esc_html_e( 'Disabled: users can only vote for one option in each poll.', 'buddypress-polls' ); ?>
			</p>
		    </td>
	    </tr>
	    <tr>
			<th scope="row"><label for="blogname"><?php esc_html_e( 'Hide results', 'buddypress-profanity' ); ?></label></th>
			<td><input name='bpolls_settings[hide_results]' type='checkbox' class="regular-text" value='yes' <?php (isset($bpolls_settings['hide_results']))?checked($bpolls_settings['hide_results'],'yes'):''; ?>/>
			<p class="description" id="tagline-description"><?php esc_html_e( 'Enabled: results are hidden from users who have not voted yet.', 'buddypress-polls' ); ?>
			</p>
			<p class="description" id="tagline-description"><?php esc_html_e( 'Disabled: users can see poll results before voting.', 'buddypress-polls' ); ?>
			</p>
		    </td>
	    </tr>
	    <tr>
			<th scope="row"><label for="blogname"><?php esc_html_e( 'Poll closing date & time', 'buddypress-profanity' ); ?></label></th>
			<td><input name='bpolls_settings[close_date]' type='checkbox' class="regular-text" value='yes' <?php (isset($bpolls_settings['close_date']))?checked($bpolls_settings['close_date'],'yes'):''; ?>/>
			<p class="description" id="tagline-description"><?php esc_html_e( 'Enabled: users can set poll closing date and time.', 'buddypress-polls' ); ?>
			</p>
			<p class="description" id="tagline-description"><?php esc_html_e( 'Disabled: polls will always remain open for voting', 'buddypress-polls' ); ?>
			</p>
		    </td>
	    </tr>
	</table>
	<?php submit_button(); ?>
</form>