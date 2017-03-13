<?php 

/**
 * The template for displaying product widget entries
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you (the theme developer).
 * will need to copy the new files to your theme to maintain compatibility. We try to do this.
 * as little as possible, but it does happen. When this occurs the version of the template file will.
 * be bumped and the readme will list any important changes.
 *
 * @see 	http://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.1
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product; ?>

<?php
	$class=$attrs='';
	if(isset($animate) && $animate){
		$class= 'wow fadeInUp';
		//$attrs = 'data-wow-duration="0.6s" data-wow-delay="'.$delay.'ms"';
	}
?>

<div class="media product-block widget-product <?php echo $class; ?> <?php echo (isset($item_order) && ($item_order%2)) ?'first':'last'; ?>" <?php echo $attrs; ?>>
	<?php if((isset($item_order) && $item_order==1) || !isset($item_order)) : ?>
		<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>" title="<?php echo esc_attr( $product->get_title() ); ?>" class="image pull-left">
			<?php echo $product->get_image(); ?>
			<?php if(isset($item_order) && $item_order==1) { ?> 
				<span class="first-order"><?php echo $item_order; ?></span>
			<?php } ?>
		</a>
	<?php endif; ?>
	<?php if(isset($item_order) && $item_order > 1){ ?>
		<div class="order"><span><?php echo $item_order; ?></span></div>
	<?php }?>
	<div class="media-body">
		<h3 class="name">
			<a href="<?php echo esc_url( get_permalink( $product->id ) ); ?>"><?php echo $product->get_title(); ?></a>
		</h3>

		<div class="rating clearfix">
            <?php if ( ! empty( $show_rating ) ){
            	if($rating_html = $product->get_rating_html()){
            		echo $product->get_rating_html();
            	}else{
            		echo '<div class="star-rating"></div>';
            	}
            } ?>
        </div>

		<div class="price"><?php echo wpo_price($product->get_price_html()); ?></div>
	</div>
</div>


