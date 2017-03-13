<?php
/*extract( shortcode_atts( array(
	'title'       =>'',
	'imagebg'     => '',
	'colorbg'     => '',
	'el_class'    =>'',
	'size'        =>'',
	'title_align' =>'',
	'information' =>''
), $atts ) );*/

$atts = ( vc_map_get_attributes(  str_replace('.php','',basename(__FILE__)) , $atts ) );
extract( $atts );

 $style = array();
?>

<?php $img = wp_get_attachment_image_src($imagebg,'full'); ?>
<?php
	if( isset($img[0]) )  {
		 $style[] = "background-image:url('".$img[0]."')";
	}
	if( $colorbg ){
		$style[] = "background-color:".$colorbg;
	}
?>


<div class="widget wpo-inforbox <?php echo esc_attr( $el_class );?>" style="<?php echo  implode(';', $style); ?>">
	<?php if($title!=''): ?>
    	<h3 class="widget-title inforbox-heading <?php echo esc_attr( $title_align ).' '.esc_attr( $size ); ?>">
			<span><?php echo esc_html($title); ?></span>
		</h3>
    <?php endif; ?>

    <?php if(trim($information)!=''){ ?>
        <div class="inforbox-content">
			<?php echo do_shortcode( $information );?>
		</div>
    <?php } ?>
</div>