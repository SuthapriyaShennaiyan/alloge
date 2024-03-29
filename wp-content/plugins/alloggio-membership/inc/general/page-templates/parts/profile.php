<div class="qodef-m-content-inner qodef--<?php echo esc_attr( isset( $action ) && ! empty( $action ) ? $action : 'dashboard' ); ?>">
	<?php if ( isset( $profile_image ) && ! empty( $profile_image ) ) { ?>
		<div class="qodef-m-image">
			<?php echo wp_kses_post( $profile_image ); ?>
		</div>
	<?php } ?>
	<?php if ( isset( $first_name ) && ! empty( $first_name ) ) { ?>
		<div class="qodef-m-text qodef--first-name">
			<h5 class="qodef-m-text-label"><?php esc_html_e( 'First Name:', 'alloggio-membership' ); ?></h5>
			<p class="qodef-m-text-value"><?php echo wp_kses_post( $first_name ); ?></p>
		</div>
	<?php } ?>
	<?php if ( isset( $last_name ) && ! empty( $last_name ) ) { ?>
		<div class="qodef-m-text qodef--last-name">
			<h5 class="qodef-m-text-label"><?php esc_html_e( 'Last Name:', 'alloggio-membership' ); ?></h5>
			<p class="qodef-m-text-value"><?php echo wp_kses_post( $last_name ); ?></p>
		</div>
	<?php } ?>
	<?php if ( isset( $email ) && ! empty( $email ) ) { ?>
		<div class="qodef-m-text qodef--email">
			<h5 class="qodef-m-text-label"><?php esc_html_e( 'Email:', 'alloggio-membership' ); ?></h5>
			<p class="qodef-m-text-value"><a itemprop="url" href="mailto:<?php echo sanitize_email( $email ); ?>"><?php echo sanitize_email( $email ); ?></a></p>
		</div>
	<?php } ?>
	<?php if ( isset( $website ) && ! empty( $website ) ) { ?>
		<div class="qodef-m-text qodef--website">
			<h5 class="qodef-m-text-label"><?php esc_html_e( 'Website:', 'alloggio-membership' ); ?></h5>
			<p class="qodef-m-text-value"><a itemprop="url" href="<?php echo esc_url( $website ); ?>"><?php echo esc_url( $website ); ?></a></p>
		</div>
	<?php } ?>
	<?php if ( isset( $description ) && ! empty( $description ) ) { ?>
		<div class="qodef-m-text qodef--description">
			<h5 class="qodef-m-text-label"><?php esc_html_e( 'Description:', 'alloggio-membership' ); ?></h5>
			<p class="qodef-m-text-value"><?php echo wp_kses_post( $description ); ?></p>
		</div>
	<?php } ?>
	<?php
	// Hook to include additional content
	do_action( 'alloggio_membership_action_additional_profile_page_content', $params ); ?>
</div>