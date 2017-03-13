<?php
/*
*Template Name: Template visual
*
*/
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
$wpopconfig = $wpoEngine->getPageConfig();
?>

<?php get_header( $wpoEngine->getHeaderLayout() ); ?>
    <section id="wpo-mainbody" class="default-visual default-home wpo-mainbody">
        <?php if($wpopconfig['breadcrumb']){ ?>
            <div class="wrapper-breadcrumb">
                <?php wpo_breadcrumb( $wpopconfig['showtitle']); ?>
            </div>
        <?php } ?>
        <div class="wrapper-content">
            <div class="container-inner">
                <div class="row">
                    <?php get_sidebar( 'left' );  ?>
                    <!-- MAIN CONTENT -->
                    <div id="wpo-content" class="<?php echo esc_attr( $wpopconfig['main']['class'] ); ?>">
                        <?php /* The loop */ ?>
                        <?php while ( have_posts() ) : the_post(); ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
                                <?php the_content(); ?>
                            </article><!-- #post -->
                            <?php //comments_template(); ?>
                        <?php endwhile; ?>
                    </div>
                    <!-- //MAIN CONTENT -->
                    <?php get_sidebar( 'right' );  ?>
                </div>
            </div>
        </div>
    </section>
<?php get_footer(); ?>