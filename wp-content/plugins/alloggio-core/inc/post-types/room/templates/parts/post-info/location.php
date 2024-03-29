<?php
$address = get_post_meta( get_the_ID(), 'qodef_room_single_full_address', true );

if ( ! empty( $address ) ) {
	$map_params['address1']   = $address;
	$map_params['map_height'] = 412;
	?>
	<div class="qodef-e-location">
		<h4 class="qodef-e-location-title"><?php esc_html_e( 'Location', 'alloggio-core' ); ?></h4>
		<?php echo AlloggioCoreGoogleMapShortcode::call_shortcode( $map_params ); ?>
	</div>
<?php } ?>