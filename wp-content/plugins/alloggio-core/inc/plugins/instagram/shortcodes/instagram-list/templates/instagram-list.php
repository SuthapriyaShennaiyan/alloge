<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<?php echo do_shortcode( "[instagram-feed $instagram_params]" ); // XSS OK ?>
	<?php if ( ! empty( $overlay_title ) ) { ?>
		<p class="qodef-instagram-title"><?php echo esc_html( $overlay_title ); ?></p>
	<?php } ?>
</div>