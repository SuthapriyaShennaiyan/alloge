<div class="qodef-e-media">
	<?php switch ( get_post_format() ) {
		case 'gallery':
			alloggio_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/gallery', '', $params );
			break;
		case 'video':
			alloggio_core_theme_template_part( 'blog', 'templates/parts/post-format/video' );
			break;
		case 'audio':
			alloggio_core_theme_template_part( 'blog', 'templates/parts/post-format/audio' );
			break;
		default:
			alloggio_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/image', '', $params );
			break;
	} ?>
</div>