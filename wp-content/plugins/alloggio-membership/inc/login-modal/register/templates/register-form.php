<form id="qodef-membership-register-modal-part" class="qodef-m" method="POST">
	<div class="qodef-m-fields">
		<input type="text" class="qodef-m-user-name" name="user_name" placeholder="<?php esc_attr_e( 'User Name *', 'alloggio-membership' ) ?>" value="" required pattern=".{3,}" autocomplete="username"/>
		<input type="email" class="qodef-m-user-email" name="user_email" placeholder="<?php esc_attr_e( 'Email *', 'alloggio-membership' ) ?>" value="" required autocomplete="email"/>
		<input type="password" class="qodef-m-user-password" name="user_password" placeholder="<?php esc_attr_e( 'Password *', 'alloggio-membership' ) ?>" required pattern=".{5,}" autocomplete="new-password"/>
		<input type="password" class="qodef-m-user-confirm-password" name="user_confirm_password" placeholder="<?php esc_attr_e( 'Repeat Password *', 'alloggio-membership' ) ?>" required pattern=".{5,}" autocomplete="new-password"/>
	</div>
	
	<div class="qodef-m-action">
		<?php
		$register_button_params = array(
			'custom_class' => 'qodef-m-action-button qodef-html--link',
			'html_type'    => 'submit',
			'text'         => esc_html__( 'Register', 'alloggio-membership' )
		);
		
		echo AlloggioCoreButtonShortcode::call_shortcode( $register_button_params );
		
		alloggio_membership_template_part( 'login-modal', 'templates/parts/spinner' ); ?>
	</div>
	<?php alloggio_membership_template_part( 'login-modal', 'templates/parts/response' ); ?>
	<?php alloggio_membership_template_part( 'login-modal', 'templates/parts/hidden-fields', '', array( 'response_type' => 'register' ) ); ?>
</form>