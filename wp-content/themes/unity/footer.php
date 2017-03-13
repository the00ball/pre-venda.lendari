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
global $footer_builder;
$footer = wpo_theme_options('footer-style','default');

?>
	<?php if(is_active_sidebar('social')) dynamic_sidebar('social'); ?>

	<?php if( $footer !='default' && ( get_post( $footer)) ){
        echo trim( $footer_builder['footer'] );
        ?>
        	<footer id="wpo-footer" class="wpo-footer">
	            <?php 
	              $post = get_post($footer);
	              echo do_shortcode( $post->post_content ); 
	            ?>
          </footer>
	<?php }else{ ?>

	<footer id="wpo-footer" class="wpo-footer">
		<div class="container">
			<section class="">
				<div class="row">
					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
						<div class="inner wow fadeInUp" data-wow-duration='0.8s' data-wow-delay="200ms" >
							<?php dynamic_sidebar('footer-1'); ?>
						</div>
						<?php endif; ?>
					</div>

					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
						<div class="inner wow fadeInUp" data-wow-duration='0.8s' data-wow-delay="400ms" >
							<?php dynamic_sidebar('footer-2'); ?>
						</div>
						<?php endif; ?>
					</div>

					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
						<div class="inner wow fadeInUp" data-wow-duration='0.8s' data-wow-delay="600ms" >
							<?php dynamic_sidebar('footer-3'); ?>
						</div>
						<?php endif; ?>
					</div>

					<div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
						<?php if ( is_active_sidebar( 'footer-4' ) ) : ?>
						<div class="inner wow fadeInUp" data-wow-duration='0.8s' data-wow-delay="800ms" >
							<?php dynamic_sidebar('footer-4'); ?>
						</div>
						<?php endif; ?>
					</div>
				</div>
			</section>
		</div>
	</footer>
	<?php } ?>

	<section class="wpo-copyright">
		<div class="container">
			<div class="copyright">
				<address>
					<?php 
						$copyright_text =  wpo_theme_options('copyright_text', '');
						if(!empty($copyright_text)){
							echo trim( $copyright_text );
						}else{
							echo ('Copyright <a href="' . ( is_ssl()  ? 'https' : 'http') . '://themeforest.net/user/Opal_WP/">OpalTheme</a>. All Rights Reserved.'); 
						}
					?>
				</address>

				<?php if(wpo_theme_options('image-payment', '')){ ?>
					<div class="payment">
						<img src="<?php echo esc_url_raw( wpo_theme_options('image-payment', '') ); ?>" />
					</div>
				<?php } ?>

			</div>
		</div>
	</section>

</section>
<!-- END Wrapper -->
<?php wp_footer(); ?>
</body>
</html>