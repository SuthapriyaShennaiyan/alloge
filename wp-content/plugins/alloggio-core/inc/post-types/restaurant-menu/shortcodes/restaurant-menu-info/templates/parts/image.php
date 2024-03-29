<?php if ( ! empty( $image ) ) { ?>
	<div class="qodef-m-image">
		<?php echo wp_get_attachment_image( $image, 'full' ); ?>
	</div>
<?php } ?>