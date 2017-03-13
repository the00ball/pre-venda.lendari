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
  * @website  http://www.wpopal.com
  * @support  http://www.wpopal.com/support/forum.html
  */
if( !defined("WPO_THEME_DIR") ){
    define( 'WPO_THEME_DIR', get_template_directory() );
    define( 'WPO_THEME_URI', get_template_directory_uri() );
}

define( 'WPO_FRAMEWORK_PATH', WPO_THEME_DIR . '/inc/core/' ); 
define( 'WPO_FRAMEWORK_LANGUAGE', WPO_FRAMEWORK_PATH.'language' );
define( 'WPO_FRAMEWORK_WIDGETS', WPO_FRAMEWORK_PATH.'widgets/' );
define( 'WPO_FRAMEWORK_SHORTCODE', WPO_FRAMEWORK_PATH.'shortcodes/' );
define( 'WPO_FRAMEWORK_POSTTYPE', WPO_FRAMEWORK_PATH.'types/' );

define( 'WPO_FRAMEWORK_TEMPLATES', WPO_THEME_DIR.'/templates/' ); 
define( 'WPO_FRAMEWORK_WOOCOMMERCE_WIDGETS', WPO_THEME_DIR.'/woocommerce/widgets/' );
define( 'WPO_FRAMEWORK_TEMPLATES_PAGEBUILDER', WPO_THEME_DIR.'/vc_templates/' );
define( 'WPO_FRAMEWORK_ADMIN_TEMPLATE_PATH', WPO_THEME_DIR . '/inc/core/admin/templates/' );
define( 'WPO_FRAMEWORK_PLUGINS', WPO_THEME_DIR.'/inc/plugins/' );
define( 'WPO_FRAMEWORK_XMLPATH', WPO_THEME_DIR.'/customize/' );
define( 'WPO_FRAMEWORK_CUSTOMZIME_STYLE', WPO_THEME_DIR.'/customize/assets/' );
define( 'WPO_FRAMEWORK_CUSTOMZIME_STYLE_URI', WPO_THEME_URI.'/customize/assets/' );

define( 'WPO_FRAMEWORK_ADMIN_STYLE_URI', WPO_THEME_URI.'/inc/assets/' );
define( 'WPO_FRAMEWORK_ADMIN_IMAGE_URI', WPO_FRAMEWORK_ADMIN_STYLE_URI.'images/' );
define( 'WPO_FRAMEWORK_STYLE_URI', WPO_THEME_URI.'/inc/assets/' );  


require_once ( WPO_FRAMEWORK_PATH . 'classes/plugin-activation.php' ); 
//echo WPO_FRAMEWORK_POSTTYPE;
require_once ( WPO_FRAMEWORK_PATH . 'classes/metabox.php' );
require_once ( WPO_FRAMEWORK_PATH . 'classes/params.php' );

require_once ( WPO_FRAMEWORK_PATH . 'classes/widgetbase.php' );
require_once ( WPO_FRAMEWORK_PATH . 'classes/shortcodes.php' );

require_once ( WPO_FRAMEWORK_PATH . 'classes/shortcodebase.php' );
// require_once ( WPO_FRAMEWORK_PATH . 'classes/template.php' );
require_once ( WPO_FRAMEWORK_PATH . 'classes/framework.php' );


/**
 * Megamenu Libs
 */
require_once ( WPO_FRAMEWORK_PATH . 'megamenu/classes/megamenu-config.php' );
require_once ( WPO_FRAMEWORK_PATH . 'megamenu/classes/megamenu.php' );
require_once ( WPO_FRAMEWORK_PATH . 'megamenu/classes/megamenu-vertical.php' );
require_once ( WPO_FRAMEWORK_PATH . 'megamenu/classes/megamenu-sub.php' );
require_once ( WPO_FRAMEWORK_PATH . 'megamenu/classes/megamenu-offcanvas.php' );
require_once ( WPO_FRAMEWORK_PATH . 'megamenu/classes/megamenu-widget.php' );


require_once ( WPO_FRAMEWORK_PATH . 'functions/functions.php');


//live theme editor
require_once ( WPO_FRAMEWORK_PATH . 'livetheme/livetheme-editor.php' );
 

require_once( WPO_THEME_SUB_DIR . 'frontend.php' );
if( is_admin() ) {
   require_once ( WPO_FRAMEWORK_PATH . 'megamenu/megamenu-editor.php' );
   require_once( WPO_THEME_SUB_DIR . 'backend.php' );
}