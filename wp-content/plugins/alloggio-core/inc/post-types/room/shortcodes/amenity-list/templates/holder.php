<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<div class="qodef-grid-inner">
		<?php if ( ! empty( $taxonomy_items ) ) {
			foreach ( $taxonomy_items as $taxonomy_item ) {
				$params['category_id']   = $taxonomy_item->term_id;
				$params['category_name'] = $taxonomy_item->name;
				
				alloggio_core_template_part( 'post-types/room/shortcodes/amenity-list', 'templates/item', '', $params );
			}
		} else {
			// Include global posts not found
			alloggio_core_theme_template_part( 'content', 'templates/parts/posts-not-found' );
		} ?>
	</div>
</div>