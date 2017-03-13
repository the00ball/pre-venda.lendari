<?php
//auto add footer type in visual composer
function wpo_set_visual_composer_post_type(){
 if($options = get_option('wpb_js_content_types')){
    $check = true;
    foreach ($options as $key => $value) {
      if($value=='footer') $check=false;
    }
    if($check)
      $options[] = 'footer';
  }else{
    $options = array('page','footer');
  }
  update_option( 'wpb_js_content_types',$options );
}
add_action('init','wpo_set_visual_composer_post_type',100);

  // enabling theme support for title tag
  function wpo_theme_slug_setup() {
     add_theme_support( "title-tag" );
  }
  add_action( 'after_setup_theme', 'wpo_theme_slug_setup' );


function wpo_header_style(){
    $text_color = get_header_textcolor();
    return ;
}



/**
 * Display an optional post thumbnail.
 *
 * Wraps the post thumbnail in an anchor element on index
 * views, or a div element when on single views.
 *
 * @since Twenty Fourteen 1.0
 */
function wpo_post_thumbnail() {
  
  if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
    return;
  }

  if ( is_singular() ) :
  ?>
  <div class="post-thumbnail">
  <?php
    if ( ( ! is_active_sidebar( 'sidebar-2' ) || is_page_template( 'template-fullwidth.php' ) ) ) {
      the_post_thumbnail( 'fullwidth' );
    } else {
      the_post_thumbnail();
    }
  ?>
  </div>
  <?php else : ?>
  <a class="post-thumbnail" href="<?php the_permalink(); ?>">
  <?php
    if ( ( ! is_active_sidebar( 'sidebar-2' ) || is_page_template( 'template-fullwidth.php' ) ) ) {
      the_post_thumbnail( 'fullwidth' );
    } else {
      the_post_thumbnail();
    }
  ?>
  </a>

  <?php endif; // End is_singular()
}


/**
 * Print HTML with meta information for the current post-date/time and author.
 *
 * @since Twenty Fourteen 1.0
 */
function wpo_posted_on() {
  if ( is_sticky() && is_home() && ! is_paged() ) {
    echo '<span class="featured-post">' . __( 'Sticky', 'unity' ) . '</span>';
  }

  // Set up and print post meta information.
  printf( '<span class="entry-date"><a href="%1$s" rel="bookmark"><time class="" datetime="%2$s">%3$s</time></a></span><span class="meta-sep"> / </span><span class="byline"><span class="author vcard"><a class="url fn n" href="%4$s" rel="author">%5$s</a></span></span>',
    esc_url( get_permalink() ),
    esc_attr( get_the_date( 'c' ) ),
    esc_html( get_the_date() ),
    esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
    get_the_author()
  );
}
 

/**
 * Find out if blog has more than one category.
 *
 * @since Twenty Fourteen 1.0
 *
 * @return boolean true if blog has more than 1 category
 */
function wpo_categorized_blog() {
  if ( false === ( $all_the_cool_cats = get_transient( 'wpo_category_count' ) ) ) {
    // Create an array of all the categories that are attached to posts
    $all_the_cool_cats = get_categories( array(
      'hide_empty' => 1,
    ) );

    // Count the number of categories that are attached to the posts
    $all_the_cool_cats = count( $all_the_cool_cats );

    set_transient( 'wpo_category_count', $all_the_cool_cats );
  }

  if ( 1 !== (int) $all_the_cool_cats ) {
    // This blog has more than 1 category so wpo_categorized_blog should return true
    return true;
  } else {
    // This blog has only 1 category so wpo_categorized_blog should return false
    return false;
  }
}

/**
 * Get template part (for templates like the shop-loop).
 *
 * @access public
 * @param mixed $slug
 * @param string $name (default: '')
 * @return void
 */
