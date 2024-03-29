<?php

include_once ALLOGGIO_CORE_SHORTCODES_PATH . '/button/button.php';

foreach ( glob( ALLOGGIO_CORE_SHORTCODES_PATH . '/button/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}