<article <?php qode_framework_class_attribute( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<div class="qodef-e-media">
			<?php alloggio_core_list_sc_template_part( 'post-types/room/shortcodes/room-list', 'post-info/image', '', $params ); ?>
		</div>
		<div class="qodef-e-content" data-swiper-parallax-duration="600" data-swiper-parallax-opacity="0">
			<?php alloggio_core_list_sc_template_part( 'post-types/room/shortcodes/room-list', 'post-info/title', '', $params ); ?>
			<div class="qodef-e-info-items">
				<?php alloggio_core_list_sc_template_part( 'post-types/room/shortcodes/room-list', 'post-info/room-size' ); ?>
				<?php alloggio_core_list_sc_template_part( 'post-types/room/shortcodes/room-list', 'post-info/capacity' ); ?>
				<?php alloggio_core_list_sc_template_part( 'post-types/room/shortcodes/room-list', 'post-info/price' ); ?>
			</div>
			<?php alloggio_core_list_sc_template_part( 'post-types/room/shortcodes/room-list', 'post-info/excerpt', '', $params ); ?>
			<?php alloggio_core_list_sc_template_part( 'post-types/room/shortcodes/room-list', 'post-info/link', '', $params ); ?>
		</div>
	</div>
</article>
