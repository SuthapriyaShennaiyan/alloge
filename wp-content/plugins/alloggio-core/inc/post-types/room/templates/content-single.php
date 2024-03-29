<?php
// Hook to include additional content before page content holder
do_action( 'alloggio_core_action_before_room_single_content_holder' );
?>
<main id="qodef-page-content">
	<?php
	// Include room template
	alloggio_core_template_part( 'post-types/room', 'templates/room' );
	?>
</main>
<?php
// Hook to include additional content after main page content holder
do_action( 'alloggio_core_action_after_room_single_content_holder' );
?>