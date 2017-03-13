<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="post-container">	
	<?php
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
		<?php }else{ ?>
		<div class="entry-thumb">
			<?php if (has_post_thumbnail()) { ?>
				<a href="<?php the_permalink(); ?>" title="">
					<?php the_post_thumbnail('');?>
				</a>
				<?php }
			?>
		</div>
		<?php } ?>
		
		<div class="entry-name">
            <h2 class="entry-title"> <?php the_title(); ?> </h2>
        </div> 

		<div class="post-meta">	
			<span class="post-date">
				<i class="fa fa-clock-o "></i>
				<?php the_time( 'H:m  d/M/Y' ); ?>
				&nbsp;&nbsp;
			</span>
			<span class="post-comment">
				<i class="fa fa-comments"></i>
				<?php comments_popup_link(__(' 0 comment', 'unity'), __(' 1 comment', 'unity'), __(' % comments', 'unity')); ?>
			</span>
		</div>

		<div class="entry-content no-border">
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div>
		
		<hr>
	        <div class="author-about">
	            <?php get_template_part('templates/author-bio'); ?>
	        </div>
        <hr>

	</div>
</article>