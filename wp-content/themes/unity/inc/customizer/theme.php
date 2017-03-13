<?php
 
add_action( 'customize_register', 'wpo_cst_customizer' );

function wpo_cst_customizer($wp_customize){

  

    # General Settings
    // Panel Header
    $wp_customize->add_section('wpo_cst_general_settings', array(
        'title'      => __('General Settings', 'unity'),
        'description'    => __('Website General Settings', 'unity'),
        'transport'  => 'postMessage',
        'priority'   => 10,
    ));

    // Parameter Options
    $wp_customize->add_setting('blogname', array( 
        'default'    => get_option('blogname'),
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control('blogname', array( 
        'label'    => __('Site Title', 'unity'),
        'section'  => 'wpo_cst_general_settings',
        'priority' => 1,
    ) );
    
    //
    $wp_customize->add_setting('blogdescription', array( 
        'default'    => get_option('blogdescription'),
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    
    $wp_customize->add_control('blogdescription', array( 
        'label'    => __('Tagline', 'unity'),
        'section'  => 'wpo_cst_general_settings',
        'priority' => 2,
    ) );


    // 
    $wp_customize->add_setting('display_header_text', array( 
        'default'    => 1,
        'type'       => 'option',
        'capability' => 'manage_options',
        'transport'  => 'postMessage',
        'sanitize_callback' => 'sanitize_text_field'
    ) );    
    $wp_customize->add_control( 'display_header_text', array(
        'settings' => 'header_textcolor',
        'label'    => __( 'Show Title & Tagline', 'unity' ),
        'section'  => 'wpo_cst_general_settings',
        'type'     => 'checkbox',
        'priority' => 4,
    ) );


    /* 
     * Custom Logo 
     */
     $wp_customize->add_setting('wpo_theme_options[logo]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'manage_options',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wpo_theme_options[logo]', array(
        'label'    => __('Logo', 'unity'),
        'section'  => 'wpo_cst_general_settings',
        'settings' => 'wpo_theme_options[logo]',
        'priority' => 10,
    ) ) );
    
     /* 
     * Custom payment 
     */
     $wp_customize->add_setting('wpo_theme_options[image-payment]', array(
        'default'    => '',
        'type'       => 'option',
        'capability' => 'manage_options',
        'sanitize_callback' => 'esc_url_raw',
    ) );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'wpo_theme_options[image-payment]', array(
        'label'    => __('Payment Logo', 'unity'),
        'section'  => 'wpo_cst_general_settings',
        'settings' => 'wpo_theme_options[image-payment]',
        'priority' => 11,
    ) ) );

    $wp_customize->add_setting('wpo_theme_options[copyright_text]', array(
        'default'    => 'Copyright 2015 - Unity - All Rights Reserved.',
        'type'       => 'option',
        'transport'=>'refresh',
         'sanitize_callback' => 'wpo_sanitize_textarea',
    ) );

    $wp_customize->add_control( new WPOpalTextAreaControl( $wp_customize, 'wpo_theme_options[copyright_text]', array(
        'label'    => __('Copyright text', 'unity'),
        'section'  => 'wpo_cst_general_settings',
        'settings' => 'wpo_theme_options[copyright_text]',
        'priority' => 12,
    ) ) );


    function wpo_sanitize_textarea( $content ){
        return wp_kses_post( force_balance_tags( $content ) );
    }
   /***************************************************************************
    * Theme Settings 
    ***************************************************************************/

  
   /**
     * General Setting
     */
    $wp_customize->add_section( 'ts_general_settings', array(
        'priority' => 12,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __( 'Themes And Layouts Setting', 'unity' ),
        'description' => '',
    ) );

    //
    $wp_customize->add_setting( 'wpo_theme_options[skin]', array(
        'type'       => 'option',
        'capability' => 'manage_options',
        'default'  => 'default',
         'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( 'wpo_theme_options[skin]', array(
        'label'      => __( 'Default Theme', 'unity' ),
        'section'    => 'ts_general_settings',
        'type'    => 'select',
        'choices'    => wpo_cst_skins(),
    ) );

     $wp_customize->add_setting( 'wpo_theme_options[headerlayout]', array(
        'type'       => 'option',
        'capability' => 'manage_options',
        'default'  => '',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( 'wpo_theme_options[headerlayout]', array(
        'label'      => __( 'Header Layout Style', 'unity' ),
        'section'    => 'ts_general_settings',
        'type'    => 'select',
        //'choices' => array(''=>'Default') 
        'choices'    => wpo_cst_headerlayouts(),
    ) );

    $wp_customize->add_setting( 'wpo_theme_options[footer-style]', array(
        'type'           => 'option',
        'capability'     => 'manage_options',
        'default'        => 'default'   ,
        'sanitize_callback' => 'sanitize_text_field'
        //  'theme_supports' => 'static-front-page',
    ) );
    
     $wp_customize->add_control( 'wpo_theme_options[footer-style]', array(
        'label'      => __( 'Footer Styles Builder', 'unity' ),
        'section'    => 'ts_general_settings',
        'type'       => 'select',
        'choices'    => wpo_get_footerbuilder_profiles()
    ) );
     
    //if( defined("WPO_CTS_STYLE_PATH") ){
         $wp_customize->add_setting( 'wpo_theme_options[customize-theme]', array(
            'type'       => 'option',
            'capability' => 'manage_options',
            'default'  => '',
	       'sanitize_callback' => 'sanitize_text_field'
        ) );

        $wp_customize->add_control(  new WPO_CustomizeProfile_DropDown( $wp_customize, 'wpo_theme_options[customize-theme]', array(
            'label'      => __( 'Custom Theme Profile', 'unity' ),
            'section'    => 'ts_general_settings'
        ) ) );
        
     $wp_customize->add_section( 'header_image', array(
        'description' => __( 'Applied to the breadcrumb.', 'unity' ),
        'title'          => __( 'Breadcrumb Image', 'unity' ),
        'priority'   => 88,
    ));
     //}

    /******************************************************************
     * Navigation
     ******************************************************************/

     # Sticky Top Bar Option
    $wp_customize->add_setting('wpo_theme_options[verticalmenu]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control('wpo_theme_options[verticalmenu]', array(
        'settings'  => 'wpo_theme_options[verticalmenu]',
        'label'     => __('Vertical Megamenu', 'unity'),
        'section'   => 'nav',
        'type'      => 'select',
        'choices' => wpo_get_menugroups(),
    ) );
    


    # Sticky Top Bar Option
    $wp_customize->add_setting('wpo_theme_options[megamenu-is-sticky]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control('wpo_theme_options[megamenu-is-sticky]', array(
        'settings'  => 'wpo_theme_options[megamenu-is-sticky]',
        'label'     => __('Sticky Top Bar', 'unity'),
        'section'   => 'nav',
        'type'      => 'checkbox',
        'transport' => 4,
    ) );
    
    $wp_customize->add_setting( 'wpo_theme_options[magemenu-animation]', array(
        'type'       => 'option',
        'capability' => 'manage_options',
        'default'  => '',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( 'wpo_theme_options[magemenu-animation]', array(
        'label'      => __( 'Megamenu Animation', 'unity' ),
        'section'    => 'nav',
        'type'    => 'select',
        'choices'    => wpo_get_menuanimation(),
    ) );

    $wp_customize->add_setting( 'wpo_theme_options[megamenu-duration]', array(
        'type'       => 'option',
        'capability' => 'manage_options',
        'default'  => '300',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( 'wpo_theme_options[megamenu-duration]', array(
        'label'      => __(  'Megamenu Duration', 'unity' ),
        'section'    => 'nav',
        'type'    => 'text'
    ) );



    /*****************************************************************
     * Front Page Settings Panel
     *****************************************************************/   
    $wp_customize->add_section( 'static_front_page', array(
        'title'          => __( 'Front Page Settings', 'unity' ),
        'priority'       => 120,
        'description'    => __( 'Your theme supports a static front page.', 'unity'),
    ) );

    $wp_customize->add_setting( 'wpo_theme_options[sidebar_position]', array(
        'default' => 'left',
        'capability'     => 'edit_theme_options',
        'type'           => 'option',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
 
    $wp_customize->add_control( 'wpo_theme_options[sidebar_position]', array(
        'type' => 'radio',
        'label' => 'Sidebar Position',
        'section' => 'static_front_page',
        'priority' => 1,
        'choices' => array(
            'left' => 'Left',
            'right' => 'Right',
        ),
    ) );

    $wp_customize->add_setting( 'show_on_front', array(
        'default'        => get_option( 'show_on_front' ),
        'capability'     => 'manage_options',
        'type'           => 'option',
        //  'theme_supports' => 'static-front-page',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( 'show_on_front', array(
        'label'   => __( 'Front page displays', 'unity' ),
        'section' => 'static_front_page',
        'type'    => 'radio',
        'choices' => array(
            'posts' => __( 'Your latest posts', 'unity' ),
            'page'  => __( 'A static page', 'unity' ),
        ),
    ) );
    
    $wp_customize->add_setting( 'page_on_front', array(
        'type'       => 'option',
        'capability' => 'manage_options',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( 'page_on_front', array(
        'label'      => __( 'Front page', 'unity' ),
        'section'    => 'static_front_page',
        'type'       => 'dropdown-pages',
    ) );

    $wp_customize->add_setting( 'page_for_posts', array(
        'type'           => 'option',
        'capability'     => 'manage_options',
        //  'theme_supports' => 'static-front-page',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( 'page_for_posts', array(
        'label'      => __( 'Posts page', 'unity' ),
        'section'    => 'static_front_page',
        'type'       => 'dropdown-pages',
    ) );


    /* 
     /*****************************************************************
     * Front Page Settings Panel
     *****************************************************************/   
    $wp_customize->add_section( 'pages_setting', array(
        'title'          => __( 'Pages Settings', 'unity' ),
        'priority'       => 120,
        'description'    => __( 'Your theme supports a static front page.', 'unity'),
    ) );

     
    $wp_customize->add_setting( 'wpo_theme_options[404_post]', array(
        'type'           => 'option',
        'capability'     => 'manage_options',
        'default'        => ''   ,
        'sanitize_callback' => 'sanitize_text_field'
        //  'theme_supports' => 'static-front-page',
    ) );
    
     $wp_customize->add_control( 'wpo_theme_options[404_post]', array(
        'label'      => __( '404 Page', 'unity' ),
        'section'    => 'pages_setting',
        'type'       => 'dropdown-pages',
    ) );

     // 
}



?>
