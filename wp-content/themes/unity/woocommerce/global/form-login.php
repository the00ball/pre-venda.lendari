<?php
/**
 * Login form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.1.0
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if ( is_user_logged_in() ) 
	return;
?>
<form method="post" class="login" <?php if ( $hidden ) echo 'style="display:none;"'; ?>>

	<?php do_action( 'woocommerce_login_form_start' ); ?>

	<?php if ( $message ) echo wpautop( wptexturize( $message ) ); ?>

	<div class="row">
		<div class="col-md-6">
			<div class="form-group">
				<label for="username"><?php _e( 'Username or email', 'unity' ); ?> <span class="required">*</span></label>
				<input type="text" class="input-text form-control" name="username" id="username" />
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="password"><?php _e( 'Password', 'unity' ); ?> <span class="required">*</span></label>
				<input class="input-text form-control" type="password" name="password" id="password" />
			</div>
		</div>
	</div>

	<?php do_action( 'woocommerce_login_form' ); ?>

	<div class="form-group">
		<?php wp_nonce_field( 'woocommerce-login' ); ?>
		<input type="submit" class="button" name="login" value="<?php esc_attr_e( 'Login', 'unity' ); ?>" />
		<input type="hidden" name="redirect" value="<?php echo esc_url( $redirect ) ?>" />
	</div>
	<div class="checkbox">
		<label for="rememberme" class="inline">
			<input name="rememberme" type="checkbox" id="rememberme" value="forever" /> <?php _e( 'Remember me', 'unity' ); ?>
		</label>
	</div>

	<div class="lost_password">
		<a href="<?php echo esc_url( wp_lostpassword_url() ); ?>"><?php _e( 'Lost your password?', 'unity' ); ?></a>
	</div>

	<!--<div class="clear"></div>-->

	<?php do_action( 'woocommerce_login_form_end' ); ?>

</form>