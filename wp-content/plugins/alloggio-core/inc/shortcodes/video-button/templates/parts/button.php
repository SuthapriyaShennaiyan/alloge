<?php if ( ! empty( $video_link ) ) { ?>
	<a itemprop="url" class="qodef-m-play qodef-magnific-popup qodef-popup-item" <?php echo qode_framework_get_inline_style( $play_button_styles ); ?> href="<?php echo esc_url( $video_link ); ?>" data-type="iframe">
		<span class="qodef-m-play-inner">
			<?php /*echo qode_framework_icons()->render_icon( 'icon-music-play-button', 'linea-icons' ); */?>
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 71 71" enable-background="new 0 0 71 71" xml:space="preserve">
				<polygon points="49.2,35.5 25.8,22 25.8,49 "/>
				<circle cx="35.5" cy="35.5" r="35"/>
			</svg>
		</span>
	</a>
<?php } ?>