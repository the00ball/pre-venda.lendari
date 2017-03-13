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
	'title'=>'',
	'size' => '',
    'alignment' => 'separator_align_left',
	'el_class' => '',
	'skin'=>'skin-1',
	'number' => '6'
), $atts ) );*/

$atts = ( vc_map_get_attributes(  str_replace('.php','',basename(__FILE__)) , $atts ) );
extract( $atts );

$_id = wpo_makeid();
$_count = 0;
$args = array(
	'post_type' => 'testimonial',
	'posts_per_page' => $number,
	'post_status' => 'publish',
);

$query = new WP_Query($args);
?>

<div class="widget wpo-testimonial <?php echo esc_attr( $skin ).' '.esc_attr( $el_class ); ?>">
	<?php if($query->have_posts()){ ?>
		<?php if($title!=''){ ?>
			<h3 class="widget-title visual-title <?php echo esc_attr( $size ).' '.esc_attr( $alignment ); ?>">
				<span><?php echo esc_html( $title ); ?></span>
			</h3>
		<?php } ?>
		<?php if($skin=='skin-1'){ ?>
			<!-- Skin 1 -->
			<div id="carousel-<?php echo esc_attr( $_id ); ?>" class="widget-content text-center carousel slide" data-ride="carousel">
				<div class="carousel-inner testimonial-carousel">
					<?php while($query->have_posts()):$query->the_post(); ?>
						<!-- Wrapper for slides -->
						<div class="item<?php echo (($_count==0)?" active":"") ?>">
							<div class="carousel-body testimonial-info text-uppercase">
								<div class="testimonial-avata"><?php the_post_thumbnail('widget');?></div>
								<div class="testimonial-meta hidden">
									<h5 class="testimonial-customer-name text-skin"><?php the_title(); ?></h5>
									<div class="testimonial-customer-position">
										<?php the_excerpt(); ?>
									</div>
								</div>	
							</div>
							<div class="testimonial-description">
								<?php the_content() ?>
							</div>
						</div>
						<?php $_count++; ?>
					<?php endwhile; ?>
				</div>

				<!-- Indicators -->
				<div class="testimonial-navigation">
					<div class="testimonial-navigation-inner">
						<ol class="carousel-indicators testimonial-carousel-indicators">
							<?php $_count =0; ?>
							<?php while($query->have_posts()):$query->the_post(); ?>
							    <li data-target="#carousel-<?php echo esc_attr( $_id ); ?>" data-slide-to="<?php echo esc_attr( $_count ); ?>" <?php echo ($_count==0)?'class="active"':''; ?>>
							    </li>
							    <?php $_count++; ?>
							<?php endwhile; ?>
					  	</ol>
					</div>
				</div>
			</div>

		<?php }else if($skin == 'skin-2'){ ?>
			<!-- Skin 2 -->
			<div id="carousel-<?php echo esc_attr( $_id ); ?>" class="widget-content carousel slide" data-ride="carousel">
				<div class="carousel-inner testimonial-carousel">
					<?php while($query->have_posts()):$query->the_post(); 
						$_count = $query->current_post + 1; 
					?>
						<!-- Wrapper for slides -->
						<?php if( $_count % 3 == 1 ) echo '<div class="item'.(($_count==1)?" active":"").'"><div class="row">'; ?>
							<div class="col-md-4">
								<div class="testimonial-thumbnail text-center">
									<?php the_post_thumbnail();?>
								</div>
								<h5 class="testimonial-customer-name text-center"><?php the_title(); ?></h5>
								<div class="testimonial-customer-position text-center">
									<?php the_excerpt(); ?>
								</div>
								<div class="testimonial-description text-center">
									<?php the_content() ?>
								</div>
							</div>
						<?php if( ($_count%3==0) || $_count == $query->found_posts ) echo '</div></div>'; ?>
					<?php endwhile; ?>
				</div>
				<div class="testimonial-navigation">
					<ol class="carousel-indicators testimonial-carousel-indicators">
						<?php for ($i=0, $total=(int) $query->found_posts/3; $i < $total ; $i++) { ?>
							<li data-target="#carousel-<?php echo esc_attr( $_id ); ?>" data-slide-to="<?php echo esc_attr($i); ?>" <?php echo ($i==0)?'class="active"':''; ?>></li>
						<?php } ?>
				  	</ol>
				</div>
			</div>
		<?php } ?>
	<?php } ?>
</div>
<?php wp_reset_query(); ?>