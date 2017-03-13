<?php
/**
 * $loop
 * $class_column
 *
 */

$_count =1;

$colums = '3';
$bscol = floor( 12/$colums );
$end = $loop->post_count;

?>

<div class="front-page list-layout">
<?php

	$i = 0;
	$main = $num_mainpost;

	while($loop->have_posts()){
		$loop->the_post();
 ?>
				<article class="post">
					<?php if ( has_post_thumbnail() ) { ?>
			            <figure class="entry-thumb pull-left">
			                <a href="<?php the_permalink(); ?>" title="" class="entry-image zoom-2">
			                    <?php the_post_thumbnail( );?>
			                </a>
			                <!-- vote    -->
            				<?php do_action('wpo_rating') ?>
			            </figure>
					<?php }?>

				    <div class="entry-content pull-left">
				    	<div class="entry-date-big">
							<p class="day"><?php the_time( 'd' ); ?></p>
							<p class="month"><?php the_time( 'M' ); ?></p>
						</div>
						<div class="entry-content-inner">
					    	<?php if (get_the_title()) { ?>
					            <h4 class="entry-title">
					                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					            </h4>
					        <?php } ?>

					        <?php if (has_excerpt()) { ?>
					           <p class="entry-description"><?php echo wpo_excerpt(25,'[...]'); ?></p>
					        <?php } ?>

						    <div class="clearfix">
						    	<div class="entry-meta">
						    		<div class="entry-create">
						    			<span class="entry-author"><?php the_author_link(); ?></span>
						    			<span class="meta-sep">|</span>
						    			<span class="entry-date"><?php the_time( 'M d, Y' ); ?></span>
					                	<span class="meta-sep">|</span>
					                	<span class="entry-comment"><?php comments_popup_link(' 0', ' 1', ''); ?></span>
						    		</div>
						    	</div>
						    </div>
					    </div>
				    </div>
				    <div class="clearfix"></div>
				</article>
<?php  $i++; } ?>
</div>