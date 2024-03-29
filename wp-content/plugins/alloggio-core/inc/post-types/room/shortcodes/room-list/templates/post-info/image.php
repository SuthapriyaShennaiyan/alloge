<?php
$gallery             = get_post_meta( get_the_ID(), 'qodef_room_list_gallery', true );
$is_enabled          = get_post_meta( get_the_ID(), 'qodef_enable_room_list_gallery', true );
$image_dimension     = isset( $image_dimension ) && ! empty( $image_dimension ) ? esc_attr( $image_dimension['size'] ) : 'full';
$custom_image_width  = isset( $custom_image_width ) && $custom_image_width !== '' ? intval( $custom_image_width ) : 0;
$custom_image_height = isset( $custom_image_height ) && $custom_image_height !== '' ? intval( $custom_image_height ) : 0;

if ( $is_enabled === 'yes' && $behavior !== 'slider' && ! empty( $gallery ) && count( explode( ',', $gallery ) ) > 1 && class_exists( 'AlloggioCoreImageGalleryShortcode' ) ) {
	$slider_params                      = array();
	$slider_params['images']            = $gallery;
	$slider_params['behavior']          = 'slider';
	$slider_params['columns']           = '1';
	$slider_params['space']             = 'no';
	$slider_params['slider_pagination'] = 'no';
	
	if ( $image_dimension !== 'custom' ) {
		$slider_params['image_size'] = $image_dimension;
	} elseif ( $custom_image_width > 0 && $custom_image_height > 0 ) {
		$slider_params['image_size'] = $custom_image_width . 'x' . $custom_image_height;
	} else {
		$slider_params['image_size'] = 'full';
	}
	?>
	<div class="qodef-e-media-slider">
		<?php echo AlloggioCoreImageGalleryShortcode::call_shortcode( $slider_params ); ?>
	</div>
	<?php
} elseif ( has_post_thumbnail() ) {
	$attachment_id = get_post_thumbnail_id();
	$item_link     = isset( $query_options ) && ! empty( $query_options ) ? add_query_arg( array_map( 'urlencode', $query_options ), get_the_permalink() ) : get_the_permalink();
	?>
	<div class="qodef-e-media-image" data-swiper-parallax="27%">
		<a itemprop="url" href="<?php echo esc_url( $item_link ); ?>">
			<?php echo alloggio_core_get_list_shortcode_item_image( $image_dimension, $attachment_id, $custom_image_width , $custom_image_height ); ?>
		</a>
	</div>
<?php } ?>