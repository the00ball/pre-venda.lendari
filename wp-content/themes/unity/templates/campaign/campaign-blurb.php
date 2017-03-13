<?php global $campaign; $uid = wpo_makeid();?>

<?php if ( $campaign === false ) return ?>

<?php 
	$color = "#FED857";
	switch (wpo_theme_options('skin', 'default')) {
		case 'blue':
			$color = "#41A4DC";
			break;
		case 'brown':
			$color = "#887161";
			break;
		default:
			$color = "#FED857";
			break;
	}
?>

<!-- Active campaign -->
<section class="active-campaign current-campaign cf <?php if ( !$campaign->is_active() ) : ?>ended<?php endif ?>">

	<div class="shadow-wrapper">
	<div class="row">
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
				<div class="thumbnail">
				<?php the_post_thumbnail('thumbnails-crowdfunding'); ?>
				<?php if ( $campaign->is_funded() ) : ?>
					<span class="campaign-successful"><?php _e( 'Successful', 'unity' ) ?></span>
				<?php elseif ( ! $campaign->is_active() && ! $campaign->is_funded() ) : ?>
					<span class="campaign-unsuccessful"><?php _e( 'Unsuccessful', 'unity' ) ?></span>
				<?php endif ?>
				</div>
				<div class="title-wrapper">
					<h2 class="block-title"><?php the_title() ?></h2>
				</div>
			</div>

			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 xs-text-center">
				<div class="campaign-summary cf">

					<div class="barometer-main">
						<div class="barometer" data-progress="<?php echo esc_attr( $campaign->percent_completed(false) ); ?>" data-width="148" data-height="148" data-strokewidth="11" data-stroke="#DEDEDE" data-progress-stroke="<?php echo esc_attr( $color ); ?>">
							<span><?php printf( _x( "%s", 'x percent funded','unity' ), '<span class="funded">'.$campaign->percent_completed(false).'<sup>%</sup></span>' ) ?></span>
						</div>
						<div class="campaign-time-left text-center"><span class="title"><?php _e('Expired on', 'unity') ?><br/><?php echo trim( $campaign->days_remaining() ); ?></span><span><?php _e(' days left', 'unity'); ?></span></div>
					</div>

					<div class="text-barometer">
						<ul>
							<!--li class="campaign-raised">
								<p class="label"><?php _e( 'Current','unity' ) ?></p>
								<p class="text"><?php echo esc_html( $campaign->current_amount() ) ?></p>
							</li-->
							<li class="campaign-goal">
								<p class="label"><?php _e( 'Target','unity' ) ?></p>
								<p class="text"><?php echo esc_html( $campaign->date_goal() ) ?></p>
							</li>
							<li class="campaign-backers">
								<p class="label"><?php _e( 'Backers','unity' ) ?></p>
								<p class="text"><?php echo esc_html( $campaign->backers_count() ) ?></p>
							</li>
						</ul>
						<div class="social">

						</div>
					</div>
				</div>

				<div class="quick-donate">
					<a class="btn btn-donate-black" data-toggle="modal" data-target="#campaign-quick-donate-<?php echo esc_attr(get_the_ID() . "-$uid") ?>"><?php _e('Donate now', 'unity'); ?></a>
				</div>

			</div>

		</div>
	</div>

	<div class="modal fade campaign-item-modal" id="campaign-quick-donate-<?php echo esc_attr(get_the_ID() . "-$uid") ?>" tabindex="-1" role="dialog" aria-labelledby="campaign-quick-donate-<?php echo esc_attr(get_the_ID() . "-$uid") ?>">
		<div class="modal-dialog">
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
		        	<h4 class="modal-title"><?php the_title(); ?></h4>
		      	</div>
		      	<div class="modal-body">
		      		<div class="campaign-content">
						<div class="barometer" data-progress="<?php echo esc_attr( $campaign->percent_completed(false) ); ?>" data-width="148" data-height="148" data-strokewidth="11" data-stroke="#DEDEDE" data-progress-stroke="#F6B21F">
							<span><?php printf( _x( "%s", 'x percent funded','unity' ), '<span class="funded">'.esc_html( $campaign->percent_completed(false) ).'<sup>%</sup></span>' ) ?></span>
						</div>

						<ul class="campaign-status text-center">

							<!--li class="campaign-raised">
								<p class="label"><?php _e( 'Current','unity' ) ?></p>
								<p class="text"><?php echo esc_html( $campaign->current_amount() ); ?></p>
							</li-->
							<li class="campaign-goal">
								<p class="label"><?php _e( 'Target','unity' ) ?></p>
								<p class="text"><?php echo esc_html( $campaign->date_goal() ); ?></p>
							</li>
							<li class="campaign-backers">
								<p class="label"><?php _e( 'Backers','unity' ) ?></p>
								<p class="text"><?php echo esc_html( $campaign->backers_count() ); ?></p>
							</li>
						</ul>
					</div>
					<div class="clearfix"></div>
					<div class="desciption">
						<?php echo wpo_excerpt(36, '... <a class="read-more" href="' . esc_url( get_the_permalink() ). '">' . __('Read more', 'unity') . '</a>'); ?>
					</div>

					<?php if( $campaign->is_active() ) : ?>
				        <div id="campaign-form-<?php echo esc_attr(get_the_ID() . "-$uid") ?>" class="campaign-form reveal-modal content-block block">
					        <?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID() ) ); ?>
					    </div>
					<?php endif; ?>
		      	</div>
		    </div>
		</div>
	</div>

</section>
<!-- End active campaign -->
