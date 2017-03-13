<?php

add_theme_support( 'woocommerce');
/////
// Wishlist
add_filter( 'yith_wcwl_button_label',		   'wpo_woocomerce_icon_wishlist'  );
add_filter( 'yith-wcwl-browse-wishlist-label', 'wpo_woocomerce_icon_wishlist_add' );


add_filter('add_to_cart_fragments',				'wpo_woocommerce_header_add_to_cart_fragment' );
add_filter( 'woocommerce_breadcrumb_defaults',  'wpo_woocommerce_breadcrumbs' );

// Out of stock
add_filter('woocommerce_sale_flash', 'wpo_woocommerce_sale_flashmessage', 10, 2);


/////
//remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0);					// breadcrumbs
remove_action( 'woocommerce_sidebar', 			  'woocommerce_get_sidebar', 10);								// sidebar

remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);		// content wrapper begin
remove_action( 'woocommerce_after_main_content',  'woocommerce_output_content_wrapper_end', 10);		// content wrapper end

add_action( 'woocommerce_before_main_content',    'wpo_woocommerce_output_content_wrapper', 10);		// content wrapper begin
add_action( 'woocommerce_after_main_content', 	  'wpo_woocommerce_output_content_wrapper_end', 10);	// content wrapper end


//remove link open and close before button add to cart
remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
    
/// Remove Style Woocommerce
add_filter( 'woocommerce_enqueue_styles', '__return_false' );

function wpo_woocommerce_output_content_wrapper(){ ?>
    <!-- #Content -->
    <section id="wpo-mainbody" class="wpo-mainbody clearfix woocommerce-page">

<?php }


function wpo_woocommerce_output_content_wrapper_end(){
?>
    </section>
    <?php
}
/* ---------------------------------------------------------------------------
 * WooCommerce - Styles
 * --------------------------------------------------------------------------- */
function wpo_woo_styles() {
    $current = wpo_theme_options('skin','default');
    if($current == 'default'){
        $path = WPO_THEME_URI .'/css/woocommerce.css';
    }else{
        $path = WPO_THEME_URI .'/css/skins/'.$current.'/woocommerce.css';
    }
	wp_enqueue_style( 'wpo-woocommerce', $path , 'woocommerce_frontend_styles-css' , WPO_THEME_VERSION, 'all' );
}
add_action( 'wp_enqueue_scripts', 'wpo_woo_styles', 5 );



function wpo_woocomerce_icon_wishlist( $value='' ){
	return '<i class="fa fa-heart-o"></i><span>'.__('Wishlist','unity').'</span>';
}

function wpo_woocomerce_icon_wishlist_add(){
	return '<i class="fa fa-heart-o"></i><span>'.__('Wishlist','unity').'</span>';
}


/*Customise the WooCommerce breadcrumb*/
function wpo_woocommerce_breadcrumbs($array) {
	return array(
        'delimiter'   => ' &#47; ',
        'wrap_before' => '<section id="breadcrumb" class="breadcrumb wpo-breadcrumb"><nav class="container" itemprop="breadcrumb">',
        'wrap_after'  => '</nav></section>',
        'before'      => '',
        'after'       => '',
        'home'        => _x( 'Home', 'breadcrumb', 'unity' )
	);
}

/**
*
*/
function wpo_woocommerce_header_add_to_cart_fragment( $fragments ) {
	global $woocommerce;
    ob_start();
    wpo_cartdropdown();
    $fragments['#cart'] = ob_get_clean();
    return $fragments;
}

/*
* Re-markup html for cart content with bootstrap dropdown
*/

