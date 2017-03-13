<?php
/**
 * The Template for displaying all single products.
 *
 * Override this template by copying it to yourtheme/woocommerce/single-product.php
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
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


	<section class="wpo-single-product content-product">
		<section class="container">
			<section class="row">
			<?php get_sidebar( 'shop-left' );  ?>
				<section class="<?php echo $config['main']['class']; ?>">
					<div class="wpo-content">
						<?php while ( have_posts() ) : the_post(); ?>
							<?php wc_get_template_part( 'content', 'single-product' ); ?>
						<?php endwhile; // end of the loop. ?>
					</div>
				</section>
            <?php get_sidebar( 'shop-right' ); ?>
			
			</section>
		</section>
	</section>


	<?php
		/**
		 * woocommerce_after_main_content hook
		 *
		 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
		 */
		do_action( 'woocommerce_after_main_content' );
	?>
