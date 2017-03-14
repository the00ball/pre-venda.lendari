<?php
/**
 * Shipping Calculator
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.0.8
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

global $woocommerce;

if ( get_option( 'woocommerce_enable_shipping_calc' ) === 'no' || ! WC()->cart->needs_shipping() )
	return;
?>

<?php do_action( 'woocommerce_before_shipping_calculator' ); ?>

<div class="calculator">
	<form class="shipping_calculator" action="<?php echo esc_url( wc_get_cart_url() ); ?>" method="post">

		<h2><a href="#" class="shipping-calculator-button btn btn-outline"><?php _e( 'Calculate Shipping', 'unity' ); ?></a></h2>

		<section class="shipping-calculator-form">

			<div class="form-group form-row-wide">
				<select name="calc_shipping_country" id="calc_shipping_country" class="country_to_state form-control" rel="calc_shipping_state">
					<option value=""><?php _e( 'Select a country&hellip;', 'unity' ); ?></option>
					<?php
						foreach( WC()->countries->get_shipping_countries() as $key => $value )
						echo '<option value="' . esc_attr( $key ) . '"' . selected( WC()->customer->get_shipping_country(), esc_attr( $key ), false ) . '>' . esc_html( $value ) . '</option>';
					?>
				</select>
			</div>

			<div class="form-group form-row-wide">
				<?php
					$current_cc = WC()->customer->get_shipping_country();
					$current_r  = WC()->customer->get_shipping_state();
					$states     = WC()->countries->get_states( $current_cc );

					// Hidden Input
					if ( is_array( $states ) && empty( $states ) ) {

						?><input type="hidden" name="calc_shipping_state" id="calc_shipping_state" placeholder="<?php _e( 'State / county', 'unity' ); ?>" /><?php

					// Dropdown Input
					} elseif ( is_array( $states ) ) {

						?><span>
							<select name="calc_shipping_state" id="calc_shipping_state" placeholder="<?php _e( 'State / county', 'unity' ); ?>">
								<option value=""><?php _e( 'Select a state&hellip;', 'unity' ); ?></option>
								<?php
									foreach ( $states as $ckey => $cvalue )
										echo '<option value="' . esc_attr( $ckey ) . '" ' . selected( $current_r, $ckey, false ) . '>' . esc_html( $cvalue ) .'</option>';
								?>
							</select>
						</span><?php

					// Standard Input
					} else {

						?><input type="text" class="input-text form-control" value="<?php echo esc_attr( $current_r ); ?>" placeholder="<?php _e( 'State / county', 'unity' ); ?>" name="calc_shipping_state" id="calc_shipping_state" /><?php

					}
				?>
			</div>

			<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_city', false ) ) : ?>

				<div class="form-group form-row-wide">
					<input type="text" class="input-text form-control" value="<?php echo esc_attr( WC()->customer->get_shipping_city() ); ?>" placeholder="<?php _e( 'City', 'unity' ); ?>" name="calc_shipping_city" id="calc_shipping_city" />
				</div>

			<?php endif; ?>

			<?php if ( apply_filters( 'woocommerce_shipping_calculator_enable_postcode', true ) ) : ?>

				<div class="form-group form-row-wide">
					<input type="text" class="input-text form-control" value="<?php echo esc_attr( WC()->customer->get_shipping_postcode() ); ?>" placeholder="<?php _e( 'Postcode / Zip', 'unity' ); ?>" name="calc_shipping_postcode" id="calc_shipping_postcode" />
				</div>

			<?php endif; ?>

			<p><button type="submit" name="calc_shipping" value="1" class="btn btn-outline btn-lg"><?php _e( 'Update Totals', 'unity' ); ?></button></p>

			<?php wp_nonce_field( 'woocommerce-cart' ); ?>
		</section>
	</form>
</div>

<?php do_action( 'woocommerce_after_shipping_calculator' ); ?>