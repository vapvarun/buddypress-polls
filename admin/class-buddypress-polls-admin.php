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
if ( ! class_exists( 'Buddypress_Polls_Admin' ) ) {

	/** Buddypress_Polls_Admin class */
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
		 * @param      string $plugin_name       The name of this plugin.
		 * @param      string $version    The version of this plugin.
		 */
		public function __construct( $plugin_name, $version ) {

			$this->plugin_name = $plugin_name;
			$this->version     = $version;

		}

		/**
		 * Register the stylesheets for the admin area.
		 *
		 * @since    1.0.0
		 * @param hook $hook hook.
		 */
		public function enqueue_styles( $hook ) {
			$activity_page = filter_input( INPUT_GET, 'page' ) ? filter_input( INPUT_GET, 'page' ) : 'bp-activity';
			if ( isset( $activity_page ) && 'bp-activity' === $activity_page ) {
				wp_enqueue_style( $this->plugin_name, BPOLLS_PLUGIN_URL . 'public/css/buddypress-polls-public.css', array(), time(), 'all' );
			}

			if ( 'wb-plugins_page_buddypress-polls' !== $hook ) {
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
			$admin_page = filter_input( INPUT_GET, 'page' ) ? filter_input( INPUT_GET, 'page' ) : 'buddypress-polls';
			if ( isset( $admin_page ) && 'buddypress-polls' === $admin_page ) {

				wp_enqueue_style( 'wp-color-picker' );

				if ( ! wp_style_is( 'polls-selectize-css', 'enqueued' ) ) {
					wp_enqueue_style( 'polls-selectize-css', plugin_dir_url( __FILE__ ) . 'css/selectize.css', array(), $this->version, 'all' );
				}

				wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/buddypress-polls-admin.css', array(), $this->version, 'all' );
			}
		}

		/**
		 * Hide all notices from the setting page.
		 *
		 * @return void
		 */
		public function wbcom_hide_all_admin_notices_from_setting_page() {
			$wbcom_pages_array  = array( 'wbcomplugins', 'wbcom-plugins-page', 'wbcom-support-page', 'buddypress-polls' );
			$wbcom_setting_page = filter_input( INPUT_GET, 'page' ) ? filter_input( INPUT_GET, 'page' ) : '';

			if ( in_array( $wbcom_setting_page, $wbcom_pages_array, true ) ) {
				remove_all_actions( 'admin_notices' );
				remove_all_actions( 'all_admin_notices' );
			}
		}

		/**
		 * Register the JavaScript for the admin area.
		 *
		 * @since    1.0.0
		 * @param hook $hook hook.
		 */
		public function enqueue_scripts( $hook ) {
			if ( 'wb-plugins_page_buddypress-polls' !== $hook ) {
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
			$admin_page = filter_input( INPUT_GET, 'page' ) ? filter_input( INPUT_GET, 'page' ) : 'buddypress-polls';
			if ( isset( $admin_page ) && 'buddypress-polls' === $admin_page ) {
				if ( ! wp_script_is( 'polls-selectize-js', 'enqueued' ) ) {
					wp_enqueue_script( 'polls-selectize-js', plugin_dir_url( __FILE__ ) . 'js/selectize.min.js', array( 'jquery' ), $this->version, false );
				}

				wp_enqueue_script( 'wp-color-picker' );
				wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/buddypress-polls-admin.js', array( 'jquery' ), $this->version, false );
			}
		}

		/**
		 * Register admin menu for plugin.
		 *
		 * @since    1.0.0
		 */
		public function bpolls_add_menu_buddypress_polls() {

			if ( empty( $GLOBALS['admin_page_hooks']['wbcomplugins'] ) ) {

				add_menu_page( esc_html__( 'WB Plugins', 'buddypress-polls' ), esc_html__( 'WB Plugins', 'buddypress-polls' ), 'manage_options', 'wbcomplugins', array( $this, 'bpolls_buddypress_polls_settings_page' ), 'dashicons-lightbulb', 59 );
				add_submenu_page( 'wbcomplugins', esc_html__( 'General', 'buddypress-polls' ), esc_html__( 'General', 'buddypress-polls' ), 'manage_options', 'wbcomplugins' );
			}
			add_submenu_page( 'wbcomplugins', esc_html__( 'Buddypress Polls Settings Page', 'buddypress-polls' ), esc_html__( 'BuddyPress Polls', 'buddypress-polls' ), 'manage_options', 'buddypress-polls', array( $this, 'bpolls_buddypress_polls_settings_page' ) );

		}

		/**
		 * Callable function for admin menu setting page.
		 *
		 * @since    1.0.0
		 */
		public function bpolls_buddypress_polls_settings_page() {
			$current = filter_input( INPUT_GET, 'tab' ) ? filter_input( INPUT_GET, 'tab' ) : 'welcome';
			?>

			<div class="wrap">
				<div class="wbcom-bb-plugins-offer-wrapper">
					<div id="wb_admin_logo">
						<a href="https://wbcomdesigns.com/downloads/buddypress-community-bundle/" target="_blank">
							<img src="<?php echo esc_url( BPOLLS_PLUGIN_URL ) . '/admin/assets/wbcom/assets/imgs/wbcom-offer-notice.png'; ?>">
						</a>
					</div>
				</div>
				<div class="wbcom-wrap buddyPress-polls-header">					
				<div class="blpro-header">
					<div class="wbcom_admin_header-wrapper">
						<div id="wb_admin_plugin_name">
							<?php esc_html_e( 'BuddyPress Polls', 'buddypress-polls' ); ?>
							<span><?php printf( esc_html__( 'Version %s', 'buddypress-polls' ), esc_attr(BPOLLS_PLUGIN_VERSION) ); ?></span>
						</div>
						<?php echo do_shortcode( '[wbcom_admin_setting_header]' ); ?>
					</div>
				</div>
				<div class="wbcom-admin-settings-page">
			<?php
			$bpolls_tabs = array(
				'welcome' => esc_html__( 'Welcome', 'buddypress-polls' ),
				'general' => esc_html__( 'General', 'buddypress-polls' ),
				'support' => esc_html__( 'Support', 'buddypress-polls' ),
			);

			$tab_html = '<div class="wbcom-tabs-section"><div class="nav-tab-wrapper"><div class="wb-responsive-menu"><span>' . esc_html( 'Menu' ) . '</span><input class="wb-toggle-btn" type="checkbox" id="wb-toggle-btn"><label class="wb-toggle-icon" for="wb-toggle-btn"><span class="wb-icon-bars"></span></label></div><ul>';
			foreach ( $bpolls_tabs as $bpolls_tab => $bpolls_name ) {
				$class     = ( $bpolls_tab == $current ) ? 'nav-tab-active' : '';
				$tab_html .= '<li class="' . $bpolls_name . '"><a class="nav-tab ' . $class . '" href="admin.php?page=buddypress-polls&tab=' . $bpolls_tab . '">' . $bpolls_name . '</a></li>';
			}
			$tab_html .= '</div></ul></div>';
			echo wp_kses_post( $tab_html );
			include 'inc/bpolls-tabs-options.php';
			echo '</div>';
			echo '</div>';
			echo '</div>';
		}

		/**
		 * Function to register admin settings.
		 *
		 * @since    1.0.0
		 */
		public function bpolls_admin_register_settings() {
			if ( isset( $_POST['bpolls_settings'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
				unset( $_POST['bpolls_settings']['hidden'] ); // phpcs:ignore WordPress.Security.NonceVerification, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
				update_site_option( 'bpolls_settings', wp_unslash( $_POST['bpolls_settings'] ) ); // phpcs:ignore WordPress.Security.NonceVerification, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized
				wp_safe_redirect( $_POST['_wp_http_referer'] ); // phpcs:ignore WordPress.Security.NonceVerification, WordPress.Security.ValidatedSanitizedInput.InputNotSanitized, WordPress.Security.ValidatedSanitizedInput.MissingUnslash
				exit();
			}
		}
		

		
		/**
		 * Bpolls_add_dashboard_widgets
		 *
		 * @since    1.0.0
		 */
		public function bpolls_add_dashboard_widgets() {
			wp_add_dashboard_widget(
				'bpolls_stats_dashboard_widget', // Widget slug.
				esc_html__( 'Site Polls Data', 'buddypress-polls' ), // Title.
				array( $this, 'bpolls_stats_dashboard_widget_function' ) // Display function.
			);

			wp_add_dashboard_widget(
				'bpolls_graph_dashboard_widget', // Widget slug.
				esc_html__( 'Poll Graph', 'buddypress-polls' ), // Title.
				array( $this, 'bpolls_graph_dashboard_widget_function' ) // Display function.
			);
		}

		/**
		 * Function to output the contents of polls stats widgets.
		 */
		public function bpolls_stats_dashboard_widget_function() {
			$args          = array(
				'show_hidden' => true,
				'action'      => 'activity_poll',
				'count_total' => true,
			);
			$polls_created = 0;
			if ( bp_has_activities( $args ) ) {
				global $activities_template;
				$polls_created = $activities_template->total_activity_count;
			}
			global $wpdb;

			$results = $wpdb->get_row( "SELECT * from {$wpdb->prefix}bp_activity_meta where meta_key = 'bpolls_total_votes' group by activity_id having meta_value=max(meta_value) order by meta_value desc" );

			$max_votes_act_link = '#';
			$title              = '';
			if ( isset( $results->activity_id ) ) {
				$max_votes          = $results->meta_value;
				$max_votes_act_link = bp_activity_get_permalink( $results->activity_id );
				$activity_obj       = bp_activity_get(
					array(
						'in'     => $results->activity_id,
						'max'    => 1,
						'action' => 'activity_poll',
						'type'   => 'activity_poll',
					)
				);
				$title              = $activity_content = $activity_obj['activities'][0]->content;
				$length             = strlen( $activity_content );
				if ( $length > 60 ) {
					$title = bp_create_excerpt(
						$activity_content,
						'50',
						array(
							'ending'            => '...',
							'exact'             => false,
							'html'              => true,
							'filter_shortcodes' => '',
							'strip_tags'        => false,
							'remove_links'      => false,
						)
					);
				}
			}

			$recent_poll = $wpdb->get_row( "SELECT * from {$wpdb->prefix}bp_activity where type = 'activity_poll' group by id having date_recorded=max(date_recorded) order by date_recorded desc" );

			$recent_poll_link = '#';
			if ( isset( $recent_poll->id ) ) {
				$recent_poll_link = bp_activity_get_permalink( $recent_poll->id );
				$recent_title     = $r_activity_content = $recent_poll->content;
				$length           = strlen( $r_activity_content );
				if ( $length > 60 ) {
					$recent_title = bp_create_excerpt(
						$r_activity_content,
						'50',
						array(
							'ending'            => '...',
							'exact'             => false,
							'html'              => true,
							'filter_shortcodes' => '',
							'strip_tags'        => false,
							'remove_links'      => false,
						)
					);
				}
			}
			if ( $polls_created ) {
				?>
				<div class="bpolls_stats_wrapper">
					<table class="form-table">
						<tr>
							<td><?php esc_html_e( 'Polls Created', 'buddypress-polls' ); ?></td>
							<td><?php echo esc_html( $polls_created ); ?></td>
						</tr>
						<tr>
							<td><?php esc_html_e( 'Highest Voted Poll', 'buddypress-polls' ); ?></td>
							<td><a href="<?php echo esc_url( $max_votes_act_link ); ?>"><?php echo $title; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?><a></td>
						</tr>
						<tr>
							<td><?php esc_html_e( 'Recent Poll', 'buddypress-polls' ); ?></td>
							<td><a href="<?php echo esc_url( $recent_poll_link ); ?>"><?php echo esc_html( $recent_title ); ?><a></td>
						</tr>
					</table>
				</div>
				<?php
			} else {
				?>
				<div class="bpolls-empty-messgae"><?php esc_html_e( 'No polls created.', 'buddypress-polls' ); ?></div>
				<?php
			}
		}

		/**
		 * Bpolls_graph_dashboard_widget_function
		 */
		public function bpolls_graph_dashboard_widget_function() {

			global $wpdb;

			$results = $wpdb->get_row( "SELECT * from {$wpdb->prefix}bp_activity where type = 'activity_poll' group by id having date_recorded=max(date_recorded) order by date_recorded desc" );

			$poll_wdgt       = new BP_Poll_Activity_Graph_Widget();
			$poll_wdgt_stngs = $poll_wdgt->get_settings();
			$instance        = array(
				'title'            => esc_html__( 'Poll Graph', 'buddypress-polls' ),
				'max_activity'     => 50,
				'activity_default' => ( isset( $results->id ) ) ? $results->id : '',
			);
			the_widget( 'BP_Poll_Activity_Graph_Widget', $instance );
		}

		/**
		 * Bpolls_activity_polls_data_export
		 */
		public function bpolls_activity_polls_data_export() {

			$contributor = get_role( 'contributor' );
			$subscriber  = get_role( 'subscriber' );

			if ( ! empty( $contributor ) ) {
				$contributor->add_cap( 'upload_files' );
			}

			if ( ! empty( $subscriber ) ) {
				$subscriber->add_cap( 'upload_files' );
			}

			if ( isset( $_REQUEST['export_csv'] ) && 1 == $_REQUEST['export_csv'] && isset( $_REQUEST['buddypress_poll'] ) && 1 == $_REQUEST['buddypress_poll'] && isset( $_REQUEST['activity_id'] ) ) { // phpcs:ignore WordPress.Security.NonceVerification
				$activity_id   = isset( $_REQUEST['activity_id'] ) ? sanitize_text_field( wp_unslash( $_REQUEST['activity_id'] ) ) : 0; // phpcs:ignore WordPress.Security.NonceVerification
				$activity_meta = bp_activity_get_meta( $activity_id, 'bpolls_meta' );

				$file         = 'buddypress-activity-poll-info.csv';
				$uploads_path = ABSPATH . 'wp-content/uploads/';
				$fp           = fopen( $uploads_path . $file, 'a' ) or die( "Error Couldn't open $file for writing!" ); // phpcs:ignore WordPress.Security.EscapeOutput

				$csv_header = array( 'User ID', 'UserName' );
				foreach ( $activity_meta['poll_option'] as $key => $value ) {
					$csv_header[ $key ] = $value;
				}
				fputs( $fp, $bom = ( chr( 0xEF ) . chr( 0xBB ) . chr( 0xBF ) ) );
				fputcsv( $fp, $csv_header );
				$activity_meta = bp_activity_get_meta( $activity_id, 'bpolls_meta' );
				$users         = $activity_meta['poll_users'];
				$args          = array(
					'include' => $users,
				);

				$users       = new WP_User_Query( $args );
				$users_found = $users->get_results();
				foreach ( $users_found as $user ) {
					$results['users'][] = $user->ID;
					$user_id            = $user->ID;
					$user_display_name  = $user->user_login;

					$user_polls_data         = get_user_meta( $user_id, 'bpoll_user_vote', true );
					$user_activity_poll_data = isset( $user_polls_data[ $activity_id ] ) ? $user_polls_data[ $activity_id ] : array();

					$fields = array( $user_id, $user_display_name );

					foreach ( $activity_meta['poll_option'] as $key => $value ) {
						if ( in_array( $key, $user_activity_poll_data, true ) ) {
							$fields[] = 'true';
						} else {
							$fields[] = '-';
						}
					}
					$fields = array_map( 'utf8_decode', $fields );
					fputcsv( $fp, $fields );

				}

				fclose( $fp );

				ignore_user_abort( true );
				set_time_limit( 0 ); // disable the time limit for this script.

				// change the path to fit your websites document structure.
				$dl_file = preg_replace( '([^\w\s\d\-_~,;:\[\]\(\].]|[\.]{2,})', '', $file ); // simple file name validation.
				$dl_file = filter_var( $dl_file, FILTER_SANITIZE_URL ); // Remove (more) invalid characters.

				$uploads_path = ABSPATH . 'wp-content/uploads/'; // change the path to fit your websites document structure.
				$full_path    = $uploads_path . $dl_file;

				if ( $fd = fopen( $full_path, 'r' ) ) {
					$path_parts = pathinfo( $full_path );

					header( 'Content-type: application/csv' );
					header( 'Content-Disposition: attachment; filename="' . $path_parts['basename'] . '"' ); // use.
					header( 'Cache-control: private' ); // use this to open files directly.
					header( 'Content-Transfer-Encoding: binary' );
					while ( ! feof( $fd ) ) {
						$buffer = fread( $fd, 2048 );
						echo $buffer; // phpcs:ignore WordPress.Security.EscapeOutput
					}
				}
				fclose( $fd );
				unlink( $uploads_path . $file );
				exit;
			}
		}

		/****** Polls functions *******/

		public function init_wbpoll_type()
		{
			WBPollHelper::create_wbpoll_post_type();
	
		}//end method init_wbpoll_type

		/**
		 * wbpoll type post listing extra cols
		 *
		 * @param $wbpoll_columns
		 *
		 * @return mixed
		 *
		 */
		public function add_new_poll_columns($wbpoll_columns)
		{
			$wbpoll_columns['title']      = esc_html__('Poll Title', 'wbpoll');
			$wbpoll_columns['pollstatus'] = esc_html__('Status', 'wbpoll');
			$wbpoll_columns['startdate']  = esc_html__('Start Date', 'wbpoll');
			$wbpoll_columns['enddate']    = esc_html__('End Date', 'wbpoll');
			$wbpoll_columns['date']       = esc_html__('Created', 'wbpoll');
			$wbpoll_columns['pollvotes']  = esc_html__('Votes', 'wbpoll');
			$wbpoll_columns['shortcode']  = esc_html__('Shortcode', 'wbpoll');

			return $wbpoll_columns;
		}//end method add_new_poll_columns

		/**
		 * wbpoll type post listing extra col values
		 *
		 * @param $column_name
		 *
		 */
		public function manage_poll_columns($column_name, $post_id)
		{

			global $post;

			//$post_id = $post->ID;

			$end_date     = get_post_meta($post_id, '_wbpoll_end_date', true);
			$start_date   = get_post_meta($post_id, '_wbpoll_start_date', true);
			$never_expire = intval(get_post_meta($post_id, '_wbpoll_never_expire', true));
			$total_votes  = absint(get_post_meta($post_id, '_wbpoll_total_votes', true));

			switch ($column_name) {

				case 'pollstatus':
					// Get number of images in gallery
					if ($never_expire == 1) {
						if (new DateTime($start_date) > new DateTime()) {
							echo '<span class="dashicons dashicons-calendar"></span> '.esc_html__('Yet to Start',
									'wbpoll'); //
						} else {
							echo '<span class="dashicons dashicons-yes"></span> '.esc_html__('Active', 'wbpoll');
						}

					} else {
						if (new DateTime($start_date) > new DateTime()) {
							echo '<span class="dashicons dashicons-calendar"></span> '.__('Yet to Start', 'wbpoll'); //
						} else {
							if (new DateTime($start_date) <= new DateTime() && new DateTime($end_date) > new DateTime()) {
								echo '<span class="dashicons dashicons-yes"></span> '.esc_html__('Active', 'wbpoll');
							} else {
								if (new DateTime($end_date) <= new DateTime()) {
									echo '<span class="dashicons dashicons-lock"></span> '.esc_html__('Expired', 'wbpoll');
								}
							}
						}
					}
					break;
				case 'startdate':
					echo $start_date;
					break;
				case 'enddate':
					echo $end_date;
					break;
				case 'pollvotes':
					echo apply_filters('wbpoll_admin_listing_votes', $total_votes, $post_id);
					break;
				case 'shortcode':
					echo '<span id="wbpollhortcode-'.$post_id.'" class="wbpollhortcode wbpollhortcode-'.$post_id.'">[wbpoll id="'.$post_id.'"]</span><span class="wbpoll_ctp" aria-label="'.esc_html__('Click to copy',
							'wbpoll').'" data-balloon-pos="down">&nbsp;</span>';

					break;
				default:
					break;
			} // end switch

		}//end method manage_poll_columns

		 /**
		 * wbpoll type post liting extra col sortable
		 *
		 * make poll table columns sortable
		 */
		function wbpoll_columnsort($columns)
		{
			$columns['startdate']  = 'startdate';
			$columns['enddate']    = 'enddate';
			$columns['pollstatus'] = 'pollstatus';
			$columns['pollvotes']  = 'pollvotes';

			return $columns;
		}//end method wbpoll_columnsort

		/**
		 * Inits all shortcodes
		 */
		public function init_shortcodes()
		{
			add_shortcode('wbpoll', array($this, 'wbpoll_shortcode')); //single poll shortcode
			add_shortcode('wbpoll', array($this, 'wbpolls_shortcode')); //all polls shortcode
		}//end method init_shortcodes

		 /**
		 * Shortcode callback function to display all polls or poll archive
		 *
		 * @param $atts
		 *
		 * @return string
		 */
		public static function wbpolls_shortcode($atts)
		{
			// normalize attribute keys, lowercase
			$atts = array_change_key_case((array) $atts, CASE_LOWER);

			//$global_result_chart_type = isset($setting_api['result_chart_type']) ? $setting_api['result_chart_type'] : 'text';
			$global_result_chart_type = 'text';
			$global_answer_grid_list  = 1; //0 = list 1 = grid


			$nonce          = wp_create_nonce('wbpollslisting');
			$show_load_more = true;

			$options = shortcode_atts(array(
				'per_page'    => 5,
				'chart_type'  => $global_result_chart_type, //chart type, default will be always 'text' if not defined
				//'chart_type'  => '', //chart type, default will be always 'text' if not defined
				'grid'        => $global_answer_grid_list, //show grid or list as answer
				'description' => 1, //show poll description,
				'user_id'     => 0 //if we want to show polls from any user
			), $atts);

			$per_page            = (int) $options['per_page']; //just for check now its 2 after get from args
			$current_page_number = 1;

			$description      = intval($options['description']);
			$chart_type       = $options['chart_type'];
			$answer_grid_list = intval($options['grid']);
			$user_id          = intval($options['user_id']);

			$content = '<div class="wbpoll-listing-wrap">';
			$content .= '<div class="wbpoll-listing">';

			$poll_list_output = WBPollHelper::poll_list($user_id, $per_page, $current_page_number, $chart_type,
				$answer_grid_list, $description, 'shortcode');


			if (intval($poll_list_output['found'])) {
				$content .= $poll_list_output['content'];
			} else {
				$content        .= esc_html__('No poll found', 'wbpoll');
				$show_load_more = false;
			}

			$content .= '</div>';

			$current_page_number++;

			if ($show_load_more && $poll_list_output['max_num_pages'] == 1) {
				$show_load_more = false;
			}


			if ($show_load_more && (int) $options['per_page'] != -1 && $options['per_page'] != '') {
				$content .= '<p class="wbpoll-listing-more"><a class="wbpoll-listing-trig" href="#" data-user_id="'.intval($user_id).'" data-security="'.$nonce.'" data-page-no="'.$current_page_number.'"  data-busy ="0" data-per-page="'.$per_page.'">'.esc_html__('View More Polls',
						'wbpoll').'<span class="cbvoteajaximage cbvoteajaximagecustom"></span></a></p>';
			}

			$content .= '</div>';

			return $content;
		}//end method wbpolls_shortcode

		/**
		 * Shortcode callback function to display single poll [wbpoll id="comma separated poll id"]
		 *
		 * @param $atts
		 *
		 * @return string
		 * @throws Exception
		 */
		public function wbpoll_shortcode($atts)
		{

			// normalize attribute keys, lowercase
			$atts = array_change_key_case((array) $atts, CASE_LOWER);


			//$global_result_chart_type = isset($setting_api['result_chart_type']) ? $setting_api['result_chart_type'] : 'text';
			$global_result_chart_type = 'text';
			$global_answer_grid_list  = 1; //0 = list 1 = grid

			$options = shortcode_atts(array(
				'id'          => '',
				'reference'   => 'shortcode',
				'description' => '', //show poll description in shortcode
				'chart_type'  => $global_result_chart_type,
				'grid'        => $global_answer_grid_list
			), $atts, 'wbpoll');

			$reference   = esc_attr($options['reference']);
			$chart_type  = esc_attr($options['chart_type']);
			$description = esc_attr($options['description']);
			$grid        = intval($options['grid']);


			$poll_ids = array_map('trim', explode(',', $options['id']));


			$output = '';
			if (is_array($poll_ids) && sizeof($poll_ids) > 0) {
				foreach ($poll_ids as $poll_id) {
					$output .= wbpollHelper::wbpoll_single_display($poll_id, $reference, $chart_type, $grid,
						$description);
				}
			}


			return $output;
		}//end method wbpoll_shortcode

		 /**
		 * Hook custom meta box
		 */
		function metaboxes_display()
		{

			//add meta box in left side to show poll setting
			add_meta_box('pollcustom_meta_box',
				esc_html__('Poll Options', 'wbpoll'), 
				array($this, 'metabox_setting_display'), 
				'wbpoll',                                   
				'normal',                                          
				'high');                                           

			//add meta box in right col to show the result
			add_meta_box('pollresult_meta_box',                              
				esc_html__('Poll Result', 'wbpoll'),  
				array($this, 'metabox_result_display'),           
				'wbpoll',                                      
				'side',                                          
				'low');

			//add meta box in right col to show the result
			add_meta_box('pollshortcode_meta_box', 
				esc_html__('Shortcode', 'wbpoll'),
				array($this, 'metabox_shortcode_display'),
				'wbpoll', 
				'side', 
				'low');
		}//end method metaboxes_display

		/**
		 * Renders metabox in right col to show  shortcode with copy to clipboard
		 */
		function metabox_shortcode_display()
		{
			global $post;
			$post_id = $post->ID;

			echo '<span  id="wbpollshortcode-'.intval($post_id).'" class="wbpollshortcode wbpollshortcode-single wbpollshortcode-'.intval($post_id).'">[wbpoll id="'.intval($post_id).'"]</span><span class="wbpoll_ctp" aria-label="'.esc_html__('Click to copy',
					'wbpoll').'" data-balloon-pos="down">&nbsp;</span>';
			echo '<div class="wbpollclear"></div>';
		}//end method metabox_shortcode_display

		/**
		 * Renders metabox in right col to show result
		 */
		function metabox_result_display()
		{

			global $post;
			$poll_postid = $post->ID;

			$poll_output = WBPollHelper::show_single_poll_result($poll_postid, 'shortcode', 'text');

			echo $poll_output;
		}//end method metabox_result_display

		/**
		 * Meta box display: Setting
		 */
		function metabox_setting_display()
		{

			global $post;
			$post_meta_fields = WBPollHelper::get_meta_fields();


			$poll_postid = isset($post->ID) ? intval($post->ID) : 0;

			$prefix = '_wbpoll_';

			//$answer_counter = 0;
			$new_index = 0;

			$is_voted = 0;
			$poll_answers = array();
			$poll_colors = array();
			$full_size_image  = array();
			$thumbnail_size_image = array();
			$video_url = array();
			$video_thumbnail_image = array();
			$audio_url = array();
			$audio_thumbnail_image = array();
			$html_code = array();

			if ($poll_postid > 0):
				//$is_voted           = intval( get_post_meta( $poll_postid, '_wbpoll_is_voted', true ) );
				$is_voted = WBPollHelper::is_poll_voted($poll_postid);

				$poll_answers       = get_post_meta($poll_postid, '_wbpoll_answer', true);
				$poll_colors        = get_post_meta($poll_postid, '_wbpoll_answer_color', true);
				$poll_answers_extra = get_post_meta($poll_postid, '_wbpoll_answer_extra', true);
				
				$full_size_images = get_post_meta($poll_postid, '_wbpoll_full_size_image_answer', true);
				if (isset($full_size_images) && !empty($full_size_images)){
					$full_size_image = $full_size_images;
				} 

				$thumbnail_size_images = get_post_meta($poll_postid, '_wbpoll_full_thumbnail_image_answer', true);
				if (isset($thumbnail_size_images) && !empty($thumbnail_size_images)){
					$thumbnail_size_image = $thumbnail_size_images;
				} 

				$video_urls = get_post_meta($poll_postid, '_wbpoll_video_answer_url', true);
				if (isset($video_urls) && !empty($video_urls)){
					$video_url = $video_urls;
				} 

				$video_thumbnail_images = get_post_meta($poll_postid, '_wbpoll_video_thumbnail_image_url', true);
				if (isset($video_thumbnail_images) && !empty($video_thumbnail_images)){
					$video_thumbnail_image = $video_thumbnail_images;
				}

				$audio_urls = get_post_meta($poll_postid, '_wbpoll_audio_answer_url', true);
				if (isset($audio_urls) && !empty($audio_urls)){
					$audio_url = $audio_urls;
				} 

				$audio_thumbnail_images = get_post_meta($poll_postid, '_wbpoll_audio_thumbnail_image_url', true);
				if (isset($audio_thumbnail_images) && !empty($audio_thumbnail_images)){
					$audio_thumbnail_image = $audio_thumbnail_images;
				}

				$html_codes = get_post_meta($poll_postid, '_wbpoll_html_answer', true);
				if (isset($html_codes) && !empty($html_codes)){
					$html_code = $html_codes;
				}

				$new_index = isset($poll_answers_extra['answercount']) ? intval($poll_answers_extra['answercount']) : 0;


				if (is_array($poll_answers)) {
					if ($new_index == 0 && sizeof($poll_answers) > 0) {
						$old_index = $new_index;
						foreach ($poll_answers as $index => $poll_answer) {
							if ($index > $old_index) {
								$old_index = $index;
							} //find the greater index
						}

						if ($old_index > $new_index) {
							$new_index = intval($old_index) + 1;
						}
					}
				} else {
					$poll_answers = array();
				}


				wp_nonce_field('wbpoll_meta_box', 'wbpoll_meta_box_nonce');

				echo '<div id="wbpoll_answer_wrap" class="wbpoll_answer_wrap" data-postid="'.$poll_postid.'">';
				echo '<h4>'.esc_html__('Poll Answers', 'wbpoll').'</h4>';
				echo __('<p>[<strong>Note : </strong>  <span>Please select different color for each field.]</span></p>',
					'wbpoll');


				echo '<ul id="wb_poll_answers_items" class="wb_poll_answers_items wb_poll_answers_items_'.$post->ID.'">';

				if (sizeof($poll_answers) > 0) {

					foreach ($poll_answers as $index => $poll_answer) {

						if (isset($poll_answer)) {
							$poll_answers_extra[$index] = isset($poll_answers_extra[$index]) ? $poll_answers_extra[$index] : '';
							$poll_colors[$index] = isset($poll_colors[$index]) ? $poll_colors[$index] : '';

							//image
							$thumbnail_size_image[$index] = isset($thumbnail_size_image[$index]) ? $thumbnail_size_image[$index] : array();
							$full_size_image[$index] = isset($full_size_image[$index]) ? $full_size_image[$index] : array();

							//video
							$video_url[$index] = isset($video_url[$index]) ? $video_url[$index] : array();
							$video_thumbnail_image[$index] = isset($video_thumbnail_image[$index]) ? $video_thumbnail_image[$index] : array();

							//audio
							
							$audio_url[$index] = isset($audio_url[$index]) ? $audio_url[$index] : array();
							$audio_thumbnail_image[$index] = isset($audio_thumbnail_image[$index]) ? $audio_thumbnail_image[$index] : array();

							//HTML
							$html_code[$index] = isset($html_code[$index]) ? $html_code[$index] : array();
							
							echo WBPollHelper::wbpoll_answer_field_template($index, $poll_answer, $poll_colors[$index], $is_voted, $poll_answers_extra[$index], $poll_postid, $full_size_image[$index], $thumbnail_size_image[$index], $video_url[$index], $video_thumbnail_image[$index], $html_code[$index], $audio_url[$index], $audio_thumbnail_image[$index]);
						}
					}
				}
				//else {


				//$answer_counter         = 3;
				if (!$is_voted && sizeof($poll_answers) == 0) {
					$default_answers_titles = array(
						esc_html__('Yes', 'wbpoll'),
						esc_html__('No', 'wbpoll'),
						esc_html__('No comments', 'wbpoll')
					);

					$default_answers_colors = array(
						'#2f7022',
						'#dd6363',
						'#e4e4e4'
					);

					$answers_extra = array('type' => 'default');
					$thumbnail_size_image = array();
					$full_size_image = array();
					$video_url = array();
					$video_thumbnail_image = array();
					$audio_url = array();
					$audio_thumbnail_image = array();
					$html_code = array();

					$thumbnail_size_image = array();
					foreach ($default_answers_titles as $index => $answers_title) {
						
						//image
						$thumbnail_size_image[$index] = isset($thumbnail_size_image[$index]) ? $thumbnail_size_image[$index] : array();
						$full_size_image[$index] = isset($full_size_image[$index]) ? $full_size_image[$index] : array();


						//video
						$video_url[$index] = isset($video_url[$index]) ? $video_url[$index] : array();
						$video_thumbnail_image[$index] = isset($video_thumbnail_image[$index]) ? $video_thumbnail_image[$index] : array();

						//audio
						$audio_url[$index] = isset($audio_url[$index]) ? $audio_url[$index] : array();
						$audio_thumbnail_image[$index] = isset($audio_thumbnail_image[$index]) ? $audio_thumbnail_image[$index] : array();

						//HTML
						$html_code[$index] = isset($html_code[$index]) ? $html_code[$index] : array();

						echo WBPollHelper::wbpoll_answer_field_template(intval($index) + $new_index,
							$default_answers_titles[$index], $default_answers_colors[$index], $is_voted, $answers_extra,
							$poll_postid, $full_size_image[$index], $thumbnail_size_image[$index], $video_url[$index], $video_thumbnail_image[$index], $html_code[$index], $audio_url[$index], $audio_thumbnail_image[$index]);
					}

					$new_index = intval($index) + $new_index + 1;
				}


				//}
				echo '</ul>';
				?>
				<input type="hidden" id="wbpoll_answer_extra_answercount" value="<?php echo intval($new_index); ?>"
					name="_wbpoll_answer_extra[answercount]"/>
				<?php //if ( ! $is_voted ){
				?>
				<div class="add-wb-poll-answer-wrap" data-busy="0" data-postid="<?php echo $poll_postid; ?>">
					<a data-type="default" id="add-wb-poll-answer-default"
					class="float-left button button-primary add-wb-poll-answer add-wb-poll-answer-default add-wb-poll-answer-<?php echo $poll_postid; ?>"><i
								style="line-height: 25px;"
								class="dashicons dashicons-media-text"></i> <?php echo esc_html__('Add Text Answer',
							'wbpoll'); ?>
					</a>
					<?php do_action('wbpolladmin_add_answertype', $poll_postid, $new_index); ?>
				</div>
				<div class="add-wb-poll-answer-image-wrap" data-busy="0" data-postid="<?php echo $poll_postid; ?>">
					<a data-type="image" id="add-wb-poll-image-answer"
					class="float-left button button-primary add-wb-poll-image-answer add-wb-poll-answer-image add-wb-poll-image-answer-<?php echo $poll_postid; ?>"><i
								style="line-height: 25px;"
								class="dashicons dashicons-media-text"></i> <?php echo esc_html__('Add Image Answer',
							'wbpoll'); ?>
					</a>
					<?php do_action('wbpolladmin_add_answertype', $poll_postid, $new_index); ?>
				</div>
				<div class="add-wb-poll-answer-video-wrap" data-busy="0" data-postid="<?php echo $poll_postid; ?>">
					<a data-type="video" id="add-wb-poll-video-answer"
					class="float-left button button-primary add-wb-poll-video-answer add-wb-poll-answer-video add-wb-poll-video-answer-<?php echo $poll_postid; ?>"><i
								style="line-height: 25px;"
								class="dashicons dashicons-media-text"></i> <?php echo esc_html__('Add Video Answer',
							'wbpoll'); ?>
					</a>
					<?php do_action('wbpolladmin_add_answertype', $poll_postid, $new_index); ?>
				</div>
				<div class="add-wb-poll-answer-audio-wrap" data-busy="0" data-postid="<?php echo $poll_postid; ?>">
					<a data-type="audio" id="add-wb-poll-audio-answer"
					class="float-left button button-primary add-wb-poll-audio-answer add-wb-poll-answer-audio add-wb-poll-audio-answer-<?php echo $poll_postid; ?>"><i
								style="line-height: 25px;"
								class="dashicons dashicons-media-text"></i> <?php echo esc_html__('Add Audio Answer',
							'wbpoll'); ?>
					</a>
					<?php do_action('wbpolladmin_add_answertype', $poll_postid, $new_index); ?>
				</div>
				<div class="add-wb-poll-answer-html-wrap" data-busy="0" data-postid="<?php echo $poll_postid; ?>">
					<a data-type="html" id="add-wb-poll-html-answer"
					class="float-left button button-primary add-wb-poll-html-answer add-wb-poll-html-answer add-wb-poll-html-answer-<?php echo $poll_postid; ?>"><i
								style="line-height: 25px;"
								class="dashicons dashicons-media-text"></i> <?php echo esc_html__('Add HTML Answer',
							'wbpoll'); ?>
					</a>
					<?php do_action('wbpolladmin_add_answertype', $poll_postid, $new_index); ?>
				</div>
				<?php //}
				?>
				<br/>

				<?php
				echo '</div>';


				echo '<table class="form-table">';

				foreach ($post_meta_fields as $field) {

					$meta = get_post_meta($poll_postid, $field['id'], true);


					if ($meta == '' && isset($field['default'])) {

						$meta = $field['default'];
					}

					$label = isset($field['label']) ? $field['label'] : '';

					echo '<tr>';
					echo '<th><label for="'.$field['id'].'">'.$label.'</label></th>';
					echo '<td>';


					switch ($field['type']) {

						case 'text':
							echo '<input type="text" class="regular-text" name="'.$field['id'].'" id="'.$field['id'].'-text-'.$poll_postid.'" value="'.$meta.'" size="30" />
							<span class="description">'.$field['desc'].'</span>';
							break;
						case 'number':
							echo '<input type="number" class="regular-text" name="'.$field['id'].'" id="'.$field['id'].'-number-'.$poll_postid.'" value="'.$meta.'" size="30" />
							<span class="description">'.$field['desc'].'</span>';
							break;

						case 'date':

							echo '<input type="text" class="wbpollmetadatepicker" name="'.$field['id'].'" id="'.$field['id'].'-date-'.$poll_postid.'" value="'.$meta.'" size="30" />
							<span class="description">'.$field['desc'].'</span>';
							break;

						case 'colorpicker':


							echo '<input type="text" class="wbpoll-colorpicker" name="'.$field['id'].'" id="'.$field['id'].'-date-'.$poll_postid.'" value="'.$meta.'" size="30" />
							<span class="description">'.$field['desc'].'</span>';
							break;

						case 'multiselect':
							echo '<select name="'.$field['id'].'[]" id="'.$field['id'].'-chosen-'.$poll_postid.'" class="selecttwo-select" multiple="multiple">';
							if (isset($field['optgroup']) && intval($field['optgroup'])) {

								foreach ($field['options'] as $optlabel => $data) {
									echo '<optgroup label="'.$optlabel.'">';
									foreach ($data as $key => $val) {
										echo '<option value="'.$key.'"', is_array($meta) && in_array($key,
											$meta) ? ' selected="selected"' : '', ' >'.$val.'</option>';
									}
									echo '<optgroup>';
								}

							} else {
								foreach ($field['options'] as $key => $val) {
									echo '<option value="'.$key.'"', is_array($meta) && in_array($key,
										$meta) ? ' selected="selected"' : '', ' >'.$val.'</option>';
								}
							}


							echo '</select><span class="description">'.$field['desc'].'</span>';
							break;

						case 'select':
							echo '<select name="'.$field['id'].'" id="'.$field['id'].'-select-'.$poll_postid.'" class="cb-select select-'.$poll_postid.'">';

							if (isset($field['optgroup']) && intval($field['optgroup'])) {

								foreach ($field['options'] as $optlabel => $data) {
									echo '<optgroup label="'.$optlabel.'">';
									foreach ($data as $index => $option) {
										echo '<option '.(($meta == $index) ? ' selected="selected"' : '').' value="'.$index.'">'.$option.'</option>';
									}

								}
							} else {
								foreach ($field['options'] as $index => $option) {
									echo '<option '.(($meta == $index) ? ' selected="selected"' : '').' value="'.$index.'">'.$option.'</option>';
								}
							}


							echo '</select><br/><span class="description">'.$field['desc'].'</span>';
							break;
						case 'radio':

							echo '<fieldset class="radio_fields">
									<legend class="screen-reader-text"><span>input type="radio"</span></legend>';
							foreach ($field['options'] as $key => $value) {
								echo '<label title="g:i a" for="'.$field['id'].'-radio-'.$poll_postid.'-'.$key.'">
											<input id="'.$field['id'].'-radio-'.$poll_postid.'-'.$key.'" type="radio" name="'.$field['id'].'" value="'.$key.'" '.(($meta == $key) ? '  checked="checked" ' : '').'  />
											<span>'.$value.'</span>
										</label>';


							}
							echo '</fieldset>';
							echo '<br/><span class="description">'.$field['desc'].'</span>';
							break;

						case 'checkbox':
							echo '<input type="checkbox" name="'.$field['id'].'" id="'.$field['id'].'-checkbox-'.$poll_postid.'" class="cb-checkbox checkbox-'.$poll_postid.'" ', $meta ? ' checked="checked"' : '', '/>
						<span for="'.$field['id'].'">'.$field['desc'].'</span>';
							break;
						case 'checkbox_group':
							if ($meta == '') {
								$meta = array();
								foreach ($field['options'] as $option) {
									array_push($meta, $option['value']);
								}
							}

							foreach ($field['options'] as $option) {
								echo '<input type="checkbox" value="'.$option['value'].'" name="'.$field['id'].'[]" id="'.$option['value'].'-mult-chk-'.$poll_postid.'-field-'.$field['id'].'" class="cb-multi-check mult-check-'.$poll_postid.'"', $meta && in_array($option['value'],
									$meta) ? ' checked="checked"' : '', ' />
							<label for="'.$option['value'].'">'.$option['label'].'</label><br/>';
							}

							echo '<span class="description">'.$field['desc'].'</span>';
							break;

					}
					echo '</td>';
					echo '</tr>';
				}
				echo '</table>';

			else:
				echo esc_html__('Please save the post once to enter poll answers.', 'wbpoll');
			endif;

		}//end method metabox_setting_display

		
		/**
		 * Save wbpoll metabox
		 *
		 * @param $post_id
		 *
		 * @return bool
		 */
		function metabox_save($post_id)
		{
			// Check if our nonce is set.
			if (!isset($_POST['wbpoll_meta_box_nonce'])) {
				return;
			}

			// Verify that the nonce is valid.
			if (!wp_verify_nonce($_POST['wbpoll_meta_box_nonce'], 'wbpoll_meta_box')) {
				return;
			}

			if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
				return;
			}


			// Check the user's permissions.
			if (isset($_POST['post_type']) && 'wbpoll' == $_POST['post_type']) {

				if (!current_user_can('edit_post', $post_id)) {
					return;
				}
			}


			global $post;
			$post   = get_post($post_id);
			$status = $post->post_status;

			$prefix = '_wbpoll_';

			//handle answer colors
			if (isset($_POST[$prefix.'answer_color'])) {

				$colors = $_POST[$prefix.'answer_color'];
				foreach ($colors as $index => $color) {
					$colors[$index] = WBPollHelper::sanitize_hex_color($color);
				}

				$unique_color = array_unique($colors);

				if ((count($unique_color)) == (count($colors))) {
					update_post_meta($post_id, $prefix.'answer_color', $colors);
				} else {
					$error = '<div class="error"><p>'.esc_html__('Error: Answer Color repeat error',
							'wbpoll').'</p></div>';

					return false;
				}
			} else {
				delete_post_meta($post_id, $prefix.'answer_color');
			}

			//handling extra fields
			if (isset($_POST[$prefix.'answer_extra'])) {
				$extra = $_POST[$prefix.'answer_extra'];
				update_post_meta($post_id, $prefix.'answer_extra', $extra);

			} else {
				delete_post_meta($post_id, $prefix.'answer_extra');
			}

			//handle answer titles
			if (isset($_POST[$prefix.'answer'])) {
				$titles = $_POST[$prefix.'answer'];

				foreach ($titles as $index => $title) {
					$titles[$index] = sanitize_text_field($title);
				}

				update_post_meta($post_id, $prefix.'answer', $titles);
				
			} else {
				delete_post_meta($post_id, $prefix.'answer');
			}

			//Full size image answer
			if (isset($_POST[$prefix.'full_size_image_answer'])) {
				$images = $_POST[$prefix.'full_size_image_answer'];

				foreach ($images as $index => $url) {
					$images[$index] = sanitize_text_field($url);
				}

				update_post_meta($post_id, $prefix.'full_size_image_answer', $images);
				
			} else {
				delete_post_meta($post_id, $prefix.'full_size_image_answer');
			}


			//thumbnail size image answer
			if (isset($_POST[$prefix.'full_thumbnail_image_answer'])) {
				$images = $_POST[$prefix.'full_thumbnail_image_answer'];

				foreach ($images as $index => $url) {
					$images[$index] = sanitize_text_field($url);
				}

				update_post_meta($post_id, $prefix.'full_thumbnail_image_answer', $images);
				
			} else {
				delete_post_meta($post_id, $prefix.'full_thumbnail_image_answer');
			}

			//video url
			if (isset($_POST[$prefix.'video_answer_url'])) {
				$images = $_POST[$prefix.'video_answer_url'];

				foreach ($images as $index => $url) {
					$images[$index] = sanitize_text_field($url);
				}

				update_post_meta($post_id, $prefix.'video_answer_url', $images);
				
			} else {
				delete_post_meta($post_id, $prefix.'video_answer_url');
			}

			//Video thumbnail size image answer
			if (isset($_POST[$prefix.'video_thumbnail_image_url'])) {
				$images = $_POST[$prefix.'video_thumbnail_image_url'];

				foreach ($images as $index => $url) {
					$images[$index] = sanitize_text_field($url);
				}

				update_post_meta($post_id, $prefix.'video_thumbnail_image_url', $images);
				
			} else {
				delete_post_meta($post_id, $prefix.'video_thumbnail_image_url');
			}

			//Audio url
			if (isset($_POST[$prefix.'audio_answer_url'])) {
				$images = $_POST[$prefix.'audio_answer_url'];

				foreach ($images as $index => $url) {
					$images[$index] = sanitize_text_field($url);
				}

				update_post_meta($post_id, $prefix.'audio_answer_url', $images);
				
			} else {
				delete_post_meta($post_id, $prefix.'audio_answer_url');
			}

			//Audio thumbnail size image answer
			if (isset($_POST[$prefix.'audio_thumbnail_image_url'])) {
				$images = $_POST[$prefix.'audio_thumbnail_image_url'];

				foreach ($images as $index => $url) {
					$images[$index] = sanitize_text_field($url);
				}

				update_post_meta($post_id, $prefix.'audio_thumbnail_image_url', $images);
				
			} else {
				delete_post_meta($post_id, $prefix.'audio_thumbnail_image_url');
			}

			//HTML textarea answer
			if (isset($_POST[$prefix.'html_answer'])) {
				$images = $_POST[$prefix.'html_answer'];

				foreach ($images as $index => $url) {
					$images[$index] = sanitize_text_field($url);
				}

				update_post_meta($post_id, $prefix.'html_answer', $images);
				
			} else {
				delete_post_meta($post_id, $prefix.'html_answer');
			}

			$this->metabox_extra_save($post_id);
		}//end method metabox_save

		/**
		 * Save wbpoll meta fields except poll color and titles
		 *
		 * @param $post_id
		 *
		 * @return bool|void
		 */
		function metabox_extra_save($post_id)
		{
			//global $post_meta_fields;
			$post_meta_fields = WBPollHelper::get_meta_fields();

			$prefix = '_wbpoll_';


			$cb_date_array = array();
			foreach ($post_meta_fields as $field) {

				$old = get_post_meta($post_id, $field['id'], true);
				$new = $_POST[$field['id']];

				if (($prefix.'start_date' == $field['id'] && $new == '') || ($prefix.'end_date' == $field['id'] && $new == '')) {

					$cbpollerror = '<div class="notice notice-error inline"><p>'.esc_html__('Error:: Start or End date any one empty',
							'wbpoll').'</p></div>';


					return false; //might stop processing here
				} else {


					update_post_meta($post_id, $field['id'], $new);

				}
			}
		}//end method metabox_extra_save

		 /**
		 * Get Text answer templte
		 */
		public function wbpoll_get_answer_template()
		{

			//security check
			check_ajax_referer('wbpoll', 'security');

			//get the fields

			$index        = intval($_POST['answer_counter']);
			$answer_color = esc_attr($_POST['answer_color']);
			$is_voted     = intval($_POST['is_voted']);
			$poll_postid  = intval($_POST['poll_postid']);
			$answer_type  = esc_attr($_POST['answer_type']);

			$answers_extra = array('type' => $answer_type);

			$poll_answer = sprintf(esc_html__('Answer %d', 'wbpoll'), ($index + 1));

			$template = WBPollHelper::wbpoll_answer_field_template($index, $poll_answer, $answer_color, $is_voted,
				$answers_extra, $poll_postid);

			echo json_encode($template);
			die();
		}//end method wbpoll_get_answer_template

		 /**
		 *  Add Text type poll result display method
		 *
		 * @param  array  $methods
		 *
		 * @return array
		 */
		public function poll_display_methods_text($methods)
		{
			$methods['text'] = array(
				'title'  => esc_html__('Text', 'wbpoll'),
				'method' => array($this, 'poll_display_methods_text_result')
			);

			return $methods;
		}//end method poll_display_methods_text

		/**
		 * Display poll result as text method
		 *
		 * @param  int  $poll_id
		 * @param  string  $reference
		 *
		 * @param  string  $poll_result
		 */
		public function poll_display_methods_text_result($poll_id, $reference = 'shortcode', $poll_result)
		{

			$total  = intval($poll_result['total']);
			$colors = $poll_result['colors'];

			$answers = isset($poll_result['answer']) ? $poll_result['answer'] : array();


			$output_result = '';

			if ($total > 0) {
				$output = '<p>'.sprintf(__('Total votes: %d', 'wbpoll'), number_format_i18n($total)).'</p>';
				$output .= '<ul>';


				$total_percent = 0;

				foreach ($poll_result['weighted_index'] as $index => $vote_count) {
					$answer_title = isset($answers[$index]) ? esc_html($answers[$index]) : esc_html__('Unknown Answer',
						'cbxpoll');
					$color_style  = isset($colors[$index]) ? 'color:'.$colors[$index].';' : '';

					$percent       = ($vote_count * 100) / $total;
					$total_percent += $percent;
					$output_result .= '<li style="'.$color_style.'"><strong>'.$answer_title.': '.$vote_count.' ('.number_format_i18n($percent,
							2).'%)</strong></li>';

				}


				if ($total_percent > 0) {
					$output_result = '';

					foreach ($poll_result['weighted_index'] as $index => $vote_count) {
						$answer_title = isset($answers[$index]) ? esc_html($answers[$index]) : esc_html__('Unknown Answer',
							'cbxpoll');
						$color_style  = isset($colors[$index]) ? 'color:'.$colors[$index].';' : '';

						$percent    = ($vote_count * 100) / $total;
						$re_percent = ($percent * 100) / $total_percent;

						$output_result .= '<li style="'.$color_style.'"><strong>'.$answer_title.': '.$vote_count.' ('.number_format_i18n($re_percent,
								2).'%)</strong></li>';

					}
				}

				$output .= $output_result;
				$output .= '</ul>';
			} else {
				$output = '<p>'.esc_html__('No approved vote yet', 'cbxpoll').'</p>';
			}

			echo $output;
		}//end method poll_display_methods_text_result
			

	}


}
