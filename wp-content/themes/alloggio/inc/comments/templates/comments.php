<div id="qodef-page-comments">
	<?php if ( have_comments() ) {
		$comments_number = get_comments_number();
		?>
		<div id="qodef-page-comments-list" class="qodef-m">
			<h3 class="qodef-m-title"><?php echo sprintf( _n( '%s Comment', '%s Comments', $comments_number, 'alloggio' ), '' ); ?></h3>
			<ul class="qodef-m-comments">
				<?php wp_list_comments( array_unique( array_merge( array( 'callback' => 'alloggio_get_comments_list_template' ), apply_filters( 'alloggio_filter_comments_list_template_callback', array() ) ) ) ); ?>
			</ul>

			<?php if ( get_comment_pages_count() > 1 ) { ?>
				<div class="qodef-m-pagination qodef--wp">
					<?php the_comments_pagination( array(
						'prev_text'          => alloggio_get_icon( 'arrow_carrot-left', 'elegant-icons', '&blacktriangleleft; '.esc_html__( 'Prev', 'alloggio' ) ),
						'next_text'          => alloggio_get_icon( 'arrow_carrot-right', 'elegant-icons', esc_html__( 'Next', 'alloggio' ).'  &blacktriangleright;' ),
						'before_page_number' => '0',
					) ); ?>
				</div>
			<?php } ?>
		</div>
	<?php } ?>
	<?php if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) { ?>
		<p class="qodef-page-comments-not-found"><?php esc_html_e( 'Comments are closed.', 'alloggio' ); ?></p>
	<?php } ?>

	<div id="qodef-page-comments-form">
        <?php comment_form( alloggio_get_comment_form_args() ); ?>
	</div>
</div>