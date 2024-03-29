<?php if ( isset( $query_result ) && intval( $query_result->max_num_pages ) > 1 ) { ?>
	<div class="qodef-m-pagination qodef--load-more" <?php echo alloggio_is_installed( 'framework' ) ? qode_framework_get_inline_style( $pagination_type_load_more_top_margin ) : ''; ?>>
		<div class="qodef-m-pagination-inner">
			<?php
			$button_params = array(
				'custom_class'  => 'qodef-load-more-button',
				'button_layout' => 'filled',
				'link'          => '#',
				'text'          => esc_html__( 'Load More', 'alloggio' ),
			);
			
			alloggio_render_button_element( $button_params ); ?>
		</div>
	</div>
	<?php
	// Include loading spinner
	qode_framework_svg_icon( 'spinner', 'qodef-loading-spinner' ); ?>
<?php } ?>