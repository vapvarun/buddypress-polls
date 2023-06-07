<?php
/**
 * The poll dashboard page.
 *
 * @link       http://www.wbcomdesigns.com
 * @since      1.0.0
 *
 * @package    Buddypress_Polls
 * @subpackage Buddypress_Polls/public
 */

?>

<div class="main-dashboard">
<?php if (is_user_logged_in()) { ?>
	<div class="deshboard-top">
		<div class="main-title">
			<h3><?php esc_html_e( 'Poll Listing', 'buddypress-polls' ); ?></h3>
		</div>
		<div class="add-poll-button">
			<a class="button btn" href="<?php echo esc_url( site_url() ) . '/create-poll/'; ?>"><?php esc_html_e( 'Create new poll', 'buddypress-polls' ); ?></a>
		</div>
	</div>
	<div class="poll-listing">
		<table class="poll-listing-table">
			<thead>
				<tr>
					<th class="poll-title"><?php esc_html_e( 'Title', 'buddypress-polls' ); ?></th>
					<th class="poll-status"><?php esc_html_e( 'Status', 'buddypress-polls' ); ?></th>
					<th class="poll-vote"><?php esc_html_e( 'Vote', 'buddypress-polls' ); ?></th>
					<th class="poll-action"><?php esc_html_e( 'Action', 'buddypress-polls' ); ?></th>
				</tr>
			</thead>
			<?php
			$userid = get_current_user_id();
			$url    = site_url() . '/wp-json/wbpoll/v1/listpoll/user/id?id=' . $userid;
			$curl   = curl_init();
			curl_setopt_array(
				$curl,
				array(
					CURLOPT_URL            => $url,
					CURLOPT_RETURNTRANSFER => true,
					CURLOPT_CUSTOMREQUEST  => 'POST',
				)
			);
			$response = curl_exec( $curl );

			curl_close( $curl );

			// Parse the JSON response
			$data = json_decode( $response );
				if(isset($data->code) && $data->code == '404'){?>

					<tr>
						<td colspan="4">
							<?php echo esc_html_e( 'Polls Not Found', 'buddypress-polls' ); ?>
						</td>
					</tr>
					<?php
				}else{ 

					foreach ( $data as $post ) {
					
						// Access post information.
						$post_id     = $post->id;
						$post_title  = $post->title;
						$post_stauts = $post->status;
						$totalvote   = $post->totalvote;
						$pause       = $post->pausetype;
						?>
						<tr>
							<td class="poll-title" data-title="<?php esc_attr_e( 'Title', 'buddypress-polls' ); ?>"><?php echo esc_html( $post_title ); ?></td>
							<td class="poll-status" data-title="<?php esc_attr_e( 'Status', 'buddypress-polls' ); ?>"><?php echo esc_html( $post_stauts ); ?></td>
							<td class="poll-vote" data-title="<?php esc_attr_e( 'Vote', 'buddypress-polls' ); ?>"><?php echo esc_html( $totalvote ); ?></td>
							<td class="poll-action" data-title="<?php esc_attr_e( 'Action', 'buddypress-polls' ); ?>"><a class="button btn" href="<?php echo esc_url( site_url() ) . '/wbpoll/' . esc_html( str_replace( ' ', '-', $post_title ) ); ?>" data-polls-tooltip="<?php esc_attr_e( 'View', 'buddypress-polls' ); ?>"><i class="wb-icons wb-icon-eye-small"></i></a>
							<button class="button btn pause_poll" data-value="
							<?php
							if ( ! empty( $pause ) && $pause == 1 ) {
								echo 0;
							} else {
								echo 1; }
							?>
							" data-id="<?php echo esc_html( $post_id ); ?>"
							<?php
							if ( ! empty( $pause ) && $pause == 1 ) {
								?>
								data-polls-tooltip="<?php esc_attr_e( 'Resume', 'buddypress-polls' ); ?>"
								<?php
							} else {
								?>
								data-polls-tooltip="<?php esc_attr_e( 'Pause', 'buddypress-polls' ); ?>"
								<?php
							}
							?>
							>
							<?php
							if ( ! empty( $pause ) && $pause == 1 ) {
								?>
								<i class="wb-icons wb-icon-play-circle"></i>
								<?php
							} else {
								?>
								<i class="wb-icons wb-icon-pause-circle"></i>
								<?php
							}
							?>
							</button>
							<button class="button btn delete_poll" data-id="<?php echo esc_html( $post_id ); ?>" data-polls-tooltip="<?php esc_attr_e( 'Delete', 'buddypress-polls' ); ?>"><i class="wb-icons wb-icon-trash"></i></button></td>
						</tr>
	
						<?php
					}
					wp_reset_postdata();
				 }
				
			?>
		</table>
	</div>
	<?php }else{ ?>
		<div class="wbpoll_wrapper wbpoll_wrapper-1324 wbpoll_wrapper-content_hook" data-reference="content_hook"><p class="wbpoll-voted-info wbpoll-alert"> <?php esc_html_e( 'This page content only for login members.', 'buddypress-polls' ); ?> </p></div>
	<?php } ?>
</div>
