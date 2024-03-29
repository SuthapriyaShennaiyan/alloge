<?php do_action('alloggio_action_before_page_header'); ?>

<header id="qodef-page-header">
    <div id="qodef-page-header-inner">
	    <?php
	    // Include logo
	    alloggio_core_get_header_logo_image();
	
	    // Include divided left navigation
		alloggio_core_template_part( 'header', 'layouts/vertical/templates/navigation' );
	
	    // Include widget area one
	    alloggio_core_get_header_widget_area(); ?>
    </div>
</header>

