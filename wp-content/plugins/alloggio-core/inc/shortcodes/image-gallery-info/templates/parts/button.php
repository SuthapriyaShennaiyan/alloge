<?php if ( ! empty( $button_link ) && ! empty( $button_text ) ) {
	
	$button_params =  array(
			'html_type'     => 'default',
			'button_layout' => 'filled',
			'link'          => $button_link,
			'text'          => $button_text,
			'target'        => $button_target,
			'size'          => 'normal',
		); ?>
	
	<div class="qodef-m-button">
		<?php echo AlloggioCoreButtonShortcode::call_shortcode( $button_params ); ?>
	</div>
<?php } ?>