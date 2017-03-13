<?php 
global $wpopconfig;
$sidebar_left = empty($wpopconfig['left-sidebar']) ?wpo_theme_options('left-sidebar'): $wpopconfig['left-sidebar']['widget'];  
?> 
<?php if($wpopconfig['left-sidebar']['show']){ ?>
	<div class="<?php echo esc_attr( $wpopconfig['left-sidebar']['class'] ); ?>">
	<?php if( is_active_sidebar( $sidebar_left) ): ?>
		<div class="wpo-sidebar wpo-sidebar-left">
			<div class="sidebar-inner">
				<?php dynamic_sidebar( $sidebar_left ); ?>
			</div>
		</div>
	<?php endif; ?>
	</div>
<?php } ?>
 