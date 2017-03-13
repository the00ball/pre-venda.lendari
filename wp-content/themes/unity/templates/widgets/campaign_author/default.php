<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author     Opal  Team <opalwordpressl@gmail.com >
 * @copyright  Copyright (C) 2014 wpopal.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/support/forum.html
 */
 
$campaign = get_post( $campaign_id );
$author = get_user_by('id', $campaign->post_author);
global $wpdb; 
$user_id = $author->ID;

$campaigns = new ATCF_Campaign_Query( array(
	'author' => $user_id, 
	'post_status' => 'publish', 
	'posts_per_page' => -1,
	'post_type' => 'download'
) );

if ( !empty($title) )
	echo $before_title . esc_html( $title ) . $after_title;

?>
<div class="author-description">

	<div class="author-info">	
		<?php $avatar = get_avatar( $author->ID, 120 ) ?>
		<?php if ( strlen( $avatar ) ) : ?>
			<div class="author-avatar">
				<?php echo ( $avatar ); ?>
			</div>
		<?php endif ?>

		<div class="author-stats">
			<h6><?php echo esc_html( $author->nickname ); ?></h6>
			<p>	<?php printf( _n( '%d campaign', '%d campaigns', $campaigns->post_count, 'unity' ), $campaigns->post_count ) ?>
			</p>
		</div>
	</div>	
	<div class="clearfix"></div>
	<div class="desc">	
		<p class="author-bio"><?php echo trim( $author->description ) ?></p>

		<p class="author-profile-link center">
			<a href="<?php echo esc_url( get_author_posts_url($author->ID) ); ?>" class="button button-alt"><?php _e( 'Profile', 'unity' ) ?></a>
		</p>
	</div>	

</div>		
