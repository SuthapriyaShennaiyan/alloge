<?php
$single_gallery = get_post_meta( get_the_ID(), 'qodef_room_single_gallery', true );
$list_gallery   = get_post_meta( get_the_ID(), 'qodef_room_list_gallery', true );
$gallery        = ! empty( $list_gallery ) ? $list_gallery : $single_gallery;

if ( ! empty( $gallery ) && count( explode( ',', $gallery ) ) > 1 && class_exists( 'AlloggioCoreImageGalleryShortcode' ) ) {
	$slider_params                           = array();
	$slider_params['images']                 = $gallery;
	/*$slider_params['custom_class']           = 'qodef--swiper-parallax';*/
	$slider_params['behavior']               = 'slider';
	$slider_params['columns']                = '1';
	$slider_params['space']                  = 'no';
	$slider_params['slider_autoplay']        = 'yes';
	$slider_params['slider_pagination']      = 'no';
	$slider_params['slider_speed_animation'] = '1000';
	?>
	
	<div class="qodef-e-media-slider">
		<?php echo AlloggioCoreImageGalleryShortcode::call_shortcode( $slider_params ); ?>
	</div>
	<?php
} elseif ( has_post_thumbnail() ) { ?>
	<div class="qodef-e-media-image">
		<a itemprop="url" href="<?php the_permalink(); ?>">
			<?php the_post_thumbnail( 'full' ); ?>
		</a>
	</div>
<?php } ?>