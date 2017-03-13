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

if(!function_exists('wpo_create_type_video')){
  function wpo_create_type_video(){
    $labels = array(
      'name' => __( 'Video', 'unity' ),
      'singular_name' => __( 'Video', 'unity' ),
      'add_new' => __( 'Add New Video', 'unity' ),
      'add_new_item' => __( 'Add New Video', 'unity' ),
      'edit_item' => __( 'Edit Video', 'unity' ),
      'new_item' => __( 'New Video', 'unity' ),
      'view_item' => __( 'View Video', 'unity' ),
      'search_items' => __( 'Search Videos', 'unity' ),
      'not_found' => __( 'No Videos found', 'unity' ),
      'not_found_in_trash' => __( 'No Videos found in Trash', 'unity' ),
      'parent_item_colon' => __( 'Parent Video:', 'unity' ),
      'menu_name' => __( 'Opal Videos', 'unity' ),
    );

    $args = array(
        'labels' => $labels,
        'hierarchical' => true,
        'description' => 'List Video',
        'supports' => array( 'title', 'editor', 'thumbnail','comments', 'excerpt' ),
        'public' => true,
        'show_ui' => true,
        'show_in_menu' => true,
        'menu_position' => 5,
        'show_in_nav_menus' => false,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'has_archive' => true,
        'query_var' => true,
        'can_export' => true,
        'rewrite' => true,
        'capability_type' => 'post'
    );
    register_post_type( 'video', $args );
  }
  add_action( 'init', 'wpo_create_type_video' );
}


