<?php 
	$pos = wpo_theme_options('sidebar_position') == 'left'?'sidebar-left':'side-right';
?>
<?php if( is_active_sidebar($pos) ): ?>
<div class="col-lg-3 col-md-3 col-sm-3">
	<div class="wpo-sidebar wpo-sidebar-right">
		<div class="sidebar-inner">
			<?php dynamic_sidebar( $pos ); ?>
		</div>
	</div>
</div>
<?php endif; ?>
