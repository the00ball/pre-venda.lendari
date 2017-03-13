<?php 
 	global $post;
	$start = strtotime($post->EventStartDate);
	$end = strtotime($post->EventEndDate);
	$day = date('d', $start);
	$month = date('M', $start);		
?>

<article <?php echo trim( $post->class ); ?>>
	<div class="layout-1">
		<div class="event-header-inner">
			<div class="event-header-inner">
				<div class="event-header clearfix">
					<div class="date">
						<p class="day"><?php echo $day  ?></p>
						<p class="month"><?php echo $month  ?></p>
					</div>
					<div class="event-cost">
						<i class="fa fa-ticket"></i>
						<?php 
							if(tribe_get_cost(get_the_ID()) > 0){ 
								echo tribe_get_formatted_cost(get_the_ID());
							}else{ 
								echo __('FREE', 'unity'); 
							}
						?>
					</div>
					<div class="event-title">
						<?php do_action( 'tribe_events_before_the_event_title' ); ?>
							<h4 class="tribe-events-list-event-title entry-title summary">
								<a class="url" href="<?php echo esc_url( tribe_get_event_link() ); ?>" title="<?php the_title() ?>" rel="bookmark">
									<?php the_title(); ?>
								</a>
							</h4>
						<?php do_action( 'tribe_events_after_the_event_title' ); ?>
						<?php echo tribe_address_exists() ? '<address class="tribe-events-address"><i class="fa fa-map-marker"></i>' . tribe_get_full_address() . '</address>' : ''; ?>
					</div>
				</div>
			</div>	
		</div>	
		<div class="event-time">
			<div class="time">
	            <div class="pts-countdown clearfix" data-countdown="countdown"
	                 data-date="<?php echo  tribe_get_start_date( $post->ID, false, 'Y-m-d-H-i-s' ); ?>">
	            </div>
	        </div>
		</div>
	</div>	
</article>

