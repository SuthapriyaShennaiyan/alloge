<div class="qodef-e-media">
	<?php switch ( get_post_format() ) {
		case 'gallery':
			alloggio_template_part( 'blog', 'templates/parts/post-format/gallery' );
			break;
		case 'video':
			alloggio_template_part( 'blog', 'templates/parts/post-format/video' );
			break;
		case 'audio':
			alloggio_template_part( 'blog', 'templates/parts/post-format/audio' );
			break;
		default:
			alloggio_template_part( 'blog', 'templates/parts/post-info/image' );
			break;
	} ?>
</div>