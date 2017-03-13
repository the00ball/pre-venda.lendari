<?php 
/**
 * Single campaign template.
 */
global $wpopconfig;
$wpopconfig = $wpoEngine->getCampaignConfig();


get_header() ?>	
	<section id="wpo-mainbody" class=" wpo-mainbody single-campaign">
        <div class="wrapper-breadcrumb">
            <?php wpo_breadcrumb(); ?>
        </div>
        <div class="wrapper-content">
	        <div class="container">
	            <div class="container-inner">
	                <div class="row">
						
						<?php get_sidebar( 'left' );  ?>
						<div id="wpo-content" class="<?php echo esc_attr( $wpopconfig['main']['class'] ); ?>">
							<div class="single-campaign-content">
								<?php if ( have_posts() ) : ?>

									<?php while( have_posts() ) : ?>

										<?php the_post() ?>

										<?php $campaign = new ATCF_Campaign( get_the_ID() ) ?>

										<?php do_action( 'atcf_campaign_before', $campaign ) ?>

										<?php get_template_part('templates/campaign/campaign', 'blurb') ?>			

										<!-- Campaign content -->					
										<?php get_template_part('templates/campaign/single') ?>
										<!-- End campaign content -->

										<?php comments_template('/comments.php', true) ?>

									<?php endwhile ?>

								<?php endif ?>
							</div>
						</div>	
						<?php get_sidebar( 'right' );  ?>

					</div>
				</div>
			</div>
		</div>			

</section>

<?php get_footer(wpo_theme_options('footer-style')); ?>