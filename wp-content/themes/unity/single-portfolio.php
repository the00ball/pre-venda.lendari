<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     WPOpal  Team <wpopal@gmail.com, support@wpopal.com>
 * @copyright  Copyright (C) 2014 wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/support/forum.html
 */
global $wpopconfig;
$wpopconfig = $wpoEngine->getPortfolioConfig();
$show_title = wpo_theme_options('portfolio_show-title', true);
?>

<?php get_header( wpo_theme_options('headerlayout', '') ); ?>

<?php
	if( wpo_theme_options( 'portfolio_show-breadcrumb', true))
		wpo_breadcrumb( $show_title);
 ?>

<section id="wpo-mainbody" class="wpo-mainbody clearfix single-portfolio">
	<div class="container">
		<div class="row">
			<?php get_sidebar( 'left' );  ?>
			<!-- MAIN CONTENT -->
			<div class="<?php echo esc_attr( $wpopconfig['main']['class'] ); ?>">
				<div id="wpo-content" class="wpo-content ">
					<?php while(have_posts()):the_post(); ?>
							
						<div class="post next">
							<div class="post-next">
								<?php previous_post_link('<strong>%link</strong>', 'Previous', FALSE); ?> | <?php next_post_link('<strong>%link</strong>', 'Next', FALSE); ?>
	 						</div>
						</div>
					
						<div class="post-area single-blog">
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
								<div class="post-container">
									<?php if ( has_post_thumbnail() ) { ?>
										<div class="entry-thumb">
											<a href="<?php the_permalink(); ?>" title="">
												<?php the_post_thumbnail('');?>
											</a>
										</div>
									<?php } ?>
									<div class="entry-content no-border">
										<?php the_content(); ?>
										<?php wp_link_pages(); ?>
									</div>
									<?php if( wpo_theme_options('show-share-portfolio', true)) { ?>
										<div class="post-share">
		                                    <div class="row">
		                                        <div class="col-sm-4">
		                                            <h6><?php echo __( 'Share this Post!','unity' ); ?></h6>
		                                        </div>
		                                        <div class="col-sm-8">
		                                            <?php wpo_share_box(); ?>
		                                        </div>
		                                    </div>
		                                </div>
	                                <?php } ?>

	                                <?php
		                                if(wpo_theme_options('show-related-portfolio')){
		                                    $relate_count = wpo_theme_options('portfolio-items-show', 4);
		                                    wpo_related_post($relate_count, 'portfolio', 'Categories');
		                                }
	                                ?>
								</div>
							</article>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
				<!-- //MAIN CONTENT -->
				<?php get_sidebar( 'right' );  ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>