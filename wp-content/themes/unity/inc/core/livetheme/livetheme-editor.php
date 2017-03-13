<?php
/**
 * Plugin Name: WPO Theme Customizer
 * Plugin URI: https://wpopal.com
 * Description: Customize theme
 * Version: 1.1.2
 * Author: Wpopal
 * Author URI: https://wpopal.com
 * License: http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * Text Domain: wpo-customize
 * Domain Path: /languages
 *
 * @package   Widget_Importer_Exporter
 * @copyright Copyright (c) 2014, Wpopal Team
 * @link      https://wpopal.com
 * @license   http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */

// No direct access
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * Main class
 *
 * @since 0.1
 */
class WPO_Themecustomizer {


	public function __construct() {
		add_action('admin_menu', array( $this, 'adminLoadMenu') );
		require_once( dirname(__FILE__).'/livetheme.php' );

		WPO_LiveTheme::getInstance();
		 
	}	


	public function adminLoadMenu(){
		add_theme_page( 'Live Theme Editor', $this->l("Live Theme Editor"), 'switch_themes', 'wpo_livethemeedit', array($this,'liveThemePage') );
	}

	public function liveThemePage(){
	}

	public function l($text){
		return $text;
	}

}

// Instantiate the main class
new WPO_Themecustomizer();
