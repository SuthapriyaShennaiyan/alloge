<?php

include_once ALLOGGIO_CORE_INC_PATH . '/blog/shortcodes/blog-list/blog-list.php';

foreach ( glob( ALLOGGIO_CORE_INC_PATH . '/blog/shortcodes/blog-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}