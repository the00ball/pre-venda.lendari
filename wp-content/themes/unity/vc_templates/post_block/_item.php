<?php
$block = $block_data[0];
$settings = $block_data[1];
$link_setting = empty($settings[0]) ? '' : $settings[0];

?>
<?php if($block === 'title'): ?>
<h3 class="entry-title">
    <?php echo empty($link_setting) || $link_setting!='no_link' ? $this->getLinked($post, $post->title, $link_setting, 'link_title') : $post->title ?>
</h3>
<?php elseif($block === 'image' && !empty($post->thumbnail)): ?>
<div class="entry-thumb">
    <?php echo empty($link_setting) || $link_setting!='no_link' ? $this->getLinked($post, $post->thumbnail, $link_setting, 'link_image') : $post->thumbnail ?>
</div>
<?php elseif($block === 'text'): ?>
<?php if(isset($post->excerpt) && $post->excerpt): ?>
<div class="entry-content">
    <?php echo empty($link_setting) || $link_setting==='text' ?  $post->content : wp_trim_words( $post->content, 25); ?>
</div>
<?php endif; ?>
<?php elseif($block === 'link'): ?>
<p class="entry-link">
    <a  href="<?php echo esc_url( $post->link ) ?>" class="vc_read_more btn btn-outline"
        title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'unity' ), $post->title_attribute ) ); ?>"<?php echo trim( $this->link_target ); ?>><?php _e( 'Read more', 'unity' ) ?></a>
</p>
<?php endif; ?>