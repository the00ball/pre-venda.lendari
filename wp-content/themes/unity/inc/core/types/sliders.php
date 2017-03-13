<?php

if(!function_exists('wpo_create_type_sliders')){
    function wpo_create_type_sliders(){
        $labels = array(
            'name' => __( 'Sliders', 'unity' ),
            'singular_name' => __( 'Slider', 'unity'),
            'add_new' => __( 'Add New Slider', 'unity' ),
            'add_new_item' => __( 'Add New Slider', 'unity' ),
            'edit_item' => __( 'Edit Slider', 'unity' ),
            'new_item' => __( 'New Slider', 'unity' ),
            'view_item' => __( 'View Slider', 'unity' ),
            'search_items' => __( 'Search Slider', 'unity' ),
            'not_found' => __( 'No Slider found', 'unity' ),
            'not_found_in_trash' => __( 'No Slider found in Trash', 'unity' ),
            'parent_item_colon' => __( 'Parent Slider:', 'unity' ),
            'menu_name' => __( 'Opal Sliders', 'unity' )
        );

        $args = array(
            'labels' => $labels,
            'hierarchical' => true,
            'description' => 'List Slider',
            'supports' => array( 'title', 'editor', 'thumbnail' ),
            'taxonomies' => array('slider_group' ),
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
        register_post_type( 'sliders', $args );


        $labels = array(
            'name' => __( 'Slider groups', 'unity' ),
            'singular_name' => __( 'Slider group', 'unity' ),
            'search_items' =>  __( 'Search Slider groups','unity' ),
            'all_items' => __( 'All Slider groups','unity' ),
            'parent_item' => __( 'Parent Slider group','unity' ),
            'parent_item_colon' => __( 'Parent Slider group:','unity' ),
            'edit_item' => __( 'Edit Slider group','unity' ),
            'update_item' => __( 'Update Slider group','unity' ),
            'add_new_item' => __( 'Add New Slider group','unity' ),
            'new_item_name' => __( 'New Slider group','unity' ),
            'menu_name' => __( 'Slider groups','unity' ),
        );

        register_taxonomy('slider_group',array('sliders'), array(
            'hierarchical' => true,
            'labels' => $labels,
            'show_ui' => true,
            'show_admin_column' => true,
            'query_var' => true,
            'rewrite' => array( 'slug' => 'slider_group' ),
            'show_in_nav_menus'=>false
        ));
    }
    add_action( 'init','wpo_create_type_sliders' );
}