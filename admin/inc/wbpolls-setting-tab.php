<?php
/**
 * This file is used for rendering and saving plugin general settings.
 *
 * @package    Buddypress_Polls
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( is_multisite() && is_plugin_active_for_network( plugin_basename( __FILE__ ) ) ) {
	$bpolls_settings = get_site_option( 'wbpolls_settings' );
} else {
	$bpolls_settings = get_site_option( 'wbpolls_settings' );
}

global $wp_roles;
?>
<div class="wbcom-tab-content">
    <div class="wbcom-admin-option-wrap wbcom-admin-option-wrap-view">
        <form method="post" action="admin.php?action=update_network_options">
            <div class="wbcom-wrapper-admin">
                <div class="wbcom-admin-title-section">
                    <h3><?php esc_html_e( 'General (WB)', 'buddypress-polls' ); ?></h3>
                </div>
                <div class="wbcom-admin-option-wrap-bp-poll">
                    <input name='wbpolls_settings[hidden]' type='hidden' value="" />
                    <?php	settings_fields( 'buddypress_wbpolls' );
                        do_settings_sections( 'buddypress_wbpolls' );
                        ?>
                    <div class="form-table polls-general-options">
                        <!-- <div class="wbcom-settings-section-wrap">
                            <div class="wbcom-settings-section-options-heading">
                                <label
                                    for="blogname"><?php esc_html_e( 'Multi select polls', 'buddypress-polls' ); ?></label>
                                <p class="description" id="tagline-description">
                                    <?php esc_html_e( 'Enabled/Disabled: users can vote for multiple options in each poll.', 'buddypress-polls' ); ?>
                                </p>
                            </div>
                            <div class="wbcom-settings-section-options">
                                <label class="wb-switch">
                                    <input name='wbpolls_settings[wbpolls_multiselect]' type='checkbox' value='yes'
                                        <?php ( isset( $bpolls_settings['wbpolls_multiselect'] ) ) ? checked( $bpolls_settings['wbpolls_multiselect'], 'yes' ) : ''; ?> />
                                    <div class="wb-slider wb-round"></div>
                                </label>
                            </div>
                        </div> -->

                        <div class="wbcom-settings-section-wrap">
                            <div class="wbcom-settings-section-options-heading">
                                <label for="blogname"><?php esc_html_e( 'Who Can Vote', 'buddypress-polls' ); ?></label>
                                <p class="description" id="tagline-description">
                                    <?php esc_html_e( 'Enabled/Disabled: users can vote for multiple options in each poll.', 'buddypress-polls' ); ?>
                                </p>
                            </div>
                            <div class="wbcom-settings-section-options">
                                <select class="multi-selectize" name="wbpolls_settings[wppolls_who_can_vote][]" multiple>
                                    <?php
                                    $roles = $wp_roles->get_names();
                                    foreach ( $roles as $role => $rname ) {
                                        $selected = ( ! empty( $bpolls_settings['wppolls_who_can_vote'] ) && in_array( $role, $bpolls_settings['wppolls_who_can_vote'], true ) ) ? 'selected' : '';
                                        ?>
                                    <option value="<?php echo esc_attr( $role ); ?>" <?php echo esc_attr( $selected ); ?>><?php echo esc_attr( $rname ); ?></option>
                                    <?php } ?>
                                </select>				
                            </div>
                        </div>

                        <!-- <div class="wbcom-settings-section-wrap">
                            <div class="wbcom-settings-section-options-heading">
                                <label
                                    for="blogname"><?php esc_html_e( 'Never Expire', 'buddypress-polls' ); ?></label>
                                <p class="description" id="tagline-description">
                                    <?php esc_html_e( 'Enabled/Disabled: users can vote for multiple options in each poll.', 'buddypress-polls' ); ?>
                                </p>
                            </div>
                            <div class="wbcom-settings-section-options">
                                <label class="wb-switch">
                                    <input name='wbpolls_settings[wbpolls_never_expire]' type='checkbox' value='yes'
                                        <?php ( isset( $bpolls_settings['wbpolls_never_expire'] ) ) ? checked( $bpolls_settings['wbpolls_never_expire'], 'yes' ) : ''; ?> />
                                    <div class="wb-slider wb-round"></div>
                                </label>
                            </div>
                        </div> -->

                        <div class="wbcom-settings-section-wrap">
                            <div class="wbcom-settings-section-options-heading">
                                <label
                                    for="blogname"><?php esc_html_e( 'User Add extra Options', 'buddypress-polls' ); ?></label>
                                <p class="description" id="tagline-description">
                                    <?php esc_html_e( 'Enabled/Disabled: users can vote for multiple options in each poll.', 'buddypress-polls' ); ?>
                                </p>
                            </div>
                            <div class="wbcom-settings-section-options">
                                <label class="wb-switch">
                                    <input name='wbpolls_settings[wbpolls_user_add_extra_op]' type='checkbox' value='yes'
                                        <?php ( isset( $bpolls_settings['wbpolls_user_add_extra_op'] ) ) ? checked( $bpolls_settings['wbpolls_user_add_extra_op'], 'yes' ) : ''; ?> />
                                    <div class="wb-slider wb-round"></div>
                                </label>
                            </div>
                        </div>

                        <div class="wbcom-settings-section-wrap">
                            <div class="wbcom-settings-section-options-heading">
                                <label
                                    for="blogname"><?php esc_html_e( 'Poll Submit Status', 'buddypress-polls' ); ?></label>
                                <p class="description" id="tagline-description">
                                    <?php esc_html_e( 'Enabled/Disabled: users can vote for multiple options in each poll.', 'buddypress-polls' ); ?>
                                </p>
                            </div>
                            <div class="wbcom-settings-section-options">
                                <label class="wb-switch">
                                    <select name="wbpolls_settings[wbpolls_submit_status]">
                                        <option value="" <?php if($bpolls_settings['wbpolls_submit_status'] == ''){ echo "selected"; }?>>Poll Status</option>
                                        <option value="draft" <?php if($bpolls_settings['wbpolls_submit_status'] == 'draft'){ echo "selected"; }?>>Draft</option>
                                        <option value="publish" <?php if($bpolls_settings['wbpolls_submit_status'] == 'publish'){ echo "selected"; }?>>Publish</option>
                                    </select>
                                </label>
                            </div>
                        </div>

                        <div class="wbcom-settings-section-wrap">
                            <div class="wbcom-settings-section-options-heading">
                                <label
                                    for="blogname"><?php esc_html_e( 'Results ', 'buddypress-polls' ); ?></label>
                                <p class="description" id="tagline-description">
                                    <?php esc_html_e( 'Enabled/Disabled: users can vote for multiple options in each poll.', 'buddypress-polls' ); ?>
                                </p>
                            </div>
                            <div class="wbcom-settings-section-options">
                                <label class="wb-switch">
                                    <input name='wbpolls_settings[wppolls_show_result]' type='checkbox' value='yes'
                                        <?php ( isset( $bpolls_settings['wppolls_show_result'] ) ) ? checked( $bpolls_settings['wppolls_show_result'], 'yes' ) : ''; ?> />
                                    <div class="wb-slider wb-round"></div>
                                </label>
                            </div>
                        </div>
                        

                    </div>
                </div>
            </div>

            <div class="wbcom-wrapper-admin">
                <div class="wbcom-admin-title-section">
                    <h3><?php esc_html_e( 'Fields (WB)', 'buddypress-polls' ); ?></h3>
                </div>
                <div class="wbcom-admin-option-wrap-bp-poll">
                    
                    <div class="form-table polls-general-options">
                        <div class="wbcom-settings-section-wrap">
                            <div class="wbcom-settings-section-options-heading">
                                <label
                                    for="blogname"><?php esc_html_e( 'Allow Logout Users', 'buddypress-polls' ); ?></label>
                                <p class="description" id="tagline-description">
                                    <?php esc_html_e( 'Enabled/Disabled: users can vote for multiple options in each poll.', 'buddypress-polls' ); ?>
                                </p>
                            </div>
                            <div class="wbcom-settings-section-options">
                                <label class="wb-switch">
                                    <input name='wbpolls_settings[wbpolls_logoutuser]' type='checkbox' value='yes'
                                        <?php ( isset( $bpolls_settings['wbpolls_logoutuser'] ) ) ? checked( $bpolls_settings['wbpolls_logoutuser'], 'yes' ) : ''; ?> />
                                    <div class="wb-slider wb-round"></div>
                                </label>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="wbcom-wrapper-admin">
                <div class="wbcom-admin-title-section">
                    <h3><?php esc_html_e( 'Design (WB)', 'buddypress-polls' ); ?></h3>
                </div>
                <div class="wbcom-admin-option-wrap-bp-poll">
                    
                        <div class="wbcom-settings-section-wrap">
                            <div class="wbcom-settings-section-options-heading">
                                <label for="blogname"><?php esc_html_e( 'Color Scheme', 'buddypress-polls' ); ?></label>
                                <p class="description" id="tagline-description">
                                    <?php esc_html_e( 'Allow users to set color scheme for progress bar and submit button.', 'buddypress-polls' ); ?>
                                </p>
                            </div>
                            <div class="wbcom-settings-section-options">
                                <label for>
                                    <input id="polls_background_color" name='wbpolls_settings[wbpolls_background_color]'
                                        type='text'
                                        value='<?php echo isset( $bpolls_settings['wbpolls_background_color'] ) ? esc_attr( $bpolls_settings['wbpolls_background_color'] ) : '#4caf50'; ?>' />
                                </label>
                            </div>
                        </div>
                </div>
            </div>
                <?php submit_button(); ?>
        </form>
    </div>
</div>