<?php
$min_capacity_meta = get_post_meta( get_the_ID(), 'qodef_room_single_min_capacity', true );
$max_capacity_meta = get_post_meta( get_the_ID(), 'qodef_room_single_max_capacity', true );

$min_capacity = ! empty( $min_capacity_meta ) ? intval( $min_capacity_meta ) : 1;
$max_capacity = ! empty( $max_capacity_meta ) ? intval( $max_capacity_meta ) : $min_capacity;

if ( ! empty( $min_capacity ) && $max_capacity > 1 ) { ?>
	<span class="qodef-e-capacity"><?php echo sprintf( '%s-%s %s', $min_capacity, $max_capacity, esc_html__( 'person', 'alloggio-core' ) ); ?></span>
<?php } ?>