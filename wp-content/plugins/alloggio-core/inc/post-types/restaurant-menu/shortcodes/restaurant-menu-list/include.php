<?php

include_once ALLOGGIO_CORE_CPT_PATH . '/restaurant-menu/shortcodes/restaurant-menu-list/restaurant-menu-list.php';

foreach ( glob( ALLOGGIO_CORE_CPT_PATH . '/restaurant-menu/shortcodes/restaurant-menu-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}