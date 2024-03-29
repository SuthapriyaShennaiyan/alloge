<div class="qodef-e-button">
	<?php alloggio_core_print_room_button_element( array(
		'html_type'     => 'default',
		'button_layout' => 'textual',
		'link'          => isset( $query_options ) && ! empty( $query_options ) ? add_query_arg( array_map( 'urlencode', $query_options ), get_the_permalink() ) : get_the_permalink(),
		'text'          => esc_html__( 'Book Now', 'alloggio-core' ),
		'size'          => 'normal',
	) ); ?>
</div>