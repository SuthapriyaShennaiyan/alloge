<?php
$item_id     = get_the_ID();
$price       = get_post_meta( $item_id, 'qodef_restaurant_menu_item_price', true );
$description = get_post_meta( $item_id, 'qodef_restaurant_menu_item_description', true );
$title_tag = isset( $title_tag ) && ! empty( $title_tag ) ? $title_tag : 'h4';
?>
<div <?php qode_framework_class_attribute( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<div class="qodef-e-heading">
			<<?php echo esc_attr( $title_tag ); ?> class="qodef-e-heading-title">
				<?php the_title(); ?>
			</<?php echo esc_attr( $title_tag ); ?>>
			<?php if ( ! empty( $price ) ) : ?>
				<div class="qodef-e-heading-line"></div>
				<h6 class="qodef-e-heading-price"><?php echo esc_html( $price ); ?></h6>
			<?php endif; ?>
		</div>
		
		<?php if ( ! empty ( $description ) ) : ?>
			<p class="qodef-e-description">
				<?php echo esc_html( $description ); ?>
			</p>
		<?php endif; ?>
	</div>
</div>

