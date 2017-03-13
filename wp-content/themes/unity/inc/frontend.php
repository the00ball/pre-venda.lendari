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
class WPO_Frontend extends WPO_Framework {

	public function __construct(){

		parent::__construct();
		// Add default Sidebar
		$this->setSidebarDefault();

		// Require Plugin
		$this->initRequirePlugin();

 		/* This theme uses post thumbnails */
		$this->addThemeSupport( 'post-thumbnails' );
		set_post_thumbnail_size( 600, 353, true );
		// Add default posts and comments RSS feed links to head*/
		$this->addThemeSupport( 'automatic-feed-links' );
		$this->addImagesSize( 'fullwidth', 1024, 590, true );
		$this->addImagesSize('thumbnails-crowdfunding', 700, 384, true);	
		$this->addImagesSize('thumbnails-gallery', 600, 600, true);	
		$this->addImagesSize('thumbnails-gallery-category', 500, 250, true);	
		// Register Post type support
		add_filter('body_class',array($this,'enable_sticky_menu'));

		$args = array(
			'width'         => 1920,
			'height'        => 200,
			//'default-image' => get_template_directory_uri() . '/images/breadcrumb-bg.jpg',
			'flex-height'            => false,
			'flex-width'             => false,
			'uploads'                => true,
			'random-default'         => false,
			'header-text'            => false,
		);
		add_theme_support( 'custom-header', $args );

		/**
		 * Register  list of widgets supported inside framework
		 */
		//	$this->addWidgetsSuport( array( 'twitter','sliders','recent_post','facebook_like','tabs','flickr' ) );
		$widget_suport = array( 'twitter','posts','featured_post','top_rate','recent_comment','recent_post','tabs','flickr', 'video', 'socials', 'menu_vertical', 'socials_siderbar');
		if(WPO_CROWDFUNDING_ACTIVED){
			$widget_suport[] = 'campaign_backers';
			$widget_suport[] = 'campaign_author';
		}
		$this->addWidgetsSuport($widget_suport);
		/* Post types supported */
		$this->addPostTypeSuport( array( 'brands', 'testimonials', 'gallery', 'portfolio', 'faq', 'offer', 'footer' ) );

		/* add  post types support as default */
		$this->addThemeSupport( 'post-formats',  array( 'audio', 'aside', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'  ) );
		$this->loadFrontEndMedia();
				$this->setRTLMode();
		add_action( 'wp_footer',array($this,'wpo_skins_css') );

	}


	
	public function setRTLMode(){
		if( isset($_GET['is_rtl']) ){  		
			$GLOBALS['text_direction'] = 'rtl';
			global $wp_locale;
 		    $wp_locale->text_direction = "rtl";
		}	
	}
	
	function wpo_skins_css() {
		$config = self::getPageConfig();
		if($config['skins'] && $config['skins'] != 'default'){
			$files = self::wpo_get_file_skins($config['skins']);
			if($files)
				foreach($files as $file)
					echo '<link rel= "stylesheet" type="text/css" href="'.WPO_THEME_URI.'/css/skins/'.$config['skins'].'/'.$file.'"/>';	
		}
	}
	
	function wpo_get_file_skins($kins){
		$path = WPO_THEME_DIR.'/css/skins/'.$kins.'/';
		$file = '.css';
		$files = array();
        $allfiles = glob($path . '*' . $file);
        foreach ($allfiles as $name) {
			$name = basename($name);
            $files[$name] = $name;
        }
        return $files;
	}
	public function enable_sticky_menu($classes){
		if(wpo_theme_options('megamenu-is-sticky',true))
			$classes[] = 'main-menu-fixed';
		return $classes;
	}
 

	public function loadFrontEndMedia(){
		// add Javascript and CSS  
		//$this->addScript('scroll_animate',WPO_THEME_URI.'/js/smooth-scrollbar.js',array(),false,true);
		//$this->addScript('modernizr',WPO_THEME_URI.'/js/modernizr.custom.js',array(),false,true);
		//$this->addScript('wow_js',WPO_THEME_URI.'/js/jquery.wow.min.js',array(),false,true);
		//$this->addScript('prettyPhoto_js',WPO_THEME_URI.'/js/jquery.prettyPhoto.js',array(),false,true);
		$this->addScript('raphael_js',WPO_THEME_URI.'/js/raphael-min.js',array(),false,true);
		$this->addScript('appear_js',WPO_THEME_URI.'/js/jquery.appear.js',array(),false,true);
		$this->addScript('main_js',WPO_THEME_URI.'/js/main.js',array(),false,true);
		$this->addStyle('base-fonticon', WPO_THEME_URI.'/css/font-awesome.css' );
	}

	public function getBlogConfig(){
		$config = array();
		$layout = wpo_theme_options('blog-archive-layout', '0-1-1');
		if( !empty($layout) )
			$lt = $layout;
		else
			$lt = '0-1-1';

		$config = $this->configLayout($lt,$config);
		$config['right-sidebar']['widget'] = wpo_theme_options('blog-archive-right-sidebar', 'sidebar-default');
		$config['left-sidebar']['widget'] = wpo_theme_options('blog-archive-left-sidebar', 'sidebar-default');
		$config['show_breadcrumb'] = wpo_theme_options('blog_show-breadcrumb', true);
		return $config;
	}

	//Post Configuration
	public function getPostConfig(){
		global $wp_query;
		$postconfig = get_post_meta($wp_query->get_queried_object_id(),'wpo_postconfig',true);

		$defaults = array(  'config_layout'  	=> 'no');
		$postconfig = wp_parse_args((array) $postconfig, $defaults);
		$config = array();
		if( $postconfig['config_layout'] == 'yes'){
			$config['page_layout'] 				= $postconfig['page_layout'];
			$config['right-sidebar']['widget']	= $postconfig['right_sidebar'];
			$config['left-sidebar']['widget'] 	= $postconfig['left_sidebar'];
		}else{
			$config['page_layout']  			= wpo_theme_options('blog-single-layout', '0-1-1');
			$config['right-sidebar']['widget']	= wpo_theme_options('blog-single-right-sidebar', 'sidebar-default');
			$config['left-sidebar']['widget'] 	= wpo_theme_options('blog-single-left-sidebar', 'sidebar-default');
		}

		if( empty($config))
			$lt = '0-1-1';
		else
			$lt = $config['page_layout'];
		
		$config = $this->configLayout($lt,$config);

		if( isset($postconfig['audio_link']) && !empty( $postconfig['audio_link'] ) ){
			$config['audio_link']	 = $postconfig['audio_link'];
		}

		if( isset($postconfig['video_link']) && !empty( $postconfig['video_link'] )){
			$config['video_link']	 = $postconfig['video_link'];
		}

		if( isset($postconfig['link_url']) && $postconfig['link_url'] ){
			$config['link_url']	 = $postconfig['link_url'];
			$config['link_title']	 = $postconfig['link_title'];
		}

		if( isset($postconfig['chat_content']) && $postconfig['chat_content'] ){
			$config['chat_content']	 = $postconfig['chat_content'];
		}

		if( isset($postconfig['quote_content']) && $postconfig['quote_content'] ){
			$config['quote_content']	 = $postconfig['quote_content'];
			$config['quote_author']	 = $postconfig['quote_author'];
		}

		//$config['advanced'] = get_post_meta($wp_query->get_queried_object_id(), 'wpo_template', TRUE);
		$maincontent = array();
		
		return $config;
	}
	//Portfolio Configuration
	public function getPortfolioConfig(){
		global $wp_query;
		$portconfig = get_post_meta($wp_query->get_queried_object_id(),'wpo_portfolio',true);

		$defaults = array(  'config_layout'  	=> 'no');
		$postconfig = wp_parse_args((array) $portconfig, $defaults);
		$config = array();
		if( $postconfig['config_layout'] == 'yes'){
			$config['page_layout'] 				= $postconfig['page_layout'];
			$config['right-sidebar']['widget']	= $postconfig['right_sidebar'];
			$config['left-sidebar']['widget'] 	= $postconfig['left_sidebar'];
		}else{
			$config['page_layout']  			= wpo_theme_options('portfolio-layout', '0-1-1');
			$config['left-sidebar']['widget']	= wpo_theme_options('portfolio-left-sidebar', 'sidebar-default');
			$config['right-sidebar']['widget'] 	= wpo_theme_options('portfolio-right-sidebar', 'sidebar-default');
		}

		if( empty($config))
			$lt = '0-1-1';
		else
			$lt = $config['page_layout'];
		
		$config = $this->configLayout($lt,$config);
		return $config;
	}

	public function getCampaignConfig(){
		$defaults = array(  'config_layout'  => false);
		//$postconfig = wp_parse_args((array) $portconfig, $defaults);
		
		$config = array();
		if(!is_single()){
			$config['page_layout']  			= wpo_theme_options('campaign-archive-layout', '0-1-1');
			$config['left-sidebar']['widget']	= wpo_theme_options('campaign-archive-left-sidebar', 'sidebar-left');
			$config['right-sidebar']['widget'] 	= wpo_theme_options('campaign-archive-right-sidebar', 'sidebar-right');
		}else{
			$config['page_layout']  			= wpo_theme_options('campaign-single-layout', '0-1-1');
			$config['left-sidebar']['widget']	= wpo_theme_options('campaign-single-left-sidebar', 'sidebar-left');
			$config['right-sidebar']['widget'] 	= wpo_theme_options('campaign-single-right-sidebar', 'sidebar-right');
		}	

		if( empty($config))
			$lt = '0-1-0';
		else
			$lt = $config['page_layout'];
		
		$config = $this->configLayout($lt, $config);
		return $config;
	}

	public function getGalleryConfig(){
		$defaults = array(  'config_layout'  => false);
		//$postconfig = wp_parse_args((array) $portconfig, $defaults);
		
		$config = array();
		if(!is_single()){
			$config['page_layout']  			= wpo_theme_options('gallery-archive-layout', '0-1-1');
			$config['left-sidebar']['widget']	= wpo_theme_options('gallery-archive-left-sidebar', 'sidebar-left');
			$config['right-sidebar']['widget'] 	= wpo_theme_options('gallery-archive-right-sidebar', 'sidebar-right');
		}else{
			$config['page_layout']  			= wpo_theme_options('gallery-single-layout', '0-1-1');
			$config['left-sidebar']['widget']	= wpo_theme_options('gallery-single-left-sidebar', 'sidebar-left');
			$config['right-sidebar']['widget'] 	= wpo_theme_options('gallery-single-right-sidebar', 'sidebar-right');
		}	

		if( empty($config))
			$lt = '0-1-0';
		else
			$lt = $config['page_layout'];
		
		$config = $this->configLayout($lt, $config);
		return $config;
	}

	public function getEventConfig(){
		$defaults = array(  'config_layout'  => false);
		//$postconfig = wp_parse_args((array) $portconfig, $defaults);
		
		$config = array();
		if(!is_single()){
			$config['page_layout']  			= wpo_theme_options('event-archive-layout', '0-1-1');
			$config['left-sidebar']['widget']	= wpo_theme_options('event-archive-left-sidebar', 'sidebar-left');
			$config['right-sidebar']['widget'] 	= wpo_theme_options('event-archive-right-sidebar', 'sidebar-right');
		}else{
			$config['page_layout']  			= wpo_theme_options('event-single-layout', '0-1-1');
			$config['left-sidebar']['widget']	= wpo_theme_options('event-single-left-sidebar', 'sidebar-left');
			$config['right-sidebar']['widget'] 	= wpo_theme_options('event-single-right-sidebar', 'sidebar-right');
		}	

		if( empty($config))
			$lt = '0-1-0';
		else
			$lt = $config['page_layout'];
		
		$config = $this->configLayout($lt, $config);
		return $config;
	}

	// page Configuration
	public function getPageConfig(){

		global $wp_query;

		$pageconfig = get_post_meta($wp_query->get_queried_object_id(),'wpo_pageconfig',true);

		$defaults = array(  'page_layout' => '0-1-1',
                            'right_sidebar' => 'sidebar-default' ,
                            'left_sidebar' => 'sidebar-default',
                            'showtitle'=> 'yes',
                            'advanced'=>'',
                            'breadcrumb'=> 'yes',
                            'skins' => 'global',
                            'layout' => 'global',
                            'blog_number' => 10,
                            'blog_style' => '',
                            'blog_columns' => 4,
                            'portfolio_number' => 10,
                            'portfolio_style' => '',
                            'portfolio_columns'=>4,
                            'header_skin' => 'global',
                            'footer' => 'global',
                            );
		$pageconfig = wp_parse_args((array) $pageconfig, $defaults);
		$config = array();
		if($pageconfig==''){
			$lt = '0-1-0';
		}else{
			$lt = (!empty($pageconfig['page_layout']) || $pageconfig['page_layout']!= '')?$pageconfig['page_layout']:'0-1-0';
			$config['breadcrumb']= ($pageconfig['breadcrumb'] == 'yes')? true: false;
			$config['showtitle']= ($pageconfig['showtitle'] == 'yes') ? true: false;
			$config['right-sidebar']['widget']=$pageconfig['right_sidebar'];
			$config['left-sidebar']['widget']=$pageconfig['left_sidebar'];
			$config = $this->configLayout($lt,$config);
			$config['advanced'] = get_post_meta($wp_query->get_queried_object_id(), 'wpo_template', TRUE);
			$config['header_skin']=$pageconfig['header_skin'];
			$config['skins']=$pageconfig['skins'];
			$config['footer']= $pageconfig['footer'];
			$config['layout']= $pageconfig['layout'];

			$config['blog_number'] = $pageconfig['blog_number'];
			$config['blog_style'] = $pageconfig['blog_style'];
			$config['blog_columns'] = $pageconfig['blog_columns'];

			$config['portfolio_number'] = $pageconfig['portfolio_number'];
			$config['portfolio_style'] = $pageconfig['portfolio_style'];
			$config['portfolio_columns'] = $pageconfig['portfolio_columns'];
		}
		$maincontent = array();
		if( $config['layout'] =='global' ){
			$config['layout'] = wpo_theme_options('configlayout', '0-1-1');
		}

		//
		if(is_front_page()) {
			$config['paged'] = (get_query_var('page')) ? get_query_var('page') : 1;
		} else {
			$config['paged'] = (get_query_var('paged')) ? get_query_var('paged') : 1;
		}
		
		return $config;
	}

	public function wpo_body_class_page( $classes ){
		global $wp_query;
		foreach ( $classes as $key => $value ) {
	        if ( $value == 'boxed' || $value == 'default' ) 
	        	unset( $classes[ $key ] );
	    }
	    
		$pageconfig = get_post_meta($wp_query->get_queried_object_id(),'wpo_pageconfig',true);
		if(empty($pageconfig) || !isset( $pageconfig['layout'])) $pageconfig['layout']= 'global';
		if( $pageconfig['layout'] =='global' ){
			$classes[] = wpo_theme_options('configlayout', '0-1-1');
		}else
			$classes[] = $pageconfig['layout'];

	  	return $classes;
	}
 
 
	private function initRequirePlugin(){

		$this->addRequiredPlugin(array(
			'name'                     => 'Easy Digital Downloads', // The plugin name
		    'slug'                     => 'easy-digital-downloads', // The plugin slug (typically the folder name)
		    'required'                 => true, // If false, the plugin is only 'recommended' instead of required
		));

		$this->addRequiredPlugin(array(
			'name'                     => 'AppThemer Crowdfunding', // The plugin name
		    'slug'                     => 'appthemer-crowdfunding', // The plugin slug (typically the folder name)
		    'source'                	=>  'http://www.wpopal.com/thememods/appthemer-crowdfunding.zip',// If false, the plugin is only 'recommended' instead of required
		    'required' 					=>true
		));

		$this->addRequiredPlugin(array(
			'name'                     => 'The Events Calendar', // The plugin name
		    'slug'                     => 'the-events-calendar', // The plugin slug (typically the folder name)
		    'required'                 => true, // If false, the plugin is only 'recommended' instead of required
		));

		$this->addRequiredPlugin(array(
			'name'                     => 'MailChimp', // The plugin name
		    'slug'                     => 'mailchimp-for-wp', // The plugin slug (typically the folder name)
		    'required'                 =>  true
		));

		$this->addRequiredPlugin(array(
			'name'                     => 'WooCommerce', // The plugin name
		    'slug'                     => 'woocommerce', // The plugin slug (typically the folder name)
		    'required'                 =>  true
		));

		$this->addRequiredPlugin(array(
			'name'                     => 'Contact Form 7', // The plugin name
		    'slug'                     => 'contact-form-7', // The plugin slug (typically the folder name)
		    'required'                 => true, // If false, the plugin is only 'recommended' instead of required
		));

		$this->addRequiredPlugin(array(
			'name'                     => 'WPBakery Visual Composer', // The plugin name
		    'slug'                     => 'js_composer', // The plugin slug (typically the folder name)
		    'required'                 => true,
		    'source'				   => 'http://www.wpopal.com/thememods/js_composer.zip' 
		));

		$this->addRequiredPlugin(array(
			'name'                     => 'Revolution Slider', // The plugin name
            'slug'                     => 'revslider', // The plugin slug (typically the folder name)
            'required'                 => true ,
            'source'				   => 'http://www.wpopal.com/thememods/revslider.zip'
		));

		$this->addRequiredPlugin(array(
			'name'                     => 'MailChimp', // The plugin name
		    'slug'                     => 'mailchimp-for-wp', // The plugin slug (typically the folder name)
		    'required'                 =>  true
		));
	}

	//override
	public function configLayout($layout,$config=array()){
		switch ($layout) {
			// Two Sidebar
			case '1-1-1':
				$config['left-sidebar']['show'] 	= true;
				$config['left-sidebar']['class'] 	='col-md-4';
				$config['right-sidebar']['class']	='col-md-4';
				$config['right-sidebar']['show'] 	= true;
				$config['main']['class'] 		='col-xs-12 col-md-4';
				break;
			//One Sidebar Right
			case '0-1-1':
				$config['left-sidebar']['show'] 	= false;
				$config['right-sidebar']['show'] 	= true;
				$config['main']['class']  		='col-xs-12 col-md-8 no-sidebar-left';
				$config['right-sidebar']['class'] 	='col-xs-12 col-md-4';
				break;
			// One Sidebar Left
			case '1-1-0':
				$config['left-sidebar']['show'] 	= true;
				$config['right-sidebar']['show'] 	= false;
				$config['left-sidebar']['class'] 	='col-xs-12 col-md-4';
				$config['main']['class'] 		='col-xs-12 col-md-8 no-sidebar-right';
				break;

			// Fullwidth
			default:
				$config['left-sidebar']['show'] 	= false;
				$config['right-sidebar']['show'] 	= false;
				$config['main']['class'] 			='col-xs-12 no-sidebar';
				break;
		}
		return $config;
	}

   /**
	*
	*/
	private function setSidebarDefault(){
		$this->addSidebar('sidebar-default',
			array(
				'name'          => esc_html__( 'Sidebar Default', 'unity'),
				'id'            => 'sidebar-default',
				'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'unity'),
				'before_widget' => '<aside id="%1$s" class="widget  clearfix %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			));
		$this->addSidebar('newsletter',
			array(
				'name'          => esc_html__( 'Newsletter' , 'unity'),
				'id'            => 'newsletter',
				'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'unity'),
				'before_widget' => '<aside id="%1$s" class="widget  clearfix %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			));
		$this->addSidebar('twitter',
			array(
				'name'          => esc_html__( 'Twitter' , 'unity'),
				'id'            => 'twitter',
				'description'   => esc_html__( 'Appears on content in the sidebar.', 'unity'),
				'before_widget' => '<aside id="%1$s" class="widget  clearfix %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			));

		$this->addSidebar('gallery',
			array(
				'name'          => esc_html__( 'Gallery' , 'unity'),
				'id'            => 'gallery',
				'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'unity'),
				'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			));	
		$this->addSidebar('plugin-campaigns',
			array(
				'name'          => esc_html__( 'Plugin | Campaigns' , 'unity'),
				'id'            => 'plugin-campaigns',
				'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'unity'),
				'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			));	
		$this->addSidebar('sidebar-left',
			array(
				'name'          => esc_html__( 'Left Sidebar' , 'unity'),
				'id'            => 'sidebar-left',
				'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'unity'),
				'before_widget' => '<aside id="%1$s" class="widget  clearfix %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			));
		$this->addSidebar('sidebar-right',
			array(
				'name'          => esc_html__( 'Right Sidebar', 'unity' ),
				'id'            => 'sidebar-right',
				'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'unity'),
				'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			));
 
			$this->addSidebar('blog-sidebar-left',
			array(
				'name'          => esc_html__( 'Blog Left Sidebar', 'unity' ),
				'id'            => 'blog-sidebar-left',
				'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'unity'),
				'before_widget' => '<aside id="%1$s" class="widget  clearfix %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</span></h3>',
			));

			$this->addSidebar('blog-sidebar-right',
			array(
				'name'          => esc_html__( 'Blog Right Sidebar', 'unity' ),
				'id'            => 'blog-sidebar-right',
				'description'   => esc_html__( 'Appears on posts and pages in the sidebar.', 'unity'),
				'before_widget' => '<aside id="%1$s" class="widget  clearfix %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			));

		$this->addSidebar('footer-1',
			array(
				'name'          => esc_html__( 'Footer 1', 'unity' ),
				'id'            => 'footer-1',
				'description'   => esc_html__( 'Appears in the footer section of the site.', 'unity'),
				'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			));
		$this->addSidebar('footer-2',
			array(
				'name'          => esc_html__( 'Footer 2' , 'unity'),
				'id'            => 'footer-2',
				'description'   => esc_html__( 'Appears in the footer section of the site.', 'unity'),
				'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			));
		$this->addSidebar('footer-3',
			array(
				'name'          => esc_html__( 'Footer 3' , 'unity'),
				'id'            => 'footer-3',
				'description'   => esc_html__( 'Appears in the footer section of the site.', 'unity'),
				'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			));
		$this->addSidebar('footer-4',
			array(
				'name'          => esc_html__( 'Footer 4' , 'unity'),
				'id'            => 'footer-4',
				'description'   => esc_html__( 'Appears in the footer section of the site.', 'unity'),
				'before_widget' => '<aside id="%1$s" class="widget clearfix %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title"><span>',
				'after_title'   => '</span></h3>',
			));
	}


	public function getHeaderLayout(){
		global $wp_query;
	    $layout = get_post_meta($wp_query->get_queried_object_id(),'wpo_pageconfig',true);

	    if( !isset($layout['header_skin']) || isset( $layout['header_skin'] ) && $layout['header_skin'] =='global' )
			return wpo_theme_options('headerlayout','');
		else
			return $layout['header_skin'];
	}

/*	public function getFooterLayout(){
		global $wp_query;
		$config = get_post_meta($wp_query->get_queried_object_id(),'wpo_pageconfig',true);
		if( isset( $config['footer'] ) && $config['footer'] =='global' || !isset($config['footer']))
			return wpo_theme_options('footer-style','');
		else
			return $config['footer'];
	}*/
}



?>