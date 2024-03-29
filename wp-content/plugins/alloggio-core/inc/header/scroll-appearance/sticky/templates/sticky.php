<div class="qodef-header-sticky">
    <div class="qodef-header-sticky-inner <?php echo apply_filters( 'alloggio_filter_header_inner_class', '' ); ?>">
		<?php
		// Include logo
		alloggio_core_get_header_logo_image( array( 'sticky_logo' => true ) );
		
		// Include main navigation
		alloggio_core_template_part( 'header', 'templates/parts/navigation', '', array( 'menu_id' => 'qodef-sticky-navigation-menu' ) );
		
		// Include widget area one
		alloggio_core_get_header_widget_area('sticky');

		do_action( 'alloggio_core_action_after_sticky_header' ); ?>
    </div>
</div>