<?php

add_action('after_setup_theme', 'wpo_download_setup_theme');
function wpo_download_setup_theme() {
	add_theme_support('appthemer-crowdfunding', apply_filters( 'franklin_crowdfunding_supports', array(
		'campaign-widget'         => true, 
		'campaign-featured-image' => true, 
		'campaign-video'          => true, 
		'anonymous-backers'       => true, 
        'campaign-edit'           => true, 
        'campaign-categories'     => true, 
        'campaign-tags'           => true, 
        'campaign-category'       => true, 
        'campaign-tag'            => true
	)));
}

/**
 * Contribute now list options
 * @return void
**/
function wpo_campaign_contribute_options_custom( $prices, $type, $download_id ) {
	$campaign = atcf_get_campaign( $download_id );
	$uid = wpo_makeid();
?>
	<div class="edd_price_options <?php echo ( $campaign->is_active() ) ? 'active' : 'expired'; ?>" <?php echo ( $campaign->is_donations_only() ) ? 'style="display: none"' : null; ?>>
		<ul>
			<?php foreach ( $prices as $key => $price ) : ?>
				<?php
					$amount  = $price[ 'amount' ];
					$limit   = isset ( $price[ 'limit' ] ) ? $price[ 'limit' ] : '';
					$bought  = isset ( $price[ 'bought' ] ) ? $price[ 'bought' ] : 0;
					$allgone = false;

					if ( $bought == absint( $limit ) && '' != $limit )
						$allgone = true;

					if ( edd_use_taxes() && edd_taxes_on_prices() )
						$amount += edd_calculate_tax( $amount );
				?>
				<li class="atcf-price-option pledge-level <?php echo ( $allgone ) ? 'inactive' : null; ?>"  data-pri="<?php echo edd_sanitize_amount( $amount ); ?>"  data-price="<?php echo edd_sanitize_amount( $amount ); ?>-<?php echo esc_attr( $key ); ?>">
					<div class="clear">
						<h3><label><!-- <label for="<?php echo esc_attr( 'edd_price_option_' . $download_id . '_' . $key ); ?>"> -->
							<?php
								if ( $campaign->is_active() )
									if ( ! $allgone )
										printf(
											'<input type="radio" name="edd_options[price_id][]" id="%1$s" class="%2$s edd_price_options_input" value="%3$s"/>',
											esc_attr( 'edd_price_option_' . $download_id . '_' . $key . '_' . $uid ),
											esc_attr( 'edd_price_option_' . $download_id ),
											esc_attr( $key )
										);
							?>  
							<?php echo edd_currency_filter( edd_format_amount( $amount ) ); ?>
						</label></h3>
						
						<div class="backers hidden">
							<div class="backer-count">
								<i class="icon-user"></i> <?php printf( _n( '1 Backer', '%1$s Backers', $bought, 'unity' ), $bought ); ?>
							</div>
							<?php if ( '' != $limit && ! $allgone ) : ?>
								<small class="limit"><?php printf( __( 'Limit of %d &mdash; %d remaining', 'unity' ), $limit, $limit - $bought ); ?></small>
							<?php elseif ( $allgone ) : ?>
								<small class="gone"><?php _e( 'All gone!', 'unity' ); ?></small>
							<?php endif; ?>
						</div>

					</div>
					<?php //echo wpautop( wp_kses_data( $price[ 'name' ] ) ); ?>
				</li>

			<?php endforeach; ?>
			<li class="price-custom">
				<div class="campaign-price-input">
					<div class="price-wrapper"><span class="title"><?php _e('Amount: ', 'unity'); ?></span><input type="text" name="atcf_custom_price" value="" /></div>
				</div>	
			</li>

		</ul>
	</div><!--end .edd_price_options-->
<?php
}
remove_action( 'atcf_campaign_contribute_options', 'atcf_campaign_contribute_options', 10, 3 );
add_action( 'atcf_campaign_contribute_options', 'wpo_campaign_contribute_options_custom', 10, 3 );

/*
**	Save custom price edd
*/
add_filter('edd_add_to_cart_item', 'wpo_edd_add_to_cart_item_filter');
function wpo_edd_add_to_cart_item_filter($item) {
    if ( !isset($_POST['post_data']))
        return $item;

    parse_str( urldecode( $_POST['post_data'] ), $query_args );

    if ( isset( $query_args['atcf_custom_price'] ) ) {
        $item['options']['custom_price'] = $query_args['atcf_custom_price'];
    }
    return $item;
}

/*
**
*/
add_filter('edd_cart_item_price', 'wpo_edd_cart_item_price_filter', 10, 3);
if(!function_exists('wpo_edd_cart_item_price_filter')){
	function wpo_edd_cart_item_price_filter($price, $item_id, $options) {
	    if ( isset( $options['custom_price']) && $options['custom_price'] != $price )
	        return $options['custom_price'];
	    return $price;        
	}
}

/**
 * Get the login page URL. 
 * 
 * @param string $page
 * @return string|false
 */
function wpo_crowdfunding_get_page_url($page) {
	global $edd_options;
	
	if ( !isset( $edd_options[$page] ) || $edd_options[$page] == 0 )
		return false;

	return get_permalink( $edd_options[$page] );
}


