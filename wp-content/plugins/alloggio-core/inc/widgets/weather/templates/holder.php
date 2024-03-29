<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<?php if ( ! empty( $today_params ) ) {
		alloggio_core_template_part( 'widgets/weather', 'templates/item', $layout, array_merge( $params, $today_params ) );
	} ?>
</div>