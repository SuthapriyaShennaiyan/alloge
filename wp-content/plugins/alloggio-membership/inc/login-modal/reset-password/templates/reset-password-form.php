<form id="qodef-membership-reset-password-modal-part" class="qodef-m" method="POST">
	<div class="qodef-m-fields">
		<label><?php esc_html_e( 'Lost your password? Please enter your username or email address. You will receive a link to create a new password via email.', 'alloggio-membership' ); ?></label>
		<input type="text" class="qodef-m-user-login" name="user_login" placeholder="<?php esc_attr_e( 'User name or email', 'alloggio-membership' ) ?>" value="" required />
	</div>
	<div class="qodef-m-action">
		<?php
		$reset_button_params = array(
			'custom_class' => 'qodef-m-action-button qodef-html--link',
			'html_type'    => 'submit',
			'text'         => esc_html__( 'Reset Password', 'alloggio-membership' )
		);
		
		echo AlloggioCoreButtonShortcode::call_shortcode( $reset_button_params );
		
		alloggio_membership_template_part( 'login-modal', 'templates/parts/spinner' ); ?>
	</div>
	<?php alloggio_membership_template_part( 'login-modal', 'templates/parts/response' ); ?>
	<?php alloggio_membership_template_part( 'login-modal', 'templates/parts/hidden-fields', '', array( 'response_type' => 'reset-password' ) ); ?>
</form>