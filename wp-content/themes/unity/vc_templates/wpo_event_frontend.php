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
	'title' => '',
	'size' => 'separator_align_left',
	'alignment' => '',
	'mode' => 3,
	'number' => '',
    'column' => '',
    'el_class' => ''

), $atts ) );*/

$atts = ( vc_map_get_attributes(  str_replace('.php','',basename(__FILE__)) , $atts ) );
extract( $atts );

$arg = array();    
$class_col = "col-lg-4 col-md-4 col-sm-4 col-xs-12";
switch ( $mode ) {
    case 'most_recent' : 
       $arg = array( 
            'posts_per_page' => $number, 
            'orderby' => 'date', 
            'order' => 'DESC',
            'post_type' => 'tribe_events'
        );
        break;

    case 'random' : 
        $arg = array(
            'post_type' => 'tribe_events',
            'posts_per_page' => $number, 
            'orderby' => 'rand'
        );
        break;

    default : 
     	$arg = array('p' => $mode);
}

switch ( $column ) {
    case '2' : 
        $class_col = "col-lg-6 col-md-6 col-sm-6 col-xs-12";
        break;
    case '3' : 
      	$class_col = "col-lg-4 col-md-4 col-sm-4 col-xs-12";
        break;
    case '4' : 
      	$class_col = "col-lg-3 col-md-3 col-sm-3 col-xs-12";
        break;
    default : 
     	$class_col = "col-lg-4 col-md-4 col-sm-4 col-xs-12";
}


$query = new WP_Query( $arg );
$_id = wpo_makeid();
?>
<div class="widget wpo-event-frontend <?php echo esc_attr( $el_class ); ?>">
	<?php if( $title ) { ?>
        <h3 class="widget-title visual-title <?php echo esc_attr( $size ).' '.esc_attr( $alignment ); ?>">
           <span> <?php echo esc_html( $title ); ?></span>
        </h3>
    <?php } ?>

	<div class="widget-content tribe-events-list">
		<?php if ( $query->have_posts() ) :
			while ( $query->have_posts() ) : $query->the_post();
				$i = $query->current_post + 1;
		?>
		<?php if($i%$column==1) echo '<div class="row">'; ?>
		
		<article <?php post_class($class_col . 'item-campaign'); ?>>
			<?php get_template_part( 'tribe-events/list/single', 'event' ) ?>	
		</article>	

		<?php if($i%$column==0 || $i==($query->found_posts)) echo '</div>'; ?>
		<?php endwhile; 
			wp_reset_query();
			endif;
		?>
	</div>
</div>