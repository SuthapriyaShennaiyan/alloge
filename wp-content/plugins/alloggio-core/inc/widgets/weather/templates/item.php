<?php if ( isset( $city ) && ! empty( $city ) ) { ?>
	<h4 class="qodef-m-city"><?php echo sprintf( '%s %s', $city, esc_html__( 'Weather', 'alloggio-core' ) ); ?></h4>
<?php } ?>
<div class="qodef-m-inner">
	<div class="qodef-m-weather">
		<?php alloggio_core_template_part( 'widgets/weather', 'templates/parts/icon', '', $params ); ?>
		<?php alloggio_core_template_part( 'widgets/weather', 'templates/parts/temperature', '', $params ); ?>
		<p class="qodef-e-humidity">
			<?php echo sprintf( '%s %s%s', esc_html__( 'Humidity:', 'alloggio-core' ), esc_html( $today_humidity ), esc_html__( '%', 'alloggio-core' ) ); ?>
		</p>
		<p class="qodef-e-wind">
			<?php echo sprintf( '%s %s%s', esc_html__( 'Wind:', 'alloggio-core' ), esc_html( $today_wind_speed ), esc_html( $wind_unit ) ); ?>
		</p>
	</div>
	<?php alloggio_core_template_part( 'widgets/weather', 'templates/parts/five-days', '', $params ); ?>
</div>