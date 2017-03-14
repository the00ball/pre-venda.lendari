<section class="col-md-12">
		<div itemscope itemtype="<?php echo woocommerce_get_product_schema(); ?>" id="product-<?php the_ID(); ?>" <?php post_class(); ?>>
			<div id="single-product" class="product-info">
				<div class="row">
					<div class="col-lg-5 col-md-5 col-sm-5">
						<?php
							/**
							* woocommerce_before_single_product_summary hook
							*
							* @hooked woocommerce_show_product_sale_flash - 10
							* @hooked woocommerce_show_product_images - 20
							*/
							do_action( 'woocommerce_before_single_product_summary' );
						?>
					</div>
					<div class="col-lg-7 col-md-7 col-sm-7">
						<div class="summary entry-summary">
							<?php
								/**
								* woocommerce_single_product_summary hook
								*
								* @hooked woocommerce_template_single_title - 5
								* @hooked woocommerce_template_single_rating - 10
								* @hooked woocommerce_template_single_price - 10
								* @hooked woocommerce_template_single_excerpt - 20
								* @hooked woocommerce_template_single_add_to_cart - 30
								* @hooked woocommerce_template_single_meta - 40
								* @hooked woocommerce_template_single_sharing - 50
								*/
								do_action( 'woocommerce_single_product_summary' );
							?>
						<?php if(wpo_theme_options('wc_show_share_social', false)) : ?>
							<div class="addthis">
								<!-- AddThis Button BEGIN -->
								<div class="addthis_toolbox addthis_default_style">
									<a class="addthis_button_facebook_like" fb:like:layout="button_count"></a>
									<a class="addthis_button_tweet"></a>
									<a class="addthis_button_google_plusone" g:plusone:size="medium"></a>
									<a class="addthis_counter addthis_pill_style"></a>
								</div>
								<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-533e342d186e8c37"></script>
								<!-- AddThis Button END -->
							</div>
						<?php endif; ?>
						</div><!-- .summary -->
					</div>
				</div>
			</div>

	<?php
		/**
		 * woocommerce_after_single_product_summary hook
		 *
		 * @hooked woocommerce_output_product_data_tabs - 10
		 * @hooked woocommerce_upsell_display - 15
		 * @hooked woocommerce_output_related_products - 20
		 */
		do_action( 'woocommerce_after_single_product_summary' );
	?>

	<meta itemprop="url" content="<?php the_permalink(); ?>" />

</div><!-- #product-<?php the_ID(); ?> -->

<?php do_action( 'woocommerce_after_single_product' ); ?>

</section>

<!-- <aside class="wpo-sidebar col-md-3">
	<?php
	/**
	* woocommerce_sidebar hook
	*
	* @hooked woocommerce_get_sidebar - 10
	*/
    //do_action( 'woocommerce_sidebar' );
    ?>
</aside> -->
