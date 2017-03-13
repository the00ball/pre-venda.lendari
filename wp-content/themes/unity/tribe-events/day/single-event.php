<?php
/**
 * Day View Single Event
 * This file contains one event in the day view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/day/single-event.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

global $post;

$venue_details = tribe_get_venue_details();

$has_venue = ( $venue_details ) ? ' vcard' : '';

$featured_image = tribe_event_featured_image( null, '' );
?>
<div class="wpo-event-inner">
	<div class="small-event-header clearfix <?php if(empty($featured_image)) echo 'no-image' ?>">
		<?php echo trim( $featured_image ); ?>

		<div class="tribe-events-event-meta-wrapper">
			<?php do_action( 'tribe_events_before_the_meta' ); ?>
				<div class="tribe-events-event-meta">
					<?php
						$start = strtotime($post->EventStartDate);
						$end = strtotime($post->EventEndDate);
						$day = date('d', $start);
						$month = date('M', $start);

						$stime = date(get_option('time_format'), $start);
						$etime = date(get_option('time_format'), $end);
					?>
					<div class="caption">	
						
						<div class="event-heading">
							<div class="date">
								<div class="day"><?php echo esc_html( $day ); ?></div>
								<div class="month"><?php echo esc_html( $month ); ?></div>
							</div>
							
							<div class="event-title">
								<?php do_action( 'tribe_events_before_the_event_title' ); ?>
								<h4 class="tribe-events-list-event-title entry-title summary">
									<a class="url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title() ?>" rel="bookmark">
										<?php the_title(); ?>
									</a>
								</h4>
								<?php do_action( 'tribe_events_after_the_event_title' ); ?>

								<?php echo tribe_address_exists() ? '<address class="tribe-events-address">' . tribe_get_full_address() . '</address>' : ''; ?>
							</div>

						</div>	
						
					</div>
					
				</div><!-- .tribe-events-event-meta -->
			<?php do_action( 'tribe_events_after_the_meta' ); ?>
		</div>

	</div>

	<div class="tribe-events-event-details tribe-clearfix <?php if(empty($featured_image)) echo 'no-image' ?> hidden">
		<!-- Event Content -->
		<?php do_action( 'tribe_events_before_the_content' ); ?>
		<div class="tribe-events-list-photo-description tribe-events-content entry-summary description">
			<?php echo tribe_events_get_the_excerpt(); ?>
		</div>
		<?php do_action( 'tribe_events_after_the_content' ) ?>

	</div><!-- /.tribe-events-event-details -->
</div>	
