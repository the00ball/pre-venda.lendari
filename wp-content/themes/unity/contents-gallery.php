<?php
    
    if(is_front_page()) {
        $paged = (get_query_var('page')) ? get_query_var('page') : 1;
    } else {
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    }

    $column = (int)wpo_theme_options('gallery-items-show', 3);
    $post_per_page = (int)wpo_theme_options('gallery-archive-items', 9);

    $args = array(
        'post_type' => 'gallery',
        'paged' => $paged,
        'posts_per_page'=>$post_per_page
    );

    $gallerys = new WP_Query($args);

    $col = floor(12/$column);
    $smcol = ($col > 4)? 6: $col;
    $class_column='col-lg-'.$col.' col-md-'.$col.' col-sm-'.$smcol;

if ( $gallerys->have_posts() ) :
    while( $gallerys->have_posts() ) : $gallerys->the_post();
        echo '<div class="'.esc_attr( $class_column ).'">';
            get_template_part( 'templates/gallery/item' );               
        echo '</div>';
     endwhile;
    wpo_pagination_nav( $post_per_page, $gallerys->found_posts, $gallerys->max_num_pages );
else :
    get_template_part( 'templates/none' );
endif;