function wpo_get_template_part( $slug, $name = '' ) {
	$template = '';

	// Look in yourtheme/slug-name.php and yourtheme/woocommerce/slug-name.php
	if ( $name ) {
		$template = locate_template( array( "{$slug}-{$name}.php", WC()->template_path() . "{$slug}-{$name}.php" ) );
	}

	// Get default slug-name.php
	if ( ! $template && $name && file_exists( WC()->plugin_path() . "/templates/{$slug}-{$name}.php" ) ) {
		$template = WC()->plugin_path() . "/templates/{$slug}-{$name}.php";
	}

	// If template file doesn't exist, look in yourtheme/slug.php and yourtheme/woocommerce/slug.php
	if ( ! $template ) {
		$template = locate_template( array( "{$slug}.php", WC()->template_path() . "{$slug}.php" ) );
	}

	// Allow 3rd party plugin filter template file from their plugin
	$template = apply_filters( 'wc_get_template_part', $template, $slug, $name );

	if ( $template ) {
		load_template( $template, false );
	}
}

/**
 *
 */
function wpo_get_categories( $category ) {
	$categories = get_categories( array( 'taxonomy' => $category ));

	$output = array( '' => __( 'All', 'unity' ) );
	foreach( $categories as $cat ){
		if( is_object($cat) ) $output[$cat->slug] = $cat->name;
	}
	return $output;
}

///// Define  list of function processing theme logics.
function wpo_vc_shortcode_render( $atts, $content='' , $tag='' ){
	$output = '';
	if(is_file( WPO_FRAMEWORK_TEMPLATES_PAGEBUILDER. $tag.'.php')){
		ob_start();
		require( WPO_FRAMEWORK_TEMPLATES_PAGEBUILDER.$tag.'.php' );
		$output .= ob_get_clean();
	}
	return $output;
}
/// //
if(wpo_theme_options('is-effect-scroll','1')=='1'){
    add_filter('body_class', 'wpo_animate_scroll');
    function wpo_animate_scroll($classes){
    $classes[] = 'wpo-animate-scroll';
        return $classes;
    }
}


add_filter('body_class', 'wpo_body_class');
function wpo_body_class( $classes ){
  foreach ( $classes as $key => $value ) {
      if ( $value == 'boxed' || $value == 'default' ) 
        unset( $classes[$key] );
  }
  $classes[] = wpo_theme_options('configlayout');
  return $classes;
}


if(function_exists('PostRatings')){
  add_action( 'wpo_rating', 'wpo_vote_count' );
  function wpo_vote_count(){
    $options = PostRatings()->getRating(get_the_ID());
    $classRating = "vote-default";
    if(isset($options['bayesian_rating']) && $options['bayesian_rating']>0 ){
      if(85<$options['bayesian_rating'] && $options['bayesian_rating'] <=100){
        $classRating = "vote-perfect";
      }
      if(75<$options['bayesian_rating'] && $options['bayesian_rating'] <=85){
        $classRating = "vote-good";
      }
      if(65<$options['bayesian_rating'] && $options['bayesian_rating'] <=75){
        $classRating = "vote-average";
      }
      if(55<$options['bayesian_rating'] && $options['bayesian_rating'] <=65){
        $classRating = "vote-bad";
      }
      if(0<$options['bayesian_rating'] && $options['bayesian_rating'] <=55){
        $classRating = "vote-poor";
      }
  ?>
  <?php
    $result_ratings = number_format((float)$options['bayesian_rating']/10,1,'.','');

  ?>
      <div class="entry-vote <?php echo trim( $classRating ); ?>"><span class="entry-vote-inner"><?php echo trim( $result_ratings ); ?></span></div>
  <?php
    }
  }
}


/*
** Search With Category
*/

if(!function_exists('wpo_categories_searchform')){
    function wpo_categories_searchform(){
        if(class_exists('WooCommerce')){
        	global $wpdb;
			$dropdown_args = array(
                'show_counts'        => false,
                'hierarchical'       => true,
                'show_uncategorized' => 0
            );
        ?>
		<form role="search" method="get" class="input-group search-category" action="<?php echo esc_url( home_url('/') ); ?>">
            <div class="input-group-addon search-category-container">
            	<label class="select">
            		<?php wc_product_dropdown_categories( $dropdown_args ); ?>
            	</label>
            </div>
            <input name="s" id="s" maxlength="60" class="form-control search-category-input" type="text" size="20" placeholder="Enter search...">
            <div class="input-group-btn">
                <label class="btn btn-link btn-search">
                  <span id="wpo-title-search" class="title-search hidden"><?php _e('Search', 'unity') ?></span>
                  <input type="submit" id="searchsubmit" class="fa searchsubmit" value="&#xf002;"/>
                </label>
                <input type="hidden" name="post_type" value="product"/>
            </div>
        </form>
        <?php
        }else{
        	get_search_form();
        }
    }
}

