<?php

include_once ALLOGGIO_CORE_CPT_PATH . '/room/shortcodes/room-list/room-list.php';

foreach ( glob( ALLOGGIO_CORE_CPT_PATH . '/room/shortcodes/room-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}