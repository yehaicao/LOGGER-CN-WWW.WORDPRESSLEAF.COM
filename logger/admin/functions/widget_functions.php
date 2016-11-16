<?php
add_action( 'widgets_init', 'widgets_init' );
function widgets_init() {
	global $post;
	$sidebars = get_option('sidebars');
	if ($sidebars) {
		$before_widget = '<div id="%1$s" class="widget %2$s">';
		$after_widget = '</div>';
		$before_title = '<div class="widget-title"><i class="fa"></i>';
		$after_title = '</div>';
		foreach ($sidebars as $sidebar) {
			register_sidebar( array(
				'name' => esc_html($sidebar),
				'id' => sanitize_title(esc_html($sidebar)),
				'before_widget' => $before_widget , 'after_widget' => $after_widget , 'before_title' => $before_title , 'after_title' => $after_title ,
			) );
		}
	}
	
	$footer_layout_1 = vpanel_options("footer_layout_1");
	$footer_layout_2 = vpanel_options("footer_layout_2");
	
	$before_widget = '<div id="%1$s" class="widget %2$s">';
	$after_widget = '</div>';
	$before_title = '<div class="widget-title">';
	$after_title = '</div>';
	
	if ($footer_layout_1 == "footer_1c" || $footer_layout_1 == "footer_2c" || $footer_layout_1 == "footer_3c" || $footer_layout_1 == "footer_4c") {
		register_sidebar( array(
			'name' => __("First footer widget area ( level 1 )","vbegy"),
			'id' => "footer_1c_sidebar_1",
			'before_widget' => $before_widget , 'after_widget' => $after_widget , 'before_title' => $before_title , 'after_title' => $after_title ,
		));
	}
	if ($footer_layout_1 == "footer_2c" || $footer_layout_1 == "footer_3c" || $footer_layout_1 == "footer_4c") {
		register_sidebar( array(
			'name' => __("Second footer widget area ( level 1 )","vbegy"),
			'id' => "footer_2c_sidebar_1",
			'before_widget' => $before_widget , 'after_widget' => $after_widget , 'before_title' => $before_title , 'after_title' => $after_title ,
		));
	}
	if ($footer_layout_1 == "footer_3c" || $footer_layout_1 == "footer_4c") {
		register_sidebar( array(
			'name' => __("Third footer widget area ( level 1 )","vbegy"),
			'id' => "footer_3c_sidebar_1",
			'before_widget' => $before_widget , 'after_widget' => $after_widget , 'before_title' => $before_title , 'after_title' => $after_title ,
		));
	}
	if ($footer_layout_1 == "footer_4c") {
		register_sidebar( array(
			'name' => __("Fourth footer widget area ( level 1 )","vbegy"),
			'id' => "footer_4c_sidebar_1",
			'before_widget' => $before_widget , 'after_widget' => $after_widget , 'before_title' => $before_title , 'after_title' => $after_title ,
		));
	}
	
	if ($footer_layout_2 == "footer_1c" || $footer_layout_2 == "footer_2c" || $footer_layout_2 == "footer_3c" || $footer_layout_2 == "footer_4c") {
		register_sidebar( array(
			'name' => __("First footer widget area ( level 2 )","vbegy"),
			'id' => "footer_1c_sidebar_2",
			'before_widget' => $before_widget , 'after_widget' => $after_widget , 'before_title' => $before_title , 'after_title' => $after_title ,
		));
	}
	if ($footer_layout_2 == "footer_2c" || $footer_layout_2 == "footer_3c" || $footer_layout_2 == "footer_4c") {
		register_sidebar( array(
			'name' => __("Second footer widget area ( level 2 )","vbegy"),
			'id' => "footer_2c_sidebar_2",
			'before_widget' => $before_widget , 'after_widget' => $after_widget , 'before_title' => $before_title , 'after_title' => $after_title ,
		));
	}
	if ($footer_layout_2 == "footer_3c" || $footer_layout_2 == "footer_4c") {
		register_sidebar( array(
			'name' => __("Third footer widget area ( level 2 )","vbegy"),
			'id' => "footer_3c_sidebar_2",
			'before_widget' => $before_widget , 'after_widget' => $after_widget , 'before_title' => $before_title , 'after_title' => $after_title ,
		));
	}
	if ($footer_layout_2 == "footer_4c") {
		register_sidebar( array(
			'name' => __("Fourth footer widget area ( level 2 )","vbegy"),
			'id' => "footer_4c_sidebar_2",
			'before_widget' => $before_widget , 'after_widget' => $after_widget , 'before_title' => $before_title , 'after_title' => $after_title ,
		));
	}
}
if (function_exists('register_sidebar'))
register_sidebar(array('name' => 'Sidebar','id' => 'sidebar_default',
	'before_widget' => '<div id="%1$s" class="widget %2$s">',
	'after_widget' => '</div>',	
	'before_title' => '<div class="widget-title"><i class="fa"></i>',
	'after_title' => '</div>'
));