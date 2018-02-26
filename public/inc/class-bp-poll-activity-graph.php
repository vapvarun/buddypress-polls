<?php
/**
 * BuddyPress Groups Widget.
 *
 * @package BuddyPress
 * @subpackage GroupsWidgets
 * @since 1.0.0
 */

// Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

/**
 * Groups widget.
 *
 * @since 1.0.3
 */
class BP_Poll_Activity_Graph_Widget extends WP_Widget {

	/**
	 * Working as a group, we get things done better.
	 *
	 * @since 1.0.3
	 */
	public function __construct() {
		$widget_ops = array(
			'description'                 => __( 'A poll activity graph widget', 'buddypress-polls' ),
			'classname'                   => 'widget_bp_poll_graph_widget buddypress widget',
			'customize_selective_refresh' => true,
		);
		parent::__construct( false, _x( '(BuddyPress) Poll Activity Graph', 'widget name', 'buddypress-polls' ), $widget_ops );

		if ( is_customize_preview() || is_active_widget( false, false, $this->id_base ) ) {
			add_action( 'bp_enqueue_scripts', array( $this, 'enqueue_scripts' ));
		}
	}

	/**
	 * Enqueue scripts.
	 *
	 * @since 2.6.0
	 */
	public function enqueue_scripts() {

		$poll_wdgt = new BP_Poll_Activity_Graph_Widget();
		$poll_wdgt_stngs = $poll_wdgt->get_settings();
		
		$uptd_votes = array();

		foreach ($poll_wdgt_stngs as $key => $value) {
			$activity_id = $value['activity_default'];

			$activity_meta = bp_activity_get_meta( $activity_id, 'bpolls_meta');

			$poll_options = isset($activity_meta['poll_option'])?$activity_meta['poll_option']:'';
			
			if( !empty($poll_options) && is_array($poll_options) ){
				foreach ($poll_options as $key => $value) {
					if( isset( $activity_meta['poll_total_votes'] ) ){
						$total_votes = $activity_meta['poll_total_votes'];
					}else{
						$total_votes = 0;
					}

					if( isset( $activity_meta['poll_optn_votes'] ) && array_key_exists( $key, $activity_meta['poll_optn_votes'] ) ){
						$this_optn_vote = $activity_meta['poll_optn_votes'][$key];
					}else{
						$this_optn_vote = 0;
					}

					if( $total_votes != 0 ){
						$vote_percent = round( $this_optn_vote/$total_votes*100, 2 );
					}else{
						$vote_percent = '(no votes yet)';
					}

					$bpolls_votes_txt = $this_optn_vote . '&nbsp;of&nbsp;' . $total_votes;

					$uptd_votes[$activity_id][] = array(
						'label' => $value,
						'y' => $vote_percent,

					);
				}
			}
		}
		
		
		
		wp_enqueue_script( 'bpolls-poll-activity-graph-js', BPOLLS_PLUGIN_URL . "/public/js/poll-activity-graph.js", array( 'jquery' ), time() );

		wp_localize_script( 'bpolls-poll-activity-graph-js', 'bpolls_wiget_obj', array( 'ajax_url' => admin_url( 'admin-ajax.php' ), 'ajax_nonce' => wp_create_nonce( 'bpolls_widget_security' ), 'votes' => json_encode($uptd_votes) ) );
		wp_enqueue_script( 'bpolls-graph-canvas-js', "https://canvasjs.com/assets/script/jquery.canvasjs.min.js", array( 'jquery' ), bp_get_version() );
	}

	/**
	 * Extends our front-end output method.
	 *
	 * @since 1.0.3
	 *
	 * @param array $args     Array of arguments for the widget.
	 * @param array $instance Widget instance data.
	 */
	public function widget( $args, $instance ) {
		extract( $args );
		if ( empty( $instance['activity_default'] ) ) {
			$instance['activity_default'] = '226';
		}

		if ( empty( $instance['title'] ) ) {
			$instance['title'] = __( 'Poll Activity Graph', 'buddypress-polls' );
		}

		/**
		 * Filters the title of the Groups widget.
		 *
		 * @since 1.8.0
		 * @since 2.3.0 Added 'instance' and 'id_base' to arguments passed to filter.
		 *
		 * @param string $title    The widget title.
		 * @param array  $instance The settings for the particular instance of the widget.
		 * @param string $id_base  Root ID for all widgets of this type.
		 */
		$title = apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base );

