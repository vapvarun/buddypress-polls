<?php
/**
 * The poll dashboard page.
 *
 * @link       http://www.wbcomdesigns.com
 * @since      4.3.0
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
			<button class="button btn"><?php esc_html_e( 'Create new poll', 'buddypress-polls' ); ?></button>
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
			$args   = array(
				'author'         => $userid,
				'posts_per_page' => -1, // Retrieve all posts by the author
				'post_status'    => 'publish',
				'post_type'      => 'wbpoll',
			);

			$posts = get_posts( $args );

			foreach ( $posts as $post ) {
				// Access post information.
				$post_id     = $post->ID;
				$post_title  = $post->post_title;
				$post_stauts = $post->post_status;
				$start_date  = get_post_meta( $post_id, '_wbpoll_start_date', true ); // poll start date
				$end_date    = get_post_meta( $post_id, '_wbpoll_end_date', true ); // poll end date
				$totalvote   = WBPollHelper::getVoteCount( $post_id );
				// ...and so on.
				?>
				<tr>
					<td class="poll-title" data-title="<?php esc_attr_e( 'Title', 'buddypress-polls' ); ?>"><?php echo esc_html( $post_title ); ?></td>
					<td class="poll-status" data-title="<?php esc_attr_e( 'Status', 'buddypress-polls' ); ?>"><?php echo esc_html( $post_stauts ); ?></td>
					<td class="poll-start-date" data-title="<?php esc_attr_e( 'Start date', 'buddypress-polls' ); ?>"><?php echo esc_html( $start_date ); ?></td>
					<td class="poll-end-date" data-title="<?php esc_attr_e( 'End date', 'buddypress-polls' ); ?>"><?php echo esc_html( $end_date ); ?></td>
					<td class="poll-vote" data-title="<?php esc_attr_e( 'Vote', 'buddypress-polls' ); ?>"><?php echo esc_html( $totalvote ); ?></td>
					<td class="poll-action" data-title="<?php esc_attr_e( 'Action', 'buddypress-polls' ); ?>"><?php esc_html_e( 'Action', 'buddypress-polls' ); ?></td>
				</tr>

				<?php
			}

			?>
		</table>
	</div>
</div>
