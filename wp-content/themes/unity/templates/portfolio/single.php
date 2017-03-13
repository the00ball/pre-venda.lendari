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
			<?php if (has_post_thumbnail()) { ?>
				<a href="<?php the_permalink(); ?>" title="">
					<?php the_post_thumbnail('');?>
				</a>
				<?php }
			?>
		</div>
	
		<div class="entry-content no-border">
			<?php the_content(); ?>
			<?php wp_link_pages(); ?>
		</div>

	</div><!--  End .post-container -->

</article>