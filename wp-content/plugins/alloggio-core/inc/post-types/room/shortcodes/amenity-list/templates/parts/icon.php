<?php
$term_svg_icon        = get_term_meta( $category_id, 'qodef_amenity_svg_icon', true );
$term_svg_custom_icon = get_term_meta( $category_id, 'qodef_amenity_custom_svg_icon', true );

if ( ! empty( $term_svg_icon ) || ! empty( $term_svg_custom_icon ) ) { ?>
	<span class="qodef-e-icon">
		<?php if ( ! empty( $term_svg_icon ) ) {
			alloggio_core_template_part( 'post-types/room', 'templates/parts/icons/' . esc_attr( $term_svg_icon ), '', array( 'icon_class' => esc_attr( $term_svg_icon ) ) );
		} elseif ( ! empty( $term_svg_custom_icon ) ) {
			echo qode_framework_wp_kses_html( 'html', $term_svg_custom_icon );
		} ?>
	</span>
<?php } ?>
