<?php
/**
 * Single Event Template
 * A single event. This displays the event title, description, meta, and
 * optionally, the Google map for the event.
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/single-event.php
 *
 * @package TribeEventsCalendar
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

$events_label_singular = tribe_get_event_label_singular();
$events_label_plural = tribe_get_event_label_plural();

$event_id = get_the_ID();

?>

<?php while ( have_posts() ) :  the_post(); ?>
<div class="clearfix">
	<div class="row">
		<div class="col-xs-8">
			<div id="tribe-events-content" class="tribe-events-single">

				<!-- Notices -->
				<?php tribe_the_notices() ?>

				<!-- Event content -->
				<?php do_action( 'tribe_events_single_event_before_the_content' ) ?>
				<div class="tribe-events-single-event-description tribe-events-content entry-content description">
					<div class="image-event">
					<?php echo tribe_event_featured_image( $event_id, 'full', false ); ?>
					</div>
					<div class="clearfix"></div>
					<?php the_content(); ?>
				</div><!-- .tribe-events-single-event-description -->
				<?php do_action( 'tribe_events_single_event_after_the_content' ) ?>

				<?php if ( get_post_type() == Tribe__Events__Main::POSTTYPE && tribe_get_option( 'showComments', false ) ) comments_template() ?>

			</div><!-- #tribe-events-content -->
		</div>	

		<div class="wpo-tribe-events-meta col-xs-4">
			<?php do_action( 'tribe_events_single_event_before_the_meta' ) ?>
				<?php
			/**
			 * The tribe_events_single_event_meta() function has been deprecated and has been
			 * left in place only to help customers with existing meta factory customizations
			 * to transition: if you are one of those users, please review the new meta templates
			 * and make the switch!
			 */
			if ( ! apply_filters( 'tribe_events_single_event_meta_legacy_mode', false ) ) {
				tribe_get_template_part( 'modules/meta' );
			} else {
				echo tribe_events_single_event_meta();
			}
			?>
			<?php do_action( 'tribe_events_single_event_after_the_meta' ) ?>
		</div>
	</div>	
</div>
<?php endwhile; ?>
