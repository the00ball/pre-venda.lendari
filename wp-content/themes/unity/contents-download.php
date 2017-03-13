<?php
    
    global $gallery, $wpopconfig, $column;

    if(is_front_page()) {
        $paged = (get_query_var('page')) ? get_query_var('page') : 1;
    } else {
        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
    }


    $column = wpo_theme_options('campaign-archive-column', 3);
    $style = wpo_theme_options('campaign-archive-style', 'style-1');
    $post_per_page = (int)wpo_theme_options('campaign-archive-items', 9);

    $args = array(
        'post_type' => 'download',
        'paged' => $paged,
        'posts_per_page'=>$post_per_page
    );

    $downloads = new WP_Query($args);

    $col = floor(12/$column);
    $smcol = ($col > 4)? 6: $col;
    $class_column='col-lg-'.$col.' col-md-'.$col.' col-sm-'.$smcol;
    $count = 0;

    //echo '<pre>'.print_r( $downloads, 1).'</pre>';

if ( $downloads->have_posts() ) :
    while( $downloads->have_posts() ) : $downloads->the_post();
        echo ($count % $column == 0)? '<div class="row">':'';
            echo '<div class="'.esc_attr( $class_column ).'">';
                get_template_part( 'templates/campaign/campaign', $style );
            echo '</div>';
        echo ( $count % $column == $column-1 || $count== ($downloads->post_count)-1 )? '</div>': '';
        $count++;
     endwhile;
    wpo_pagination_nav( $post_per_page, $downloads->found_posts, $downloads->max_num_pages );
else :
    get_template_part( 'templates/none' );
endif;
