<?php

include_once ALLOGGIO_CORE_SHORTCODES_PATH . '/banner/banner.php';

foreach ( glob( ALLOGGIO_CORE_INC_PATH . '/shortcodes/banner/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}