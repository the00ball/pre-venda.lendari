<?php
add_action( 'customize_register', 'wpo_ct_gallery_setting' );
function wpo_ct_gallery_setting( $wp_customize ){
    
    $wp_customize->add_panel( 'panel_gallery', array(
        'priority' => 82,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __( 'Gallery', 'unity' ),
        'description' =>__( 'Make default setting for page, general', 'unity' ),
    ) );

    /**
     * Layout Setting
     */
    $wp_customize->add_section( 'gallery_layout_settings', array(
        'priority' => 1,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __( 'Layout Setting', 'unity' ),
        'description' => '',
        'panel' => 'panel_gallery',
    ) );

     ///  Archive layout setting
    $wp_customize->add_setting( 'wpo_theme_options[gallery-archive-layout]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => '0-1-1',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( new WPO_Layout_DropDown( $wp_customize, 'wpo_theme_options[gallery-archive-layout]', array(
        'settings'  => 'wpo_theme_options[gallery-archive-layout]',
        'label'     => __('Archive Layout', 'unity'),
        'section'   => 'gallery_layout_settings',
        'priority' => 1

    ) ) );

   
    $wp_customize->add_setting( 'wpo_theme_options[gallery-archive-left-sidebar]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 'sidebar-left',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    
    $wp_customize->add_control( new WPO_Sidebar_DropDown( $wp_customize, 'wpo_theme_options[gallery-archive-left-sidebar]', array(
        'settings'  => 'wpo_theme_options[gallery-archive-left-sidebar]',
        'label'     => __('Archive Left Sidebar', 'unity'),
        'section'   => 'gallery_layout_settings' ,
         'priority' => 2
    ) ) );

     /// 
    $wp_customize->add_setting( 'wpo_theme_options[gallery-archive-right-sidebar]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 'sidebar-right',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( new WPO_Sidebar_DropDown( $wp_customize, 'wpo_theme_options[gallery-archive-right-sidebar]', array(
        'settings'  => 'wpo_theme_options[gallery-archive-right-sidebar]',
        'label'     => __('Archive Right Sidebar', 'unity'),
        'section'   => 'gallery_layout_settings',
         'priority' => 2 
    ) ) );

     ///  single layout setting
    $wp_customize->add_setting( 'wpo_theme_options[gallery-single-layout]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => '0-1-1',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( new WPO_Layout_DropDown( $wp_customize,  'wpo_theme_options[gallery-single-layout]', array(
        'settings'  => 'wpo_theme_options[gallery-single-layout]',
        'label'     => __('Single Blog Layout', 'unity'),
        'section'   => 'gallery_layout_settings' 
    ) ) );

   
    $wp_customize->add_setting( 'wpo_theme_options[gallery-single-left-sidebar]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 'sidebar-left',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( new WPO_Sidebar_DropDown( $wp_customize,  'wpo_theme_options[gallery-single-left-sidebar]', array(
        'settings'  => 'wpo_theme_options[gallery-single-left-sidebar]',
        'label'     => __('Single gallery Left Sidebar', 'unity'),
        'section'   => 'gallery_layout_settings' 
    ) ) );

     $wp_customize->add_setting( 'wpo_theme_options[gallery-single-right-sidebar]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 'sidebar-right',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( new WPO_Sidebar_DropDown( $wp_customize,  'wpo_theme_options[gallery-single-right-sidebar]', array(
        'settings'  => 'wpo_theme_options[gallery-single-right-sidebar]',
        'label'     => __('Single gallery Right Sidebar', 'unity'),
        'section'   => 'gallery_layout_settings' 
    ) ) );

    $wp_customize->add_setting('wpo_theme_options[gallery_show-title]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 1,
        'checked' => 1,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control('wpo_theme_options[gallery_show-title]', array(
        'settings'  => 'wpo_theme_options[gallery_show-title]',
        'label'     => __('Show title', 'unity'),
        'section'   => 'gallery_layout_settings',
        'type'      => 'checkbox',
        'transport' => 4,
    ) );

    $wp_customize->add_setting('wpo_theme_options[gallery_show-breadcrumb]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 1,
        'checked' => 1,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control('wpo_theme_options[gallery_show-breadcrumb]', array(
        'settings'  => 'wpo_theme_options[gallery_show-breadcrumb]',
        'label'     => __('Show breadcrumb', 'unity'),
        'section'   => 'gallery_layout_settings',
        'type'      => 'checkbox',
        'transport' => 4,
    ) );

    /**
     * Archive Setting
     */
    $wp_customize->add_section( 'gallery_archive_general_settings', array(
        'priority' => 11,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __( 'Archive Setting', 'unity' ),
        'description' => '',
        'panel' => 'panel_gallery',
    ) );

     $wp_customize->add_setting('wpo_theme_options[gallery-archive-column]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => '3',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( 'wpo_theme_options[gallery-archive-column]', array(
        'label'      => __( 'Select column', 'unity' ),
        'section'    => 'gallery_archive_general_settings',
        'type'       => 'select',
        'choices'     => array(
            '2' => __('2 column', 'unity' ),
            '3' => __('3 column', 'unity' ),
            '4' => __('4 column', 'unity' ),
            '6' => __('6 column', 'unity' ),
        )
    ) );

    $wp_customize->add_setting('wpo_theme_options[gallery-archive-items]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => '9',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( 'wpo_theme_options[gallery-archive-items]', array(
        'label'      => __( 'Post per page', 'unity' ),
        'section'    => 'gallery_archive_general_settings',
        'settings'  => 'wpo_theme_options[gallery-archive-items]',
    ) );  
}
