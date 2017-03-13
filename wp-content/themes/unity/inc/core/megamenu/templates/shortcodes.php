<div class="wpo-shortcodes">
	<ul class="wrapper clearfix">
		<?php foreach( $shortcodes as $key => $shortcode ){ ?>
		<li class="shortcode-col">
			<div class="wpo-shorcode-button btn btn-default" data-name="<?php echo esc_attr( $shortcode['name'] );?>">
				<?php if( isset($shortcode['icon']) &&  $shortcode['icon'] ){ ?>
					<div class="wpo-icon wpo-icon-<?php echo esc_attr( $shortcode['icon'] );?>"></div>
				<?php } ?>
				<div class="content">
					<h3 class="title"><?php echo esc_html( $shortcode['title'] ); ?></h3>
					<em><?php echo trim( $shortcode['desc'] ); ?></em>
				</div>
			</div>
		</li>
		<?php  } ?>
	</ul>
</div>
<script>
jQuery(".wpo-shortcodes").WPO_Shortcode();
</script>