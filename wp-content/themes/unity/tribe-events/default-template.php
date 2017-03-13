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
  
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}
global $wpopconfig;
$wpopconfig = $wpoEngine->getEventConfig();
get_header( $wpoEngine->getHeaderLayout() ); 
?>


<div class="wrapper-breadcrumb">
    <?php wpo_breadcrumb(); ?>
</div>

<section id="wpo-mainbody" class="wpo-mainbody event-template clearfix">
    <div class="container">
      <div class="container-inner">
        <div class="row">
          <!-- MAIN CONTENT -->
          <?php get_sidebar( 'left' );  ?>

          <div id="wpo-content" class="<?php echo esc_attr( $wpopconfig['main']['class'] ); ?>">
            <div id="wpo-content" class="wpo-content">
              <article id="post-<?php the_ID(); ?>" <?php post_class('clearfix'); ?>>
                  <?php tribe_events_before_html(); ?>
				          <?php tribe_get_view(); ?>
				          <?php tribe_events_after_html(); ?>
              </article>

            </div>
          </div>
          <!-- //MAIN CONTENT -->
          
          <?php get_sidebar( 'right' );  ?>
        </div>
      </div>
    </div>
</section>
<?php get_footer(); ?>
