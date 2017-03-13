<?php

/*extract(shortcode_atts(array(
			'icon' 			=> '',
			'color' 		=> '',
			'image' 		=> '',
			'number' 		=> '',
			'title' 		=> '',
			'style'	 		=> 'vertical',
			'animate'	 	=> '',
			'el_class'	=> '',
	), $atts));*/

$atts = ( vc_map_get_attributes(  str_replace('.php','',basename(__FILE__)) , $atts ) );
extract( $atts );


$color = $color?'style="color:'. $color .';"' : "";

?>
<?php $img = wp_get_attachment_image_src($image,'full'); ?>
<div class="wpo-counter media animate-math counter_<?php echo esc_attr( $style ) ;?>">
	<?php if( $animate ){ ?>
	<div class="animate" data-anim-type="<?php echo esc_attr( $animate ); ?>">
	<?php } ?>

		<div class="counter-icon-wrapper pull-left">
			<?php if( isset($img[0]) ) { ?>
				<img src="<?php echo trim( $img[0] );?>" title="<?php echo esc_attr( $title ); ?>" class="media-object image-icon">
			<?php }else if( $icon ) { ?>
			 	<i class="fa <?php echo esc_attr( $icon ); ?> fa-4x" <?php echo esc_attr( $color ) ?>></i>
			<?php } ?>
		</div>
		<div class="media-body counter-desc-wrapper">
			<?php if( $number ) { ?>
			<div class="counter-number counter"><?php echo esc_html( $number ); ?></div>
			<?php } ?>
			<?php if( $title ) { ?>
			<h4 class="media-heading counter-title"><span><?php echo esc_html( $title ); ?></span></h4>
			<?php } ?>
		</div>

	<?php if( $animate ){ ?>
	</div>
	<?php } ?>
 </div>