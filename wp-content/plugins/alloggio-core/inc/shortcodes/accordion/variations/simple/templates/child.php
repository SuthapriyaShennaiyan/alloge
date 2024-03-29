<<?php echo esc_attr( $title_tag ); ?> class="qodef-accordion-title">
	<span class="qodef-tab-title">
		<?php echo esc_html( $title ); ?>
	</span>
	<span class="qodef-accordion-mark">
		<span class="qodef-icon--arrow-down"><?php echo alloggio_get_icon( 'icon-arrows-down', 'linea-icons', esc_html__( '+', 'alloggio' ) ); ?></span>
		<span class="qodef-icon--arrow-up"><?php echo alloggio_get_icon( 'icon-arrows-up', 'linea-icons', esc_html__( '-', 'alloggio' ) ); ?></span>
	</span>
</<?php echo esc_attr( $title_tag ); ?>>
<div class="qodef-accordion-content">
	<div class="qodef-accordion-content-inner">
		<?php echo do_shortcode( $content ); ?>
	</div>
</div>