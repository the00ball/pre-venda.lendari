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
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <!-- OFF-CANVAS MENU SIDEBAR -->
    <div id="wpo-off-canvas" class="wpo-off-canvas">
        <div class="wpo-off-canvas-body">
            <div class="wpo-off-canvas-header">
                <?php get_search_form(); ?>
                <button type="button" class="close btn btn-close" data-dismiss="modal">
                    <i class="fa fa-times"></i>
                </button>
                <div class="mobile-menu-header">
                    <?php _e('Menu','unity'); ?>
                </div>
            </div>
            <nav class="navbar navbar-offcanvas navbar-static" role="navigation">
                <?php
                $args = array(
                    'theme_location'  => 'mainmenu',
                    'container_class' => 'navbar-collapse',
                    'menu_class'      => 'wpo-menu-top nav navbar-nav',
                    'fallback_cb'     => '',
                    'menu_id'         => 'main-menu-offcanvas',
                    'walker'          => new Wpo_Megamenu_Offcanvas()
                );
                wp_nav_menu($args);
                ?>
            </nav>
        </div>
    </div>
    <!-- //OFF-CANVAS MENU SIDEBAR -->

    <?php
        $meta_template = get_post_meta(get_the_ID(),'wpo_template',true);
    ?>

    <!-- START Wrapper -->
    <section class="wpo-wrapper <?php echo isset($meta_template['el_class']) ? $meta_template['el_class'] : '' ; ?>">
        <!-- Top bar -->
        <section id="wpo-topbar" class="wpo-topbar">
            <div class="topbar-inner">
                <div class="container">
                    
                    <div class="topbar-mobile hidden-lg hidden-md">
                        <div class="pull-right">
                            <div class="active-mobile pull-left hidden-sm">
                                <div class="navbar-header-topbar">
                                    <?php wpo_renderButtonToggle(); ?>
                                </div>
                            </div>

                            <div class="active-mobile pull-left search-popup">
                                <a id="dLabel1" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                                    <span class="fa fa-search"></span>
                                </a>    
                                <div class="active-content dropdown-menu" role="menu" aria-labelledby="dLabel1">
                                    <?php get_search_form(); ?>
                                </div>
                            </div>
                            <div class="active-mobile pull-left setting-popup">
                                <a id="dLabel2" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                                    <span class="fa fa-user"></span>
                                </a>  
                                <div class="active-content dropdown-menu" role="menu" aria-labelledby="dLabel2">
                                    <h3 class="white title"><?php _e('Settings','unity'); ?></h3>
                                    <?php if(has_nav_menu( 'topmenu' )){ ?>
                                        <div class="pull-left">
                                            <?php
                                                $args = array(
                                                    'theme_location'  => 'topmenu',
                                                    'container_class' => '',
                                                    'menu_class'      => 'menu-topbar'
                                                );
                                                wp_nav_menu($args);
                                            ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                            <div class="active-mobile pull-left cart-popup">
                                <a id="dLabel3" data-target="#" href="#" data-toggle="dropdown" aria-haspopup="true" role="button" aria-expanded="false">
                                    <span class="fa fa-shopping-cart"></span>
                                </a>  
                                <div class="active-content dropdown-menu" role="menu" aria-labelledby="dLabel3">
                                    <h3 class="white title">
                                        <?php _e('Shopping Bag','unity'); ?>
                                    </h3>
                                    <div class="widget_shopping_cart_content"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>    
        </section>
        <!-- // Topbar -->
        <!-- HEADER -->
        <header id="wpo-header" class="wpo-header wpo-header-v4">
       
            <div class="container-inner header-wrap">
                <div class="container header-wrapper-inner">
                    <div class="row">
                        <!-- LOGO -->
                        <div class="logo-in-theme col-lg-3 col-md-2 col-sm-12 col-xs-12">
                            <?php if( wpo_theme_options('logo') ) { ?>
                            <div class="logo">
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                    <img src="<?php echo wpo_theme_options('logo'); ?>" alt="<?php bloginfo( 'name' ); ?>">
                                </a>
                            </div>
                            <?php } else { ?>
                                <div class="logo logo-theme">
                                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>">
                                         <img src="<?php echo get_template_directory_uri() . '/images/logo-home-3.png'; ?>" alt="<?php bloginfo( 'name' ); ?>" />
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                        <div class="col-lg-9 col-md-10 col-sm-12 col-xs-12">
                            <div class="wpo-mainmenu-wrap">
                                <div class="mainmenu-content-wapper">
                                    <div class="mainmenu-content">
                                        <nav id="wpo-mainnav" data-duration="<?php echo wpo_theme_options('megamenu-duration',400); ?>" class="wpo-megamenu <?php echo wpo_theme_options('magemenu-animation','slide'); ?> animate navbar navbar-mega" role="navigation">
                                            <div class="navbar-header">
                                                <?php wpo_renderButtonToggle(); ?>
                                            </div><!-- //END #navbar-header -->
                                            <?php
                                                $args = array(  'theme_location' => 'mainmenu',
                                                                'container_class' => 'collapse navbar-collapse navbar-ex1-collapse',
                                                                'menu_class' => 'nav navbar-nav megamenu',
                                                                'fallback_cb' => '',
                                                                'menu_id' => 'main-menu',
                                                                'walker' => new Wpo_Megamenu());
                                                wp_nav_menu($args);
                                            ?>
                                        </nav>
                                    </div> 
                                </div>    
                            </div>   
                        </div>
                    </div>    
                </div>  
                <!-- // Setting -->
            </div>
        </header>
        <!-- //HEADER -->