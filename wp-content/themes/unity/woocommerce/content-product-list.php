<?php
/**
 * The template for displaying product content within loops.
 *
 * Override this template by copying it to yourtheme/woocommerce/content-product.php
 *
 * @author      WooThemes
 * @package     WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product, $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) )
    $woocommerce_loop['loop'] = 0;

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) )
    $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );

// Ensure visibility
if ( ! $product || ! $product->is_visible() )
    return;

 

// Extra post classes
$classes = '';
 

$columns = 12/$woocommerce_loop['columns']
?>


<div <?php post_class( 'shopcol product-wrapper product-list-layout '.$classes.' col-md-12 product-cols' ); ?>>
	<?php global $product; ?>
    <div class="product-block product product-list">
    	<div class="row">
    		<div class="col-lg-3 col-md-3">
    			<figure class="image">
    		        <?php woocommerce_show_product_loop_sale_flash(); ?>
    		        <a href="<?php the_permalink(); ?>" class="product-image zoom-2">
    		            <?php
    		                /**
    		                * woocommerce_before_shop_loop_item_title hook
    		                *
    		                * @hooked woocommerce_show_product_loop_sale_flash - 10
    		                * @hooked woocommerce_template_loop_product_thumbnail - 10
    		                */
    		                remove_action('woocommerce_before_shop_loop_item_title','woocommerce_show_product_loop_sale_flash',10);
    		                do_action( 'woocommerce_before_shop_loop_item_title' );
    		            ?>
    		        </a>
    		    </figure>
    		</div>

    		<div class="col-md-6 col-lg-6">
                <div class="product-meta">
                    <h3 class="name"> <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a> </h3>

                    <?php woocommerce_template_single_excerpt(); ?>

                    <?php if(wpo_theme_options('is-quickview',true)){ ?>
                        <div class="quick-view">
                            <a href="#" class="quickview hidden-xs hidden-sm" data-productslug="<?php echo $product->post->post_name; ?>" data-toggle="modal" data-target="#wpo_modal_quickview"> <span><?php echo __('Quick view','unity'); ?></span> </a>
                        </div>
                    <?php } ?>

                    <?php echo $product->get_categories( ', ', '<h5 class="category">', '</h5>' ); ?>
                </div>
    		</div>

    		<div class="col-lg-3 col-md-3">
                <div class="product-assets">
        			<?php
        				/**
        				* woocommerce_after_shop_loop_item_title hook
        				*
        				* @hooked woocommerce_template_loop_rating - 5
        				* @hooked woocommerce_template_loop_price - 10
        				*/
        				do_action( 'woocommerce_after_shop_loop_item_title' );
        	        ?>
        			<div class="button-groups">
                        <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>

                        <?php
                            if( class_exists( 'YITH_WCWL' ) ) {
                                echo do_shortcode( '[yith_wcwl_add_to_wishlist]' );
                            }
                        ?>

                        <?php if( class_exists( 'YITH_Woocompare' ) ) {
                            $action_add = 'yith-woocompare-add-product';
                            $url_args = array(
                                'action' => $action_add,
                                'id' => $product->id
                            );
                        ?>
                        <div class="yith-compare hidden-xs hidden-sm">
                            <a href="<?php echo esc_url( wp_nonce_url( add_query_arg( $url_args ), $action_add ) ); ?>" class="compare" data-product_id="<?php echo $product->id; ?>"> <i class="fa fa-files-o"></i> <span><?php echo __('add to compare','unity'); ?></span> </a>
                        </div>
                        <?php } ?>
        	        </div>
                </div>
    		</div>
    	</div>
    </div>
</div>