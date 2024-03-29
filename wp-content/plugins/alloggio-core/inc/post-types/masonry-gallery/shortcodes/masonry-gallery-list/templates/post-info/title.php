<?php
$title_tag_meta = get_post_meta( get_the_ID(), 'qodef_masonry_gallery_item_title_tag', true );
$title_tag      = ! empty( $title_tag_meta ) ? $title_tag_meta : 'h4';
?>
<<?php echo esc_attr( $title_tag ); ?> itemprop="name" class="qodef-e-title entry-title"><?php the_title(); ?></<?php echo esc_attr( $title_tag ); ?>>