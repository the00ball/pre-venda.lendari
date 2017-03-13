<?php 
global $post, $woocommerce, $product, $is_IE;

?>
<div class="images<?php if($is_IE): ?> ie<?php endif ?>">

    <?php
    if ( has_post_thumbnail() ) {

        $image              = get_the_post_thumbnail( $post->ID, apply_filters( 'single_product_large_thumbnail_size', 'shop_single' ) );
        $image_title        = esc_attr( get_the_title( get_post_thumbnail_id() ) );
        $image_link         = wp_get_attachment_url( get_post_thumbnail_id() );
        list( $magnifier_url, $magnifier_width, $magnifier_height ) = wp_get_attachment_image_src( get_post_thumbnail_id(), "shop_magnifier" );

        $placeholder = function_exists('wc_placeholder_img_src') ? wc_placeholder_img_src() : woocommerce_placeholder_img_src();

        echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="yith_magnifier_zoom woocommerce-main-image" title="%s">%s</a>', $magnifier_url, $image_title, $image ), $post->ID );

    } else {
        echo apply_filters( 'woocommerce_single_product_image_html', sprintf( '<a href="%s" itemprop="image" class="yith_magnifier_zoom woocommerce-main-image"><img src="%s" alt="Placeholder" /></a>', $placeholder, $placeholder ), $post->ID );
    }
    ?>

    <?php do_action( 'woocommerce_product_thumbnails' ); ?>

</div>
