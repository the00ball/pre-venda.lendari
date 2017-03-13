<?php
$output = $title = $page_url = $width = $size = $show_faces = $show_stream = $show_header = '';
/*extract(shortcode_atts(array(
    'title'		 	=> 	'',
    'size' 			=> '',
    'alignment' 	=> '',
    'page_url' 		=> 	'#',
    'width' 		=> 	268,
    'color_scheme' 	=> 	'light',
    'show_faces' 	=> 	'',
    'show_stream' 	=> 	'',
    'show_header'	=>	'',
    'el_class'		=> ''
), $atts));*/

$atts = ( vc_map_get_attributes(  str_replace('.php','',basename(__FILE__)) , $atts ) );
extract( $atts );


	$show_faces 	= ($show_faces) ? 'true' : 'false';	
	$show_stream 	= ($show_stream) ? 'true' : 'false';	
	$show_header 	= ($show_header) ? 'true' : 'false';	
	$height = '65';

	if($show_faces == 'true') {
		$height = '240';
	}

	if($show_stream == 'true') {
		$height = '515';
	}

	if($show_stream == 'true' && $show_faces == 'true' && $show_header == 'true') {
		$height = '540';
	}

	if($show_stream == 'true' && $show_faces == 'true' && $show_header == 'false') {
		$height = '540';
	}

	if($show_header == 'true') {
		$height = $height + 30;
	}
?>
<div class="widget wpo-facebook-fanbox <?php echo ($el_class ? esc_attr( $el_class ) : ''); ?>">
	<?php if( $title ) { ?>
	    <h3 class="widget-title visual-title <?php echo esc_attr( $size ).' '.esc_attr( $alignment ); ?>">
	       <span> <?php echo esc_html( $title ); ?></span>
	    </h3>
	<?php } ?>
	<?php if($page_url): ?>
		<iframe src="http<?php echo (is_ssl())? 's' : ''; ?>://www.facebook.com/plugins/likebox.php?href=<?php echo esc_url($page_url); ?>&amp;width=<?php echo esc_attr( $width ); ?>&amp;colorscheme=<?php echo esc_attr( $color_scheme ); ?>&amp;show_faces=<?php echo esc_attr( $show_faces ); ?>&amp;stream=<?php echo esc_attr( $show_stream ); ?>&amp;header=<?php echo esc_attr( $show_header ); ?>&amp;height=<?php echo esc_attr( $height ); ?>&amp;force_wall=true<?php if($show_faces == 'true'): ?>&amp;connections=8<?php endif; ?>" 
			style="border:none; overflow:hidden; width:<?php echo esc_attr( $width ); ?>px; height: <?php echo esc_attr( $height ); ?>px;">
		</iframe>
	<?php endif;?>
</div>