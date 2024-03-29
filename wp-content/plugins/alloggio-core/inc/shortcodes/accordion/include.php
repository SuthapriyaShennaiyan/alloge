<?php

include_once ALLOGGIO_CORE_SHORTCODES_PATH . '/accordion/accordion.php';
include_once ALLOGGIO_CORE_SHORTCODES_PATH . '/accordion/accordion-child.php';

foreach ( glob( ALLOGGIO_CORE_SHORTCODES_PATH . '/accordion/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}