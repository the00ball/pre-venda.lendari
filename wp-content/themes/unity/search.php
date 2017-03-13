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
<section class="breadcrumb wpo-breadcrumb">
    <nav class="container" itemprop="breadcrumb">
        <h4 class="text-left"><?php _e( '<span>Search </span> results for: ', 'unity' ); echo $s; ?></h4>
    </nav>
</section>

<section id="wpo-mainbody" class="wpo-mainbody clearfix main-page">

     <div class="wrapper-content"> 
        <div class="container"><div class="container-inner">
        
            <div class="row"> 
                <!-- MAIN CONTENT -->
                <div class="col-lg-9 col-md-9 col-sm-9">
                    <div id="wpo-content">
                        <?php  if ( have_posts() ) : ?>
                            <div class="post-area">
                                <?php while ( have_posts() ) : the_post(); ?>
                                  <?php get_template_part( 'templates/blog/blog'); ?>
                                <?php endwhile; ?>
                            </div>
                         
                        <?php else : ?>
                            <?php get_template_part( 'templates/none' ); ?>
                        <?php endif; ?>
                    </div>
                    <?php wpo_pagination(); ?>
                </div>
                <div class="col-xs-3 wpo-sidebar">
                   <?php dynamic_sidebar('sidebar-default'); ?>
                </div>
            </div>
        </div> </div>
     </div>   
</section>
<?php get_footer(); ?>