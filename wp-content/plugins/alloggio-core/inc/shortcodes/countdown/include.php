<?php

include_once ALLOGGIO_CORE_SHORTCODES_PATH . '/countdown/countdown.php';

foreach ( glob( ALLOGGIO_CORE_SHORTCODES_PATH . '/countdown/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}