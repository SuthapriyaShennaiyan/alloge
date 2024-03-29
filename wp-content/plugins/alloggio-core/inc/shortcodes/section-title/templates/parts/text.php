<?php if ( ! empty( $text ) ) { ?>
	<<?php echo esc_attr( $text_tag ); ?> class="qodef-m-text" <?php qode_framework_inline_style( $text_styles ); ?>><?php echo esc_html( $text ); ?></<?php echo esc_attr( $text_tag ); ?>>
<?php } ?>