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
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/support/forum.html
 */
class WPO_Featured_Video_Widget extends WPO_Widget {
    public function __construct() {
        parent::__construct(
            // Base ID of your widget
            'wpo_featured_video_widget',
            // Widget name will appear in UI
            __('WPO Featured Video Widget', 'unity'),
             // Widget description
            array( 'description' => __( 'Show Featured video', 'unity' ),)
        );
        $this->widgetName = 'video';
    }

    public function widget( $args, $instance ) {
        extract( $args );
        extract( $instance );
        $title 	= apply_filters('widget_title', esc_attr($instance['title']));		

        $embed_code = wp_oembed_get( $instance['video_link'], array( 'width'=> $instance['video_width'] ) );

        echo $before_widget;

        require($this->renderLayout( 'default'));

        echo $after_widget;
    }

    // Widget Backend
    public function form( $instance ) {
        $defaults = array(  'title' => 'Featured Video',
                            'video_link' => 'https://www.youtube.com/watch?v=Drei_jt2kos',
                            'video_name' => 'Opal video guide',
                            'video_width' =>  300
                        );

        $instance = wp_parse_args((array) $instance, $defaults);

        ?>
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php echo __('Title:', 'unity' ); ?></label>
            <br>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('title') ); ?>" name="<?php echo esc_attr( $this->get_field_name('title') ); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'video_link' ) ); ?>"><?php echo __('Video link:', 'unity' ); ?></label>
            <br>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('video_link') ); ?>" name="<?php echo esc_attr( $this->get_field_name('video_link') ); ?>" type="text" value="<?php echo esc_url( $instance['video_link'] ); ?>" />
            <br>
            <?php echo __('Support video from Youtube and Vimeo link. Ex: https://www.youtube.com/watch?v=Drei_jt2kos', 'unity' ); ?>
        </p>

        <p>
            <label for="<?php echo  esc_attr( $this->get_field_id('video_name') ); ?>"><?php echo __('Video name:', 'unity' ); ?></label>
            <br>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('video_name') ); ?>" name="<?php echo esc_attr( $this->get_field_name('video_name') ); ?>" type="text" value="<?php echo esc_attr( $instance['video_name'] ); ?>" />
        </p>

        <p>
            <label for="<?php echo esc_attr( $this->get_field_id('video_width') ); ?>"><?php echo __('Video width:', 'unity'); ?></label>
            <br>
            <input class="widefat" id="<?php echo esc_attr( $this->get_field_id('video_width') ); ?>" name="<?php echo esc_attr( $this->get_field_name('video_width') ); ?>" type="text" value="<?php echo esc_attr( $instance['video_width'] ); ?>" />
        </p>

<?php
    }

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;

        $instance['title'] = $new_instance['title'];
        $instance['video_link'] = $new_instance['video_link'];
        $instance['video_name'] = $new_instance['video_name'];
        $instance['video_width'] = $new_instance['video_width'];
        return $instance;

    }
}

register_widget( 'WPO_Featured_Video_Widget' );