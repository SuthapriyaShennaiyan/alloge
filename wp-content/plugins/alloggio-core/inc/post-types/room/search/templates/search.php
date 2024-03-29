<div class="qodef-grid-item qodef-page-content-section qodef-col--8">
	<?php
	// Include posts loop
	alloggio_core_generate_room_archive_with_shortcode( '', '', $params );
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