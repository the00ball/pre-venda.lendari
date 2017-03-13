<?php
/**
 * Single Product Image
 *
 * @author 		YIThemes
 * @package 	YITH_Magnifier/Templates
 * @version     1.1.2
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


$skin = 'fashion';

$enable_slider = get_option('yith_wcmg_enableslider') == 'yes' ? true : false;

wc_get_template_part( 'skin/'.$skin.'/product', 'image-magnifier' );
?>
   
<script type="text/javascript" charset="utf-8">
    var yith_magnifier_options = {
        enableSlider: <?php echo $enable_slider ? 'true' : 'false' ?>,

        <?php if( $enable_slider ): ?>
        sliderOptions: {
            responsive: <?php echo get_option('yith_wcmg_slider_responsive') == 'yes' ? 'true' : 'false' ?>,
            circular: <?php echo get_option('yith_wcmg_slider_circular') == 'yes' ? 'true' : 'false' ?>,
            infinite: <?php echo get_option('yith_wcmg_slider_infinite') == 'yes' ? 'true' : 'false' ?>,
            direction: 'left',
            debug: false,
            auto: false,
            align: 'left',
            prev	: {
                button	: "#slider-prev",
                key		: "left"
            },
            next	: {
                button	: "#slider-next",
                key		: "right"
            },
            //width   : <?php echo yit_shop_single_w() + 18 ?>,
            scroll : {
                items     : 1,
                pauseOnHover: true
            },
            items   : {
                //width: <?php echo yit_shop_thumbnail_w() + 4 ?>,
                visible: <?php echo apply_filters( 'woocommerce_product_thumbnails_columns', get_option( 'yith_wcmg_slider_items', 3 ) ) ?>
            }
        },

        <?php endif ?>

        showTitle: false,
        zoomWidth: '<?php echo get_option('yith_wcmg_zoom_width') ?>',
        zoomHeight: '<?php echo get_option('yith_wcmg_zoom_height') ?>',
        position: '<?php echo get_option('yith_wcmg_zoom_position') ?>',
        //tint: <?php //echo get_option('yith_wcmg_tint') == '' ? 'false' : "'".get_option('yith_wcmg_tint')."'" ?>,
        //tintOpacity: <?php //echo get_option('yith_wcmg_tint_opacity') ?>,
        lensOpacity: <?php echo get_option('yith_wcmg_lens_opacity') ?>,
        softFocus: <?php echo get_option('yith_wcmg_softfocus') == 'yes' ? 'true' : 'false' ?>,
        //smoothMove: <?php //echo get_option('yith_wcmg_smooth') ?>,
        adjustY: 0,
        disableRightClick: false,
        phoneBehavior: '<?php echo get_option('yith_wcmg_zoom_mobile_position') ?>',
        loadingLabel: '<?php echo stripslashes(get_option('yith_wcmg_loading_label')) ?>'
    };
</script>
