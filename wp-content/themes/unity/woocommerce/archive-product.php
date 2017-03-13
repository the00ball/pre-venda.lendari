<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

?>

	<?php
		/**
		 * woocommerce_before_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
		 * @hooked woocommerce_breadcrumb - 20
		 */
		do_action( 'woocommerce_before_main_content' );
	?>
    <section class="wpo-content-product content-product">
    <div class="container">
        <div class="row">
            <?php get_sidebar( 'shop-left' );  ?>
            <section class="<?php echo esc_attr( $config['main']['class'] ); ?>">
                <div id="wpo-main-content" class="wpo-content">
                    <?php wc_get_template_part( 'content', 'archive-product' ); ?>
                </div>
            </section>

            
            <?php get_sidebar( 'shop-right' ); ?>
        </div>
    </div>
    </section>
<?php
/**
 * woocommerce_after_main_content hook
 *
 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
 */
do_action( 'woocommerce_after_main_content' );
?>