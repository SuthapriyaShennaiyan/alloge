<?php

abstract class AlloggioCoreSearch {
	public $search_layout;

	public function __construct() {
		add_action('wp', array( $this, 'set_variables' ), 11); //after alloggio_core_search_include_layout
		add_filter( 'body_class', array( $this, 'add_body_classes' ) );
	}

	function set_variables() {
		$this->search_layout = AlloggioCoreHeaders::get_instance()->get_header_object()->search_layout;
	}

	function add_body_classes( $classes ) {
		$classes[] = 'qodef-search--'.$this->search_layout;
		return $classes;
	}

}