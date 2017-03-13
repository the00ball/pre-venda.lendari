<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     Opal  Team <opalwordpressl@gmail.com >
 * @copyright  Copyright (C) 2014 wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/support/forum.html
 */
if(!class_exists('WPO_Framework')){

abstract class WPO_Framework {

	/**
	 * @var String $themeName
	 *
	 * @access public
	 */
	protected $themeName='wpbase';

	/**
	 * @var Array $options
	 *
	 * @access protected
	 */
	protected $options=array();

	/**
	 * @var Array $menu
	 *
	 * @access protected
	 */
	protected $menus=array();

	/**
	 * @var string $sidebars
	 *
	 * @access protected
	 */
	protected $sidebars = array();

	/**
	 * @var Array $shortcodes
	 *
	 * @access protected
	 */
	protected $shortcodes = array();

	/**
	 * @var Array $images
	 *
	 * @access protected
	 */
	protected $imagesSize = array();

	/**
	 * @var Array $requiredPlugins
	 *
	 * @access protected
	 */
	protected $requiredPlugins = array();

	/**
	 * @var Array $scripts storing list of javascript files
	 *
	 * @access protected
	 */
	protected $scripts = array();

	/**
	 * @var Array $styles storing list of stylesheets files
	 *
	 * @access protected
	 */

	protected $styles = array();

	protected $themesSupports = array();

	protected $widgets = array();

	protected $posttype = array();

	/**
	 * constructor
	 */
	public function __construct(){
		$themename = get_option( 'stylesheet' );
        $themename = preg_replace("/\W/", "_", strtolower($themename) );

		$this->themeName = $themename;
		 
		if ( ! isset( $content_width ) ) $content_width = 900;
	}


	/**
	 *
	 */
	public function addImagesSize( $name=null, $width=0,$height=0,$crop=false){
		if($name!=null){
			$this->imagesSize[$name] = array('width'=>$width,'height'=>$height,'crop'=>$crop);
		}
	}

	/**
	 * Register  list of widgets supported inside framework
	 */
	public function addWidgetsSuport( $widgets=array()){
		if( is_array($widgets) ){
			$this->widgets = $widgets;
		}
	}

	/**
	 * Register  list of widgets supported inside framework
	 */
	public function addPostTypeSuport( $posttype=array()){
		if( is_array($posttype) ){
			$this->posttype = $posttype;
		}
	}

	/**
	 *
	 */
	public function setPostThumbnailSize($width=0,$height=0,$crop=false){
		set_post_thumbnail_size($width,$height,$crop);
	}

	/**
	 *
	 */
	public function addMenu( $location, $description  ){
		$this->menus[$location] = $description;
	}

	/**
	 *
	 */
	public function addRequiredPlugin( $required ){
		$this->requiredPlugins[] = $required;
	}

	/**
	 *
	 */
	public function addSidebar($key,$sidebar){
		if(is_array($sidebar)) { 
			$this->sidebars[$key] = $sidebar;
		}
	}


	/**
	 *
	 */
	public function addThemeSupport( $support, $default=null ){
		$this->themesSupports[$support] = $default;
	}

	/**
	 *
	 */
	public function addScript( $key, $src,$deps=array(),$ver=false,$in_footer=false){
		$this->scripts[$key] = array($src,$deps,$ver,$in_footer);
	}

	public function removeScript( $key ){
		if( isset($this->scripts[$key]) ){
			unset( $this->scripts[$key] );
			return true;
		}
		return false;
	}

	public function addStyle( $key, $url, $deps=array(),$ver=false,$media='all'){
		$this->styles[$key] = array($url,$deps,$ver,$media);
	}

	public function removeStyle( $key ){
		if( isset($this->styles[$key]) ){
			unset( $this->styles[$key] );
			return true;
		}
		return false;
	}

	/**
	 *
	 */
	public function getThemeSupport( $support ){
		return isset($this->themesSupports[$support])?$this->themesSupports[$support]:null;
	}

	public function init(){
	 
		$this->initFrontEndActions();
		$this->initWidgets();
		$this->initShortcodes();
		$this->initPostType();

 
	
	}

	public function initScript(){
		foreach( $this->scripts as $key => $file ) {
			wp_register_script( $key, $file[0], $file[1], $file[2], $file[3] );
			wp_enqueue_script( $key );
		}
	}


 
	/**
	 * Initial FrontEnd Actions
	 */
	public function initFrontEndActions(){
	 
		add_action('wp_enqueue_scripts', array( $this, 'initScripts' ) );

		add_action('wp_head',array($this,'setPostViews'));
		add_action('wp_head',array($this,'registerGoogleAnalytics'));
		
		add_action('wp_head',array($this,'initCustomCode'),99);
		add_action('wp_head',array($this,'checkHTML5'),100);
		 
		add_action('init', array($this,'addVimeoOembedCorrectly'));

		add_action('after_setup_theme',array($this,'initSetup'));

		add_action('widgets_init', array($this,'initSidebars'));

		add_action('tgmpa_register',array($this,'initRequiredPlugin') );

		//add_shortcode('gallery', '__return_false');

		add_filter('pre_get_posts',array($this,'searchFilter'));
		add_filter('widget_text', 'do_shortcode');
		add_filter( 'post_thumbnail_html', array($this,'removeThumbnailDimensions'), 10, 3 );

		// Fix Youtube Modal
		add_filter( 'oembed_result', array($this,'fixOembebYoutube') );

		

	}
 

	// Fix Youtube Modal
	public function fixOembebYoutube( $url )
	{
		$array = array (
	        'webkitallowfullscreen'     => '',
	        'mozallowfullscreen'        => '',
	        'frameborder="0"'			=> '',
	        '</iframe>)'        => '</iframe>'
	    );
	    $url = strtr( $url, $array );

	    if ( strpos( $url, "<embed src=" ) !== false ){
	        return str_replace('</param><embed', '</param><param name="wmode" value="opaque"></param><embed wmode="opaque" ', $url);
	    }
	    elseif ( strpos ( $url, 'feature=oembed' ) !== false ){
	        return str_replace( 'feature=oembed', 'feature=oembed&wmode=opaque', $url );
	    }
	    else{
	        return $url;
	    }
	}

	//Fix Vimeo embed
	public function addVimeoOembedCorrectly() {
	    wp_oembed_add_provider( '#http://(www\.)?vimeo\.com/.*#i', 'http://vimeo.com/api/oembed.{format}', true );
	}

	/**
	 * Initial Search Filter
	 */
	public function searchFilter($query) {
	    if (isset($_GET['s']) && empty($_GET['s']) && $query->is_main_query()){
	        $query->is_search = true;
	        $query->is_home = false;
	    }
		return $query;
	}

	public function removeThumbnailDimensions( $html, $post_id, $post_image_id ) {
		$html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
		return $html;
	}

	/**
	 * Initial Most Popular
	 */
	public function setPostViews() {
	    global $post;

	    if('post' == get_post_type() && is_single()) {
	        $postID = $post->ID;
	        if(!empty($postID)) {
	            $count_key = 'wpo_post_views_count';
	            $count = get_post_meta($postID, $count_key, true);
	            if($count == '') {
	                $count = 0;
	                delete_post_meta($postID, $count_key);
	                add_post_meta($postID, $count_key, '0');
	            } else {
	                $count++;
	                update_post_meta($postID, $count_key, $count);
	            }
	        }
	    }
	}

	/**
	 * Initial Custom Code
	 */
	public function initCustomCode(){
		if(function_exists('wpo_theme_options')){
			$str = $this->renderCode(wpo_theme_options('snippet-close-body',''),wpo_theme_options('snippet-js-body',''));
			echo trim( $str );
		}
	}

	private function renderCode($css,$js){
		$str ='';
		if($css!=''){
			$str.='
			<style type="text/css">
				'.$css.'
			</style>';
		}
		if($js!=''){
			$str.='
			<script type="text/javascript">
				'.esc_js( $js ).';
			</script>
			';
		}
		$str = htmlspecialchars_decode($str);
		return $str;
	}

	/**
	 * Initial Sidebars
	 */
	public function initSetup(){
		 
		$this->initThemeSupport();
		$this->initRegisterMenu();
		$this->initImageSize();
		$this->setPostThumbnailSize();
	}

	/**
	 * Initial Shortcode Actions
	 */
	public function initShortcodes(){
		$shortcodes = glob( WPO_FRAMEWORK_SHORTCODE.'*.php' );
		foreach($shortcodes as $sc){
			require_once($sc);
		}
	}



	/**
	 * Initial Widgets Actions
	 */
	public function initWidgets( ){
		foreach( $this->widgets as $wg ){
			$wg = WPO_FRAMEWORK_WIDGETS.$wg.'.php';
			if( is_file($wg) ){
				require_once($wg);
			}
		}
	}

	/**
	 * Initial Post type Actions
	 */
	public function initPostType(){
		foreach( $this->posttype as $pt ){
			$pt = WPO_FRAMEWORK_POSTTYPE.$pt.'.php';
			if( is_file($pt) ){
				require_once($pt);
			}
		}
	}

	/**
	 * Initial FrontEnd Actions
	 */
	public function initRequiredPlugin(){  
		if(count($this->requiredPlugins)>0){
			tgmpa( $this->requiredPlugins  );
		}
	}


	/**
	 * Initial Sidebars
	 */
	public function initSidebars(){
		foreach ($this->sidebars as $key => $sidebar) {
			register_sidebar($sidebar);
		}
	}

	public function initImageSize(){
		foreach ($this->imagesSize as $key => $image) {
			add_image_size($key,$image['width'],$image['height'],$image['crop']);
		}
	}
 
	/**
	 * Initial Scripts
	 */
	public function initScripts(){
		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ){
      		wp_enqueue_script( 'comment-reply' );
		}

		wp_enqueue_script("jquery");
		/*  add scripts files  */
		wp_enqueue_script('base_bootstrap_js',WPO_THEME_URI.'/js/bootstrap.min.js');
		// register google Map API
		wp_register_script('base_gmap_api_js','http://maps.google.com/maps/api/js?sensor=true');
		wp_register_script('base_gmap_function_js',WPO_FRAMEWORK_STYLE_URI.'js/jquery.ui.map.min.js');


		foreach( $this->scripts as $key => $file ) {
			wp_register_script( $key, $file[0], $file[1], $file[2], $file[3] );
			wp_enqueue_script( $key );
		}

		wp_enqueue_script( 'base_wpo_plugin_js',  WPO_THEME_URI.'/js/wpo-plugin.js',array(),false,true);
	 
		
		wp_enqueue_style( 'theme-style', get_stylesheet_uri() );
		 

		$currentSkin = str_replace( '.css','',wpo_theme_options('skin','default') );
		// Check RTL
		if( is_rtl() ){
			if( file_exists(WPO_THEME_CSS_DIR.'skins/'.$currentSkin.'/bootstrap-rtl.css') ){
				wp_enqueue_style( 'bootstrap-rtl-'.$currentSkin, WPO_THEME_URI.'/css/skins/'.$currentSkin.'/bootstrap-rtl.css' );
			}else {
				wp_enqueue_style( 'bootstrap-rtl-default',WPO_THEME_URI.'/css/bootstrap-rtl.css' );
			}
		}else{
			if( file_exists(WPO_THEME_CSS_DIR.'skins/'.$currentSkin.'/bootstrap.css') ){
				wp_enqueue_style( 'bootstrap-'.$currentSkin, WPO_THEME_URI.'/css/skins/'.$currentSkin.'/bootstrap.css' );
			}else {
				wp_enqueue_style( 'bootstrap-default', WPO_THEME_URI.'/css/bootstrap.css' );
			}
		}

		if( $currentSkin == 'template' || empty($currentSkin) || $currentSkin == 'default' ){
			wp_enqueue_style( 'template-default',WPO_THEME_URI.'/css/template.css' );
		}else {
			wp_enqueue_style('template-'.$currentSkin,WPO_THEME_URI.'/css/skins/'.$currentSkin.'/template.css' );
		}

	 
		

		/* add styles files */
		foreach( $this->styles as $key => $file ) {
			wp_register_style( $key, $file[0], $file[1], $file[2], $file[3] );
			wp_enqueue_style( $key );
		}
		if( is_rtl() ){
			wp_enqueue_style('base-style-rtl',WPO_THEME_URI.'/css/rtl/template.css');
		}

		if( wpo_theme_options('customize-theme','') && wpo_theme_options('customize-theme','') != 'No Use' ){
			wp_enqueue_style('customize-style',WPO_FRAMEWORK_CUSTOMZIME_STYLE_URI.wpo_theme_options('customize-theme').'.css');
		}
	}



	/**
	 * Initial Theme Support
	 */
	private function initThemeSupport(){
		add_theme_support( 'automatic-feed-links' );
		foreach ($this->themesSupports as $key => $value) {
			if($value!=null){
				add_theme_support($key,$value);
			}
			else{
				add_theme_support($key);
			}
		}
	}

	/**
	 * Initial Register Menu
	 */
	public function initRegisterMenu(){
		//register_nav_menu('wpo_megamenu','Megamenu');
		foreach ($this->menus as $key => $menu) {
			register_nav_menu( $key, $menu );
		}
	}

 

	public function checkHTML5(){
		?>
		
		<?php
	}

	/**
	 *
	 */
	public function registerGoogleAnalytics(){
		$output='';
		$google_analytics='';
		if(function_exists('wpo_theme_options')){
			$google_analytics = wpo_theme_options('google-analytics','');
		}
		if($google_analytics!=''){
			$output.='
				<script type="text/javascript">
				    var _gaq = _gaq || [];
				    _gaq.push([\'_setAccount\', \''.esc_js( $google_analytics ).'\']);
				    _gaq.push([\'_trackPageview\']);

				    (function() {
				        var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
				        ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
				        var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
				    })();
				</script>
			';
		}
		echo trim( $output );
	}

	/**
	 * Translate Languages Follow Actived Theme
	 */

}
}
?>