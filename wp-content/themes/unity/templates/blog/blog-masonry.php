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
$postformat = get_post_format();
$icon = '';
switch ($postformat) {
    case 'link':
        $icon = 'fa-link';
        break;
    case 'gallery':
        $icon = 'fa-th-large';
        break;
    case 'audio':
        $icon = 'fa-music';
        break;
    case 'video':
        $icon = 'fa-film';
        break;
    case 'image':
        $icon = 'fa-picture-o';
        break;
    case 'chat':
        $icon = 'fa-weixin';
        break;
    case 'quote':
        $icon = 'fa-quote-left';
        break;
}

wp_enqueue_script( 'wpo_isotope_js', WPO_THEME_URI.'/js/isotope.pkgd.min.js', array( 'jquery' ) );
?>
<article id="post-<?php the_ID(); ?>" class="blog-masonry">
        <?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
           
        <?php endif; ?>
        <div class="post-container">
            <div class="blog-post-detail">
                <div class="entry-thumb">
					<?php 
						if(has_post_format($postformat)){
							get_template_part( 'templates/content/content', $postformat );
						}
					?>
                    <?php if(!empty($icon)){ ?>
                        <span class="icon-post fa <?php echo esc_attr( $icon ); ?>"></span>
                    <?php } ?>
				</div>
                <div class="entry-content">
                    <h2 class="entry-title">
                        <a href="<?php the_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                    </h2>

                    <div class="entry-description">
                        <?php echo wpo_excerpt(30); ?>
                    </div>

                    <div class="entry-meta hidden">
                        <span class="entry-date"><?php echo get_the_date(); ?></span>
                        <span class="meta-sep"> / </span>
                        <span class="comment-count">
                            <?php comments_popup_link(__(' 0 comment', 'unity'), __(' 1 comment', 'unity'), __(' % comments', 'unity')); ?>
                        </span>
                        <span class="meta-sep"> / </span>
                        <span class="author-link"><?php the_author_posts_link(); ?></span>
                        <?php if(is_tag()): ?>
                            <span class="meta-sep"> / </span>
                            <span class="tag-link"><?php the_tags('Tags: ',', '); ?></span>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
</article>

