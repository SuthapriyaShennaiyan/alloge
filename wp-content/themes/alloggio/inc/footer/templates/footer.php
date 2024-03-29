<footer id="qodef-page-footer" <?php alloggio_class_attribute( implode( ' ', apply_filters( 'alloggio_filter_footer_holder_classes', array() ) ) ); ?>>
	<?php
	// Hook to include additional content before page footer content
	do_action( 'alloggio_action_before_page_footer_content' );
	
	// Include module content template
	echo apply_filters( 'alloggio_filter_footer_content_template', alloggio_get_template_part( 'footer', 'templates/footer-content' ) );
	
	// Hook to include additional content after page footer content
	do_action( 'alloggio_action_after_page_footer_content' );
	?>
</footer>