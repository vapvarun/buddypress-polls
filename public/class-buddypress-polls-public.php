<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://www.wbcomdesigns.com
 * @since      1.0.0
 *
 * @package    Buddypress_Polls
 * @subpackage Buddypress_Polls/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Buddypress_Polls
 * @subpackage Buddypress_Polls/public
 * @author     wbcomdesigns <admin@wbcomdesigns.com>
 */
class Buddypress_Polls_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Buddypress_Polls_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Buddypress_Polls_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		global $wp_styles;
		$srcs = array_map( 'basename', (array) wp_list_pluck( $wp_styles->registered, 'src' ) );

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/buddypress-polls-public.css', array(), $this->version, 'all' );

		if ( in_array( 'font-awesome.css', $srcs ) || in_array( 'font-awesome.min.css', $srcs ) ) {
			/* echo 'font-awesome.css registered'; */
		} else {
			wp_enqueue_style( 'bpolls-font-awesome', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css', array(), $this->version, 'all' );
		}

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Buddypress_Polls_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Buddypress_Polls_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		if ( ! wp_script_is( 'jquery-ui-sortable', 'enqueued' ) ) {
			wp_enqueue_script( 'jquery-ui-sortable' );
		}

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/buddypress-polls-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Function to render polls html.
	 *
	 * @since    1.0.0
	 */
	public function bpolls_polls_update_html() {
		?>
		<div class="bpolls-html-container">
			<span class="bpolls-icon"><i class="fa fa-bar-chart"></i><?php esc_html_e('&nbsp;Poll','buddypress-polls'); ?></span>
			<div class="bpolls-polls-option-html">
				<div class="bpolls-cancel-div">
					<a class="bpolls-cancel" href="JavaScript:void(0);"><?php esc_html_e('Cancel Poll','buddypress-polls'); ?></a>
				</div>
				<div class="bpolls-sortable">
					<div class="bpolls-option">
						<a class="bpolls-sortable-handle" title="Move" href="#"><i class="fa fa-arrows-alt"></i></a>
						<input name="bpolls_input_options" class="bpolls-input" placeholder="<?php esc_html_e('Option 1','buddypress-polls'); ?>" type="text">
						<a class="bpolls-option-delete" title="Delete" href="JavaScript:void(0);"><i class="fa fa-trash" aria-hidden="true"></i></a>
					</div>
					<div class="bpolls-option">
						<a class="bpolls-sortable-handle" title="Move" href="#"><i class="fa fa-arrows-alt"></i></a>
						<input name="bpolls_input_options" class="bpolls-input" placeholder="<?php esc_html_e('Option 2','buddypress-polls'); ?>" type="text">
						<a class="bpolls-option-delete" title="Delete" href="JavaScript:void(0);"><i class="fa fa-trash" aria-hidden="true"></i></a>
					</div>
				</div>
				<div class="bpolls-option-action">
					<a href="JavaScript:void(0);" class="bpolls-add-option"><?php esc_html_e('Add new option','buddypress-polls'); ?></a>
					<div class="bpolls-checkbox">
						<input name="bpolls_multiselect" class="bpolls-allow-multiple" type="checkbox" value="yes">
						<label class="lbl" for="allow-multiple"><?php esc_html_e('Allow multiple options selection','buddypress-polls'); ?></label>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	/**
	 * Filters the default activity types to add poll type activity.
	 *
	 * @since 1.0.0
	 *
	 * @param array $types Default activity types to moderate.
	 */
	public function bpolls_add_polls_type_activity($types) {
		$types[] = 'activity_poll';
		return $types;
	}

	/**
	 * Register the activity stream actions for poll updates.
	 *
	 * @since 1.0.0
	 */
	public function bpolls_register_activity_actions() {
		$bp = buddypress();

		bp_activity_set_action(
			$bp->activity->id,
			'activity_poll',
			__( 'Polls Update', 'buddypress-polls' ),
			array( $this, 'bp_activity_format_activity_action_activity_poll' ),
			__( 'Poll', 'buddypress-polls' ),
			array( 'activity', 'group', 'member', 'member_groups' )
		);
	}

	/**
	 * Format 'activity_poll' activity actions.
	 *
	 * @since 1.0.0
	 *
	 * @param string $action   Static activity action.
	 * @param object $activity Activity data object.
	 * @return string $action
	 */
	function bp_activity_format_activity_action_activity_poll( $action, $activity ) {
		$action = sprintf( __( '%s created a poll', 'buddypress-polls' ), bp_core_get_userlink( $activity->user_id ) );

		/**
		 * Filters the formatted activity action update string.
		 *
		 * @since 1.0.0
		 *
		 * @param string               $action   Activity action string value.
		 * @param BP_Activity_Activity $activity Activity item object.
		 */
		return apply_filters( 'bp_activity_new_poll_action', $action, $activity );
	}

	/**
	 * Function to set activity type activity_poll.
	 *
	 * @since 1.0.0
	 * @param array $activity Activity object.
	 */
	public function bpolls_update_poll_type_activity( $activity ) {
		if(isset($_POST['bpolls_input_options']) && !empty($_POST['bpolls_input_options'])){
			$activity->type = 'activity_poll';
		}
		
	}

}
