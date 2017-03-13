<?php 
    $day = get_the_date('d');
    $month = get_the_date('M');
?>
<div class="wpo-gallery-item text-center">
    <div class="item-inner">
        <div class="img">
            <?php if ( has_post_thumbnail()) {
                the_post_thumbnail('thumbnails-gallery-category');
            }?>
        </div>

        <div class="caption"> 
            <div class="gallery-heading">
                <div class="date">
                    <div class="day"><?php echo esc_html( $day ); ?></div>
                    <div class="month"><?php echo esc_html( $month ); ?></div>
                </div>
                <div class="gallery-title">
                    <h4 class="entry-title summary">
                        <a class="url" href="<?php the_permalink() ?>" title="<?php the_title() ?>" rel="bookmark">
                            <?php the_title(); ?>
                        </a>
                    </h4>
                </div>
            </div>  
        </div>
    </div>              
</div>  
