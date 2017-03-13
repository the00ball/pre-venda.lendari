<?php  
if( function_exists("vc_path_dir") && !class_exists("WPBakeryShortCode_VC_Posts_Grid") ){
require_once vc_path_dir('SHORTCODES_DIR', 'vc-posts-grid.php');
class WPBakeryShortCode_Wpo_Counter extends WPBakeryShortCode_VC_Posts_Grid {

	public function __construct( $settings ) {
		parent::__construct( $settings );
		$this->jsCssScripts();
	}

	public function jsCssScripts() {

		wp_register_style('counterup_js',WPO_THEME_URI.'/js/jquery.counterup.min.js',array(),false,true);
	 
	}
}
}