<div class="qodef-m-inner">
	<?php if ( isset( $city ) && ! empty( $city ) && $show_location === 'yes' ) { ?>
		<div class="qodef-m-city"><?php echo esc_html( $city ); ?></div>
	<?php } ?>
	<?php alloggio_core_template_part( 'widgets/weather', 'templates/parts/icon', '', $params ); ?>
	<?php alloggio_core_template_part( 'widgets/weather', 'templates/parts/temperature', '', $params ); ?>
</div>
<?php alloggio_core_template_part( 'widgets/weather', 'templates/parts/five-days', '', $params ); ?>