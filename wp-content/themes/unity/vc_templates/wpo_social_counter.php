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

/*extract( shortcode_atts( array(
	'title' => '',
	'twitter_show' => '',
	'twitter_user' => '',
	'show_facebook' => '',
	'facebook_id' => '',
	'show_youtube' => '',
	'youtube_usename' => '',
	'show_google' => '',
	'google_id' => '',
	'google_key' => '',
	'class' => '',
	'size' => '',
	'alignment' => 'separator_align_left'

), $atts ) );*/

$atts = ( vc_map_get_attributes(  str_replace('.php','',basename(__FILE__)) , $atts ) );
extract( $atts );

?>

<div class="widget wpo-social-counter <?php echo esc_attr( $class ); ?>">
	<?php if( $title ) { ?>
        <h3 class="widget-title visual-title <?php echo esc_attr( $size ).' '.esc_attr( $alignment ); ?>">
           <span> <?php echo esc_html( $title ); ?></span>
        </h3>
    <?php } ?>

    <div class="widget-content">
	    <ul class="wpo-social-count">
	    <?php if( $show_facebook && !empty( $facebook_id) ): ?>
	        <li class="diverz facebook">
	        	<a href="https://www.facebook.com/<?php echo esc_attr( $facebook_id ); ?>">
			        <div class="main-diverz">
				        <i class="facebookz fa fa-facebook"></i>
		        	</div>
	        	</a>
			    <div class="sub-diverz">
			        <span class="count"><?php echo wpo_fb_get_counter( $facebook_id ) ?></span>
			        <span class="count-name"><?php echo __('Like', 'unity'); ?></span>
			    </div>
	        </li>
        <?php endif; ?>
        <?php if( $twitter_show && !empty( $twitter_user)): ?>         
	        <li class="diverz twitter">
		        <a href="https://www.twitter.com/<?php echo esc_attr( $twitter_user ); ?>">
			        <div class="main-diverz">
			        <i class="twitterz fa fa-twitter"></i>
			        </div>
		        </a>
		        <div class="sub-diverz">
		        	<span class="count"><?php echo wpo_twitter_count( $twitter_user ) ?></span>
		        	<span class="count-name"><?php echo __('Followers', 'unity'); ?></span>
		        </div>
	        </li>
        <?php endif; ?>

        <?php if($show_google && !empty($google_id) && !empty($google_key)): ?>
	                 
	        <li class="diverz google">
		        <a href="https://plus.google.com/u/0/<?php echo esc_attr( $google_id ); ?>">
			        <div class="main-diverz">
				        <i class="googlez fa fa-google-plus"></i>
			        </div>
		        </a>
		        <div class="sub-diverz">
		        	<span class="count"><?php echo wpo_googleplus_count( $google_id, $google_key ) ?></span>
		        	<span class="count-name"><?php echo __('Followers', 'unity'); ?></span>
		        </div>
	        </li>
        <?php endif; ?>
	    </ul>
    </div>
</div>
