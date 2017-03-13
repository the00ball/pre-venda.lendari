<?php  
// require_once vc_path_dir('SHORTCODES_DIR', 'vc-posts-grid.php');
if( class_exists('WPBakeryShortCode')){
	class WPBakeryShortCode_Wpo_All_Products extends WPBakeryShortCode {

		public function getListQuery( $show_tab){
			$list_query = array();
			$types = explode(',', $show_tab);
			foreach ($types as $type) {
				$list_query[$type] = $this->getTabTitle($type);
			}
			return $list_query;
		}

		public function getTabTitle($type){
			switch ($type) {
				case 'recent':
					return array('title'=>__('Latest Products','unity'),'title_tab'=>__('Latest','unity'));
				case 'featured_product':
					return array('title'=>__('Featured Products','unity'),'title_tab'=>__('Featured','unity'));
				case 'top_rate':
					return array('title'=> __('Top Rated Products','unity'),'title_tab'=>__('Top Rated', 'unity'));
				case 'best_selling':
					return array('title'=>__('BestSeller Products','unity'),'title_tab'=>__('BestSeller','unity'));
				case 'on_sale':
					return array('title'=>__('Special Products','unity'),'title_tab'=>__('Special','unity'));
			}
		}
	}
}