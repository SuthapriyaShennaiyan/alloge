<?php

include_once ALLOGGIO_CORE_CPT_PATH . '/room/shortcodes/room-reservation-filter/room-reservation-filter.php';

foreach ( glob( ALLOGGIO_CORE_CPT_PATH . '/room/shortcodes/room-reservation-filter/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}