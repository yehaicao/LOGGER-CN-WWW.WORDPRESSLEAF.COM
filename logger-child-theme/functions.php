<?php
add_action('wp_enqueue_scripts','vpanel_enqueue_parent_theme_style');
function vpanel_enqueue_parent_theme_style() {
	wp_enqueue_style('parent-style',get_template_directory_uri().'/style.css');
}