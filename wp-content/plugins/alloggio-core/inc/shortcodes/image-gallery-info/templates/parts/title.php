<?php if ( ! empty( $title ) ) { ?>
	<<?php echo esc_attr( $title_tag ); ?> class="qodef-m-title"><?php echo qode_framework_wp_kses_html( 'content', $title ); ?></<?php echo esc_attr( $title_tag ); ?>>
<?php } ?>