<?php

// Create a custom widget class
class Wb_Poll_Report extends WP_Widget {
    
    // Constructor function
    public function __construct() {
        parent::__construct(
            'wb_poll_report', // Widget ID
            'WB Poll Report', // Widget name
            array( 'description' => 'A custom widget for your WordPress site' ) // Widget description
        );
    }
    
    // Widget front-end display
    public function widget( $args, $instance ) {
        global $wpdb, $current_user;

		if ( ! is_user_logged_in() ) {
			return;
		}
        // Widget output
        echo $args['before_widget'];
        
        // Widget content
        $poll_id = $instance['wb_activity_default'];
        echo '<h4 class="widget-title"><span>'.$instance['title'].'</span></h4>';
        echo WBPollHelper::show_backend_single_poll_widget_result( $poll_id, 'shortcode', 'text' );
        
        echo $args['after_widget'];
    }
    
    // Widget form back-end display
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
			$act_default = '';
		}

		$defaults = array(
			'title'            => __( 'WB Poll Report', 'buddypress-polls' ),
			'wb_activity_default' => $act_default,
		);

		$instance = wp_parse_args( (array) $instance, $defaults );

		$title            = strip_tags( $instance['title'] );
		$wb_activity_default = strip_tags( $instance['wb_activity_default'] );
		?>

		<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'buddypress' ); ?> <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" style="width: 100%" /></label></p>
		<p>
				<label for="<?php echo esc_attr( $this->get_field_id( 'wb_activity_default' ) ); ?>"><?php esc_html_e( 'Default Poll to display:', 'buddypress' ); ?></label>
				<select name="<?php echo esc_attr( $this->get_field_name( 'wb_activity_default' ) ); ?>" id="<?php echo esc_attr( $this->get_field_id( 'wb_activity_default' ) ); ?>">
					<?php

                    $args = array(
                        'post_type' => 'wbpoll', // Replace 'your_post_type' with the desired post type
                        'post_status'    => 'publish', 
                        'posts_per_page' => -1, // Retrieve all posts of the specified post type
                    );

                    $query = new WP_Query($args);

                    if ($query->have_posts()) {
                        while ($query->have_posts()) {
                            $query->the_post();

                            // Access post properties
                            $post_id = get_the_ID();
                            $post_title = get_the_title();
                            ?>
                            <option value="<?php echo $post_id; ?>" <?php selected( $wb_activity_default, $post_id ); ?>><?php echo esc_html( $post_title ); ?></option>
                            <?php
                            // Do something with the post data
                        }
                    } else { ?>
                        <label for="<?php echo esc_attr( $this->get_field_id( 'wb_activity_default' ) ); ?>"><?php esc_html_e( 'No polls are created yet.', 'buddypress' ); ?></label>
                    <?php	} ?>
				</select>
		</p>
		<?php
		// Restore the global.
		$activities_template = $old_activities_template;
    }
    
    // Update widget settings
    public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title']            = strip_tags( $new_instance['title'] );
		$instance['wb_activity_default'] = strip_tags( $new_instance['wb_activity_default'] );

		return $instance;
	}
}

// Register the widget
function register_custom_widget() {
    register_widget( 'wb_poll_report' );
}
add_action( 'widgets_init', 'register_custom_widget' );

?>