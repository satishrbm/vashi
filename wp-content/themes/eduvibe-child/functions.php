<?php

function eduvibe_child_enqueue_styles() {
	wp_enqueue_style( 'eduvibe-child-style', get_stylesheet_uri() );
}

add_action( 'wp_enqueue_scripts', 'eduvibe_child_enqueue_styles', 100 );