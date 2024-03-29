<?php if ( class_exists( 'AlloggioCoreSocialShareShortcode' ) ) { ?>
	<div class="qodef-e-info-item qodef-e-info-social-share">
		<?php
		$params = array();
		$params['title'] = esc_html__( 'Share:', 'alloggio-core' );
		
		echo AlloggioCoreSocialShareShortcode::call_shortcode( $params ); ?>
	</div>
<?php } ?>