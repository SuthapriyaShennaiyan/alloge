<?php
$link_url_meta  = get_post_meta( get_the_ID(), 'qodef_post_format_link', true );
$link_url       = ! empty( $link_url_meta ) ? $link_url_meta : get_the_permalink();
$link_text_meta = get_post_meta( get_the_ID(), 'qodef_post_format_link_text', true );

if ( ! empty( $link_url ) ) {
	$link_text = ! empty( $link_text_meta ) ? $link_text_meta : get_the_title();
	$title_tag = isset( $title_tag ) && ! empty( $title_tag ) ? $title_tag : 'h4';
	?>
	<div class="qodef-e-link">
		<span class="qodef-e-mark">
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 73.9 73.9" xml:space="preserve"><g><path d="M69.6,63.1L63,69.7c-2.4,2.4-5.7,3.7-9.1,3.7c-3.4,0-6.7-1.3-9.1-3.8l-9.2-9.2c-2.4-2.4-3.7-5.7-3.7-9.1c0-3.5,1.4-6.9,3.9-9.3L31.9,38c-2.5,2.5-5.8,3.9-9.3,3.9c-3.4,0-6.7-1.3-9.1-3.8l-9.3-9.3c-2.5-2.5-3.8-5.7-3.8-9.1c0-3.4,1.4-6.7,3.8-9.1l6.6-6.5c2.4-2.4,5.7-3.7,9.1-3.7c3.4,0,6.7,1.3,9.1,3.8l9.2,9.2c2.4,2.4,3.7,5.7,3.7,9.1c0,3.5-1.4,6.9-3.9,9.3l3.9,3.9c2.5-2.5,5.8-3.9,9.3-3.9c3.4,0,6.7,1.3,9.1,3.8l9.3,9.3c2.5,2.5,3.8,5.7,3.8,9.1C73.4,57.5,72,60.8,69.6,63.1z M32.2,19.6L23,10.3c-0.8-0.8-1.9-1.3-3-1.3s-2.2,0.4-3,1.2l-6.6,6.5c-0.8,0.8-1.3,1.9-1.3,3c0,1.2,0.4,2.2,1.3,3l9.3,9.3c0.8,0.8,1.9,1.2,3,1.2c1.3,0,2.3-0.4,3.2-1.4c-1.5-1.5-3.2-2.7-3.2-5c0-2.4,1.9-4.3,4.3-4.3c2.3,0,3.5,1.7,5,3.2c0.9-0.9,1.5-1.9,1.5-3.3C33.4,21.5,33,20.4,32.2,19.6z M63.5,51l-9.3-9.3c-0.8-0.8-1.9-1.3-3-1.3c-1.3,0-2.3,0.5-3.2,1.4c1.5,1.5,3.2,2.7,3.2,5c0,2.4-1.9,4.3-4.3,4.3c-2.3,0-3.5-1.7-5-3.2c-0.9,0.9-1.5,1.9-1.5,3.3c0,1.1,0.4,2.2,1.3,3l9.2,9.2c0.8,0.8,1.9,1.2,3,1.2s2.2-0.4,3-1.2l6.6-6.5c0.8-0.8,1.3-1.9,1.3-3C64.8,52.9,64.3,51.8,63.5,51z"/></g></svg>
		</span>
		<<?php echo esc_attr( $title_tag ); ?> class="qodef-e-link-text"><?php echo esc_html( $link_text ); ?></<?php echo esc_attr( $title_tag ); ?>>
		<a itemprop="url" class="qodef-e-link-url" href="<?php echo esc_url( $link_url ); ?>" target="_blank"></a>
	</div>
<?php } ?>