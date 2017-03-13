<?php 
/**
 * Campaign edit page. 
 */
global $wpopconfig;
$wpopconfig = $wpoEngine->getCampaignConfig();

 get_header( wpo_theme_options('headerlayout', '') ); ?>
	<section id="wpo-mainbody" class=" wpo-mainbody single-campaign edit-single-campaign">
      <div class="wrapper-breadcrumb">
         <?php wpo_breadcrumb(); ?>
      </div>
      <div id="wpo-content" class="wpo-content">
      <div class="container atcf-submit-campaign">	
			<?php if ( have_posts() ) : ?>

			<?php while ( have_posts() ) : ?>
		
				<?php the_post() ?>

				<div class="content content-wrapper fullwidth ">							
					
						<article class="" id="post-<?php the_ID() ?>" <?php post_class() ?>>			
							<?php if ( get_post_status() != 'draft' ) : ?>
								<div class="title-wrapper"><h2 class="post-title"><?php the_title() ?></h2></div>
							<?php endif ?>
							
							<div class="entry cf">				
								<?php echo atcf_shortcode_submit( array(
								    'editing'    => is_preview() ? false : true, 
	    							'previewing' => is_preview() ? true : false  
	    						) ) ?>
							</div>						
						</article>
					</div>		
				

			<?php endwhile ?>

			<?php endif ?>	
			</div>
		</div>	
</section>

<?php get_footer() ?>		