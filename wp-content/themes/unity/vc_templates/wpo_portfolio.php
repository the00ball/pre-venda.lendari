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
wp_enqueue_style( 'isotope-css' );
wp_enqueue_script( 'isotope' );

/*extract( shortcode_atts( array(
  'title'         => '',
  'size'          => '',
  'el_class'      => '',
  'descript'      => '',
  'alignment'     => '',
  'template'      => '',
  'number'        => -1,
  'columns_count' => '4',
  'style'         => 'effect5 left_to_right'
  ), $atts ) );*/

$atts = ( vc_map_get_attributes(  str_replace('.php','',basename(__FILE__)) , $atts ) );
extract( $atts );

$col = floor(12/$columns_count);
$smcol = ($col > 4)? 6: $col;
$class_column='col-lg-'.$col.' col-md-'.$col.' col-sm-'.$smcol;

$portfolio_skills = get_terms('Categories',array('orderby'=>'id'));
$args = array(
  'post_type' => 'portfolio',
  'posts_per_page'=>$number
  );
$loop = new WP_Query($args);

?>

<div class="widget wpb_grid wpo-portfolio <?php echo (($el_class!='')?' '.esc_attr( $el_class ):''); ?>">
  <div class="teaser_grid_container">
    <div class="wpb_filtered_grid teaser_grid_container">
        <?php if( $title ) { ?>
            <h3 class="widget-title visual-title <?php echo esc_attr( $size ).' '.esc_attr( $alignment ); ?>">
                <span><?php echo esc_html( $title ); ?></span>
                <?php if(trim($descript)!=''){ ?>
                <span class="visual-description">
                <?php echo trim( $descript ); ?>
                </span>
                <?php } ?>
            </h3>
        <?php } ?>

      <?php if( $loop->have_posts()): ?>
      <!-- filters category -->
      <div id="filters" class="isotope-filter">
        <ul class="nav nav-tabs wpo-portfolio-filters categories_filter">
          <?php
          $terms = $portfolio_skills;
          $count = count($terms);
          echo '<li><a href="javascript:void(0)" title="" data-filter=".all" class="active">All</a></li>';

          if ( $count > 0 ){
            foreach ( $terms as $term ) {
              echo '<li><a href="javascript:void(0)" title="" data-filter=".'.esc_attr( $term->slug ).'">'.esc_html($term->name).'</a></li>';
            }
          }
          ?>
        </ul>
      </div>

      <!-- end filters -->
      <?php $_id = wpo_makeid();

      ?>

      <div class="isotope-list row wpb_thumbnails wpb_thumbnails-fluid clearfix list-unstyled" data-isotope-duration="400" id="isotope-<?php echo esc_attr( $_id ); ?>">
       <?php while($loop->have_posts()): $loop->the_post();

       $item_classes = 'all ';
       $item_cats = get_the_terms( $loop->post->ID, 'Categories' );

       foreach((array)$item_cats as $item_cat){
         if(count($item_cat)>0){
           $item_classes .= $item_cat->slug . ' ';
         }
       }
       $image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( $loop->post->ID ), 'blog-thumbnails' );
       ?>
       <div class="isotope-item <?php echo esc_attr( $class_column ); ?> item <?php echo esc_attr( $item_classes ); ?>">
        
        <div class="wpo-portfolio-content thumbnail text-center">
          <div class="ih-item square colored <?php echo esc_attr( $style ); ?>">
            <a href="<?php the_permalink(); ?>">
              <div class="img">
                  <?php if ( has_post_thumbnail()) {
                    the_post_thumbnail('blog-thumbnails');
                  }?>
              </div>
              <div class="info">
              <h3><?php the_title(); ?></h3>
              <p><?php echo wpo_excerpt(20,'...'); ?></p>
              </div>
            </a>
          </div>
      </div>

    </div>
    <?php endwhile; ?>
    </div>


    <?php endif; ?>
    </div>
  </div>  
</div>    
<?php wp_reset_query(); ?>

<script>

</script>