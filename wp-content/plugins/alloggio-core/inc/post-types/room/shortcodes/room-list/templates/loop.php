<?php if ( $query_result->have_posts() ) {
	while ( $query_result->have_posts() ) : $query_result->the_post();
		$params['image_dimension'] = $this_shortcode->get_list_item_image_dimension( $params );
		$params['item_classes']    = $this_shortcode->get_item_classes( $params );
		
		alloggio_core_list_sc_template_part( 'post-types/room/shortcodes/room-list', 'layouts/' . $layout, get_post_format(), $params );
	endwhile; // End of the loop.
} else {
	// Include posts not found
	alloggio_core_template_part( 'post-types/room', 'templates/parts/posts-not-found' );
}

wp_reset_postdata();