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
        'title'     => '',
        'alignment' => 'separator_align_left',
        'number'    => '6',
        'column'    => '3',
        'class'     => '',
        'padding'   => '',
        'size'      => ''
    ), $atts ) );*/

    $atts = ( vc_map_get_attributes(  str_replace('.php','',basename(__FILE__)) , $atts ) );
    extract( $atts );
    
    switch ($column) {
		case '6': 
			$class_column = 'col-lg-2 col-md-4 col-sm-4 col-xs-6';
			break;
		case '4':
			$class_column='col-md-3 col-sm-3 col-xs-6';
			break;
		case '3':
			$class_column='col-md-4 col-sm-4';
			break;
		case '2':
			$class_column='col-md-6 col-sm-6 col-xs-6';
			break;
		default:
			$class_column='col-md-12 col-sm-12';
			break;
	}

    $args = array( 
        'post_type' => 'gallery',
        'posts_per_page' => $number
    );
    $query = new WP_Query($args);
    $_id = wpo_makeid();
?>

<div class="widget wpo-gallery-grid <?php echo ($padding) ? 'gallery-no-padding' : '' ?> <?php echo ($class) ? esc_attr( $class ) : ''; ?>">
    <?php if( $title ) { ?>
        <h3 class="widget-title visual-title <?php echo esc_attr( $size ).' '.esc_attr( $alignment ); ?>">
           <span> <?php echo esc_html( $title ); ?></span>
        </h3>
    <?php } ?>

    <div class="widget-content">
        <?php if ( $query->have_posts() ) :
            while ( $query->have_posts() ) : $query->the_post();    
            $image_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_id() ), 'thumbnails-gallery' );
            $i = $query->current_post + 1;
        ?>
        <?php if($i % $column == 1) echo '<div class="row">' ?>
            <div class="item text-center <?php echo esc_attr( $class_column ); ?> <?php echo ($padding) ? 'no-padding' : '' ?>">
            	<div class="entry-thumbnail"> 
                	<img src="<?php echo trim( $image_attributes[0] ); ?>" alt="<?php the_title(); ?>" />
                    <h3><a class="title" href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                </div>    
            </div>
           <?php if($i % $column == 0 || $i==($query->found_posts)) echo '</div>' ?> 
        <?php endwhile; 
            wp_reset_query();
            endif;
        ?>
    </div>
</div>