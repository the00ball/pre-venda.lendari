<?php

if( $title ) {
        echo $before_title.esc_html( $title ).$after_title;
    }
?>

<div class="widget-video-content widget-content">
    <div class="widget-video-inner embed-responsive embed-responsive-16by9">
        <?php if ( $embed_code ) { ?>
            <?php echo trim( $embed_code ); ?>
        <?php } else { ?>
            <span class="visual-video-error text-error">
                <?php echo __( 'Video error!', 'unity' ); ?>
            </span>
        <?php } ?>
    </div>
    <?php if ( $video_name ) { ?>
        <h6 class="widget-video-name">
            <?php echo trim( $instance['video_name'] ); ?>
        </h6>
    <?php } ?>
</div>