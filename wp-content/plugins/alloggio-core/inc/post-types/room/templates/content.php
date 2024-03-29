<?php
// Hook to include additional content before page content holder
do_action( 'alloggio_core_action_before_room_content_holder' );
?>
<main id="qodef-page-content" class="qodef-grid qodef-layout--template <?php echo alloggio_core_get_grid_gutter_classes(); ?>">
	<div class="qodef-grid-inner clear">
		<?php
		// Include room template
		$content = isset( $content ) ? $content : '';
		alloggio_core_template_part( 'post-types/room', 'templates/room', $content );
		?>
	</div>
</main>
<?php
// Hook to include additional content after main page content holder
do_action( 'alloggio_core_action_after_room_content_holder' );
?>