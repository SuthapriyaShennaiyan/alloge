<?php
$is_enabled = alloggio_core_get_post_value_through_levels( 'qodef_room_single_enable_weather' );
$api_key    = alloggio_core_get_option_value( 'admin', 'qodef_room_single_weather_api_key' );

if ( $is_enabled && ! empty( $api_key ) && class_exists( 'AlloggioCoreWeatherWidget' ) ) {
	$page_id          = get_the_ID();
	$weather_location = get_post_meta( $page_id, 'qodef_room_single_enable_weather_location', true );
	$location_values  = get_the_terms( $page_id, 'location' );
	$location         = '';
	
	if ( ! empty( $weather_location ) ) {
		$location = $weather_location;
	} elseif ( ! empty( $location_values ) && ! is_wp_error( $location_values ) ) {
		$location = $location_values[0]->name;
	}
	
	if ( ! empty( $location ) ) { ?>
		<div id="qodef-room-weather" class="qodef-m">
			<?php $attr = apply_filters( 'alloggio_core_filter_room_single_weather_attributes', array(
				'api_key'      => $api_key,
				'layout'       => 'standard',
				'location'     => esc_attr( $location ),
				'units'        => 'metric',
				'time_zone'    => '0',
				'days_to_show' => '5',
			) );
			
			the_widget( 'AlloggioCoreWeatherWidget', http_build_query( $attr ) ); ?>
		</div>
	<?php
	}
}