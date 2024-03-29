<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<div class="qodef-m-inner clear">
		<div class="qodef-m-content">
			<?php alloggio_core_template_part( 'post-types/restaurant-menu/shortcodes/restaurant-menu-info', 'templates/parts/availability', '', $params ) ?>
			<?php alloggio_core_template_part( 'post-types/restaurant-menu/shortcodes/restaurant-menu-info', 'templates/parts/title', '', $params ) ?>
			
			<?php
			// Include items
			alloggio_core_template_part( 'post-types/restaurant-menu/shortcodes/restaurant-menu-info', 'templates/loop', '', $params );
			?>
			
			<?php alloggio_core_template_part( 'post-types/restaurant-menu/shortcodes/restaurant-menu-info', 'templates/parts/button', '', $params ); ?>
		</div>
		<div class="qodef-m-media">
			<?php alloggio_core_template_part( 'post-types/restaurant-menu/shortcodes/restaurant-menu-info', 'templates/parts/image', '', $params ); ?>
		</div>
	</div>
</div>