<div id="qodef-fullscreen-area">
	<?php if ( $fullscreen_menu_in_grid ) { ?>
		<div class="qodef-content-grid">
	<?php } ?>
		<?php
		$holder_classes = is_active_sidebar( 'qodef-fullscreen-menu-widget-area' ) ? 'qodef--has-widget' : '';
		?>
		<div id="qodef-fullscreen-area-inner" <?php qode_framework_class_attribute( $holder_classes ); ?>>
			<?php if ( has_nav_menu( 'fullscreen-menu-navigation' ) ) { ?>
				<nav class="qodef-fullscreen-menu">
					<?php wp_nav_menu(
						array(
							'theme_location' => 'fullscreen-menu-navigation',
							'container'         => '',
							'link_before'       => '<span class="qodef-menu-item-text">',
							'link_after'        => '</span>',
							'walker'         => new AlloggioCoreRootMainMenuWalker()
						)
					); ?>
				</nav>
			<?php } ?>
			<?php if ( is_active_sidebar( 'qodef-fullscreen-menu-widget-area' ) ) { ?>
				<div class="qodef-fullscreen-menu-widget">
					<?php dynamic_sidebar( 'qodef-fullscreen-menu-widget-area' ); ?>
				</div>
			<?php } ?>
		</div>
		
	<?php if ( $fullscreen_menu_in_grid ) { ?>
		</div>
	<?php } ?>
</div>