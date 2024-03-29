<?php if ( is_active_sidebar( alloggio_get_sidebar_name() ) ) { ?>
	<aside id="qodef-page-sidebar" class="<?php echo esc_attr( apply_filters( 'alloggio_filter_page_sidebar_aside_classes', '' ) ); ?>">
		<?php dynamic_sidebar( alloggio_get_sidebar_name() ); ?>
	</aside>
<?php } ?>