/**
 * Return whether the backer is anonymous.
 * 
 * @param WP_Post $log
 * @return bool
 */
function wpo_crowdfunding_is_backer_anonymous($log) {
	$payment_meta = edd_get_payment_meta( get_post_meta( $log->ID, '_edd_log_payment_id', true ) );
	return $payment_meta['anonymous'];
}

/**
 * Get the payment ID for the log object.
 * 
 * @param WP_Post $log
 * @return int 
 */
function wpo_crowdfunding_get_payment($log) {
	return get_post( get_post_meta( $log->ID, '_edd_log_payment_id', true ) ); 
}

/**
 * Get the avatar for the backer. 
 * 
 * @param WP_Post $backer
 * @param int $size
 * @return string
 */
function wpo_crowdfunding_get_backer_avatar($backer, $size = 115) {
	return get_avatar( edd_get_payment_user_email($backer->ID), $size, '', $backer->post_title );
}

/**
 * Get the backer's location. 
 * 
 * @param WP_Post $backer
 * @return string|void
 */
function wpo_crowdfunding_get_backer_location($backer) {
	$meta = get_post_meta( $backer->ID, '_edd_payment_meta', true );
	if ( !isset( $meta['shipping'] ) ) 
		return;

	return apply_filters('wpo_backer_location', sprintf( "%s, %s", $meta['shipping']['shipping_city'], $meta['shipping']['shipping_country'] ), $meta, $backer );
}

/**
 * Get the backer's pledge amount. 
 * 
 * @param WP_Post $backer
 * @param bool $formatted
 * @return string
 */
function wpo_crowdfunding_get_backer_pledge($backer, $formatted = true) {
	if ( $formatted ) {
		return edd_currency_filter( edd_format_amount( edd_get_payment_amount($backer->ID) ) );
	}

	return edd_get_payment_amount($backer->ID);	
}

/**
 * Display a project's campaign backers. 
 */
if ( !function_exists('wpo_campaign_backers') ) {

	function wpo_campaign_backers( $campaign, $args = array() ) {

		$defaults = array(
			'number'		=> 10,
			'show_location'	=> true,
			'show_pledge'	=> true, 
			'show_name' 	=> true 
		);

		extract( wp_parse_args( $args, $defaults ), EXTR_SKIP );

		$backers = $campaign->backers();

		// Start the buffer 
		ob_start();

		if ( empty( $backers ) ): ?>
			
			<p><?php _e( 'No backers yet. Be the first!', 'unity' ) ?></p>
		
		<?php else :

			$number = count($backers) > $number ? $number : count($backers);		
			?>
			<ul class="row">

			<?php for( $i = 0; $i <= $number; $i++ ) : ?>

				<?php if ( isset( $backers[$i] ) ) : ?>

					<?php $log = $backers[$i] ?>

					<?php if ( ! wpo_crowdfunding_is_backer_anonymous( $log ) ) : ?>

						<?php $backer = wpo_crowdfunding_get_payment($log) ?>

						<li class="campaign-backer col-lg-4 col-md-4 col-sm-12 col-xs-12"> 			

							<?php echo wpo_crowdfunding_get_backer_avatar( $backer ) ?>

							<div class="if-tiny-hide">
								<?php if ( $show_name ) : ?>

									<h6><?php echo esc_html( $backer->post_title ); ?></h6>

								<?php endif ?>

								<?php if ( $show_location || $show_pledge ) : ?>

									<p>
										<?php if ( $show_location ) : ?>

											<?php echo wpo_crowdfunding_get_backer_location( $backer ) ?><br />

										<?php endif ?>

										<?php if ( $show_pledge ) : ?>

											<?php echo wpo_crowdfunding_get_backer_pledge( $backer ) ?>					

										<?php endif ?>

									</p>

								<?php endif ?>
							</div>

						</li>

					<?php endif ?>

				<?php endif ?>
				
			<?php endfor ?>

			</ul>

		<?php endif;

		return apply_filters( 'kuma_campaign_backers', ob_get_clean(), $campaign, $show_location );
	}
}

