<?php
/**
 * Single Event Meta (Organizer) Template
 *
 * Override this template in your own theme by creating a file at:
 * [your-theme]/tribe-events/modules/meta/details.php
 *
 * @package TribeEventsCalendar
 */

$organizer_ids = tribe_get_organizer_ids();
$multiple = count( $organizer_ids ) > 1;

$phone = tribe_get_organizer_phone();
$email = tribe_get_organizer_email();
$website = tribe_get_organizer_website_link();
?>

<div class="tribe-events-meta-group tribe-events-meta-group-organizer">
	<h3 class="tribe-events-single-section-title"><?php echo tribe_get_organizer_label( ! $multiple ); ?></h3>
	<dl>
	<?php
		do_action( 'tribe_events_single_meta_organizer_section_start' );

		foreach ( $organizer_ids as $organizer ) {
			if ( ! $organizer ) {
				continue;
			}

	?>
			<dd class="fn org">
				<?php echo tribe_get_organizer( $organizer ) ?>
			</dd>
		<?php } ?>
		<div class="clearfix"></div>
		<?php if ( ! $multiple ) { ?>
			<?php if ( ! empty( $phone ) ): ?>
						<?php esc_html_e( 'Phone:', 'unity' ) ?>
				<dd class="tel"> <?php echo esc_html( $phone ); ?> </dd>
				<div class="clearfix"></div>
			<?php endif ?>

			<?php if ( ! empty( $email ) ): ?>
						<?php esc_html_e( 'Email:', 'unity' ) ?>
				<dd class="email"> <?php echo esc_html( $email ); ?> </dd>
				<div class="clearfix"></div>
			<?php endif ?>

			<?php if ( ! empty( $website ) ): ?>
						<?php esc_html_e( 'Website:', 'unity' ) ?>
				<dd class="url"> <a href="<?php echo esc_html( $website ); ?>"><?php echo trim($website);?></a> </dd>
				<div class="clearfix"></div>
			<?php endif ?>
	<?php }//end if ?>

		<?php do_action( 'tribe_events_single_meta_organizer_section_end' ) ?>
	</dl>
</div>