<?php
$text          = get_post_meta( get_the_ID(), 'qodef_masonry_gallery_item_text', true );
$text_tag_meta = get_post_meta( get_the_ID(), 'qodef_masonry_gallery_item_text_tag', true );
$text_tag      = ! empty( $text_tag_meta ) ? $text_tag_meta : 'p';

if( ! empty ( $text ) ) { ?>
	<<?php echo esc_attr( $text_tag ); ?> itemprop="description" class="qodef-e-text"><?php echo qode_framework_wp_kses_html( 'content', $text ); ?></<?php echo esc_attr( $text_tag ); ?>>
<?php }