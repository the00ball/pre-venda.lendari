<?php  
if( WPO_VISUAL_COMPOSER_ACTIVED){
   require_once vc_path_dir('SHORTCODES_DIR', 'vc-posts-grid.php');
   class WPBakeryShortCode_Wpo_gridposts extends WPBakeryShortCode_VC_Posts_Grid {
   }
}