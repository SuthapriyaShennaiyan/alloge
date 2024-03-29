<div id="qodef-404-page">
	<span class="qodef-404-watermark"><?php echo esc_html( $watermark ); ?></span>
	
	<h2 class="qodef-404-title"><?php echo esc_html( $title ); ?></h2>
	
	<p class="qodef-404-text"><?php echo esc_html( $text ); ?></p>
	
	<div class="qodef-404-button">
		<?php
		$button_params = array(
			'link' => esc_url( home_url( '/' ) ),
			'text' => esc_html( $button_text ),
		);
		
		alloggio_render_button_element( $button_params ); ?>
	</div>
</div>