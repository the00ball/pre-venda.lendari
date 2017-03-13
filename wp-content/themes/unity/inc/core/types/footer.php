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
if( !function_exists("wpo_create_type_footer") ){

function wpo_create_type_footer(){
  $labels = array(
    'name' => __( 'Footer', 'unity' ),
    'singular_name' => __( 'Footer', 'unity' ),
    'add_new' => __( 'Add New Footer', 'unity' ),
    'add_new_item' => __( 'Add New Footer', 'unity' ),
    'edit_item' => __( 'Edit Footer', 'unity' ),
    'new_item' => __( 'New Footer', 'unity' ),
    'view_item' => __( 'View Footer', 'unity' ),
    'search_items' => __( 'Search Footers', 'unity' ),
    'not_found' => __( 'No Footers found', 'unity' ),
    'not_found_in_trash' => __( 'No Footers found in Trash', 'unity' ),
    'parent_item_colon' => __( 'Parent Footer:', 'unity' ),
    'menu_name' => __( 'Footers', 'unity' ),
  );

  $args = array(
      'labels' => $labels,
      'hierarchical' => true,
      'description' => 'List Footer',
      'supports' => array( 'title', 'editor' ),
      'public' => true,
      'show_ui' => true,
      'show_in_menu' => true,
      'menu_position' => 5,
      'show_in_nav_menus' => false,
      'publicly_queryable' => false,
      'exclude_from_search' => false,
      'has_archive' => false,
      'query_var' => true,
      'can_export' => true,
      'rewrite' => false
  );
  register_post_type( 'footer', $args );

  
}

add_action('init','wpo_create_type_footer');
}