<?php
$room_size = get_post_meta( get_the_ID(), 'qodef_room_single_room_size', true );

if ( ! empty( $room_size ) ) { ?>
	<span class="qodef-e-room-size"><?php echo esc_html( $room_size ); ?></span>
<?php } ?>