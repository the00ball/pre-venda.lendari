<?php
/**
 * List View Loop
 * This file sets up the structure for the list loop
 *
 * Override this template in your own theme by creating a file at [your-theme]/tribe-events/list/loop.php
 *
 * @package TribeEventsCalendar
 * @since  3.0
 * @author Modern Tribe Inc.
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); } ?>

<?php
	$GLOBALS['more'] = false;

	$GLOBALS['wpv_pretty_tribe_date_headers'] = true;
	$GLOBALS['wpv_pretty_tribe_date_headers_first'] = true;

	$column = wpo_theme_options('event-archive-column', 2);
	$class = "col-lg-4 col-md-4 col-sm-12 col-xs-12";
	switch ($column) {
		case '2':
			$class = "col-lg-6 col-md-6 col-sm-6 col-xs-12";
			break;
		case '3':
			$class = "col-lg-4 col-md-4 col-sm-12 col-xs-12";
			break;
		case '4':
			$class = "col-lg-3 col-md-3 col-sm-6 col-xs-12";
			break;
		case '6':
			$class = "col-lg-2 col-md-2 col-sm-6 col-xs-12";
			break;		
		default:
			$class = "col-lg-4 col-md-4 col-sm-12 col-xs-12";
			break;
	}
?>

<div class="tribe-events-loop hfeed vcalendar clearfix">
	<div class="row">
		<?php while ( have_posts() ) : the_post(); ?>
			<?php do_action( 'tribe_events_inside_before_loop' ); ?>

			
			<?php tribe_events_list_the_date_headers(); ?>
			
			<!-- Event  -->
			<article id="post-<?php the_ID() ?>" class="<?php tribe_events_event_classes() ?> <?php echo esc_attr( $class ); ?>">
				<?php tribe_get_template_part( 'list/single', 'event-2' ) ?>
			</article><!-- .hentry .vevent -->


			<?php do_action( 'tribe_events_inside_after_loop' ); ?>
			<?php $GLOBALS['wpv_pretty_tribe_date_headers_first'] = false; ?>
		<?php endwhile; ?>

	</div>	

</div><!-- .tribe-events-loop -->
