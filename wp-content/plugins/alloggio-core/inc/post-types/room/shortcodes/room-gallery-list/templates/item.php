<article <?php qode_framework_class_attribute( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<div class="qodef-e-media">
			<?php alloggio_core_list_sc_template_part( 'post-types/room/shortcodes/room-gallery-list', 'post-info/gallery', '', $params ); ?>
		</div>
		<div class="qodef-e-content">
			<?php alloggio_core_list_sc_template_part( 'post-types/room/shortcodes/room-gallery-list', 'post-info/price' ); ?>
			<?php alloggio_core_list_sc_template_part( 'post-types/room/shortcodes/room-gallery-list', 'post-info/title', '', $params ); ?>
			<?php alloggio_core_list_sc_template_part( 'post-types/room/shortcodes/room-gallery-list', 'post-info/amenity' ); ?>
			<?php alloggio_core_list_sc_template_part( 'post-types/room/shortcodes/room-gallery-list', 'post-info/button', '', $params ); ?>
		</div>
	</div>
</article>