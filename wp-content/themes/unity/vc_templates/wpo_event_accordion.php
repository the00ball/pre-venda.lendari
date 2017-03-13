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
	'alignment' => 'separator_align_left',
	'number' => '',
	'column' => 3,
	'mode' => '',
	'el_class' => '',
	'size'      => ''

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

$query = new WP_Query( $arg );
$_id = wpo_makeid();
?>
<div class="widget wpo-event-frontend <?php echo esc_attr( $el_class ) ?>">
	<?php if( $title ) { ?>
        <h3 class="widget-title visual-title <?php echo esc_attr( $size ).' '.esc_attr( $alignment ); ?>">
           <span> <?php echo esc_html( $title ); ?></span>
        </h3>
    <?php } ?>

	<div class="widget-content tribe-events-accordion">
		<div class="row">
			<div class="col-xs-12 col-sm-6 panel-group" id="accordion-<?php echo esc_attr( $_id ); ?>" role="tablist" aria-multiselectable="true">
				<?php if ( $query->have_posts() ) :
					while ( $query->have_posts() ) : $query->the_post();
						$i = $query->current_post + 1;
				?>
					<article <?php post_class('panel panel-default accordion-toggle'); ?>>
						
						<div class="panel-heading <?php echo ( $i==1 ) ? 'active' : '' ?>" role="tab" id="heading-<?php echo esc_attr( $_id ) . esc_attr( $i ) ?>">						
							<div class="heading-icon">
								<i class="fa fa-calendar"></i>
							</div>
							<div class="heading-inner">
								<div class="date"><i class="fa fa-clock-o"></i><?php echo tribe_get_start_date( get_the_ID(), false, 'H:i m/d/Y' ); ?> </div>
								<h4 class="panel-title">
									<a data-event="<?php echo ('event-tab-' . $_id . $i) ?>" class="action-open-event  <?php echo ( $i==1 ) ? '' : 'collapsed' ?>" aria-controls="accordion-item-<?php echo esc_attr( $_id . $i ); ?>" aria-expanded="<?php echo ( $i==1 ) ? 'true' : 'false' ?>" href="#accordion-item-<?php echo esc_attr( $_id . $i ) ?>" data-parent="#accordion-<?php echo esc_attr( $_id ); ?>" data-toggle="collapse"> <?php the_title(); ?> </a>
								</h4>
								<span class="arrow fa fa-angle-down"></span>
							</div>	
						</div>

						<div id="accordion-item-<?php echo esc_attr( $_id . $i ); ?>" class="panel-collapse collapse <?php echo ( $i==1 ) ? 'in' : '' ?>" role="tabpanel" aria-labelledby="heading-<?php echo esc_attr( $_id . $i ); ?>">
							<div class="event-body hidden">
								<div class="left">
									<?php the_post_thumbnail('thumbnail') ?>
								</div>
								<div class="right">
									<?php echo wpo_excerpt(15, '...'); ?>
									<p class="readmore"><a href="<?php the_permalink(); ?>"><?php _e('Read more', 'unity'); ?></a></p>
								</div>	
							</div>	
						</div>
					</article>	
				<?php endwhile; 
					
					endif;
				?>
			</div>	
			
			<div class="col-xs-12 col-sm-6 tribe-events-content">
				<?php if ( $query->have_posts() ) :
						while ( $query->have_posts() ) : $query->the_post();
							$i = $query->current_post + 1;
							global $post;
					$start = strtotime($post->EventStartDate);
					$end = strtotime($post->EventEndDate);
					$day = date('d', $start);
					$month = date('M', $start);		
				?>
				<div class="event-detail-tab event-detail-tab-<?php echo esc_attr( $_id ); ?> <?php echo ('event-tab-' . $_id . $i) ?> <?php echo ($i==1)?'active':''; ?> ">
					<article <?php echo trim( $post->class ); ?>>
						<div class="event-header-inner layout-2">
							<div class="event-header-inner">
								<div class="event-thumbnail">
									<?php the_post_thumbnail(); ?>
								</div>
								<div class="event-header clearfix">
									<div class="event-desc">
										<?php echo wpo_excerpt(20, '...'); ?>
										<p class="readmore"><a href="<?php the_permalink(); ?>"><?php _e('Read more', 'unity'); ?></a></p>
									</div>
								</div>
							</div>	
							
							<div class="event-time">
								<div class="heading-time"><?php _e('Time left', 'unity'); ?></div>
								<div class="time">
						            <div class="pts-countdown clearfix" data-countdown="countdown"
						                 data-date="<?php echo  tribe_get_start_date( $post->ID, false, 'Y-m-d-H-i-s' ); ?>">
						            </div>
						        </div>
							</div>
						</div>
					</article>
				</div>	
			<?php endwhile; wp_reset_query(); endif;?>
			</div>
		</div>	
	</div>
</div>

<script>
(function ($) {
	"use strict";
	$(".action-open-event").click(function(){
		var tab = $(this).attr('data-event');
		$(".event-detail-tab-<?php echo esc_js( $_id ); ?>").each(function(){
			$(this).removeClass('active');
		});
		$('.' + tab).addClass('active');
	})
})(jQuery)	
</script>