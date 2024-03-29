<?php
$term_values = get_the_terms( get_the_ID(), 'amenity' );

if ( ! empty( $term_values ) && ! is_wp_error( $term_values ) ) { ?>
	<div class="qodef-e-amenity-items">
		<?php foreach ( $term_values as $term_value ) { ?>
			<div class="qodef-e-amenity-item qodef-ei"><?php echo esc_html( $term_value->name ); ?></div>
		<?php } ?>
	</div>
<?php }