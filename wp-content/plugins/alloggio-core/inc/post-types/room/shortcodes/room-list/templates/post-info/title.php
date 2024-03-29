<?php
$title_tag = isset( $title_tag ) && ! empty( $title_tag ) ? $title_tag : 'h2';
$item_link = isset( $query_options ) && ! empty( $query_options ) ? add_query_arg( array_map( 'urlencode', $query_options ), get_the_permalink() ) : get_the_permalink();
?>
<<?php echo esc_attr( $title_tag ); ?> itemprop="name" class="qodef-e-title entry-title" <?php qode_framework_inline_style( $this_shortcode->get_title_styles( $params ) ); ?>>
	<a itemprop="url" href="<?php echo esc_url( $item_link ); ?>">
		<?php the_title(); ?>
	</a>
</<?php echo esc_attr( $title_tag ); ?>>