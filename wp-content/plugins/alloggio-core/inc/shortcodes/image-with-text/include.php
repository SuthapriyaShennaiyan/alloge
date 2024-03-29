<?php

include_once ALLOGGIO_CORE_SHORTCODES_PATH . '/image-with-text/image-with-text.php';

foreach ( glob( ALLOGGIO_CORE_SHORTCODES_PATH . '/image-with-text/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}