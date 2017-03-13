<?php
$campaign = new ATCF_Campaign( get_the_ID());
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
<div class="item-campaign row item-layout-1">
	<div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>	
		<div class="campaign-title"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></div>
	</div>

	<div class="col-lg-4 col-md-3 col-sm-6 col-xs-12">
        <div class="entry-description">
       		<?php if (has_excerpt()) { ?>
       			<?php echo the_excerpt(); ?>
       		<?php } ?>
       		<div class="clearfix"></div>
    		<div class="readmore"><a href="<?php the_permalink(); ?>"><?php echo __('Read more', 'unity'); ?></a></div>
        </div>
	</div>

	<div class="col-lg-4 col-md-5 col-sm-12 col-xs-12">
		<div class="row">
			<div class="barometer-main">
				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
					<div class="barometer" data-progress="<?php echo trim( $campaign->percent_completed(false) ); ?>" data-width="148" data-height="148" data-strokewidth="11" data-stroke="#FFF" data-progress-stroke="<?php echo esc_attr( $color ); ?>">
						<span><?php printf( _x( "%s", 'x percent funded','unity' ), '<span class="funded">'.$campaign->percent_completed(false).'<sup>%</sup></span>' ) ?></span>
					</div>
					<div class="campaign-time-left text-center"><span class="title"><?php _e('Expired on', 'unity') ?><br/><?php echo trim( $campaign->days_remaining() ); ?></span><span><?php _e(' days left', 'unity'); ?></span></div>
				</div>

				<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 xs-text-center">
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

				<div class="col-xs-12">
					<div class="text-center quick-donate">
						<button type="button" class="btn btn-donate-black" data-toggle="modal" data-target="#campaign-donate-<?php echo (get_the_ID() . "-$uid") ?>">
						  	<?php _e('Donate now', 'unity'); ?>
						</button>
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="modal fade campaign-item-modal" id="campaign-donate-<?php echo (get_the_ID() . "-$uid") ?>" tabindex="-1" role="dialog" aria-labelledby="campaign-donate-<?php echo (get_the_ID() . "-$uid") ?>">
		<div class="modal-dialog">
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        	<h4 class="modal-title"><?php the_title(); ?></h4>
		      	</div>
		      	<div class="modal-body">
			        <div id="campaign-form-<?php echo esc_attr(get_the_ID() . "-$uid") ?>" class="campaign-form reveal-modal content-block block">
				        <?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID() ) ); ?>
				    </div>
		      	</div>
		    </div>
		</div>
	</div>

</div>
