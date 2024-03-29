<?php
	$spinner_text = alloggio_core_get_post_value_through_levels( 'qodef_page_spinner_text' );

	if ( ! function_exists( 'alloggio_str_split_unicode' ) ) {
		function alloggio_str_split_unicode( $str ) {
			return preg_split( '~~u', html_entity_decode( $str ), - 1, PREG_SPLIT_NO_EMPTY );
		}
	}
	
	if ( ! function_exists( 'alloggio_get_split_text' ) ) {
		function alloggio_get_split_text( $text ) {
			if ( ! empty( $text ) ) {
				$split_text = alloggio_str_split_unicode( $text );
				
				foreach ( $split_text as $key => $value ) {
					$value = ( $split_text[ $key ] === ' ' ) ? '&nbsp;' : $value;
					$split_text[ $key ] = '<span class="qodef-e-character">' . $value . '</span>';
				}
				
				return implode( ' ', $split_text );
			}
			
			return $text;
		}
	}

	$split_spinner_text = alloggio_get_split_text($spinner_text);
?>

<div class="qodef-m-textual">
	<div class="qodef-textual-spinner-text">
		<?php echo qode_framework_wp_kses_html( 'content', $split_spinner_text );?>
	</div>
</div>