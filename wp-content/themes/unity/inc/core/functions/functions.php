<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     Opal  Team <opalwordpressl@gmail.com >
 * @copyright  Copyright (C) 2014 wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/support/forum.html
 */
function wpo_get_template( $template_name, $args = array() ) {
    $url = get_template_directory().'/templates/';

    $located = $url . $template_name;

    if ( ! file_exists( $located ) ) {
        return;
    }
    if ( $args && is_array( $args ) ) {
        extract( $args );
    }
    include( $located );

}

//update function wpo_related_post for $taxonomy
if(!function_exists('wpo_related_post')){
    function wpo_related_post( $relate_count = 4, $posttype = 'post', $taxonomy = 'category', $style = '' ){
      
        $terms = get_the_terms( get_the_ID(), $taxonomy );
        $termids =array();

        if($terms){
            foreach($terms as $term){
                $termids[] = $term->term_id;
            }
        }

        $args = array(
            'post_type' => $posttype,
            'posts_per_page' => $relate_count,
            'post__not_in' => array( get_the_ID() ),
            'tax_query' => array(
                'relation' => 'AND',
                array(
                    'taxonomy' => $taxonomy,
                    'field' => 'id',
                    'terms' => $termids,
                    'operator' => 'IN'
                )
            )
        );
        $template_name = $style.'related_'.$posttype.'.php';

        $relates = new WP_Query( $args );

        if(is_file(WPO_FRAMEWORK_TEMPLATES.$template_name)) {
            include(WPO_FRAMEWORK_TEMPLATES.$template_name);
        }
    }
}

if(!function_exists('wpo_getAgo')){
    function wpo_getAgo($timestamp){
    	// return $timestamp;
    	$timestamp = strtotime($timestamp);
    	$difference = time() - $timestamp;

        if ($difference < 60) {
            return $difference.__(" seconds ago",'unity');
        } else {
            $difference = round($difference / 60);
        }

        if ($difference < 60) {
            return $difference.__(" minutes ago",'unity');
        } else {
            $difference = round($difference / 60);
        }

        if ($difference < 24) {
            return $difference.__(" hours ago",'unity');
        }
        else {
            $difference = round($difference / 24);
        }

        if ($difference < 7) {
            return $difference.__(" days ago",'unity');
        } else {
            $difference = round($difference / 7);
            return $difference.__(" weeks ago",'unity');
        }
    }
}

if(!function_exists('wpo_excerpt')){
    //Custom Excerpt Function
    function wpo_excerpt($limit,$afterlimit='[...]') {
        $excerpt = get_the_excerpt();
        if( $excerpt != ''){
    	   $excerpt = explode(' ', strip_tags( $excerpt ), $limit);
        }else{
            $excerpt = explode(' ', strip_tags(get_the_content( )), $limit);
        }
    	if (count($excerpt)>=$limit) {
    		array_pop($excerpt);
    		$excerpt = implode(" ",$excerpt).' '.$afterlimit;
    	} else {
    		$excerpt = implode(" ",$excerpt);
    	}
    	$excerpt = preg_replace('`[[^]]*]`','',$excerpt);
    	return strip_shortcodes( $excerpt );
    }
}

if(!function_exists('wpo_theme_comment')){
    function wpo_theme_comment($comment, $args, $depth){
    	if(is_file(WPO_FRAMEWORK_TEMPLATES.'list_comments.php')){
    		require (WPO_FRAMEWORK_TEMPLATES.'list_comments.php');
    	}
    }
}

if(!function_exists('wpo_thumbnail_url')){
    //Get thumbnail url
    function wpo_thumbnail_url($size){
        global $post;
        //$url = wp_get_attachment_url( get_post_thumbnail_id(get_the_ID()),$size );
        if($size==''){
            $url = wp_get_attachment_url( get_post_thumbnail_id($post->ID) );
             return $url;
        }else{
            $url = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), $size);
             return $url[0];
        }
    }
}

if(!function_exists('wpo_get_pageconfig')){
    // page Configuration
    function wpo_get_pageconfig(){ die('page config here');
    	global $wp_query;
    	$pageconfig = get_post_meta($wp_query->get_queried_object_id(),'wpo_pageconfig',true);
    	$lt = (!empty($pageconfig['page_layout']) ||$pageconfig['page_layout']!= '' )?$pageconfig['page_layout']:'0-1-0';
    	$maincontent = array();
    	$config = array();
    	$config['breadcrumb']=$pageconfig['breadcrumb'];
    	$config['right-sidebar']['widget']=$pageconfig['right_sidebar'];
    	$config['left-sidebar']['widget']=$pageconfig['left_sidebar'];
    	$config['showtitle']= $pageconfig['showtitle'];
    	$obj = new WPO_Template();
    	$config = $obj->configLayout($lt,$config);
    	return $config;
    }
}

