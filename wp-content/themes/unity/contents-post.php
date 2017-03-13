<?php
    
    global $wp_query, $wpopconfig;

if( !empty($wp_query)){
    if(is_category()){

        $style = wpo_theme_options('archive-style');
        $columns_count = (int)wpo_theme_options('archive-column', 4);
        $col = floor(12/$columns_count);
        $smcol = ($col > 4)? 6: $col;
        $class_column='col-lg-'.$col.' col-md-'.$col.' col-sm-'.$smcol;
        $post_per_page = get_option('posts_per_page');
    }elseif( is_page()) {

        $options = array(
            'blog_number' => 10,
            'blog_style' => '',
            'blog_columns' => 2,
        );

        //$wpopconfig     = apply_filter( 'wpo_posts_options', $wpopconfig );
        $wpopconfig     = array_merge( $options, $wpopconfig );       
        $style          = $wpopconfig['blog_style'] ;
        $post_per_page  = $wpopconfig['blog_number'];

        $col = floor(12/$wpopconfig['blog_columns']);

        $smcol = ($col > 4)? 6: $col;
        $class_column='col-lg-'.$col.' col-md-'.$col.' col-sm-'.$smcol;
        
        if(is_front_page())
            $paged = (get_query_var('page')) ? get_query_var('page') : 1;
        else
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

        $args = array(
            'post_type' => 'post',
            'paged' => $paged,
            'posts_per_page'=> $post_per_page
        );

        $wp_query = new WP_Query($args);
    }else{
        $style = '';
        $post_per_page = get_option('posts_per_page');
    }
}else
    get_template_part( 'templates/none' );
?>
<?php if ( have_posts() ) : ?>
<div class="post-area <?php echo ($style=='masonry')? 'row blog-masonry': ''; ?>" id="container">
<?php while ( have_posts() ) : the_post(); ?>
<?php if($style=='masonry'){ ?>
    <div class="<?php echo esc_attr( $class_column ); ?> isotope-item">
        <?php get_template_part( 'templates/blog/blog', $style); ?>
    </div>
<?php }else{ ?>
    <?php get_template_part( 'templates/blog/blog', $style); ?>
<?php } ?>
<?php endwhile; ?>
</div>
<?php wpo_pagination_nav( $post_per_page,$wp_query->found_posts,$wp_query->max_num_pages ); ?>
<?php else : ?>
<?php get_template_part( 'templates/none' ); ?>
<?php endif;