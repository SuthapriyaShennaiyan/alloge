<?php
$text = get_post_meta( get_the_ID(), 'qodef_testimonials_text', true );
if( ! empty ( $text ) ) { ?>
	<p itemprop="description" class="qodef-e-text">
		<?php if ( $icon === 'text' ) {
			alloggio_core_list_sc_template_part( 'post-types/testimonials/shortcodes/testimonials-list', 'post-info/icon' );
		} ?>
		<?php echo esc_html( $text ); ?>
	</p>
<?php }