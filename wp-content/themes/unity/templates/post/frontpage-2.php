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

<div class="front-page">
<div class="row">
<?php

	$i = 0;
	$main = $num_mainpost;

	while($loop->have_posts()){
		$loop->the_post();
 ?>
 		<?php if( $i<=$main-1) { ?>
 			<?php if( $i == 0 ) {  ?>
 				<div  class="col-sm-12 main-posts">
 			<?php } ?>
		 	<?php get_template_part( 'templates/post/_single' ) ?>

			<?php if( $i == $main-1 || $i == $end -1 ) { ?>
				</div>
			<?php } ?>
		<?php } else { ?>
				<?php if( $i == $main  ) { ?>
				<div class="col-sm-12 secondary-posts">
				<?php }  ?>
					<article class="post">
					    <figure class="entry-thumb">
					        <div class="entry-date">
					            <span><?php the_time( 'd' ); ?></span><?php the_time( 'M' ); ?>
					        </div>
					    </figure>
					    <h4 class="entry-title">
					        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
					    </h4>
					    <p class="entry-description"><?php echo wpo_excerpt(25,'...');; ?></p>
					</article>
				<?php if( $i == $end-1 ) {   ?>
					</div>
				<?php } ?>
			<?php } ?>
<?php  $i++; } ?>
</div>
</div>