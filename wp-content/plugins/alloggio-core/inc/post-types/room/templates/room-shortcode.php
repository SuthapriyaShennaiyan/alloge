<div class="qodef-grid-item qodef-page-content-section qodef-col--8">
	<?php
		$queried_tax = get_queried_object();
		$tax         = ! empty( $queried_tax->taxonomy ) ? $queried_tax->taxonomy : '';
		$tax_slug    = ! empty( $queried_tax->slug ) ? $queried_tax->slug : '';

		alloggio_core_generate_room_archive_with_shortcode( $tax, $tax_slug, alloggio_core_get_room_archive_search_arguments() );
	?>
</div>
<div class="qodef-grid-item qodef-page-sidebar-section qodef-col--4">
	<aside id="qodef-room-list-sidebar">
		<div id="qodef-room-sticky-widget"></div>
		<?php
		// Include page reservation sidebar
		$params = array(
			'layout' => 'vertical',
		);
		
		echo AlloggioCoreRoomReservationFilterShortcode::call_shortcode( $params );
		?>
	</aside>
</div>