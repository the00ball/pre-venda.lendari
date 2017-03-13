<?php global $campaign; ?>
<div class="clearfix"></div>
<div id="campaign-<?php echo get_the_ID() ?>" <?php post_class('campaign-content') ?>>
	<?php if($campaign->video() ): ?>
		<div class="video-responsive">
			<?php echo wp_oembed_get( $campaign->video()); ?>
		</div>
	<?php endif; ?>
	
	<div class="entry-description">
		<?php the_content() ?>
	</div>
</div>
