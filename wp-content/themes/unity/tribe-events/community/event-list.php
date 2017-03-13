<?php
/**
 * My Events List Template
 * The template for a list of a users events.
 *
 * Override this template in your own theme by creating a file at
 * [your-theme]/tribe-events/community/event-list.php
 *
 * @package TribeCommunityEvents
 * @since  2.1
 * @author Modern Tribe Inc.
 *
 */

if ( !defined('ABSPATH') ) { die('-1'); }

$icons = array(
	'publish' => 'checkmark',
	'draft'     => 'file',
	'pending'   => 'clock',
);

	// List "Add New" Button
	do_action( 'tribe_ce_before_event_list_top_buttons' ); ?>

	<div id="add-new"><a href="<?php echo esc_url( tribe_community_events_add_event_link() ); ?>" class="vamtam-button button button-border accent-2 hover-accent-2"><span class="btext"><?php echo apply_filters( 'tribe_ce_add_event_button_text', __( 'Add New','unity' ) ); ?></span></a></div>

	<div class="table-menu-wrapper">

		<?php if ( $events->have_posts() ) { ?>
		<a href="#" class="table-menu-btn vamtam-button button button-border accent-2 hover-accent-2"><span class="btext"><?php echo apply_filters( 'tribe_ce_event_list_display_button_text', __( 'Display', 'unity' ) ); ?></span></a><!-- table-menu-btn -->
		<?php } ?>

		<?php do_action( 'tribe_ce_after_event_list_top_buttons' ); ?>

		<div class="table-menu table-menu-hidden">
			<ul></ul>
		</div><!-- .table-menu -->

	</div><!-- .table-menu-wrapper -->


	<?php // list admin link
	$current_user = wp_get_current_user(); ?>
	<div id="not-user">
		<?php _e( 'Not','unity' ); ?>
		<i><?php echo esc_html( $current_user->display_name ); ?></i> ?
		<a href="<?php echo esc_url( tribe_community_events_logout_url() ); ?>">
			<?php _e( 'Log Out', 'unity' ); ?>
		</a>
	</div>

	<div style="clear:both"></div>

	<?php // list pagination
	if ( !$events->have_posts() ) {
		$this->enqueueOutputMessage( __( 'There are no upcoming events in your queue.', 'unity' ) );
	}
	echo tribe_community_events_get_messages();
	$tbody = '';
	echo trim( $this->pagination( $events, '', $this->paginationRange ) );

	do_action( 'tribe_ce_before_event_list_table' );
	if ( $events->have_posts() ) :
	?>

	<div class="my-events-table-wrapper">

		<table class="events-community my-events" cellspacing="0" cellpadding="4">
			<thead id="my-events-display-headers">
				<tr>
					<th class="essential persist"><?php _e( 'Status','unity' ); ?></th>
					<th class="essential persist"><?php _e( 'Title','unity' ); ?></th>
					<th class="essential"><?php _e( 'Organizer','unity' ); ?></th>
					<th class="essential"><?php _e( 'Venue','unity' ); ?></th>
					<th class="optional1"><?php _e( 'Category','unity' ); ?></th>
					<?php if(class_exists('TribeEventsPro'))
						echo '<th class="optional2">'. __( 'Recurring?','unity' ) .'</th>'; ?>
					<th class="essential"><?php _e( 'Start Date','unity' ); ?></th>
					<th class="essential"><?php _e( 'End Date','unity' ); ?></th>
				</tr>
			</thead><!-- #my-events-display-headers -->

			<tbody id="the-list"><tr>
				<?php $rewriteSlugSingular = TribeEvents::getOption( 'singleEventSlug', 'event' );
				global $post;
				$old_post = $post;
				while ( $events->have_posts() ) {
					$e = $events->next_post();
					$post = $e; ?>

					<tr>

						<td><?php
							if ( isset( $icons[$post->post_status] ) ) {
								echo wpv_shortcode_icon(
									array(
										'name' => $icons[$post->post_status],
										'size' => 16,
									)
								);
							} else {
								echo TribeCommunityEvents::instance()->getEventStatusIcon( $post->post_status );
							}
						?></td>
						<td>
						<?php
						$canEdit = current_user_can( 'edit_post', $post->ID );
						$canDelete = current_user_can( 'delete_post', $post->ID );
						if ( $canEdit ) { ?>
							<span class="title">
								<a href="<?php echo esc_url( tribe_community_events_edit_event_link( $post->ID ) ); ?>"><?php echo esc_html( $post->post_title ); ?></a>
							</span>
						<?php } else {
							echo esc_html( $post->post_title );
						} ?>
						<div class="row-actions">
							<span class="view">
								<a href="<?php echo esc_url( tribe_get_event_link( $post ) ); ?>"><?php _e( 'View','unity' ); ?></a>
							</span>
							<?php if ( $canEdit ) {
								echo TribeCommunityEvents::instance()->getEditButton( $post, 'Edit', '<span class="edit wp-admin events-cal"> |', '</span> ' );
							}
							if ( $canDelete ) {
								echo TribeCommunityEvents::instance()->getDeleteButton( $post );
							} ?>
						</div><!-- .row-actions -->
						</td>

						<td>
						<?php if ( tribe_has_organizer( $post->ID ) ) {
							$organizer_id = tribe_get_organizer_id( $post->ID );
							if ( current_user_can( 'edit_post', $organizer_id ) ) {
								echo '<a href="'. TribeCommunityEvents::instance()->getUrl( 'edit', $organizer_id, null, TribeEvents::ORGANIZER_POST_TYPE ) .'">'. tribe_get_organizer( $post->ID ) .'</a>';
							} else {
								echo tribe_get_organizer( $post->ID );
							}
						} ?>
						</td>

						<td>
						<?php if ( tribe_has_venue( $post->ID ) ) {
							$venue_id = tribe_get_venue_id( $post->ID );
							if ( current_user_can( 'edit_post', $venue_id ) ) {
								echo '<a href="' . TribeCommunityEvents::instance()->getUrl( 'edit', $venue_id, null, TribeEvents::VENUE_POST_TYPE ) . '">'. tribe_get_venue( $post->ID ) .'</a>';
							} else {
								echo tribe_get_venue( $post->ID );
							}
						} ?>
						</td>

						<td><?php echo TribeEventsAdminList::custom_columns( 'events-cats', $post->ID, false ); ?></td>

						<?php if ( function_exists('tribe_is_recurring_event') ) { ?>
							<td>
							<?php if ( tribe_is_recurring_event( $post->ID ) ) {
								_e('Yes','unity' );
							} else {
								_e('No','unity' );
							} ?>
							</td>
						<?php } ?>

						<td>
						<?php $start_date = strtotime( $post->EventStartDate );
						echo tribe_event_format_date( $start_date, false, TribeCommunityEvents::instance()->eventListDateFormat ); ?>
						</td>

						<td>
						<?php $end_date = strtotime( $post->EventEndDate );
						echo tribe_event_format_date( $end_date, false, TribeCommunityEvents::instance()->eventListDateFormat ); ?>
						</td>

					</tr>

				<?php } // end list loop
				$post = $old_post; ?>

			</tbody><!-- #the-list -->

			<?php do_action( 'tribe_ce_after_event_list_table' ); ?>

		</table><!-- .events-community -->

	</div><!-- .my-events-table-wrapper -->

	<?php // list pagination
	echo trim( $this->pagination( $events, '', $this->paginationRange ) );

	endif; // if ( $events->have_posts() )