if(!function_exists('wpo_pagination')){
    //page navegation
    function wpo_pagination($prev = 'Prev', $next = 'Next', $pages='' ,$args=array('class'=>'')) {
        global $wp_query, $wp_rewrite;
        $wp_query->query_vars['paged'] > 1 ? $current = $wp_query->query_vars['paged'] : $current = 1;
        if($pages==''){
            global $wp_query;
             $pages = $wp_query->max_num_pages;
             if(!$pages)
             {
                 $pages = 1;
             }
        }
        $pagination = array(
            'base' => @add_query_arg('paged','%#%'),
            'format' => '',
            'total' => $pages,
            'current' => $current,
            'prev_text' => $prev,
            'next_text' => $next,
            'type' => 'array'
        );

        if( $wp_rewrite->using_permalinks() )
            $pagination['base'] = user_trailingslashit( trailingslashit( remove_query_arg( 's', get_pagenum_link( 1 ) ) ) . 'page/%#%/', 'paged' );

        
        if(isset( $_GET['s'])){
            $cq = $_GET['s'];
            $sq = str_replace(" ", "+", $cq);
        }
        
        if( !empty($wp_query->query_vars['s']) ){
            $pagination['add_args'] = array( 's' => $sq);
        }
        if(paginate_links( $pagination )!=''){
            $paginations = paginate_links( $pagination );
            echo '<ul class="pagination '.esc_attr( $args["class"] ).'">';
                foreach ($paginations as $key => $pg) {
                    echo '<li>'. $pg .'</li>';
                }
            echo '</ul>';
        }
    }
}

if(!function_exists('wpo_makeid')){
    function wpo_makeid($length = 5){
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, strlen($characters) - 1)];
        }
        return $randomString;
    }
}

if(!function_exists('wpo_breadcrumb')){
    function wpo_breadcrumb( $showtitle=true ){
    	if(is_file(WPO_FRAMEWORK_TEMPLATES.'breadcrumb.php')){
    		require (WPO_FRAMEWORK_TEMPLATES.'breadcrumb.php');
    	}
    }
}

 
 
if(!function_exists('wpo_get_post_views')){
    function wpo_get_post_views($postID){
        $count_key = 'wpo_post_views_count';
        $count = get_post_meta($postID, $count_key, true);
        if($count==''){
            delete_post_meta($postID, $count_key);
            add_post_meta($postID, $count_key, '0');
            return 0;
        }
        return $count;
    }
}

if(!function_exists('wpo_string_limit_words')){
    function wpo_string_limit_words($string, $word_limit)
    {
    	$words = explode(' ', $string, ($word_limit + 1));

    	if(count($words) > $word_limit) {
    		array_pop($words);
    	}

    	return implode(' ', $words);
    }
}

if(!function_exists('wpo_share_box')){
    function wpo_share_box( $layout='',$args=array() ){
		$default = array(
			'position' => 'top',
			'animation' => 'true'
			);
		$args = wp_parse_args( (array) $args, $default );
		
		$path = WPO_FRAMEWORK_TEMPLATES.'sharebox';
		if( $layout!='' ){
			$path = $path.'-'.$layout;
		}
		$path .= '.php';

		if( is_file($path) ){
			require($path);
		}
 
    }
}

if(!function_exists('wpo_is_embed')){
    function wpo_is_embed() {
        $postconfig = get_post_meta(get_the_ID(),'wpo_post',true);
        if(!isset($postconfig['embed']) || $postconfig['embed']=='') return false;
        return true;
    }
}

if(!function_exists('wpo_getcontent')){
    function wpo_getcontent( $config ){
        $postconfig = get_post_meta(get_the_ID(),$config['type'],true);
        if( isset($postconfig[$config['format']]) && !empty( $postconfig[$config['format']] ) ) 
            return $postconfig[ $config['format'] ];
        return false;
    }
}

if(!function_exists('wpo_embed')){
    function wpo_embed( $config ) {
        $postconfig = get_post_meta(get_the_ID(),$config['type'],true);
        $content='';
        if(isset($postconfig[$config['format']]))
            $content = wp_oembed_get($postconfig[$config['format']]);
        return $content;
    }
}

if(!function_exists('wpo_embed_render')){
    function wpo_embed_render($link) {
        $content = wp_oembed_get($link);
        return $content;
    }
}

if(!function_exists('wpo_is_link')){
    function wpo_is_link(){
        $postconfig = get_post_meta(get_the_ID(),'wpo_post',true);
        if(!isset($postconfig["link"]) || $postconfig["link"]=='' ) return false;
        return true;
    }
}

if(!function_exists('wpo_is_gallery')){
    function wpo_is_gallery(){
        $galleries = get_post_gallery( get_the_ID(), false );
        if(!isset($galleries['ids']) || $galleries['ids']=='' ) return false;
        return true;
    }
}


if(!function_exists('wpo_gallery')){
    function wpo_gallery($size='full'){
    	$galleries = get_post_gallery( get_the_ID(), false );
        if( !isset($galleries['ids'] ) ){
            return array();
        }
    	$img_ids = explode(",",$galleries['ids']);
    	$output = array();
    	foreach ($img_ids as $key => $id){
    		$img_src = wp_get_attachment_image_src($id,$size);
    		$output[] = $img_src[0];
    	}
    	return $output;
    }
}


/**
 * Get Theme Option Value.
 */
