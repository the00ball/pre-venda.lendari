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
wp_enqueue_script( 'wpo_isotope_js', WPO_THEME_URI.'/js/isotope.pkgd.min.js', array( 'jquery' ) );

$terms = get_terms('Categories',array('orderby'=>'id'));

$_id = wpo_makeid();

global $column, $portfolio;

$col = floor(12/$column);
$smcol = ($col > 4)? 6: $col;
$class_column='col-lg-'.$col.' col-md-'.$col.' col-sm-'.$smcol;
$_count =0;

?>

<div class="wpo-portfolio">
<?php if( $portfolio->have_posts()): ?>
    <!-- filters category -->
    <div class="col-xs-12">
      <div id="filters" class="isotope-filter">
        <ul class="nav nav-tabs wpo-portfolio-filters">
          <li>
            <a href="javascript:void(0)" title="" data-filter=".all" class="active">
              <?php _e('All', 'unity'); ?>
            </a>
          </li>
      <?php if ( count($terms) > 0 ){
            foreach ( $terms as $term ): ?>
              <li><a href="javascript:void(0)" title="" data-filter=".<?php echo esc_attr( $term->slug ); ?>">
              <?php echo esc_html( $term->name ); ?>
              </a></li>
        <?php endforeach;
            }
        ?>
        </ul>
      </div>
    </div>
    <div class="clearfix"></div>
  <div class="isotope row" data-isotope-duration="400" id="isotope-<?php echo esc_attr( $_id ); ?>">
  <?php while($portfolio->have_posts()): $portfolio->the_post();
     $item_classes = 'all ';
     $item_cats = get_the_terms( $portfolio->post->ID, 'Categories' );
     foreach((array)$item_cats as $item_cat){
       if(count($item_cat)>0){
         $item_classes .= $item_cat->slug . ' ';
        }
      }
$image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( $portfolio->post->ID ), 'blog-thumbnails' );
?>
<div class="<?php echo esc_attr( $class_column ); ?> item <?php echo esc_attr( $item_classes ); ?>">
    <div class="wpo-portfolio-content thumbnail text-center">
      <div class="ih-item square effect8 scale_up">
        <a href="<?php the_permalink(); ?>">
          <div class="img">
              <?php if ( has_post_thumbnail()) {
                the_post_thumbnail('blog-thumbnails');
              }?>
          </div>
          <div class="info">
            <h3><?php the_title(); ?></h3>
            <p>
              <?php echo wpo_excerpt(20,'...'); ?>
            </p>
          </div>
        </a>
      </div>              
    </div>  
</div>
<?php endwhile; ?>
</div>


<?php endif; ?>
</div>
<?php wp_reset_query(); ?>