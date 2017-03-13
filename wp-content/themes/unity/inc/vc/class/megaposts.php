<?php  
if( function_exists("vc_path_dir") && !class_exists("WPBakeryShortCode_VC_Posts_Grid") ){
require_once vc_path_dir('SHORTCODES_DIR', 'vc-posts-grid.php');
class WPBakeryShortCode_Wpo_Megaposts extends WPBakeryShortCode_VC_Posts_Grid {

}
}