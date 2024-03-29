<?php
$gallery = get_post_meta( get_the_ID(), 'qodef_room_single_gallery', true );

if ( ! empty( $gallery ) && count( explode( ',', $gallery ) ) > 1 && class_exists( 'AlloggioCoreImageGalleryShortcode' ) ) {
	$gallery_classes = array();
	
	$gallery_skin = get_post_meta( get_the_ID(), 'qodef_room_single_gallery_nav_skin', true );
	if ( ! empty( $gallery_skin ) ) {
		$gallery_classes[] = 'qodef-skin--' . $gallery_skin;
	}
	
	$slider_params                       = array();
	$slider_params['images']             = $gallery;
	$slider_params['behavior']           = 'slider';
	$slider_params['columns']            = 'auto';
	$slider_params['columns_responsive'] = 'custom';
	$slider_params['columns_1440']       = 'auto';
	$slider_params['columns_1366']       = 'auto';
	$slider_params['columns_1024']       = 'auto';
	$slider_params['columns_768']        = 'auto';
	$slider_params['columns_680']        = '1';
	$slider_params['columns_480']        = '1';
	$slider_params['space']              = 2;
	$slider_params['looped_slides']      = '';
	$slider_params['slider_pagination']  = 'no';
	
	?>
	<div class="qodef-m-slider <?php echo esc_attr( implode( ' ', $gallery_classes ) ); ?>">
		<?php echo AlloggioCoreImageGalleryShortcode::call_shortcode( $slider_params ); ?>
	</div>
	<?php
} else {
	$image_id = is_single() && ! empty( $gallery ) && count( explode( ',', $gallery ) ) == 1 ? intval( $gallery ) : '';
	
	alloggio_core_template_part( 'post-types/room', 'templates/parts/post-info/featured-image', '', array( 'image_id' => $image_id ) );
} ?>