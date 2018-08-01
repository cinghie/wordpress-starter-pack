<?php

require_once 'aq_resizer.php';

add_action( 'wp_enqueue_scripts', 'wp_bootstrap_starter_child_enqueue_styles' );

function wp_bootstrap_starter_child_enqueue_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
