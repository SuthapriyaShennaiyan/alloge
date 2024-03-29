<?php

include_once ALLOGGIO_CORE_SHORTCODES_PATH . '/pricing-table/pricing-table.php';

foreach ( glob( ALLOGGIO_CORE_SHORTCODES_PATH . '/pricing-table/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}