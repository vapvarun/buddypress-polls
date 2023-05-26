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
	<div class="deshboard-top">
		<div class="main-title">
			<h3><?php esc_html_e( 'Poll Listing', 'buddypress-polls' ); ?></h3>
		</div>
		<div class="add-poll-button">
			<a class="button btn" href="<?php echo esc_url(site_url()).'/create-poll/'; ?>"><?php esc_html_e( 'Create new poll', 'buddypress-polls' ); ?></a>
		</div>
	</div>
	<div class="poll-listing">
		<table class="poll-listing-table">
			<thead>
				<tr>
					<th class="poll-title"><?php esc_html_e( 'Title', 'buddypress-polls' ); ?></th>
					<th class="poll-status"><?php esc_html_e( 'Status', 'buddypress-polls' ); ?></th>
					<th class="poll-start-date"><?php esc_html_e( 'Start date', 'buddypress-polls' ); ?></th>
					<th class="poll-end-date"><?php esc_html_e( 'End date', 'buddypress-polls' ); ?></th>
					<th class="poll-vote"><?php esc_html_e( 'Vote', 'buddypress-polls' ); ?></th>
					<th class="poll-action"><?php esc_html_e( 'Action', 'buddypress-polls' ); ?></th>
				</tr>
			</thead>
			<?php
			$userid = get_current_user_id();
			$url = site_url().'/wp-json/wbpoll/v1/listpoll/user/id?id='.$userid;
			$curl = curl_init();
			curl_setopt_array($curl, array(
			CURLOPT_URL => $url,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_CUSTOMREQUEST => 'POST',			
			));
			$response = curl_exec($curl);

			curl_close($curl);
			
			// Parse the JSON response
			$data = json_decode($response);
			if(!empty($data)){
				foreach ( $data as $post ) {
					// Access post information.
					$post_id     = $post->id;
					$post_title  = $post->title;
					$post_stauts = $post->status;
					$start_date  = $post->start_time; // poll start date
					$end_date    = $post->end_date; // poll end date
					$totalvote   = $post->totalvote;
					$pause = $post->pausetype;
					?>
					<tr>
						<td class="poll-title" data-title="<?php esc_attr_e( 'Title', 'buddypress-polls' ); ?>"><?php echo esc_html( $post_title ); ?></td>
						<td class="poll-status" data-title="<?php esc_attr_e( 'Status', 'buddypress-polls' ); ?>"><?php echo esc_html( $post_stauts ); ?></td>
						<td class="poll-start-date" data-title="<?php esc_attr_e( 'Start date', 'buddypress-polls' ); ?>"><?php echo esc_html( $start_date ); ?></td>
						<td class="poll-end-date" data-title="<?php esc_attr_e( 'End date', 'buddypress-polls' ); ?>"><?php echo esc_html( $end_date ); ?></td>
						<td class="poll-vote" data-title="<?php esc_attr_e( 'Vote', 'buddypress-polls' ); ?>"><?php echo esc_html( $totalvote ); ?></td>
						<td class="poll-action" data-title="<?php esc_attr_e( 'Action', 'buddypress-polls' ); ?>"><a class="btn" href="<?php echo esc_url(site_url()).'/wbpoll/'.esc_html(str_replace(' ', '-', $post_title)); ?>"><?php esc_attr_e('View'); ?></a> <button class="btn pause_poll" data-value="<?php if(!empty($pause) && $pause == 1){ echo 0;}else{echo 1;}?>" data-id="<?php echo esc_html($post_id); ?>"><?php if(!empty($pause) && $pause == 1){ echo esc_html_e('Resume');}else{echo esc_html_e('Pause');}?></button></td>
					</tr>
	
					<?php
				}
			}else{
				echo "Polls Not Found";
			}
			?>
		</table>
	</div>
</div>
