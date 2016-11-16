<?php
/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'options_framework_theme'
 * with the actual text domain for your theme.  Read more:
 * http://codex.WordPress.org/Function_Reference/load_theme_textdomain
 */

function optionsframework_options() {

	// Test data
	$test_array = array(
		'one' => 'One',
		'two' => 'Two',
		'three' => 'Three',
		'four' => 'Four',
		'five' => 'Five'
	);

	// Multicheck Array
	$multicheck_array = array(
		'one' => 'French Toast',
		'two' => 'Pancake',
		'three' => 'Omelette',
		'four' => 'Crepe',
		'five' => 'Waffle'
	);

	// Multicheck Defaults
	$multicheck_defaults = array(
		'one' => '1',
		'five' => '1'
	);

	// Background Defaults
	$background_defaults = array(
		'color' => '',
		'image' => '',
		'repeat' => 'repeat',
		'position' => 'top center',
		'attachment'=>'scroll' );

	// Typography Defaults
	$typography_defaults = array(
		'size' => '15px',
		'face' => 'georgia',
		'style' => 'bold',
		'color' => '#bada55' );

	// Typography Options
	$typography_options = array(
		'sizes' => array( '6','12','14','16','20' ),
		'faces' => array( 'Helvetica Neue' => 'Helvetica Neue','Arial' => 'Arial' ),
		'styles' => array( 'normal' => 'Normal','bold' => 'Bold' ),
		'color' => false
	);
	
	// Pull all the categories into an array
	$options_categories = array();
	$options_categories_obj = get_categories();
	foreach ($options_categories_obj as $category) {
		$options_categories[$category->cat_ID] = $category->cat_name;
	}
		
	// Pull all tags into an array
	$options_tags = array();
	$options_tags_obj = get_tags();
	foreach ( $options_tags_obj as $tag ) {
		$options_tags[$tag->term_id] = $tag->name;
	}

	// Pull all the pages into an array
	$options_pages = array();
	$options_pages_obj = get_pages('sort_column=post_parent,menu_order');
	$options_pages[''] = 'Select a page:';
	foreach ($options_pages_obj as $page) {
		$options_pages[$page->ID] = $page->post_title;
	}
	
	// Pull all the sidebars into an array
	$sidebars = get_option('sidebars');
	$new_sidebars = array('default'=> 'Default');
	foreach ($GLOBALS['wp_registered_sidebars'] as $sidebar) {
		$new_sidebars[$sidebar['id']] = $sidebar['name'];
	}
	
	$export = array(vpanel_options,"sidebars");
	$current_options = array();
	foreach ($export as $options) {
		if (get_option($options)) {
			$current_options[$options] = get_option($options);
		}else {
			$current_options[$options] = array();
		}
	}
	$current_options_e = base64_encode(serialize($current_options));
	
	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/admin/images/';

	$options = array();
	
	$options[] = array(
		'name' => '基本设置',
		'type' => 'heading');
	
	$options[] = array(
		'name' => '启用加载程序',
		'desc' => '选择On启用加载程序。',
		'id' => 'loader',
		'std' => 'on',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => '启用条纹',
		'desc' => '选择On启用条纹。',
		'id' => 'stripe',
		'std' => 'on',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => '启用细小滚动条',
		'desc' => '选择On启用细小滚动条。',
		'id' => 'nicescroll',
		'std' => 'on',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => '启用SEO选项',
		'desc' => '选择On启用SEO选项。',
		'id' => 'seo_active',
		'std' => 'on',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => "脸书分享图片",
		'desc' => "这是设置脸书分享图片。",
		'id' => 'fb_share_image',
		'type' => 'upload');
	
	$options[] = array(
		'name' => "网页头部代码",
		'desc' => "在框中粘贴你的谷歌统计代码。",
		'id' => 'head_code',
		'std' => '',
		'type' => 'textarea');

	$options[] = array(
		'name' => "网页脚部代码",
		'desc' => "在框中粘贴网页脚部代码。",
		'id' => 'footer_code',
		'std' => '',
		'type' => 'textarea');

	$options[] = array(
		'name' => "自定义CSS代码",
		'desc' => "高级CSS选项, 在框中粘贴你的CSS代码。",
		'id' => 'custom_css',
		'std' => '',
		'type' => 'textarea');
	
	$options[] = array(
		'name' => "SEO关键字",
		'desc' => "在框中粘贴你的关键字。",
		'id' => 'the_keywords',
		'std' => '',
		'type' => 'textarea');
	
	$options[] = array(
		'name' => "WordPress登录标志",
		'desc' => "这是出现在WordPress默认登录页面的标志。",
		'id' => 'login_logo',
		'type' => 'upload');
	
	$options[] = array(
		"name" => "WordPress登录标志高度",
		"id" => "login_logo_height",
		"type" => "sliderui",
		"step" => "1",
		"min" => "0",
		"max" => "300",);
	
	$options[] = array(
		"name" => "WordPress登录标志宽度",
		"id" => "login_logo_width",
		"type" => "sliderui",
		"step" => "1",
		"min" => "0",
		"max" => "300",);
	
	$options[] = array(
		'name' => "自定义网站图标",
		'desc' => "在这里上传网站图标（favicon），你可以在favicon.cc创建新的网站图标。",
		'id' => 'favicon',
		'type' => 'upload');
	
	$options[] = array(
		'name' => "为iPhone自定义网站图标",
		'desc' => "上传你的自定义iPhone网站图标",
		'id' => 'iphone_icon',
		'type' => 'upload');
	
	$options[] = array(
		'name' => "自定义iPhone视网膜网站图标",
		'desc' => "上传你的自定义iPhone视网膜网站图标",
		'id' => 'iphone_icon_retina',
		'type' => 'upload');
	
	$options[] = array(
		'name' => "为iPad自定义网站图标",
		'desc' => "上传你的自定义iPad网站图标",
		'id' => 'ipad_icon',
		'type' => 'upload');
	
	$options[] = array(
		'name' => "自定义iPad视网膜网站图标",
		'desc' => "上传你的自定义iPad视网膜网站图标",
		'id' => 'ipad_icon_retina',
		'type' => 'upload');
	
	$options[] = array(
		'name' => '页眉设置',
		'type' => 'heading');
	
	$options[] = array(
		'name' => "页眉风格",
		'desc' => "选择页眉风格。",
		'id' => "header_style",
		'std' => "1",
		'type' => "select",
		'options' => array(
			'1' => 'Header 1',
			'2' => 'Header 2',
			'3' => 'Header 3',
			'4' => 'Header 4',
			'5' => 'Header 5',
		)
	);
	
	$options[] = array(
		'name' => '标志显示',
		'desc' => '选择标志显示。',
		'id' => 'logo_display',
		'std' => 'display_title',
		'type' => 'radio',
		'options' => array("display_title" => "显示网站标题","custom_image" => "自定义图片"));
	
	$options[] = array(
		'name' => '标志上传',
		'desc' => '上传自定义标志。 ',
		'id' => 'logo_img',
		'std' => '',
		'type' => 'upload');
	
	$options[] = array(
		'name' => '视网膜标志上传',
		'desc' => '上传你的自定义视网膜标志。',
		'id' => 'retina_logo',
		'std' => '',
		'type' => 'upload');
	
	$options[] = array(
		'name' => '页眉菜单设置',
		'desc' => '选择On在页眉启用菜单。',
		'id' => 'header_menu',
		'std' => 'on',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => '页眉菜单风格',
		'desc' => '选择页眉菜单风格。',
		'id' => 'header_menu_style',
		'std' => '1',
		'options' => array("1" => "风格 1","2" => "风格 2"),
		'type' => 'radio');
	
	$options[] = array(
		'name' => '固定页眉选项',
		'desc' => '选择On启用固定页眉。',
		'id' => 'header_fixed',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => '在移动端停止固定页眉的选项',
		'desc' => '选择On在移动端停止固定页眉。',
		'id' => 'header_fixed_responsive',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => '广告类型',
		'desc' => '广告类型。',
		'id' => 'header_adv_type_3',
		'std' => 'custom_image',
		'type' => 'radio',
		'options' => array("display_code" => "显示代码","custom_image" => "自定义图片"));
	
	$options[] = array(
		'name' => '图片网址',
		'desc' => '上传一张图片，或者，输入一条图片网址，如果你已经上传。',
		'id' => 'header_adv_img_3',
		'std' => '',
		'type' => 'upload');
	
	$options[] = array(
		'name' => '广告网址',
		'desc' => '广告网址。',
		'id' => 'header_adv_href_3',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => "广告HTML代码（例如：谷歌广告）",
		'desc' => "广告HTML代码（例如：谷歌广告）。",
		'id' => 'header_adv_code_3',
		'std' => '',
		'type' => 'textarea');
	
	$options[] = array(
		'name' => '页眉购物车设置',
		'desc' => '选择On在页眉启用购物车。',
		'id' => 'header_cart',
		'std' => 'on',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => '页眉搜索设置',
		'desc' => '选择On在页眉启用搜索。',
		'id' => 'header_search',
		'std' => 'on',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => '页眉关注设置',
		'desc' => '选择On在页眉启用关注我。',
		'id' => 'header_follow',
		'std' => 'on',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => '页眉关注风格',
		'desc' => '选择页眉关注风格。',
		'id' => 'header_follow_style',
		'std' => '1',
		'options' => array("1" => "风格 1","2" => "风格 2"),
		'type' => 'radio');
	
	$options[] = array(
		'name' => 'Facebook URL',
		'desc' => 'Type the facebook URL from here .',
		'id' => 'facebook_icon_h',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Twitter URL',
		'desc' => 'Type the twitter URL from here .',
		'id' => 'twitter_icon_h',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Google plus URL',
		'desc' => 'Type the google plus URL from here .',
		'id' => 'gplus_icon_h',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Linkedin URL',
		'desc' => 'Type the linkedin URL from here .',
		'id' => 'linkedin_icon_h',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Dribbble URL',
		'desc' => 'Type the dribbble URL from here .',
		'id' => 'dribbble_icon_h',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Youtube URL',
		'desc' => 'Type the youtube URL from here .',
		'id' => 'youtube_icon_h',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Vimeo URL',
		'desc' => 'Type the vimeo URL from here .',
		'id' => 'vimeo_icon_h',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Skype',
		'desc' => 'Type the skype from here .',
		'id' => 'skype_icon_h',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Flickr URL',
		'desc' => 'Type the flickr URL from here .',
		'id' => 'flickr_icon_h',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Soundcloud URL',
		'desc' => 'Type the soundcloud URL from here .',
		'id' => 'soundcloud_icon_h',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Instagram URL',
		'desc' => 'Type the instagram URL from here .',
		'id' => 'instagram_icon_h',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Pinterest URL',
		'desc' => 'Type the pinterest URL from here .',
		'id' => 'pinterest_icon_h',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => '面包屑导航设置',
		'desc' => '选择On启用面包屑导航。',
		'id' => 'breadcrumbs',
		'std' => 'on',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => '主页',
		'type' => 'heading');
	
	$options[] = array(
		'name' => "头部幻灯片",
		'desc' => "选择头部幻灯片。",
		'id' => "head_slide",
		'std' => "none",
		'type' => "select",
		'options' => array(
			'header' => 'Header',
			'footer' => 'Footer',
			'none' => 'None',
		)
	);
	
	$options[] = array(
		'name' => '头部的顶部工作在全部页面还是只工作在主页？',
		'desc' => '头部的顶部工作在全部页面还是只工作在主页？',
		'id' => 'head_top_work',
		'std' => "home_page",
		'options' => array(
			'home_page' => '主页',
			'all_pages' => '全部页面',
		),
		'type' => 'select'
	);
	
	$options[] = array(
		'name' => "头部幻灯片背景",
		'desc' => "选择头部幻灯片背景。",
		'id' => "head_slide_background",
		'std' => "transparent",
		'type' => "select",
		'options' => array(
			'transparent' => '透明',
			'blue' => '深蓝',
			'custom' => '自定义',
		)
	);
	
	$options[] = array(
		'name' =>  "自定义背景",
		'desc' => "自定义背景",
		'id' => 'head_slide_custom_background',
		'std' => $background_defaults,
		'type' => 'background' );
		
	$options[] = array(
		'name' => "全屏背景",
		'desc' => "点击On启用全屏背景。",
		'id' => 'head_slide_full_screen_background',
		'std' => '0',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => '启用或禁用新闻快报',
		'desc' => '启用或禁用新闻快报。',
		'id' => 'news_ticker',
		'std' => "on",
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => "新闻快报摘要标题",
		'desc' => "输入新闻快报摘要标题",
		'id' => 'news_excerpt_title',
		'type' => 'text',
		'std' => "5");
	
	$options[] = array(
		'name' => "新闻快报数量",
		'desc' => "输入新闻快报数量",
		'id' => 'news_number',
		'type' => 'text',
		'std' => "5");
	
	$options[] = array(
		'name' => "排序",
		'desc' => "选择新闻快报排序方式",
		'id' => "orderby_news",
		'std' => "recent",
		'type' => "select",
		'options' => array(
			'recent' => '最新',
			'popular' => '热门',
			'random' => '随机',
		)
	);
	
	$options[] = array(
		'name'		=> "显示",
		'id'		=> "news_display",
		'type'		=> 'select',
		'options'	=> array(
			'lasts'	=> '持续',
			'single_category' => '单个分类',
			'multiple_categories' => '多个分类',
			'posts'	=> '自定义文章',
		),
		'std'		=> 'lasts',
	);
	
	$options[] = array(
		'name'		=> '单个分类',
		'id'		=> 'news_single_category',
		'type'		=> 'select',
		'options'	=> $options_categories,
	);
	
	$options[] = array(
		'name' => "新闻快报分类",
		'desc' => "选择新闻快报的分类。",
		'id' => "news_categories",
		'std' => '',
		'options' => $options_categories,
		'type' => 'multicheck');
	
	$options[] = array(
		'name' => "头部文章ID",
		'desc' => "选择头部文章的ID。",
		'id' => "news_posts",
		'std' => '',
		'type' => 'text',);
	
	$options[] = array(
		'name' => '头部幻灯片设置',
		'class' => 'top_head_setting',
		'type' => 'info');
	
	$options[] = array(
		'name' => "头部幻灯片风格",
		'desc' => "选择头部幻灯片风格。",
		'id' => "head_slide_style",
		'std' => "slideshow_thumbnail",
		'type' => "select",
		'options' => array(
			'slideshow' => '自动播放',
			'slideshow_thumbnail' => '自动播放和缩略图',
			'thumbnail_slideshow' => '缩略图和自动播放',
			'thumbnail' => '缩略图',
			'video_container' => '视频容器',
			'video_full' => '视频全宽',
			'none' => 'None',
		)
	);
	
	$options[] = array(
		'name'		=> '视频类型',
		'id'		=> 'video_head',
		'type'		=> 'select',
		'options'	=> array(
			'youtube' => "Youtube",
			'vimeo' => "Vimeo",
			'daily' => "Dialymotion",
			'embed' => "Custom embed",
		),
		'std'		=> 'youtube',
		'desc'		=> '从这里的视频类型中选择'
	);
	
	$options[] = array(
		'name'		=> '自定义内嵌',
		'desc'		=> "输入你的自定义内嵌HTML",
		'id'		=> "custom_embed_head",
		'type'		=> 'textarea',
		'cols'		=> "40",
		'rows'		=> "8"
	);
	
	$options[] = array(
		'name'		=> '视频ID',
		'id'		=> 'video_id_head',
		'desc'		=> '在这里输入视频ID : http://www.youtube.com/watch?v=sdUUx5FdySs 例如 : "sdUUx5FdySs"',
		'type'		=> 'text',
		'std'		=> ''
	);
	
	$options[] = array(
		'name' => "幻灯片叠加",
		'desc' => "选择幻灯片叠加。",
		'id' => "slide_overlay",
		'std' => "enable",
		'type' => "select",
		'options' => array(
			'enable' => 'Enable',
			'title' => 'Title',
			'disable' => 'Disable',
		)
	);
	
	$options[] = array(
		'name' => "幻灯片摘要标题",
		'desc' => "输入幻灯片摘要标题。",
		'id' => 'excerpt_title_slideshow',
		'type' => 'text',
		'std' => "5");
	
	$options[] = array(
		'name' => "幻灯片摘要",
		'desc' => "输入幻灯片摘要",
		'id' => 'excerpt_slideshow',
		'type' => 'text',
		'std' => "25");
	
	$options[] = array(
		'name' => "幻灯片数量",
		'desc' => "输入幻灯片数量",
		'id' => 'slideshow_number',
		'type' => 'text',
		'std' => "5");
	
	$options[] = array(
		'name' => "排序",
		'desc' => "选择幻灯片排序方式。",
		'id' => "orderby_slide",
		'std' => "recent",
		'type' => "select",
		'options' => array(
			'recent' => '最新',
			'popular' => '热门',
			'random' => '随机',
		)
	);
	
	$options[] = array(
		'name'		=> "显示",
		'id'		=> "slideshow_display",
		'type'		=> 'select',
		'options'	=> array(
			'lasts'	=> '持续',
			'single_category' => '单个分类',
			'multiple_categories' => '多个分类',
			'posts'	=> '自定义文章',
		),
		'std'		=> 'lasts',
	);
	
	$options[] = array(
		'name'		=> '单个分类',
		'id'		=> 'slideshow_single_category',
		'type'		=> 'select',
		'options'	=> $options_categories,
	);
	
	$options[] = array(
		'name' => "幻灯片分类",
		'desc' => "Select the slideshow categories .",
		'id' => "slideshow_categories",
		'std' => '',
		'options' => $options_categories,
		'type' => 'multicheck');
	
	$options[] = array(
		'name' => "幻灯片文章ID",
		'desc' => "选择幻灯片文章ID.",
		'id' => "slideshow_posts",
		'std' => '',
		'type' => 'text',);
	
	$options[] = array(
		'name' => '缩略图设置',
		'class' => 'top_head_setting thumbnail_setting',
		'type' => 'info');
	
	$options[] = array(
		'name' => "缩略图摘要标题",
		'desc' => "put the excerpt title for the thumbnail",
		'id' => 'excerpt_title_thumbnail',
		'type' => 'text',
		'std' => "5");
	
	$options[] = array(
		'name' => "缩略图数量",
		'desc' => "put the thumbnail number",
		'id' => 'thumbnail_number',
		'type' => 'text',
		'std' => "6");
	
	$options[] = array(
		'name' => "排序",
		'desc' => "选择缩略图排序。",
		'id' => "orderby_thumbnail",
		'std' => "recent",
		'type' => "select",
		'options' => array(
			'recent' => 'Recent',
			'popular' => 'Popular',
			'random' => 'Random',
		)
	);
	
	$options[] = array(
		'name'		=> "显示",
		'id'		=> "thumbnail_display",
		'type'		=> 'select',
		'options'	=> array(
			'lasts'	=> 'Lasts',
			'single_category' => 'Single category',
			'multiple_categories' => 'Multiple categories',
			'posts'	=> 'Custom posts',
		),
		'std'		=> 'lasts',
	);
	
	$options[] = array(
		'name'		=> '单个分类',
		'id'		=> 'thumbnail_single_category',
		'type'		=> 'select',
		'options'	=> $options_categories,
	);
	
	$options[] = array(
		'name' => "缩略图分类",
		'desc' => "Select the thumbnail categories .",
		'id' => "thumbnail_categories",
		'std' => '',
		'options' => $options_categories,
		'type' => 'multicheck');
	
	$options[] = array(
		'name' => "缩略图文章ID",
		'desc' => "Select the thumbnail post ids .",
		'id' => "thumbnail_posts",
		'std' => '',
		'type' => 'text',);
	
	$options[] = array(
		'name' => '验证码设置',
		'type' => 'heading');
	
	$options[] = array(
		'name' => '在添加文章表单启用或禁用验证码',
		'desc' => 'Captcha enable or disable in add post form .',
		'id' => 'the_captcha',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => '在注册表单启用或禁用验证码。',
		'desc' => 'Captcha enable or disable in register form .',
		'id' => 'the_captcha_register',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => '在评论表单启用或禁用验证码。',
		'desc' => 'Captcha enable or disable in comment form .',
		'id' => 'the_captcha_comment',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => "验证码风格",
		'desc' => "Choose the captcha style",
		'id' => 'captcha_style',
		'std' => 'question_answer',
		'type' => 'radio',
		'options' => 
			array(
				"question_answer" => "问题与答案",
				"normal_captcha" => "普通验证码"
		)
	);
	
	$options[] = array(
		'name' => '在表单启用或禁用验证码答案',
		'desc' => 'Captcha answer enable or disable in forms .',
		'id' => 'show_captcha_answer',
		'std' => 'on',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => "验证码问题",
		'desc' => "put the Captcha question",
		'id' => 'captcha_question',
		'type' => 'text',
		'std' => "埃及的首都是什么？");
	
	$options[] = array(
		'name' => "验证码答案",
		'desc' => "put the Captcha answer",
		'id' => 'captcha_answer',
		'type' => 'text',
		'std' => "开罗");
	
	$options[] = array(
		'name' => '新文章设置',
		'type' => 'heading');
	
	$options[] = array(
		'name' => '无需注册，任何人都可以添加文章',
		'desc' => 'Any one can add post without register enable or disable .',
		'id' => 'add_post_no_register',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => '选择文章状态',
		'desc' => 'Choose post status after user publish the post .',
		'id' => 'post_publish',
		'options' => array("publish" => "发布","draft" => "草稿"),
		'std' => 'draft',
		'type' => 'select');
	
	$options[] = array(
		'name' => '在添加文章表单启用或禁用标签',
		'desc' => 'Select on to enable the tags in add post form .',
		'id' => 'tags_post',
		'std' => 'on',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => '在添加文章表单启用或禁用附件',
		'desc' => 'Select on to enable the attachment in add post form .',
		'id' => 'attachment_post',
		'std' => 'on',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => '在添加文章表单启用或禁用要求详情',
		'desc' => 'Details in add post form is required .',
		'id' => 'content_post',
		'std' => 'on',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => '用户能编辑文章吗？',
		'desc' => 'The users can edit the posts ?',
		'id' => 'can_edit_post',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => "编辑文章页",
		'desc' => "Create a page using the Edit post template and select it here",
		'id' => 'edit_post',
		'type' => 'select',
		'options' => $options_pages);
	
	$options[] = array(
		'name' => '活跃用户能删除文章',
		'desc' => 'Select on if you want the user can delete the posts .',
		'id' => 'post_delete',
		'std' => 0,
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => '作品集固定链接',
		'type' => 'heading');
	
	$options[] = array(
		'name' => '作品集固定链接',
		'desc' => 'Add your portfolio slug.',
		'id' => 'portfolio_slug',
		'std' => 'portfolio',
		'type' => 'text');
	
	$options[] = array(
		'name' => '作品集分类固定链接',
		'desc' => 'Add your portfolio category slug.',
		'id' => 'category_portfolio_slug',
		'std' => 'portfolio-category',
		'type' => 'text');
	
	$options[] = array(
		'name' => '作品集标签固定链接',
		'desc' => 'Add your portfolio tag slug.',
		'id' => 'tag_portfolio_slug',
		'std' => 'portfolio-tag',
		'type' => 'text');
	
	$options[] = array(
		'name' => '博客 & 文章设置',
		'type' => 'heading');
	
	$options[] = array(
		'name' => '文章风格',
		'desc' => 'Choose post style from here .',
		'id' => 'post_style',
		'options' => array(
			'style_1'         => '1 列',
			'style_2'         => '2 列',
			'style_3'         => '3 列 (只工作在全宽)',
			'style_4'         => '1 列 小图片',
			'style_5'         => '1 列 大图片',
			'style_6'         => 'Style 6',
			'style_7'         => 'Style 7',
		),
		'std' => 'style_1',
		'type' => 'radio');
	
	$options[] = array(
		'name' => '依照此链接所示，键入日期格式: http://codex.wordpress.org/Formatting_Date_and_Time',
		'desc' => 'Type here your date format .',
		'id' => 'date_format',
		'std' => 'F j, Y',
		'type' => 'text');
	
	$options[] = array(
		'desc' => "整理你的部件",
		'name' => "整理你的部件。",
		'id' => "order_sections_li",
		'std' => '',
		'type' => 'sections');
	
	$options[] = array(
		'name' => "注意：关于作者 不能在单个作品集页面工作。",
		'class' => 'home_page_display',
		'type' => 'info');
	
	$options[] = array(
		'name' => '分类描述启用或禁用',
		'desc' => 'Click on to enable the category description in the category page .',
		'id' => 'category_description',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => '分类RSS启用或禁用',
		'desc' => 'Click on to enable the category rss in the category page .',
		'id' => 'category_rss',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => '在单个文章隐藏特色图片',
		'desc' => 'Click on to hide the featured image in the single post .',
		'id' => 'featured_image',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => '作者信息启用或禁用',
		'desc' => 'Author by enable or disable .',
		'id' => 'author_by',
		'std' => 'on',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => '分类文章启用或禁用',
		'desc' => 'Category post enable or disable .',
		'id' => 'category_post',
		'std' => 'on',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => '文章元启用或禁用',
		'desc' => 'Post meta enable or disable .',
		'id' => 'post_meta',
		'std' => 'on',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => '评论启用或禁用',
		'desc' => 'Review enable or disable .',
		'id' => 'post_review',
		'std' => 'on',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => '文章类型启用或禁用',
		'desc' => 'Post type enable or disable .',
		'id' => 'post_type',
		'std' => 'on',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => '文章作者启用或禁用',
		'desc' => 'Post author enable or disable .',
		'id' => 'post_author',
		'std' => 'on',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => '分享启用或禁用',
		'desc' => 'Share enable or disable .',
		'id' => 'post_share',
		'std' => 'on',
		'type' => 'checkbox');
		
	$options[] = array(
		'name' => '浏览启用或禁用',
		'desc' => 'Views enable or disable .',
		'id' => 'post_views',
		'std' => 'on',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => '摘要类型',
		'desc' => 'Choose form here the excerpt type .',
		'id' => 'excerpt_type',
		'std' => 5,
		'type' => "select",
		'options' => array(
			'words' => 'Words',
			'characters' => 'Characters')
		);
	
	$options[] = array(
		'name' => '摘要标题（工作在style 6）',
		'desc' => 'Put here the excerpt title .',
		'id' => 'post_excerpt_title',
		'std' => 5,
		'type' => 'text');
	
	$options[] = array(
		'name' => '摘要文章',
		'desc' => 'Put here the excerpt post .',
		'id' => 'post_excerpt',
		'std' => 40,
		'type' => 'text');
	
	$options[] = array(
		'name' => '分页样式',
		'desc' => 'Choose pagination style from here .',
		'id' => 'post_pagination',
		'options' => array(
			'standard' => '标准',
			'pagination' => '页码',
			'none' => 'None',
		),
		'std' => 'standard',
		'type' => 'radio');
	
	$options[] = array(
		'name' => '分页文章启用或禁用',
		'desc' => 'Navigation post ( next and previous posts) enable or disable .',
		'id' => 'post_navigation',
		'std' => 'on',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => '作者信息框启用或禁用',
		'desc' => 'Author info box enable or disable .',
		'id' => 'post_author_box',
		'std' => 'on',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => '相关文章启用或禁用',
		'desc' => 'Related post enable or disable .',
		'id' => 'related_post',
		'std' => 'on',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => '相关文章数量',
		'desc' => 'Type related post number from here .',
		'id' => 'related_number',
		'std' => '4',
		'type' => 'text');
	
	$options[] = array(
		'name' => '全宽时相关文章数量',
		'desc' => 'Type related post number full width from here .',
		'id' => 'related_number_full',
		'std' => '6',
		'type' => 'text');
	
	$options[] = array(
		'name' => '相关文章摘要标题',
		'desc' => 'Type excerpt title in related post from here .',
		'id' => 'excerpt_related_title',
		'std' => '5',
		'type' => 'text');
	
	$options[] = array(
		'name' => '评论启用或禁用',
		'desc' => 'Comments enable or disable .',
		'id' => 'post_comments',
		'std' => 'on',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => '404页的内容',
		'desc' => 'Type here the content in 404 page .',
		'id' => '404_page',
		'std' => 'Lorem ipsum dolor sit amet, mauris suspendisse viverra eleifend tortor tellus suscipit, tortor aliquet at nulla mus, dignissim neque, nulla neque.',
		'type' => 'textarea');
	
	if ( class_exists( 'woocommerce' ) ) {
		$options[] = array(
			'name' => '产品设置',
			'type' => 'heading');
		
		$options[] = array(
			'name' => '相关产品数量',
			'desc' => 'Type related products number from here .',
			'id' => 'related_products_number',
			'std' => '3',
			'type' => 'text');
		
		$options[] = array(
			'name' => '全宽时相关产品数量',
			'desc' => 'Type related products number full width from here .',
			'id' => 'related_products_number_full',
			'std' => '4',
			'type' => 'text');
		
		$options[] = array(
			'name' => '产品页摘要标题',
			'desc' => 'Type excerpt title in products pages from here .',
			'id' => 'products_excerpt_title',
			'std' => '40',
			'type' => 'text');
		
		$options[] = array(
			'name' => "产品侧边栏布局",
			'desc' => "Products sidebar layout .",
			'id' => "products_sidebar_layout",
			'std' => "default",
			'type' => "images",
			'options' => array(
				'default' => $imagepath.'sidebar_default.jpg',
				'right' => $imagepath.'sidebar_right.jpg',
				'full' => $imagepath.'sidebar_no.jpg',
				'left' => $imagepath.'sidebar_left.jpg',
				'centered' => $imagepath.'centered.jpg',
			)
		);
		
		$options[] = array(
			'name' => "产品页侧边栏",
			'desc' => "Products Page Sidebar .",
			'id' => "products_sidebar",
			'std' => '',
			'options' => $new_sidebars,
			'type' => 'select');
		
		$options[] = array(
			'name' => "产品页布局",
			'desc' => "Products page layout .",
			'id' => "products_layout",
			'std' => "default",
			'type' => "images",
			'options' => array(
				'default' => $imagepath.'sidebar_default.jpg',
				'full' => $imagepath.'full.jpg',
				'fixed' => $imagepath.'fixed.jpg',
				'fixed_2' => $imagepath.'fixed_2.jpg'
			)
		);
		
		$options[] = array(
			'name' => "选择模板",
			'desc' => "Choose template layout .",
			'id' => "products_template",
			'std' => "default",
			'type' => "images",
			'options' => array(
				'default' => $imagepath.'sidebar_default.jpg',
				'grid_1200' => $imagepath.'template_1200.jpg',
				'grid_970' => $imagepath.'template_970.jpg'
			)
		);
		
		$options[] = array(
			'name' => "网站皮肤",
			'desc' => "Choose Site skin .",
			'id' => "products_skin_l",
			'std' => "default",
			'type' => "images",
			'options' => array(
				'default' => $imagepath.'sidebar_default.jpg',
				'site_light' => $imagepath.'light.jpg',
				'site_dark' => $imagepath.'dark.jpg'
			)
		);
		
		$options[] = array(
			'name' => "选择你的皮肤",
			'desc' => "Choose Your Skin",
			'class' => "site_skin",
			'id' => "products_skin",
			'std' => "default",
			'type' => "images",
			'options' => array(
				'default'	=> $imagepath.'default_color.jpg',
				'skin'	=> $imagepath.'default.jpg',
				'bright_cyan'	=> $imagepath.'bright_cyan.jpg',
				'bright_pink'	=> $imagepath.'bright_pink.jpg',
				'dark_grayish_blue'	=> $imagepath.'dark_grayish_blue.jpg',
				'dark_grayish_cyan'	=> $imagepath.'dark_grayish_cyan.jpg',
				'dark_grayish_cyan_2'	=> $imagepath.'dark_grayish_cyan_2.jpg',
				'dark_green'	=> $imagepath.'dark_green.jpg',
				'dark_moderate_violet'	=> $imagepath.'dark_moderate_violet.jpg',
				'dark_pink'	=> $imagepath.'dark_pink.jpg',
				'light_orange'	=> $imagepath.'light_orange.jpg',
				'lime_green'	=> $imagepath.'lime_green.jpg',
				'moderate_blue'	=> $imagepath.'moderate_blue.jpg',
				'moderate_blue_2'	=> $imagepath.'moderate_blue_2.jpg',
				'moderate_cyan'	=> $imagepath.'moderate_cyan.jpg',
				'moderate_violet'	=> $imagepath.'moderate_violet.jpg',
				'slightly_desaturated_blue'	=> $imagepath.'slightly_desaturated_blue.jpg',
				'soft_blue'	=> $imagepath.'soft_blue.jpg',
				'soft_cyan'	=> $imagepath.'soft_cyan.jpg',
				'soft_red'	=> $imagepath.'soft_red.jpg',
				'soft_yellow'	=> $imagepath.'soft_yellow.jpg',
				'strong_cyan'	=> $imagepath.'strong_cyan.jpg',
				'strong_orange'	=> $imagepath.'strong_orange.jpg',
				'strong_red'	=> $imagepath.'strong_red.jpg',
				'very_light_pink'	=> $imagepath.'very_light_pink.jpg',
				'vivid_cyan'	=> $imagepath.'vivid_cyan.jpg',
				'vivid_orange'	=> $imagepath.'vivid_orange.jpg',
				'vivid_orange_2'	=> $imagepath.'vivid_orange_2.jpg',
				'vivid_orange_3'	=> $imagepath.'vivid_orange_3.jpg',
				'vivid_yellow'	=> $imagepath.'vivid_yellow.jpg',
				'vivid_yellow_2'	=> $imagepath.'vivid_yellow_2.jpg',
				'yellow'	=> $imagepath.'yellow.jpg',
				'red'	=> $imagepath.'red.jpg',
				'purple'	=> $imagepath.'purple.jpg',
				'orange'	=> $imagepath.'orange.jpg',
				'light_red'	=> $imagepath.'light_red.jpg',
				'green'	=> $imagepath.'green.jpg',
				'gray'	=> $imagepath.'gray.jpg',
				'blue'	=> $imagepath.'blue.jpg',
			)
		);
		
		$options[] = array(
			'name' => "首要颜色",
			'desc' => "Primary Color",
			'id' => 'products_primary_color',
			'type' => 'color' );
		
		$options[] = array(
			'name' => "次要颜色 ( it's darkness more than primary color )",
			'desc' => "Secondary Color ( it's darkness more than primary color )",
			'id' => 'products_secondary_color',
			'type' => 'color' );
		
		$options[] = array(
			'name' => "背景类型",
			'desc' => "Background Type",
			'id' => 'products_background_type',
			'std' => 'patterns',
			'type' => 'radio',
			'options' => 
				array(
					"patterns" => "Patterns",
					"custom_background" => "Custom Background"
				)
		);
	
		$options[] = array(
			'name' => "背景颜色",
			'desc' => "Background Color",
			'id' => 'products_background_color',
			'std' => "#FFF",
			'type' => 'color' );
			
		$options[] = array(
			'name' => "选择模式",
			'desc' => "Choose Pattern",
			'id' => "products_background_pattern",
			'std' => "bg13",
			'type' => "images",
			'options' => array(
				'bg1' => $imagepath.'bg1.jpg',
				'bg2' => $imagepath.'bg2.jpg',
				'bg3' => $imagepath.'bg3.jpg',
				'bg4' => $imagepath.'bg4.jpg',
				'bg5' => $imagepath.'bg5.jpg',
				'bg6' => $imagepath.'bg6.jpg',
				'bg7' => $imagepath.'bg7.jpg',
				'bg8' => $imagepath.'bg8.jpg',
				'bg9' => $imagepath.'../../images/patterns/bg9.png',
				'bg10' => $imagepath.'../../images/patterns/bg10.png',
				'bg11' => $imagepath.'../../images/patterns/bg11.png',
				'bg12' => $imagepath.'../../images/patterns/bg12.png',
				'bg13' => $imagepath.'bg13.jpg',
				'bg14' => $imagepath.'bg14.jpg',
				'bg15' => $imagepath.'../../images/patterns/bg15.png',
				'bg16' => $imagepath.'../../images/patterns/bg16.png',
				'bg17' => $imagepath.'bg17.jpg',
				'bg18' => $imagepath.'bg18.jpg',
				'bg19' => $imagepath.'bg19.jpg',
				'bg20' => $imagepath.'bg20.jpg',
				'bg21' => $imagepath.'../../images/patterns/bg21.png',
				'bg22' => $imagepath.'bg22.jpg',
				'bg23' => $imagepath.'../../images/patterns/bg23.png',
				'bg24' => $imagepath.'../../images/patterns/bg24.png',
		));
	
		$options[] = array(
			'name' =>  "自定义背景",
			'desc' => "Custom Background",
			'id' => 'products_custom_background',
			'std' => $background_defaults,
			'type' => 'background' );
			
		$options[] = array(
			'name' => "全屏背景",
			'desc' => "Click on to Full Screen Background",
			'id' => 'products_full_screen_background',
			'std' => '0',
			'type' => 'checkbox');
	}
	
	$options[] = array(
		'name' => '侧边栏',
		'type' => 'heading');
	
	$options[] = array(
		'desc' => "添加你的侧边栏。",
		'id' => "sidebars",
		'std' => '',
		'type' => 'sidebar');
	
	$options[] = array(
		'name' => "侧边栏布局",
		'desc' => "Sidebar layout .",
		'id' => "sidebar_layout",
		'std' => "right",
		'type' => "images",
		'options' => array(
			'right' => $imagepath.'sidebar_right.jpg',
			'full' => $imagepath.'sidebar_no.jpg',
			'left' => $imagepath.'sidebar_left.jpg',
			'centered' => $imagepath.'centered.jpg',
		)
	);
	
	$options[] = array(
		'name' => "粘性侧边栏",
		'desc' => "Click on to active the sticky sidebar",
		'id' => 'sticky_sidebar',
		'std' => 'on',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => "主页侧边栏",
		'desc' => "Home Page Sidebar .",
		'id' => "sidebar_home",
		'std' => '',
		'options' => $new_sidebars,
		'type' => 'select');
	
	$options[] = array(
		'name' => "首页，文章和页面",
		'desc' => "Else home page , single and page .",
		'id' => "else_sidebar",
		'std' => '',
		'options' => $new_sidebars,
		'type' => 'select');
	
	$options[] = array(
		'name' => '作者风格',
		'type' => 'heading');
	
	$options[] = array(
		'name' => '在关于作者框中启用或禁用文章作者',
		'desc' => 'Post author enable or disable in about author box .',
		'id' => 'author_img',
		'std' => 'on',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => '文章样式',
		'desc' => 'Choose post style from here .',
		'id' => 'author_post_style',
		'options' => array(
			'style_1' => '1 column',
			'style_2' => '2 columns',
			'style_3' => '3 columns ( work in full with only )',
			'style_4' => '1 columns small image',
			'style_5' => '1 columns large image',
			'style_6' => 'Style 6',
			'style_7' => 'Style 7',
			'slider'  => 'Slider',
		),
		'std' => 'style_1',
		'type' => 'radio');
	
	$options[] = array(
		'name' => '最多显示的博客网页（只工作在侧边栏风格）)',
		'desc' => 'Type here blog pages show at most ( work in slider style only )',
		'id' => 'author_blog_pages_show',
		'std' => '4',
		'type' => 'text');
	
	$options[] = array(
		'name' => '在作者网页的摘要标题',
		'desc' => 'Type excerpt title in author page from here .',
		'id' => 'author_excerpt_title',
		'std' => '5',
		'type' => 'text');
	
	$options[] = array(
		'name' => "作者侧边栏布局",
		'desc' => "Author sidebar layout .",
		'id' => "author_sidebar_layout",
		'std' => "default",
		'type' => "images",
		'options' => array(
			'default' => $imagepath.'sidebar_default.jpg',
			'right' => $imagepath.'sidebar_right.jpg',
			'full' => $imagepath.'sidebar_no.jpg',
			'left' => $imagepath.'sidebar_left.jpg',
			'centered' => $imagepath.'centered.jpg',
		)
	);
	
	$options[] = array(
		'name' => "作者页面侧边栏",
		'desc' => "Author Page Sidebar .",
		'id' => "author_sidebar",
		'std' => '',
		'options' => $new_sidebars,
		'type' => 'select');
	
	$options[] = array(
		'name' => "作者页面布局",
		'desc' => "Author page layout .",
		'id' => "author_layout",
		'std' => "default",
		'type' => "images",
		'options' => array(
			'default' => $imagepath.'sidebar_default.jpg',
			'full' => $imagepath.'full.jpg',
			'fixed' => $imagepath.'fixed.jpg',
			'fixed_2' => $imagepath.'fixed_2.jpg'
		)
	);
	
	$options[] = array(
		'name' => "选择模板",
		'desc' => "Choose template layout .",
		'id' => "author_template",
		'std' => "default",
		'type' => "images",
		'options' => array(
			'default' => $imagepath.'sidebar_default.jpg',
			'grid_1200' => $imagepath.'template_1200.jpg',
			'grid_970' => $imagepath.'template_970.jpg'
		)
	);
	
	$options[] = array(
		'name' => "网站皮肤",
		'desc' => "Choose Site skin .",
		'id' => "author_skin_l",
		'std' => "default",
		'type' => "images",
		'options' => array(
			'default' => $imagepath.'sidebar_default.jpg',
			'site_light' => $imagepath.'light.jpg',
			'site_dark' => $imagepath.'dark.jpg'
		)
	);
	
	$options[] = array(
		'name' => "选择你的皮肤",
		'desc' => "Choose Your Skin",
		'class' => "site_skin",
		'id' => "author_skin",
		'std' => "default",
		'type' => "images",
		'options' => array(
			'default'	=> $imagepath.'default_color.jpg',
			'skin'	=> $imagepath.'default.jpg',
			'bright_cyan'	=> $imagepath.'bright_cyan.jpg',
			'bright_pink'	=> $imagepath.'bright_pink.jpg',
			'dark_grayish_blue'	=> $imagepath.'dark_grayish_blue.jpg',
			'dark_grayish_cyan'	=> $imagepath.'dark_grayish_cyan.jpg',
			'dark_grayish_cyan_2'	=> $imagepath.'dark_grayish_cyan_2.jpg',
			'dark_green'	=> $imagepath.'dark_green.jpg',
			'dark_moderate_violet'	=> $imagepath.'dark_moderate_violet.jpg',
			'dark_pink'	=> $imagepath.'dark_pink.jpg',
			'light_orange'	=> $imagepath.'light_orange.jpg',
			'lime_green'	=> $imagepath.'lime_green.jpg',
			'moderate_blue'	=> $imagepath.'moderate_blue.jpg',
			'moderate_blue_2'	=> $imagepath.'moderate_blue_2.jpg',
			'moderate_cyan'	=> $imagepath.'moderate_cyan.jpg',
			'moderate_violet'	=> $imagepath.'moderate_violet.jpg',
			'slightly_desaturated_blue'	=> $imagepath.'slightly_desaturated_blue.jpg',
			'soft_blue'	=> $imagepath.'soft_blue.jpg',
			'soft_cyan'	=> $imagepath.'soft_cyan.jpg',
			'soft_red'	=> $imagepath.'soft_red.jpg',
			'soft_yellow'	=> $imagepath.'soft_yellow.jpg',
			'strong_cyan'	=> $imagepath.'strong_cyan.jpg',
			'strong_orange'	=> $imagepath.'strong_orange.jpg',
			'strong_red'	=> $imagepath.'strong_red.jpg',
			'very_light_pink'	=> $imagepath.'very_light_pink.jpg',
			'vivid_cyan'	=> $imagepath.'vivid_cyan.jpg',
			'vivid_orange'	=> $imagepath.'vivid_orange.jpg',
			'vivid_orange_2'	=> $imagepath.'vivid_orange_2.jpg',
			'vivid_orange_3'	=> $imagepath.'vivid_orange_3.jpg',
			'vivid_yellow'	=> $imagepath.'vivid_yellow.jpg',
			'vivid_yellow_2'	=> $imagepath.'vivid_yellow_2.jpg',
			'yellow'	=> $imagepath.'yellow.jpg',
			'red'	=> $imagepath.'red.jpg',
			'purple'	=> $imagepath.'purple.jpg',
			'orange'	=> $imagepath.'orange.jpg',
			'light_red'	=> $imagepath.'light_red.jpg',
			'green'	=> $imagepath.'green.jpg',
			'gray'	=> $imagepath.'gray.jpg',
			'blue'	=> $imagepath.'blue.jpg',
		)
	);
	
	$options[] = array(
		'name' => "主要颜色",
		'desc' => "Primary Color",
		'id' => 'author_primary_color',
		'type' => 'color' );
	
	$options[] = array(
		'name' => "次要颜色（它比主要颜色深一些）",
		'desc' => "Secondary Color ( it's darkness more than primary color )",
		'id' => 'author_secondary_color',
		'type' => 'color' );
	
	$options[] = array(
		'name' => "背景风格",
		'desc' => "Background Type",
		'id' => 'author_background_type',
		'std' => 'patterns',
		'type' => 'radio',
		'options' => 
			array(
				"patterns" => "Patterns",
				"custom_background" => "Custom Background"
			)
	);

	$options[] = array(
		'name' => "背景颜色",
		'desc' => "Background Color",
		'id' => 'author_background_color',
		'std' => "#FFF",
		'type' => 'color' );
		
	$options[] = array(
		'name' => "选择模式",
		'desc' => "Choose Pattern",
		'id' => "author_background_pattern",
		'std' => "bg13",
		'type' => "images",
		'options' => array(
			'bg1' => $imagepath.'bg1.jpg',
			'bg2' => $imagepath.'bg2.jpg',
			'bg3' => $imagepath.'bg3.jpg',
			'bg4' => $imagepath.'bg4.jpg',
			'bg5' => $imagepath.'bg5.jpg',
			'bg6' => $imagepath.'bg6.jpg',
			'bg7' => $imagepath.'bg7.jpg',
			'bg8' => $imagepath.'bg8.jpg',
			'bg9' => $imagepath.'../../images/patterns/bg9.png',
			'bg10' => $imagepath.'../../images/patterns/bg10.png',
			'bg11' => $imagepath.'../../images/patterns/bg11.png',
			'bg12' => $imagepath.'../../images/patterns/bg12.png',
			'bg13' => $imagepath.'bg13.jpg',
			'bg14' => $imagepath.'bg14.jpg',
			'bg15' => $imagepath.'../../images/patterns/bg15.png',
			'bg16' => $imagepath.'../../images/patterns/bg16.png',
			'bg17' => $imagepath.'bg17.jpg',
			'bg18' => $imagepath.'bg18.jpg',
			'bg19' => $imagepath.'bg19.jpg',
			'bg20' => $imagepath.'bg20.jpg',
			'bg21' => $imagepath.'../../images/patterns/bg21.png',
			'bg22' => $imagepath.'bg22.jpg',
			'bg23' => $imagepath.'../../images/patterns/bg23.png',
			'bg24' => $imagepath.'../../images/patterns/bg24.png',
	));

	$options[] = array(
		'name' =>  "自定义背景",
		'desc' => "Custom Background",
		'id' => 'author_custom_background',
		'std' => $background_defaults,
		'type' => 'background' );
		
	$options[] = array(
		'name' => "全屏背景",
		'desc' => "Click on to Full Screen Background",
		'id' => 'author_full_screen_background',
		'std' => '0',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => '式样',
		'type' => 'heading');
	
	$options[] = array(
		'name' => "主页布局",
		'desc' => "Home page layout .",
		'id' => "home_layout",
		'std' => "full",
		'type' => "images",
		'options' => array(
			'full' => $imagepath.'full.jpg',
			'fixed' => $imagepath.'fixed.jpg',
			'fixed_2' => $imagepath.'fixed_2.jpg'
		)
	);
	
	$options[] = array(
		'name' => "选择模板",
		'desc' => "Choose template layout .",
		'id' => "home_template",
		'std' => "grid_1200",
		'type' => "images",
		'options' => array(
			'grid_1200' => $imagepath.'template_1200.jpg',
			'grid_970' => $imagepath.'template_970.jpg'
		)
	);
	
	$options[] = array(
		'name' => "站点皮肤",
		'desc' => "Choose Site skin .",
		'id' => "site_skin_l",
		'std' => "site_light",
		'type' => "images",
		'options' => array(
			'site_light' => $imagepath.'light.jpg',
			'site_dark' => $imagepath.'dark.jpg'
		)
	);
	
	$options[] = array(
		'name' => "选择你的皮肤",
		'desc' => "Choose Your Skin",
		'class' => "site_skin",
		'id' => "site_skin",
		'std' => "default",
		'type' => "images",
		'options' => array(
			'default'	=> $imagepath.'default.jpg',
			'bright_cyan'	=> $imagepath.'bright_cyan.jpg',
			'bright_pink'	=> $imagepath.'bright_pink.jpg',
			'dark_grayish_blue'	=> $imagepath.'dark_grayish_blue.jpg',
			'dark_grayish_cyan'	=> $imagepath.'dark_grayish_cyan.jpg',
			'dark_grayish_cyan_2'	=> $imagepath.'dark_grayish_cyan_2.jpg',
			'dark_green'	=> $imagepath.'dark_green.jpg',
			'dark_moderate_violet'	=> $imagepath.'dark_moderate_violet.jpg',
			'dark_pink'	=> $imagepath.'dark_pink.jpg',
			'light_orange'	=> $imagepath.'light_orange.jpg',
			'lime_green'	=> $imagepath.'lime_green.jpg',
			'moderate_blue'	=> $imagepath.'moderate_blue.jpg',
			'moderate_blue_2'	=> $imagepath.'moderate_blue_2.jpg',
			'moderate_cyan'	=> $imagepath.'moderate_cyan.jpg',
			'moderate_violet'	=> $imagepath.'moderate_violet.jpg',
			'slightly_desaturated_blue'	=> $imagepath.'slightly_desaturated_blue.jpg',
			'soft_blue'	=> $imagepath.'soft_blue.jpg',
			'soft_cyan'	=> $imagepath.'soft_cyan.jpg',
			'soft_red'	=> $imagepath.'soft_red.jpg',
			'soft_yellow'	=> $imagepath.'soft_yellow.jpg',
			'strong_cyan'	=> $imagepath.'strong_cyan.jpg',
			'strong_orange'	=> $imagepath.'strong_orange.jpg',
			'strong_red'	=> $imagepath.'strong_red.jpg',
			'very_light_pink'	=> $imagepath.'very_light_pink.jpg',
			'vivid_cyan'	=> $imagepath.'vivid_cyan.jpg',
			'vivid_orange'	=> $imagepath.'vivid_orange.jpg',
			'vivid_orange_2'	=> $imagepath.'vivid_orange_2.jpg',
			'vivid_orange_3'	=> $imagepath.'vivid_orange_3.jpg',
			'vivid_yellow'	=> $imagepath.'vivid_yellow.jpg',
			'vivid_yellow_2'	=> $imagepath.'vivid_yellow_2.jpg',
			'yellow'	=> $imagepath.'yellow.jpg',
			'red'	=> $imagepath.'red.jpg',
			'purple'	=> $imagepath.'purple.jpg',
			'orange'	=> $imagepath.'orange.jpg',
			'light_red'	=> $imagepath.'light_red.jpg',
			'green'	=> $imagepath.'green.jpg',
			'gray'	=> $imagepath.'gray.jpg',
			'blue'	=> $imagepath.'blue.jpg',
		)
	);
	
	$options[] = array(
		'name' => "主要颜色",
		'desc' => "Primary Color",
		'id' => 'primary_color',
		'type' => 'color' );
	
	$options[] = array(
		'name' => "次要颜色（它比主要颜色深一些）",
		'desc' => "Secondary Color ( it's darkness more than primary color )",
		'id' => 'secondary_color',
		'type' => 'color' );
	
	$options[] = array(
		'name' => "背景类型",
		'desc' => "Background Type",
		'id' => 'background_type',
		'std' => 'patterns',
		'type' => 'radio',
		'options' => 
			array(
				"patterns" => "Patterns",
				"custom_background" => "Custom Background"
			)
		);

	$options[] = array(
		'name' => "背景颜色",
		'desc' => "Background Color",
		'id' => 'background_color',
		'std' => "#FFF",
		'type' => 'color' );
		
	$options[] = array(
		'name' => "选择模式",
		'desc' => "Choose Pattern",
		'id' => "background_pattern",
		'std' => "bg13",
		'type' => "images",
		'options' => array(
			'bg1' => $imagepath.'bg1.jpg',
			'bg2' => $imagepath.'bg2.jpg',
			'bg3' => $imagepath.'bg3.jpg',
			'bg4' => $imagepath.'bg4.jpg',
			'bg5' => $imagepath.'bg5.jpg',
			'bg6' => $imagepath.'bg6.jpg',
			'bg7' => $imagepath.'bg7.jpg',
			'bg8' => $imagepath.'bg8.jpg',
			'bg9' => $imagepath.'../../images/patterns/bg9.png',
			'bg10' => $imagepath.'../../images/patterns/bg10.png',
			'bg11' => $imagepath.'../../images/patterns/bg11.png',
			'bg12' => $imagepath.'../../images/patterns/bg12.png',
			'bg13' => $imagepath.'bg13.jpg',
			'bg14' => $imagepath.'bg14.jpg',
			'bg15' => $imagepath.'../../images/patterns/bg15.png',
			'bg16' => $imagepath.'../../images/patterns/bg16.png',
			'bg17' => $imagepath.'bg17.jpg',
			'bg18' => $imagepath.'bg18.jpg',
			'bg19' => $imagepath.'bg19.jpg',
			'bg20' => $imagepath.'bg20.jpg',
			'bg21' => $imagepath.'../../images/patterns/bg21.png',
			'bg22' => $imagepath.'bg22.jpg',
			'bg23' => $imagepath.'../../images/patterns/bg23.png',
			'bg24' => $imagepath.'../../images/patterns/bg24.png',
	));

	$options[] = array(
		'name' =>  "自定义背景",
		'desc' => "Custom Background",
		'id' => 'custom_background',
		'std' => $background_defaults,
		'type' => 'background' );
		
	$options[] = array(
		'name' => "全屏背景",
		'desc' => "Click on to Full Screen Background",
		'id' => 'full_screen_background',
		'std' => '0',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => '排版',
		'type' => 'heading');
	
	$options[] = array(
		"name" => "主要字体",
		"desc" => "Typography",
		"id" => "main_font",
		"type" => "typography",
		'options' => array('faces' => vpanel_google_fonts(),"color" => false,"styles" => false,"sizes" => false));
	
	$options[] = array(
		"name" => "次要字体",
		"desc" => "Secondary font",
		"id" => "secondary_font",
		"type" => "typography",
		'options' => array('faces' => vpanel_google_fonts(),"color" => false,"styles" => false,"sizes" => false));
	
	$options[] = array(
		"name" => "第三字体",
		"desc" => "Third font",
		"id" => "third_font",
		"type" => "typography",
		'options' => array('faces' => vpanel_google_fonts(),"color" => false,"styles" => false,"sizes" => false));
	
	$options[] = array(
		"name" => "基本排版",
		"desc" => "General Typography",
		"id" => "general_typography",
		"type" => "typography",
		'options' => array('faces' => false));
	
	$options[] = array(
		"name" => "基本链接颜色",
		"desc" => "General link color",
		"id" => "general_link_color",
		"type" => "color");
	
	$options[] = array(
		"name" => "H1",
		"desc" => "Typography",
		"id" => "h1",
		"type" => "typography",
		'options' => array('faces' => false,"color" => false));
	
	$options[] = array(
		"name" => "H2",
		"desc" => "Typography",
		"id" => "h2",
		"type" => "typography",
		'options' => array('faces' => false,"color" => false));
	
	$options[] = array(
		"name" => "H3",
		"desc" => "Typography",
		"id" => "h3",
		"type" => "typography",
		'options' => array('faces' => false,"color" => false));
	
	$options[] = array(
		"name" => "H4",
		"desc" => "Typography",
		"id" => "h4",
		"type" => "typography",
		'options' => array('faces' => false,"color" => false));
	
	$options[] = array(
		"name" => "H5",
		"desc" => "Typography",
		"id" => "h5",
		"type" => "typography",
		'options' => array('faces' => false,"color" => false));
	
	$options[] = array(
		"name" => "H6",
		"desc" => "Typography",
		"id" => "h6",
		"type" => "typography",
		'options' => array('faces' => false,"color" => false));
	
	$options[] = array(
		'name' => '页眉设置',
		'class' => 'top_head_setting thumbnail_setting',
		'type' => 'info');
	
	$options[] = array(
		'name' =>  "页眉背景",
		'desc' => "Upload a image, or enter URL to an image if it is already uploaded.",
		'id' => 'header_image',
		'std' => $background_defaults,
		'type' => 'background' );
	
	$options[] = array(
		'name' => "全屏背景",
		'desc' => "Click on to Full Screen Background",
		'id' => 'header_full_screen_background',
		'std' => '0',
		'type' => 'checkbox');
	
	$options[] = array(
		"name" => "页眉链接颜色",
		"desc" => "Header link color",
		"id" => "header_link_color",
		"type" => "color");
	
	/*
	$options[] = array(
		"name" => "Header link color hover",
		"desc" => "Header link color hover",
		"id" => "header_link_color_hover",
		"type" => "color");*/
	
	$options[] = array(
		"name" => "导航菜单",
		"desc" => "Nav menu",
		"id" => "nav_menu",
		"type" => "typography",
		'options' => array('faces' => false));
	
	$options[] = array(
		"name" => "导航菜单悬停",
		"desc" => "Nav menu hover",
		"id" => "nav_menu_hover",
		"type" => "color");
	
	$options[] = array(
		"name" => "导航下拉菜单",
		"desc" => "Nav menu",
		"id" => "nav_drop_menu",
		"type" => "typography",
		'options' => array('faces' => false));
	
	$options[] = array(
		"name" => "导航下拉菜单背景",
		"desc" => "Nav drop menu background",
		"id" => "nav_drop_menu_background",
		"type" => "color");
	
	$options[] = array(
		"name" => "导航下拉菜单边框",
		"desc" => "Nav drop menu border",
		"id" => "nav_drop_menu_border",
		"type" => "color");
	
	$options[] = array(
		"name" => "导航下拉菜单链接悬停",
		"desc" => "Nav drop menu link hover",
		"id" => "nav_drop_menu_hover",
		"type" => "color");
	
	$options[] = array(
		"name" => "标志菜单背景",
		"desc" => "Icon menu background",
		"id" => "icon_menu_background",
		"type" => "color");
	
	$options[] = array(
		"name" => "标志菜单边框",
		"desc" => "Icon menu border",
		"id" => "icon_menu_border",
		"type" => "color");
	
	$options[] = array(
		"name" => "标志菜单链接",
		"desc" => "Icon menu link",
		"id" => "icon_menu_link",
		"type" => "color");
	
	$options[] = array(
		"name" => "标志菜单背景悬停",
		"desc" => "Icon menu background hover",
		"id" => "icon_menu_background_hover",
		"type" => "color");
	
	$options[] = array(
		"name" => "标志菜单边框悬停",
		"desc" => "Icon menu border hover",
		"id" => "icon_menu_border_hover",
		"type" => "color");
	
	$options[] = array(
		"name" => "标志菜单链接悬停",
		"desc" => "Icon menu link hover",
		"id" => "icon_menu_link_hover",
		"type" => "color");
	
	$options[] = array(
		'name' => '面包屑导航设置',
		'class' => 'top_head_setting thumbnail_setting',
		'type' => 'info');
	
	$options[] = array(
		"name" => "面包屑导航设置排版",
		"desc" => "Breadcrumbs typography",
		"id" => "breadcrumbs_typography",
		"type" => "typography",
		'options' => array('faces' => false));
	
	$options[] = array(
		"name" => "面包屑导航颜色",
		"desc" => "Breadcrumbs link color",
		"id" => "breadcrumbs_link_color",
		"type" => "color");
	
	$options[] = array(
		"name" => "面包屑导航悬停颜色",
		"desc" => "Breadcrumbs link hover color",
		"id" => "breadcrumbs_link_hover_color",
		"type" => "color");
	
	$options[] = array(
		'name' => '新闻设置',
		'class' => 'top_head_setting thumbnail_setting',
		'type' => 'info');
	
	$options[] = array(
		'name' =>  "头部背景",
		'desc' => "Upload a image, or enter URL to an image if it is already uploaded.",
		'id' => 'head_background_color',
		'std' => $background_defaults,
		'type' => 'background' );
	
	$options[] = array(
		"name" => "头部排版",
		"desc" => "Head typography",
		"id" => "head_typography",
		"type" => "typography",
		'options' => array('faces' => false));
	
	$options[] = array(
		'name' =>  "新闻背景",
		'desc' => "Upload a image, or enter URL to an image if it is already uploaded.",
		'id' => 'news_image',
		'std' => $background_defaults,
		'type' => 'background' );
	
	$options[] = array(
		"name" => "新闻链接排版",
		"desc" => "News link typography",
		"id" => "news_link_typography",
		"type" => "typography",
		'options' => array('faces' => false));
	
	$options[] = array(
		"name" => "新闻链接悬停颜色",
		"desc" => "News link hover color",
		"id" => "news_link_hover_color",
		"type" => "color");
	
	$options[] = array(
		"name" => "新闻箭头背景",
		"desc" => "News arrow background",
		"id" => "news_arrow_background",
		"type" => "color");
	
	$options[] = array(
		"name" => "新闻箭头颜色",
		"desc" => "News arrow color",
		"id" => "news_arrow_color",
		"type" => "color");
	
	$options[] = array(
		"name" => "新闻箭头背景悬停r",
		"desc" => "News arrow background hover",
		"id" => "news_arrow_background_hover",
		"type" => "color");
	
	$options[] = array(
		"name" => "新闻箭头颜色悬停",
		"desc" => "News arrow color hover",
		"id" => "news_arrow_color_hover",
		"type" => "color");
	
	$options[] = array(
		'name' => '幻灯片设置',
		'class' => 'top_head_setting thumbnail_setting',
		'type' => 'info');
	
	$options[] = array(
		'name' =>  "幻灯片背景",
		'desc' => "Upload a image, or enter URL to an image if it is already uploaded.",
		'id' => 'slideshow_image',
		'std' => $background_defaults,
		'type' => 'background' );
	
	$options[] = array(
		"name" => "幻灯片链接排版",
		"desc" => "Slideshow link typography",
		"id" => "slideshow_link_typography",
		"type" => "typography",
		'options' => array('faces' => false));
	
	$options[] = array(
		"name" => "幻灯片链接悬停颜色",
		"desc" => "Slideshow link hover color",
		"id" => "slideshow_link_hover_color",
		"type" => "color");
	
	$options[] = array(
		"name" => "幻灯片内容排版",
		"desc" => "Slideshow content typography",
		"id" => "slideshow_content_typography",
		"type" => "typography",
		'options' => array('faces' => false));
	
	$options[] = array(
		"name" => "幻灯片元边框",
		"desc" => "Slideshow meta border",
		"id" => "slideshow_meta_border",
		"type" => "color");
	
	$options[] = array(
		"name" => "幻灯片元颜色",
		"desc" => "Slideshow meta color",
		"id" => "slideshow_meta_color",
		"type" => "color");
	
	$options[] = array(
		"name" => "幻灯片元链接颜色",
		"desc" => "Slideshow meta link color",
		"id" => "slideshow_meta_link_color",
		"type" => "color");
	
	$options[] = array(
		"name" => "幻灯片元链接悬停颜色",
		"desc" => "Slideshow meta link hover color",
		"id" => "slideshow_meta_link_hover_color",
		"type" => "color");
	
	$options[] = array(
		"name" => "幻灯片箭头背景",
		"desc" => "Slideshow arrow background",
		"id" => "slideshow_arrow_background",
		"type" => "color");
	
	$options[] = array(
		"name" => "幻灯片箭头颜色",
		"desc" => "Slideshow arrow color",
		"id" => "slideshow_arrow_color",
		"type" => "color");
	
	$options[] = array(
		"name" => "幻灯片箭头背景悬停",
		"desc" => "Slideshow arrow background hover",
		"id" => "slideshow_arrow_background_hover",
		"type" => "color");
	
	$options[] = array(
		"name" => "幻灯片箭头颜色悬停",
		"desc" => "Slideshow arrow color hover",
		"id" => "slideshow_arrow_color_hover",
		"type" => "color");
	
	$options[] = array(
		'name' => '页眉生成器设置',
		'class' => 'top_head_setting thumbnail_setting',
		'type' => 'info');
	
	$options[] = array(
		"name" => "标题框排版",
		"desc" => "Title box typography",
		"id" => "title_box_typography",
		"type" => "typography",
		'options' => array('faces' => false));
	
	$options[] = array(
		"name" => "下面标题颜色",
		"desc" => "Under title color",
		"id" => "under_title_color",
		"type" => "color");
	
	$options[] = array(
		"name" => "标题框链接颜色",
		"desc" => "Title box link color",
		"id" => "title_box_link_color",
		"type" => "color");
	
	$options[] = array(
		"name" => "标题框链接悬停颜色",
		"desc" => "Title box link hover color",
		"id" => "title_box_link_hover_color",
		"type" => "color");
	
	$options[] = array(
		"name" => "标题内链接排版",
		"desc" => "Title inner link typography",
		"id" => "title_inner_link_typography",
		"type" => "typography",
		'options' => array('faces' => false));
	
	$options[] = array(
		"name" => "标题内链接悬停颜色",
		"desc" => "Title inner link hover color",
		"id" => "title_inner_link_hover_color",
		"type" => "color");
	
	$options[] = array(
		"name" => "框体元颜色",
		"desc" => "Box meta color",
		"id" => "box_meta_color",
		"type" => "color");
	
	$options[] = array(
		"name" => "框体元链接颜色",
		"desc" => "Box meta link color",
		"id" => "box_meta_link_color",
		"type" => "color");
	
	$options[] = array(
		"name" => "框体元链接悬停颜色",
		"desc" => "Box meta link hover color",
		"id" => "box_meta_link_hover_color",
		"type" => "color");
	
	$options[] = array(
		"name" => "内在内容排版",
		"desc" => "Content inner typography",
		"id" => "content_inner_typography",
		"type" => "typography",
		'options' => array('faces' => false));
	
	$options[] = array(
		'name' => '小工具设置',
		'class' => 'top_head_setting thumbnail_setting',
		'type' => 'info');
	
	$options[] = array(
		"name" => "小工具标题",
		"desc" => "Widget title",
		"id" => "widget_title",
		"type" => "typography",
		'options' => array('faces' => false));
	
	$options[] = array(
		"name" => "小工具标题图标背景",
		"desc" => "Widget title icon background",
		"id" => "widget_title_icon_background",
		"type" => "color");
	
	$options[] = array(
		"name" => "小工具标题图标颜色",
		"desc" => "Widget title icon color",
		"id" => "widget_title_icon_color",
		"type" => "color");
	
	$options[] = array(
		"name" => "小工具颜色",
		"desc" => "Widget color",
		"id" => "widget_color",
		"type" => "color");
	
	$options[] = array(
		"name" => "小工具链接颜色",
		"desc" => "Widget link color",
		"id" => "widget_link_color",
		"type" => "color");
	
	$options[] = array(
		"name" => "小工具链接悬停颜色",
		"desc" => "Widget link hover color",
		"id" => "widget_link_hover_color",
		"type" => "color");
	
	$options[] = array(
		'name' => '内容设置',
		'class' => 'top_head_setting thumbnail_setting',
		'type' => 'info');
	
	$options[] = array(
		"name" => "内容标题",
		"desc" => "Content title",
		"id" => "content_title",
		"type" => "typography",
		'options' => array('faces' => false));
	
	$options[] = array(
		"name" => "内容标题图标背景 — 只在style 2中工作",
		"desc" => "Content title icon background - work in style 2",
		"id" => "content_title_icon_background",
		"type" => "color");
	
	$options[] = array(
		"name" => "内容标题图标颜色 — 只在style 2中工作",
		"desc" => "Content title icon color - work in style 2",
		"id" => "content_title_icon_color",
		"type" => "color");
	
	$options[] = array(
		"name" => "内容标题链接",
		"desc" => "Content title link",
		"id" => "content_title_link",
		"type" => "color");
	
	$options[] = array(
		"name" => "内容标题链接悬停",
		"desc" => "Content title link hover",
		"id" => "content_title_link_hover",
		"type" => "color");
	
	$options[] = array(
		"name" => "内容标题",
		"desc" => "Content title",
		"id" => "content_typography",
		"type" => "typography",
		'options' => array('faces' => false));
	
	$options[] = array(
		"name" => "内容链接",
		"desc" => "Content link",
		"id" => "content_link",
		"type" => "color");
	
	$options[] = array(
		"name" => "内容链接悬停",
		"desc" => "Content link hover",
		"id" => "content_link_hover",
		"type" => "color");
	
	$options[] = array(
		'name' => '页脚设置',
		'class' => 'top_head_setting thumbnail_setting',
		'type' => 'info');
	
	$options[] = array(
		'name' =>  "页脚背景",
		'desc' => "Upload a image, or enter URL to an image if it is already uploaded.",
		'id' => 'footer_image',
		'std' => $background_defaults,
		'type' => 'background' );
	
	$options[] = array(
		'name' => "全屏背景",
		'desc' => "Click on to Full Screen Background",
		'id' => 'footer_full_screen_background',
		'std' => '0',
		'type' => 'checkbox');
	
	$options[] = array(
		"name" => "页脚颜色",
		"desc" => "Footer color",
		"id" => "footer_color",
		"type" => "color");
	
	$options[] = array(
		"name" => "页脚链接颜色",
		"desc" => "Footer link color",
		"id" => "footer_link_color",
		"type" => "color");
	
	$options[] = array(
		'name' => '在页脚的小工具设置',
		'class' => 'top_head_setting thumbnail_setting',
		'type' => 'info');
	
	$options[] = array(
		"name" => "小工具标题",
		"desc" => "Widget title",
		"id" => "footer_widget_title",
		"type" => "typography",
		'options' => array('faces' => false));
	
	$options[] = array(
		"name" => "小工具标题图标背景/下面标题",
		"desc" => "Widget title icon background/under title",
		"id" => "footer_widget_title_icon_background",
		"type" => "color");
	
	$options[] = array(
		"name" => "小工具标题图标颜色",
		"desc" => "Widget title icon color",
		"id" => "footer_widget_title_icon_color",
		"type" => "color");
	
	$options[] = array(
		"name" => "小工具颜色",
		"desc" => "Widget color",
		"id" => "footer_widget_color",
		"type" => "color");
	
	$options[] = array(
		"name" => "小工具链接颜色",
		"desc" => "Widget link color",
		"id" => "footer_widget_link_color",
		"type" => "color");
	
	$options[] = array(
		"name" => "小工具链接悬停颜色",
		"desc" => "Widget link hover color",
		"id" => "footer_widget_link_hover_color",
		"type" => "color");
	
	$options[] = array(
		'name' => '页脚底部设置',
		'class' => 'top_head_setting thumbnail_setting',
		'type' => 'info');
	
	$options[] = array(
		'name' =>  "页脚底部背景",
		'desc' => "Upload a image, or enter URL to an image if it is already uploaded.",
		'id' => 'footer_bottom_image',
		'std' => $background_defaults,
		'type' => 'background' );
	
	$options[] = array(
		'name' => "全屏背景",
		'desc' => "Click on to Full Screen Background",
		'id' => 'footer_bottom_full_screen_background',
		'std' => '0',
		'type' => 'checkbox');
	
	$options[] = array(
		"name" => "页脚底部颜色",
		"desc" => "Footer bottom color",
		"id" => "footer_bottom_color",
		"type" => "color");
	
	$options[] = array(
		"name" => "页脚底部链接颜色",
		"desc" => "Footer bottom link color",
		"id" => "footer_bottom_link_color",
		"type" => "color");
	
	$options[] = array(
		"name" => "页脚底部链接悬停颜色",
		"desc" => "Footer bottom link hover color",
		"id" => "footer_bottom_link_hover_color",
		"type" => "color");
	
	$options[] = array(
		'name' => '广告',
		'type' => 'heading');
	
	$options[] = array(
		'name' => "在页眉1（header 1）之后的广告",
		'class' => 'home_page_display',
		'type' => 'info');
	
	$options[] = array(
		'name' => '广告类型',
		'desc' => 'Advertising type .',
		'id' => 'header_adv_type_1',
		'std' => 'custom_image',
		'type' => 'radio',
		'options' => array("display_code" => "Display code","custom_image" => "Custom Image"));
	
	$options[] = array(
		'name' => '图片网址',
		'desc' => 'Upload a image, or enter URL to an image if it is already uploaded. ',
		'id' => 'header_adv_img_1',
		'std' => '',
		'type' => 'upload');
	
	$options[] = array(
		'name' => '广告网址',
		'desc' => 'Advertising url. ',
		'id' => 'header_adv_href_1',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => "广告HTML代码( Ex: Google ads)",
		'desc' => "Advertising Code html ( Ex: Google ads)",
		'id' => 'header_adv_code_1',
		'std' => '',
		'type' => 'textarea');
	
	$options[] = array(
		'name' => "在页眉2（header 2）之后的广告",
		'class' => 'home_page_display',
		'type' => 'info');
	
	$options[] = array(
		'name' => '广告类型',
		'desc' => 'Advertising type .',
		'id' => 'header_adv_type',
		'std' => 'custom_image',
		'type' => 'radio',
		'options' => array("display_code" => "Display code","custom_image" => "Custom Image"));
	
	$options[] = array(
		'name' => '图片网址',
		'desc' => 'Upload a image, or enter URL to an image if it is already uploaded. ',
		'id' => 'header_adv_img',
		'std' => '',
		'type' => 'upload');
	
	$options[] = array(
		'name' => '广告网址',
		'desc' => 'Advertising url. ',
		'id' => 'header_adv_href',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => "广告HTML代码( Ex: Google ads)",
		'desc' => "Advertising Code html ( Ex: Google ads)",
		'id' => 'header_adv_code',
		'std' => '',
		'type' => 'textarea');
	
	$options[] = array(
		'name' => "在分享和标签之后的广告（在文章页面）",
		'class' => 'home_page_display',
		'type' => 'info');
	
	$options[] = array(
		'name' => '广告类型',
		'desc' => 'Advertising type .',
		'id' => 'share_adv_type',
		'std' => 'custom_image',
		'type' => 'radio',
		'options' => array("display_code" => "Display code","custom_image" => "Custom Image"));
	
	$options[] = array(
		'name' => '图片网址',
		'desc' => 'Upload a image, or enter URL to an image if it is already uploaded. ',
		'id' => 'share_adv_img',
		'std' => '',
		'type' => 'upload');
	
	$options[] = array(
		'name' => '广告网址',
		'desc' => 'Advertising url. ',
		'id' => 'share_adv_href',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => "广告HTML代码 ( Ex: Google ads)",
		'desc' => "Advertising Code html ( Ex: Google ads)",
		'id' => 'share_adv_code',
		'std' => '',
		'type' => 'textarea');
	
	$options[] = array(
		'name' => "在内容之后的广告",
		'class' => 'home_page_display',
		'type' => 'info');
	
	$options[] = array(
		'name' => '广告类型',
		'desc' => 'Advertising type .',
		'id' => 'content_adv_type',
		'std' => 'custom_image',
		'type' => 'radio',
		'options' => array("display_code" => "Display code","custom_image" => "Custom Image"));
	
	$options[] = array(
		'name' => '图片网址',
		'desc' => 'Upload a image, or enter URL to an image if it is already uploaded. ',
		'id' => 'content_adv_img',
		'std' => '',
		'type' => 'upload');
	
	$options[] = array(
		'name' => '广告网址',
		'desc' => 'Advertising url. ',
		'id' => 'content_adv_href',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => "广告HTML代码( Ex: Google ads)",
		'desc' => "Advertising Code html ( Ex: Google ads)",
		'id' => 'content_adv_code',
		'std' => '',
		'type' => 'textarea');
	
	$options[] = array(
		'name' => '页脚设置',
		'type' => 'heading');
	
	$options[] = array(
		'name' => '页脚顶部启用或禁用',
		'desc' => 'Footer top enable or disable .',
		'id' => 'footer_top',
		'std' => 'on',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => '订阅启用或禁用',
		'desc' => 'Subscribe enable or disable .',
		'id' => 'subscribe_f',
		'std' => 'on',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Feedburner ID',
		'desc' => 'Type here the Feedburner ID .',
		'id' => 'feedburner_id',
		'type' => 'text');
	
	$options[] = array(
		'name' => '订阅的标题',
		'desc' => 'Type here the title of subscribe .',
		'id' => 'feedburner_h3',
		'std' => 'Subscribe for our weekly news letter',
		'type' => 'text');
	
	$options[] = array(
		'name' => '订阅的内容',
		'desc' => 'Type here the content of subscribe .',
		'id' => 'feedburner_p',
		'std' => 'Suspendisse non augue tincidunt, ullamcorper odio vel, tempor risus. In cursus lacus at mattis consectetur.',
		'type' => 'text');
	
	$options[] = array(
		'name' => "页脚布局( level 1 )",
		'desc' => "Footer columns Layout ( level 1 ) .",
		'id' => "footer_layout_1",
		'std' => "footer_no",
		'type' => "images",
		'options' => array(
			'footer_1c' => $imagepath . 'footer_1c.jpg',
			'footer_2c' => $imagepath . 'footer_2c.jpg',
			'footer_3c' => $imagepath . 'footer_3c.jpg',
			'footer_4c' => $imagepath . 'footer_4c.jpg',
			'footer_no' => $imagepath . 'footer_no.jpg')
	);
	
	$options[] = array(
		'name' => "页脚布局( level 2 )",
		'desc' => "Footer columns Layout ( level 2 ) .",
		'id' => "footer_layout_2",
		'std' => "footer_no",
		'type' => "images",
		'options' => array(
			'footer_1c' => $imagepath . 'footer_1c.jpg',
			'footer_2c' => $imagepath . 'footer_2c.jpg',
			'footer_3c' => $imagepath . 'footer_3c.jpg',
			'footer_4c' => $imagepath . 'footer_4c.jpg',
			'footer_no' => $imagepath . 'footer_no.jpg')
	);
	
	$options[] = array(
		'name' => '版权',
		'desc' => 'Put the copyrights of footer .',
		'id' => 'footer_copyrights',
		'std' => 'Copyright 2014 Logger | Designed By <a href=http://7oroof.com/ target=_blank>7oroof</a> | Developed By <a href=http://2code.info/ target=_blank>2codeThemes</a>',
		'type' => 'textarea');
	
	$options[] = array(
		'name' => '社交启用或禁用',
		'desc' => 'Social enable or disable .',
		'id' => 'social_icon_f',
		'std' => 'on',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'Facebook网址L',
		'desc' => 'Type the facebook URL from here .',
		'id' => 'facebook_icon_f',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Twitter网址',
		'desc' => 'Type the twitter URL from here .',
		'id' => 'twitter_icon_f',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Google plus 网址',
		'desc' => 'Type the google plus URL from here .',
		'id' => 'gplus_icon_f',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Linkedin 网址',
		'desc' => 'Type the linkedin URL from here .',
		'id' => 'linkedin_icon_f',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Dribbble 网址',
		'desc' => 'Type the dribbble URL from here .',
		'id' => 'dribbble_icon_f',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Youtube 网址',
		'desc' => 'Type the youtube URL from here .',
		'id' => 'youtube_icon_f',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Vimeo 网址',
		'desc' => 'Type the vimeo URL from here .',
		'id' => 'vimeo_icon_f',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Skype',
		'desc' => 'Type the skype from here .',
		'id' => 'skype_icon_f',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Flickr 网址',
		'desc' => 'Type the flickr URL from here .',
		'id' => 'flickr_icon_f',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Soundcloud 网址',
		'desc' => 'Type the soundcloud URL from here .',
		'id' => 'soundcloud_icon_f',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Instagram 网址',
		'desc' => 'Type the instagram URL from here .',
		'id' => 'instagram_icon_f',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Pinterest 网址',
		'desc' => 'Type the pinterest URL from here .',
		'id' => 'pinterest_icon_f',
		'std' => '#',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Rss启用或者禁用',
		'desc' => 'Rss enable or disable .',
		'id' => 'rss_icon_f',
		'std' => 'on',
		'type' => 'checkbox');
	
	$options[] = array(
		'name' => 'RSS URL 如果你想改变默认的网址',
		'desc' => 'Type the RSS URL if you want change the default URL or leave it empty for enable the default URL .',
		'id' => 'rss_icon_f_other',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'name' => "高级",
		'id' => "advanced",
		'type' => 'heading');
	
	$options[] = array(
		'name' => 'Facebook 身份验证 ( 创建 https://developers.facebook.com/apps & 从这里得到它: https://developers.facebook.com/tools/access_token )',
		'desc' => 'Facebook access token. ',
		'id' => 'facebook_access_token',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Google API ( 从这里得到它 : https://developers.google.com/+/api/oauth )',
		'desc' => 'Type here the Google API. ',
		'id' => 'google_api',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Dribbble 身份验证 ( 从这里得到它 : https://dribbble.com/account/applications/new )',
		'desc' => 'Dribbble access token. ',
		'id' => 'dribbble_access_token',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Twitter consumer key',
		'desc' => 'Twitter consumer key. ',
		'id' => 'twitter_consumer_key',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Twitter consumer secret',
		'desc' => 'Twitter consumer secret. ',
		'id' => 'twitter_consumer_secret',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Twitter access token',
		'desc' => 'Twitter access token. ',
		'id' => 'twitter_access_token',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'name' => 'Twitter access token secret',
		'desc' => 'Twitter access token secret. ',
		'id' => 'twitter_access_token_secret',
		'std' => '',
		'type' => 'text');
	
	$options[] = array(
		'name' => "如果你习惯于导出设置，请在导出之前刷新",
		'type' => 'info');

	$options[] = array(
		'name' => "导出设置",
		'desc' => "Copy this to saved file",
		'id' => 'export_setting',
		'export' => $current_options_e,
		'type' => 'export');

	$options[] = array(
		'name' => "导入设置",
		'desc' => "Put here the import setting",
		'id' => 'import_setting',
		'type' => 'import');
		
	$options[] = array(
		'name' => "汉化作者",
		'id' => "chinese_author",
		'type' => 'heading');
		
		$options[] = array(
		'name' => "Logger汉化中文版由<a href=http://www.wordpressleaf.com target=_blank>WordPress leaf</a>汉化，<a href=http://themostspecialname.com target=_blank>The Most Special Name</a>联合出品。如果您需要深度汉化请联系作者。<br>
			<a target=_blank href=http://www.wordpressleaf.com class=wordpressleaf-badge wp-badge>WordPress Leaf</a><a target=_blank href=http://themostspecialname.com class=themostspecialname-badge wp-badge>themostspecialname</a><br><br>
   		<h3 style=margin: 0 0 10px;>捐助我们</h3>
			如果您愿意捐助我们，请点击<a href=http://www.wordpressleaf.com/donate target=_blank><strong>这里</strong></a>或者使用微信扫描下面的二维码进行捐助。谢谢！<br>
			<img src=http://www.wordpressleaf.com/wp-content/themes/wordpressleaf/assets/images/weixin.png width=140 height=140 alt=捐助我们> 
		",
		'type' => 'info');
	
	return $options;
}