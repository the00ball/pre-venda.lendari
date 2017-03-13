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
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-container">
		<div class="entry-thumb">
			<?php
				if ( has_post_format( 'video' )) {
				?>
					<div class="video-responsive">
						<?php wpo_embed(); ?>
					</div>
				<?php
				}
				else if ( has_post_format( 'audio' )) {
				?>
					<div class="audio-thumb audio-responsive">
						<?php wpo_embed(); ?>
					</div>
				<?php
				}
				else if ( has_post_format( 'gallery' )) {
					$_imgs = wpo_gallery();
					$galleries = array();
					foreach( $_imgs as $val){
						if( $val ) $galleries[] = $val;
					}
				?>
					<?php if(count($galleries) > 1) { ?>
							<div id="post-slide-<?php the_ID(); ?>" class="carousel slide" data-ride="carousel">
								<div class="carousel-inner">
									<?php foreach ($galleries as $key => $_img) {
										echo '<div class="item '.(($key==0)?'active':'').'">';
											echo '<img src="'.$_img.'" alt="">';
										echo '</div>';
									} ?>
								</div>
								<a class="left carousel-control" href="#post-slide-<?php the_ID(); ?>" data-slide="prev">
									<span class="fa fa-angle-left"></span>
								</a>
								<a class="right carousel-control" href="#post-slide-<?php the_ID(); ?>" data-slide="next">
									<span class="fa fa-angle-right"></span>
								</a>
							</div>
						<?php } elseif (count($galleries) == 1){ ?>
									<?php foreach ($galleries as $key => $_img) {
										echo '<div class="item '.(($key==0)?'active':'').'">';
											echo '<img src="'.$_img.'" alt="">';
										echo '</div>';
									} ?>
						<?php } ?>
				<?php
				}
				else if (has_post_thumbnail()) {
				?>
				<a href="<?php the_permalink(); ?>" title="">
					<?php the_post_thumbnail('');?>
				</a>
				<?php }
			?>
		</div>
		<div class="entry-name">
			<?php if(wpo_theme_options('post-title')){ ?>
			<h2 class="entry-title">
				<?php the_title(); ?>
			</h2>
			<?php } ?>
			<p class="entry-meta">
				<span class="entry-date"><?php the_time( 'M d, Y' ); ?></span>
				<span class="meta-sep"> / </span>
				<span class="comment-count">
					<?php comments_popup_link(__(' 0 comment', 'unity'), __(' 1 comment', 'unity'), __(' % comments', 'unity')); ?>
				</span>
				<span class="meta-sep"> / </span>
				<span class="entry-author"><?php the_author_posts_link(); ?></span>
				<?php if(is_tag()): ?>
				<span class="meta-sep"> / </span>
				<span class="tag-link"><?php the_tags('Tags: ',', '); ?></span>
				<?php endif; ?>
			</p>
		</div>
		<div class="entry-content no-border">
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div>

		<div class="post-share">
			<div class="row">
				<div class="col-sm-4">
					<h4><?php echo __( 'Share this Post!','unity' ); ?></h4>
				</div>
				<div class="col-sm-8">
					<?php wpo_share_box(); ?>
				</div>
			</div>
		</div>

		<div class="author-about">
			<?php get_template_part('templates/author-bio'); ?>
		</div>

		<?php comments_template(); ?>

		<!-- Related Posts -->

		<?php if ( wpo_theme_options( 'show_related') ) : ?>
			<div class="wpo-related-post">
				<?php
					$post_number = wpo_theme_options( 'limit-post', 4);
					//$post_number = 4;
					wpo_related_post( $post_number, 'post', 'category'); ?>
			</div>
		<?php endif; ?>

	</div><!--  End .post-container -->

</article>