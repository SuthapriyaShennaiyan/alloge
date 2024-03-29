<?php if ( has_post_thumbnail() ) { ?>
	<div class="qodef-e-media-image">
		<?php the_post_thumbnail( $image_dimension['size'] ); ?>
	</div>
<?php } ?>