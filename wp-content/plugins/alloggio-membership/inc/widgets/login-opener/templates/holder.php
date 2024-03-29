<?php

if ( is_user_logged_in() ) {
	alloggio_membership_template_part( 'widgets/login-opener', 'templates/logged-in-content' );
} else {
	alloggio_membership_template_part( 'widgets/login-opener', 'templates/logged-out-content' );
}