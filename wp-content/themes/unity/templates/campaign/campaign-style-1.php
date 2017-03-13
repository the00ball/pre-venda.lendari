<?php
$campaign = new ATCF_Campaign( get_the_ID() );
$uid = wpo_makeid();
?>
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

<?php if ( $campaign === false ) return; ?>

	<div class="item-content item-campaign-wrapper">
		<div class="entry-thumbnail text-center">
			<?php the_post_thumbnail('thumbnails-crowdfunding'); ?>
			<div class="donate-now">
				<button type="button" class="btn btn-slide" data-toggle="modal" data-target="#campaign-donate-<?php echo esc_attr(get_the_ID() . "-$uid") ?>">
				  	<?php _e('Donate now', 'unity'); ?>
				</button>
			</div>
			<?php if ( $campaign->is_funded() ) : ?>
				<span class="campaign-successful"><?php _e( 'Successful', 'unity' ) ?></span>
			<?php elseif ( ! $campaign->is_active() && ! $campaign->is_funded() ) : ?>
				<span class="campaign-unsuccessful"><?php _e( 'Unsuccessful', 'unity' ) ?></span>
			<?php endif ?>

		</div>

		<div class="campaign-main">
			<ul class="campaign-status text-center">
				<li class="campaign-raised">
					<span class="label"><?php _e( 'Days left','unity' ) ?></span>
					<span class="text"><?php echo trim( $campaign->days_remaining() ); ?></span>
				</li>
				<li class="campaign-funded">
					<span class="funded"><?php echo esc_html( $campaign->percent_completed(false) );?>%</span>
				</li>
				<li class="campaign-backers">
					<span class="label"><?php _e( 'Expires','unity' ) ?></span>
					<span class="text"><?php echo esc_html( $campaign->date_goal() ); ?></span>
				</li>
			</ul>
		</div>

		<div class="clearfix"></div>
		<div class="entry-title">
			<a href="<?php the_permalink();?>" title="<?php the_title(); ?>"><span><?php the_title(); ?></span></a>
		</div>
		<div class="clearfix"></div>
		<div class="desciption text-center">
			<?php echo wpo_excerpt(35, '...'); ?>
		</div>
		<div class="entry-author text-center">
			<span><?php _e('By', 'unity') ?></span> <strong><?php the_author_link(); ?></strong>
		</div>

		<div class="modal fade campaign-item-modal" id="campaign-donate-<?php echo esc_attr(get_the_ID() . "-$uid") ?>" tabindex="-1" role="dialog" aria-labelledby="campaign-donate-<?php echo (get_the_ID() . "-$uid") ?>" aria-hidden="true">
			<div class="modal-dialog">
			    <div class="modal-content">
			      	<div class="modal-header">
			        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span>&times;</span></button>
			        	<h4 class="modal-title"><?php the_title(); ?></h4>
			      	</div>
			      	<div class="modal-body">
			      		<div class="campaign-content">
							<div class="barometer" data-progress="<?php echo esc_attr( $campaign->percent_completed(false) ); ?>" data-width="148" data-height="148" data-strokewidth="11" data-stroke="#DEDEDE" data-progress-stroke="<?php echo esc_attr( $color ); ?>">
								<span><?php printf( _x( "%s", 'x percent funded','unity' ), '<span class="funded">'.$campaign->percent_completed(false).'<sup>%</sup></span>' ) ?></span>
							</div>

							<ul class="campaign-status text-center">

								<li class="campaign-raised">
									<p class="label"><?php _e( 'Current','unity' ) ?></p>
									<p class="text"><?php echo trim( $campaign->days_remaining() ); ?></p>
								</li>
								<li class="campaign-goal">
									<p class="label"><?php _e( 'Target','unity' ) ?></p>
									<p class="text"><?php echo esc_html( $campaign->date_goal() ); ?></p>
								</li>
								<li class="campaign-backers hidden">
									<p class="label"><?php _e( 'Backers','unity' ) ?></p>
									<p class="text"><?php echo esc_html( $campaign->backers_count() ); ?></p>
								</li>
							</ul>
						</div>
						<div class="clearfix"></div>
						<div class="desciption">
							<?php echo wpo_excerpt(36, '... <a class="read-more" href="' . esc_url( get_the_permalink() ) . '">' . __('Read more', 'unity') . '</a>'); ?>
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

	</div>
