<?php
$grid_link = $grid_layout_mode = $title = $filter= '';
$posts = array();
/*extract(shortcode_atts(array(
    'title' => '',
    'grid_link_target' => '_self',
    'filter' => '', //grid,
    'grid_thumb_size' => 'thumbnail',
    'grid_layout_mode' => 'fitRows',
    'el_class' => '',
    'teaser_width' => '12',
    'orderby' => NULL,
    'order' => 'DESC',
    'size' => '',
    'alignment' => 'separator_align_left',
    'descript' => '',
    'loop' => '',
    'layout'    => 'blog',
    'grid_columns'  => 4,
), $atts));*/

$atts = ( vc_map_get_attributes(  str_replace('.php','',basename(__FILE__)) , $atts ) );
extract( $atts );

if(empty($loop)) return;
$this->getLoop($loop);
$args = $this->loop_args;

$my_query = new WP_Query($args);
$columgrid = floor(12/$grid_columns);
if(  empty($layout) ){
    $layout = 'blog';
}

$countposts = $args ['posts_per_page'];
?>

<section class="widget post blog-type <?php echo (($el_class!='')?' '.esc_attr( $el_class ):''); ?>">
    <?php if( $title ) { ?>
        <h3 class="widget-title visual-title <?php echo esc_attr( $size ).' '.esc_attr( $alignment ); ?>">
           <span> <?php echo esc_html( $title ); ?></span>
            <?php if(trim($descript)!=''){ ?>
                <span class="visual-description">
                    <?php echo trim( $descript ); ?>
                </span>
            <?php } ?>
        </h3>
    <?php } ?>

    <div class="widget-content">
        <div class="row">
            <?php $i=0; while ( $my_query->have_posts() ): $my_query->the_post(); ?>
            <div class="col-sm-<?php echo esc_attr( $columgrid ); ?> col-md-<?php echo esc_attr( $columgrid ); ?> col-lg-<?php echo esc_attr( $columgrid ); ?>">
                <?php get_template_part( 'templates/blog/'.$layout ); ?>
            </div>
            <?php if( ++$i== $countposts){ break; } ?>
            <?php endwhile; ?>
        </div>
    </div>
</section>
<?php wp_reset_query();

