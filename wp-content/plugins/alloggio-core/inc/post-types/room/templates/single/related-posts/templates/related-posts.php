<?php
$post_id       = get_the_ID();
$is_enabled    = alloggio_core_get_post_value_through_levels( 'qodef_room_single_enable_related_posts' );
$related_posts = alloggio_core_get_custom_post_type_related_posts( $post_id, alloggio_core_get_room_single_post_taxonomies( $post_id ) );

if ( $is_enabled === 'yes' && ! empty( $related_posts ) && class_exists( 'AlloggioCoreRoomListShortcode' ) ) { ?>
	<div id="qodef-room-related-items" class="qodef-content-grid qodef-m">
		<h3 class="qodef-m-title"><?php esc_html_e( 'Related rooms', 'alloggio-core' ); ?></h3>
		<?php
		$params = apply_filters( 'alloggio_core_filter_room_single_related_posts_params', array(
			'custom_class'      => 'qodef-m-related-posts qodef--no-bottom-space',
			'columns'           => '3',
			'posts_per_page'    => 3,
			'additional_params' => 'id',
			'post_ids'          => $related_posts['items'],
			'layout'            => 'simple',
			'title_tag'         => 'h3',
			'excerpt_length'    => '153'
		) );
		
		echo AlloggioCoreRoomListShortcode::call_shortcode( $params ); ?>
	</div>
<?php } ?>