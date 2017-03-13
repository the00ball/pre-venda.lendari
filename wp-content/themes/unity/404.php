<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     Opal  Team <opalwordpressl@gmail.com >
 * @copyright  Copyright (C) 2014 wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http:/wpopal.com
 * @support  http://wpopal.com
 */

/*
*Template Name: 404 Page
*/

?>

<?php get_header( $wpoEngine->getHeaderLayout() ); ?>

<section class="wpo-mainbody clearfix 404-page">
	<section class="container">
		<div class="page_not_found text-center clearfix">
			<div class="col-sm-12">
				<img src="<?php echo (get_template_directory_uri() . '/images/404.png') ?>" alt="<?php echo _e('404 page !', 'unity') ?>"/>
				<div class="clearfix"></div>
				<div class="error-title"><?php _e('This page couLd not be found on the server.', 'unity') ?> </div>
				<div class="page-preview"><a href="javascript: history.go(-1)"><?php _e('Go back to previous page', 'unity'); ?></a></div>
				<div class="back-home"><a class="btn btn-outline-inverse" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php _e('Return to homepage', 'unity'); ?></a></div>
			</div>
		</div>
	</section>
</section>

<?php get_footer(); ?>