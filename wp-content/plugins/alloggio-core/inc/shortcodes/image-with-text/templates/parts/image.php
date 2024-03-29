<div class="qodef-m-image">
	<?php if ($image_action === 'scrolling-image') { ?>
	<div class="qodef-m-image-holder">
		<div class="qodef-m-image-holder-inner">
			<?php } ?>
			<?php if ( $image_action === 'open-popup' ) { ?>
			<a class="qodef-magnific-popup qodef-popup-item" itemprop="image" href="<?php echo esc_url( $image_params['url'] ); ?>" data-type="image" title="<?php echo esc_attr( $image_params['alt'] ); ?>">
				<?php } else if ( $image_action === 'custom-link' || $image_action === 'scrolling-image' && ! empty( $link ) ) { ?>
				<a itemprop="url" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
					<?php } ?>
					<?php if ( is_array( $image_params['image_size'] ) && count( $image_params['image_size'] ) ) {
						echo qode_framework_generate_thumbnail( $image_params['image_id'], $image_params['image_size'][0], $image_params['image_size'][1] );
					} else {
						echo wp_get_attachment_image($image_params['image_id'], $image_params['image_size'], false, array('class' => 'qodef-e-main-image') );
					} ?>
					<?php if ( $image_action === 'open-popup' || $image_action === 'custom-link' || $image_action === 'scrolling-image') { ?>
				</a>
			<?php } ?>
				<?php if ($image_action === 'scrolling-image') { ?>
		</div>
		<img class="qodef-e-frame" src="<?php echo ALLOGGIO_CORE_SHORTCODES_URL_PATH ?>/image-with-text/assets/img/scrolling-image-frame.png" <?php qode_framework_inline_style( $frame_styles );?> alt="<?php esc_html_e('Scrolling Image Frame', 'allogio-core') ?>" />
	</div>
	<?php if ( ! empty ($image_caption ) ) { ?>
		<span class="qodef-m-caption"><?php echo esc_html( $image_caption ); ?></span>
	<?php } ?>
<?php } ?>
</div>