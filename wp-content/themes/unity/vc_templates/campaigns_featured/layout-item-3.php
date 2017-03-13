<?php 
$campaign = new ATCF_Campaign( get_the_ID()); 
$uid = wpo_makeid();
?>
<div class="item-campaign row item-layout-3">
	<div class="col-xs-12">
		<div class="campaign-title"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></div>
		<div class="campaign-des"><?php echo wpo_excerpt(30, '...'); ?>	</div>
	</div>	

	<div class="col-xs-12">
		<div class="campaign-main-style-3">
			<ul class="campaign-status text-center">		
				<li class="campaign-raised">
					<span class="label"><?php _e( 'Current','unity' ) ?></span>	
					<span class="text"><?php echo esc_html( $campaign->current_amount() ) ?></span>
				</li>
				<li class="campaign-funded">
					<span class="funded"><?php echo esc_html( $campaign->percent_completed(false) )?>%</span>		
				</li>
				<li class="campaign-goal">
					<span class="label"><?php _e( 'Backers','unity' ) ?></span>
					<span class="text"><?php echo esc_html( $campaign->goal() ) ?></span>
				</li>		
			</ul>
			<div class="process"><span class="processing" style="width: <?php echo trim( $campaign->percent_completed(false) ); ?>%"></span></div>
		</div>

		<div class="link text-center">
			<a class="btn btn-outline" data-toggle="modal" data-target="#campaign-feature-donate-<?php echo (get_the_ID() . "-$uid") ?>" href="javascript:void(0);">
				 <?php _e('Donate now', 'unity'); ?>
			</a>
			<a class="btn btn-outline-inverse" href="<?php the_permalink(); ?>"><?php _e('Read more', 'unity') ?></a>
		</div>
	</div>

	<div class="modal fade campaign-item-modal" id="campaign-feature-donate-<?php echo (get_the_ID() . "-$uid") ?>" tabindex="-1" role="dialog" aria-labelledby="campaign-feature-donate-<?php echo (get_the_ID() . "-$uid") ?>">
		<div class="modal-dialog">
		    <div class="modal-content">
		      	<div class="modal-header">
		        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		        	<h4 class="modal-title"><?php the_title(); ?></h4>
		      	</div>
		      	<div class="modal-body">
			        <div id="campaign-form-<?php echo (get_the_ID() . "-$uid") ?>" class="campaign-form reveal-modal content-block block">
				        <?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID() ) ); ?>
				    </div>
		      	</div>
		    </div>
		</div>
	</div>

</div>