/*
** Pagination Navigation
*/

if(!function_exists('wpo_pagination_nav')){
    function wpo_pagination_nav($per_page,$total,$max_num_pages=''){
        ?>
        <section class="wpo-pagination">
            <?php global  $wp_query;?>
            <?php wpo_pagination($prev = __('Previous','unity'), $next = __('Next','unity'), $pages=$max_num_pages ,array('class'=>'pull-left')); ?>
            <div class="result-count pull-right">
                <?php
                $paged    = max( 1, $wp_query->get( 'paged' ) );
                $first    = ( $per_page * $paged ) - $per_page + 1;
                $last     = min( $total, $per_page * $paged );


                if ( 1 == $total ) {
                    _e( 'Showing the single result', 'unity' );
                } elseif ( $total <= $per_page || -1 == $per_page ) {
                    printf( __( 'Showing all %d results', 'unity' ), $total );
                } else {
                    printf( _x( 'Showing %1$d to %2$d of %3$d results', '%1$d = first, %2$d = last, %3$d = total', 'unity' ), $first, $last, $total );
                }
                ?>
            </div>
        </section>
    <?php
    }
}


if ( !function_exists( 'wpo_print_style_footer' ) ) {
  function wpo_print_style_footer(){
    $footer = wpo_theme_options('footer-style','default');
    if($footer!='default'){
    $shortcodes_custom_css = get_post_meta( $footer, '_wpb_shortcodes_custom_css', true );
      if ( ! empty( $shortcodes_custom_css ) ) {
        echo '<style>
              '.$shortcodes_custom_css.'
            </style>
          ';
      }
    }
  }
}
add_action('wp_head','wpo_print_style_footer', 18);
 

if(!function_exists('wpo_add_extra_fields_menu_config')){
    add_action( 'wpo_megamenu_item_config' , 'wpo_add_extra_fields_menu_config' );
    function wpo_add_extra_fields_menu_config($item){
        $item_id = esc_attr( $item->ID );
    ?>
        <p class="field-addclass description description-wide">
            <label for="edit-menu-item-text_customize-<?php echo esc_attr( $item_id ); ?>">
                <?php  echo __( 'Text customize', 'unity' ); ?><br />
                <select name="menu-item-text_customize[<?php echo esc_attr( $item_id ); ?>]">
                  <option value="text_new" <?php selected( esc_attr($item->text_customize), 'text_new' ); ?>><?php _e('New', 'unity'); ?></option>
                  <option value="text_hot" <?php selected( esc_attr($item->text_customize), 'text_hot' ); ?>><?php _e('Hot', 'unity'); ?></option>
                  <option value="text_featured" <?php selected( esc_attr($item->text_customize), 'text_featured' ); ?>><?php _e('Featured', 'unity'); ?></option>
                  <option value="" <?php selected( esc_attr($item->text_customize), '' ); ?>><?php _e('None', 'unity'); ?></option>
                </select>
            </label>
        </p>
    <?php
    }
}

if(!function_exists('wpo_custom_nav_update')){
    add_action('wp_update_nav_menu_item', 'wpo_custom_nav_update',10, 3);
    function wpo_custom_nav_update($menu_id, $menu_item_db_id, $args ) {
      if(!isset($_POST['menu-item-text_customize'][$menu_item_db_id])){
          $_POST['menu-item-text_customize'][$menu_item_db_id] = "";
      }
      $custom_value = $_POST['menu-item-text_customize'][$menu_item_db_id];
      update_post_meta( $menu_item_db_id, 'text_customize', $custom_value );
    }
}

/*
 * Adds value of new field to $item object that will be passed to     Walker_Nav_Menu_Edit_Custom
 */

if(!function_exists('wpo_custom_nav_item')){
    add_filter( 'wp_setup_nav_menu_item','wpo_custom_nav_item' );
    function wpo_custom_nav_item($menu_item) {
        $menu_item->text_customize = get_post_meta( $menu_item->ID, 'text_customize', true );
        return $menu_item;
    }
}

if(!function_exists('wpo_custom_nav_edit_walker')){
    add_filter( 'wp_edit_nav_menu_walker', 'wpo_custom_nav_edit_walker',10,2 );
    function wpo_custom_nav_edit_walker($walker,$menu_id) {
        return 'WPO_Megamenu_Config';
    }
}

