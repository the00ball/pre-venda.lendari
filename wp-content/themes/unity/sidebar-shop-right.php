<?php  
global $wpopconfig;
if( is_product()){
	$sidebar_right = wpo_theme_options('woocommerce-single-right-sidebar', 'sidebar-right');
}else
	$sidebar_right = wpo_theme_options('woocommerce-archive-right-sidebar', 'sidebar-right');
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
