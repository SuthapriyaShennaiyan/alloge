<div <?php qode_framework_class_attribute( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<?php alloggio_core_list_sc_template_part( 'post-types/masonry-gallery/shortcodes/masonry-gallery-list', 'post-info/image', '', $params ); ?>
		<div class="qodef-e-content">
			<?php alloggio_core_list_sc_template_part( 'post-types/masonry-gallery/shortcodes/masonry-gallery-list', 'post-info/title', '', $params ); ?>
			<?php alloggio_core_list_sc_template_part( 'post-types/masonry-gallery/shortcodes/masonry-gallery-list', 'post-info/text', '', $params ); ?>
			<?php alloggio_core_list_sc_template_part( 'post-types/masonry-gallery/shortcodes/masonry-gallery-list', 'post-info/button', '', $params ); ?>
		</div>
		<?php alloggio_core_list_sc_template_part( 'post-types/masonry-gallery/shortcodes/masonry-gallery-list', 'post-info/link', '', $params ); ?>
	</div>
</div>