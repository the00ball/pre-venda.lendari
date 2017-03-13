<?php
/**
 * Month View Single Day
 * This file contains one day in the month grid
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/month/single-day.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural = tribe_get_event_label_plural();

$day = tribe_events_get_current_month_day();
?>



<!-- Events List -->
<div class="tribe-month-single-day">
	<div class="tribe-month-daynumber" id="tribe-events-daynum-<?php echo trim( $day['daynum'] ) ?>">
		<?php if ( $day['unity'] > 0 && tribe_events_is_view_enabled( 'day' ) ) { ?>
			<a href="<?php echo esc_url( tribe_get_day_link( $day['date'] ) ); ?>"><?php echo trim( $day['daynum'] ); ?></a>
		<?php } else { ?>
			<a> <?php echo trim( $day['daynum'] ); ?></a>
		<?php } ?>
	</div>

	<?php if($day['events']->have_posts()) :  ?>
		<div class="tribe-month-sigle-day-list">
			<?php while ( $day['events']->have_posts() ) : $day['events']->the_post(); ?>
				<?php tribe_get_template_part( 'month/single', 'event' ) ?>
			<?php endwhile; ?>
		</div>
	<?php endif; ?>

	<!-- View More -->
<?php if ( $day['view_more'] ) : ?>
		<div class="tribe-events-viewmore">
			<?php

			$view_all_label = sprintf( _n( 'View 1 %1$s', 'View All %2$s %3$s', $day['unity'], 'unity' ), $events_label_singular, $day['unity'], $events_label_plural );

			?>
			<a href="<?php echo esc_url( $day['view_more'] ); ?>"><?php echo trim( $view_all_label ); ?> &raquo;</a>
		</div>
<?php
endif;
