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
if(!function_exists('wpo_create_type_gallery')){
    function wpo_create_type_gallery(){
      $labels = array(
          'name'               => __( 'Gallerys', 'unity' ),
          'singular_name'      => __( 'Gallery', 'unity' ),
          'add_new'            => __( 'Add New Gallery', 'unity' ),
          'add_new_item'       => __( 'Add New Gallery', 'unity' ),
          'edit_item'          => __( 'Edit Gallery', 'unity' ),
          'new_item'           => __( 'New Gallery', 'unity' ),
          'view_item'          => __( 'View Gallery', 'unity' ),
          'search_items'       => __( 'Search Gallerys', 'unity' ),
          'not_found'          => __( 'No Gallerys found', 'unity' ),
          'not_found_in_trash' => __( 'No Gallerys found in Trash', 'unity' ),
          'parent_item_colon'  => __( 'Parent Gallery:', 'unity' ),
          'menu_name'          => __( 'Opal Gallerys', 'unity' ),
      );

      $args = array(
          'labels'              => $labels,
          'hierarchical'        => true,
          'description'         => 'List Gallery',
          'supports'            => array( 'title', 'editor', 'author', 'thumbnail','excerpt','custom-fields' ), //page-attributes, post-formats
          'taxonomies'          => array( 'gallery_category','skills','post_tag' ),
          'public'              => true,
          'show_ui'             => true,
          'show_in_menu'        => true,
          'menu_position'       => 5,
          'menu_icon'           => WPO_FRAMEWORK_ADMIN_IMAGE_URI.'icon/admin_ico_gallery.png',
          'show_in_nav_menus'   => false,
          'publicly_queryable'  => true,
          'exclude_from_search' => false,
          'has_archive'         => true,
          'query_var'           => true,
          'can_export'          => true,
          'rewrite'             => true,
          'capability_type'     => 'post'
      );
      register_post_type( 'gallery', $args );

      //Add Port folio Skill
      // Add new taxonomy, make it hierarchical like categories
      //first do the translations part for GUI
      $labels = array(
        'name'              => __( 'Categories', 'unity' ),
        'singular_name'     => __( 'Category', 'unity' ),
        'search_items'      => __( 'Search Category','unity' ),
        'all_items'         => __( 'All Categories','unity' ),
        'parent_item'       => __( 'Parent Category','unity' ),
        'parent_item_colon' => __( 'Parent Category:','unity' ),
        'edit_item'         => __( 'Edit Category','unity' ),
        'update_item'       => __( 'Update Category','unity' ),
        'add_new_item'      => __( 'Add New Category','unity' ),
        'new_item_name'     => __( 'New Category Name','unity' ),
        'menu_name'         => __( 'Categories','unity' ),
      );
      // Now register the taxonomy
      register_taxonomy('gallery_category',array('gallery'),
          array(
              'hierarchical'      => true,
              'labels'            => $labels,
              'show_ui'           => true,
              'show_admin_column' => true,
              'query_var'         => true,
              'show_in_nav_menus' => false,
              'rewrite'           => array( 'slug' => 'skills'
          ),
      ));
  }
  add_action( 'init','wpo_create_type_gallery' );
}