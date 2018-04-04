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
		if($hook != 'toplevel_page_buddypress_polls') {
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/buddypress-polls-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts($hook) {
		if($hook != 'toplevel_page_buddypress_polls') {
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/buddypress-polls-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register admin menu for plugin.
	 *
	 * @since    1.0.0
	 */
	public function bpolls_add_menu_buddypress_polls() {
		add_menu_page( __( 'Buddypress Polls Settings Page', 'buddypress-polls' ), __( 'BuddyPress Polls', 'buddypress-polls' ), 'manage_options', 'buddypress_polls', array( $this, 'bpolls_buddypress_polls_settings_page' ), 'dashicons-chart-bar', 60 );
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
			<h1> <?php esc_html_e( 'BuddyPress Polls Settings', 'buddypress-polls' ); ?></h1>
		</div>
		<?php
		$bpolls_tabs = array(
			'general'        => __( 'General', 'buddypress-polls' ),
			'support'        => __( 'Support', 'buddypress-polls' ),
		);

    	$tab_html = '<h2 class="nav-tab-wrapper">';
		foreach ( $bpolls_tabs as $bpolls_tab => $bpolls_name ) {
			$class     = ( $bpolls_tab == $current ) ? 'active' : '';
			$tab_html .= '<a class="nav-tab ' . $class . '" href="admin.php?page=buddypress_polls&tab=' . $bpolls_tab . '">' . $bpolls_name . '</a>';
		}
		$tab_html .= '</h2>';
		echo $tab_html;
		include 'inc/bpolls-tabs-options.php';
	}

	/**
	 * Function to register admin settings.
	 *
	 * @since    1.0.0
	 */
	public function bpolls_admin_register_settings() {
	  	if(isset($_POST['bpolls_settings'])){
	  		update_site_option('bpolls_settings',$_POST['bpolls_settings']);
	  		wp_redirect($_POST['_wp_http_referer']);
			exit();
	  	}
	}
}
