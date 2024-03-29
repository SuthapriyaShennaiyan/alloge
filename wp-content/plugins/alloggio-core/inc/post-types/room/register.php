<?php

if ( ! function_exists( 'alloggio_core_register_room_for_meta_options' ) ) {
	/**
	 * Function that add custom post type into global meta box allowed items array for saving meta box options
	 *
	 * @param array $post_types
	 *
	 * @return array
	 */
	function alloggio_core_register_room_for_meta_options( $post_types ) {
		$post_types[] = 'room';
		
		return $post_types;
	}
	
	add_filter( 'qode_framework_filter_meta_box_save', 'alloggio_core_register_room_for_meta_options' );
	add_filter( 'qode_framework_filter_meta_box_remove', 'alloggio_core_register_room_for_meta_options' );
}

if ( ! function_exists( 'alloggio_core_add_room_custom_post_type' ) ) {
	/**
	 * Function that adds custom post type
	 *
	 * @param array $cpts
	 *
	 * @return array
	 */
	function alloggio_core_add_room_custom_post_type( $cpts ) {
		$cpts[] = 'AlloggioCoreRoomCPT';
		
		return $cpts;
	}
	
	add_filter( 'alloggio_core_filter_register_custom_post_types', 'alloggio_core_add_room_custom_post_type' );
}

if ( class_exists( 'QodeFrameworkCustomPostType' ) ) {
	class AlloggioCoreRoomCPT extends QodeFrameworkCustomPostType {
		
		public function map_post_type() {
			$name = esc_html__( 'Room', 'alloggio-core' );
			$this->set_base( 'room' );
			$this->set_menu_position( 15 );
			$this->set_menu_icon( 'dashicons-palmtree' );
			$this->set_slug( 'room' );
			$this->set_name( $name );
			$this->set_path( ALLOGGIO_CORE_CPT_PATH . '/room' );
			$this->set_labels( array(
				'name'          => esc_html__( 'Alloggio Room', 'alloggio-core' ),
				'singular_name' => esc_html__( 'Room', 'alloggio-core' ),
				'add_item'      => esc_html__( 'New Room', 'alloggio-core' ),
				'add_new_item'  => esc_html__( 'Add New Room', 'alloggio-core' ),
				'edit_item'     => esc_html__( 'Edit Room', 'alloggio-core' )
			) );
			$this->set_supports( array(
				'title',
				'thumbnail',
				'editor',
				'excerpt',
				'page-attributes',
			) );
			$this->add_post_taxonomy( array(
				'base'          => 'location',
				'slug'          => 'location',
				'singular_name' => esc_html__( 'Location', 'alloggio-core' ),
				'plural_name'   => esc_html__( 'Locations', 'alloggio-core' ),
			) );
			$this->add_post_taxonomy( array(
				'base'          => 'room-type',
				'slug'          => 'room-type',
				'singular_name' => esc_html__( 'Type', 'alloggio-core' ),
				'plural_name'   => esc_html__( 'Types', 'alloggio-core' ),
			) );
			$this->add_post_taxonomy( array(
				'base'          => 'amenity',
				'slug'          => 'amenity',
				'singular_name' => esc_html__( 'Amenity', 'alloggio-core' ),
				'plural_name'   => esc_html__( 'Amenities', 'alloggio-core' ),
			) );
		}
	}
}