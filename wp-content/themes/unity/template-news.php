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

/*
*Template Name: Magazine
*
*/
global $wpopconfig;
$wpopconfig = $wpoEngine->getPageConfig();
?>
 <?php get_header( $wpoEngine->getHeaderLayout() ); ?>
 <?php if($wpopconfig['breadcrumb']){ ?>
    <div class="wrapper-breadcrumb">
        <?php wpo_breadcrumb( $wpopconfig['showtitle']); ?>
    </div>
<?php } ?>

<section id="wpo-mainbody" class="wpo-mainbody news-page clearfix">
    <div class="container">
        <div class="row">
        <?php get_sidebar( 'left' );  ?>
            <?php /******************************* MAIN CONTENT ************************************/ ?>
            <div class="<?php echo esc_attr( $wpopconfig['main']['class'] ); ?>">
                <div id="wpo-content" class="wpo-content no-padding bg-transparent">

                  <?php /* The loop */ ?>
                      <?php while ( have_posts() ) : the_post(); ?>
                      <article id="post-<?php the_ID(); ?>" <?php post_class(''); ?>>
                          <?php the_content(); ?>
                      </article><!-- #post -->
                      <?php //comments_template(); ?>
                  <?php endwhile; ?>
              </div>
            </div>

          
          <?php get_sidebar( 'right' ); ?>
        </div>
    </div>
</section>

<?php get_footer(); ?>