<?php
$post_id       = get_the_ID();
$is_enabled    = alloggio_core_get_post_value_through_levels( 'qodef_blog_single_enable_related_posts' );
$related_posts = alloggio_core_get_custom_post_type_related_posts( $post_id, alloggio_core_get_blog_single_post_taxonomies( $post_id ) );

if ( $is_enabled === 'yes' && ! empty( $related_posts ) && class_exists( 'AlloggioCoreBlogListShortcode' ) ) { ?>
	<div id="qodef-related-posts">
		<h3 class="qodef-related-posts-title"><?php echo esc_html__('Related Articles', 'alloggio-core') ?></h3>
		<?php
		$params = apply_filters( 'alloggio_core_filter_blog_single_related_posts_params', array(
			'custom_class'        => 'qodef--no-bottom-space',
			'columns'             => '2',
			'posts_per_page'      => 2,
			'images_proportion'   => 'custom',
			'custom_image_width'  => 405,
			'custom_image_height' => 285,
			'additional_params'   => 'id',
			'post_ids'            => $related_posts['items'],
			'title_tag'           => 'h4',
			'excerpt_length'      => '0',
			'layout'              => 'standard',
			'enable_read_more'    => 'no'
		) );
		
		echo AlloggioCoreBlogListShortcode::call_shortcode( $params ); ?>
	</div>
<?php } ?>