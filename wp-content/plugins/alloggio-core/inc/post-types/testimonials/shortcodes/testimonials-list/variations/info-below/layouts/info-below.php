<div <?php qode_framework_class_attribute( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<?php if ( ( $show_image !== 'no' ) && ( $behavior !== 'slider' ) ) {
			alloggio_core_list_sc_template_part( 'post-types/testimonials/shortcodes/testimonials-list', 'post-info/image', '', $params );
		} ?>
		<div class="qodef-e-content">
			<?php if ( $icon === 'title' ) {
				alloggio_core_list_sc_template_part( 'post-types/testimonials/shortcodes/testimonials-list', 'post-info/icon' );
			} ?>
			<?php alloggio_core_list_sc_template_part( 'post-types/testimonials/shortcodes/testimonials-list', 'post-info/title', '', $params ); ?>
			<?php alloggio_core_list_sc_template_part( 'post-types/testimonials/shortcodes/testimonials-list', 'post-info/text', '', $params ); ?>
			<?php alloggio_core_list_sc_template_part( 'post-types/testimonials/shortcodes/testimonials-list', 'post-info/author', '', $params ); ?>
		</div>
	</div>
</div>