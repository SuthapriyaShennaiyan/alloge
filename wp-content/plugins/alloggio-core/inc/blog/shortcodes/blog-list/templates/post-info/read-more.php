<?php if ( ! post_password_required() && class_exists( 'AlloggioCoreButtonShortcode' ) ) { ?>
	<div class="qodef-e-read-more">
		<?php
		$button_params = array(
			'link' => get_the_permalink(),
			'text' => esc_html__( 'Read More', 'alloggio-core' )
		);
		
		echo AlloggioCoreButtonShortcode::call_shortcode( $button_params ); ?>
	</div>
<?php } ?>