/*
**	Fields submit
*/
function wpo_field_submit(){
	global $edd_options;
	$min = isset ( $edd_options[ 'atcf_campaign_length_min' ] ) ? $edd_options[ 'atcf_campaign_length_min' ] : 14;
	$max = isset ( $edd_options[ 'atcf_campaign_length_max' ] ) ? $edd_options[ 'atcf_campaign_length_max' ] : 48;
	return array(
		'campaign_heading' => array(
			'label'       => __( 'Campaign Information', 'unity' ),
			'type'        => 'heading',
			'default'     => null,
			'editable'    => true,
			'priority'    => 2
		),
		'title' => array(
			'label'       => __( 'Title', 'unity' ),
			'default'     => null,
			'type'        => 'text',
			'editable'    => false,
			'placeholder' => null,
			'required'    => true,
			'priority'    => 4
		),
		'goal' => array(
			'label'       => sprintf( __( 'Goal (%s)', 'unity' ), edd_currency_filter( '' ) ),
			'default'     => null,
			'type'        => 'text',
			'editable'    => false,
			'placeholder' => edd_format_amount( 800 ),
			'required'    => true,
			'priority'    => 6
		),
		'length' => array(
			'label'       => __( 'Length', 'unity' ),
			'default'     => floor( ( $min + $max ) / 2 ),
			'type'        => 'number',
			'editable'    => false,
			'placeholder' => null,
			'min'         => $min,
			'max'         => $max,
			'step'        => 1,
			'priority'    => 8
		),
		'type' => array(
			'label'       => __( 'Funding Type', 'unity' ),
			'default'     => atcf_campaign_type_default(),
			'type'        => 'radio',
			'options'     => atcf_campaign_types_active(),
			'editable'    => false,
			'placeholder' => null,
			'required'    => true,
			'priority'    => 10
		),
		'category' => array(
			'label'       => __( 'Categories', 'unity' ),
			'default'     => null,
			'type'        => 'term_checklist',
			'editable'    => true,
			'placeholder' => null,
			'priority'    => 12
		),
		'tag' => array(
			'label'       => __( 'Tags', 'unity' ),
			'default'     => null,
			'type'        => 'term_checklist',
			'editable'    => true,
			'placeholder' => null,
			'priority'    => 14
		),
		'image' => array(
			'label'       => __( 'Featured Image', 'unity' ),
			'default'     => null,
			'type'        => 'featured_image',
			'editable'    => true,
			'placeholder' => null,
			'priority'    => 16
		),
		'video' => array(
			'label'       => __( 'Featured Video URL', 'unity' ),
			'default'     => null,
			'type'        => 'text',
			'editable'    => true,
			'placeholder' => null,
			'priority'    => 18
		),
		'description' => array(
			'label'       => __( 'Description', 'unity' ),
			'default'     => null,
			'type'        => 'wp_editor',
			'editable'    => true,
			'placeholder' => null,
			'required'    => true,
			'priority'    => 20
		),
		'updates' => array(
			'label'       => __( 'Updates', 'unity' ),
			'default'     => null,
			'type'        => 'wp_editor',
			'editable'    => 'only',
			'placeholder' => null,
			'priority'    => 22
		),
		'excerpt' => array(
			'label'       => __( 'Excerpt', 'unity' ),
			'default'     => null,
			'type'        => 'textarea',
			'editable'    => true,
			'placeholder' => null,
			'priority'    => 24
		),
		
		'backer_rewards_heading' => array(
			'label'       => __( 'Backer Rewards', 'unity' ),
			'type'        => 'heading',
			'default'     => null,
			'editable'    => true,
			'priority'    => 26
		),
		'physical' => array(
			'label'       => __( 'Collect shipping information on checkout.', 'unity' ),
			'default'     => null,
			'type'        => 'checkbox',
			'editable'    => true,
			'placeholder' => null,
			'priority'    => 28
		),
		'norewards' => array(
			'label'       => __( 'No rewards, donations only.', 'unity' ),
			'default'     => null,
			'type'        => 'checkbox',
			'editable'    => false,
			'placeholder' => null,
			'priority'    => 30
		),
		'rewards' => array(
			'label'       => null,
			'type'        => 'rewards',
			'required'    => false,
			'default'     => null,
			'editable'    => true,
			'priority'    => 32
		),
		'info_heading' => array(
			'label'       => __( 'Your Information', 'unity' ),
			'type'        => 'heading',
			'default'     => null,
			'editable'    => true,
			'priority'    => 34
		),
		'contact_email' => array(
			'label'       => __( 'Contact Email', 'unity' ),
			'default'     => null,
			'type'        => 'text',
			'editable'    => true,
			'placeholder' => null,
			'required'    => true,
			'priority'    => 36
		),
		'organization' => array(
			'label'       => __( 'Name/Organization', 'unity' ),
			'default'     => null,
			'type'        => 'text',
			'editable'    => true,
			'placeholder' => null,
			'priority'    => 38
		),
		'location' => array(
			'label'       => __( 'Location', 'unity' ),
			'default'     => null,
			'type'        => 'text',
			'editable'    => true,
			'placeholder' => null,
			'priority'    => 40
		)
	);
}

function wpo_atcf_wrapper_start_4(){
	echo '<div class="row">';
	echo '<div class="col-md-4 col-sm-12 campaign-submit-column left">';
}
function wpo_atcf_wrapper_start_8(){
	echo '<div class="col-md-8 col-sm-12 campaign-submit-column right">';
}
function wpo_atcf_wrapper_end(){
	echo "</div>";
}
function wpo_atcf_wrapper_end_2(){
	echo "</div></div>";
}
add_action('atcf_shortcode_submit_field_before_title', 'wpo_atcf_wrapper_start_4');
add_action('atcf_shortcode_submit_field_after_video', 'wpo_atcf_wrapper_end');

add_action('atcf_shortcode_submit_field_before_description', 'wpo_atcf_wrapper_start_8');
add_action('atcf_shortcode_submit_field_after_excerpt', 'wpo_atcf_wrapper_end_2');
add_filter( 'atcf_shortcode_submit_fields', 'wpo_field_submit' );
