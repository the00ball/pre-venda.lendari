<?php
/**
 * Single Product Up-Sells
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */
if( !(wpo_theme_options('wc_show_upsells', false)) ){
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

	global $product, $woocommerce_loop;

	$upsells = $product->get_upsells();
	$posts_per_page = wpo_theme_options('woo-number-product-single',6);
	if ( sizeof( $upsells ) == 0 ) return;

	$meta_query = WC()->query->get_meta_query();

	$args = array(
		'post_type'           => 'product',
		'ignore_sticky_posts' => 1,
		'no_found_rows'       => 1,
		'posts_per_page'      => $posts_per_page,
		'orderby'             => $orderby,
		'post__in'            => $upsells,
		'post__not_in'        => array( $product->id ),
	'meta_query'          => WC()->query->get_meta_query()
	);
	$_count =1;
	$products = new WP_Query( $args );

	$columns_count = wpo_theme_options('product-number-columns',3);
	$class_column = 'col-sm-' . floor( 12/$columns_count );
	$woocommerce_loop['columns'] = $columns;

	if ( $products->have_posts() ) : ?>

		<div class="widget widget-products upsells products product-single">
			<div class="background"></div>
			<h3 class="widget-title visual-title">
		        <span><?php _e( 'You may also like&hellip;', 'unity' ) ?></span>
			</h3>
			<div class="woocommerce">
				<div class="widget-content <?php echo isset($style)? esc_attr($style): ''; ?>">
					<?php wc_get_template( 'widget-products/carousel.php' , array( 'loop'=>$products,'columns_count'=>$columns_count,'class_column'=>$class_column,'posts_per_page'=>$posts_per_page ) ); ?>
				</div>
			</div>
		</div>

	<?php endif;

	wp_reset_postdata();
}