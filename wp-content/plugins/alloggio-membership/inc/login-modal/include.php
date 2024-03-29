<?php

include_once ALLOGGIO_MEMBERSHIP_LOGIN_MODAL_PATH . '/helper.php';

foreach ( glob( ALLOGGIO_MEMBERSHIP_LOGIN_MODAL_PATH . '/*/include.php' ) as $module ) {
	include_once $module;
}