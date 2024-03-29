<?php
$is_enabled = alloggio_core_get_post_value_through_levels( 'qodef_room_single_enable_ads' ) === 'yes';
$ads_image  = alloggio_core_get_post_value_through_levels( 'qodef_room_single_ads_image' );

if ( $is_enabled && ! empty( $ads_image ) ) {
	$ads_link = alloggio_core_get_post_value_through_levels( 'qodef_room_single_ads_link' );
	?>
	<div id="qodef-room-ads">
		<?php echo sprintf( '%s%s%s', ! empty( $ads_link ) ? '<a itemprop="url" href="' . esc_url( $ads_link ) . '">' : '', wp_get_attachment_image( $ads_image, 'full' ), ! empty( $ads_link ) ? '</a>' : '' ); ?>
	</div>
<?php } ?>