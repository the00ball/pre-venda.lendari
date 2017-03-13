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
	'mode' => ''
), $atts ) );*/

$atts = ( vc_map_get_attributes(  str_replace('.php','',basename(__FILE__)) , $atts ) );
extract( $atts );

$arg = array();     
switch ( $mode ) {
    case 'featured' : 
        $arg = array( 
            'meta_query' => array(
                array( 'key' => '_campaign_featured', 'value' => 1 ) 
            ), 
            'posts_per_page' => $number
        );
        break;

    case 'most_recent' : 
       $arg = array( 
            'posts_per_page' => $number, 
            'orderby' => 'date', 
            'order' => 'DESC'
        );
        break;

    case 'random' : 
        $arg = array(
            'posts_per_page' => $number, 
            'orderby' => 'rand'
        );
        break;

    default : 
     	$arg = array('p' => $mode);
}

$query = new ATCF_Campaign_Query( $arg );
$uid = $_id = wpo_makeid();

?>
<div class="widget campaigns-tab-frontend tab-theme">
	<?php if( $title ) { ?>
        <h3 class="widget-title visual-title <?php echo esc_attr( $size ).' '.esc_attr( $alignment ); ?>">
           <span> <?php echo esc_html( $title ); ?></span>
        </h3>
    <?php } ?>

	<ul class="nav nav-tabs-theme" role="tablist" id="campaign-<?php echo esc_attr( $_id );?>">
		<?php for($i = 0; $i < count($query->posts) ; $i++) { ?>
			 <li role="presentation" class="<?php echo ($i==0)?'active':''; ?>"><a href="#campaign-<?php echo esc_attr( $_id );?>-<?php echo esc_attr( $i ); ?>" aria-controls="home" role="tab" data-toggle="tab"><?php echo( $i + 1 ); ?></a></li>
		<?php } ?>
	</ul>

	<div class="tab-content">
		<?php if ( $query->have_posts() ) :
			while ( $query->have_posts() ) : $query->the_post();
				$campaign = new ATCF_Campaign( get_the_ID());
		?>
			<div role="tabpanel" class="tab-pane <?php echo ($query->current_post==0 ? 'active' : ''); ?>" id="campaign-<?php echo esc_attr( $_id ); ?>-<?php echo esc_attr( $query->current_post ); ?>">
				<div class="campaign-title text-center"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></div>
				<div class="clearfix"></div>
				<div class="campaign-time-left text-center"><span class="title"><?php _e('Expired on: ', 'unity') ?></span><span><?php echo trim( $campaign->days_remaining() ); ?><?php _e(' Day', 'unity'); ?></span></div>
				<div class="clearfix"></div>

				<div class="campaign-content">
					<div class="barometer" data-progress="<?php echo trim( $campaign->percent_completed(false) ) ?>" data-width="148" data-height="148" data-strokewidth="11" data-stroke="#FFF" data-progress-stroke="#F6B21F">
						<span><?php printf( _x( "%s", 'x percent funded','unity' ), '<span class="funded">'.$campaign->percent_completed(false).'<sup>%</sup></span>' ) ?></span>
					</div>	

					<ul class="campaign-status text-center">
						
						<li class="campaign-raised">
							<p class="label"><?php _e( 'Current','unity' ) ?></p>	
							<p class="text"><?php echo esc_html( $campaign->current_amount() ); ?></p>
						</li>
						<li class="campaign-goal">
							<p class="label"><?php _e( 'Target','unity' ) ?></p>
							<p class="text"><?php echo esc_html( $campaign->goal() ); ?></p>		
						</li>
						<li class="campaign-backers hidden">
							<p class="label"><?php _e( 'Backers','unity' ) ?></p>
							<p class="text"><?php echo esc_html( $campaign->backers_count() ); ?></p>
						</li>		
					</ul>
				</div>

				<div class="desciption">
					<?php echo wpo_excerpt(36, '... <a class="read-more" href="' . esc_url( get_the_permalink() ) . '">' . __('Read more', 'unity') . '</a>'); ?>					
				</div>
				<div class="text-center">
					<button type="button" class="btn btn-donate" data-toggle="modal" data-target="#campaign-donate-<?php echo esc_attr(get_the_ID() . "-$uid") ?>">
					  	<?php _e('Donate now', 'unity'); ?>
					</button>
				</div>	

				<div class="modal fade" id="campaign-donate-<?php echo esc_attr(get_the_ID() . "-$uid") ?>" tabindex="-1" role="dialog" aria-labelledby="campaign-donate-<?php echo esc_attr( $_id );?>-<?php echo esc_attr( $query->current_post ); ?>">
					<div class="modal-dialog">
					    <div class="modal-content">
					      	<div class="modal-header">
					        	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					        	<h4 class="modal-title"><?php the_title(); ?></h4>
					      	</div>
					      	<div class="modal-body">
						        <div id="campaign-form-<?php echo esc_attr(get_the_ID() . "-$uid") ?>" class="campaign-form reveal-modal content-block block">
							        <?php echo edd_get_purchase_link( array( 'download_id' => get_the_ID() ) ); ?>
							    </div>
					      	</div>
					    </div>
					</div>
				</div>

			</div>
		<?php endwhile; 
			wp_reset_query();
			endif;
		?>
	</div>
</div>