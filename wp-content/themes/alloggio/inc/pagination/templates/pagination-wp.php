<?php if ( get_the_posts_pagination() !== '' ): ?>

    <div class="qodef-m-pagination qodef--wp">
		<?php
		// Load posts pagination (in order to override template use navigation_markup_template filter hook)
		the_posts_pagination( array(
            'prev_text'          => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 6.9 12.5" xml:space="preserve"><polyline points="6.3,0.6 0.6,6.3 6.3,11.9 "/></svg>',
            'next_text'          => '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 6.9 12.5" xml:space="preserve"><polyline points="0.6,0.6 6.3,6.3 0.6,11.9 "/></svg>',
            'before_page_number' => '',
		) ); ?>
    </div>

<?php endif; ?>