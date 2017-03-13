<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     WPOpal  Team <wpopal@gmail.com, support@wpopal.com>
 * @copyright  Copyright (C) 2014 wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/support/forum.html
 */

/*extract( shortcode_atts( array(
	'category' => '',
	'number'=>-1,
	'columns_count'=>'4',
	'icon' => '',
	'el_class' => '',
	'style'=>'grid'
), $atts ) );*/

$atts = ( vc_map_get_attributes(  str_replace('.php','',basename(__FILE__)) , $atts ) );
extract( $atts );

switch ($columns_count) {
	case '4':
		$class_column='col-sm-3 col-md-3';
		break;
	case '3':
		$class_column='col-sm-4';
		break;
	case '2':
		$class_column='col-sm-6';
		break;
	default:
		$class_column='col-sm-12';
		break;
}
$_id = wpo_makeid();
if($category=='') return;
$_count = 1;


$loop = wpo_woocommerce_query('',$number,$category);


if($title!=''){ ?>
	<h3 class="widget-title visual-title">
       <span><?php echo esc_html( $title ); ?></span>
	</h3>
<?php }
if ( $loop->have_posts() ) : ?>
	<div class="woocommerce<?php echo (($el_class!='')?' '.esc_attr( $el_class ):''); ?>">
		<div class="widget-content <?php echo esc_attr( $style ); ?>">
			<?php wc_get_template( 'widget-products/'.$style.'.php' , array( 'loop'=>$loop,'columns_count'=>$columns_count,'class_column'=>$class_column,'posts_per_page'=>$number ) ); ?>
		</div>
	</div>
<?php endif; ?>

<?php wp_reset_query(); ?>