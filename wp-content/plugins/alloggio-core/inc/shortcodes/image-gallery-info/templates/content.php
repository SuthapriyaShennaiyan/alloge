<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<div class="qodef-m-inner">
		<div class="qodef-m-gallery">
			<?php
			$images = array();
			
			foreach ( $items as $item ) {
				if ( ! empty( $item['item_text'] ) && ! empty( $item['item_image'] ) ) {
					$images[] = $item['item_image'];
				}
			}
			
			if ( ! empty( $images ) ) {
				$gallery_params                      = array();
				$gallery_params['custom_class']      = 'qodef--watch-sliding';
				$gallery_params['images']            = implode( ',', $images );
				$gallery_params['behavior']          = 'slider';
				$gallery_params['columns']           = '1';
				$gallery_params['slider_navigation'] = 'no';
				$gallery_params['slider_autoplay']   = 'no';
				$gallery_params['slider_pagination'] = 'yes';
				
				echo AlloggioCoreImageGalleryShortcode::call_shortcode( $gallery_params );
			}
			?>
		</div>
		<div class="qodef-m-items">
			<?php alloggio_core_template_part( 'shortcodes/image-gallery-info', 'templates/parts/title', '', $params ); ?>
			<?php alloggio_core_template_part( 'shortcodes/image-gallery-info', 'templates/parts/subtitle', '', $params ); ?>
			<div class="qodef-m-text-items">
				<?php
				$index = 0;
				foreach ( $items as $item ) {
					if ( ! empty( $item['item_text'] ) && ! empty( $item['item_image'] ) ) {
						$item['custom_class'] = '';
						
						if ( $index === 0 ) {
							$item['custom_class'] = 'qodef--active';
						}
				
						alloggio_core_template_part( 'shortcodes/image-gallery-info', 'templates/parts/text', '', $item );
						
						$index++;
					}
				} ?>
			</div>
			<?php alloggio_core_template_part( 'shortcodes/image-gallery-info', 'templates/parts/button', '', $params ); ?>
		</div>
	</div>
</div>