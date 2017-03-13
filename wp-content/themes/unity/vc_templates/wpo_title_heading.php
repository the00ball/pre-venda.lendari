<?php
/*extract( shortcode_atts( array(
    'title'       => '',
    'title_align' => '',
    'descript'    => '',
    'size'        =>'',
    'font_color'  =>'',
    'el_class'    => ''
), $atts ) );*/

$atts = ( vc_map_get_attributes(  str_replace('.php','',basename(__FILE__)) , $atts ) );
extract( $atts );

?>

<div class="widget widget-text-heading <?php echo esc_attr( $el_class ); ?>">
	<?php if($title!=''): ?>
        <h3 class="widget-title visual-title <?php echo esc_attr( $title_align ).' '.esc_attr( $size ); ?>" style="<?php echo 'color:'.$font_color;?>">
           <?php if(trim($descript)!=''){ ?>
                <span class="visual-description">
                    <?php echo trim( $descript ); ?>
                </span>
            <?php } ?>
           <span><?php echo esc_html( $title ); ?></span>
        </h3>
    <?php endif; ?>
</div>