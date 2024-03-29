<?php
if ( $query_result->have_posts() ) {
	while ( $query_result->have_posts() ) : $query_result->the_post();
		$params['item_classes'] = $this_shortcode->get_item_classes( $params );
		alloggio_core_template_part( 'post-types/room/shortcodes/room-gallery-list', 'templates/item', '', $params );
	endwhile; // End of the loop.
} else {
	// Include posts not found
	alloggio_core_template_part( 'post-types/room', 'templates/parts/posts-not-found' );
}

wp_reset_postdata();