function wpo_theme_options($name, $default = false) {
  
    // get the meta from the database
    $options = ( get_option( 'wpo_theme_options' ) ) ? get_option( 'wpo_theme_options' ) : null;

    // d( $options );
   
    // return the option if it exists
    if ( isset( $options[$name] ) ) {
        return apply_filters( 'wpo_theme_options_$name', $options[ $name ] );
    }
    if( get_option( $name ) ){
        return get_option( $name );
    }
    // return default if nothing else
    return apply_filters( 'wpo_theme_options_$name', $default );
}

function wpo_get_menugroups(){
    $menus = wp_get_nav_menus( );
    $option_menu = array(''=>'---Select Menu---');
    foreach ($menus as $menu) {
        $option_menu[$menu->term_id]=$menu->name;
    }

    return $option_menu;
}

function wpo_format_chat_content( $content ) {
    global $_post_format_chat_ids;

    /* If this is not a 'chat' post, return the content. */
    if ( !has_post_format( 'chat' ) )
        return $content;

    /* Set the global variable of speaker IDs to a new, empty array for this chat. */
    $_post_format_chat_ids = array();

    /* Allow the separator (separator for speaker/text) to be filtered. */
    $separator = apply_filters( 'my_post_format_chat_separator', ':' );

    /* Open the chat transcript div and give it a unique ID based on the post ID. */
    $chat_output = "\n\t\t\t" . '<div id="chat-transcript-' . esc_attr( get_the_ID() ) . '" class="chat-transcript">';

    /* Split the content to get individual chat rows. */
    $chat_rows = preg_split( "/(\r?\n)+|(<br\s*\/?>\s*)+/", $content );

    /* Loop through each row and format the output. */
    foreach ( $chat_rows as $chat_row ) {

        /* If a speaker is found, create a new chat row with speaker and text. */
        if ( strpos( $chat_row, $separator ) ) {

            /* Split the chat row into author/text. */
            $chat_row_split = explode( $separator, trim( $chat_row ), 2 );

            /* Get the chat author and strip tags. */
            $chat_author = strip_tags( trim( $chat_row_split[0] ) );

            /* Get the chat text. */
            $chat_text = trim( $chat_row_split[1] );

            /* Get the chat row ID (based on chat author) to give a specific class to each row for styling. */
            $speaker_id = wpo_format_chat_row_id( $chat_author );

            /* Open the chat row. */
            $chat_output .= "\n\t\t\t\t" . '<div class="chat-row ' . sanitize_html_class( "chat-speaker-{$speaker_id}" ) . '">';

            /* Add the chat row author. */
            $chat_output .= "\n\t\t\t\t\t" . '<div class="chat-author ' . sanitize_html_class( strtolower( "chat-author-{$chat_author}" ) ) . ' vcard"><cite class="fn">' . apply_filters( 'my_post_format_chat_author', $chat_author, $speaker_id ) . '</cite>' . $separator;

            /* Add the chat row text. */
            $chat_output .= "\n\t\t\t\t\t" . '<span class="chat-text">' . str_replace( array( "\r", "\n", "\t" ), '', apply_filters( 'my_post_format_chat_text', $chat_text, $chat_author, $speaker_id ) ) . '</span></div>';

            /* Close the chat row. */
            $chat_output .= "\n\t\t\t\t" . '</div><!-- .chat-row -->';
        }

        /**
         * If no author is found, assume this is a separate paragraph of text that belongs to the
         * previous speaker and label it as such, but let's still create a new row.
         */
        else {

            /* Make sure we have text. */
            if ( !empty( $chat_row ) ) {

                /* Open the chat row. */
                $chat_output .= "\n\t\t\t\t" . '<div class="chat-row ' . sanitize_html_class( "chat-speaker-{$speaker_id}" ) . '">';

                /* Don't add a chat row author.  The label for the previous row should suffice. */

                /* Add the chat row text. */
                $chat_output .= "\n\t\t\t\t\t" . '<div class="chat-text">' . str_replace( array( "\r", "\n", "\t" ), '', apply_filters( 'my_post_format_chat_text', $chat_row, $chat_author, $speaker_id ) ) . '</div>';

                /* Close the chat row. */
                $chat_output .= "\n\t\t\t</div><!-- .chat-row -->";
            }
        }
    }

    /* Close the chat transcript div. */
    $chat_output .= "\n\t\t\t</div><!-- .chat-transcript -->\n";

    /* Return the chat content and apply filters for developers. */
    return $chat_output;
}

function wpo_format_chat_row_id( $chat_author ) {
    global $_post_format_chat_ids;

    /* Let's sanitize the chat author to avoid craziness and differences like "John" and "john". */
    $chat_author = strtolower( strip_tags( $chat_author ) );

    /* Add the chat author to the array. */
    $_post_format_chat_ids[] = $chat_author;

    /* Make sure the array only holds unique values. */
    $_post_format_chat_ids = array_unique( $_post_format_chat_ids );

    /* Return the array key for the chat author and add "1" to avoid an ID of "0". */
    return absint( array_search( $chat_author, $_post_format_chat_ids ) ) + 1;
}
