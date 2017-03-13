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
	'title'=>'Shop by category',
	'menu'=>'',
	'el_class' => '',
	'postion' => 'left'
), $atts ) );*/

$atts = ( vc_map_get_attributes(  str_replace('.php','',basename(__FILE__)) , $atts ) );
extract( $atts );

$nav_menu = ( $menu !='' ) ? wp_get_nav_menu_object( $menu ) : false;
if(!$nav_menu) return false;
$postion_class = ($postion=='left')?'menu-left':'menu-right';
$args = array(  'menu' => $nav_menu,
                'container_class' => 'collapse navbar-collapse navbar-ex1-collapse vertical-menu '.$postion_class,
                'menu_class' => 'nav navbar-nav megamenu',
                'fallback_cb' => '',
                'walker' => new Wpo_Megamenu_Vertical());

?>

<aside class="widget_wpo_vertical_menu clearfix widget-highlighted ">
    <?php if($title!=''): ?>
        <h3 class="widget-title visual-title">
            <span><?php echo  $title; ?></span>
        </h3>
    <?php endif; ?>
    <div class="widget-content">
        <?php wp_nav_menu($args); ?>
    </div>
</aside>
