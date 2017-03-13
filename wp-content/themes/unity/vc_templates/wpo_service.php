<?php
/*extract( shortcode_atts( array(
	'title'=>'',
	'size' => '',
	'icon'=> '',
	'style'	=> '',
	'el_class'=>'',
	'title_align'=>'',
	'information'=>'',
	'photo' => ''
), $atts ) );*/

$atts = ( vc_map_get_attributes(  str_replace('.php','',basename(__FILE__)) , $atts ) );
extract( $atts );

$img = wp_get_attachment_image_src($photo,'full');
?>

<div class="widget wpo-ourservice <?php echo esc_attr( $el_class ).' '.esc_attr( $style ).' '; ?>">
	<?php if(isset($img[0]) && $img[0]){?>
	<div class="ourservice-image">
		<img src="<?php echo trim( $img[0] );?>" alt="<?php echo esc_attr( $title ); ?>" />
	</div>
	<?php } ?>
	<?php if($icon){ ?>
	<div class="ourservice-icon">
		<i class="fa <?php echo esc_attr( $icon ); ?> text-skin"></i>
	</div>
	<?php } ?>
	<?php if($title!=''): ?>
		<h3 class="widget-title ourservice-heading <?php echo esc_attr( $size ).' '.esc_attr( $title_align ).' '; ?>">
			<span><?php echo esc_html( $title ); ?></span>
		</h3>
	<?php endif; ?>
	<?php if(trim($information)!=''){ ?>
        <p class="ourservice-content">
			<?php echo do_shortcode( $information );?>
		</p>
    <?php } ?>
</div>