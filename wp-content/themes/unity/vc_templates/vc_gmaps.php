<?php
$output = $title = $link = $size = $zoom = $type = $bubble = $el_class = '';
extract(shortcode_atts(array(
    'title' => '',
    'link' => '21.0173222,105.78405279999993',
    'size' => 300,
    'zoom' => 14,
    'type' => 'ROADMAP',
    'bubble' => '',
    'pancontrol'=>'',
    'zoomcontrol'=>'',
    'maptypecontrol'=>'',
    'streetscontrol'=>'',
    'el_class' => ''
), $atts));

wp_enqueue_script('base_gmap_api_js');
wp_enqueue_script('base_gmap_function_js');

$bubble = ($bubble!='' && $bubble!='0') ? 'false' : 'true';
$pancontrol = ($pancontrol!='' && $pancontrol!='0') ? 'false' : 'true';
$zoomcontrol = ($zoomcontrol!='' && $zoomcontrol!='0') ? 'false' : 'true';
$maptypecontrol = ($maptypecontrol!='' && $maptypecontrol!='0') ? 'false' : 'true';
$streetscontrol = ($streetscontrol!='' && $streetscontrol!='0') ? 'false' : 'true';
$_id = wpo_makeid();
?>

<div id="map_canvas_<?php echo esc_attr( $_id ); ?>" class="map_canvas" style="width:100%;height:<?php echo esc_attr( $size ); ?>px;"></div>
<script type="text/javascript">
	jQuery(document).ready(function($) {
		var stmapdefault = '<?php echo esc_js( $link ); ?>';
		var marker = {position:stmapdefault}
		jQuery('#map_canvas_<?php echo esc_js( $_id ); ?>').gmap({
			'scrollwheel':false,
			'zoom': <?php echo esc_js( $zoom );  ?>  ,
			'center': stmapdefault,
			'mapTypeId':google.maps.MapTypeId.<?php echo esc_js( $type ); ?>,
			
			<?php 
				switch (wpo_theme_options('skin', '')) {
					case 'default':
						$style = '[{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#ffcc00"},{"visibility":"on"}]}]';
						break;
					case 'brown':
						$style = '[{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#887060"},{"visibility":"on"}]}]';
						break;
					case 'blue' :
						$style = '[{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"color":"#444444"}]},{"featureType":"landscape","elementType":"all","stylers":[{"color":"#f2f2f2"}]},{"featureType":"poi","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"road","elementType":"all","stylers":[{"saturation":-100},{"lightness":45}]},{"featureType":"road.highway","elementType":"all","stylers":[{"visibility":"simplified"}]},{"featureType":"road.arterial","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"transit","elementType":"all","stylers":[{"visibility":"off"}]},{"featureType":"water","elementType":"all","stylers":[{"color":"#41A4DD"},{"visibility":"on"}]}]';	
						break;
					default:
						$style = '[{"featureType":"water","elementType":"geometry.fill","stylers":[{"color":"#d3d3d3"}]},{"featureType":"transit","stylers":[{"color":"#808080"},{"visibility":"off"}]},{"featureType":"road.highway","elementType":"geometry.stroke","stylers":[{"visibility":"on"},{"color":"#b3b3b3"}]},{"featureType":"road.highway","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.local","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#ffffff"},{"weight":1.8}]},{"featureType":"road.local","elementType":"geometry.stroke","stylers":[{"color":"#d7d7d7"}]},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#ebebeb"}]},{"featureType":"administrative","elementType":"geometry","stylers":[{"color":"#a7a7a7"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"road.arterial","elementType":"geometry.fill","stylers":[{"color":"#ffffff"}]},{"featureType":"landscape","elementType":"geometry.fill","stylers":[{"visibility":"on"},{"color":"#efefef"}]},{"featureType":"road","elementType":"labels.text.fill","stylers":[{"color":"#696969"}]},{"featureType":"administrative","elementType":"labels.text.fill","stylers":[{"visibility":"on"},{"color":"#737373"}]},{"featureType":"poi","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{"featureType":"poi","elementType":"labels","stylers":[{"visibility":"off"}]},{"featureType":"road.arterial","elementType":"geometry.stroke","stylers":[{"color":"#d6d6d6"}]},{"featureType":"road","elementType":"labels.icon","stylers":[{"visibility":"off"}]},{},{"featureType":"poi","elementType":"geometry.fill","stylers":[{"color":"#dadada"}]}]';
						break;
				}
			?>	
			'styles': <?php echo ( $style ); ?>,
			

			<?php if($bubble=='true'){ ?>
			'callback': function() {
				var self = this;
				self.addMarker(marker).click(function(){
					//self.openInfoWindow({'content': '$location'}, self.instance.markers[0]);
				});
			},
			<?php } ?>
			panControl: <?php echo esc_js( $pancontrol ); ?>
		});
	});
	// jQuery(window).resize(function(){
	// 	var stct = new google.maps.LatLng('{$latitude}','{$longitude}');
	// 	jQuery('#map_canvas').gmap('option', 'center', stct);
	// });
</script>