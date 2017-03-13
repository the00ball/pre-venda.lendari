<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     WPOpal  Team <wpopal@gmail.com, support@wpopal.com>
 * @copyright  Copyright (C) 2014 wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/support/forum.html
 */
global $post;
$title = '';
$style = 'background: #F0F0F0 url('.esc_url( get_header_image() ).') no-repeat 0 0;';
?>

<?php
if(in_array("search-no-results",get_body_class())){ ?>
   <div class="breadcrumb" class="col-sm-12">
   <a href="<?php WPO_THEME_URI.'/'; ?>"><span class="fa fa-home"></span><?php echo __('Home', 'unity'); ?></a>
   <span class="delimiter">/</span>
   <span class="current">Search results for "<?php echo get_search_query(); ?>"</span> </div>
<?php
    }else{
    	$delimiter = '<span class="delimiter">/</span>';
        $home = 'Home';
        $before = '<span class="current">';
        $after = '</span> ';
        echo '<section id="breadcrumb" class="breadcrumb wpo-breadcrumb" style="'.esc_attr( $style  ).'"><nav class="container">';
        global $post;
        global $wp_query;
        $homeLink = home_url();
        echo '<a href="' . esc_url( $homeLink ) . '">' . $home . '</a>';
       	
        
        if ( is_category() ) {
	        global $wp_query;
	        $cat_obj = $wp_query->get_queried_object();
	        $thisCat = $cat_obj->term_id;
	        $thisCat = get_category($thisCat);
	        $parentCat = get_category($thisCat->parent);
	        if ($thisCat->parent != 0) echo(get_category_parents($parentCat, TRUE, ' ' . $delimiter . ' '));
	        $title = $before . '' . single_cat_title('', false) . '' . $after;
        } elseif ( is_day() ) {
        	echo ' '.$delimiter.' ';
	        echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ' . $delimiter . ' ';
	        echo '<a href="' . get_month_link(get_the_time('Y'),get_the_time('m')) . '">' . get_the_time('F') . '</a> ';
	        $title = $before . 'Archive by date "' . get_the_time('d') . '"' . $after;
        } elseif ( is_month() ) {
        	echo ' '.$delimiter.' ';
	        echo '<a href="' . get_year_link(get_the_time('Y')) . '">' . get_the_time('Y') . '</a> ';
	        $title = $before . 'Archive by month "' . get_the_time('F') . '"' . $after;
        } elseif ( is_year() ) {
        	echo ' '.$delimiter.' ';
        	$title = $before . 'Archive by year "' . get_the_time('Y') . '"' . $after;
        } elseif ( is_single() && !is_attachment() ) {
	        if ( get_post_type() != 'post' ) {
		        $post_type = get_post_type_object(get_post_type());
		        $slug = $post_type->rewrite;
		        echo ' '.$delimiter.' ';
		        echo '<a href="' . esc_url( $homeLink ) . '/' . esc_attr( $slug['slug'] ) . '/">' . $post_type->labels->singular_name . '</a>';
		        $title = $before . get_the_title() . $after;
	        } else {
	        	echo ' '.$delimiter.' ';
		        $cat = get_the_category(); $cat = $cat[0];
		        echo ' ' . get_category_parents($cat, TRUE, '') . ' ';
		        $title = $before . '' . get_the_title() . '' . $after;
	        }
        } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
	        $post_type = get_post_type_object(get_post_type());
	        if($post_type)
	        	$title = $before . $post_type->labels->singular_name . $after;
        } elseif ( is_attachment() ) {
	        $parent_id  = $post->post_parent;
	        $breadcrumbs = array();
	        echo ' '.$delimiter.' ';
	        while ($parent_id) {
		        $page = get_page($parent_id);
		        $breadcrumbs[] = '<a href="' . esc_url( get_permalink($page->ID) ) . '">' . esc_html( get_the_title($page->ID) ) . '</a>';
		        $parent_id    = $page->post_parent;
	        }
	        $breadcrumbs = array_reverse($breadcrumbs);
	        foreach ($breadcrumbs as $crumb) echo ' ' . $crumb . ' ' . $delimiter . ' ';
	        $title = $before . '' . get_the_title() . '' . $after;
        } elseif ( is_page() && !$post->post_parent ) {
        	$title = $before . '' . get_the_title() . '' . $after;
        } elseif ( is_page() && $post->post_parent ) {
	        $parent_id  = $post->post_parent;
	        $breadcrumbs = array();
	        echo ' '.$delimiter.' ';
	        while ($parent_id) {
		        $page = get_page($parent_id);
		        $breadcrumbs[] = '<a href="' . esc_url( get_permalink($page->ID) ) . '">' . esc_html( get_the_title($page->ID) ) . '</a>';
		        $parent_id    = $page->post_parent;
	        }
	        $breadcrumbs = array_reverse($breadcrumbs);
	        foreach ($breadcrumbs as $crumb) echo ' ' . $crumb . ' ' . $delimiter . ' ';
        	$title = $before . '' . get_the_title() . '' . $after;
        } elseif ( is_search()) {
            $title = $before . 'Search results for "' . get_search_query() . '"' . $after;
        } elseif ( is_tag() ) {
        	$title = $before . 'Archive by tag "' . single_tag_title('', false) . '"' . $after;
        } elseif ( is_author() ) {
        global $author;
        $userdata = get_userdata($author);
        	$title = $before . 'Articles posted by "' . $userdata->display_name . '"' . $after;
        } elseif ( is_404() ) {
        	$title = $before . 'You got it "' . 'Error 404 not Found' . '"&nbsp;' . $after;
        }
        if ( get_query_var('paged') ) {
	        if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' ';
	        //echo ('Page') . ' ' . get_query_var('paged');
	        if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo '';
        }
        if($showtitle){
        	echo '<div class="breadcrumb-name"><span>' . ( $title ) . '</span></div>';
        }
        echo '</nav></section>';
    }
?>