<?php

/*extract(shortcode_atts(array(
		'icon' 			=> '',
		'color' 		=> '',
		'image' 		=> '',
		'number' 		=> '',
		'title' 		=> '',
		'style'	 		=> 'vertical',
		'animate'	 	=> 'animate-math',
		'description'	=> '',
		'information'	=> '',
		'size'     		=> '',
		'alignment'     => 'separator_align_left',
		'el_class'	=> ''
	), $atts));*/

$atts = ( vc_map_get_attributes(  str_replace('.php','',basename(__FILE__)) , $atts ) );
extract( $atts );


	$color = $color?'style="color:'. $color .';"' : "";

?>
<?php $img = wp_get_attachment_image_src($image,'full'); ?>
<div class="widget wpo-reassuarence <?php echo esc_attr( $animate ).' '.esc_attr( $el_class ).' '.esc_attr( $alignment ); ?> counter_<?php echo esc_attr( $style ) ;?>">
		<?php if( isset($img[0]) ) { ?>
			<div class="reassuarence-icon">
		 		<img src="<?php echo trim( $img[0] );?>" title="<?php echo esc_attr( $title ); ?>" class="image-icon">
		 	</div>
		 <?php }else if( $icon ) { ?>
		 	<div class="reassuarence-icon">
		 		<i class="fa <?php echo esc_attr( $icon ); ?> fa-2x" <?php echo esc_attr( $color )?>></i>
		 	</div>
		 <?php } ?>

	   <?php if( $title ) { ?>
		<h3 class="widget-title <?php echo esc_attr( $size ).' '.esc_attr( $alignment ); ?>">
			<?php echo esc_html( $title ); ?>
		</h3>
	  <?php } ?>
	  <p class="widget-content"><?php echo trim( $description ); ?></p>
 </div>