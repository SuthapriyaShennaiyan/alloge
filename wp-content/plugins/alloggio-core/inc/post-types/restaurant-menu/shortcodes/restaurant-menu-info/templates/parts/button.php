<?php if ( ! empty ( $download_link ) ) { ?>
	<div class="qodef-m-download">
		<a href="<?php echo esc_url( $download_link ); ?>" download class="qodef-button qodef-layout--outlined qodef-html--link">
			<span class="qodef-m-text">
				<?php echo esc_html__('Download Menu','alloggio-core')?>
			</span>
		</a>
	</div>
<?php } ?>