if(!function_exists('wpo_comment_form')){
    function wpo_comment_form($arg,$class='btn-primary'){
      ob_start();
      comment_form($arg);
      $form = ob_get_clean();
      echo str_replace('id="submit"','id="submit" class="btn '.$class.'"', $form);
    }
}

if(!function_exists('wpo_comment_reply_link')){
    function wpo_comment_reply_link($arg,$class='btn btn-default btn-xs'){
      ob_start();
      comment_reply_link($arg);
      $reply = ob_get_clean();
      echo str_replace('comment-reply-link','comment-reply-link '.$class, $reply);
    }
}

if(!function_exists('wpo_renderButtonToggle')){
    function wpo_renderButtonToggle($class='btn-primary btn-xs visible-xs', $toggle='offcanvas'){
    ?>
      <a href="javascript:;"
            data-target=".navbar-collapse"
            data-pos="left" data-effect="<?php echo wpo_theme_options('magemenu-offcanvas-effect','off-canvas-effect-1'); ?>"
            data-nav="#wpo-off-canvas"
            data-toggle="<?php echo esc_attr( $toggle ); ?>"
            class="navbar-toggle off-canvas-toggle <?php echo esc_attr( $class ); ?>">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
        </a>
    <?php
    }
}

if ( !function_exists( 'wpo_theme_options' ) ) {
  function wpo_theme_options( $name, $default = false ) {
    $config = get_option( 'wpo_theme_options' );

    if ( ! isset( $config['id'] ) ) {
      return $default;
    }

    $options = get_option( $config['id'] );

    if ( isset( $options[$name] ) ) {
      return $options[$name];
    }

    return $default;
  }
}


if(!function_exists('wpo_price')){
    function wpo_price($html){
      $tmp = '';
      if ( $html ) {
        $wpoEngine_price = preg_split("/<ins>/", $html);
        if(count($wpoEngine_price) > 1) { 
          $tmp .= '<div class="price old-price"> ';
          if(isset($wpoEngine_price[1])) $tmp .= '<ins>' . $wpoEngine_price[1]; 
          if(isset($wpoEngine_price[0])) $tmp .= $wpoEngine_price[0];
          $tmp .= '</div>';
        }else{ 
          $tmp = '<div class="price">'. $html .'</div>';
        }
      }
      return $tmp;
    }
}
 
if ( is_admin() && isset($_GET['activated'] ) && $pagenow == 'themes.php' ) {
  $menus = get_terms( 'nav_menu', array( 'hide_empty' => true ) ); 
  $locations = get_theme_mod('nav_menu_locations');
  if(!$locations['mainmenu'] && isset($menus[0]->term_id)){
    $locations['mainmenu'] = $menus[0]->term_id;
  }
  set_theme_mod( 'nav_menu_locations', $locations );
}

// Add html to wp_footer()
function wpo_returntop_footer() { ?>
  <div class="return-top">
    <span class="fa fa-angle-up">&nbsp;</span>
    <span><?php echo __('TOP', 'unity') ?></span>
  </div>
<?php }
add_action( 'wp_footer', 'wpo_returntop_footer' );

//gallery customize

