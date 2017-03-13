<?php

	$product_columns_deal = array(1, 2, 3, 4);
    vc_map( array(
        "name" => __("WPO Product Deals",'unity'),
        "base" => "wpo_product_deals",
        "class" => "",
        "category" => $this->l('WPO Elements'),
        "params" => array(
            array(
                "type" => "textfield",
                "class" => "",
                "heading" => $this->l('Title'),
                "param_name" => "title",
                "admin_label" => true
            ),
            array(
                "type" => "textfield",
                "heading" => __("Extra class name", 'unity'),
                "param_name" => "el_class",
                "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'unity')
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Columns count",'unity'),
                "param_name" => "columns_count",
                "value" => $product_columns_deal,
                "admin_label" => true,
                "description" => __("Select columns count.",'unity')
            ),
            array(
                "type" => "dropdown",
                "heading" => __("Layout",'unity'),
                "param_name" => "layout",
                "value" => array(__('Carousel', 'unity') => 'carousel', __('Grid', 'unity') =>'grid' ),
                "admin_label" => true,
                "description" => __("Select columns count.",'unity')
            )
        )
    ));
    add_shortcode( 'wpo_product_deals', ('wpo_vc_shortcode_render') );

	/**
	 * wpo_productcategory
	 */
	global $wpdb;
	$sql = "SELECT a.name,a.slug,a.term_id FROM $wpdb->terms a JOIN  $wpdb->term_taxonomy b ON (a.term_id= b.term_id ) where b.count>0 and b.taxonomy = 'product_cat'";
	$results = $wpdb->get_results($sql);
	$value = array();
	foreach ($results as $vl) {
		$value[$vl->name] = $vl->slug;
	}

	$product_layout = array('Grid'=>'grid','List'=>'list','Carousel'=>'carousel', 'Special'=>'special');
	$product_type = array('Best Selling'=>'best_selling','Featured Products'=>'featured_product','Top Rate'=>'top_rate','Recent Products'=>'recent_product','On Sale'=>'on_sale','Recent Review' => 'recent_review' );
	$product_columns = array(6,4, 3, 2, 1);
	$show_tab = array(
	                array('recent', __('Latest Products', 'unity')),
	                array( 'featured_product', __('Featured Products', 'unity' )),
	                array('best_selling', __('BestSeller Products', 'unity' )),
	                array('top_rate', __('TopRated Products', 'unity' )),
	                array('on_sale', __('Special Products', 'unity' ))
	            );

	vc_map( array(
	    "name" => __("WPO Product Category",'unity'),
	    "base" => "wpo_productcategory",
	    "class" => "",
	    "category" =>__("Opal Widgets",'unity'),
	    "params" => array(
	    	array(
				"type" => "textfield",
				"class" => "",
				"heading" => __('Title', 'unity'),
				"param_name" => "title",
				"value" =>''
			),
	    	array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __('Category', 'unity'),
				"param_name" => "category",
				"value" =>$value,
				"admin_label" => true
			),
			array(
				"type" => "dropdown",
				"heading" => __("Style",'unity'),
				"param_name" => "style",
				"value" => $product_layout
			),
			array(
				"type"        => "attach_image",
				"description" => __("Upload an image for categories", 'unity'),
				"param_name"  => "image_cat",
				"value"       => '',
				'heading'     => __('Image', 'unity' )
			),
			array(
				"type" => "textfield",
				"heading" => __("Number of products to show",'unity'),
				"param_name" => "number",
				"value" => '4'
			),
			array(
				"type" => "dropdown",
				"heading" => __("Columns count",'unity'),
				"param_name" => "columns_count",
				"value" => $product_columns,
				"admin_label" => true,
				"description" => __("Select columns count.",'unity')
			),
			array(
				"type" => "textfield",
				"heading" => __("Icon",'unity'),
				"param_name" => "icon"
			),
			array(
				"type" => "textfield",
				"heading" => __("Extra class name",'unity'),
				"param_name" => "el_class",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.",'unity')
			)
	   	)
	));
	add_shortcode( 'wpo_productcategory', ('wpo_vc_shortcode_render') );



	/**
	* wpo_category_filter
	*/
	$cats = array();
	$query = "SELECT a.name,a.slug,a.term_id FROM $wpdb->terms a JOIN  $wpdb->term_taxonomy b ON (a.term_id= b.term_id ) where b.count>0 and b.taxonomy = 'product_cat' and b.parent = 0";
	$categories = $wpdb->get_results($query);
	foreach ($categories as $category) {
		$cats[$category->name] = $category->term_id;
	}

	vc_map( array(
			"name"     => __("WPO Product Categories Filter",'unity'),
			"base"     => "wpo_category_filter",
			"class"    => "",
			"category" => __('Opal Widgets', 'unity'),
			"params"   => array(

			array(
				"type" => "dropdown",
				"class" => "",
				"heading" => __('Category', 'unity'),
				"param_name" => "term_id",
				"value" =>$cats,
				"admin_label" => true
			),

			array(
				"type"        => "attach_image",
				"description" => __("Upload an image for categories (190px x 190px)", 'unity'),
				"param_name"  => "image_cat",
				"value"       => '',
				'heading'     => __('Image', 'unity' )
			),

			array(
				"type"       => "textfield",
				"heading"    => __("Number of categories to show",'unity'),
				"param_name" => "number",
				"value"      => '5'
			),

			array(
				"type"        => "textfield",
				"heading"     => __("Extra class name",'unity'),
				"param_name"  => "el_class",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.",'unity')
			)
	   	)
	));
	add_shortcode( 'wpo_category_filter', ('wpo_vc_shortcode_render')  );



	/**
	 * wpo_products
	 */
	vc_map( array(
	    "name" => __("WPO Products",'unity'),
	    "base" => "wpo_products",
	    "class" => "",
	    "category" => __('Opal Widgets', 'unity'),
	    "params" => array(
	    	array(
				"type" => "textfield",
				"heading" => __("Title",'unity'),
				"param_name" => "title",
				"admin_label" => true,
				"value" => ''
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
				'param_name' => 'title_align',
				'value' => array(
					__( 'Align left', 'unity' ) => 'separator_align_left',
					__( 'Align center', 'unity' ) => 'separator_align_center',
					__( 'Align right', 'unity' ) => 'separator_align_right'
				)
			),
	    	array(
				"type" => "dropdown",
				"heading" => __("Type",'unity'),
				"param_name" => "type",
				"value" => $product_type,
				"admin_label" => true,
				"description" => __("Select columns count.",'unity')
			),
			array(
				"type" => "dropdown",
				"heading" => __("Style",'unity'),
				"param_name" => "style",
				"value" => $product_layout
			),
			array(
				"type" => "dropdown",
				"heading" => __("Columns count",'unity'),
				"param_name" => "columns_count",
				"value" => $product_columns,
				"admin_label" => true,
				"description" => __("Select columns count.",'unity')
			),
			array(
				"type" => "textfield",
				"heading" => __("Number of products to show",'unity'),
				"param_name" => "number",
				"value" => '4'
			),
			array(
				"type" => "textfield",
				"heading" => __("Extra class name",'unity'),
				"param_name" => "el_class",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.",'unity')
			)
	   	)
	));
	add_shortcode( 'wpo_products', ('wpo_vc_shortcode_render')  );

	/**
	 * wpo_all_products
	 */
	vc_map( array(
	    "name" => __("WPO Products Tabs",'unity'),
	    "base" => "wpo_all_products",
	    "class" => "",
	    "category" => __('Opal Widgets', 'unity'),
	    "params" => array(
	    	array(
				"type" => "textfield",
				"heading" => __("Title",'unity'),
				"param_name" => "title",
				"admin_label" => true,
				"value" => ''
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
				'param_name' => 'title_align',
				'value' => array(
					__( 'Align left', 'unity' ) => 'separator_align_left',
					__( 'Align center', 'unity' ) => 'separator_align_center',
					__( 'Align right', 'unity' ) => 'separator_align_right'
				)
			),
			array(
	            "type" => "sorted_list",
	            "heading" => __("Show Tab", 'unity'),
	            "param_name" => "show_tab",
	            "description" => __("Control teasers look. Enable blocks and place them in desired order.", 'unity'),
	            "value" => "recent,featured_product,best_selling",
	            "options" => $show_tab
	        ),
	        array(
				"type" => "dropdown",
				"heading" => __("Style",'unity'),
				"param_name" => "style",
				"value" => $product_layout
			),
			array(
				"type" => "textfield",
				"heading" => __("Number of products to show",'unity'),
				"param_name" => "number",
				"value" => '4'
			),
			array(
				"type" => "dropdown",
				"heading" => __("Columns count",'unity'),
				"param_name" => "columns_count",
				"value" => $product_columns,
				"admin_label" => true,
				"description" => __("Select columns count.",'unity')
			),
			array(
				"type" => "textfield",
				"heading" => __("Extra class name",'unity'),
				"param_name" => "el_class",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.",'unity')
			)
	   	)
	));

	/**
	 * wpo_brands
	 */
	vc_map( array(
	    "name" => __("WPO Brands", 'unity' ),
	    "base" => "wpo_brands",
	    "class" => "",
	    "category" => __('Opal Widgets', 'unity'),
	    "params" => array(
	    	array(
				"type" => "textfield",
				"heading" => __("Title",'unity'),
				"param_name" => "title",
				"value" => '',
				"admin_label" => true
			),
			array(
				"type" => "textfield",
				"heading" => __("Number of brands to show",'unity'),
				"param_name" => "number",
				"value" => '6'
			),
			array(
				"type" => "textfield",
				"heading" => __("Icon",'unity'),
				"param_name" => "icon"
			),
			array(
				"type" => "textfield",
				"heading" => __("Extra class name",'unity'),
				"param_name" => "el_class",
				"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.",'unity')
			)
	   	)
	));
	add_shortcode( 'wpo_brands', ('wpo_vc_shortcode_render')  );

	vc_map( array(
		"name"     => __("WPO Product Categories List",'unity'),
		"base"     => "wpo_category_list",
		"class"    => "",
		"category" => __('Opal Widgets', 'unity'),
		"params"   => array(
		array(
			"type" => "textfield",
			"class" => "",
			"heading" => __('Title', 'unity'),
			"param_name" => "title",
			"value"      => '',
		),
		array(
			'type' => 'checkbox',
			'heading' => __( 'Show post counts', 'unity' ),
			'param_name' => 'show_count',
			'description' => __( 'Enables show count total product of category.', 'unity' ),
			'value' => array( __( 'Yes, please', 'unity' ) => 'yes' )
		),
		array(
			"type"       => "checkbox",
			"heading"    => __("show children of the current category",'unity'),
			"param_name" => "show_children",
			'description' => __( 'Enables show children of the current category.', 'unity' ),
			'value' => array( __( 'Yes, please', 'unity' ) => 'yes' )
		),
		array(
			"type"       => "checkbox",
			"heading"    => __("Show dropdown children of the current category ",'unity'),
			"param_name" => "show_dropdown",
			'description' => __( 'Enables show dropdown children of the current category.', 'unity' ),
			'value' => array( __( 'Yes, please', 'unity' ) => 'yes' )
		),

		array(
			"type"        => "textfield",
			"heading"     => __("Extra class name",'unity'),
			"param_name"  => "el_class",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.",'unity')
		)
   	)
));
add_shortcode( 'wpo_category_list', ('wpo_vc_shortcode_render')  );
?>