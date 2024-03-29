<?php

if ( ! function_exists( 'alloggio_child_theme_enqueue_scripts' ) ) {
	/**
	 * Function that enqueue theme's child style
	 */
	function alloggio_child_theme_enqueue_scripts() {
		$main_style = 'alloggio-main';
		
		wp_enqueue_style( 'alloggio-child-style', get_stylesheet_directory_uri() . '/style.css', array( $main_style ) );
	}
	
	add_action( 'wp_enqueue_scripts', 'alloggio_child_theme_enqueue_scripts' );
}