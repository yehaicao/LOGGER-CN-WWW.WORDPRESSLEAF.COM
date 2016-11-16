<?php
$prefix = 'vbegy_';
add_action( 'admin_init', 'vbegy_register_meta_boxes' );
function vbegy_register_meta_boxes() {
	global $prefix;
	if ( ! class_exists( 'RW_Meta_Box' ) )
		return;
	
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
	
	$options_categories_t = array();
	$options_categories_t_obj = get_terms("portfolio-category");
	foreach ($options_categories_t_obj as $category) {
		$options_categories_t[$category->term_id] = $category->name;
	}
	
	$sidebars = get_option('sidebars');
	$new_sidebars = array('default'=> 'Default');
	foreach ($GLOBALS['wp_registered_sidebars'] as $sidebar) {
		$new_sidebars[$sidebar['id']] = $sidebar['name'];
	}
	
	// Menus
    $menus = array('default'=> 'Default');
    $all_menus = get_terms('nav_menu',array('hide_empty' => true));
	foreach ($all_menus as $menu) {
	    $menus[$menu->term_id] = $menu->name;
	}
	
	$meta_boxes = array();
	$post_types = get_post_types();
	
	$meta_boxes[] = array(
		'id' => 'blog',
		'title' => 'Blog Options',
		'pages' => array('page'),
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
				'name'    => 'Post style',
				'desc'    => 'Choose post style from here .',
				'id'      => $prefix.'post_style',
				'class'   => 'post_style',
				'options' => array(
					'style_1'         => '1 column',
					'style_2'         => '2 columns',
					'style_3'         => '3 columns ( work in full with only )',
					'style_4'         => '1 columns small image',
					'style_5'         => '1 columns large image',
					'style_6'         => 'Style 6',
					'style_7'         => 'Style 7',
					'portfolio_style' => 'Portfolio style',
				),
				'std'  => 'style_1',
				'type' => 'radio'
			),
			
			array(
				'name'		=> "Columns",
				'id'		=> $prefix."post_columns",
				'type'		=> 'select',
				'options'	=> array(
					'2_columns'	=> '2 Columns',
					'3_columns'	=> '3 Columns',
					'4_columns'	=> '4 Columns',
				),
				'std'		=> array('3_columns'),
			),
			array(
				'name'		=> "Type",
				'id'		=> $prefix."post_portfolio_type",
				'type'		=> 'select',
				'options'	=> array(
					'style_1'	=> 'Style 1',
					'style_2'	=> 'Style 2',
				),
				'std'		=> array('style_1'),
			),
			array(
				'name'		=> "Margin",
				'id'		=> $prefix."post_margin",
				'type'		=> 'select',
				'options'	=> array(
					'yes'	=> 'Yes',
					'no'	=> 'No',
				),
				'std'		=> array('yes'),
			),
			array(
				'name'		=> "Options",
				'id'		=> $prefix."post_options",
				'type'		=> 'select',
				'options'	=> array(
					'filter'	=> 'Filter',
					'pagination'	=> 'Pagination',
					'filter_pagination'	=> 'Filter and pagination',
					'none'	=> 'None',
				),
				'std'		=> array('filter_pagination'),
			),
			
			array(
				'name' => 'Post meta enable or disable',
				'desc' => 'Post meta enable or disable .',
				'id'   => $prefix.'post_meta',
				'std'  => 'on',
				'type' => 'checkbox'
			),
			array(
				'name' => 'Post type enable or disable',
				'desc' => 'Post type enable or disable .',
				'id'   => $prefix.'post_type',
				'std'  => 'on',
				'type' => 'checkbox'
			),
			array(
				'name' => 'Post author enable or disable',
				'desc' => 'Post author enable or disable .',
				'id'   => $prefix.'post_author',
				'std'  => 'on',
				'type' => 'checkbox'
			),
			array(
				'name' => 'Share enable or disable',
				'desc' => 'Share enable or disable .',
				'id'   => $prefix.'post_share',
				'std'  => 'on',
				'type' => 'checkbox'
			),
			array(
				'name' => 'Views enable or disable',
				'desc' => 'Views enable or disable .',
				'id'   => $prefix.'post_views',
				'std'  => 'on',
				'type' => 'checkbox'
			),
			array(
				'name' => 'Excerpt title ( Work in style 6 )',
				'desc' => 'Put here the excerpt title .',
				'id'   => $prefix.'post_excerpt_title',
				'std'  => 5,
				'type' => 'text'
			),
			array(
				'name' => 'Excerpt post',
				'desc' => 'Put here the excerpt post .',
				'id'   => $prefix.'post_excerpt',
				'std'  => 40,
				'type' => 'text'
			),
			array(
				'name'    => 'Pagination style',
				'desc'    => 'Choose pagination style from here .',
				'id'      => $prefix.'post_pagination',
				'class'   => 'post_pagination',
				'options' => array(
					'standard'        => 'Standard',
					'pagination'      => 'Pagination',
					'none'            => 'None',
				),
				'std'  => 'standard',
				'type' => 'radio'
			),
			array(
				'name' => "Post number",
				'desc' => "put the post number",
				'id' => $prefix.'post_number',
				'type' => 'text',
				'std' => "5"
			),
			array(
				'name' => "Order by",
				'desc' => "Select the post order by .",
				'id' => $prefix."orderby_post",
				'std' => array("recent"),
				'type' => "select",
				'options' => array(
					'recent' => 'Recent',
					'popular' => 'Popular',
					'random' => 'Random',
				)
			),
			array(
				'name'		=> "Display by",
				'id'		=> $prefix."post_display",
				'type'		=> 'select',
				'options'	=> array(
					'lasts'	=> 'Lasts',
					'single_category' => 'Single category',
					'multiple_categories' => 'Multiple categories',
					'posts'	=> 'Custom posts',
				),
				'std'		=> array('lasts'),
			),
			array(
				'name'		=> 'Single category',
				'id'		=> $prefix.'post_single_category',
				'type'		=> 'select',
				'options'	=> $options_categories,
			),
			array(
				'name' => "Post categories",
				'desc' => "Select the post categories .",
				'id' => $prefix."post_categories",
				'std' => '',
				'options' => $options_categories,
				'type' => 'checkbox_list'
			),
			array(
				'name'     => "Post ids",
				'desc'     => "Type the post ids .",
				'id'       => $prefix."post_posts",
				'std'      => '',
				'type'     => 'text',
			),
		),
	);
	
	$meta_boxes[] = array(
		'id' => 'contact_us',
		'title' => 'Contact us Options',
		'pages' => array('page'),
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
				'name' => 'Form shortcode',
				'desc' => 'Put the form shortcode .',
				'id'   => $prefix.'contact_form',
				'type' => 'text'
			),
		),
	);
	
	$meta_boxes[] = array(
		'id' => 'portfolio_meta',
		'title' => 'Portfolio Options',
		'pages' => array('page'),
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
				'name'		=> "Columns",
				'id'		=> $prefix."portfolio_columns",
				'type'		=> 'select',
				'options'	=> array(
					'2_columns'	=> '2 Columns',
					'3_columns'	=> '3 Columns',
					'4_columns'	=> '4 Columns',
				),
				'std'		=> array('3_columns'),
			),
			array(
				'name'		=> "Type",
				'id'		=> $prefix."portfolio_type",
				'type'		=> 'select',
				'options'	=> array(
					'style_1'	=> 'Style 1',
					'style_2'	=> 'Style 2',
				),
				'std'		=> array('style_1'),
			),
			array(
				'name'		=> "Margin",
				'id'		=> $prefix."portfolio_margin",
				'type'		=> 'select',
				'options'	=> array(
					'yes'	=> 'Yes',
					'no'	=> 'No',
				),
				'std'		=> array('yes'),
			),
			array(
				'name'		=> "Display by",
				'id'		=> $prefix."portfolio_display",
				'type'		=> 'select',
				'options'	=> array(
					'lasts'	=> 'Lasts',
					'single_category'	=> 'Single category',
					'multiple_categories'	=> 'Multiple categories',
				),
				'std'		=> array('lasts'),
			),
			array(
				'name'		=> 'Single category',
				'id'		=> $prefix.'single_category',
				'type'		=> 'select',
				'options'	=> $options_categories_t,
			),
			array(
				'name'		=> 'Multiple categories',
				'id'		=> $prefix.'multiple_categories',
				'type'		=> 'select_advanced',
				'multiple'    => true,
				'options'	=> $options_categories_t,
			),
			array(
				'name'		=> "Options",
				'id'		=> $prefix."portfolio_options",
				'type'		=> 'select',
				'options'	=> array(
					'filter'	=> 'Filter',
					'pagination'	=> 'Pagination',
					'filter_pagination'	=> 'Filter and pagination',
					'none'	=> 'None',
				),
				'std'		=> array('filter_pagination'),
			),
			array(
				'name' => 'Items per page',
				'desc' => 'Put the items per page .',
				'id'   => $prefix.'items_per_page',
				'type' => 'text',
				'std' => 8
			),
		),
	);
	
	$meta_boxes[] = array(
		'id' => 'header_setting',
		'title' => 'Header Options',
		'pages' => array('post','page','portfolio','product'),
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
				'name' => 'Custom header settings',
				'desc' => 'Select on to enable the custom header settings .',
				'id'   => $prefix.'custom_header',
				'type' => 'checkbox'
			),
			array(
				'name' => "Header style",
				'desc' => "Select the header style .",
				'id'   => $prefix."header_style",
				'std'  => "1",
				'type' => "select",
				'options' => array(
					'1' => 'Header 1',
					'2' => 'Header 2',
					'3' => 'Header 3',
					'4' => 'Header 4',
					'5' => 'Header 5',
				)
			),
			array(
				'name' => 'Header menu settings',
				'desc' => 'Select on to enable the menu in the header .',
				'id'   => $prefix.'header_menu',
				'std'  => 'on',
				'type' => 'checkbox'
			),
			array(
				'name'    => 'Header menu style',
				'desc'    => 'Choose the header menu style .',
				'id'      => $prefix.'header_menu_style',
				'std'     => '1',
				'options' => array("1" => "Style 1","2" => "Style 2"),
				'type'    => 'radio',
				'class'   => 'radio',
			),
			array(
				'name'		=> 'Header menu',
				'desc'		=> "Select Your Header menu",
				'id'		=> $prefix."menu_header",
				'type'		=> 'select',
				'options'	=> $menus,
			),
			array(
				'name' => 'Fixed header option',
				'desc' => 'Select on to enable fixed header .',
				'id'   => $prefix.'header_fixed',
				'std'  => 0,
				'type' => 'checkbox'
			),
			array(
				'name' => 'Stop fixed header in mobile option',
				'desc' => 'Select on to stop fixed header in mobile .',
				'id'   =>  $prefix.'header_fixed_responsive',
				'std'  => 0,
				'type' => 'checkbox'
			),
			array(
				'name'    => 'Logo display',
				'desc'    => 'choose Logo display .',
				'id'      => $prefix.'logo_display',
				'std'     => 'display_title',
				'type'    => 'radio',
				'class'   => 'radio',
				'options' => array("display_title" => "Display site title","custom_image" => "Custom Image")
			),
			array(
				'name' => 'Logo upload',
				'desc' => 'Upload your custom logo. ',
				'id'   => $prefix.'logo_img',
				'std'  => '',
				'type' => 'upload'
			),
			array(
				'name' => 'Logo retina upload',
				'desc' => 'Upload your custom logo retina. ',
				'id'   => $prefix.'retina_logo',
				'std'  => '',
				'type' => 'upload'
			),
			array(
				'name' => 'Header cart settings',
				'desc' => 'Select on to enable the cart in the header .',
				'id'   => $prefix.'header_cart',
				'std'  => 'on',
				'type' => 'checkbox'
			),
			array(
				'name' => 'Header search settings',
				'desc' => 'Select on to enable the search in the header .',
				'id'   => $prefix.'header_search',
				'std'  => 'on',
				'type' => 'checkbox'
			),
			array(
				'name' => 'Header follow settings',
				'desc' => 'Select on to enable the follow me in the header .',
				'id'   => $prefix.'header_follow',
				'std'  => 'on',
				'type' => 'checkbox'
			),
			array(
				'name'    => 'Header follow style',
				'desc'    => 'Choose the header follow style .',
				'id'      => $prefix.'header_follow_style',
				'std'     => '1',
				'options' => array("1" => "Style 1","2" => "Style 2"),
				'type'    => 'radio',
				'class'   => 'radio',
			),
			array(
				'name' => 'Facebook URL',
				'desc' => 'Type the facebook URL from here .',
				'id'   => $prefix.'facebook_icon_h',
				'std'  => '#',
				'type' => 'text'
			),
			array(
				'name' => 'Twitter URL',
				'desc' => 'Type the twitter URL from here .',
				'id'   => $prefix.'twitter_icon_h',
				'std'  => '#',
				'type' => 'text'
			),
			array(
				'name' => 'Google plus URL',
				'desc' => 'Type the google plus URL from here .',
				'id'   => $prefix.'gplus_icon_h',
				'std'  => '#',
				'type' => 'text'
			),
			array(
				'name' => 'Linkedin URL',
				'desc' => 'Type the linkedin URL from here .',
				'id'   => $prefix.'linkedin_icon_h',
				'std'  => '#',
				'type' => 'text'
			),
			array(
				'name' => 'Dribbble URL',
				'desc' => 'Type the dribbble URL from here .',
				'id'   => $prefix.'dribbble_icon_h',
				'std'  => '#',
				'type' => 'text'
			),
			array(
				'name' => 'Youtube URL',
				'desc' => 'Type the youtube URL from here .',
				'id'   => $prefix.'youtube_icon_h',
				'std'  => '#',
				'type' => 'text'
			),
			array(
				'name' => 'Vimeo URL',
				'desc' => 'Type the vimeo URL from here .',
				'id'   => $prefix.'vimeo_icon_h',
				'std'  => '#',
				'type' => 'text'
			),
			array(
				'name' => 'Skype',
				'desc' => 'Type the skype from here .',
				'id'   => $prefix.'skype_icon_h',
				'std'  => '#',
				'type' => 'text'
			),
			array(
				'name' => 'Flickr URL',
				'desc' => 'Type the flickr URL from here .',
				'id'   => $prefix.'flickr_icon_h',
				'std'  => '#',
				'type' => 'text'
			),
			array(
				'name' => 'Soundcloud URL',
				'desc' => 'Type the soundcloud URL from here .',
				'id'   => $prefix.'soundcloud_icon_h',
				'std'  => '#',
				'type' => 'text'
			),
			array(
				'name' => 'Instagram URL',
				'desc' => 'Type the instagram URL from here .',
				'id'   => $prefix.'instagram_icon_h',
				'std'  => '#',
				'type' => 'text'
			),
			array(
				'name' => 'Pinterest URL',
				'desc' => 'Type the pinterest URL from here .',
				'id'   => $prefix.'pinterest_icon_h',
				'std'  => '#',
				'type' => 'text'
			),
			array(
				'name' => 'breadcrumbs settings',
				'desc' => 'Select on to enable the breadcrumbs .',
				'id'   => $prefix.'breadcrumbs',
				'std'  => 'on',
				'type' => 'checkbox'
			),
		),
	);
	
	$meta_boxes[] = array(
		'id' => 'top_head',
		'title' => 'Top head Options',
		'pages' => array('post','page','portfolio','product'),
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
				'name' => 'Custom setting for top head',
				'desc' => 'Custom setting for top head .',
				'id' => $prefix.'custom_slide_show_style',
				'type' => 'checkbox'
			),
			array(
				'name' => "Head slide",
				'desc' => "Select the Head slide .",
				'id'   => $prefix."head_slide",
				'std'  => "header",
				'type' => "select",
				'options' => array(
					'header' => 'Header',
					'footer' => 'Footer',
					'none' => 'None',
				)
			),
			array(
				'name' => "Head slide background",
				'desc' => "Select the head slide background .",
				'id'   => $prefix."head_slide_background",
				'std'  => "transparent",
				'type' => "select",
				'options' => array(
					'transparent' => 'Transparent',
					'blue' => 'Dark blue',
					'custom' => 'Custom',
				)
			),
			array(
				'name'		=> 'Background',
				'id'		=> $prefix."head_slide_background_img",
				'type'		=> 'upload',
			),
			array(
				'name'		=> "Background color",
				'id'		=> $prefix."head_slide_background_color",
				'type'		=> 'color',
			),
			array(
				'name'		=> "Background repeat",
				'id'		=> $prefix."head_slide_background_repeat",
				'type'		=> 'select',
				'options'	=> array(
					'repeat'	=> 'repeat',
					'no-repeat'	=> 'no-repeat',
					'repeat-x'	=> 'repeat-x',
					'repeat-y'	=> 'repeat-y',
				),
			),
			array(
				'name'		=> "Background fixed",
				'id'		=> $prefix."head_slide_background_fixed",
				'type'		=> 'select',
				'options'	=> array(
					'fixed'  => 'fixed',
					'scroll' => 'scroll',
				),
			),
			array(
				'name'		=> "Background position x",
				'id'		=> $prefix."head_slide_background_position_x",
				'type'		=> 'select',
				'options'	=> array(
					'left'	 => 'left',
					'center' => 'center',
					'right'	 => 'right',
				),
			),
			array(
				'name'		=> "Background position y",
				'id'		=> $prefix."head_slide_background_position_y",
				'type'		=> 'select',
				'options'	=> array(
					'top'	 => 'top',
					'center' => 'center',
					'bottom' => 'bottom',
				),
			),
			array(
				'name' => "Full Screen Background",
				'id'   => $prefix."head_slide_background_full",
				'type' => 'checkbox',
				'std'  => 0,
			),
			array(
				'name' => 'News ticker enable or disable',
				'desc' => 'News ticker enable or disable .',
				'id'   => $prefix.'news_ticker',
				'std'  => "on",
				'type' => 'checkbox'
			),
			array(
				'name' => "News ticker excerpt title",
				'desc' => "put the news ticker excerpt title",
				'id'   => $prefix.'news_excerpt_title',
				'type' => 'text',
				'std'  => "5"
			),
			array(
				'name' => "News ticker number",
				'desc' => "put the news ticker number",
				'id'   => $prefix.'news_number',
				'type' => 'text',
				'std'  => "5"
			),
			array(
				'name' => "Order by",
				'desc' => "Select the news ticker order by .",
				'id' => $prefix."orderby_news",
				'std' => array("recent"),
				'type' => "select",
				'options' => array(
					'recent' => 'Recent',
					'popular' => 'Popular',
					'random' => 'Random',
				)
			),
			array(
				'name'		=> "Display by",
				'id'		=> $prefix."news_display",
				'type'		=> 'select',
				'options'	=> array(
					'lasts'	=> 'Lasts',
					'single_category' => 'Single category',
					'multiple_categories' => 'Multiple categories',
					'posts'	=> 'Custom posts',
				),
				'std'		=> array('lasts'),
			),
			array(
				'name'		=> 'Single category',
				'id'		=> $prefix.'news_single_category',
				'type'		=> 'select',
				'options'	=> $options_categories,
			),
			array(
				'name' => "News ticker categories",
				'desc' => "Select the news ticker categories .",
				'id' => $prefix."news_categories",
				'options' => $options_categories,
				'type' => 'checkbox_list'
			),
			array(
				'name'     => "News post ids",
				'desc'     => "Select the news post ids .",
				'id'       => $prefix."news_posts",
				'std'      => '',
				'type'     => 'text',
			),
			array(
				'name' => "Head slide style",
				'desc' => "Select the head slide style .",
				'id'   => $prefix."head_slide_style",
				'std'  => "slideshow_thumbnail",
				'type' => "select",
				'options' => array(
					'slideshow' => 'Slideshow',
					'slideshow_thumbnail' => 'Slideshow and thumbnail',
					'thumbnail_slideshow' => 'Thumbnail and slideshow',
					'thumbnail' => 'Thumbnail',
					'video_container' => 'Video container',
					'video_full' => 'Video full width',
					'none' => 'None',
				)
			),
			array(
				'name'		=> 'Video type',
				'id'		=> $prefix.'video_head',
				'type'		=> 'select',
				'options'	=> array(
					'youtube' => "Youtube",
					'vimeo' => "Vimeo",
					'daily' => "Dialymotion",
					'embed' => "Custom embed",
				),
				'std'		=> array('youtube'),
				'desc'		=> 'Choose from here the video type'
			),
			array(
				'name'		=> 'Video ID',
				'id'		=> $prefix.'video_id_head',
				'desc'		=> 'Put here the video id : http://www.youtube.com/watch?v=sdUUx5FdySs EX : "sdUUx5FdySs"',
				'type'		=> 'text',
				'std'		=> ''
			),
			array(
				'name'		=> 'Custom embed',
				'desc'		=> "Put your Custom embed html",
				'id'		=> $prefix."custom_embed_head",
				'type'		=> 'textarea',
				'cols'		=> "40",
				'rows'		=> "8"
			),
			array(
				'name' => "Slideshow overlay",
				'desc' => "Select the slideshow overlay .",
				'id' => $prefix."slide_overlay",
				'std' => array("enable"),
				'type' => "select",
				'options' => array(
					'enable' => 'Enable',
					'title' => 'Title',
					'disable' => 'Disable',
				)
			),
			array(
				'name' => "Excerpt title for the slideshow",
				'desc' => "put the excerpt title for the slideshow",
				'id' => $prefix.'excerpt_title_slideshow',
				'type' => 'text',
				'std' => "5"
			),
			array(
				'name' => "Excerpt for the slideshow",
				'desc' => "put the excerpt for the slideshow",
				'id' => $prefix.'excerpt_slideshow',
				'type' => 'text',
				'std' => "25"
			),
			array(
				'name' => "Slides number",
				'desc' => "put the slides number",
				'id' => $prefix.'slideshow_number',
				'type' => 'text',
				'std' => "5"
			),
			array(
				'name' => "Order by",
				'desc' => "Select the slideshow order by .",
				'id' => $prefix."orderby_slide",
				'std' => array("recent"),
				'type' => "select",
				'options' => array(
					'recent' => 'Recent',
					'popular' => 'Popular',
					'random' => 'Random',
				)
			),
			array(
				'name'		=> "Display by",
				'id'		=> $prefix."slideshow_display",
				'type'		=> 'select',
				'options'	=> array(
					'lasts'	=> 'Lasts',
					'single_category' => 'Single category',
					'multiple_categories' => 'Multiple categories',
					'posts'	=> 'Custom posts',
				),
				'std'		=> array('lasts'),
			),
			array(
				'name'		=> 'Single category',
				'id'		=> $prefix.'slideshow_single_category',
				'type'		=> 'select',
				'options'	=> $options_categories,
			),
			array(
				'name' => "Slideshow categories",
				'desc' => "Select the slideshow categories .",
				'id' => $prefix."slideshow_categories",
				'std' => '',
				'options' => $options_categories,
				'type' => 'checkbox_list'
			),
			array(
				'name'     => "Slideshow post ids",
				'desc'     => "Select the head post ids .",
				'id'       => $prefix."slideshow_posts",
				'std'      => '',
				'type'     => 'text',
			),
			array(
				'name' => "Excerpt title for the thumbnail",
				'desc' => "put the excerpt title for the thumbnail",
				'id' => $prefix.'excerpt_title_thumbnail',
				'type' => 'text',
				'std' => "5"
			),
			array(
				'name' => "Thumbnail number",
				'desc' => "put the thumbnail number",
				'id' => $prefix.'thumbnail_number',
				'type' => 'text',
				'std' => "6"
			),
			array(
				'name' => "Order by",
				'desc' => "Select the thumbnail order by .",
				'id' => $prefix."orderby_thumbnail",
				'std' => array("recent"),
				'type' => "select",
				'options' => array(
					'recent' => 'Recent',
					'popular' => 'Popular',
					'random' => 'Random',
				)
			),
			array(
				'name'		=> "Display by",
				'id'		=> $prefix."thumbnail_display",
				'type'		=> 'select',
				'options'	=> array(
					'lasts'	=> 'Lasts',
					'single_category' => 'Single category',
					'multiple_categories' => 'Multiple categories',
					'posts'	=> 'Custom posts',
				),
				'std'		=> array('lasts'),
			),
			$options[] = array(
				'name'		=> 'Single category',
				'id'		=> $prefix.'thumbnail_single_category',
				'type'		=> 'select',
				'options'	=> $options_categories,
			),
			array(
				'name' => "Thumbnail categories",
				'desc' => "Select the thumbnail categories .",
				'id' => $prefix."thumbnail_categories",
				'std' => '',
				'options' => $options_categories,
				'type' => 'checkbox_list'
			),
			array(
				'name'    => "Thumbnail post ids",
				'desc'    => "Select the head post ids .",
				'id'      => $prefix."thumbnail_posts",
				'std'     => '',
				'type'    => 'text',
			),
		),
	);
	
	$meta_boxes[] = array(
		'id' => 'page_style',
		'title' => 'Post and Page Options',
		'pages' => array('post','page','portfolio'),
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
				'name'		=> "Page style",
				'id'		=> $prefix."page_style",
				'type'		=> 'select',
				'options'	=> array(
					'style_1'	=> 'Style 1 ( with meta post )',
					'style_2'	=> 'Style 2',
				),
			),
			array(
				'name'		=> 'Post icon',
				'id'		=> $prefix.'post_icon',
				'desc'		=> 'Put here the icon form here <a href=http://fortawesome.github.io/Font-Awesome/icons/>Font Awesome</a>',
				'type'		=> 'text',
				'std'		=> 'fa-file-text'
			),
		),
	);
	
	$meta_boxes[] = array(
		'id' => 'post_page',
		'title' => 'Post, Page and portfolio Options',
		'pages' => array('post','page','portfolio','product'),
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
				'name' => "Page builder",
				'id'   => $prefix."page_builder",
				'type' => 'checkbox',
				'std'  => 0,
			),
			array(
				'name'		=> 'Layout',
				'id'		=> $prefix."layout",
				'class'     => 'radio_no_margin',
				'type'		=> 'radio',
				'options'	=> array(
					'default'	=> '',
					'full'		=> '',
					'fixed'		=> '',
					'fixed_2'	=> '',
				),
				'std'		=> 'default',
			),
			array(
				'name'		=> 'Choose page / post template',
				'id'		=> $prefix."home_template",
				'class'     => 'radio_no_margin',
				'type'		=> 'radio',
				'options'	=> array(
					'default'   => '',
					'grid_1200' => '',
					'grid_970'  => ''
				),
				'std'		=> 'default',
			),
			array(
				'name'		=> 'Choose page / post skin',
				'id'		=> $prefix."site_skin_l",
				'class'     => 'radio_no_margin',
				'type'		=> 'radio',
				'options'	=> array(
					'default'    => '',
					'site_light' => '',
					'site_dark'  => ''
				),
				'std'		=> 'default',
			),
			array(
				'name'		=> 'Choose Your Skin',
				'id'		=> $prefix."skin",
				'class'		=> 'radio_no_margin',
				'type'		=> 'radio',
				'options'	=> array(
					'default' => '',
					'skin' => '',
					'bright_cyan' => '',
					'bright_pink' => '',
					'dark_grayish_blue' => '',
					'dark_grayish_cyan' => '',
					'dark_grayish_cyan_2' => '',
					'dark_green' => '',
					'dark_moderate_violet' => '',
					'dark_pink' => '',
					'light_orange' => '',
					'lime_green' => '',
					'moderate_blue' => '',
					'moderate_blue_2' => '',
					'moderate_cyan' => '',
					'moderate_violet' => '',
					'slightly_desaturated_blue' => '',
					'soft_blue' => '',
					'soft_cyan' => '',
					'soft_red' => '',
					'soft_yellow' => '',
					'strong_cyan' => '',
					'strong_orange' => '',
					'strong_red' => '',
					'very_light_pink' => '',
					'vivid_cyan' => '',
					'vivid_orange' => '',
					'vivid_orange_2' => '',
					'vivid_orange_3' => '',
					'vivid_yellow' => '',
					'vivid_yellow_2' => '',
					'yellow' => '',
					'red' => '',
					'purple' => '',
					'orange' => '',
					'light_red' => '',
					'green' => '',
					'gray' => '',
					'blue' => '',
				),
				'std'		=> 'default',
			),
			array(
				'name'		=> 'Primary Color',
				'id'		=> $prefix."primary_color",
				'type'		=> 'color',
			),
			array(
				'name'		=> 'Secondary Color',
				'id'		=> $prefix."secondary_color",
				'type'		=> 'color',
			),
			array(
				'name'		=> 'Background',
				'id'		=> $prefix."background_img",
				'type'		=> 'upload',
			),
			array(
				'name'		=> "Background color",
				'id'		=> $prefix."background_color",
				'type'		=> 'color',
			),
			array(
				'name'		=> "Background repeat",
				'id'		=> $prefix."background_repeat",
				'type'		=> 'select',
				'options'	=> array(
					'repeat'	=> 'repeat',
					'no-repeat'	=> 'no-repeat',
					'repeat-x'	=> 'repeat-x',
					'repeat-y'	=> 'repeat-y',
				),
			),
			array(
				'name'		=> "Background fixed",
				'id'		=> $prefix."background_fixed",
				'type'		=> 'select',
				'options'	=> array(
					'fixed'  => 'fixed',
					'scroll' => 'scroll',
				),
			),
			array(
				'name'		=> "Background position x",
				'id'		=> $prefix."background_position_x",
				'type'		=> 'select',
				'options'	=> array(
					'left'	 => 'left',
					'center' => 'center',
					'right'	 => 'right',
				),
			),
			array(
				'name'		=> "Background position y",
				'id'		=> $prefix."background_position_y",
				'type'		=> 'select',
				'options'	=> array(
					'top'	 => 'top',
					'center' => 'center',
					'bottom' => 'bottom',
				),
			),
			array(
				'name' => "Full Screen Background",
				'id'   => $prefix."background_full",
				'type' => 'checkbox',
				'std'  => 0,
			),
			array(
				'name'		=> 'Sidebar',
				'id'		=> $prefix."sidebar",
				'class'     => 'radio_no_margin',
				'type'		=> 'radio',
				'options'	=> array(
					'default'		=> '',
					'right'			=> '',
					'full'			=> '',
					'left'			=> '',
					'centered'		=> '',
				),
				'std'		=> 'default',
			),
			array(
				'name'		=> 'Select your sidebar',
				'id'		=> $prefix.'what_sidebar',
				'type'		=> 'select',
				'options'	=> $new_sidebars,
			),
		),
	);
	
	$meta_boxes[] = array(
		'id' => 'portfolio_head',
		'title' => 'Portfolio options',
		'pages' => array('portfolio'),
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
				'name'		=> 'Head post',
				'id'		=> $prefix.'what_post',
				'type'		=> 'select',
				'options'	=> array(
					'image'			 => "Featured Image",
					'slideshow'		 => "Slideshow",
					'video'			 => "Video",
				),
				'std'		=> array('image'),
				'desc'		=> 'Choose from here the post type'
			),
			array(
				'name'		=> 'Image style',
				'id'		=> $prefix.'image_style',
				'type'		=> 'select',
				'options'	=> array(
					'default' => "Default",
					'style_1' => "Full width",
					'style_2' => "Full width container",
				),
				'std'		=> array('default'),
			),
			array(
				'name'		=> 'Meta post position',
				'id'		=> $prefix.'meta_post_position',
				'type'		=> 'select',
				'options'	=> array(
					'default' => "Default",
					'top_image' => "Post with meta on the top image",
				),
				'std'		=> array('default'),
			),
			array(
				'name'		=> 'Slideshow ?',
				'id'		=> $prefix.'slideshow_type',
				'type'		=> 'select',
				'options'	=> array(
					'custom_slide' => "Custom Slideshow",
					'upload_images' => "Upload your images",
				),
				'std'		=> array('custom_slide'),
			),
			array(
				'id'		=> $prefix.'slideshow_post',
				'type'		=> 'note',
			),
			array(
				'name'	=> 'Upload your images',
				'id'	=> $prefix."upload_images",
				'type'	=> 'image_advanced',
			),
			array(
				'name'		=> 'Video type',
				'id'		=> $prefix.'video_post_type',
				'type'		=> 'select',
				'options'	=> array(
					'youtube' => "Youtube",
					'vimeo' => "Vimeo",
					'daily' => "Dialymotion",
					'embed' => "Custom embed",
				),
				'std'		=> array('youtube'),
				'desc'		=> 'Choose from here the video type'
			),
			array(
				'name'		=> 'Custom embed',
				'desc'		=> "Put your Custom embed html",
				'id'		=> $prefix."custom_embed",
				'type'		=> 'textarea',
				'cols'		=> "40",
				'rows'		=> "8"
			),
			array(
				'name'		=> 'Video ID',
				'id'		=> $prefix.'video_post_id',
				'desc'		=> 'Put here the video id : http://www.youtube.com/watch?v=sdUUx5FdySs EX : "sdUUx5FdySs"',
				'type'		=> 'text',
				'std'		=> ''
			),
			array(
				'name'		=> 'Client',
				'id'		=> $prefix.'client',
				'desc'		=> 'Put here the client',
				'type'		=> 'text',
				'std'		=> ''
			),
			array(
				'name'		=> 'Skills',
				'id'		=> $prefix.'skills',
				'desc'		=> 'Put here the skills',
				'type'		=> 'text',
				'std'		=> ''
			),
			array(
				'name'		=> 'URL',
				'id'		=> $prefix.'url',
				'desc'		=> 'Put here the URL',
				'type'		=> 'url',
				'std'		=> ''
			),
		),
	);
	
	$meta_boxes[] = array(
		'id' => 'post_head',
		'title' => 'Post head options',
		'pages' => array('post'),
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
				'name'		=> 'Head post',
				'id'		=> $prefix.'what_post',
				'type'		=> 'select',
				'options'	=> array(
					'none'			 => "None",
					'image'			 => "Featured Image",
					'image_lightbox' => "Image With Lightbox",
					'google'		 => "Google Map",
					'slideshow'		 => "Slideshow",
					'video'			 => "Video",
					'quote'			 => "Quote",
					'link'			 => "Link",
					'twitter'		 => "Twitter",
					'facebook'		 => "Facebook",
					'soundcloud'	 => "Soundcloud",
					'audio'	         => "Audio",
				),
				'std'		=> array('image'),
				'desc'		=> 'Choose from here the post type'
			),
			array(
				'name'		=> 'Image style',
				'id'		=> $prefix.'image_style',
				'type'		=> 'select',
				'options'	=> array(
					'default' => "Default",
					'style_1' => "Full width",
					'style_2' => "Full width container",
				),
				'std'		=> array('default'),
			),
			array(
				'name'		=> 'Meta post position',
				'id'		=> $prefix.'meta_post_position',
				'type'		=> 'select',
				'options'	=> array(
					'default' => "Default",
					'top_image' => "Post with meta on the top image",
				),
				'std'		=> array('default'),
			),
			array(
				'name'		=> 'Google map',
				'desc'		=> "Put your google map html",
				'id'		=> $prefix."google",
				'type'		=> 'textarea',
				'cols'		=> "40",
				'rows'		=> "8"
			),
			array(
				'name'		=> 'Audio URL MP3',
				'desc'		=> "Put your audio URL MP3",
				'id'		=> $prefix."audio",
				'type'		=> 'text',
			),
			array(
				'name'		=> 'Slideshow ?',
				'id'		=> $prefix.'slideshow_type',
				'type'		=> 'select',
				'options'	=> array(
					'custom_slide' => "Custom Slideshow",
					'upload_images' => "Upload your images",
				),
				'std'		=> array('custom_slide'),
			),
			array(
				'id'		=> $prefix.'slideshow_post',
				'type'		=> 'note',
			),
			array(
				'name'	=> 'Upload your images',
				'id'	=> $prefix."upload_images",
				'type'	=> 'image_advanced',
			),
			array(
				'name'		=> 'Video type',
				'id'		=> $prefix.'video_post_type',
				'type'		=> 'select',
				'options'	=> array(
					'youtube' => "Youtube",
					'vimeo' => "Vimeo",
					'daily' => "Dialymotion",
					'embed' => "Custom embed",
				),
				'std'		=> array('youtube'),
				'desc'		=> 'Choose from here the video type'
			),
			array(
				'name'		=> 'Custom embed',
				'desc'		=> "Put your Custom embed html",
				'id'		=> $prefix."custom_embed",
				'type'		=> 'textarea',
				'cols'		=> "40",
				'rows'		=> "8"
			),
			array(
				'name'		=> 'Video ID',
				'id'		=> $prefix.'video_post_id',
				'desc'		=> 'Put here the video id : http://www.youtube.com/watch?v=sdUUx5FdySs EX : "sdUUx5FdySs"',
				'type'		=> 'text',
				'std'		=> ''
			),
			array(
				'name'		=> 'Author',
				'id'		=> $prefix.'quote_author',
				'desc'		=> 'Put here the quote author',
				'type'		=> 'text',
				'std'		=> ''
			),
			array(
				'name'		=> 'Quote icon color',
				'id'		=> $prefix.'quote_icon_color',
				'desc'		=> 'Put here the quote icon color',
				'type'		=> 'color',
				'std'		=> ''
			),
			array(
				'name'		=> 'Quote color',
				'id'		=> $prefix.'quote_color',
				'desc'		=> 'Put here the quote color',
				'type'		=> 'color',
				'std'		=> ''
			),
			array(
				'name'		=> 'Link title',
				'id'		=> $prefix.'link_title',
				'desc'		=> 'Put here the link title',
				'type'		=> 'text',
				'std'		=> ''
			),
			array(
				'name'		=> 'Link',
				'id'		=> $prefix.'link',
				'desc'		=> 'Put here the link',
				'type'		=> 'text',
				'std'		=> ''
			),
			array(
				'name'		=> 'Link target',
				'id'		=> $prefix.'link_target',
				'type'		=> 'select',
				'options'	=> array(
					'style_1' => "Same window",
					'style_2' => "New window",
				),
				'std'		=> array('style_1'),
				'desc'		=> 'Choose from here the Link target'
			),
			array(
				'name'		=> 'Link icon color',
				'id'		=> $prefix.'link_icon_color',
				'desc'		=> 'Put here the link icon color',
				'type'		=> 'color',
				'std'		=> ''
			),
			array(
				'name'		=> 'Link color',
				'id'		=> $prefix.'link_color',
				'desc'		=> 'Put here the link color',
				'type'		=> 'color',
				'std'		=> ''
			),
			array(
				'name'		=> 'Link icon hover color',
				'id'		=> $prefix.'link_icon_hover_color',
				'desc'		=> 'Put here the link icon hover color',
				'type'		=> 'color',
				'std'		=> ''
			),
			array(
				'name'		=> 'Link hover color',
				'id'		=> $prefix.'link_hover_color',
				'desc'		=> 'Put here the link hover color',
				'type'		=> 'color',
				'std'		=> ''
			),
			array(
				'name'		=> 'Soundcloud embed',
				'id'		=> $prefix.'soundcloud_embed',
				'desc'		=> 'Put here the soundcloud embed',
				'type'		=> 'text',
				'std'		=> ''
			),
			array(
				'name'		=> 'Soundcloud height',
				'id'		=> $prefix.'soundcloud_height',
				'desc'		=> 'Put here the soundcloud height',
				'type'		=> 'text',
				'std'		=> '150'
			),
			array(
				'name'		=> 'Twitter embed',
				'id'		=> $prefix.'twitter_embed',
				'desc'		=> 'Put here the twitter embed',
				'type'		=> 'text',
				'std'		=> ''
			),
			array(
				'name'		=> 'Facebook embed',
				'id'		=> $prefix.'facebook_embed',
				'desc'		=> 'Put here the facebook embed',
				'type'		=> 'textarea',
				'std'		=> ''
			),
			array(
				'name'		=> 'Background color',
				'id'		=> $prefix.'post_head_background',
				'desc'		=> 'Put here the background color',
				'type'		=> 'color',
				'std'		=> ''
			),
			array(
				'name'		=> 'Background',
				'id'		=> $prefix."post_head_background_img",
				'type'		=> 'upload',
			),
			array(
				'name'		=> "Background repeat",
				'id'		=> $prefix."post_head_background_repeat",
				'type'		=> 'select',
				'options'	=> array(
					'repeat'	=> 'repeat',
					'no-repeat'	=> 'no-repeat',
					'repeat-x'	=> 'repeat-x',
					'repeat-y'	=> 'repeat-y',
				),
			),
			array(
				'name'		=> "Background fixed",
				'id'		=> $prefix."post_head_background_fixed",
				'type'		=> 'select',
				'options'	=> array(
					'fixed'  => 'fixed',
					'scroll' => 'scroll',
				),
			),
			array(
				'name'		=> "Background position x",
				'id'		=> $prefix."post_head_background_position_x",
				'type'		=> 'select',
				'options'	=> array(
					'left'	 => 'left',
					'center' => 'center',
					'right'	 => 'right',
				),
			),
			array(
				'name'		=> "Background position y",
				'id'		=> $prefix."post_head_background_position_y",
				'type'		=> 'select',
				'options'	=> array(
					'top'	 => 'top',
					'center' => 'center',
					'bottom' => 'bottom',
				),
			),
			array(
				'name' => "Full Screen Background",
				'id'   => $prefix."post_head_background_full",
				'type' => 'checkbox',
				'std'  => 0,
			),
		),
	);
	
	$meta_boxes[] = array(
		'id' => 'single_page',
		'title' => 'Single Pages Options',
		'pages' => array('post','page','portfolio','product'),
		'context' => 'side',
		'priority' => 'default',
		'fields' => array(
			array(
				'name' => 'Choose a custom page setting',
				'desc' => 'Choose a custom page setting .',
				'id'   => $prefix.'custom_page_setting',
				'type' => 'checkbox'
			),
			array(
				'name' => 'Sticky sidebar enable or disable',
				'desc' => 'Sticky sidebar enable or disable .',
				'id'   => $prefix.'sticky_sidebar_s',
				'std'  => 'on',
				'type' => 'checkbox'
			),
			array(
				'name' => 'Post meta enable or disable',
				'desc' => 'Post meta enable or disable .',
				'id'   => $prefix.'post_meta_s',
				'std'  => 'on',
				'type' => 'checkbox'
			),
			array(
				'name' => 'Post review enable or disable',
				'desc' => 'Post review enable or disable .',
				'id'   => $prefix.'post_review_s',
				'std'  => 'on',
				'type' => 'checkbox'
			),
			array(
				'name' => 'Post type enable or disable',
				'desc' => 'Post type enable or disable .',
				'id'   => $prefix.'post_type_s',
				'std'  => 'on',
				'type' => 'checkbox'
			),
			array(
				'name' => 'Post author enable or disable',
				'desc' => 'Post author enable or disable .',
				'id'   => $prefix.'post_author_s',
				'std'  => 'on',
				'type' => 'checkbox'
			),
			array(
				'name' => 'Share enable or disable',
				'desc' => 'Share enable or disable .',
				'id'   => $prefix.'post_share_s',
				'std'  => 'on',
				'type' => 'checkbox'
			),
			array(
				'name' => 'Views enable or disable',
				'desc' => 'Views enable or disable .',
				'id'   => $prefix.'post_views_s',
				'std'  => 'on',
				'type' => 'checkbox'
			),
			array(
				'name' => 'Navigation post enable or disable',
				'desc' => 'Navigation post ( next and previous posts) enable or disable .',
				'id'   =>  $prefix.'post_navigation_s',
				'std'  => 'on',
				'type' => 'checkbox'
			),
			array(
				'name' => 'Author info box enable or disable',
				'desc' => 'Author info box enable or disable .',
				'id'   =>  $prefix.'post_author_box_s',
				'std'  => 'on',
				'type' => 'checkbox'
			),
			array(
				'name' => 'Related post enable or disable',
				'desc' => 'Related post enable or disable .',
				'id'   =>  $prefix.'related_post_s',
				'std'  => 'on',
				'type' => 'checkbox'
			),
			array(
				'name' => 'Related post number',
				'desc' => 'Type related post number from here .',
				'id'   =>  $prefix.'related_number_s',
				'std'  => '4',
				'type' => 'text'
			),
			array(
				'name' => 'Excerpt title in related post',
				'desc' => 'Type excerpt title in related post from here .',
				'id'   =>  $prefix.'excerpt_related_title_s',
				'std'  => '5',
				'type' => 'text'
			),
			array(
				'name' => 'Comments enable or disable',
				'desc' => 'Comments enable or disable .',
				'id'   =>  $prefix.'post_comments_s',
				'std'  => 'on',
				'type' => 'checkbox'
			),
		),
	);
	
	$meta_boxes[] = array(
		'id' => 'review',
		'title' => 'Ratings',
		'pages' => array( 'post' ),
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
				'name'		=> 'Display Review?',
				'id'		=> $prefix . 'review_display',
				'clone'		=> false,
				'type'		=> 'checkbox',
				'std'		=> false
			),
			array(
				'id'		=> $prefix.'ratings_post',
				'type'		=> 'note',
			),
			array(
				'name'		=> 'Rating Type',
				'id'		=> $prefix."review_type",
				'type'		=> 'select',
				'options'	=> array(
					'stars'	  => 'Stars',
					'percentage' => 'Percentage',
					'points' => 'Points'
				),
				'std'		=> 'stars',
			),
			array(
				'name'		=> 'Final Score',
				'desc'		=> "Total of <em>__</em>% will be displayed if percentage is selected",
				'id'		=> $prefix."final_review",
				'type'		=> 'text',
				'std'		=> "",
			),
			array(
				'name'		=> 'Review title',
				'desc'		=> "Leave blank if you don't want it",
				'id'		=> $prefix."review_title",
				'type'		=> 'text',
				'std'		=> "Item review",
			),
			array(
				'name'		=> 'Brief summary',
				'desc'		=> "Leave blank if you don't want it",
				'id'		=> $prefix."brief_summary",
				'type'		=> 'text',
			),
			array(
				'name'		=> 'Review summary',
				'desc'		=> "Just a paragraph will do",
				'id'		=> $prefix."review_summary",
				'type'		=> 'textarea',
				'std'		=> "",
				'cols'		=> "50",
				'rows'		=> "4"
			),
			array(
				'name'		  => 'Review position',
				'id'		  => $prefix."review_position",
				'type'		  => 'select',
				'options'	  => array(
					'top'	  => 'Top (Half Width)',
					'top_f' => 'Top (Full Width)',
					'bottom' => 'Bottom (Full Width)'
				),
				'std'		  => 'bottom',
				'desc'		  => 'Where in the post do you want it to display?'
			)
			
		)
	);
	
	$meta_boxes[] = array(
		'id' => 'advertising',
		'title' => 'Advertising Options',
		'pages' => array('post','page','portfolio','product'),
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
				'name'  => "Advertising after header 1",
				'id'    => $prefix.'header_adv_n',
				'type'  => 'heading'
			),
			array(
				'name'    => 'Advertising type',
				'desc'    => 'Advertising type .',
				'id'      => $prefix.'header_adv_type_1',
				'std'     => 'custom_image',
				'type'    => 'radio',
				'class'   => 'radio',
				'options' => array("display_code" => "Display code","custom_image" => "Custom Image")
			),
			array(
				'name' => 'Image URL',
				'desc' => 'Upload a image, or enter URL to an image if it is already uploaded. ',
				'id'   => $prefix.'header_adv_img_1',
				'std'  => '',
				'type' => 'upload'
			),
			array(
				'name' => 'Advertising url',
				'desc' => 'Advertising url. ',
				'id'   => $prefix.'header_adv_href_1',
				'std'  => '#',
				'type' => 'text'
			),
			array(
				'name' => "Advertising Code html ( Ex: Google ads)",
				'desc' => "Advertising Code html ( Ex: Google ads)",
				'id'   => $prefix.'header_adv_code_1',
				'std'  => '',
				'type' => 'textarea'
			),
			array(
				'name'  => "Advertising after header 2",
				'id'    => $prefix.'header_adv_n',
				'type'  => 'heading'
			),
			array(
				'name'    => 'Advertising type',
				'desc'    => 'Advertising type .',
				'id'      => $prefix.'header_adv_type',
				'std'     => 'custom_image',
				'type'    => 'radio',
				'class'   => 'radio',
				'options' => array("display_code" => "Display code","custom_image" => "Custom Image")
			),
			array(
				'name' => 'Image URL',
				'desc' => 'Upload a image, or enter URL to an image if it is already uploaded. ',
				'id'   => $prefix.'header_adv_img',
				'std'  => '',
				'type' => 'upload'
			),
			array(
				'name' => 'Advertising url',
				'desc' => 'Advertising url. ',
				'id'   => $prefix.'header_adv_href',
				'std'  => '#',
				'type' => 'text'
			),
			array(
				'name' => "Advertising Code html ( Ex: Google ads)",
				'desc' => "Advertising Code html ( Ex: Google ads)",
				'id'   => $prefix.'header_adv_code',
				'std'  => '',
				'type' => 'textarea'
			),
			array(
				'name'  => "Advertising inner single page sections",
				'id'    => $prefix.'share_adv_n',
				'type'  => 'heading'
			),
			array(
				'name'    => 'Advertising type',
				'desc'    => 'Advertising type .',
				'id'      => $prefix.'share_adv_type',
				'std'     => 'custom_image',
				'type'    => 'radio',
				'class'   => 'radio',
				'options' => array("display_code" => "Display code","custom_image" => "Custom Image")
			),
			array(
				'name' => 'Image URL',
				'desc' => 'Upload a image, or enter URL to an image if it is already uploaded. ',
				'id'   => $prefix.'share_adv_img',
				'std'  => '',
				'type' => 'upload'
			),
			array(
				'name' => 'Advertising url',
				'desc' => 'Advertising url. ',
				'id'   => $prefix.'share_adv_href',
				'std'  => '#',
				'type' => 'text'
			),
			array(
				'name' => "Advertising Code html ( Ex: Google ads)",
				'desc' => "Advertising Code html ( Ex: Google ads)",
				'id'   => $prefix.'share_adv_code',
				'std'  => '',
				'type' => 'textarea'
			),
			array(
				'name'  => "Advertising after content",
				'id'    => $prefix.'content_adv_n',
				'type'  => 'heading'
			),
			array(
				'name'    => 'Advertising type',
				'desc'    => 'Advertising type .',
				'id'      => $prefix.'content_adv_type',
				'std'     => 'custom_image',
				'type'    => 'radio',
				'class'   => 'radio',
				'options' => array("display_code" => "Display code","custom_image" => "Custom Image")
			),
			array(
				'name' => 'Image URL',
				'desc' => 'Upload a image, or enter URL to an image if it is already uploaded. ',
				'id'   => $prefix.'content_adv_img',
				'std'  => '',
				'type' => 'upload'
			),
			array(
				'name' => 'Advertising url',
				'desc' => 'Advertising url. ',
				'id'   => $prefix.'content_adv_href',
				'std'  => '#',
				'type' => 'text'
			),
			array(
				'name' => "Advertising Code html ( Ex: Google ads)",
				'desc' => "Advertising Code html ( Ex: Google ads)",
				'id'   => $prefix.'content_adv_code',
				'std'  => '',
				'type' => 'textarea'
			)
		),
	);
	
	$meta_boxes[] = array(
		'id' => 'css_meta',
		'title' => 'Custom css',
		'pages' => array('post','page','portfolio','product'),
		'context' => 'normal',
		'priority' => 'high',
		'fields' => array(
			array(
				'name' => 'Custom css',
				'desc' => 'Put the Custom css .',
				'id'   => $prefix.'footer_css',
				'rows' => 10,
				'type' => 'textarea'
			),
		),
	);
	
	foreach ( $meta_boxes as $meta_box ) {
		new RW_Meta_Box( $meta_box );
	}
}
?>