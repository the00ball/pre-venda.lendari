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

?>

<?php 
	get_header( $wpoEngine->getHeaderLayout() );
	$wpopconfig = $wpoEngine->getGalleryConfig();
	wpo_breadcrumb();
?>

<section id="wpo-mainbody" class="wpo-mainbody clearfix single-gallery">
	<div class="container">
		<div class="row">
			<?php get_sidebar( 'left' );  ?>
			
			<!-- MAIN CONTENT -->
			<div class="<?php echo esc_attr( $wpopconfig['main']['class'] ); ?>">
				<div id="wpo-content" class="wpo-content">
					<?php while(have_posts()): the_post(); ?>
					<div class="post-area single-blog">
						<?php get_template_part('templates/gallery/single'); ?>
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