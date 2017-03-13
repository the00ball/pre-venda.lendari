<?php
add_action( 'customize_register', 'wpo_ct_woocommerce_setting' );
function wpo_ct_woocommerce_setting( $wp_customize ){
    


	$wp_customize->add_panel( 'panel_woocommerce', array(
		'priority' => 70,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Woocommerce', 'unity' ),
		'description' =>__( 'Make default setting for page, general', 'unity' ),
	) );

    /**
     * General Setting
     */
    $wp_customize->add_section( 'wc_general_settings', array(
        'priority' => 1,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __( 'General Setting', 'unity' ),
        'description' => '',
        'panel' => 'panel_woocommerce',
    ) );

    //config mini cart
    $wp_customize->add_setting('wpo_theme_options[woo-show-minicart]', array(
        'capability' => 'manage_options',
        'type'       => 'option',
        'default'   => 1,
        'checked' => 1,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control('wpo_theme_options[woo-show-minicart]', array(
        'settings'  => 'wpo_theme_options[woo-show-minicart]',
        'label'     => __('Enable Mini Basket', 'unity'),
        'section'   => 'wc_general_settings',
        'type'      => 'checkbox'
    ) );

    
    $wp_customize->add_setting('wpo_theme_options[is-quickview]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 1,
        'checked' => 1,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control('wpo_theme_options[is-quickview]', array(
        'settings'  => 'wpo_theme_options[is-quickview]',
        'label'     => __('Enable QuickView', 'unity'),
        'section'   => 'wc_general_settings',
        'type'      => 'checkbox',
        'transport' => 4,
    ) );



    $wp_customize->add_setting('wpo_theme_options[is-swap-effect]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 1,
        'checked' => 1,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control('wpo_theme_options[is-swap-effect]', array(
        'settings'  => 'wpo_theme_options[is-swap-effect]',
        'label'     => __('Enable Swap Image', 'unity'),
        'section'   => 'wc_general_settings',
        'type'      => 'checkbox',
        'transport' => 4,
    ) );

    $wp_customize->add_setting('wpo_theme_options[wc_cartnotice]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 1,
        'checked' => 1,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control('wpo_theme_options[wc_cartnotice]', array(
        'settings'  => 'wpo_theme_options[wc_cartnotice]',
        'label'     => __('Enable Adding Cart Notification', 'unity'),
        'section'   => 'wc_general_settings',
        'type'      => 'checkbox',
        'transport' => 4,
    ) );
    $wp_customize->add_setting('wpo_theme_options[wc_cartnotice_text]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 'Add to cart success!',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control('wpo_theme_options[wc_cartnotice_text]', array(
        'settings'  => 'wpo_theme_options[wc_cartnotice_text]',
        'label'     => __('Text add cart success', 'unity'),
        'section'   => 'wc_general_settings',
        'type'      => 'text',
        'transport' => 5,
    ) );



    /**
     * Archive Page Setting
     */
    $wp_customize->add_section( 'wc_archive_settings', array(
        'priority' => 2,
        'capability' => 'edit_theme_options',
        'theme_supports' => '',
        'title' => __( 'Archive Page Setting', 'unity' ),
        'description' => 'Configure categories, search, shop page setting',
        'panel' => 'panel_woocommerce',
    ) );

     ///  Archive layout setting
    $wp_customize->add_setting( 'wpo_theme_options[woocommerce-archive-layout]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => '0-1-1',
        'checked' => 1,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( new WPO_Layout_DropDown( $wp_customize,  'wpo_theme_options[woocommerce-archive-layout]', array(
        'settings'  => 'wpo_theme_options[woocommerce-archive-layout]',
        'label'     => __('Archive Layout', 'unity'),
        'section'   => 'wc_archive_settings',
        'priority' => 1

    ) ) );

   //sidebar archive left
    $wp_customize->add_setting( 'wpo_theme_options[woocommerce-archive-left-sidebar]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 'sidebar-left',
        'checked' => 1,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( new WPO_Sidebar_DropDown( $wp_customize,  'wpo_theme_options[woocommerce-archive-left-sidebar]', array(
        'settings'  => 'wpo_theme_options[woocommerce-archive-left-sidebar]',
        'label'     => __('Archive Left Sidebar', 'unity'),
        'section'   => 'wc_archive_settings' ,
         'priority' => 3
    ) ) );

      //sidebar archive right
    $wp_customize->add_setting( 'wpo_theme_options[woocommerce-archive-right-sidebar]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 'sidebar-right',
        'checked' => 1,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( new WPO_Sidebar_DropDown( $wp_customize,  'wpo_theme_options[woocommerce-archive-right-sidebar]', array(
        'settings'  => 'wpo_theme_options[woocommerce-archive-right-sidebar]',
        'label'     => __('Archive Right Sidebar', 'unity'),
        'section'   => 'wc_archive_settings',
         'priority' => 4 
    ) ) );

    //list-grid  style archive
    $wp_customize->add_setting( 'wpo_theme_options[wc_listgrid]', array(
        'type'       => 'option',
        'default'    => 'product',
        'capability' => 'manage_options',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( 'wpo_theme_options[wc_listgrid]', array(
        'label'      => __( 'List Grid', 'unity' ),
        'section'    => 'wc_archive_settings',
        'type'       => 'select',
        'choices'     => array(
            'product-list' => __('List', 'unity' ),
            'product' => __('Grid', 'unity' ),
        ),
        'description' => 'Select default layout archive product',
        'priority' => 5
    ) );

    //number product per page
    $wp_customize->add_setting( 'wpo_theme_options[woo-number-page]', array(
        'type'       => 'option',
        'default'    => 12,
        'capability' => 'manage_options',
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    $wp_customize->add_control( 'wpo_theme_options[woo-number-page]', array(
        'label'      => __( 'Number of Products Per Page', 'unity' ),
        'section'    => 'wc_archive_settings',
        'priority' => 6
    ) );

    //number product per row
    $wp_customize->add_setting( 'wpo_theme_options[wc_itemsrow]', array(
        'type'       => 'option',
        'default'    => 4,
        'capability' => 'manage_options',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( 'wpo_theme_options[wc_itemsrow]', array(
        'label'      => __( 'Number of Products Per Row', 'unity' ),
        'section'    => 'wc_archive_settings',
        'type'       => 'select',
        'choices'     => array(
            '2' => __('2 Items', 'unity' ),
            '3' => __('3 Items', 'unity' ),
            '4' => __('4 Items', 'unity' ),
            '6' => __('6 Items', 'unity' ),
        ),
        'priority' => 7
    ) );
	

    /**
	 * Product Single Setting
	 */
	$wp_customize->add_section( 'wc_product_settings', array(
		'priority' => 12,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Single Product Page Setting', 'unity' ),
		'description' => 'Configure single product page',
		'panel' => 'panel_woocommerce',
	) );
    ///  single layout setting
    $wp_customize->add_setting( 'wpo_theme_options[woocommerce-single-layout]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => '0-1-1',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    //Select layout
    $wp_customize->add_control( new WPO_Layout_DropDown( $wp_customize,  'wpo_theme_options[woocommerce-single-layout]', array(
        'settings'  => 'wpo_theme_options[woocommerce-single-layout]',
        'label'     => __('Product Detail Layout', 'unity'),
        'section'   => 'wc_product_settings',
        'priority' => 1
    ) ) );

   
    $wp_customize->add_setting( 'wpo_theme_options[woocommerce-single-left-sidebar]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 1,
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    //Sidebar left
    $wp_customize->add_control( new WPO_Sidebar_DropDown( $wp_customize,  'wpo_theme_options[woocommerce-single-left-sidebar]', array(
        'settings'  => 'wpo_theme_options[woocommerce-single-left-sidebar]',
        'label'     => __('Product Detail Left Sidebar', 'unity'),
        'section'   => 'wc_product_settings',
        'priority' => 2 
    ) ) );

     $wp_customize->add_setting( 'wpo_theme_options[woocommerce-single-right-sidebar]', array(
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 'sidebar-right',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    //Sidebar right
    $wp_customize->add_control( new WPO_Sidebar_DropDown( $wp_customize,  'wpo_theme_options[woocommerce-single-right-sidebar]', array(
        'settings'  => 'wpo_theme_options[woocommerce-single-right-sidebar]',
        'label'     => __('Product Detail Right Sidebar', 'unity'),
        'section'   => 'wc_product_settings',
        'priority' => 3 
    ) ) );

    //Show related product
    $wp_customize->add_setting('wpo_theme_options[wc_show_related]', array(     
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 0,
        'checked' => 1,
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    
    $wp_customize->add_control('wpo_theme_options[wc_show_related]', array(
        'settings'  => 'wpo_theme_options[wc_show_related]',
        'label'     => __('Disable show related product', 'unity'),
        'section'   => 'wc_product_settings',
        'type'      => 'checkbox',
        'priority' => 4
    ) );
     //Show upsells product
    $wp_customize->add_setting('wpo_theme_options[wc_show_upsells]', array(     
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 0,
        'checked' => 1,
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    
    $wp_customize->add_control('wpo_theme_options[wc_show_upsells]', array(
        'settings'  => 'wpo_theme_options[wc_show_upsells]',
        'label'     => __('Disable show upsells product', 'unity'),
        'section'   => 'wc_product_settings',
        'type'      => 'checkbox',
        'transport' => 3,
        'priority' => 5
    ) );

    //number of product per row 
    $wp_customize->add_setting( 'wpo_theme_options[product-number-columns]', array(
        'type'       => 'option',
        'default'    => 3,
        'capability' => 'manage_options',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( 'wpo_theme_options[product-number-columns]', array(
        'label'      => __( 'Number of Product Per Row', 'unity' ),
        'section'    => 'wc_product_settings',
        'type'       => 'select',
        'choices'     => array(
            '2' => __('2 Items', 'unity' ),
            '3' => __('3 Items', 'unity' ),
            '4' => __('4 Items', 'unity' )
        ),
        'priority' => 6
    ) );
    
    //Number of product to show 
    $wp_customize->add_setting( 'wpo_theme_options[woo-number-product-single]', array(
        'type'       => 'option',
        'default'	 => 6,
        'capability' => 'manage_options',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( 'wpo_theme_options[woo-number-product-single]', array(
        'label'      => __( 'Number of Products to Show', 'unity' ),
        'section'    => 'wc_product_settings',
        'priority' => 7
    ) );

     //Show Social share product
    $wp_customize->add_setting('wpo_theme_options[wc_show_share_social]', array(     
        'capability' => 'edit_theme_options',
        'type'       => 'option',
        'default'   => 1,
        'checked' => 1,
        'sanitize_callback' => 'sanitize_text_field'
    ) );
    
    $wp_customize->add_control('wpo_theme_options[wc_show_share_social]', array(
        'settings'  => 'wpo_theme_options[wc_show_share_social]',
        'label'     => __('Show Social share product', 'unity'),
        'section'   => 'wc_product_settings',
        'type'      => 'checkbox',
        'priority' => 8
    ) );

    /**
	 * Product Listing Setting
	 */
	/*$wp_customize->add_section( 'wc_product_settings', array(
		'priority' => 13,
		'capability' => 'edit_theme_options',
		'theme_supports' => '',
		'title' => __( 'Product Page Setting', 'unity' ),
		'description' => '',
		'panel' => 'panel_woocommerce',
	) );

    $wp_customize->add_setting( 'page_on_frontaas', array(
        'type'       => 'option',
        'capability' => 'manage_options',
        'sanitize_callback' => 'sanitize_text_field'
    ) );

    $wp_customize->add_control( 'page_on_frontaas', array(
        'label'      => __( 'Front page', 'unity' ),
        'section'    => 'wc_product_settings',
        'type'       => 'dropdown-pages',
    ) );*/

}
?>