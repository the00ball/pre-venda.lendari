<?php global $campaign; ?>

<?php if ( $campaign === false ) return ?>

<!-- Active campaign -->
<section class="active-campaign current-campaign cf <?php if ( !$campaign->is_active() ) : ?>ended<?php endif ?>">

	<div class="shadow-wrapper">

		<div class="col-xs-6">
			<div class="title-wrapper">	
				<h2 class="block-title"><?php the_title() ?></h2>
			</div>			
		</div>
		<div class="col-xs-6">
			<div class="campaign-summary cf">		

				<div class="barometer" data-progress="<?php echo esc_attr( $campaign->percent_completed(false) ); ?>" data-width="148" data-height="148" data-strokewidth="11" data-stroke="#DEDEDE" data-progress-stroke="#FED857">
					<span><?php printf( _x( "%s", 'x percent funded','unity' ), '<span class="funded">'.$campaign->percent_completed(false).'<sup>%</sup></span>' ) ?></span>
				</div>		
				<div class="text-barometer">
					<ul>
						<li class="campaign-raised">
							<p class="label"><?php _e( 'Current','unity' ) ?></p>	
							<p class="text"><?php echo esc_html( $campaign->current_amount() ); ?></p>
						</li>
						<li class="campaign-goal">
							<p class="label"><?php _e( 'Target','unity' ) ?></p>
							<p class="text"><?php echo esc_html( $campaign->goal() ); ?></p>		
						</li>		
					</ul>
					<div class="campaign-backers">
						<p class="label"><?php _e( 'Backers','unity' ) ?></p>
						<p class="text"><?php echo esc_html( $campaign->backers_count() ); ?></p>
					</div>	
					<div class="social">
						
					</div>
	 			</div> 
				<?php if ( $campaign->is_active() ) : ?>

				<?php else : ?>

					<?php if ( $campaign->is_funded() ) : ?>
						<h3 class="campaign-ended"><?php printf( __( 'This campaign successfully reached its funding goal and ended %s','unity' ), '<span class="time-ago">'.esc_html( sofa_crowdfunding_get_time_since_ended($campaign, true) ).'</span>' ) ?></h3>
					<?php else : ?>
						<h3 class="campaign-ended"><?php printf( __( 'This campaign failed to reach its funding goal %s','unity' ), '<span class="time-ago">'.esc_html( sofa_crowdfunding_get_time_since_ended($campaign, true).'</span>' ) ) ?></h3>
					<?php endif ?>

				<?php endif ?>

			</div>				
		</div>	
		
	</div>	

</section>
<!-- End active campaign -->