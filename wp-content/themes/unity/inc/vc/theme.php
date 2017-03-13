<?php
	/*********************************************************************************************************************
	 *  Vertical menu
	 *********************************************************************************************************************/
	$menus = wp_get_nav_menus( array( 'orderby' => 'name' ) );
    $option_menu = array('---Select Menu---'=>'');
    foreach ($menus as $menu) {
    	$option_menu[$menu->name]=$menu->term_id;
    }
	vc_map( array(
	    "name" => __("WPO Vertical Menu",'unity'),
	    "base" => "wpo_verticalmenu",
	    "class" => "",
	    "category" => $this->l('WPO Elements'),
	    "params" => array(
	    	array(
				"type" => "textfield",
				"heading" => __("Title", 'unity'),
				"param_name" => "title",
				"value" => 'Vertical Menu'
			),
	    	array(
				"type" => "dropdown",
				"heading" => __("Menu", 'unity'),
				"param_name" => "menu",
				"value" => $option_menu,
				"admin_label" => true,
				"description" => __("Select menu.", 'unity')
			),
			array(
				"type" => "dropdown",
				"heading" => __("Position", 'unity'),
				"param_name" => "postion",
				"value" => array(
						'left'=>'left',
						'right'=>'right'
					),
				"admin_label" => true,
				"description" => __("Postion Menu Vertical.", 'unity')
			),
			array(
				"type" => "textfield",
				"heading" => __("Extra class name", 'unity'),
				"param_name" => "el_class",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'unity')
			)
	   	)
	));
	add_shortcode( 'wpo_verticalmenu', ('wpo_vc_shortcode_render') );

	/*********************************************************************************************************************
	 *  Portfolio
	 *********************************************************************************************************************/
	vc_map( array(
	    "name" => __("WPO Portfolio",'unity'),
	    "base" => "wpo_portfolio",
	    'icon' => 'icon-wpb-application-icon-large',
	    'description'=>'Portfolio',
	    "class" => "",
	    "category" => __('Opal Widgets', 'unity'),
	    "params" => array(
	    	array(
				"type" => "textfield",
				"heading" => __("Title", 'unity'),
				"param_name" => "title",
				"value" => '',
				"admin_label" => true
			),

	    	array(
				'type' => 'dropdown',
				'heading' => __( 'Title font size', 'unity' ),
				'param_name' => 'size',
				'value' => array(
					__( 'Large', 'unity' ) => 'font-size-lg',
					__( 'Medium', 'unity' ) => 'font-size-md',
					__( 'Small', 'unity' ) => 'font-size-sm',
					__( 'Extra small', 'unity' ) => 'font-size-xs'
				)
			),

			array(
				'type' => 'dropdown',
				'heading' => __( 'Title Alignment', 'unity' ),
				'param_name' => 'alignment',
				'value' => array(
					__( 'Align left', 'unity' ) => 'separator_align_left',
					__( 'Align center', 'unity' ) => 'separator_align_center',
					__( 'Align right', 'unity' ) => 'separator_align_right'
				)
			),

			array(
				"type" => "textarea",
				'heading' => __( 'Description', 'unity' ),
				"param_name" => "descript",
				"value" => ''
		    ),

			array(
				"type" => "textfield",
				"heading" => __("Number of portfolio to show", 'unity'),
				"param_name" => "number",
				"value" => '6'
			),

			array(
				'type' => 'dropdown',
				'heading' => __( 'Columns count', 'unity' ),
				'param_name' => 'columns_count',
				'value' => array( 6, 4, 3, 2, 1 ),
				'std' => 3,
				'admin_label' => true,
				'description' => __( 'Select columns count.', 'unity' )
			),

			array(
				'type' => 'dropdown',
				'heading' => __( 'Style display', 'unity' ),
				'param_name' => 'style',
				'value' => array( 'Style 1'=>'square effect2', 'Style 2'=>'effect3 bottom_to_top', 'Style 3'=>'effect5 left_to_right', 'Style 4'=>'effect6 bottom_to_top', 'Style 5'=>'effect7', 'Style 6'=>'effect8 scale_up', 'Style 7'=>'effect10 left_to_right', 'Style 8'=>'effect12 left_to_right', 'Style 9'=>'effect14 left_to_right', 'Style 10'=>'effect15 left_to_right'),
				'std' => 'style-1',
				'admin_label' => true,
				'description' => __( 'Select style display.', 'unity' )
			),

			array(
				"type" => "textfield",
				"heading" => __("Extra class name", 'unity'),
				"param_name" => "el_class",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'unity')
			)
	   	)
	));
	add_shortcode( 'wpo_portfolio', ('wpo_vc_shortcode_render') );


	/**********************************************************************************************************************
	 * Testimonials
	 **********************************************************************************************************************/
	vc_map( array(
	    "name" => __("WPO Testimonials",'unity'),
	    "base" => "wpo_testimonials",
	    'description'=> __('Play Testimonials In Carousel', 'unity'),
	    "class" => "",
	    "category" => __('Opal Widgets', 'unity'),
	    "params" => array(
	    	array(
				"type" => "textfield",
				"heading" => __("Title", 'unity'),
				"param_name" => "title",
				"admin_label" => true,
				"value" => '',
					"admin_label" => true
			),

	    	array(
                'type' => 'dropdown',
                'heading' => __( 'Title font size', 'unity' ),
                'param_name' => 'size',
                'value' => array(
                    __( 'Large', 'unity' ) => 'font-size-lg',
                    __( 'Medium', 'unity' ) => 'font-size-md',
                    __( 'Small', 'unity' ) => 'font-size-sm',
                    __( 'Extra small', 'unity' ) => 'font-size-xs'
                )
            ),

            array(
                'type' => 'dropdown',
                'heading' => __( 'Title Alignment', 'unity' ),
                'param_name' => 'alignment',
                'value' => array(
                    __( 'Align left', 'unity' ) => 'separator_align_left',
                    __( 'Align center', 'unity' ) => 'separator_align_center',
                    __( 'Align right', 'unity' ) => 'separator_align_right'
                )
            ),
            array(
				"type" => "textfield",
				"heading" => __("Number", 'unity'),
				"param_name" => "number",
				"value" => '6',
			),
			array(
				"type" => "dropdown",
				"heading" => __("Skin", 'unity'),
				"param_name" => "skin",
				"value" => array('Skin 1'=>'skin-1','Skin 2'=>'skin-2'),
				"admin_label" => true,
				"description" => __("Select Skin layout.", 'unity')
			),
			array(
				"type" => "textfield",
				"heading" => __("Extra class name", 'unity'),
				"param_name" => "el_class",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'unity')
			)
	   	)
	));
	add_shortcode( 'wpo_testimonials', ('wpo_vc_shortcode_render') );

	/*********************************************************************************************************************
	 *  Brands Carousel
	 *********************************************************************************************************************/
	vc_map( array(
	    "name" => __("WPO Brands Carousel",'unity'),
	    "base" => "wpo_brands",
	    'description'=>'Show Brand Logos, Manufacture Logos',
	    "class" => "",
	    "category" => __('Opal Widgets', 'unity'),
	    "params" => array(
	    	array(
				"type" => "textfield",
				"heading" => __("Title", 'unity'),
				"param_name" => "title",
				"value" => '',
					"admin_label" => true
			),

	    	array(
				'type' => 'dropdown',
				'heading' => __( 'Title font size', 'unity' ),
				'param_name' => 'size',
				'value' => array(
					__( 'Large', 'unity' ) => 'font-size-lg',
					__( 'Medium', 'unity' ) => 'font-size-md',
					__( 'Small', 'unity' ) => 'font-size-sm',
					__( 'Extra small', 'unity' ) => 'font-size-xs'
				)
			),

			array(
				"type" => "textarea",
				"heading" => __('Description', 'unity'),
				"param_name" => "descript",
				"value" => ''
			),

			array(
				'type' => 'dropdown',
				'heading' => __( 'Title Alignment', 'unity' ),
				'param_name' => 'alignment',
				'value' => array(
					__( 'Align left', 'unity' ) => 'separator_align_left',
					__( 'Align center', 'unity' ) => 'separator_align_center',
					__( 'Align right', 'unity' ) => 'separator_align_right'
				)
			),

			array(
				"type" => "textfield",
				"heading" => __("Number of brands to show", 'unity'),
				"param_name" => "number",
				"value" => '6'
			),
			array(
				"type" => "textfield",
				"heading" => __("Icon", 'unity'),
				"param_name" => "icon"
			),
			array(
				"type" => "textfield",
				"heading" => __("Extra class name", 'unity'),
				"param_name" => "el_class",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'unity')
			)
	   	)
	));
	add_shortcode( 'wpo_brands', ('wpo_vc_shortcode_render') );


	/*********************************************************************************************************************
	 * Pricing Table
	 *********************************************************************************************************************/
	vc_map( array(
	    "name" => __("WPO Pricing",'unity'),
	    "base" => "wpo_pricing",
	    "description" => __('Make Plan for membership', 'unity' ),
	    "class" => "",
	    "category" => __('Opal Widgets', 'unity'),
	    "params" => array(
	    	array(
				"type" => "textfield",
				"heading" => __("Title", 'unity'),
				"param_name" => "title",
				"value" => '',
					"admin_label" => true
			),
			array(
				"type" => "textfield",
				"heading" => __("Price", 'unity'),
				"param_name" => "price",
				"value" => '',
				'description'	=> ''
			),
			array(
				"type" => "textfield",
				"heading" => __("Currency", 'unity'),
				"param_name" => "currency",
				"value" => '',
				'description'	=> ''
			),
			array(
				"type" => "textfield",
				"heading" => __("Period", 'unity'),
				"param_name" => "period",
				"value" => '',
				'description'	=> ''
			),
			array(
				"type" => "textfield",
				"heading" => __("Subtitle", 'unity'),
				"param_name" => "subtitle",
				"value" => '',
				'description'	=> ''
			),
			array(
				"type" => "dropdown",
				"heading" => __("Is Featured", 'unity'),
				"param_name" => "featured",
				'value' 	=> array(  __('No', 'unity') => 0,  __('Yes', 'unity') => 1 ),
			),

			array(
				"type" => "dropdown",
				"heading" => __("Box Style", 'unity'),
				"param_name" => "style",
				'value' 	=> array( 'boxed' => __('Boxed', 'unity'), 'label' => __('Label', 'unity') , 'table' => __('Table', 'unity') ),
			),

			array(
				"type" => "textarea_html",
				"heading" => __("Content", 'unity'),
				"param_name" => "content",
				"value" => '',
				'description'	=> __('Allow  put html tags', 'unity')
			),

			array(
				"type" => "textfield",
				"heading" => __("Link Title", 'unity'),
				"param_name" => "linktitle",
				"value" => '',
				'description'	=> ''
			),

			array(
				"type" => "textfield",
				"heading" => __("Link", 'unity'),
				"param_name" => "link",
				"value" => '',
				'description'	=> ''
			),
			array(
				"type" => "textfield",
				"heading" => __("Extra class name", 'unity'),
				"param_name" => "el_class",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'unity')
			)
	   	)
	));
	add_shortcode( 'wpo_pricing', ('wpo_vc_shortcode_render') );

	/******************************
	 * Our Team
	 ******************************/
	vc_map( array(
	    "name" => __("WPO Our Team Grid Style",'unity'),
	    "base" => "wpo_team",
	    "class" => "",
	    "description" => 'Show Personal Profile Info',
	    "category" => __('Opal Widgets', 'unity'),
	    "params" => array(
	    	array(
				"type" => "textfield",
				"heading" => __("Title", 'unity'),
				"param_name" => "title",
				"value" => '',
					"admin_label" => true
			),
			array(
				"type" => "attach_image",
				"heading" => __("Photo", 'unity'),
				"param_name" => "photo",
				"value" => '',
				'description'	=> ''
			),
			array(
				"type" => "textfield",
				"heading" => __("Job", 'unity'),
				"param_name" => "job",
				"value" => 'CEO',
				'description'	=>  ''
			),

			array(
				"type" => "textarea",
				"heading" => __("information", 'unity'),
				"param_name" => "information",
				"value" => '',
				'description'	=> __('Allow  put html tags', 'unity')
			),
			array(
				"type" => "textfield",
				"heading" => __("Phone", 'unity'),
				"param_name" => "phone",
				"value" => '',
				'description'	=> ''
			),
			array(
				"type" => "textfield",
				"heading" => __("Google Plus", 'unity'),
				"param_name" => "google",
				"value" => '',
				'description'	=> ''
			),
			array(
				"type" => "textfield",
				"heading" => __("Facebook", 'unity'),
				"param_name" => "facebook",
				"value" => '',
				'description'	=> ''
			),

			array(
				"type" => "textfield",
				"heading" => __("Twitter", 'unity'),
				"param_name" => "twitter",
				"value" => '',
				'description'	=> ''
			),

			array(
				"type" => "textfield",
				"heading" => __("Pinterest", 'unity'),
				"param_name" => "pinterest",
				"value" => '',
				'description'	=> ''
			),

			array(
				"type" => "textfield",
				"heading" => __("Linked In", 'unity'),
				"param_name" => "linkedin",
				"value" => '',
				'description'	=> ''
			),

			array(
				"type" => "dropdown",
				"heading" => __("Style", 'unity'),
				"param_name" => "style",
				'value' 	=> array( 'circle' => __('circle', 'unity'), 'vertical' => __('vertical', 'unity') , 'horizontal' => __('horizontal', 'unity') ),
			),

			array(
				"type" => "textfield",
				"heading" => __("Extra class name", 'unity'),
				"param_name" => "el_class",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'unity')
			)
	   	)
	));
	add_shortcode( 'wpo_team', ('wpo_vc_shortcode_render') );

	/******************************
	 * Our Team
	 ******************************/
	vc_map( array(
		"name" => __("WPO Our Team List Style",'unity'),
		"base" => "wpo_team_list",
		"class" => "",
		"description" => __('Show Info In List Style', 'unity'),
		"category" => __('Opal Widgets', 'unity'),
	    "params" => array(
	    	array(
				"type" => "textfield",
				"heading" => __("Title", 'unity'),
				"param_name" => "title",
				"value" => '',
					"admin_label" => true
			),
			array(
				"type" => "attach_image",
				"heading" => __("Photo", 'unity'),
				"param_name" => "photo",
				"value" => '',
				'description'	=> ''
			),
			array(
				"type" => "textfield",
				"heading" => __("Phone", 'unity'),
				"param_name" => "phone",
				"value" => '',
				'description'	=> ''
			),
			array(
				"type" => "textarea",
				"heading" => __("information", 'unity'),
				"param_name" => "information",
				"value" => '',
				'description'	=> __('Allow  put html tags', 'unity')
			),
			array(
				"type" => "textarea",
				"heading" => __("blockquote", 'unity'),
				"param_name" => "blockquote",
				"value" => '',
				'description'	=> ''
			),
			array(
				"type" => "textfield",
				"heading" => __("Email", 'unity'),
				"param_name" => "email",
				"value" => '',
				'description'	=> ''
			),
			array(
				"type" => "textfield",
				"heading" => __("Facebook", 'unity'),
				"param_name" => "facebook",
				"value" => '',
				'description'	=> ''
			),

			array(
				"type" => "textfield",
				"heading" => __("Twitter", 'unity'),
				"param_name" => "twitter",
				"value" => '',
				'description'	=> ''
			),

			array(
				"type" => "textfield",
				"heading" => __("Linked In", 'unity'),
				"param_name" => "linkedin",
				"value" => '',
				'description'	=> ''
			),

			array(
				"type" => "dropdown",
				"heading" => __("Style", 'unity'),
				"param_name" => "style",
				'value' 	=> array( 'circle' => __('circle', 'unity'), 'vertical' => __('vertical', 'unity') , 'horizontal' => __('horizontal', 'unity') ),
			),
			array(
				"type" => "textfield",
				"heading" => __("Extra class name", 'unity'),
				"param_name" => "el_class",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'unity')
			)

	   	)
	));
	add_shortcode( 'wpo_team_list', ('wpo_vc_shortcode_render') );

	/*********************************************************************************************************************
	 *  Info Box
	 *********************************************************************************************************************/
	vc_map( array(
	    "name" => __("WPO Info Box",'unity'),
	    "base" => "wpo_inforbox",
	    "class" => "",
	    "description"=> __( 'Show header, text in special style', 'unity'),
	    "category" => __('Opal Widgets', 'unity'),
	    "params" => array(
	    	array(
				"type" => "textfield",
				"heading" => __("Title", 'unity'),
				"param_name" => "title",
				"value" => '',
					"admin_label" => true
			),

			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Title font size', 'unity' ),
				'param_name' => 'size',
				'value'      => array(
					__( 'Large', 'unity' )       => 'font-size-lg',
					__( 'Medium', 'unity' )      => 'font-size-md',
					__( 'Small', 'unity' )       => 'font-size-sm',
					__( 'Extra small', 'unity' ) => 'font-size-xs'
				)
			),

			array(
				'type'       => 'dropdown',
				'heading'    => __( 'Title Alignment', 'unity' ),
				'param_name' => 'title_align',
				'value'      => array(
				__( 'Align left', 'unity' )   => 'separator_align_left',
				__( 'Align center', 'unity' ) => 'separator_align_center',
				__( 'Align right', 'unity' )  => 'separator_align_right'
				)
			),

			array(
				"type" => "textarea",
				"heading" => __("information", 'unity'),
				"param_name" => "information",
				"value" => '',
				'description'	=> __('Allow  put html tags', 'unity')
			),
			array(
				"type" => "attach_image",
				"heading" => __("Backgroup Image", 'unity'),
				"param_name" => "imagebg",
				"value" => '',
				'description'	=> ''
			),
			array(
				"type" => "colorpicker",
				"heading" => __("Background Color", 'unity'),
				"param_name" => "colorbg",
				"value" => '',
				'description'	=> ''
			),

			array(
				"type" => "textfield",
				"heading" => __("Extra class name", 'unity'),
				"param_name" => "el_class",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'unity')
			)
	   	)
	));
	add_shortcode( 'wpo_inforbox', ('wpo_vc_shortcode_render') );



	/*********************************************************************************************************************
	 *  Our Service
	 *********************************************************************************************************************/
	vc_map( array(
	    "name" => __("WPO Our Service",'unity'),
	    "base" => "wpo_service",
	    "description"=> __('Decreale Service Info', 'unity'),
	    "class" => "",
	    "category" => __('Opal Widgets', 'unity'),
	    "params" => array(
	    	array(
				"type" => "textfield",
				"heading" => __("Title", 'unity'),
				"param_name" => "title",
				"value" => '',
					"admin_label" => true
			),

			array(
				'type' => 'dropdown',
				'heading' => __( 'Title font size', 'unity' ),
				'param_name' => 'size',
				'value' => array(
					__( 'Large', 'unity' ) => 'font-size-lg',
					__( 'Medium', 'unity' ) => 'font-size-md',
					__( 'Small', 'unity' ) => 'font-size-sm',
					__( 'Extra small', 'unity' ) => 'font-size-xs'
				)
			),

			array(
				'type'                           => 'dropdown',
				'heading'                        => __( 'Title Alignment', 'unity' ),
				'param_name'                     => 'title_align',
				'value'                          => array(
				__( 'Align left', 'unity' )   => 'separator_align_left',
				__( 'Align center', 'unity' ) => 'separator_align_center',
				__( 'Align right', 'unity' )  => 'separator_align_right'
				)
			),

		 	array(
				"type" => "textfield",
				"heading" => __("FontAwsome Icon", 'unity'),
				"param_name" => "icon",
				"value" => '',
				'description'	=> __( 'This support display icon from FontAwsome, Please click', 'unity' )
								. '<a href="' . ( is_ssl()  ? 'https' : 'http') . '://fortawesome.github.io/Font-Awesome/" target="_blank">'
								. __( 'here to see the list', 'unity' ) . '</a>'
			),

			array(
				"type" => "attach_image",
				"heading" => __("Photo", 'unity'),
				"param_name" => "photo",
				"value" => '',
				'description'	=> ''
			),

			array(
				"type" => "textarea",
				"heading" => __("information", 'unity'),
				"param_name" => "information",
				"value" => '',
				'description'	=> __('Allow  put html tags', 'unity' )
			),
			array(
				"type" => "dropdown",
				"heading" => __("Style", 'unity'),
				"param_name" => "style",
				'value' 	=> array(
					__('Default', 'unity') => 'default', 
					__('Text center', 'unity') => 'text-center', 
					__('Quote', 'unity' )=> 'quote',
					__('Icon Radius', 'unity') => 'icon-radius' 
				),
			),	
			array(
				"type" => "textfield",
				"heading" => __("Extra class name", 'unity'),
				"param_name" => "el_class",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'unity')
			)
	   	)
	));
	add_shortcode( 'wpo_service', ('wpo_vc_shortcode_render') );



	/*********************************************************************************************************************
	 *  WPO Counter
	 *********************************************************************************************************************/
	vc_map( array(
	    "name" => __("WPO Counter",'unity'),
	    "base" => "wpo_counter",
	    "class" => "",
	    "description"=> __('Counting number with your term', 'unity'),
	    "category" => __('Opal Widgets', 'unity'),
	    "params" => array(
	    	array(
				"type" => "textfield",
				"heading" => __("Title", 'unity'),
				"param_name" => "title",
				"value" => '',
					"admin_label" => true
			),

			array(
				"type" => "textfield",
				"heading" => __("Number", 'unity'),
				"param_name" => "number",
				"value" => ''
			),

		 	array(
				"type" => "textfield",
				"heading" => __("FontAwsome Icon", 'unity'),
				"param_name" => "icon",
				"value" => 'fa-desktop',
				'description'	=> __( 'This support display icon from FontAwsome, Please click', 'unity' )
								. '<a href="' . ( is_ssl()  ? 'https' : 'http') . '://fortawesome.github.io/Font-Awesome/" target="_blank">'
								. __( 'here to see the list', 'unity' ) . '</a>'
			),


			array(
				"type" => "attach_image",
				"description" => __("If you upload an image, icon will not show.", 'unity'),
				"param_name" => "image",
				"value" => '',
				'heading'	=> __('Image', 'unity' )
			),

			array(
				"type" => "colorpicker",
				"heading" => __("Icon Color", 'unity'),
				"param_name" => "color",
				"value" => '',
				'description'	=> ''
			),

			array(
				"type" => "dropdown",
				"heading" => __("Style", 'unity'),
				"param_name" => "style",
				'value' 	=> array( 'circle' => __('circle', 'unity'), 'vertical' => __('vertical', 'unity') , 'horizontal' => __('horizontal', 'unity') ),
			),

			array(
				"type" => "textfield",
				"heading" => __("Extra class name", 'unity'),
				"param_name" => "el_class",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'unity')
			)
	   	)
	));
	 



	/*********************************************************************************************************************
	 *  Mega Posts
	 *********************************************************************************************************************/

	function parramMegaLayout($settings,$value){
		$dependency = vc_generate_dependencies_attributes($settings);
		ob_start();
		?>
			<div class="layout_images">
				<?php foreach ($settings['layout_images'] as $key => $image) {
					echo '<img src="'.esc_url( $image ).'" data-layout="'.esc_attr( $key ).'" class="'.esc_attr( $key ).' '.(($key==$value)?'active':'').'">';
				} ?>
			</div>
			<input 	type="hidden"
					name="<?php echo esc_attr( $settings['param_name'] ); ?>"
					class="layout_image_field wpb_vc_param_value wpb-textinput <?php echo esc_attr( $settings['param_name'] ).' '.esc_attr( $settings['type'] ).'_field'; ?>"
					value="<?php echo esc_attr( $value ); ?>" <?php echo trim( $dependency ); ?>>
		<?php
		return ob_get_clean();
	}
	 

 
	$layout_image = array(
		__('Grid', 'unity')             => 'grid-1',
		__('List', 'unity')             => 'list-1',
		__('List not image', 'unity')   => 'list-2',
	);


	vc_map( array(
		'name' => __( 'WPO Grid Posts', 'unity' ),
		'base' => 'wpo_gridposts',
		'icon' => 'icon-wpb-application-icon-large',
		"category" => __('Opal Widgets', 'unity'),
		'description' => __( 'Post having news,managzine style', 'unity' ),
	 
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Widget title', 'unity' ),
				'param_name' => 'title',
				'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'unity' ),
				"admin_label" => true
			),

			array(
				'type'                           => 'dropdown',
				'heading'                        => __( 'Title Alignment', 'unity' ),
				'param_name'                     => 'alignment',
				'value'                          => array(
				__( 'Align left', 'unity' )   => 'separator_align_left',
				__( 'Align center', 'unity' ) => 'separator_align_center',
				__( 'Align right', 'unity' )  => 'separator_align_right'
				)
			),

			array(
				'type' => 'dropdown',
				'heading' => __( 'Title font size', 'unity' ),
				'param_name' => 'size',
				'value' => array(
					__( 'Large', 'unity' ) => 'font-size-lg',
					__( 'Medium', 'unity' ) => 'font-size-md',
					__( 'Small', 'unity' ) => 'font-size-sm',
					__( 'Extra small', 'unity' ) => 'font-size-xs'
				)
			),

			array(
				'type' => 'loop',
				'heading' => __( 'Grids content', 'unity' ),
				'param_name' => 'loop',
				'settings' => array(
					'size' => array( 'hidden' => false, 'value' => 4 ),
					'order_by' => array( 'value' => 'date' ),
				),
				'description' => __( 'Create WordPress loop, to populate content from your site.', 'unity' )
			),
			array(
				"type" => "dropdown",
				"heading" => __("Layout Type", 'unity'),
				"param_name" => "layout",
				"layout_images" => $layout_image,
				"value" => $layout_image,
				"admin_label" => true,
				"description" => __("Select Skin layout.", 'unity')
			),
			array(
				"type" => "dropdown",
				"heading" => __("Grid Columns", 'unity'),
				"param_name" => "grid_columns",
				"value" => array( 1 , 2 , 3 , 4 , 6),
				"std" => 3
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Thumbnail size', 'unity' ),
				'param_name' => 'grid_thumb_size',
				'description' => __( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'unity' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'unity' ),
				'param_name' => 'el_class',
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'unity' )
			)
		)
	) );


	/**********************************************************************************
	 * Front Page Posts
	 **********************************************************************************/

	$layout = array(
		__('List', 'unity') 	=> 'frontpage-1',
		__('Inline', 'unity') 	=> 'frontpage-2',
		__('Slide thumbnail', 'unity') 	=> 'frontpage-3',
	);


	vc_map( array(
		'name' => __( 'WPO FrontPage Posts', 'unity' ),
		'base' => 'wpo_frontpageposts',
		'icon' => 'icon-wpb-application-icon-large',
		"category" => __('Opal Widgets', 'unity'),
		'description' => __( 'Create Post having blog styles', 'unity' ),
		 
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Widget title', 'unity' ),
				'param_name' => 'title',
				'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'unity' ),
				"admin_label" => true
			),

			array(
				'type'                           => 'dropdown',
				'heading'                        => __( 'Title Alignment', 'unity' ),
				'param_name'                     => 'alignment',
				'value'                          => array(
				__( 'Align left', 'unity' )   => 'separator_align_left',
				__( 'Align center', 'unity' ) => 'separator_align_center',
				__( 'Align right', 'unity' )  => 'separator_align_right'
				)
			),

			array(
				'type' => 'dropdown',
				'heading' => __( 'Title font size', 'unity' ),
				'param_name' => 'size',
				'value' => array(
					__( 'Large', 'unity' ) => 'font-size-lg',
					__( 'Medium', 'unity' ) => 'font-size-md',
					__( 'Small', 'unity' ) => 'font-size-sm',
					__( 'Extra small', 'unity' ) => 'font-size-xs'
				)
			),

			array(
				'type' => 'loop',
				'heading' => __( 'Grids content', 'unity' ),
				'param_name' => 'loop',
				'settings' => array(
					'size' => array( 'hidden' => false, 'value' => 4 ),
					'order_by' => array( 'value' => 'date' ),
				),
				'description' => __( 'Create WordPress loop, to populate content from your site.', 'unity' )
			),

			array(
				"type" => "dropdown",
				"heading" => __("Layout", 'unity' ),
				"param_name" => "layout",
				"value" => $layout,
				"std" => 'frontpage-1'
			),

			array(
				"type" => "dropdown",
				"heading" => __("Number Main Posts", 'unity'),
				"param_name" => "num_mainpost",
				"value" => array( 1 , 2 , 3 , 4 , 5 , 6),
				"std" => 1
			),

			array(
				'type' => 'textfield',
				'heading' => __( 'Thumbnail size', 'unity' ),
				'param_name' => 'grid_thumb_size',
				'description' => __( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'unity' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'unity' ),
				'param_name' => 'el_class',
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'unity' )
			)
		)
	) );
	/**********************************************************************************
	 * Mega Blogs
	 **********************************************************************************/
	vc_map( array(
		'name' => __( 'WPO Mega Blogs', 'unity' ),
		'base' => 'wpo_megablogs',
		'icon' => 'icon-wpb-application-icon-large',
		"category" => __('Opal Widgets', 'unity'),
		'description' => __( 'Create Post having blog styles', 'unity' ),
		 
		'params' => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Widget title', 'unity' ),
				'param_name' => 'title',
				'description' => __( 'Enter text which will be used as widget title. Leave blank if no title is needed.', 'unity' ),
				"admin_label" => true
			),

			array(
				'type' => 'dropdown',
				'heading' => __( 'Title Alignment', 'unity' ),
				'param_name' => 'alignment',
				'value' => array(
					__( 'Align left', 'unity' ) => 'separator_align_left',
					__( 'Align center', 'unity' ) => 'separator_align_center',
					__( 'Align right', 'unity' ) => 'separator_align_right'
				)
			),

			array(
				'type' => 'dropdown',
				'heading' => __( 'Title font size', 'unity' ),
				'param_name' => 'size',
				'value' => array(
					__( 'Large', 'unity' ) => 'font-size-lg',
					__( 'Medium', 'unity' ) => 'font-size-md',
					__( 'Small', 'unity' ) => 'font-size-sm',
					__( 'Extra small', 'unity' ) => 'font-size-xs'
				)
			),

			array(
				'type' => 'textarea',
				'heading' => __( 'Description', 'unity' ),
				'param_name' => 'descript',
				"value" => ''
			),

			array(
				'type' => 'loop',
				'heading' => __( 'Grids content', 'unity' ),
				'param_name' => 'loop',
				'settings' => array(
					'size' => array( 'hidden' => false, 'value' => 10 ),
					'order_by' => array( 'value' => 'date' ),
				),
				'description' => __( 'Create WordPress loop, to populate content from your site.', 'unity' )
			),

			array(
				"type" => "dropdown",
				"heading" => __("Layout", 'unity' ),
				"param_name" => "layout",
				"value" => array( __('Default Style', 'unity' ) => 'blog'  ,  __('Special Style 1', 'unity' ) => 'style1' ,  __('Special Style 2', 'unity' ) => 'style2' ),
				"std" => 3
			),

			array(
				"type" => "dropdown",
				"heading" => __("Grid Columns", 'unity'),
				"param_name" => "grid_columns",
				"value" => array( 1 , 2 , 3 , 4 , 6),
				"std" => 3
			),


			array(
				'type' => 'textfield',
				'heading' => __( 'Thumbnail size', 'unity' ),
				'param_name' => 'grid_thumb_size',
				'description' => __( 'Enter thumbnail size. Example: thumbnail, medium, large, full or other sizes defined by current theme. Alternatively enter image size in pixels: 200x100 (Width x Height) . ', 'unity' )
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'unity' ),
				'param_name' => 'el_class',
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'unity' )
			)
		)
	) );

	/* Heading Text Block
	---------------------------------------------------------- */
	vc_map( array(
		'name'        => __( 'WPO Title Heading','unity'),
		'base'        => 'wpo_title_heading',
		"class"       => "",
		"category"    => __('Opal Widgets', 'unity'),
		'description' => __( 'Create title for one block', 'unity' ),
		"params"      => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Widget title', 'unity' ),
				'param_name' => 'title',
				'value'       => __( 'Title', 'unity' ),
				'description' => __( 'Enter heading title.', 'unity' ),
				"admin_label" => true
			),
			array(
			    'type' => 'colorpicker',
			    'heading' => __( 'Title Color', 'unity' ),
			    'param_name' => 'font_color',
			    'description' => __( 'Select font color', 'unity' )
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Title font size', 'unity' ),
				'param_name' => 'size',
				'value' => array(
					__( 'Large', 'unity' ) => 'font-size-lg',
					__( 'Medium', 'unity' ) => 'font-size-md',
					__( 'Small', 'unity' ) => 'font-size-sm',
					__( 'Extra small', 'unity' ) => 'font-size-xs'
				),
				'description' => __( 'Select title font size.', 'unity' )
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Title Align', 'unity' ),
				'param_name' => 'title_align',
				'value' => array(
					__( 'Align center', 'unity' ) => 'separator_align_center',
					__( 'Align left', 'unity' ) => 'separator_align_left',
					__( 'Align right', 'unity' ) => "separator_align_right"
				),
				'description' => __( 'Select title align.', 'unity' )
			),
			array(
				"type" => "textarea",
				'heading' => __( 'Description', 'unity' ),
				"param_name" => "descript",
				"value" => '',
				'description' => __( 'Enter description for title.', 'unity' )
		    ),
			array(
				'type' => 'textfield',
				'heading' => __( 'Extra class name', 'unity' ),
				'param_name' => 'el_class',
				'description' => __( 'If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'unity' )
			)
		),
	));
	add_shortcode( 'wpo_title_heading', ('wpo_vc_shortcode_render') );


	/*********************************************************************************************************************
	*  Reassuarence
	*********************************************************************************************************************/
	vc_map( array(
	    "name" => __("WPO Reassuarence",'unity'),
	    "base" => "wpo_reassuarence",
	    "class" => "",
	    "description"=> __('Counting number with your term', 'unity'),
	    "category" => __('Opal Widgets', 'unity'),
	    "params" => array(
	    	array(
				"type" => "textfield",
				"heading" => __("Title", 'unity'),
				"param_name" => "title",
				"value" => '',
				"admin_label" => true
			),

			array(
				'type' => 'dropdown',
				'heading' => __( 'Title Alignment', 'unity' ),
				'param_name' => 'alignment',
				'value' => array(
					__( 'Align left', 'unity' ) => 'separator_align_left',
					__( 'Align center', 'unity' ) => 'separator_align_center',
					__( 'Align right', 'unity' ) => 'separator_align_right'
				)
			),

			array(
				'type' => 'dropdown',
				'heading' => __( 'Title font size', 'unity' ),
				'param_name' => 'size',
				'value' => array(
					__( 'Large', 'unity' ) => 'font-size-lg',
					__( 'Medium', 'unity' ) => 'font-size-md',
					__( 'Small', 'unity' ) => 'font-size-sm',
					__( 'Extra small', 'unity' ) => 'font-size-xs'
				)
			),


		 	array(
				"type" => "textfield",
				"heading" => __("FontAwsome Icon", 'unity'),
				"param_name" => "icon",
				"value" => '',
				'description'	=> __( 'This support display icon from FontAwsome, Please click', 'unity' )
								. '<a href="' . ( is_ssl()  ? 'https' : 'http') . '://fortawesome.github.io/Font-Awesome/" target="_blank"> '
								. __( 'here to see the list', 'unity' ) . '</a>'
			),

			array(
				"type" => "textfield",
				"heading" => __("Icon Color", 'unity'),
				"param_name" => "color",
				"value" => 'black'
			),


			array(
				"type" => "attach_image",
				"description" => __("If you upload an image, icon will not show.", 'unity'),
				"param_name" => "image",
				"value" => '',
				'heading'	=> __('Image', 'unity' )
			),

		 	array(
				"type" => "textarea",
				"heading" => __("Short Information", 'unity'),
				"param_name" => "description",
				"value" => '',
				'description'	=> __('Allow  put html tags', 'unity')
			),


		 	array(
				"type" => "textarea_html",
				"heading" => __("Detail Information", 'unity'),
				"param_name" => "information",
				"value" => '',
				'description'	=> __('Allow  put html tags', 'unity')
			),


			array(
				"type" => "dropdown",
				"heading" => __("Style", 'unity'),
				"param_name" => "style",
				'value' 	=> array( 'circle' => __('circle', 'unity'), 'vertical' => __('vertical', 'unity') , 'horizontal' => __('horizontal', 'unity') ),
			),

			array(
				"type" => "textfield",
				"heading" => __("Extra class name", 'unity'),
				"param_name" => "el_class",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'unity')
			)
	   	)
	));
	add_shortcode( 'wpo_reassuarence', ('wpo_vc_shortcode_render') );
	


	/*********************************************************************************************************************
	 *  Facebook Like Box
	 *********************************************************************************************************************/
	vc_map( array(
		'name'        => __( 'WPO Facebook Like Box','unity'),
		'base'        => 'wpo_facebook_like_box',
		"class"       => "",
		"category"    => __('Opal Widgets', 'unity'),
		'description' => __( 'Create title for one block', 'unity' ),
		"params"      => array(
			array(
				'type' => 'textfield',
				'heading' => __( 'Widget', 'unity' ),
				'param_name' => 'title',
				'value'       => __( 'Find us on Facebook', 'unity' ),
				'description' => __( 'Enter heading title.', 'unity' ),
				"admin_label" => true
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Title font size', 'unity' ),
				'param_name' => 'size',
				'value' => array(
					__( 'Large', 'unity' ) => 'font-size-lg',
					__( 'Medium', 'unity' ) => 'font-size-md',
					__( 'Small', 'unity' ) => 'font-size-sm',
					__( 'Extra small', 'unity' ) => 'font-size-xs'
				)
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Title Alignment', 'unity' ),
				'param_name' => 'alignment',
				'value' => array(
					__( 'Align left', 'unity' ) => 'separator_align_left',
					__( 'Align center', 'unity' ) => 'separator_align_center',
					__( 'Align right', 'unity' ) => 'separator_align_right'
				)
			),
			array(
				"type" => "textfield",
				"heading" => __("Facebook Page URL", 'unity'),
				"param_name" => "page_url",
				"value" => "#"
			),
			array(
				"type" => "textfield",
				"heading" => __("Width", 'unity'),
				"param_name" => "width",
				"value" => 268
			),		
			array(
				'type' => 'dropdown',
				'heading' => __( 'Color Scheme', 'unity' ),
				'param_name' => 'color_scheme',
				'value' => array(
					__( 'Light', 'unity' ) => 'light',
					__( 'Dark', 'unity' ) => 'dark'
				),
				'description' => __( 'Select Color Scheme.', 'unity' )
			),
			array(
                "type" => "checkbox",
                "heading" => $this->l("Show faces"),
                "param_name" => "show_faces",
                "value" => array(
                    'Yes, please' => true
                )
			),
			array(
                "type" => "checkbox",
                "heading" => $this->l("Show stream"),
                "param_name" => "show_stream",
                "value" => array(
                    'Yes, please' => true
                )
			),
			array(
                "type" => "checkbox",
                "heading" => $this->l("Show facebook header"),
                "param_name" => "show_header",
                "value" => array(
                    'Yes, please' => true
                )
			),	
			array(
				"type" => "textfield",
				"heading" => __("Extra class name", 'unity'),
				"param_name" => "el_class",
				"value" => ''
			),									
		),
	));
	
	add_shortcode( 'wpo_facebook_like_box', ('wpo_vc_shortcode_render') );	

	/*********************************************************************************************************************
	 *  Gallery grid
	 *********************************************************************************************************************/
	vc_map( array(
	    "name" => __("WPO Gallery Grid",'unity'),
	    "base" => "wpo_gallery_grid",
	    'icon' => 'icon-wpb-application-icon-large',
	    'description'=>'Display Gallery Grid',
	    "class" => "",
	    "category" => __('Opal Widgets', 'unity'),
	    "params" => array(
	    	array(
				"type" => "textfield",
				"heading" => __("Title", 'unity'),
				"param_name" => "title",
				"value" => '',
				"admin_label" => true
			),
	    	array(
				'type' => 'dropdown',
				'heading' => __( 'Title font size', 'unity' ),
				'param_name' => 'size',
				'value' => array(
					__( 'Large', 'unity' ) => 'font-size-lg',
					__( 'Medium', 'unity' ) => 'font-size-md',
					__( 'Small', 'unity' ) => 'font-size-sm',
					__( 'Extra small', 'unity' ) => 'font-size-xs'
				)
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Title Alignment', 'unity' ),
				'param_name' => 'alignment',
				'value' => array(
					__( 'Align left', 'unity' ) => 'separator_align_left',
					__( 'Align center', 'unity' ) => 'separator_align_center',
					__( 'Align right', 'unity' ) => 'separator_align_right'
				)
			),
			array(
				"type" => "textfield",
				'heading' => __( 'Number gallery', 'unity' ),
				"param_name" => "number",
				"value" => '6'
		    ),
		    array(
				"type" => "dropdown",
				'heading' => __( 'Columns', 'unity' ),
				"param_name" => "column",
				"value" => array('2'=>'2', '3'=>'3', '4'=>'4')
		    ),
		    array(
				"type" => "dropdown",
				'heading' => __( 'Remove Padding', 'unity' ),
				"param_name" => "padding",
				"value" => array(__('No', 'unity') => '', __('Yes', 'unity') => '1')
		    ),
		    array(
				"type" => "textfield",
				'heading' => __( 'Extra class name', 'unity' ),
				"param_name" => "class",
				"value" => ''
		    )
	   	)
	));
	add_shortcode( 'wpo_gallery_grid', ('wpo_vc_shortcode_render') );

	/*********************************************************************************************************************
	 *  Gallery portfolio
	 *********************************************************************************************************************/
	vc_map( array(
	    "name" => __("WPO Gallery Filter",'unity'),
	    "base" => "wpo_gallery_filter",
	    'icon' => 'icon-wpb-application-icon-large',
	    'description'=>'Display Gallery Filter',
	    "class" => "",
	    "category" => __('Opal Widgets', 'unity'),
	    "params" => array(
	    	array(
				"type" => "textfield",
				"heading" => __("Title", 'unity'),
				"param_name" => "title",
				"value" => '',
				"admin_label" => true
			),
	    	array(
				'type' => 'dropdown',
				'heading' => __( 'Title font size', 'unity' ),
				'param_name' => 'size',
				'value' => array(
					__( 'Large', 'unity' ) => 'font-size-lg',
					__( 'Medium', 'unity' ) => 'font-size-md',
					__( 'Small', 'unity' ) => 'font-size-sm',
					__( 'Extra small', 'unity' ) => 'font-size-xs'
				)
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Title Alignment', 'unity' ),
				'param_name' => 'alignment',
				'value' => array(
					__( 'Align left', 'unity' ) => 'separator_align_left',
					__( 'Align center', 'unity' ) => 'separator_align_center',
					__( 'Align right', 'unity' ) => 'separator_align_right'
				)
			),
			array(
				'type' => 'textfield',
				'heading' => __( 'Number gallery', 'unity' ),
				'param_name' => 'number',
				'value' => '9'
		    ),
		    array(
				"type" => "dropdown",
				'heading' => __( 'Columns', 'unity' ),
				'param_name' => 'column',
				"value" => array('2' => '2', '3' => '3', '4' => '4'),
		    ),
		    array(
		    	'type' => 'dropdown',
		    	'heading' => __('Show Pagination', 'unity'),
		    	'param_name' => 'pagination',
		    	'value' => array(__('Yes', 'unity') => '1', __('No', 'unity') => '0' )
		    )
	   	)
	));
	add_shortcode( 'wpo_gallery_filter', ('wpo_vc_shortcode_render') );

	
	/*********************************************************************************************************************
	 *  Social counter
	 *********************************************************************************************************************/
	vc_map( array(
	    "name" => __("WPO Social Counter",'unity'),
	    "base" => "wpo_social_counter",
	    'icon' => 'icon-wpb-application-icon-large',
	    'description'=>'Display Social Counter',
	    "class" => "",
	    "category" => __('Opal Widgets', 'unity'),
	    "params" => array(
	    	array(
				"type" => "textfield",
				"heading" => __("Title", 'unity'),
				"param_name" => "title",
				"value" => '',
				"admin_label" => true,
				"std" => 'Social Counter'
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Title font size', 'unity' ),
				'param_name' => 'size',
				'value' => array(
					__( 'Large', 'unity' ) => 'font-size-lg',
					__( 'Medium', 'unity' ) => 'font-size-md',
					__( 'Small', 'unity' ) => 'font-size-sm',
					__( 'Extra small', 'unity' ) => 'font-size-xs'
				)
			),
			array(
				'type' => 'dropdown',
				'heading' => __( 'Title Alignment', 'unity' ),
				'param_name' => 'alignment',
				'value' => array(
					__( 'Align left', 'unity' ) => 'separator_align_left',
					__( 'Align center', 'unity' ) => 'separator_align_center',
					__( 'Align right', 'unity' ) => 'separator_align_right'
				)
			),
		    array(
                "type" => "checkbox",
                "heading" => $this->l("Display Twitter counter"),
                "param_name" => "twitter_show",
                "value" => array(
                    'Yes, please' => true
                ),
                'std' => true
			),	
		     array(
		    	"type" => "textfield",
		    	"heading" => __('Twitter Username', 'unity'),
		    	"param_name" => 'twitter_user',
		    	"value" => '',
		    	'std' => 'opalwordpress',
		    	'description'	=> __('Insert the Twitter username. Example: https://twitter.com/opalwordpress', 'unity')
		    ),
		    array(
		    	"type" => "checkbox",
		    	"heading" => __('Display Facebook counter', 'unity'),
		    	"param_name" => 'show_facebook',
		    	"value" => array(
                    'Yes, please' => true
                ),
                'std' => true
		    ), 
		    array(
		    	"type" => "textfield",
		    	"heading" => __('Facebook Page Url', 'unity'),
		    	"param_name" => 'facebook_id',
		    	"value" => '',
		    	'std' => 'opalwordpress',
		    	'description' => __('Facebook page url. Example: https://www.facebook.com/opalwordpress', 'unity')
		    ),
		    array(
		    	"type" => "checkbox",
		    	"heading" => __('Display Google+ counter', 'unity'),
		    	"param_name" => 'show_google',
		    	"value" => array(
                    'Yes, please' => true
                ),
                'std' => true
		    ),
		    array(
		    	"type" => "textfield",
		    	"heading" => __('Google+ ID', 'unity'),
		    	"param_name" => 'google_id',
		    	"value" => '',
		    	'std' => '118034858850902691620',
		    	'description' => __('Google+ page or profile ID. Example:
					https://plus.google.com/118034858850902691620', 'unity')
		    ),
		     array(
		    	"type" => "textfield",
		    	"heading" => __('Google API Key', 'unity'),
		    	"param_name" => 'google_key',
		    	"value" => '',
		    	'std' => 'AIzaSyBON-9t7IclDRgQZfW0Umnkj6dLnkELTFM',
		    	'description' => __('Get your API key creating a project/app in https://console.developers.google.com/project, 
		    					then inside your project go to "APIs & auth > APIs" and turn on the "Google+ API", 
		    					finally go to "APIs & auth > APIs > Credentials > Public API access" and click in the "CREATE A NEW KEY" button, 
		    					select the "Browser key" option and click in the "CREATE" button, now just copy your API key and paste here.', 'unity')
		    ),
		    array(
				"type" => "textfield",
				'heading' => __( 'Extra class name', 'unity' ),
				"param_name" => "class",
				"value" => ''
		    )		    
	   	)
	));
	add_shortcode( 'wpo_social_counter', ('wpo_vc_shortcode_render') );