if(!function_exists('wpo_cartdropdown')){
 function wpo_cartdropdown(){
    if(WPO_WOOCOMMERCE_ACTIVED){
        global $woocommerce;
        ?>
            <div id="cart" class="dropdown">
                <span class="text-skin cart-icon">
                    <i class="icon-cart2"></i>
                </span>
                <a class="dropdown-toggle mini-cart" data-toggle="dropdown" aria-expanded="true" role="button" aria-haspopup="true" data-delay="0" href="#" title="<?php _e('View your shopping cart', 'unity'); ?>">
                    <span class="title-cart"><?php _e('My Cart ','unity'); ?></span>
                    <?php echo sprintf(_n(' <span class="mini-cart-items"> %d item </span> ', ' <span class="mini-cart-items"> %d items - </span> ', $woocommerce->cart->cart_contents_count, 'unity'), $woocommerce->cart->cart_contents_count);?> <?php echo trim( $woocommerce->cart->get_cart_total() ); ?>
                </a>
                <div class="dropdown-menu">
                    <?php woocommerce_mini_cart(); ?>
                </div>
            </div>
        <?php
        }
    }
}


/*
 *  Display list of navigations info with list of listin + total, info for woocommerce
 */
function wpo_woocommerce_pagination( $per_page,$total ){
    ?>
    <div class="clearfix">
        <?php wpo_pagination($prev = __('Previous','unity'), $next = __('Next','unity'), $pages='',array('class'=>'pull-left pagination-sm')); ?>
        <?php global  $wp_query; ?>
        <div class="result-count pull-right">
            <?php
            $paged    = max( 1, $wp_query->get( 'paged' ) );
            $first    = ( $per_page * $paged ) - $per_page + 1;
            $last     = min( $total, $wp_query->get( 'posts_per_page' ) * $paged );

            if ( 1 == $total ) {
                _e( 'Showing the single result', 'unity' );
            } elseif ( $total <= $per_page || -1 == $per_page ) {
                printf( __( 'Showing all %d results', 'unity' ), $total );
            } else {
                printf( _x( 'Showing %1$d &ndash; %2$d of %3$d results', '%1$d = first, %2$d = last, %3$d = total', 'unity' ), $first, $last, $total );
            }
            ?>
        </div>
    </div>
<?php
}

/*
 *  Display list of navigations info with list of listin + total, info for woocommerce
 */
function wpo_woocommerce_custom_usermenutop() { ?>
    <ul class="setting-menu">
        <li>
            <a href="<?php echo get_permalink(get_option('woocommerce_myaccount_page_id')); ?>">
                <?php _e('My Account','unity'); ?>
            </a>
        </li>

        <li>
            <a href="<?php echo get_permalink(get_option('woocommerce_checkout_page_id')); ?>">
                <?php _e('Checkout','unity'); ?>
            </a>
        </li>

        <li>
            <a href="<?php echo get_permalink(get_option('woocommerce_cart_page_id')); ?>">
                <?php _e('Cart','unity'); ?>
            </a>
        </li>
    </ul>
<?php }

/* ---------------------------------------------------------------------------
 * WooCommerce - Define image sizes
 * --------------------------------------------------------------------------- */
global $pagenow;
if ( is_admin() && isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) add_action( 'init', 'wpo_woocommerce_image_dimensions', 1 );

function wpo_woocommerce_image_dimensions() {
	$catalog = array(
		'width' 	=> '500',	// px
		'height'	=> '645',	// px
		'crop'		=> 1 		// true
	);

	$single = array(
		'width' 	=> '680',	// px
		'height'	=> '878',	// px
		'crop'		=> 1 		// true
	);

	$thumbnail = array(
		'width' 	=> '200',	// px
		'height'	=> '258',	// px
		'crop'		=> 1 		// true
	);

	// Image sizes
	update_option( 'shop_catalog_image_size', $catalog );		// Product category thumbs
	update_option( 'shop_single_image_size', $single ); 		// Single product image
	update_option( 'shop_thumbnail_image_size', $thumbnail ); 	// Image gallery thumbs
}

/* ---------------------------------------------------------------------------
 * WooCommerce - Function get Query
 * --------------------------------------------------------------------------- */
