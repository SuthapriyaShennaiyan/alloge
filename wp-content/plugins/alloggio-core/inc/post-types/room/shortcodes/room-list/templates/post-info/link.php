<?php
$item_link = isset( $query_options ) && ! empty( $query_options ) ? add_query_arg( array_map( 'urlencode', $query_options ), get_the_permalink() ) : get_the_permalink();
?>
<a itemprop="url" class="qodef-e-link" href="<?php echo esc_url( $item_link ); ?>"></a>