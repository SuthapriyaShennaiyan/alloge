<?php
if ( isset( $revolution_slider ) && ! empty( $revolution_slider ) ) {
	echo do_shortcode( '[rev_slider alias="' . esc_attr( $revolution_slider ) . '"][/rev_slider]' );
}
?>
<div class="qodef-form-wrapper">
	<div class="qodef-content-grid">
		<?php alloggio_core_template_part( 'post-types/room/shortcodes/room-reservation-filter', 'templates/form', '', $params ); ?>
	</div>
</div>