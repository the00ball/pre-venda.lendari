<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     Opal  Team <opalwordpressl@gmail.com >
 * @copyright  Copyright (C) 2014 wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http:/wpopal.com
 * @support  http://wpopal.com
 */
global $wpopconfig;
 
get_header( wpo_theme_options('headerlayout', '') ); 

if(is_single()){
	$wpopconfig = $wpoEngine->configLayout(wpo_theme_options('woocommerce-single-layout','0-1-0'));
	wc_get_template( 'single-product.php' , array( 'config'=>$wpopconfig ) );
}else{
	$wpopconfig = $wpoEngine->configLayout(wpo_theme_options('woocommerce-archive-layout','0-1-0'));
	wc_get_template( 'archive-product.php' , array( 'config' => $wpopconfig ) );
}

get_footer( );