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
        'title'=>'',
        'columns_count' => '2'
    ), $atts ) );*/

    $atts = ( vc_map_get_attributes(  str_replace('.php','',basename(__FILE__)) , $atts ) );
    extract( $atts );

    $deals = array();
    $p_deals = wpo_woocommerce_query('deals')->posts;
    $_id = wpo_makeid();
    $_count = 1;
    switch ($columns_count) {
        case '4':
            $class_column='col-sm-6 col-md-3';
            break;
        case '3':
            $class_column='col-sm-4';
            break;
        case '2':
            $class_column='col-sm-6';
            break;
        default:
            $class_column='col-sm-12';
            break;
    }

    foreach($p_deals as $product){
        $date_sale = get_post_meta( $product->ID, '_sale_price_dates_to', true );
        if( $date_sale > time() )
            $deals[] = $product;
    }

    $_total = count($deals);

    if( $deals && $_total > 0 ) { ?>

    <?php
    //register countdown js
    wp_register_script( 'countdown_js', WPO_THEME_URI.'/js/countdown.js', array( 'jquery' ) );
    wp_enqueue_script('countdown_js');
    ?>
    <div class="widget_deals_products widget widget_products">
        <?php if($title!=''){ ?>
            <h3 class="widget-title title-primary">
                <span><?php echo esc_html( $title ); ?></span>
            </h3>
        <?php } ?>
        <div class="woocommerce woo-deals">
            <div class="widget-content widget_products slide" id="productcarouse-<?php echo esc_attr( $_id ); ?>" data-ride="carousel">
                <?php if( $_total > $columns_count ) { ?>
                    <div class="woo-carousel-controls pull-right">
                        <a class="left woo-carousel-control" href="#productcarouse-<?php echo esc_attr( $_id ); ?>" data-slide="prev">
                            <i class="fa fa-angle-left"></i>
                        </a>
                        <a class="right woo-carousel-control" href="#productcarouse-<?php echo esc_attr( $_id ); ?>" data-slide="next">
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                <?php } ?>
                <div class="carousel-inner">
                    <?php foreach($deals as $key=>$id ){
                        $product = get_product( $id );
                        $time_sale = get_post_meta( $product->id, '_sale_price_dates_to', true );
                    ?>
                    <?php if( $_count%$columns_count == 1 || $columns_count ==1 ) echo '<div class="item'.(($_count==1)?" active":"").'"><div class="row">'; ?>
                   
                            <div class="item-product <?php echo esc_attr( $class_column); if($_count%$columns_count==0) echo ' last'; ?>">
                                <div class="product-block thumbnail">
                                    <figure class="image">
                                        <?php echo trim( $product->get_image('image-widgets') ); ?>
                                    </figure>

                                    <div class="caption">
                                        <div class="deals-information">
                                            <h3 class="name">
                                                <a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>"><?php echo esc_html( $product->get_title() ); ?></a>
                                            </h3>
                                            <div class="rating clearfix ">
                                                <?php if ( $rating_html = $product->get_rating_html() ) { ?>
                                                    <div><?php echo trim( $rating_html ); ?></div>
                                                <?php }else{ ?>
                                                    <div class="star-rating"></div>
                                                <?php } ?>
                                            </div>
                                            <div class="price"><?php echo trim( $product->get_price_html() ); ?></div>
                                        </div>
                                        <div class="time">
                                            <div class="pts-countdown clearfix" data-countdown="countdown"
                                                 data-date="<?php echo date('m',$time_sale).'-'.date('d',$time_sale).'-'.date('Y',$time_sale).'-'. date('H',$time_sale) . '-' . date('i',$time_sale) . '-' .  date('s',$time_sale) ; ?>">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php if( ($_count%$columns_count==0 && $_count!=1) || $_count== $_total || $columns_count ==1 ) echo '</div></div>'; ?>
                <?php 
                        $_count++; 
                    } 
                ?>
                </div>
            </div>
        </div>
        </div>
    <?php } ?>

