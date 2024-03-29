<?php
$info_items = get_post_meta( get_the_ID(), 'qodef_room_single_additional_info', true );

if ( ! empty( $info_items ) ) { ?>
	<div class="qodef-e-info-items">
		<?php foreach ( $info_items as $info_item ) {
			$title = $info_item['qodef_room_single_additional_info_title'];
			$text  = $info_item['qodef_room_single_additional_info_content'];
			
			if ( ! empty( $title ) ) { ?>
				<div class="qodef-e-info-item qodef-ei <?php echo str_replace( ' ', '-', mb_strtolower('qodef-info--' . $title ) ); ?>">
					<h4 class="qodef-ei-title"><?php echo esc_html( $title ); ?></h4>
					<?php if ( ! empty( $text ) ) { ?>
						<span class="qodef-ei-content"><?php echo qode_framework_wp_kses_html( 'content', $text ); ?></span>
					<?php } ?>
				</div>
			<?php } ?>
		<?php } ?>
	</div>
<?php } ?>