function wpo_woocommerce_query($type,$post_per_page=-1,$cat=''){
    global $woocommerce;
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => $post_per_page,
        'post_status' => 'publish'
    );
    switch ($type) {
        case 'best_selling':
            $args['meta_key']='total_sales';
            $args['orderby']='meta_value_num';
            $args['ignore_sticky_posts']   = 1;
            $args['meta_query'] = array();
            $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
            $args['meta_query'][] = $woocommerce->query->visibility_meta_query();
            break;
        case 'featured_product':
            $args['ignore_sticky_posts']=1;
            $args['meta_query'] = array();
            $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
            $args['meta_query'][] = array(
                         'key' => '_featured',
                         'value' => 'yes'
                     );
            $query_args['meta_query'][] = $woocommerce->query->visibility_meta_query();
            break;
        case 'top_rate':
            add_filter( 'posts_clauses',  array( $woocommerce->query, 'order_by_rating_post_clauses' ) );
            $args['meta_query'] = array();
            $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
            $args['meta_query'][] = $woocommerce->query->visibility_meta_query();
            break;
        case 'recent_product':
            $args['meta_query'] = array();
            $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
            break;
        case 'on_sale':
            $args['meta_query'] = array();
            $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
            $args['meta_query'][] = $woocommerce->query->visibility_meta_query();
            $args['post__in'] = wc_get_product_ids_on_sale();
            break;
        case 'recent_review':
            if($post_per_page == -1) $_limit = 4;
            else $_limit = $post_per_page;
            global $wpdb;
            $query = "SELECT c.comment_post_ID FROM {$wpdb->prefix}posts p, {$wpdb->prefix}comments c WHERE p.ID = c.comment_post_ID AND c.comment_approved > 0 AND p.post_type = 'product' AND p.post_status = 'publish' AND p.comment_count > 0 ORDER BY c.comment_date ASC";
            $results = $wpdb->get_results($query, OBJECT);
            $_pids = array();
            foreach ($results as $re) {
                if(!in_array($re->comment_post_ID, $_pids))
                    $_pids[] = $re->comment_post_ID;
                if(count($_pids) == $_limit)
                    break;
            }

            $args['meta_query'] = array();
            $args['meta_query'][] = $woocommerce->query->stock_status_meta_query();
            $args['meta_query'][] = $woocommerce->query->visibility_meta_query();
            $args['post__in'] = $_pids;

            break;
    }

    if($cat!=''){
        $args['product_cat']= $cat;
    }
    return new WP_Query($args);
}

/* Out of stock label*/
if ( !function_exists('wpo_woocommerce_sale_flashmessage') ) {
    function wpo_woocommerce_sale_flashmessage($flash){
        global $product;
        $availability = $product->get_availability();

        if ($availability['availability'] == 'Out of stock') :
            $flash = '<span class="out-of-stock-badge onsale">'.__( 'Out of stock', 'unity' ).'</span>';
        endif;
        return $flash;
    }
}

function wpo_print_title(){
    echo ' <h3 class="name"><a href="'; the_permalink(); echo '">'; the_title(); echo'</a></h3>';
}


//Check config show popup add to cart success.
if( wpo_theme_options('wc_cartnotice') ) {
    add_action('init','WPO_jsWoocommerce');
    function WPO_jsWoocommerce(){
        wp_dequeue_script('wc-add-to-cart');
        wp_register_script( 'wc-add-to-cart', WPO_THEME_URI . '/js/add-to-cart.js' , array( 'jquery' ) );
        wp_localize_script('wc-add-to-cart','woocommerce_localize',array(
            'cart_success'=> wpo_theme_options('wc_cartnotice_text', 'Success: Your item has been added to cart!'),
        ));
        wp_enqueue_script('wc-add-to-cart');
        wp_register_script( 'noty_js', WPO_THEME_URI.'/js/jquery.noty.packaged.min.js', array( 'jquery' ) );
        wp_enqueue_script('noty_js');
    }
}
