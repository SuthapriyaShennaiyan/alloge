<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<?php alloggio_core_template_part( 'shortcodes/banner', 'templates/parts/image', '', $params ) ?>
	<div class="qodef-m-content">
		<div class="qodef-m-content-inner" <?php qode_framework_inline_style( $holder_styles ); ?>>
			<div class="qodef-m-content-inner-background" <?php qode_framework_inline_style( $inner_holder_styles ); ?>></div>
			<div class="qodef-m-content-inner-holder">
				<?php alloggio_core_template_part( 'shortcodes/banner', 'templates/parts/title', '', $params ) ?>
				<?php alloggio_core_template_part( 'shortcodes/banner', 'templates/parts/text', '', $params ) ?>
				<?php alloggio_core_template_part( 'shortcodes/banner', 'templates/parts/button', '', $params ) ?>
				<?php alloggio_core_template_part( 'shortcodes/banner', 'templates/parts/link', '', $params ) ?>
			</div>
			<?php alloggio_core_template_part( 'shortcodes/banner', 'templates/parts/link', '', $params ) ?>
		</div>
	</div>
</div>
