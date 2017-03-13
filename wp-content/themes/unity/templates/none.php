<section class="cat-top  page-found clearfix">
	<header class="header-title">
		<h6 class="page-title"><?php echo __( 'Nothing Found', 'unity' ); ?></h6>
	</header><!-- /header -->
</section>
<article class="wrapper">
	<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

	<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'unity' ), admin_url( 'post-new.php' ) ); ?></p>

	<?php elseif ( is_search() ) : ?>

	<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'unity' ); ?></p>
	<?php get_search_form(); ?>

	<?php else : ?>

	<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'unity' ); ?></p>
	<?php get_search_form(); ?>

	<?php endif; ?>
</article>