<?php

if ( ! function_exists( 'alloggio_core_register_testimonials_for_meta_options' ) ) {
	function alloggio_core_register_testimonials_for_meta_options( $post_types ) {
		$post_types[] = 'testimonials';
		return $post_types;
	}
	
	add_filter( 'qode_framework_filter_meta_box_save', 'alloggio_core_register_testimonials_for_meta_options' );
	add_filter( 'qode_framework_filter_meta_box_remove', 'alloggio_core_register_testimonials_for_meta_options' );
}

if ( ! function_exists( 'alloggio_core_add_testimonials_custom_post_type' ) ) {
	/**
	 * Function that adds testimonials custom post type
	 *
	 * @param array $cpts
	 *
	 * @return array
	 */
	function alloggio_core_add_testimonials_custom_post_type( $cpts ) {
		$cpts[] = 'AlloggioCoreTestimonialsCPT';
		
		return $cpts;
	}
	
	add_filter( 'alloggio_core_filter_register_custom_post_types', 'alloggio_core_add_testimonials_custom_post_type' );
}

if ( class_exists( 'QodeFrameworkCustomPostType' ) ) {
	class AlloggioCoreTestimonialsCPT extends QodeFrameworkCustomPostType {
		
		public function map_post_type() {
			$name = esc_html__( 'Testimonials', 'alloggio-core' );
			$this->set_base( 'testimonials' );
			$this->set_menu_position( 10 );
			$this->set_menu_icon( 'dashicons-format-status' );
			$this->set_slug( 'testimonials' );
			$this->set_name( $name );
			$this->set_path( ALLOGGIO_CORE_CPT_PATH . '/testimonials' );
			$this->set_labels( array(
				'name'          => esc_html__( 'Alloggio Testimonials', 'alloggio-core' ),
				'singular_name' => esc_html__( 'Testimonial', 'alloggio-core' ),
				'add_item'      => esc_html__( 'New Testimonial', 'alloggio-core' ),
				'add_new_item'  => esc_html__( 'Add New Testimonial', 'alloggio-core' ),
				'edit_item'     => esc_html__( 'Edit Testimonial', 'alloggio-core' )
			) );
			$this->set_public( false );
			$this->set_archive( false );
			$this->set_supports( array(
				'title',
				'thumbnail'
			) );
			$this->add_post_taxonomy( array(
				'base'          => 'testimonials-category',
				'slug'          => 'testimonials-category',
				'singular_name' => esc_html__( 'Category', 'alloggio-core' ),
				'plural_name'   => esc_html__( 'Categories', 'alloggio-core' ),
			) );
		}
		
	}
}