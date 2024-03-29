<?php if ( alloggio_is_footer_top_area_enabled() ) { ?>
	<div id="qodef-page-footer-top-area">
		<div id="qodef-page-footer-top-area-inner" class="<?php echo esc_attr( alloggio_get_footer_top_area_classes() ); ?>">
			<div class="<?php echo esc_attr( alloggio_get_footer_top_area_columns_classes() ); ?>">
				<div class="qodef-grid-inner clear">
					<?php for ( $i = 1; $i <= intval( alloggio_get_page_footer_sidebars_config_by_key( 'footer_top_sidebars_number' ) ); $i ++ ) { ?>
						<div class="qodef-grid-item <?php echo esc_attr( alloggio_get_footer_top_area_column_item_classes( $i ) ); ?>">
							<?php alloggio_get_footer_widget_area( 'top', $i ); ?>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>
<?php } ?>