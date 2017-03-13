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


$config = array('type' => 'wpo_postconfig', 'format' =>'video_link');

?>
<?php if( wpo_embed( $config) ){ ?>
	<div class="entry-thumb post-type-video">
		<div class="video-thumb video-responsive">
			<?php echo wpo_embed( $config); ?>
		</div>
	</div>
<?php } ?>
