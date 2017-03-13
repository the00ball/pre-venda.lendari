<?php
/*extract( shortcode_atts( array(
 	'title'				 =>'',
 	'subtitle'      	 =>'',
 	'price'         	 =>'',
 	'currency'			 =>'',
 	'period'          	 =>'',
 	'featured'           =>'',
 	'style' 			 =>'',
 	'information'     	 =>'',
 	'link' 				 =>'#',
 	'linktitle'     	 =>'Buy Now!',
 	'style'         	 =>'',
), $atts ) );*/

$atts = ( vc_map_get_attributes(  str_replace('.php','',basename(__FILE__)) , $atts ) );
extract( $atts );

$link = !empty($link) ? $link : '#';
$linktitle = !empty($linktitle) ? $linktitle : 'Buy Now!';

 $class = $featured ? "featured-plan": '';
?>

<div class="wpo-pricing-table panel panel-primary <?php echo esc_attr( $class ); ?> text-center">
	<div class="panel-heading pricing-header">
		<h4 class="plan-title"><span><?php echo esc_html( $title ); ?></span></h4>
		<p class="plan-subtitle"><?php echo esc_html( $subtitle ); ?></p>
		<div class="plan-price"><sup class="plan-currency"><?php echo esc_html( $currency ); ?></sup> <span class="plan-figure"><?php echo esc_html( $price ); ?></span><sup class="plan-period"> / <?php echo esc_html( $period ); ?></sup> </div>
	</div>
	<div class="panel-body pricing-body no-padding">
		<div class="plain-info">
			<?php echo do_shortcode($content); ; ?>
		</div>
	</div>
	<div class="panel-footer pricing-footer no-padding">
		<a class="btn btn-lg btn-block btn-outline plan-link" href="<?php echo esc_url( $link ); ?>"><?php echo  esc_html( $linktitle ); ?></a>
	</div>
</div>