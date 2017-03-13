<?php
/*
*Template Name: Blog
*
*/
global $wpopconfig;
// Get Page Config
$wpopconfig = $wpoEngine->getPageConfig();

?>

<?php get_header( $wpoEngine->getHeaderLayout() );  ?>

<section id="wpo-mainbody" class=" wpo-mainbody blog-page">
    <?php if($wpopconfig['breadcrumb']){ ?>
        <div class="wrapper-breadcrumb">
            <?php wpo_breadcrumb( $wpopconfig['showtitle'] ); ?>
        </div>
    <?php } ?>
    <div class="wrapper-content">
        <div class="container">
            <div class="container-inner">
                <div class="row">
                    <!-- MAIN CONTENT -->
                    <?php get_sidebar( 'left' );  ?>
                    <div id="wpo-content" class="<?php echo esc_attr( $wpopconfig['main']['class'] ); ?> clearfix">
                        <?php get_template_part('contents-post');?>
                    </div>
                    <!-- //END MAINCONTENT -->
                    <?php get_sidebar( 'right' ); ?>
                </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>