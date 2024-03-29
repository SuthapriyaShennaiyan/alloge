<?php

include_once ALLOGGIO_CORE_SHORTCODES_PATH . '/counter/counter.php';

foreach ( glob( ALLOGGIO_CORE_SHORTCODES_PATH . '/counter/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}