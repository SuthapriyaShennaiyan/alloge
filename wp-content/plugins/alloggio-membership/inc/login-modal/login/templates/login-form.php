<form id="qodef-membership-login-modal-part" class="qodef-m" method="GET">
	<div class="qodef-m-fields">
		<input type="text" class="qodef-m-user-name" name="user_name" placeholder="<?php esc_attr_e( 'User Name *', 'alloggio-membership' ) ?>" value="" required pattern=".{3,}" autocomplete="username"/>
		<input type="password" class="qodef-m-user-password" name="user_password" placeholder="<?php esc_attr_e( 'Password *', 'alloggio-membership' ) ?>" required autocomplete="current-password" />
	</div>
	<div class="qodef-m-links">
		<div class="qodef-m-links-remember-me">
			<input type="checkbox" id="qodef-m-links-remember" class="qodef-m-links-remember" name="remember" value="forever" />
			<label for="qodef-m-links-remember" class="qodef-m-links-remember-label"><?php esc_html_e( 'Keep me signed in', 'alloggio-membership' ) ?></label>
		</div>
		<a href="#" class="qodef-m-links-reset-password"><?php esc_html_e( 'Forgot password?', 'alloggio-membership' ); ?></a>
	</div>
	<div class="qodef-m-action">
		<?php
		$login_button_params = array(
			'custom_class' => 'qodef-m-action-button qodef-html--link',
			'html_type'    => 'submit',
			'text'         => esc_html__( 'Login', 'alloggio-membership' )
		);
		
		echo AlloggioCoreButtonShortcode::call_shortcode( $login_button_params );
		
		alloggio_membership_template_part( 'login-modal', 'templates/parts/spinner' ); ?>
	</div>
	<?php
	/**
	 * Hook to include additional form content
	 */
	do_action( 'alloggio_membership_action_login_form_template' );
	
	alloggio_membership_template_part( 'login-modal', 'templates/parts/response' );
	alloggio_membership_template_part( 'login-modal', 'templates/parts/hidden-fields', '', array( 'response_type' => 'login' ) ); ?>
</form>