<?php

get_header();

$params            = array();
$params['content'] = 'shortcode';

// Include cpt content template
alloggio_core_template_part( 'post-types/room', 'templates/content', '', $params );

get_footer();