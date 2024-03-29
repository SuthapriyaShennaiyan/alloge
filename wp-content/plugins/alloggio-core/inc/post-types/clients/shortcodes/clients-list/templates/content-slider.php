<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_attr( $slider_attr, 'data-options' ); ?>>
	<div class="swiper-wrapper">
		<?php
		// Include items
		alloggio_core_template_part( 'post-types/clients/shortcodes/clients-list', 'templates/loop', '', $params );
		?>
	</div>
	<?php if ( $slider_navigation !== 'no' ) {
		alloggio_core_template_part( 'content', 'templates/swiper-nav' );
	} ?>
	<?php if ( $slider_pagination !== 'no' ) {
		alloggio_core_template_part( 'content', 'templates/swiper-pag' );
	} ?>
</div>