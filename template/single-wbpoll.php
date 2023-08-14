<?php
/**
 * WBPoll Single page
 *
 * @package WordPress
 * @subpackage buddypress-polls
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header(); /*Header Portion*/

/**
 * Hook: buddypress_polls_before_main_content. *
 */
do_action( 'buddypress_polls_before_main_content' );

?>

<div id="primary" class="content-area">

	<main id="main" class="site-main buddypress-polls-wrap" role="main">
	
		<?php do_action( 'before_single_buddypress_polls' ); ?>
		
		<div id="buddypress-polls" class="buddypress-poll-single" >
			
			<?php
			while ( have_posts() ) :
				the_post(); ?>
				<header class="entry-header">
					<?php the_title('<h1 class="entry-title">', '</h1>' ); ?>
				</header><!-- .entry-header -->
				<div class="entry-content">
					<?php
					the_content();
					
					$post_id  = intval( get_the_ID() );
					echo WBPollHelper::wbpoll_single_display( $post_id, 'content_hook', '', '', 0 );
					?>
				</div>
			<?php endwhile; ?>
			
		</div>
		
		<?php do_action( 'after_single_buddypress_polls' ); ?>
		
	</main> <!-- Main tag finish -->
	
</div>
<?php if ( is_active_sidebar( 'buddypress-poll-right' ) ) : ?>
	<aside id="primary-sidebar" class="widget-area default" role="complementary">
		<div class="widget-area-inner-left">
			<?php dynamic_sidebar( 'buddypress-poll-right' ); ?>
		</div>
	</aside>

<?php
endif;

/**
 * Hook: bp_business_profile_after_main_content.
 */
do_action( 'buddypress_polls_after_main_content' );


get_footer();
