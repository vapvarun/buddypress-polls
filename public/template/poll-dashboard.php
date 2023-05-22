<div class="main-dashboard">
    <div class="deshboard-top">
        <div class="main-title">
            <h6>Poll Listing</h6>
        </div>
        <div class="add-poll-button">
            <button>Create new poll</button>
        </div>
    </div>
    <div class="poll-listing">
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Status</th>
                    <th>Start date</th>
                    <th>End date</th>
                    <th>Vote</th>
                    <th>Action</th>
                </tr>
            </thead>
            <?php
            $userid = get_current_user_id();
            $args = array(
                'author'         => $userid,
                'posts_per_page' => -1, // Retrieve all posts by the author
                'post_status'    => 'publish',
                'post_type'      => 'wbpoll',
            );

            $posts = get_posts($args);

            foreach ($posts as $post) {
                // Access post information
                $post_id = $post->ID;
                $post_title   = $post->post_title;
                $post_stauts = $post->post_status;
                $start_date = get_post_meta( $post_id, '_wbpoll_start_date', true ); // poll start date
		        $end_date   = get_post_meta( $post_id, '_wbpoll_end_date', true ); // poll end date
                $totalvote = WBPollHelper::getVoteCount($post_id);
                // ...and so on
            ?>
                <tr>
                    <td><?php echo esc_html($post_title); ?></td>
                    <td><?php echo esc_html($post_stauts); ?></td>
                    <td><?php echo esc_html($start_date); ?></td>
                    <td><?php echo esc_html($end_date); ?></td>
                    <td><?php echo esc_html($totalvote); ?></td>
                    <td>Action</td>
                </tr>

            <?php
            }

            ?>
        </table>
    </div>
</div>