<?php

if ( ! function_exists( 'alloggio_core_include_room_single_related_posts_template' ) ) {
	/**
	 * Function which includes additional module on single room page
	 */
	function alloggio_core_include_room_single_related_posts_template() {
		alloggio_core_template_part( 'post-types/room', 'templates/single/related-posts/templates/related-posts' );
	}
	
	add_action( 'alloggio_core_action_after_room_single_content_holder', 'alloggio_core_include_room_single_related_posts_template' );
}

if ( ! function_exists( 'alloggio_core_get_room_single_post_taxonomies' ) ) {
	/**
	 * Function that return single post taxonomies list
	 *
	 * @param int $post_id
	 *
	 * @return array
	 */
	function alloggio_core_get_room_single_post_taxonomies( $post_id ) {
		$options = array();
		
		if ( ! empty( $post_id ) ) {
			$options['location']  = wp_get_post_terms( $post_id, 'location' );
			$options['room-type'] = wp_get_post_terms( $post_id, 'room-type' );
		}
		
		return $options;
	}
}