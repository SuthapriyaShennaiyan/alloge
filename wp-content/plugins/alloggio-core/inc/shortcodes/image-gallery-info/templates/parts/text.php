<?php if ( ! empty( $item_text ) ) { ?>
	<p class="qodef-m-text <?php echo esc_attr( $custom_class ); ?>"><?php echo wp_kses_post( $item_text ); ?></p>
<?php } ?>