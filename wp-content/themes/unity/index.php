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
?>

<?php get_header( $wpoEngine->getHeaderLayout() ); ?>

<section id="wpo-mainbody" class="wpo-mainbody clearfix main-page main-page-default">
     <div class="wrapper-content"> 
        <div class="container"><div class="container-inner">
            <div class="row"> 
                <!-- MAIN CONTENT -->
                <div class="col-lg-8 col-md-8 col-sm-8 col-sx-12">
                    <div id="wpo-content">
                        <?php  if ( have_posts() ) : ?>
                            <div class="post-area">
                                  <?php get_template_part( 'contents', get_post_type() ); ?>
                            </div>
                        <?php else : ?>
                            <?php get_template_part( 'templates/none' ); ?>
                        <?php endif; ?>
                    </div>
                    
                </div>
                <div class="col-lg-4 col-md-4 col-sm-4 col-sx-12 wpo-sidebar">
                   <?php dynamic_sidebar('sidebar-default'); ?>
                </div>
            </div>
        </div> </div>
     </div>   
</section>
<?php get_footer(); ?>