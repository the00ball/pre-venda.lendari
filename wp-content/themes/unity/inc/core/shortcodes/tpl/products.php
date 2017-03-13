<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     Opal  Team <opalwordpressl@gmail.com >
 * @copyright  Copyright (C) 2014 wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/support/forum.html
 */
extract($atts);

switch ($columns_count) {
	case '4':
		$class_column='col-lg-3 col-md-3 col-sm-6 col-xs-12';
		break;
	case '3':
		$class_column='col-lg-4 col-md-4 col-sm-6 col-xs-12';
		break;
	case '2':
		$class_column='col-lg-6 col-md-6 col-sm-6 col-xs-12';
		break;
	default:
		$class_column='col-lg-12 col-md-12 col-sm-12 col-xs-12';
		break;
}

if($type=='') return;

global $woocommerce;

$_id = wpo_makeid();
$_count = 1;

$loop = wpo_woocommerce_query($type,$number);

if ( $loop->have_posts() ) : ?>	
	<div class="widget widget-products products">
		<?php if($title!=''){ ?>
			<h3 class="widget-title"><?php echo esc_html( $title ); ?></h3>			
		<?php } ?>
		<?php wc_get_template( 'widget-products/'.$layout.'.php' , array( 'loop'=>$loop,'columns_count'=>$columns_count,'class_column'=>$class_column,'posts_per_page'=>$number,'two_rows'=>false ) ); ?>
	</div>
<?php endif; ?>

<?php wp_reset_query(); ?>



