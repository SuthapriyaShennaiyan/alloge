<?php
// Hook to include additional content before post gallery
do_action( 'alloggio_core_action_before_room_post_gallery' );

alloggio_core_template_part( 'post-types/room', 'templates/parts/post-info/gallery' );

// Hook to include additional content after post gallery
do_action( 'alloggio_core_action_after_room_post_gallery' );
?>
<div class="qodef-m-content qodef-content-grid">
	<?php
	// Hook to include additional content before post content
	do_action( 'alloggio_core_action_before_room_post_content' ); ?>
	<div class="qodef-grid qodef-layout--template <?php echo alloggio_core_get_grid_gutter_classes(); ?>">
		<div class="qodef-grid-inner clear">
			<div class="qodef-grid-item qodef-page-content-section qodef-col--8">
				<article <?php post_class( 'qodef-room-item qodef-e' ); ?>>
					<div class="qodef-e-inner">
						<?php alloggio_core_template_part( 'post-types/room', 'templates/parts/post-info/title' ); ?>
						<?php alloggio_core_template_part( 'post-types/room', 'templates/parts/post-info/content' ); ?>
						<?php alloggio_core_template_part( 'post-types/room', 'templates/parts/post-info/amenity' ); ?>
						<?php alloggio_core_template_part( 'post-types/room', 'templates/parts/post-info/info-items' ); ?>
						<?php alloggio_core_template_part( 'post-types/room', 'templates/parts/post-info/availability' ); ?>
						<?php alloggio_core_template_part( 'post-types/room', 'templates/parts/post-info/seasonal-items' ); ?>
						<?php alloggio_core_template_part( 'post-types/room', 'templates/parts/post-info/location' ); ?>
					</div>
				</article>
			</div>
			<div class="qodef-grid-item qodef-page-sidebar-section qodef-col--4">
				<?php alloggio_core_template_part( 'post-types/room', 'templates/parts/post-info/reservation' ); ?>
				<?php alloggio_core_template_part( 'post-types/room', 'templates/parts/post-info/weather' ); ?>
				<?php alloggio_core_template_part( 'post-types/room', 'templates/parts/post-info/ads' ); ?>
			</div>
		</div>
	</div>
</div>