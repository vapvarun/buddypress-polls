<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://www.wbcomdesigns.com
 * @since      1.0.0
 *
 * @package    Buddypress_Polls
 * @subpackage Buddypress_Polls/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Buddypress_Polls
 * @subpackage Buddypress_Polls/admin
 * @author     wbcomdesigns <admin@wbcomdesigns.com>
 */
if ( !class_exists('Buddypress_Polls_Admin') ) {
	class Buddypress_Polls_Admin {

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
		 * @param      string    $plugin_name       The name of this plugin.
		 * @param      string    $version    The version of this plugin.
		 */
		public function __construct( $plugin_name, $version ) {

			$this->plugin_name = $plugin_name;
			$this->version = $version;

		}

		/**
		 * Register the stylesheets for the admin area.
		 *
		 * @since    1.0.0
		 */
		public function enqueue_styles($hook) {
			if($hook != 'wb-plugins_page_buddypress-polls') {
				return;
			 }

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
			
			if ( isset($_GET['page']) && $_GET['page'] == 'buddypress-polls' ) {
				if ( ! wp_style_is( 'polls-selectize-css', 'enqueued' ) ) {
					wp_enqueue_style( 'polls-selectize-css', plugin_dir_url( __FILE__ ) . 'css/selectize.css', array(), $this->version, 'all' );
				}
				
				wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/buddypress-polls-admin.css', array(), $this->version, 'all' );
			}

		}

		/**
		 * Register the JavaScript for the admin area.
		 *
		 * @since    1.0.0
		 */
		public function enqueue_scripts($hook) {
			if($hook != 'wb-plugins_page_buddypress-polls') {
				return;
			 }

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
			if ( isset($_GET['page']) && $_GET['page'] == 'buddypress-polls' ) {
				if ( ! wp_script_is( 'polls-selectize-js', 'enqueued' ) ) {
					wp_enqueue_script( 'polls-selectize-js', plugin_dir_url( __FILE__ ) . 'js/selectize.min.js', array( 'jquery' ), $this->version, false );
				}
				
				wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/buddypress-polls-admin.js', array( 'jquery' ), $this->version, false );
			}

		}

		/**
		 * Register admin menu for plugin.
		 *
		 * @since    1.0.0
		 */
		public function bpolls_add_menu_buddypress_polls() {

			if ( empty ( $GLOBALS['admin_page_hooks']['wbcomplugins'] ) ) {
					// add_menu_page( esc_html__( 'WBCOM', 'buddypress-polls' ), __( 'WBCOM', 'buddypress-polls' ), 'manage_options', 'wbcomplugins', array( $this, 'bpolls_buddypress_polls_settings_page' ), BPOLLS_PLUGIN_URL . 'admin/wbcom/assets/imgs/bulb.png', 59 );
				add_menu_page( esc_html__( 'WB Plugins', 'buddypress-polls' ), esc_html__( 'WB Plugins', 'buddypress-polls' ), 'manage_options', 'wbcomplugins', array( $this, 'bpolls_buddypress_polls_settings_page' ), 'dashicons-lightbulb', 59 );
				add_submenu_page( 'wbcomplugins', esc_html__( 'General', 'buddypress-polls' ), esc_html__( 'General', 'buddypress-polls' ), 'manage_options', 'wbcomplugins' );
				}
			add_submenu_page( 'wbcomplugins', esc_html__( 'Buddypress Polls Settings Page', 'buddypress-polls' ), esc_html__( 'BuddyPress Polls', 'buddypress-polls' ), 'manage_options', 'buddypress-polls', array( $this, 'bpolls_buddypress_polls_settings_page' ) );

			// add_menu_page( __( 'Buddypress Polls Settings Page', 'buddypress-polls' ), __( 'BuddyPress Polls', 'buddypress-polls' ), 'manage_options', 'buddypress_polls', array( $this, 'bpolls_buddypress_polls_settings_page' ), 'dashicons-chart-bar', 60 );
		}

		/**
		 * Callable function for admin menu setting page.
		 *
		 * @since    1.0.0
		 */
		public function bpolls_buddypress_polls_settings_page() {
			$current = isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : 'general';
			?>
			<div class="wrap">
				<div class="blpro-header">
					<?php echo do_shortcode( '[wbcom_admin_setting_header]' ); ?>
					<h1 class="wbcom-plugin-heading">
						<?php esc_html_e( 'BuddyPress Polls Settings', 'buddypress-polls' ); ?>
					</h1>
				</div>
				<div class="wbcom-admin-settings-page">
			<?php
			$bpolls_tabs = array(
				'general'        => __( 'General', 'buddypress-polls' ),
				'support'        => __( 'Support', 'buddypress-polls' ),
			);

			$tab_html = '<div class="wbcom-tabs-section"><h2 class="nav-tab-wrapper">';
			foreach ( $bpolls_tabs as $bpolls_tab => $bpolls_name ) {
				$class     = ( $bpolls_tab == $current ) ? 'nav-tab-active' : '';
				$tab_html .= '<a class="nav-tab ' . $class . '" href="admin.php?page=buddypress-polls&tab=' . $bpolls_tab . '">' . $bpolls_name . '</a>';
			}
			$tab_html .= '</h2></div>';
			echo $tab_html;
			include 'inc/bpolls-tabs-options.php';
			echo '</div>';
			echo '</div>';
		}

		/**
		 * Function to register admin settings.
		 *
		 * @since    1.0.0
		 */
		public function bpolls_admin_register_settings() {		
			if(isset($_POST['bpolls_settings'])){
				unset($_POST['bpolls_settings']['hidden']);
				update_site_option('bpolls_settings',$_POST['bpolls_settings']);
				wp_redirect($_POST['_wp_http_referer']);
				exit();
			}
		}

		public function bpolls_add_dashboard_widgets() {
			wp_add_dashboard_widget(
					 'bpolls_stats_dashboard_widget',// Widget slug.
					 __( 'Site Polls Data', 'buddypress-polls' ), // Title.
					 array( $this, 'bpolls_stats_dashboard_widget_function' ) // Display function.
			);

			wp_add_dashboard_widget(
					 'bpolls_graph_dashboard_widget',// Widget slug.
					 __( 'Poll Graph', 'buddypress-polls' ), // Title.
					 array( $this, 'bpolls_graph_dashboard_widget_function' ) // Display function.
			);		
		}

		/**
		 * Function to output the contents of polls stats widgets.
		 */
		function bpolls_stats_dashboard_widget_function() {
			$args = array(
				'show_hidden' => true,
				'action' => 'activity_poll',
				'count_total' => true
			);
			$polls_created = 0;
			if ( bp_has_activities( $args ) ) {
				global $activities_template;
				$polls_created = $activities_template->total_activity_count;
			}
			global $wpdb;

			$results = $wpdb->get_row( "SELECT * from {$wpdb->prefix}bp_activity_meta where meta_key = 'bpolls_total_votes' group by activity_id having meta_value=max(meta_value) order by meta_value desc" );
			
			$max_votes_act_link = "#";
			if( isset($results->activity_id) ){
				$max_votes = $results->meta_value;
				$max_votes_act_link = bp_activity_get_permalink( $results->activity_id );
				$activity_obj = bp_activity_get( array( 'in'=> $results->activity_id, 'max'=>1 ) );
				$title = $activity_content = $activity_obj['activities'][0]->content;
				$length = strlen( $activity_content );
				if( $length > 60 ) {
					$title = bp_create_excerpt( $activity_content, '50', array(
						'ending'            => '...',
						'exact'             => false,
						'html'              => true,
						'filter_shortcodes' => '',
						'strip_tags'        => false,
						'remove_links'      => false,
					) );
				}
			}

			
			$recent_poll = $wpdb->get_row( "SELECT * from {$wpdb->prefix}bp_activity where type = 'activity_poll' group by id having date_recorded=max(date_recorded) order by date_recorded desc" );

			$recent_poll_link = "#";
			if( isset( $recent_poll->id ) ){
				$recent_poll_link = bp_activity_get_permalink( $recent_poll->id );
				$recent_title = $r_activity_content = $recent_poll->content;
				$length = strlen( $r_activity_content );
				if( $length > 60 ) {
					$recent_title = bp_create_excerpt( $r_activity_content, '50', array(
						'ending'            => '...',
						'exact'             => false,
						'html'              => true,
						'filter_shortcodes' => '',
						'strip_tags'        => false,
						'remove_links'      => false,
					) );
				}
			}
			if( $polls_created ) {	
				?>
				<div class="bpolls_stats_wrapper">
					<table class="form-table">
						<tr>
							<td><?php _e( 'Polls Created', 'buddypress-polls' ); ?></td>
							<td><?php echo $polls_created; ?></td>
						</tr>
						<tr>
							<td><?php _e( 'Highest Voted Poll', 'buddypress-polls' ); ?></td>
							<td><a href="<?php echo $max_votes_act_link; ?>"><?php echo $title; ?><a></td>
						</tr>
						<tr>
							<td><?php _e( 'Recent Poll', 'buddypress-polls' ); ?></td>
							<td><a href="<?php echo $recent_poll_link; ?>"><?php echo $recent_title; ?><a></td>
						</tr>
					</table>
				</div>
				<?php
			}else{
				?>
				<div class="bpolls-empty-messgae"><?php _e( 'No polls created.', 'buddypress-polls' ); ?></div>
				<?php
			}
		}

		function bpolls_graph_dashboard_widget_function() {

			global $wpdb;

			//$results = $wpdb->get_row( "SELECT * from {$wpdb->prefix}bp_activity_meta where meta_key = 'bpolls_total_votes' group by activity_id having meta_value=max(meta_value) order by meta_value desc" );

			$results = $wpdb->get_row( "SELECT * from {$wpdb->prefix}bp_activity where type = 'activity_poll' group by id having date_recorded=max(date_recorded) order by date_recorded desc" );

			$poll_wdgt = new BP_Poll_Activity_Graph_Widget();
			$poll_wdgt_stngs = $poll_wdgt->get_settings();
			$instance = array(
				'title'            => __('Poll Graph', 'buddypress-polls'),
				'max_activity'     => 50,
				'activity_default' => (isset($results->id))?$results->id:''
			);
			the_widget( 'BP_Poll_Activity_Graph_Widget', $instance );
		}
	}
}