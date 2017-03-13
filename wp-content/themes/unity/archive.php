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
$post_type = get_post_type();
switch ( $post_type) {
  case 'portfolio':
      $wpopconfig = $wpoEngine->getPortfolioConfig();
      $_breadcrumb = wpo_theme_options('portfolio_show-breadcrumb', true);
      $_showtitle = wpo_theme_options('portfolio_show-title', true);
      break;

  case 'gallery':
      $wpopconfig = $wpoEngine->getGalleryConfig();
      $_breadcrumb = wpo_theme_options('gallery_show-breadcrumb', true);
      $_showtitle = wpo_theme_options('gallery_show-title', true);
      break;

  case 'download':
      $wpopconfig = $wpoEngine->getCampaignConfig();
      $_breadcrumb = wpo_theme_options('campaign_show-breadcrumb', true);
      $_showtitle = wpo_theme_options('campaign_show-title', true);
      break;
  
  default:
      $wpopconfig = $wpoEngine->getBlogConfig();
      $_breadcrumb = wpo_theme_options('blog_show-breadcrumb', true);
      $_showtitle = wpo_theme_options('blog_show-title', true);
      break;
}

?>

<?php get_header( wpo_theme_options('headerlayout') ); ?>

<section id="wpo-mainbody" class="wpo-mainbody clearfix main-page">
    <?php if( $_breadcrumb ){ ?>
      <?php wpo_breadcrumb( $_showtitle ); ?>
  <?php } ?>

     <div class="wrapper-content"> 
        <div class="container"><div class="container-inner">
            <div class="row">
            <?php get_sidebar( 'left' );  ?>
                <!-- MAIN CONTENT -->
                <div id="wpo-content" class="<?php echo esc_attr( $wpopconfig['main']['class'] ); ?>">
                <?php  if ( have_posts() ) : ?>
                    <div class="post-area">
                        <?php get_template_part( 'contents', get_post_type() ); ?>
                    </div>
                <?php else : ?>
                    <?php get_template_part( 'templates/none' ); ?>
                <?php endif; ?>
                </div>
                <!-- //END MAIN CONTENT -->
            <?php get_sidebar( 'right' );  ?>
            </div>
        </div> </div>
     </div>   
</section>

<?php get_footer(); ?>