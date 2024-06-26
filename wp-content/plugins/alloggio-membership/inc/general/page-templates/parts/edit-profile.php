<?php

if ( ! function_exists( 'alloggio_membership_dashboard_edit_profile_fields' ) ) {
	/**
	 * Function that display edit profile page form
	 *
	 * @param array $params
	 */
	function alloggio_membership_dashboard_edit_profile_fields( $params ) {
		$qode_framework = qode_framework_get_framework_root();
		
		$page = $qode_framework->add_options_page(
			array(
				'type'         => 'front-end',
				'slug'         => 'edit-profile-page',
				'title'        => esc_html__( 'Edit Profile', 'alloggio-membership' ),
				'form_id'      => 'qodef-membership-edit-profile',
				'name'         => 'edit_profile_form',
				'method'       => 'POST',
				'button_label' => esc_html__( 'Update Profile', 'alloggio-membership' ),
				'button_args'  => array(
					'data-updating-text' => esc_html__( 'Updating Profile', 'alloggio-membership' ),
					'data-updated-text'  => esc_html__( 'Profile Updated', 'alloggio-membership' ),
					'data-rest-route'    => 'updateUserRestRoute',
					'data-rest-nonce'    => 'restNonce',
				)
			)
		);
		
		if ( $page ) {
			extract( $params );
			
			$page->add_field_element(
				array(
					'field_type'    => 'text',
					'name'          => 'first_name',
					'title'         => esc_html__( 'First Name', 'alloggio-membership' ),
					'default_value' => $first_name
				)
			);
			
			$page->add_field_element(
				array(
					'field_type'    => 'text',
					'name'          => 'last_name',
					'title'         => esc_html__( 'Last Name', 'alloggio-membership' ),
					'default_value' => $last_name
				)
			);
			
			$page->add_field_element(
				array(
					'field_type'    => 'text',
					'name'          => 'user_email',
					'title'         => esc_html__( 'Email', 'alloggio-membership' ),
					'default_value' => $email
				)
			);
			
			$page->add_field_element(
				array(
					'field_type'    => 'text',
					'name'          => 'user_url',
					'title'         => esc_html__( 'Website', 'alloggio-membership' ),
					'default_value' => $website
				)
			);
			
			$page->add_field_element(
				array(
					'field_type'    => 'text',
					'name'          => 'description',
					'title'         => esc_html__( 'Description', 'alloggio-membership' ),
					'default_value' => $description
				)
			);

			$page->add_field_element(
				array(
					'field_type' => 'password',
					'name'       => 'user_password',
					'title'      => esc_html__( 'Password', 'alloggio-membership' )
				)
			);

			$page->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'user_confirm_password',
					'title'      => esc_html__( 'Repeat Password', 'alloggio-membership' )
				)
			);

			do_action( 'alloggio_membership_action_after_dashboard_edit_profile_fields', $page, $params );
			
			$page->render();
		}
	}
}
?>
<div class="qodef-m-content-inner qodef--<?php echo esc_attr( isset( $action ) && ! empty( $action ) ? $action : 'dashboard' ); ?>">
    <div id="qodef-page" class="qodef-options-front-end">
	    <?php alloggio_membership_dashboard_edit_profile_fields( $params ); ?>
    </div>
</div>