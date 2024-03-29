<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<?php alloggio_core_template_part( 'shortcodes/info-card', 'templates/parts/image', '', $params ) ?>
	<div class="qodef-m-content" <?php qode_framework_inline_style( $content_styles ); ?>>
		<?php alloggio_core_template_part( 'shortcodes/info-card', 'templates/parts/title', '', $params ) ?>
		<?php alloggio_core_template_part( 'shortcodes/info-card', 'templates/parts/subtitle', '', $params ) ?>
		<?php alloggio_core_template_part( 'shortcodes/info-card', 'templates/parts/text', '', $params ) ?>
		<?php alloggio_core_template_part( 'shortcodes/info-card', 'templates/parts/button', '', $params ) ?>
		<?php alloggio_core_template_part( 'shortcodes/info-card', 'templates/parts/content-image', '', $params ) ?>
	</div>
</div>