<?php 
global $wp_registered_sidebars;
 
    $meta_tabs = array(
        array(
            'id'    => 'wpo-config',
            'icon'  => 'fa-wrench',
            'title' => 'General'
        ),
        array(
            'id'    => 'option',
            'icon'  => 'fa-cogs',
            'title' => 'Post Option'
        )
    );

?>
<!--Genaral config -->
<div id="wpo-post" class="wpo-metabox">
    <!-- Nav tabs -->
    <?php $mb->getTabsConfig($meta_tabs); ?>

    <!--Genaral config -->
    <div class="wpo-meta-content active" id="wpo-config">

        <!--show title config -->
            <p class="wpo_section config_layout">
            <?php 
                $_enabal_config = array('id'=>'config_layout','title'=>'Enabal config layout', 'default'=>'no');
                $mb->getCheckboxElement( $_enabal_config ); ?>
            </p>

        <!--Select page layout-->
        <div class="wpo_section config_layout enabal-config">
        <?php
            $layout = array('id' => 'page_layout', 'title' => 'Select page layout', 'default' => '0-1-1');
            $mb->selectLayout($layout);
        ?>
        </div>

       <div style="clear:both;"></div>
        <!--Select left sidebar-->
        <p class="wpo_section left-sidebar config_layout enabal-config">
            <?php $mb->the_field('left_sidebar'); ?>
        <?php 
            $left_sidebars = array('id'=> 'left_sidebar','title'=>'Left Sidebar','data'=>$wp_registered_sidebars,'default'=>'sidebar-default');
            $mb->getSelectElement($left_sidebars);
        ?>
        </p>
        <!--Select right sidebar-->
        <p class="wpo_section right-sidebar config_layout enabal-config" style="display: none;">
    <?php 
        $right_sidebars = array('id'=> 'right_sidebar','title'=> 'Right Sidebar','data'=>$wp_registered_sidebars,'default'=>'sidebar-default');
        $mb->getSelectElement($right_sidebars); 
    ?>
        </p>
    </div>

    <!--Post Option-->
    <div class="wpo-meta-content" id="option">

    <!--Show format post-->

        <!--Select audio post-->
        <p class="wpo_section postformat wpo-postformat-audio" style="display: none;">
        <?php
            $url_audio = 'https://soundcloud.com/';
            $audio_link = array(
                'id'    => 'audio_link',
                'title' => 'Audio link',
                'des'   => '(Support <a href="'.esc_url( $url_audio ).'" target="_bank" >Soundcloud</a> audio)',
                'default' => ''
            );
            $mb->addTextElement( $audio_link );
        ?>
            
        </p>
        <div class="wpo_embed_view postformat wpo-postformat-audio">
            <span class="spinner" style="float:none;"></span>
            <div class="result"></div>
        </div>

        <!--End config audio post-->

        <!--Select video post-->
        <p class="wpo_section postformat wpo-postformat-video" style="display: none;">
        <?php
            $url_youtube = 'https://www.youtube.com/';
            $url_vimeo = 'http://vimeo.com/';
            $video_link = array(
                'id'    => 'video_link',
                'title' => 'Video link',
                'des'   => '(Support <a href="'.esc_url($url_youtube).'" target="_bank" >Youtube</a> and <a href="'.esc_url($url_vimeo).'" target="_bank">Vimeo</a> video)',
                'default' => ''
            );
            $mb->addTextElement( $video_link );
        ?>
        </p>
        <div class="wpo_embed_view postformat wpo-postformat-video">
            <span class="spinner" style="float:none;"></span>
            <div class="result"></div>
        </div>

        <!--Select gallery post-->
        <p class="wpo_section postformat wpo-postformat-gallery" style="display: none;">
            <?php $mb->addGalleryElement(); ?>
        </p>

        <!--Select link post-->
        <p class="wpo_section postformat wpo-postformat-link" style="display: none;">
            <?php
                $link_url = array('id'=>'link_url','title'=>'Link URL','des'=>'', 'default'=>'');
                $mb->addTextElement( $link_url );
            ?>
            <br/>
            <?php
                $link_title = array('id'=>'link_title','title'=>'Link title','des'=>'', 'default'=>'');
                $mb->addTextElement( $link_title );
            ?>
        </p>

        <!--Select chat post-->
        <p class="wpo_section postformat wpo-postformat-chat" style="display: none;">
            <?php
                $chat_content = array('id'=>'chat_content','title'=>'Chat content', 'default'=>'');
                $mb->addTextareaElement( $chat_content );
            ?>
        </p>

        <!--Select quote post-->
        <p class="wpo_section postformat wpo-postformat-quote" style="display: none;">
            <?php
                $quote_content = array('id'=>'quote_content','title'=>'Quote content', 'default'=>'');
                $mb->addTextareaElement( $quote_content );
            ?>
            <br/>
            <?php
                $quote_author = array('id'=>'quote_author','title'=>'Quote author', 'des' => '', 'default'=>'');
                $mb->addTextElement( $quote_author );
            ?>
        </p>

    </div>

</div>
