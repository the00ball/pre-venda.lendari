<?php 
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     Opal  Team <opalwordpressl@gmail.com >
 * @copyright  Copyright (C) 2014 wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/support/forum.html
 */

class Wpo_Crowdfunding_Author_Widget extends WPO_Widget {

	public function __construct() {
		parent::__construct(
			// Base ID of your widget
			'campaign_author', 
			// Widget name will appear in UI
			__( 'WPO Campaign Author', 'unity'),
			// Widget description 
			array( 'description' => __( 'Display the campaign creator\'s details.', 'unity' ) )
		);
		$this->widgetName = 'campaign_author';
	}

	public function widget( $args, $instance ) {

		extract( $args );		

		if ( !isset( $instance['campaign_id'] ) || $instance['campaign_id'] == '' )
			return;

		$title = apply_filters( 'widget_title', $instance['title'] );
		$campaign_id = $instance['campaign_id'] == 'current' ? get_the_ID() : $instance['campaign_id'];
		
		echo $before_widget;
		require($this->renderLayout());
		echo $after_widget;

	}

	public function form( $instance ) {
		$instance = wp_parse_args((array) $instance, array( 'title' => '', 'campaign_id' => '' ));
		$campaigns = new ATCF_Campaign_Query();
        $title = $instance['title'];
        $campaign_id = $instance['campaign_id'];
       ?>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('title') ); ?>"><?php _e('Title:', 'unity') ?>
                <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr($title); ?>" />
            </label>
        </p> 

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('campaign_id') ); ?>"><?php _e('Campaign:', 'unity') ?>        
            	<select name="<?php echo esc_attr( $this->get_field_name('campaign_id') ) ?>">
            		<option value="current"><?php _e( 'Campaign currently viewed', 'unity' ) ?></option>
            		<optgroup label="<?php _e( 'Specific campaigns', 'unity' ) ?>">
	            		<?php foreach ( $campaigns->posts as $campaign ) : ?>
	            			<option value="<?php echo esc_attr( $campaign->ID ); ?>" <?php selected( $campaign->ID, $campaign_id ) ?>><?php echo esc_html( $campaign->post_title ) ?></option>
	            		<?php endforeach ?>
            		</optgroup>
            	</select>    
            </label>      
        </p>

        <?php
	}

	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['campaign_id'] = $new_instance['campaign_id'];        
        return $instance;
	}
}

register_widget( 'Wpo_Crowdfunding_Author_Widget' );