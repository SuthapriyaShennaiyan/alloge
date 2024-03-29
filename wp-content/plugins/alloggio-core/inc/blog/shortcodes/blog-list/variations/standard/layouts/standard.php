<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<?php
		// Include post media
		alloggio_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/media', '', $params );
		?>
		<div class="qodef-e-content">
			<div class="qodef-e-info qodef-info--top">
				<?php
				// Include post date info
				alloggio_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/date', '', $params );
				
				// Include post author info
				if ( $enable_author_info === 'yes' ) {
					alloggio_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/author', '', $params );
				}
				?>
			</div>
			<div class="qodef-e-text">
				<?php
				// Include post title
				alloggio_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/title', '', $params );
				
				// Include post excerpt
				alloggio_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/excerpt', '', $params );
				
				// Hook to include additional content after blog single content
				do_action( 'alloggio_action_after_blog_single_content' );
				?>
			</div>
			<?php if ($enable_read_more === 'yes') { ?>
				<div class="qodef-e-info qodef-info--bottom">
					<?php alloggio_core_theme_template_part( 'blog', 'templates/parts/post-info/read-more' ); ?>
				</div>
			<?php } ?>
		</div>
	</div>
</article>