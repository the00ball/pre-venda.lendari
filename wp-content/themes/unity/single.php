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

global $wpopconfig;
if(get_post_type() == 'tribe_events'){
    $wpopconfig = $wpoEngine->getEventConfig();
    $show_title = wpo_theme_options('gallery_show-title', true);

}else{
    $wpopconfig = $wpoEngine->getPostConfig();
    $show_title = wpo_theme_options('blog_show-title', true);
}

?>

<?php get_header( wpo_theme_options('headerlayout', '') );  ?>

<section id="wpo-mainbody" class=" wpo-mainbody single-page">
    <?php if( wpo_theme_options('blog_show-breadcrumb', true)){ ?>
        <div class="wrapper-breadcrumb">
            <?php wpo_breadcrumb( $show_title ); ?>
        </div>
    <?php } ?>
    <div class="wrapper-content">
        <div class="container">
            <div class="container-inner">
                <div class="row">
                <?php get_sidebar('left');?>
                    <!-- MAIN CONTENT -->
                    <div id="wpo-content" class="<?php echo esc_attr( $wpopconfig['main']['class'] ); ?>">
                        <?php if( get_post_type() && get_post_type() != 'post' ) :   ?>
                        <div class="post-<?php echo get_post_type(); ?>">
                             <?php get_template_part( 'templates/'.get_post_type().'/single' ); ?>  
                        </div>
                        <?php else : ?>
                        <div class="post-area single-blog">
                            <?php  while(have_posts()): the_post();?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                <div class="entry-thumb">
                                    <?php get_template_part( 'templates/content/content', get_post_format() ); ?> 
                                </div>    

                                <?php if(is_single() ) { ?>
                                    <div class="post-container">
                                        <header class="entry-header">  
                                            <div class="entry-name">
                                                <h2 class="entry-title"> <?php the_title(); ?> </h2>
                                            </div>
                                            
                                            <div class="entry-meta">
                                                <?php wpo_posted_on(); ?>
                                                <span class="meta-sep"> / </span>
                                                <?php if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) : ?>
                                                <span class="comments-link"><?php comments_popup_link( __( 'Leave a comment', 'unity' ), __( '1 Comment', 'unity' ), __( '% Comments', 'unity' ) ); ?></span>
                                               
                                                <?php endif; ?>

                                                <?php edit_post_link( __( 'Edit', 'unity' ), '<span class="edit-link">', '</span>' ); ?>
                                            </div><!-- .entry-meta -->
                                        </header><!-- .entry-header -->

                                        <div class="entry-content">
                                            <?php
                                                the_content( sprintf(__( 'Continue reading %s', 'unity' ),
                                                            the_title( '<span class="screen-reader-text">', '</span>', false )
                                                        ) );
                                                wp_link_pages( array(
                                                    'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'unity' ) . '</span>',
                                                    'after'       => '</div>',
                                                    'link_before' => '<span>',
                                                    'link_after'  => '</span>',
                                                ) );
                                            ?>
                                        </div><!-- .entry-content -->
                                        
                                     </div>
                                    <?php } ?>

                                <?php the_tags( '<footer class="entry-meta"><span class="tag-links"><span>Tags: </span>', ', ', '</span></footer>' ); ?>
                                <?php if( wpo_theme_options('show-share-post', true) ){ ?>
                                    <div class="post-share">
                                        <div class="row">
                                            <div class="col-sm-4">
                                                <h6><?php echo __( 'Share this Post!','unity' ); ?></h6>
                                            </div>
                                            <div class="col-sm-8">
                                                <?php wpo_share_box(); ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                                    <hr>
                                    <div class="author-about">
                                        <?php get_template_part('templates/author-bio'); ?>
                                    </div>
                                    <hr>
                                <?php comments_template(); ?>
                                <div> <?php if( wpo_theme_options('show-related-post', true) ){
                                        $relate_count = wpo_theme_options('blog-items-show', 4);

                                    wpo_related_post($relate_count, 'post', 'category');
                                } ?>
                                </div>
                            </article>    
                           <?php endwhile; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                    <!-- //MAIN CONTENT -->
                <?php get_sidebar( 'right' );  ?>
             </div>
            </div>
        </div>
    </div>
</section>

<?php get_footer(); ?>