<?php

include_once ALLOGGIO_CORE_SHORTCODES_PATH . '/custom-font/custom-font.php';

foreach ( glob( ALLOGGIO_CORE_SHORTCODES_PATH . '/custom-font/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}