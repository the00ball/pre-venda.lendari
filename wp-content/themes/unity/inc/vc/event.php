<?php
/*********************************************************************************************************************
 * Campaigns Frontend
 *********************************************************************************************************************/
vc_map( array(
    "name" => __("WPO Event Frontend",'unity'),
    "base" => "wpo_event_frontend",
    'icon' => 'icon-wpb-application-icon-large',
    'description'=>'Display Event Frontend',
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
				__('Featured Events', 'unity') => 'featured',
				__('Lastest Events', 'unity') => 'most_recent',
				__('Randown Events', 'unity') => 'random'
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
	    array(
			"type" => "textfield",
			"heading" => __("Extra class name", 'unity'),
			"param_name" => "el_class",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'unity')
		)
   	)
));
add_shortcode( 'wpo_event_frontend', ('wpo_vc_shortcode_render') );


/*********************************************************************************************************************
 * Event List Accordion
 *********************************************************************************************************************/
vc_map( array(
    "name" => __("WPO Event Accordion",'unity'),
    "base" => "wpo_event_accordion",
    'icon' => 'icon-wpb-application-icon-large',
    'description'=>'Display Event Accordion',
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
				__('Featured Events', 'unity') => 'featured',
				__('Lastest Events', 'unity') => 'most_recent',
				__('Randown Events', 'unity') => 'random'
			)
	    ),
		array(
			"type" => "textfield",
			'heading' => __( 'Number', 'unity' ),
			"param_name" => "number",
			"value" => ''
	    ),
	    array(
			"type" => "textfield",
			"heading" => __("Extra class name", 'unity'),
			"param_name" => "el_class",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'unity')
		)
   	)
));
add_shortcode( 'wpo_event_accordion', ('wpo_vc_shortcode_render') );

/********************************************************************************************************************
 * Event Frontend
*********************************************************************************************************************/
require_once(ABSPATH . 'wp-admin/includes/screen.php');
$query = get_posts( array('post_type'=> 'tribe_events', 'orderby' => 'id', 'posts_per_page' => -1 ));
$posts = array();

foreach ( $query as $post ) {
	if($post->ID){
   		$posts[$post->post_title] = $post->ID;
   }
}
wp_reset_postdata();

vc_map( array(
    "name" => __("WPO Event Countdown",'unity'),
    "base" => "wpo_event_countdown",
    'icon' => 'icon-wpb-application-icon-large',
    'description'=>'Display Event Single',
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
			'heading' => __( 'Event Single', 'unity' ),
			"param_name" => "event_id",
			"value" => $posts
	    ),
		
	    array(
			"type" => "dropdown",
			'heading' => __( 'Layout', 'unity' ),
			"param_name" => "layout",
			"value" => array(
				'Layout 1' => 'layout-1',
				'Layout 2' => 'layout-2',
				'Layout 3' => 'layout-3'
			)
	    ),
	    array(
			"type" => "textfield",
			"heading" => __("Extra class name", 'unity'),
			"param_name" => "el_class",
			"description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'unity')
		)
   	)
));
add_shortcode( 'wpo_event_countdown', ('wpo_vc_shortcode_render') );

