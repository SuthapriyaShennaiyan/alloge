<?php if ( ! empty( $content_image ) ) { ?>
	<div class="qodef-m-content-image">
		<?php echo wp_get_attachment_image( $content_image, 'full' ); ?>
	</div>
<?php } ?>