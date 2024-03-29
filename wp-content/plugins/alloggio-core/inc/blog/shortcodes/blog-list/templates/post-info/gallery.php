<?php
$gallery_meta = get_post_meta( get_the_ID(), 'qodef_post_format_gallery_images', true );

if ( ! empty( $gallery_meta ) ) { ?>
	<div class="qodef-e-media-gallery qodef-swiper-container">
		<div class="swiper-wrapper">
			<?php
			$gallery_images      = explode( ',', $gallery_meta );
			$image_dimension     = isset( $image_dimension ) && ! empty( $image_dimension ) ? esc_attr( $image_dimension['size'] ) : 'full';
			$custom_image_width  = isset( $custom_image_width ) && $custom_image_width !== '' ? intval( $custom_image_width ) : 0;
			$custom_image_height = isset( $custom_image_height ) && $custom_image_height !== '' ? intval( $custom_image_height ) : 0;
			
			foreach ( $gallery_images as $image_id ) { ?>
				<div class="qodef-e-media-gallery-item swiper-slide">
					<?php if ( ! is_single() ) { ?>
						<a itemprop="url" href="<?php the_permalink(); ?>">
					<?php } ?>
						<?php echo alloggio_core_get_list_shortcode_item_image( $image_dimension, $image_id, $custom_image_width, $custom_image_height ); ?>
					<?php if ( ! is_single() ) { ?>
						</a>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
		<?php alloggio_core_template_part( 'content', 'templates/swiper-nav' ); ?>
	</div>
<?php } else {
	// Include featured image
	alloggio_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/image', '', $params );
} ?>