<?php
$link = get_post_meta( get_the_ID(), 'qodef_masonry_gallery_item_link', true );

if ( ! empty( $link ) ) {
	$link_target  = get_post_meta( get_the_ID(), 'qodef_masonry_gallery_item_link_target', true );
	?>
	<a itemprop="url" class="qodef-e-link" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $link_target ); ?>"></a>
<?php } ?>