// Custom filter function to modify default gallery shortcode output
function wpo_post_gallery( $output, $attr ) {

  // Initialize
  global $post, $wp_locale;

  // Gallery instance counter
  static $instance = 0;
  $instance++;

  // Validate the author's orderby attribute
  if ( isset( $attr['orderby'] ) ) {
    $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
    if ( ! $attr['orderby'] ) unset( $attr['orderby'] );
  }

  // Get attributes from shortcode
  extract( shortcode_atts( array(
    'order'      => 'ASC',
    'orderby'    => 'menu_order ID',
    'id'         => $post->ID,
    'itemtag'    => 'div',
    'icontag'    => 'div',
    'captiontag' => 'div',
    'columns'    => 3,
    'size'       => 'fullwidth',
    'include'    => '',
    'exclude'    => ''
  ), $attr ) );

  // Initialize
  $id = intval( $id );
  $attachments = array();
  if ( $order == 'RAND' ) $orderby = 'none';

  if ( ! empty( $include ) ) {

    // Include attribute is present
    $include = preg_replace( '/[^0-9,]+/', '', $include );
    $_attachments = get_posts( array( 'include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );

    // Setup attachments array
    foreach ( $_attachments as $key => $val ) {
      $attachments[ $val->ID ] = $_attachments[ $key ];
    }

  } else if ( ! empty( $exclude ) ) {

    // Exclude attribute is present 
    $exclude = preg_replace( '/[^0-9,]+/', '', $exclude );

    // Setup attachments array
    $attachments = get_children( array( 'post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
  } else {
    // Setup attachments array
    $attachments = get_children( array( 'post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby ) );
  }

  if ( empty( $attachments ) ) return '';

  // Filter gallery differently for feeds
  if ( is_feed() ) {
    $output = "\n";
    foreach ( $attachments as $att_id => $attachment ) $output .= wp_get_attachment_link( $att_id, $size, true ) . "\n";
    return $output;
  }

  // Filter tags and attributes
  $itemtag = tag_escape( $itemtag );
  $captiontag = tag_escape( $captiontag );
  $columns = intval( $columns );
  $itemwidth = $columns > 0 ? floor( 100 / $columns ) : 100;
  $float = is_rtl() ? 'right' : 'left';
  $selector = "gallery-{$instance}";

  // Filter gallery CSS
  $output = apply_filters( 'gallery_style', "
    
    <!-- see gallery_shortcode() in wp-includes/media.php -->
    <div id='carousel-$selector' class='gallery galleryid-{$id} carousel slide' data-ride='carousel'>
    <div class='carousel-inner' role='listbox'>"
  );

  // Iterate through the attachments in this gallery instance
  $i = 0;
  foreach ( $attachments as $id => $attachment ) {

    // Attachment link
    $link = isset( $attr['link'] ) && 'file' == $attr['link'] ? wp_get_attachment_link( $id, $size, false, false ) : wp_get_attachment_link( $id, $size, true, false ); 

    // Start itemtag
    $class_active = ($i==0)? ' active': '';
    $output .= "<{$itemtag} class='item ".$class_active."'>";

    // icontag
    $output .= "
    <{$icontag} class='gallery-icon'>
      $link
    </{$icontag}>";

    if ( $captiontag && trim( $attachment->post_excerpt ) ) {

      // captiontag
      $output .= "
      <{$captiontag} class='gallery-caption'>
        " . wptexturize($attachment->post_excerpt) . "
      </{$captiontag}>";

    }

    // End itemtag
    $output .= "</{$itemtag}>";
    $i++;

  }

  // End gallery output
  $output .= '
  </div>
      <a class="left carousel-control" href="#carousel-'.$selector.'" role="button" data-slide="prev">
        <span class="fa fa-angle-left"></span>
      </a>
      <a class="right carousel-control" href="#carousel-'.$selector.'" role="button" data-slide="next">
        <span class="fa fa-angle-right"></span>
      </a>
  </div>';

  return $output;

}

// Apply filter to default gallery shortcode
add_filter( 'post_gallery', 'wpo_post_gallery', 10, 2 );

//Social counter

//twitter counter
function wpo_twitter_count( $user ){
    return '<script type="text/javascript" language="javascript" src="http://twittercounter.com/widget/index.php?username=' . esc_js( $user ) . '"></script>';

}

//googleplus counter
function wpo_googleplus_count( $username, $apikey ) {
  if( !empty( $username) && !empty( $apikey)){
    $google = @file_get_contents( 'https://www.googleapis.com/plus/v1/people/' . $username . '?key=' . $apikey );
    if($google)
        return json_decode( $google ) -> circledByCount;
      else
        return 0;
  }else
    return 0;  
}


//Facebook social counter
function wpo_fb_get_counter($url){
  // Query in FQL
  $api_url = 'https://www.facebook.com/' . $url;
  $fql  = "SELECT like_count ";
  $fql .= " FROM link_stat WHERE url = '$api_url'";

  $fqlURL = "https://api.facebook.com/method/fql.query?format=json&query=" . urlencode($fql);

  // Facebook Response is in JSON
  $response = file_get_contents($fqlURL);
  $response = json_decode($response);
  if(is_array($response) && isset($response[0]->like_count)){
      return $response[0]->like_count;    
  }else{
      return 0;
  }
  
}