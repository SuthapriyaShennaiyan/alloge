<?php
// Unique ID for search form fields
$qodef_unique_id = uniqid( 'qodef-search-form-' );
?>
<form role="search" method="get" class="qodef-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo esc_attr( $qodef_unique_id ); ?>" class="screen-reader-text"><?php esc_html_e( 'Search for:', 'alloggio' ); ?></label>
	<div class="qodef-search-form-inner clear">
		<input type="search" id="<?php echo esc_attr( $qodef_unique_id ); ?>" class="qodef-search-form-field" value="" name="s" placeholder="<?php esc_attr_e( 'Type here', 'alloggio' ); ?>" />
		<button type="submit" class="qodef-search-form-button"><?php alloggio_render_icon( 'icon-basic-magnifier', 'linea-icons', '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="64px" height="64px" viewBox="0 0 64 64" enable-background="new 0 0 64 64" xml:space="preserve"><g><circle cx="21" cy="21" r="20"/><line x1="35" y1="35" x2="41" y2="41"/><rect x="46.257" y="37.065" transform="matrix(-0.7071 0.7071 -0.7071 -0.7071 121.9178 50.5)" width="8.485" height="26.87"/></g></svg>' ); ?></button>
	</div>
</form>