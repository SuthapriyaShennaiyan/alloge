<?php
$styles = array();
if ( ! empty( $boxed_item_bottom_margin ) ) {
	$margin_bottom = qode_framework_string_ends_with_space_units( $boxed_item_bottom_margin ) ? $boxed_item_bottom_margin : intval( $boxed_item_bottom_margin ) . 'px';
	
	$styles[] = 'margin-bottom:' . $margin_bottom;
}
?>
<article <?php qode_framework_class_attribute( $item_classes ); ?> <?php qode_framework_inline_style( $styles ); ?>>
	<div class="qodef-e-inner">
		<div class="qodef-e-media">
			<div class="qodef-e-img-holder">
				<?php alloggio_core_list_sc_template_part( 'post-types/room/shortcodes/room-list', 'post-info/image', '', $params ); ?>
			</div>
		</div>
		<div class="qodef-e-content">
			<div class="qodef-e-heading">
				<?php alloggio_core_list_sc_template_part( 'post-types/room/shortcodes/room-list', 'post-info/title', '', $params ); ?>
				<?php alloggio_core_list_sc_template_part( 'post-types/room/shortcodes/room-list', 'post-info/price' ); ?>
			</div>
			<div class="qodef-e-info-items">
				<?php alloggio_core_list_sc_template_part( 'post-types/room/shortcodes/room-list', 'post-info/price' ); ?>
				<?php alloggio_core_list_sc_template_part( 'post-types/room/shortcodes/room-list', 'post-info/room-size' ); ?>
				<?php alloggio_core_list_sc_template_part( 'post-types/room/shortcodes/room-list', 'post-info/capacity' ); ?>
			</div>
			<?php alloggio_core_list_sc_template_part( 'post-types/room/shortcodes/room-list', 'post-info/excerpt', '', $params ); ?>
			<?php alloggio_core_list_sc_template_part( 'post-types/room/shortcodes/room-list', 'post-info/button', '', $params ); ?>
		</div>
	</div>
</article>