<?php if ( ! empty( $subtitle ) ) { ?>
	<<?php echo esc_attr( $subtitle_tag ); ?> class="qodef-m-subtitle"><?php echo wp_kses_post( $subtitle ); ?></<?php echo esc_attr( $subtitle_tag ); ?>>
<?php } ?>