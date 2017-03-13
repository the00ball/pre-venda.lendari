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
	'number' => 1,
	'layout' => 'item-1',
	'size' => ''
), $atts ) );*/

$atts = ( vc_map_get_attributes(  str_replace('.php','',basename(__FILE__)) , $atts ) );
extract( $atts );

$arg = array( 
    'meta_query' => array(
        array( 'key' => '_campaign_featured', 'value' => 1 ) 
    ), 
    'posts_per_page' => $number
);

$query = new ATCF_Campaign_Query( $arg );
$_id = wpo_makeid();
?>
<div class="widget campaigns-tab-featured">
	<?php if($title!=''):?>
		<h3 class="widget-title <?php echo esc_attr( $size ).' '.esc_attr( $alignment ).' '; ?>">
    		<span><?php echo esc_html( $title ); ?></span>
		</h3>
	<?php endif; ?>
	<div class="widget-content">
		<div class="carousel slide" id="carousel-<?php echo esc_attr( $_id ); ?>" data-ride="carousel">
			<div class="carousel-inner" role="listbox">
				<?php if ( $query->have_posts() ) :
					while ( $query->have_posts() ) : $query->the_post();
					$i = $query->current_post;
				?>
				<div class="item <?php echo ($i==0?'active':'') ?>">
					<?php get_template_part('vc_templates/campaigns_featured/layout', $layout); ?>
				</div>
				<?php endwhile; 
					wp_reset_query();
					endif;
				?>
			</div>
			<div class="clearfix"></div>
			<?php if($query->post_count > 1) : ?>
				<div class="navigation">
					<div class="navigation-inner">
						<ol class="carousel-indicators">
							<?php $_count =0; ?>
							<?php while($query->have_posts()):$query->the_post(); ?>
							    <li data-target="#carousel-<?php echo esc_attr( $_id ); ?>" data-slide-to="<?php echo esc_attr( $_count ); ?>" <?php echo ($_count==0)?'class="active"':''; ?>>
							    </li>
							    <?php $_count++; ?>
							<?php endwhile; ?>
					  	</ol>
					</div>
				</div>
			<?php endif; ?>	
		</div>	
	</div>
</div>