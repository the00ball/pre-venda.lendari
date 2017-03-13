<?php
/**
 * List View Single Event
 * This file contains one event in the list view
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/single-event.php
 *
 * @package TribeEventsCalendar
 * @since  3.0
 * @author Modern Tribe Inc.
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); }

global $post;

$featured_image = tribe_event_featured_image( null, '' );
?>
<div class="wpo-event-inner style-2">
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
						<div class="event-body">
							<div class="event-date left-1">
								<p class="day"><?php echo esc_html( $day ); ?></p>
								<p class="month"><?php echo esc_html( $month ); ?></p>
							</div>
							<div class="left">
								<div class="event-title">
									<?php do_action( 'tribe_events_before_the_event_title' ); ?>
									<h4 class="tribe-events-list-event-title entry-title summary">
										<a class="url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title() ?>" rel="bookmark">
											<?php the_title(); ?>
										</a>
									</h4>
									<?php do_action( 'tribe_events_after_the_event_title' ); ?>
								</div>

								<?php echo tribe_address_exists() ? '<address class="tribe-events-address"><i class="fa fa-map-marker"></i>' . tribe_get_full_address() . '</address>' : ''; ?>
								<div class="updated published time-details">
									<i class="fa fa-calendar"></i><?php echo tribe_events_event_schedule_details() ?>
								</div>
							</div>
							<div class="right">
								<div class="event-cost">
									<i class="fa fa-ticket"></i>
									<?php 
										if(tribe_get_cost(get_the_ID()) > 0){ 
											echo tribe_get_cost(get_the_ID());
											echo '$';
										}else{ 
											echo 'FREE'; 
										}
									?>
								</div>
							</div>

						</div>	
					</div>
					
				</div><!-- .tribe-events-event-meta -->
			<?php do_action( 'tribe_events_after_the_meta' ); ?>
		</div>

	</div>

	<div class="tribe-events-event-details tribe-clearfix <?php if(empty($featured_image)) echo 'no-image' ?>">
		<!-- Event Content -->
		<?php do_action( 'tribe_events_before_the_content' ); ?>
		<div class="tribe-events-list-photo-description tribe-events-content entry-summary description hidden">
			<?php the_excerpt(); ?>
		</div>
		<?php do_action( 'tribe_events_after_the_content' ) ?>

	</div><!-- /.tribe-events-event-details -->
</div>	
