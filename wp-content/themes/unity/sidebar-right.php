<?php  
global $wpopconfig;  
$sidebar_right = empty($wpopconfig['right-sidebar']) ?wpo_theme_options('right-sidebar'): $wpopconfig['right-sidebar']['widget'];
?>

<?php if($wpopconfig['right-sidebar']['show']){ ?>
	<div class="<?php echo esc_attr( $wpopconfig['right-sidebar']['class'] ); ?>">
	<?php if( is_active_sidebar( $sidebar_right) ): ?>
		<div class="wpo-sidebar wpo-sidebar-right">
			<div class="sidebar-inner">
				<?php dynamic_sidebar( $sidebar_right ); ?>
			</div>
		</div>
	<?php endif; ?>
	</div>
<?php } ?>