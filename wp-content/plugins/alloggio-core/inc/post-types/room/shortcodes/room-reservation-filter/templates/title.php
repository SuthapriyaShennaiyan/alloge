<?php
$title_text = isset( $title_label ) && ! empty( $title_label ) ? trim( $title_label ) : esc_html__( 'Check Availability', 'alloggio-core' );

if ( ! empty( $title_text ) ) { ?>
	<h4 class="qodef-m-title"><?php echo esc_html( $title_text ); ?></h4>
<?php } ?>