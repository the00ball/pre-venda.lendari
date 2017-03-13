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
$config = array('type' => 'wpo_postconfig', 'format' =>'chat_content');
?>

<div class="entry-thumb alert alert-success">
	<?php echo wpo_format_chat_content( wpo_getcontent( $config) ); ?>
</div>
