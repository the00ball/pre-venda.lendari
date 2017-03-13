<?php

function wpo_cst_skins(){
    $path = WPO_THEME_DIR.'/css/skins/*';
    $files = glob($path , GLOB_ONLYDIR );
    $skins = array( 'default' => 'default' );
    if(count($files)>0){
        foreach ($files as $key => $file) {
            $skin = str_replace( '.css', '', basename($file) );
            $skins[$skin]=$skin;
        }
    }

    return $skins;
}


function wpo_cst_headerlayouts(){
    $path = WPO_THEME_DIR.'/header-*.php';
    $files = glob($path  );
    $headers = array( '' => __('Default', 'unity' ) );
    if(count($files)>0){
        foreach ($files as $key => $file) {
            $header = str_replace( "header-", '', str_replace( '.php', '', basename($file) ) );
            $headers[$header] = ucfirst( $header );
        }
    }

    return $headers;
}

function wpo_cst_css_profiles(){
    $path = WPO_THEME_DIR.'/customize/assets/*.css';
    $files = glob($path  );
    $skins = array( 'nouse' => __('No Use', 'unity') );

    if(count($files)>0){
        foreach ($files as $key => $file) {
            $skin = str_replace( '.css', '', basename($file) );
            $skins[$skin]=$skin;
        }
    }

    return $skins;
}

function wpo_cst_fonts_list(){
    $font_faces = array(
        "'Arvo', serif" => "Arvo",
        "'Copse', sans-serif" => "Copse",
        "'Cabin', sans-serif" => "Cabin",
        "'Droid Sans', sans-serif" => "Droid Sans",
        "'Droid Serif', serif" => "Droid Serif",
        "'Economica'', sans-serif" => "Economica",
        "'Helvetica Neue', sans-serif" => "Helvetica Neue",
        "'Josefin Slab', serif" => "Josefin Slab",
        "'Lato', sans-serif" => "Lato",
        "'Lobster', cursive" => "Lobster",
        "'Nobile', sans-serif" => "Nobile",
        "'Open Sans', sans-serif" => "Open Sans",
        "'Oswald', sans-serif" => "Oswald",
        "'Poly', sans-serif" => "Poly",
        "'Pacifico', cursive" => "Pacifico",
        "'Roboto', sans-serif" => "Roboto",
        "'Rokkitt', serif" => "Rokkit",
        "'PT Sans', sans-serif" => "PT Sans",
        "'Quattrocento', serif" => "Quattrocento",
        "'Raleway', cursive" => "Raleway",
        "'Titillium Web', sans-serif" => "Titillium Web",
        "'Ubuntu', sans-serif" => "Ubuntu",
        "'Vollkorn', serif" => "Vollkorn",
        "'Yanone Kaffeesatz', sans-serif" => "Yanone Kaffeesatz");
    return $font_faces;
}


function wpo_get_menuanimation(){
    return array(
        ''        => 'None',
        'slide'   => 'Slide',
        'zoom'    => 'Zoom',
        'elastic' => 'Elastic',
        'fading'  => 'Fading'
    );
}
        
function wpo_get_footerbuilder_profiles() {
    $footers_type = get_posts( array('posts_per_page'=>-1,'post_type'=>'footer') );
    $footers = array('default'=>'Default');
    foreach ($footers_type as $key => $value) {
        $footers[$value->ID] = $value->post_title;
    }
    return $footers;
}

function wpo_get_styles( $path, $file_name){
    //$path = WPO_THEME_DIR.'/temheader-*.php';
    $files = glob($path  );
    $styles = array( '' => __('Default', 'unity' ) );
    if(count($files)>0){
        foreach ($files as $key => $file) {
            $style = str_replace( $file_name, '', str_replace( '.php', '', basename($file) ) );
            $styles[$style] = ucfirst( $style );
        }
    }

    return $styles;
}

 
function wpo_cst_customize_register( $wp_customize ) {
    $readmore = wpo_theme_options ('post_readmore');
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}
add_action( 'customize_register', 'wpo_cst_customize_register' );


function wpo_cst_customize_preview_assets() { 
    wp_enqueue_script( 'wpo_cst_customizer_js', get_template_directory_uri() . '/inc/customizer/assets/customizer.js' );
    wp_enqueue_style( 'wpo_cst_customizer_css', get_template_directory_uri() . '/inc/customizer/assets/customizer.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'wpo_cst_customize_preview_assets' );

?>
