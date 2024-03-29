<?php

if ( have_posts() ) {
	while ( have_posts() ) : the_post();
		
		// Hook to include additional content before post item
		do_action( 'alloggio_core_action_before_room_item' );
		
		$item_layout = apply_filters( 'alloggio_core_filter_room_single_layout', '' );
		
		// Include post item
		alloggio_core_template_part( 'post-types/room', 'variations/' . $item_layout . '/layout/' . $item_layout );
		
		// Hook to include additional content after post item
		do_action( 'alloggio_core_action_after_room_item' );
	
	endwhile; // End of the loop.
} else {
	// Include posts not found
	alloggio_core_template_part( 'post-types/room', 'templates/parts/posts-not-found' );
}

wp_reset_postdata();