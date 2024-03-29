<?php

include_once ALLOGGIO_CORE_CPT_PATH . '/clients/helper.php';

foreach ( glob( ALLOGGIO_CORE_CPT_PATH . '/clients/dashboard/meta-box/*.php' ) as $module ) {
	include_once $module;
}