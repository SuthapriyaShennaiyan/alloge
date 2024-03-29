<?php if ( isset( $button_params['text'] ) && ! empty( $button_params['text'] ) && class_exists( 'AlloggioCoreButtonShortcode' ) ) { ?>
	<div class="qodef-m-button">
		<?php echo AlloggioCoreButtonShortcode::call_shortcode( $button_params ); ?>
	</div>
<?php } ?>