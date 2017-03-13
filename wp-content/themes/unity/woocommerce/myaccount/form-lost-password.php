<?php
/**
 * Lost password form
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version  2.6.1
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
?>

<?php wc_print_notices(); ?>

<form method="post" class="lost_reset_password">

	<?php if( 'lost_password' == $args['form'] ) : ?>

        <p><?php echo apply_filters( 'woocommerce_lost_password_message', __( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'unity' ) ); ?></p>

        <p class="form-group">
            <label for="user_login"><?php _e( 'Username or email', 'unity' ); ?></label>
            <input class="input-text form-control" type="text" name="user_login" id="user_login" />
        </p>

	<?php else : ?>

        <p><?php echo apply_filters( 'woocommerce_reset_password_message', __( 'Enter a new password below.', 'unity') ); ?></p>

        <p class="form-group form-row-first">
            <label for="password_1"><?php _e( 'New password', 'unity' ); ?> <span class="required">*</span></label>
            <input type="password" class="input-text form-control" name="password_1" id="password_1" />
        </p>
        <p class="form-group form-row-last">
            <label for="password_2"><?php _e( 'Re-enter new password', 'unity' ); ?> <span class="required">*</span></label>
            <input type="password" class="input-text form-control" name="password_2" id="password_2" />
        </p>

        <input type="hidden" name="reset_key" value="<?php echo isset( $args['key'] ) ? $args['key'] : ''; ?>" />
        <input type="hidden" name="reset_login" value="<?php echo isset( $args['login'] ) ? $args['login'] : ''; ?>" />

    <?php endif; ?>

    <!--<div class="clear"></div>-->

    <p class="form-group">
	<input type="hidden" name="wc_reset_password" value="true" />
        <input type="submit" class="button" value="<?php echo 'lost_password' == $args['form'] ? __( 'Reset Password', 'unity' ) : __( 'Save', 'unity' ); ?>" />
    </p>
	<?php wp_nonce_field( $args['form'] ); ?>

</form>