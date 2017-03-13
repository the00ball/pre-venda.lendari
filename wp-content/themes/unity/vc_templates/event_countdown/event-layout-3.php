<?php 
 	global $post;
	$start = strtotime($post->EventStartDate);
	$end = strtotime($post->EventEndDate);
	$day = date('d', $start);
	$month = date('M', $start);		
?>

<div class="col-sm-8 col-xs-12">
	<article <?php echo trim( $post->class ); ?>>
		<div class="layout-3">
			<div class="event-header-inner">
				<div class="event-header clearfix">
					<div class="event-title">
						<?php do_action( 'tribe_events_before_the_event_title' ); ?>
							<h4 class="tribe-events-list-event-title entry-title summary">
								<a class="url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title() ?>" rel="bookmark">
									<?php the_title(); ?>
								</a>
							</h4>
						<?php do_action( 'tribe_events_after_the_event_title' ); ?>
						<?php echo tribe_address_exists() ? '<address class="tribe-events-address"><i class="fa fa-clock-o"></i>&nbsp;'. tribe_get_start_date( $post->ID, false, 'H:i m/d/Y' ) .'&nbsp;&nbsp;&nbsp;<i class="fa fa-map-marker"></i>' . tribe_get_full_address() . '</address>' : ''; ?>
					</div>
				</div>	
			</div>	
		</div>	
	</article>
</div>	
<div class="action col-sm-2 col-xs-12">
	<a class="view-more btn btn-outline" href="<?php the_permalink(); ?>"><?php _e('View more', 'unity'); ?></a>
</div>