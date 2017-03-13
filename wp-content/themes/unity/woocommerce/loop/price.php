<?php
/**
 * Loop Price
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $product;
?>

<?php if ( $price_html = $product->get_price_html() ) {
	$wpoEngine_price = preg_split("/<ins>/", $price_html);
?>
<?php if(count($wpoEngine_price) > 1) { ?>
	<div class="price old-price">
		<?php if(isset($wpoEngine_price[1])) echo ('<ins>' . $wpoEngine_price[1]); ?>
		<?php if(isset($wpoEngine_price[0])) echo ($wpoEngine_price[0]); ?>
	</div>
	<?php }else{ ?>
	<div class="price"><?php echo $price_html; ?></div>
	<?php } ?>

<?php }else{ 
	echo '<div class="price empty"><span class="amount"></span></div>';
}?>

