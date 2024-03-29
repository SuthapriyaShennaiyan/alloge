<?php if ( $query_result->have_posts() ) {
	while ( $query_result->have_posts() ) : $query_result->the_post();
		
		alloggio_core_template_part( 'post-types/restaurant-menu/shortcodes/restaurant-menu-info', 'templates/item', '', '' );
	endwhile; // End of the loop.
} else {
	// Include posts not found
	alloggio_core_theme_template_part( 'content', 'templates/parts/posts-not-found' );
}

wp_reset_postdata();