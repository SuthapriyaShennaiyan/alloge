<?php
$nav_next_classes = '';
$nav_prev_classes = '';
if ( isset( $unique ) && ! empty( $unique ) ) {
	$nav_next_classes = 'swiper-button-outside swiper-button-next-' . esc_attr( $unique );
	$nav_prev_classes = 'swiper-button-outside swiper-button-prev-' . esc_attr( $unique );
}
?>
<div class="swiper-button-next <?php echo esc_attr( $nav_next_classes ); ?>"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 26 50.9" xml:space="preserve"><polyline points="0.4,50.6 25.3,25.5 0.4,0.4 "/></svg></div>
<div class="swiper-button-prev <?php echo esc_attr( $nav_prev_classes ); ?>"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 26 50.9" xml:space="preserve"><polyline points="25.6,0.4 0.7,25.5 25.6,50.6 "/></svg></div>