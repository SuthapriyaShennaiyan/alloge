<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_attr( $slider_attr, 'data-options' ); ?>>
	<div class="swiper-wrapper">
		<?php foreach ( $items as $item ) {
		
			if ( empty( $item['item_image'] ) ) {
				continue;
			}
			
			$image_original = wp_get_attachment_image_src( $item['item_image'], 'full' );
			$item['url']    = is_array( $image_original ) ? $image_original[0] : $image_original;
			$item['alt']    = get_post_meta( $item['item_image'], '_wp_attachment_image_alt', true );
			?>
			<div class="qodef-m-item swiper-slide">
				<?php if ( $item['item_link'] !== '' ){ ?>
					<a href="<?php echo esc_url( $item['item_link'] ) ?>" target="<?php echo esc_attr( $link_target ) ?>">
				<?php } ?>
					<div class="qodef-m-image-holder"><div class="qodef-m-image">
						<img src="<?php echo esc_url( $item['url'] ); ?>" alt="<?php echo esc_attr( $item['alt'] ); ?>"/>
					</div></div>
				<?php if ( $item['item_link'] !== '' ){ ?>
					</a>
				<?php } ?>
				<?php if ( ! empty( $item['item_title'] ) ) { ?>
					<<?php echo esc_attr( $title_tag ); ?> class="qodef-m-title"><?php echo qode_framework_wp_kses_html( 'content', $item['item_title'] ); ?></<?php echo esc_attr( $title_tag ); ?>>
				<?php } ?>
				<?php if ( ! empty( $item['item_subtitle'] ) ) { ?>
					<span class="qodef-m-subtitle"><?php echo qode_framework_wp_kses_html( 'content', $item['item_subtitle'] ); ?></span>
				<?php }	?>
			</div>
		<?php } ?>
	</div>
	<?php if ( $slider_navigation !== 'no' && $has_title ) { ?>
		<div class="swiper-navigation">
			<?php alloggio_core_template_part( 'content', 'templates/swiper-nav' ); ?>
		</div>
	<?php } ?>
	<?php if ( ! $has_title ) {
		alloggio_core_template_part( 'content', 'templates/swiper-pag' );
	} ?>
</div>