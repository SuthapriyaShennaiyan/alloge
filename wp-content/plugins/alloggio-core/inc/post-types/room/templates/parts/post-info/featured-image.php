<?php
$is_single = is_single();
$image_id  = isset( $image_id ) && ! empty( $image_id ) ? $image_id : get_post_thumbnail_id();

if ( has_post_thumbnail() ) {
	$image_class = $is_single ? 'qodef-m-image' : 'qodef-e-image';
	?>
	<div class="<?php echo esc_attr( $image_class ); ?>">
		<?php if ( ! $is_single ) { ?>
			<a itemprop="url" href="<?php the_permalink(); ?>">
		<?php } ?>
			<?php echo wp_get_attachment_image( $image_id, 'full' ); ?>
		<?php if ( ! $is_single ) { ?>
			</a>
		<?php } ?>
	</div>
<?php } ?>