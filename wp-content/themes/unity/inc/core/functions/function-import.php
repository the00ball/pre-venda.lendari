<?php
function unity_fnc_import_remote_demos() { 
   return array(
      'unity' => array( 'name' => 'unity',  'source'=> 'http://wpsampledemo.com/unity/unity.zip' ),
   );
}

add_filter( 'pbrthemer_import_remote_demos', 'unity_fnc_import_remote_demos' );



function unity_fnc_import_theme() {
   return 'unity';
}
add_filter( 'pbrthemer_import_theme', 'unity_fnc_import_theme' );

function unity_fnc_import_demos() {
   $folderes = glob( WPO_THEME_DIR.'/inc/import/*', GLOB_ONLYDIR ); 

   $output = array(); 

   foreach( $folderes as $folder ){
      $output[basename( $folder )] = basename( $folder );
   }
   
   return $output;
}
add_filter( 'pbrthemer_import_demos', 'unity_fnc_import_demos' );

function unity_fnc_import_types() {
   return array(
         'all' => 'All',
         'content' => 'Content',
         'widgets' => 'Widgets',
         'page_options' => 'Theme + Page Options',
         'menus' => 'Menus',
         'rev_slider' => 'Revolution Slider',
         'vc_templates' => 'VC Templates'
      );
}
add_filter( 'pbrthemer_import_types', 'unity_fnc_import_types' );
