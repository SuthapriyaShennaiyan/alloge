<?php

include_once ALLOGGIO_CORE_SHORTCODES_PATH . '/icon-with-text/icon-with-text.php';

foreach ( glob( ALLOGGIO_CORE_SHORTCODES_PATH . '/icon-with-text/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}