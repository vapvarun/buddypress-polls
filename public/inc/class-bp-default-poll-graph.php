<?php
/**
 * BuddyPress Poll Default Activity Graph Widget
 *
 * @package Buddypress_Polls
 * @subpackage Buddypress_Polls/public/inc
 * @since 4.4.1
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * BuddyPress Poll Default Activity Graph Widget
 *
 * @since 4.4.1
 */
class BP_Default_Poll_Graph_Widget extends WP_Widget {

	/**
	 * Working as a poll activity, we get things done better.
	 *
	 * @since 4.4.1
	 */
	public function __construct() {
		
		parent::__construct( 
			'bp_default_poll_graph_widget', 
			esc_html__( 'BuddyPress Default Polls Graph', 'buddypress-polls' ), 
			array('description' => esc_html__('This Polls widget will let you add results of the default poll selected.', 'buddypress-polls' ) )
		);

		if ( ! is_customize_preview() ) {
			global $pagenow;
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			if ( is_admin() && 'index.php' === $pagenow ) {
				add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			}
		}
	}

	/**
	 * Enqueue scripts.
	 *
	 * @since 4.4.1
	 * @param hook $hook hook.
	 */
	public function enqueue_scripts( $hook ) {

		if( is_buddypress() && is_active_widget( false, false, 'bp_default_poll_graph_widget', true ) ){
			
			if ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) {
				$js_extension = '.js';
			} else {
				$js_extension = '.min.js';
			}

			$updated_user_votes = $this->buddypress_polls_fetch_updated_user_votes();

			wp_register_script( 'bp-default-poll-activity-graph-js' . $hook, BPOLLS_PLUGIN_URL . '/public/js/buddypress-polls-default-graph' . $js_extension, array( 'jquery' ), BPOLLS_PLUGIN_VERSION );

			wp_enqueue_script( 'bp-default-poll-activity-graph-js' . $hook );

			wp_set_script_translations( 'bp-default-poll-activity-graph-js' . $hook, 'buddypress-polls' );

			wp_localize_script(
				'bp-default-poll-activity-graph-js' . $hook,
				'bp_default_poll_wiget_obj',
				array(
					'ajax_url'   => admin_url( 'admin-ajax.php' ),
					'ajax_nonce' => wp_create_nonce( 'bpolls_widget_security' ),
					'votes'      => wp_json_encode( $updated_user_votes )
				)
			);

			wp_enqueue_script( 'bpolls-poll-activity-chart-js' . $hook, BPOLLS_PLUGIN_URL . '/public/js/vendor/Chart.min.js', array( 'jquery' ), BPOLLS_PLUGIN_VERSION );

		}		
		
	}

	/**
	 * Extends our front-end output method.
	 *
	 * @since 4.4.1
	 *
	 * @param array $args     Array of arguments for the widget.
	 * @param array $instance Widget instance data.
	 */
	public function widget( $args, $instance ) {
		
		global $wpdb, $activities_template;
		$table = $wpdb->prefix . 'bp_activity';

		if ( ! is_user_logged_in() ) {
			return;
		}
		
		extract( $args );

		if ( empty( $instance['activity_default'] ) ) {
			return;
		}

		if ( empty( $instance['title'] ) ) {
			$instance['title'] = __( 'Default Poll Graph', 'buddypress-polls' );
		}

		/**
		 * Filters the title of the Poll graph widget.
		 *
		 * @since 1.0.0
		 *
		 * @param string $title    The widget title.
		 * @param array  $instance The settings for the particular instance of the widget.
		 * @param string $id_base  Root ID for all widgets of this type.
		 */
		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );
		
		echo wp_kses_post( $before_widget );

		echo wp_kses_post( $before_title . $title . $after_title ); 

		$activity_default = ! empty( $instance['activity_default'] ) ? (int) $instance['activity_default'] : '';
		
		$old_activities_template = $activities_template;

		if( ! empty( $activity_default ) ) { ?>
			<canvas class="poll-default-bar-chart" data-id="<?php echo esc_attr( $instance['activity_default'] ); ?>" id="bpolls-default-activity-chart-<?php echo esc_attr( $instance['activity_default'] ); ?>" width="800" height="450"></canvas> <?php 

		} else { ?>
			<div class="bpolls-empty-message">
				<?php esc_html_e( 'Default Poll Graph not selected.', 'buddypress-polls' ); ?>
			</div>
		<?php } ?>
		<?php
		echo wp_kses_post( $after_widget );
		// Restore the global.
		$activities_template = $old_activities_template;
	}

	/**
	 * Extends our update method.
	 *
	 * @since 4.4.1
	 *
	 * @param array $new_instance New instance data.
	 * @param array $old_instance Original instance data.
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title']            = sanitize_text_field( $new_instance['title'] );
		$instance['activity_default'] = absint( $new_instance['activity_default'] );

		return $instance;
	}

	/**
	 * Extends our form method.
	 *
	 * @since 4.4.1
	 *
	 * @param array $instance Current instance.
	 * @return mixed
	 */
	public function form( $instance ) {
		global $activities_template;

		// Back up the global.
		$old_activities_template = $activities_template;

		$act_args = array(
			'action' => 'activity_poll',
			'type'   => 'activity_poll',
		);

		if ( bp_has_activities( $act_args ) ) {
			$act_default = $activities_template->activities[0]->id;
		} else {
			$act_default = 0;
		}
		
		$defaults = array(
			'title'            => __( 'Default Poll Graph', 'buddypress-polls' ),
			'activity_default' => $act_default,
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		$title            = sanitize_text_field( $instance['title'] );
		$activity_default = absint( $instance['activity_default'] );
		
		?>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'buddypress-polls' ); ?> <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" style="width: 100%" /></label></p>

		<p>
			<?php if ( bp_has_activities( $act_args ) ) { ?>
				<label for="<?php echo esc_attr( $this->get_field_id( 'activity_default' ) ); ?>"><?php esc_html_e( 'Default Poll to display:', 'buddypress-polls' ); ?></label>
				<select name="<?php echo esc_attr( $this->get_field_name( 'activity_default' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'activity_default' ) ); ?>">
					<?php
					while ( bp_activities() ) :
						bp_the_activity();
						global $activities_template;
						?>
						<option value="<?php bp_activity_id(); ?>" <?php selected( $activity_default, bp_get_activity_id() ); ?>><?php echo esc_html( $activities_template->activity->content ); ?></option>
					<?php endwhile; ?>
				</select>
			<?php } else { ?>
				<label for="<?php echo esc_attr( $this->get_field_id( 'activity_default' ) ); ?>"><?php esc_html_e( 'Default Poll Graph not selected.', 'buddypress-polls' ); ?></label>
			<?php	} ?>
		</p>
		<?php
		// Restore the global.
		$activities_template = $old_activities_template;
	}

	/**
	 * Function to fetch updated user votes on the polls.
	 * 
	 * @return array $updated_votes Array of user votes related to poll.
	 * @since 4.4.1
	 */
	private function buddypress_polls_fetch_updated_user_votes() {

		global $wpdb;

		$poll_wdgt_stngs = $this->get_settings();

		$updated_votes   = array();

		if ( is_array( $poll_wdgt_stngs ) && !empty( $poll_wdgt_stngs ) ) {
			foreach ( $poll_wdgt_stngs as $key => $value ) {
				if ( isset( $value['activity_default'] ) ) {
					$activity_id      = $value['activity_default'];
					$args             = array( 'activity_ids' => $activity_id );
					$activity_details = bp_activity_get_specific( $args );
					
					if ( is_array( $activity_details ) ) {
						$poll_title = isset( $activity_details['activities'][0]->content ) ? wp_trim_words( $activity_details['activities'][0]->content, 10, '...' ) : '';
					} else {
						$poll_title = '';
					}
					$activity_meta = bp_activity_get_meta( $activity_id, 'bpolls_meta' );
					$poll_options  = isset( $activity_meta['poll_option'] ) ? $activity_meta['poll_option'] : '';
					if ( ! array_key_exists( $activity_id, $updated_votes ) ) {
						if ( ! empty( $poll_options ) && is_array( $poll_options ) ) {
							foreach ( $poll_options as $key => $value ) {
								if ( isset( $activity_meta['poll_total_votes'] ) ) {
									$total_votes = $activity_meta['poll_total_votes'];
								} else {
									$total_votes = 0;
								}
								if ( isset( $activity_meta['poll_optn_votes'] ) && array_key_exists( $key, $activity_meta['poll_optn_votes'] ) ) {
									$this_optn_vote = $activity_meta['poll_optn_votes'][ $key ];
								} else {
									$this_optn_vote = 0;
								}

								if ( 0 != $total_votes ) {
									$vote_percent = round( $this_optn_vote / $total_votes * 100, 2 );
								} else {
									$vote_percent = __( '(no votes yet)', 'buddypress-polls' );
								}

								$bpolls_votes_txt = '(&nbsp;' . $this_optn_vote . '&nbsp;' . _x( 'of', 'Poll Graph', 'buddypress-polls' ) . '&nbsp;' . $total_votes . '&nbsp;)';

								$updated_votes[ $activity_id ][] = array(
									'poll_title' => $poll_title,
									'label'      => $value,
									'y'          => $vote_percent,
									'color'      => bpolls_color(),

								);
							}
						}
					}
				}
			}
		}

		return $updated_votes;
	}
}


/**
 * Register the widget.
 */
function register_bp_default_poll_graph_widget() {
	register_widget( 'bp_default_poll_graph_widget' );
}
add_action( 'widgets_init', 'register_bp_default_poll_graph_widget' );
