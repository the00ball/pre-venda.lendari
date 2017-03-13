<?php 
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     WPOpal  Team <wpopal@gmail.com, support@wpopal.com>
 * @copyright  Copyright (C) 2014 wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/support/forum.html
 */
	class WPO_Backend {

		public function init(){
			global $pagenow; 

			add_action('wp_head',array($this,'initAjaxUrl'),15);
			add_action( 'admin_enqueue_scripts', array( $this, 'initScripts' ) );

			add_action( 'wp_ajax_wpo_video_popup', array($this,'ajax_Video_Popup') );
			add_action( 'wp_ajax_nopriv_wpo_video_popup', array($this,'ajax_Video_Popup') );

			

			$this->makeCustomMetaBoxs();
			if (  isset( $_GET['activated'] ) && $pagenow == 'themes.php' ) { 
				add_action( 'init', array($this, 'installSample' ), 1 );
			}

			$this->initAjaxAdmin();
			require_once ( WPO_FRAMEWORK_PATH . 'import/import.php' );
			require_once ( WPO_FRAMEWORK_PATH . 'export/export.php' );
			require_once ( WPO_FRAMEWORK_PATH . 'functions/function-import.php');

		}

		public function installSample(){
			if( file_exists(WPO_THEME_DIR.'/sample/config.txt') ){
				$content = file_get_contents( WPO_THEME_DIR.'/sample/config.txt' );
				$data = @unserialize( trim($content) );
				if( is_array($data) ){ 
					update_option("wpo_theme_options",$data);
 				}
			}
		}

		/**
		 * Initial Ajax Url
		 */
		public function initAjaxUrl() {
		?>
			<script type="text/javascript">
				var ajaxurl = '<?php echo esc_js( admin_url('admin-ajax.php') ); ?>';
			</script>
			<?php
		}

		public function initAjaxAdmin(){
			add_action( 'wp_ajax_wpo_post_embed', array($this,'initAjaxPostEmbed') );
		}

		public function initAjaxPostEmbed(){
			if ( !$_REQUEST['oembed_url'] )
				die();
			// sanitize our search string
			global $wp_embed;
			$oembed_string = sanitize_text_field( $_REQUEST['oembed_url'] );
			$oembed_url = esc_url( $oembed_string );
			$check_embed = wp_oembed_get(  $oembed_url  );
			if($check_embed==false){
				$check = false;
				$result ='not found';
			}else{
				$check = true;
				$result = $check_embed;
			}
			echo json_encode( array( 'check' => $check,'video'=>$result ) );
			die();
		}

		public function ajax_Video_Popup(){
			$postconfig = get_post_meta($_POST['id'],'wpo_portfolio',true);
		    $content = wp_oembed_get($postconfig['video_link']);
		    echo '<div class="video-responsive">';
				echo trim( $content );
			echo '</div>';
			die();
		}
		
		/**
		 *
		 */
		public function initScripts(){
			wp_enqueue_style( 'WPO_admin_meta_css', WPO_FRAMEWORK_ADMIN_STYLE_URI.'css/meta.css');
			wp_enqueue_style( 'WPO_admin_style_css', WPO_FRAMEWORK_ADMIN_STYLE_URI.'css/admin.css');
			wp_enqueue_style('base-fonticon', WPO_THEME_URI.'/css/font-awesome.css' );
			wp_enqueue_script('WPO_option_framework_js', WPO_FRAMEWORK_ADMIN_STYLE_URI.'js/admin_plugins.js');
			wp_enqueue_style('base-fonticon', WPO_THEME_URI.'/css/font-awesome.css' );
			wp_enqueue_script('WPO_option_metabox_js', WPO_FRAMEWORK_ADMIN_STYLE_URI.'js/metabox.js');

		}

		/**
		 *
		 */
		public function makeCustomMetaBoxs(){
			$path = WPO_THEME_SUB_DIR   . 'customfield/';
		
		 	//Post setting
		 	new WPO_MetaBox(array(
				'id'       => 'wpo_postconfig',
				'title'    => esc_html__('Post Configuration', 'unity'),
				'types'    => array('post'),
				'priority' => 'high',
				'template' => $path . 'post.php'
			));

			//Post setting
		 	new WPO_MetaBox(array(
				'id'       => 'wpo_brandconfig',
				'title'    => esc_html__('Brands Configuration', 'unity'),
				'types'    => array('brands'),
				'priority' => 'high',
				'template' => $path . 'brands.php'
			));
		  	
			/*
			 * Page Setting.
			 */
			$aa = new WPO_MetaBox(array(
				'id'       => 'wpo_pageconfig',
				'title'    => esc_html__('Page Configuration', 'unity'),
				'types'    => array('page'),
				'priority' => 'high',
				'template' => $path . 'page.php',
			));

			 //Gallery Setting.
			$aa = new WPO_MetaBox(array(
				'id'       => 'wpo_pageconfig',
				'title'    => esc_html__('Gallery Configuration', 'unity'),
				'types'    => array('gallery'),
				'priority' => 'high',
				'template' => $path . 'gallery.php',
			));

			//
			/*new WPO_MetaBox(array(
				'id'       => 'wpo_formatvideo',
				'title'    => esc_html__('Embed Options'),
				'types'    => array('post','video'),
				'priority' => 'high',
				'template' => $path . 'post.php',
			));*/

			new WPO_MetaBox(array(
				'id'       => 'wpo_portfolio',
				'title'    => esc_html__('Portfolio Options', 'unity'),
				'types'    => array('portfolio'),
				'priority' => 'high',
				'template' => $path . 'portfolio.php',
			));

			//Event setting
			new WPO_MetaBox(array(
				'id'       => 'wpo_event',
				'title'    => esc_html__('Event Options', 'unity'),
				'types'    => array('event'),
				'priority' => 'high',
				'template' => $path . 'event.php',
			));
		}
	}

   	/** create instance of Backend */
    $backend = new WPO_Backend();
    $backend->init();