		/**
		 * Filters the separator of the group widget links.
		 *
		 * @since 2.4.0
		 *
		 * @param string $separator Separator string. Default '|'.
		 */
		$separator = apply_filters( 'bp_groups_widget_separator', '|' );

		echo $before_widget;

		echo $before_title . $title . $after_title;

		$max_activity = ! empty( $instance['max_activity'] ) ? (int) $instance['max_activity'] : 5;

		$group_args = array(
			'type'            => $instance['activity_default'],
			'per_page'        => $max_activity,
			'max'             => $max_activity,
		);

		
		?>
		<div class="bpolls-activity-chartContainer" data-id="<?php echo $instance['activity_default']; ?>" id="bpolls-activity-chart-<?php echo $instance['activity_default']; ?>" style="height: 300px; width: 100%;"></div>
		<?php echo $after_widget;
	}

	/**
	 * Extends our update method.
	 *
	 * @since 1.0.3
	 *
	 * @param array $new_instance New instance data.
	 * @param array $old_instance Original instance data.
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title']            = strip_tags( $new_instance['title'] );
		$instance['max_activity']     = strip_tags( $new_instance['max_activity'] );
		$instance['activity_default'] = strip_tags( $new_instance['activity_default'] );

		return $instance;
	}

	/**
	 * Extends our form method.
	 *
	 * @since 1.0.3
	 *
	 * @param array $instance Current instance.
	 * @return mixed
	 */
	public function form( $instance ) {
		$defaults = array(
			'title'            => __( 'Poll Activity Graph', 'buddypress-polls' ),
			'max_activity'     => 5,
			'activity_default' => '274'
		);
		$instance = wp_parse_args( (array) $instance, $defaults );

		$title 	       = strip_tags( $instance['title'] );
		$max_activity    = strip_tags( $instance['max_activity'] );
		$activity_default = strip_tags( $instance['activity_default'] );
		?>

		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'buddypress'); ?> <input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" style="width: 100%" /></label></p>

		<p><label for="<?php echo $this->get_field_id( 'max_activity' ); ?>"><?php _e('Max activity to show:', 'buddypress'); ?> <input class="widefat" id="<?php echo $this->get_field_id( 'max_activity' ); ?>" name="<?php echo $this->get_field_name( 'max_activity' ); ?>" type="text" value="<?php echo esc_attr( $max_activity ); ?>" style="width: 30%" /></label></p>

		<p>
			<label for="<?php echo $this->get_field_id( 'activity_default' ); ?>"><?php _e('Default activity to show:', 'buddypress'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'activity_default' ); ?>" name="<?php echo $this->get_field_name( 'activity_default' ); ?>" type="text" value="<?php echo esc_attr( $activity_default ); ?>" style="width: 100%" />
			<!-- <select name="<?php echo $this->get_field_name( 'activity_default' ); ?>" id="<?php echo $this->get_field_id( 'activity_default' ); ?>">
				<option value="newest" <?php selected( $activity_default, 'newest' ); ?>><?php _e( 'Newest', 'buddypress' ) ?></option>
				<option value="active" <?php selected( $activity_default, 'active' ); ?>><?php _e( 'Active', 'buddypress' ) ?></option>
				<option value="popular"  <?php selected( $activity_default, 'popular' ); ?>><?php _e( 'Popular', 'buddypress' ) ?></option>
				<option value="alphabetical" <?php selected( $activity_default, 'alphabetical' ); ?>><?php _e( 'Alphabetical', 'buddypress' ) ?></option>
			</select> -->
		</p>
	<?php
	}
}
