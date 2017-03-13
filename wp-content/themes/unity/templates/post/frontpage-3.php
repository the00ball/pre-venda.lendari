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
$sub = 2;
$_id = wpo_makeid();
?>
<div class="front-page front-page-slide-thumbnail front-page-slide-thumbnail-<?php echo esc_attr( $_id ); ?>">
	<div class="box-posts">
	<?php $i = 0; $main = $num_mainpost;
	while($loop->have_posts()){
		$loop->the_post();
 	?>
		<article class="post <?php echo ($i==0)?'active':''; ?> post-sort-<?php echo($_id .'-'. ($i+1)); ?>">
			<div class="left">
				<?php if ( has_post_thumbnail() ) { ?>
		            <figure class="entry-thumb pull-left">
		                <a href="<?php the_permalink(); ?>" title="" class="entry-image zoom-2">
		                    <?php the_post_thumbnail( );?>
		                </a>
		                <!-- vote -->
	    				<?php do_action('wpo_rating') ?>
		            </figure>
				<?php }?>
				<?php if (get_the_title()) { ?>
			            <h4 class="entry-title">
			                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
			            </h4>
			        <?php } ?>
			</div>	
		    <div class="entry-content right">
				<div class="entry-content-inner">
			        <?php if (has_excerpt()) { ?>
			           <div class="entry-description"><?php echo the_excerpt(); ?></div>
			        <?php } ?>
			    </div>
			    <div class="clearfix"></div>
			    <div class="readmore"><a href="<?php the_permalink(); ?>"><?php echo __('Read more', 'unity'); ?></a></div>
		    </div> 
		</article>
	<?php  $i++; } ?>
	</div>
	<div class="clearfix"></div>
	<div id="front-page-slide-thumbnail-<?php echo esc_attr( $_id ); ?>" class="thumnail-list carousel slide" data-ride="carousel" data-interval="false">
	 	<div class="carousel-controls">
            <a class="prev carousel-control" href="#front-page-slide-thumbnail-<?php echo esc_attr( $_id ); ?>" data-slide="prev">
                <i class="fa fa-chevron-left"></i>
            </a>
            <a class="next carousel-control" href="#front-page-slide-thumbnail-<?php echo esc_attr( $_id ); ?>" data-slide="next">
                <i class="fa fa-chevron-right"></i>
            </a>
        </div>
		<div class="carousel-inner">
			<?php $_k=1; while($loop->have_posts()): $loop->the_post(); ?>
				<?php if( $_k%4 == 1 ) echo '<div class="item'.(($_k==1)?" active":"").'">'; ?>
					<div class="col-xs-3 thumbnail-content <?php echo ($_k==1?'active':'')?>">
						<a class="filter-post" href="javascript:void(0);" data-post="<?php echo esc_attr( $_k ); ?>"><?php the_post_thumbnail('thumbnails-carousel'); ?></a>
						<span class="entry-title"><?php the_title(); ?></span>
					</div>
				<?php if( ($_k%4==0 && $_k!=1) || $_k==$end ) echo '</div>'; ?>	
		 	<?php $_k++; endwhile; ?>
	 	</div>
	</div>
</div>
<script type="text/javascript">
	(function ($) {
		"use strict";
		var $modul = $('.front-page-slide-thumbnail-<?php echo esc_js( $_id );?>');
		$modul.find('a.filter-post').each(function(){
			$(this).click(function(){
				$modul.find('.box-posts').find('.post').removeClass('active');
				$modul.find('.box-posts').find('.post-sort-<?php echo esc_js( $_id ); ?>-'+$(this).data('post')).addClass('active', 1000, 'easeOutBounce');
				$modul.find('.thumbnail-content').removeClass('active');
				$(this).parent().addClass('active');
			})
		})
		var $thumbnails = $('#front-page-slide-thumbnail-<?php echo esc_js( $_id );?>');
		$thumbnails.on('slide.bs.carousel', function () {
		  $thumbnails.find('.carousel-inner').addClass('overflow-hidden');
		})
		$thumbnails.on('slid.bs.carousel', function () {
		  $thumbnails.find('.carousel-inner').removeClass('overflow-hidden');
		})
	})(jQuery)
</script>