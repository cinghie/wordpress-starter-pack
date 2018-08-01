<?php

require_once 'aq_resizer.php';

add_action( 'wp_enqueue_scripts', 'func_enqueue_child_styles', 99);

function func_enqueue_child_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}
