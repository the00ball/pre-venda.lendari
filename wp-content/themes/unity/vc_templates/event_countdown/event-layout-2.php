<?php 
 	global $post;
	$start = strtotime($post->EventStartDate);
	$end = strtotime($post->EventEndDate);
	$day = date('d', $start);
	$month = date('M', $start);		
?>

<article <?php echo trim( $post->class ); ?>>
	<div class="event-header-inner layout-2">
		<div class="event-header-inner">
			<div class="event-thumbnail">
				<?php the_post_thumbnail(); ?>
			</div>
			<div class="event-header clearfix">
				<div class="event-title">
					<div class="event-date">
						<i class="fa fa-clock-o"></i><?php echo tribe_get_start_date( $post->ID, false, 'H:i m/d/Y' ); ?>
					</div>
					<?php do_action( 'tribe_events_before_the_event_title' ); ?>
						<h4 class="tribe-events-list-event-title entry-title summary">
							<a class="url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title() ?>" rel="bookmark">
								<?php the_title(); ?>
							</a>
						</h4>
					<?php do_action( 'tribe_events_after_the_event_title' ); ?>
				</div>
			</div>
		</div>	
		
		<div class="event-time">
			<div class="heading-time"><?php _e('Time left', 'unity'); ?></div>
			<div class="time">
	            <div class="pts-countdown clearfix" data-countdown="countdown"
	                 data-date="<?php echo  tribe_get_start_date( $post->ID, false, 'Y-m-d-H-i-s' ); ?>">
	            </div>
	        </div>
		</div>
	</div>
</article>