<div class="qodef-instagram-holder" <?php qode_framework_inline_attr( $slider_attr, 'data-options' ); ?>>
	<?php echo do_shortcode( "[instagram-feed class=qodef-instagram-swiper-container $instagram_params]" ); // XSS OK ?>
	<?php if ( ! empty( $overlay_title ) ) { ?>
		<p class="qodef-instagram-title"><?php echo esc_html( $overlay_title ); ?></p>
	<?php } ?>
</div>