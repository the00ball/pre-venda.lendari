<?php
/*********************************************************************************************************************
 * Campaigns Tab
 *********************************************************************************************************************/
vc_map( array(
    "name" => __("WPO Campaigns Tab",'unity'),
    "base" => "wpo_campaigns_tab",
    'icon' => 'icon-wpb-application-icon-large',
    'description'=>'Display Campaigns tab',
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
			'type' => 'dropdown',
			'heading' => __('Mode', 'unity'),
			'param_name' => 'mode',
			'value' => array(
					__('Featured', 'unity') => 'featured',
					__('Most Recent', 'unity') => 'most_recent',
					__('Random', 'unity') => 'Random'
				)
		),
		array(
			"type" => "textfield",
			'heading' => __( 'Number', 'unity' ),
			"param_name" => "number",
			"value" => ''
	    ),
   	)
));
add_shortcode( 'wpo_campaigns_tab', ('wpo_vc_shortcode_render') );


/*********************************************************************************************************************
 * Campaigns Featured
 *********************************************************************************************************************/
vc_map( array(
    "name" => __("WPO Campaigns Featured",'unity'),
    "base" => "wpo_campaigns_featured",
    'icon' => 'icon-wpb-application-icon-large',
    'description'=>'Display Campaigns Featured',
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
			'heading' => __( 'Number', 'unity' ),
			"param_name" => "number",
			"value" => ''
	    ),
	    array(
	    	"type" => "dropdown",
			'heading' => __( 'Layout', 'unity' ),
			"param_name" => "layout",
			"value" => array(
				__('Layout 1', 'unity') => 'item-1',
				__('Layout 2', 'unity') => 'item-2',
				__('Layout 3', 'unity') => 'item-3'
			)
	    )
   	)
));
add_shortcode( 'wpo_campaigns_featured', ('wpo_vc_shortcode_render') );

/*********************************************************************************************************************
 * Campaigns Frontend
 *********************************************************************************************************************/
vc_map( array(
    "name" => __("WPO Campaigns Frontend",'unity'),
    "base" => "wpo_campaigns_frontend",
    'icon' => 'icon-wpb-application-icon-large',
    'description'=>'Display Campaigns Frontend',
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
			"type" => "dropdown",
			'heading' => __( 'Mode', 'unity' ),
			"param_name" => "mode",
			"value" => array(
				__('Featured Campaigns', 'unity') => 'featured',
				__('Lastest Campaigns', 'unity') => 'most_recent',
				__('Randown Campaigns', 'unity') => 'random'
			)
	    ),
		array(
			"type" => "dropdown",
			'heading' => __( 'Style', 'unity' ),
			"param_name" => "style",
			"value" => array(
				__('Style 1', 'unity') => 'style-1',
				__('Style 2', 'unity') => 'style-2',
				__('Style 3', 'unity') => 'style-3',
			)
	    ),
		array(
			"type" => "textfield",
			'heading' => __( 'Number', 'unity' ),
			"param_name" => "number",
			"value" => ''
	    ),
	    array(
			"type" => "dropdown",
			'heading' => __( 'Column', 'unity' ),
			"param_name" => "column",
			"value" => array(
				'2' => '2',
				'3' => '3',
				'4' => '4'
			)
	    ),
   	)
));
add_shortcode( 'wpo_campaigns_frontend', ('wpo_vc_shortcode_render') );
