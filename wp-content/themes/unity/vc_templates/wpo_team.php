<?php
/*extract( shortcode_atts( array(
	'title'=>'',
	'photo'=> '',
	'job'	=> '',
	'phone'=>'4',
	'information' => '',
	'google' => '',
	'twitter' => '',
	'linkedin'=>'',
	'facebook' => '',
	'pinterest'=> '',
	'style'		=> '',
), $atts ) );
*/

$atts = ( vc_map_get_attributes(  str_replace('.php','',basename(__FILE__)) , $atts ) );
extract( $atts );

?>
<div class="panel panel-default wpo-our-team text-center">
	<?php $img = wp_get_attachment_image_src($photo,'full'); ?>
	<?php if( isset($img[0]) )  { ?>
	<div class="panel-body team-member-image no-padding zoom-2">
		<img class="img-responsive" src="<?php echo esc_url( $img[0] );?>" alt="<?php echo esc_attr( $title ); ?>"  />
	</div>
	<?php } ?>
	<div class="panel-footer team-member-body">
		<div class="team-member-body-content">
			<div class="team-member-content-inner">
				<h3 class="team-member-name"><span><?php echo esc_html( $title ); ?></span></h3>
			    <h5 class="team-member-position text-muted"><?php echo esc_html($job); ?></h5>
			    <p class="team-member-info">
				    <?php echo trim( $information ); ?>
			    </p>
			</div>
		</div>
		<ul class="team-member-social list-inline">
			<?php if( $facebook ){  ?>
			<li><a class="fa fa-facebook" href="<?php echo esc_url( $facebook ); ?>"> </a></li>
				<?php } ?>
			<?php if( $twitter ){  ?>
			<li><a class="fa fa-twitter" href="<?php echo esc_url( $twitter ); ?>"> </a></li>
			<?php } ?>
			<?php if( $pinterest ){  ?>
			<li><a class="fa fa-pinterest" href="<?php echo esc_url( $pinterest ); ?>"> </a></li>
			<?php } ?>
			<?php if( $linkedin ){  ?>
			<li><a class="fa fa-linkedin" href="<?php echo esc_url( $linkedin ); ?>"> </a></li>
			<?php } ?>
			<?php if( $google ){  ?>
			<li><a class="fa fa-google" href="<?php echo esc_url( $google ); ?>"> </a></li>
			<?php } ?>
			
			<?php if( $linkedin ){  ?>
			<li><a class="fa fa-linkedin" href="<?php echo esc_url( $linkedin ); ?>"> </a></li>
			<?php } ?>
			
		</ul>
	</div>
</div>