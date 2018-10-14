<?php

require_once 'aq_resizer.php';

function hide_wordpress_version() {
	return '';
}

add_filter('the_generator', 'hide_wordpress_version');

function func_enqueue_child_styles() {
	wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );
}

add_action( 'wp_enqueue_scripts', 'func_enqueue_child_styles', 99);
