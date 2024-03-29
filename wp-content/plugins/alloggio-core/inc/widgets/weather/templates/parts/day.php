<div class="qodef-m-inner">
	<?php
	if ( isset( $day_of_week ) && ! empty( $day_of_week ) ) { ?>
		<span class="qodef-m-day"><?php echo esc_html( $day_of_week ); ?></span>
	<?php }
	alloggio_core_template_part( 'widgets/weather', 'templates/parts/icon', '', $params );
	alloggio_core_template_part( 'widgets/weather', 'templates/parts/temperature', '', $params ); ?>
</div>