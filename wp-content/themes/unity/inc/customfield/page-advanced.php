<?php
/* $Desc
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

    //$object = new WPO_Template();

?>
<div id="wpo-templates">
    <p class="wpo_section">
        <?php $mb->the_field('count'); ?>
        <label for="pf_number">Pages show at most:</label>
        <input type="text" name="<?php $mb->the_name(); ?>" id="pf_number" value="<?php $mb->the_value(); ?>" />
    </p>

    <p class="wpo_section">
        <?php $mb->the_field('el_class'); ?>
        <label for="pf_number">Extra class name:</label>
        <input type="text" name="<?php $mb->the_name(); ?>" id="pf_number" value="<?php $mb->the_value(); ?>" />
    </p>

    <p class="wpo_section">
        <?php $mb->the_field('blog_layout'); ?>
        <label for="pf_number">Blog Layout:</label>
        <select  name="<?php $mb->the_name(); ?>">
            <option value="default" <?php $mb->the_select_state('default'); ?>><?php echo __('Blog Default','unity'); ?></option>
            <option value="masonry" <?php $mb->the_select_state('masonry'); ?>><?php echo __('Blog Masonry','unity'); ?></option>
            <option value="list" <?php $mb->the_select_state('list'); ?>><?php echo __('Blog List','unity'); ?></option>
        </select>
    </p>

    <p class="wpo_section">
        <?php $mb->the_field('header_skin'); ?>
        <label for="pf_number">Header Skin:</label>
        <select  name="<?php $mb->the_name(); ?>">
	    	<option value="1" <?php $mb->the_select_state('1'); ?>><?php echo __('Use Global','unity'); ?></option>
	    	<option value="2" <?php $mb->the_select_state('2'); ?>><?php echo __('Skin 1','unity'); ?></option>
	    	<option value="3" <?php $mb->the_select_state('3'); ?>><?php echo __('Skin 2','unity'); ?></option>
	    </select>
    </p>

    <p class="wpo_section">
        <?php $mb->the_field('footer_skin'); ?>
        <label for="pf_number">Footer Skin:</label>
        <select  name="<?php $mb->the_name(); ?>">
            <option value="1" <?php $mb->the_select_state('1'); ?>><?php echo __('Use Global','unity'); ?></option>
            <option value="2" <?php $mb->the_select_state('2'); ?>><?php echo __('Skin 1','unity'); ?></option>
            <option value="3" <?php $mb->the_select_state('3'); ?>><?php echo __('Skin 2','unity'); ?></option>
        </select>
    </p>
</div>