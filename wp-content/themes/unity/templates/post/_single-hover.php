<?php  $thumbsize = isset($thumbsize)? $thumbsize : 'postthumb-grid'; ?>
<article class="post">
    <figure class="entry-thumb">
        <a href="<?php the_permalink(); ?>" title="" class="entry-image zoom-2">
            <?php the_post_thumbnail( $thumbsize  );?>
        </a>
        <!-- vote    -->
        <?php do_action('wpo_rating') ?>

        <div class="entry-overlap hidden">
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
			<h4 class="entry-title">
		        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		    </h4>
		    <p class="entry-description"><?php echo wpo_excerpt(25,'...');; ?></p>
		</div>
    </figure>

</article>