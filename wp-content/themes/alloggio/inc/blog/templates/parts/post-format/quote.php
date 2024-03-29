<?php
$quote_meta = get_post_meta( get_the_ID(), 'qodef_post_format_quote_text', true );
$quote_text = ! empty( $quote_meta ) ? $quote_meta : get_the_title();

if ( ! empty( $quote_text ) ) {
	$quote_author     = get_post_meta( get_the_ID(), 'qodef_post_format_quote_author', true );
	$title_tag        = isset( $title_tag ) && ! empty( $title_tag ) ? $title_tag : 'h4';
	$author_title_tag = isset( $author_title_tag ) && ! empty( $author_title_tag ) ? $author_title_tag : 'h5';
	?>
	<div class="qodef-e-quote">
		<span class="qodef-e-mark">
			<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 75.3 63.9" xml:space="preserve"><g><path d="M34.8,40.5c0,12.6-10.3,22.9-22.9,22.9H9.1c-1.6,0-2.9-1.3-2.9-2.9v-5.7c0-1.6,1.3-2.9,2.9-2.9h2.9c6.3,0,11.4-5.1,11.4-11.4v-1.4c0-2.4-1.9-4.3-4.3-4.3h-10c-4.7,0-8.6-3.8-8.6-8.6V9.1c0-4.7,3.8-8.6,8.6-8.6h17.1c4.7,0,8.6,3.8,8.6,8.6V40.5z M74.8,40.5c0,12.6-10.3,22.9-22.9,22.9h-2.9c-1.6,0-2.9-1.3-2.9-2.9v-5.7c0-1.6,1.3-2.9,2.9-2.9h2.9c6.3,0,11.4-5.1,11.4-11.4v-1.4c0-2.4-1.9-4.3-4.3-4.3h-10c-4.7,0-8.6-3.8-8.6-8.6V9.1c0-4.7,3.8-8.6,8.6-8.6h17.1c4.7,0,8.6,3.8,8.6,8.6V40.5z"/></g></svg>
		</span>
		<<?php echo esc_attr( $title_tag ); ?> class="qodef-e-quote-text"><?php echo esc_html( $quote_text ); ?></<?php echo esc_attr( $title_tag ); ?>>
		<?php if ( ! empty( $quote_author ) ) { ?>
			<<?php echo esc_attr( $author_title_tag ); ?> class="qodef-e-quote-author"><?php echo esc_html( $quote_author ); ?></<?php echo esc_attr( $author_title_tag ); ?>>
		<?php } ?>
		<?php if ( ! is_single() ) { ?>
			<a itemprop="url" class="qodef-e-quote-url" href="<?php the_permalink(); ?>"></a>
		<?php } ?>
	</div>
<?php } ?>