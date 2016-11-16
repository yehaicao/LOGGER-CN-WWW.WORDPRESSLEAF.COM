<?php
if (is_admin() and isset($_GET['activated']) and $pagenow == "themes.php")
wp_redirect('admin.php?page=options');
define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/admin/' );

/* Load lang languages */
load_theme_textdomain('vbegy',dirname(__FILE__).'/languages');

/* require files */
require_once get_template_directory() . '/admin/options-framework.php';
require_once get_template_directory() . '/admin/meta-box/meta-box.php';
require_once get_template_directory() . '/admin/meta-box/meta_box.php';
require_once get_template_directory() . '/admin/functions/aq_resizer.php';
require_once get_template_directory() . '/admin/functions/main_functions.php';
require_once get_template_directory() . '/admin/functions/widget_functions.php';
require_once get_template_directory() . '/admin/functions/nav_menu.php';
require_once get_template_directory() . '/admin/functions/register_post.php';
require_once get_template_directory() . '/admin/functions/page_builder.php';
require_once get_template_directory() . '/functions/shortcode_logger.php';
require_once get_template_directory() . '/functions/functions_logger.php';
if (!class_exists('TwitterOAuth',false)) {
	require_once (get_template_directory() . '/includes/twitteroauth/twitteroauth.php');
}

$themename = wp_get_theme();
$themename = preg_replace("/\W/", "_", strtolower($themename) );
define("vpanel_name","logger");
define("vpanel_options","vpanel_logger");
define("theme_name","Logger");

/* Builder */
include get_template_directory() . '/admin/page-builder/builder_page.php';
include get_template_directory() . '/admin/page-builder/slideshow.php';
include get_template_directory() . '/admin/page-builder/box_news.php';
include get_template_directory() . '/admin/page-builder/tabs_news.php';
include get_template_directory() . '/admin/page-builder/pictures_news.php';
include get_template_directory() . '/admin/page-builder/recent_posts.php';
include get_template_directory() . '/admin/page-builder/scroll_news.php';
include get_template_directory() . '/admin/page-builder/shop_box.php';

/* Woocommerce */
include get_template_directory() . '/admin/woocommerce/woocommerce.php';

/* Widgets */
include get_template_directory() . '/admin/widgets/counter.php';
include get_template_directory() . '/admin/widgets/login.php';
include get_template_directory() . '/admin/widgets/signup.php';
include get_template_directory() . '/admin/widgets/posts.php';
include get_template_directory() . '/admin/widgets/posts_images.php';
include get_template_directory() . '/admin/widgets/posts_big_images.php';
include get_template_directory() . '/admin/widgets/posts_slideshow.php';
include get_template_directory() . '/admin/widgets/twitter.php';
include get_template_directory() . '/admin/widgets/flickr.php';
include get_template_directory() . '/admin/widgets/dribbble.php';
include get_template_directory() . '/admin/widgets/youtube.php';
include get_template_directory() . '/admin/widgets/google.php';
include get_template_directory() . '/admin/widgets/facebook.php';
include get_template_directory() . '/admin/widgets/soundcloud.php';
include get_template_directory() . '/admin/widgets/video.php';
include get_template_directory() . '/admin/widgets/subscribe.php';
include get_template_directory() . '/admin/widgets/comments.php';
include get_template_directory() . '/admin/widgets/tabs.php';
include get_template_directory() . '/admin/widgets/about-me.php';
include get_template_directory() . '/admin/widgets/adv-120x600.php';
include get_template_directory() . '/admin/widgets/adv-234x60.php';
include get_template_directory() . '/admin/widgets/adv-250x250.php';
include get_template_directory() . '/admin/widgets/adv-120x240.php';
include get_template_directory() . '/admin/widgets/adv-125x125.php';
include get_template_directory() . '/admin/widgets/adv-300x250.php';
include get_template_directory() . '/admin/widgets/adv-300x600.php';
include get_template_directory() . '/admin/widgets/adv-336x280.php';

/* vbegy_scripts_styles */
function vbegy_scripts_styles() {
	global $post;
	$protocol = is_ssl() ? 'https' : 'http';
	wp_enqueue_style( 'open-sans', $protocol.'://fonts.googleapis.com/css?family=Open+Sans:400,600,700' );
	wp_enqueue_style( 'lato', $protocol.'://fonts.googleapis.com/css?family=Lato' );
	wp_enqueue_style( 'roboto-slab', $protocol.'://fonts.googleapis.com/css?family=Roboto+Slab:400,700' );
	wp_enqueue_style( 'droidarabickufi', $protocol.'://fonts.googleapis.com/earlyaccess/droidarabickufi.css' );
	wp_enqueue_style( 'v_base', get_template_directory_uri( __FILE__ ).'/css/base.css' );
	wp_enqueue_style( 'v_lists', get_template_directory_uri( __FILE__ ).'/css/lists.css' );
	wp_enqueue_style( 'v_bootstrap', get_template_directory_uri( __FILE__ ).'/css/bootstrap.min.css' );
	wp_enqueue_style( 'v_prettyPhoto', get_template_directory_uri( __FILE__ ).'/css/prettyPhoto.css' );
	wp_enqueue_style( 'v_font_awesome', get_template_directory_uri( __FILE__ ).'/css/font-awesome/css/font-awesome.min.css' );
	wp_enqueue_style( 'v_fontello', get_template_directory_uri( __FILE__ ).'/css/fontello/css/fontello.css' );
	wp_enqueue_style( 'v_animate_custom', get_template_directory_uri( __FILE__ ).'/css/animate-custom.css' );
	wp_enqueue_style( 'v_enotype', get_template_directory_uri( __FILE__ ).'/woocommerce/enotype/enotype.css' );
	wp_enqueue_style('v_css', get_stylesheet_uri() .  '', '', null, 'all');
	if (is_rtl()) {
		wp_enqueue_style( 'v_bootstrap_ar', get_template_directory_uri( __FILE__ ) . '/css/bootstrap.min-ar.css' );
	}
	wp_enqueue_style('v_responsive', get_template_directory_uri( __FILE__ )."/css/responsive.css");
	if (is_category()) {
		$category_id = get_query_var('cat');
		$categories = get_option("categories_$category_id");
	}
	$site_skin_all = vpanel_options("site_skin_l");
	if (is_author()) {
		$author_skin_l = vpanel_options("author_skin_l");
		if ($author_skin_l == "site_dark") {
			wp_enqueue_style('v_dark', get_template_directory_uri( __FILE__ )."/css/dark.css");
			add_filter('body_class', 'dark_skin_body_classes');
			function dark_skin_body_classes($classes) {
				$classes[] = 'dark_skin';
				return $classes;
			}
		}
	}else if (is_category()) {
		$cat_skin_l = (isset($categories["cat_skin_l"])?$categories["cat_skin_l"]:"default");
		if ($cat_skin_l == "site_dark") {
			wp_enqueue_style('v_dark', get_template_directory_uri( __FILE__ )."/css/dark.css");
			add_filter('body_class', 'dark_skin_body_classes');
			function dark_skin_body_classes($classes) {
				$classes[] = 'dark_skin';
				return $classes;
			}
		}
	}else if (is_tax("product_cat")) {
		$tax_id = get_term_by('slug',get_query_var('term'),"product_cat");
		$tax_id = $tax_id->term_id;
		$categories = get_option("categories_$tax_id");
		$cat_skin_l = (isset($categories["cat_skin_l"])?$categories["cat_skin_l"]:"default");
		if ($cat_skin_l == "" || $cat_skin_l == "default") {
			$cat_skin_l = vpanel_options("products_skin_l");
		}
		if ($cat_skin_l == "site_dark") {
			wp_enqueue_style('v_dark', get_template_directory_uri( __FILE__ )."/css/dark.css");
			add_filter('body_class', 'dark_skin_body_classes');
			function dark_skin_body_classes($classes) {
				$classes[] = 'dark_skin';
				return $classes;
			}
		}
	}else if (is_tax("product_tag") || is_post_type_archive("product")) {
		$products_skin_l = vpanel_options("products_skin_l");
		if ($products_skin_l == "site_dark") {
			wp_enqueue_style('v_dark', get_template_directory_uri( __FILE__ )."/css/dark.css");
			add_filter('body_class', 'dark_skin_body_classes');
			function dark_skin_body_classes($classes) {
				$classes[] = 'dark_skin';
				return $classes;
			}
		}
	}else if (is_single() || is_page()) {
		$vbegy_site_skin_l = rwmb_meta('vbegy_site_skin_l','radio',$post->ID);
		if (is_singular("product") && ($vbegy_site_skin_l == "" || $vbegy_site_skin_l == "default")) {
			$vbegy_site_skin_l = vpanel_options("products_skin_l");
		}
		if ($vbegy_site_skin_l == "" || $vbegy_site_skin_l == "default") {
			$vbegy_site_skin_l = $site_skin_all;
		}
		if ($vbegy_site_skin_l == "site_dark") {
			wp_enqueue_style('v_dark', get_template_directory_uri( __FILE__ )."/css/dark.css");
			add_filter('body_class', 'dark_skin_body_classes');
			function dark_skin_body_classes($classes) {
				$classes[] = 'dark_skin';
				return $classes;
			}
		}
	}else {
		if ($site_skin_all == "site_dark") {
			wp_enqueue_style('v_dark', get_template_directory_uri( __FILE__ )."/css/dark.css");
			add_filter('body_class', 'dark_skin_body_classes');
			function dark_skin_body_classes($classes) {
				$classes[] = 'dark_skin';
				return $classes;
			}
		}
	}
	
	if ((is_author() && ($author_skin_l == "" || $author_skin_l == "default")) || ((is_single() || is_page()) && ($vbegy_site_skin_l == "" || $vbegy_site_skin_l == "default")) || (is_category() && ($cat_skin_l == "" || $cat_skin_l == "default")) || (is_tax("product_cat") && ($cat_skin_l == "" || $cat_skin_l == "default")) || (is_tax("product_tag") && ($products_skin_l == "" || $products_skin_l == "default")) || ((is_post_type_archive("product")) && ($products_skin_l == "" || $products_skin_l == "default"))) {
		if ($site_skin_all == "site_dark") {
			wp_enqueue_style('v_dark', get_template_directory_uri( __FILE__ )."/css/dark.css");
			add_filter('body_class', 'dark_skin_body_classes');
			function dark_skin_body_classes($classes) {
				$classes[] = 'dark_skin';
				return $classes;
			}
		}
	}
	
	$site_skin = vpanel_options('site_skin');
	if ($site_skin != "default") {
		wp_enqueue_style('skin_'.$site_skin, get_template_directory_uri( __FILE__ )."/css/skins/".$site_skin.".css");
	}else {
		wp_enqueue_style('skin_default', get_template_directory_uri( __FILE__ )."/css/skins/skins.css");
	}
	
	vpanel_font_extract(vpanel_options("main_font"));
	vpanel_font_extract(vpanel_options("secondary_font"));
	vpanel_font_extract(vpanel_options("third_font"));
	
	wp_enqueue_style('vpanel_custom', get_template_directory_uri( __FILE__ )."/css/custom.css");
	
	$custom_css = '';
	$vbegy_layout = "";
	$cat_layout = "";
	$products_layout = "";
	$author_layout = "";
	if (is_category()) {
		$category_id = get_query_var('cat');
		$categories = get_option("categories_$category_id");
		$cat_layout = (isset($categories["cat_layout"])?$categories["cat_layout"]:"default");
		$background_img = (isset($categories["background_img"])?$categories["background_img"]:"");
		$background_color = (isset($categories["background_color"])?$categories["background_color"]:"");
		$background_repeat = (isset($categories["background_repeat"])?$categories["background_repeat"]:"");
		$background_fixed = (isset($categories["background_fixed"])?$categories["background_fixed"]:"");
		$background_position_x = (isset($categories["background_position_x"])?$categories["background_position_x"]:"");
		$background_position_y = (isset($categories["background_position_y"])?$categories["background_position_y"]:"");
		$cat_full_screen_background = (isset($categories["background_full"])?$categories["background_full"]:"");
		$cat_skin = (isset($categories["cat_skin"])?$categories["cat_skin"]:"default");
		$primary_color_c = (isset($categories["primary_color"])?$categories["primary_color"]:"");
		$secondary_color_c = (isset($categories["secondary_color"])?$categories["secondary_color"]:"");
	}else if (is_tax("product_cat")) {
		$tax_id = get_term_by('slug',get_query_var('term'),"product_cat");
		$tax_id = $tax_id->term_id;
		$categories = get_option("categories_$tax_id");
		$cat_layout = (isset($categories["cat_layout"])?$categories["cat_layout"]:"default");
		$background_img = (isset($categories["background_img"])?$categories["background_img"]:"");
		$background_color = (isset($categories["background_color"])?$categories["background_color"]:"");
		$background_repeat = (isset($categories["background_repeat"])?$categories["background_repeat"]:"");
		$background_fixed = (isset($categories["background_fixed"])?$categories["background_fixed"]:"");
		$background_position_x = (isset($categories["background_position_x"])?$categories["background_position_x"]:"");
		$background_position_y = (isset($categories["background_position_y"])?$categories["background_position_y"]:"");
		$cat_full_screen_background = (isset($categories["background_full"])?$categories["background_full"]:"");
		$cat_skin = (isset($categories["cat_skin"])?$categories["cat_skin"]:"default");
		$primary_color_c = (isset($categories["primary_color"])?$categories["primary_color"]:"");
		$secondary_color_c = (isset($categories["secondary_color"])?$categories["secondary_color"]:"");
		if ($primary_color_c == "" && $secondary_color_c == "") {
			$primary_color_c = vpanel_options('products_primary_color');
			$secondary_color_c = vpanel_options('products_secondary_color');
		}
		if ($cat_skin == "" || $cat_skin == "default") {
			$cat_skin = vpanel_options('products_skin');
		}
		$background_position = $background_position_x." ".$background_position_y;
		$background_type = "";
		$background_pattern = "";
		$custom_background = "";
		if ($cat_layout == "" || $cat_layout == "default") {
			$cat_layout = vpanel_options("products_layout");
			if ($cat_layout == "fixed" || $cat_layout == "fixed_2"):
				$background_type = vpanel_options("products_background_type");
				$custom_background = vpanel_options("products_custom_background");
				$background_pattern = vpanel_options("products_background_pattern");
				$background_img = $custom_background["image"];
				$background_color = $custom_background["color"];
				$background_repeat = $custom_background["repeat"];
				$background_fixed = $custom_background["attachment"];
				$background_position = $custom_background["position"];
				$cat_full_screen_background = vpanel_options("products_full_screen_background");
			endif;
		}
	}else if (is_tax("product_tag") || is_post_type_archive("product")) {
		$products_layout = vpanel_options('products_layout');
		$products_background_type = vpanel_options('products_background_type');
		$products_background_color = vpanel_options('products_background_color');
		$products_background_pattern = vpanel_options('products_background_pattern');
		$products_custom_background = vpanel_options('products_custom_background');
		$products_full_screen_background = vpanel_options('products_full_screen_background');
		$vbegy_skin = vpanel_options('products_skin');
		$primary_color_c = vpanel_options('products_primary_color');
		$secondary_color_c = vpanel_options('products_secondary_color');
	}else if (is_author()) {
		$author_layout = vpanel_options('author_layout');
		$author_background_type = vpanel_options('author_background_type');
		$author_background_color = vpanel_options('author_background_color');
		$author_background_pattern = vpanel_options('author_background_pattern');
		$author_custom_background = vpanel_options('author_custom_background');
		$author_full_screen_background = vpanel_options('author_full_screen_background');
		$vbegy_skin = vpanel_options('author_skin');
		$primary_color_a = vpanel_options('author_primary_color');
		$secondary_color_a = vpanel_options('author_secondary_color');
	}else if (is_single() || is_page()) {
		global $post;
		$vbegy_layout = rwmb_meta('vbegy_layout','radio',$post->ID);
		$primary_color_p = rwmb_meta('vbegy_primary_color','color',$post->ID);
		$secondary_color_p = rwmb_meta('vbegy_secondary_color','color',$post->ID);
		$vbegy_skin = rwmb_meta('vbegy_skin','radio',$post->ID);
		if (is_singular("product")) {
			$vbegy_layout = vpanel_options("products_layout");
			if ($vbegy_skin == "" || $vbegy_skin == "default") {
				$vbegy_skin = vpanel_options("products_skin");
			}
			if ($primary_color_p == "" && $secondary_color_p == "") {
				$primary_color_p = vpanel_options("products_primary_color");
				$secondary_color_p = vpanel_options("products_secondary_color");
			}
		}
		if ($vbegy_skin == "" || $vbegy_skin == "default") {
			$primary_color = vpanel_options("primary_color");
			$secondary_color = vpanel_options("secondary_color");
			if ($primary_color != "" && $secondary_color != "") :
				$custom_css .= all_css_color($primary_color,$secondary_color);
			endif;
		}
	}
	
	if (is_category() && $cat_layout != "default") {
		if ($cat_layout != "full") {
			if ($cat_full_screen_background == "on") {
				$custom_css .= '.background-cover {';
					if (!empty($background_color)) {
						$custom_css .= 'background-color: '.esc_attr($background_color);
					}
					$custom_css .= 'background-image : url("'.esc_attr($background_img).'") ;
					filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src="'.esc_attr($background_img).'",sizingMethod="scale");
					-ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\''.esc_attr($background_img).'\',sizingMethod=\'scale\')";';
				$custom_css .= '}';
			}else {
				if (!empty($background_img)) {
					$custom_css .= 'body {
						background:';
						if ($cat_full_screen_background != "on") {
							$custom_css .= esc_attr($background_color).' url('.esc_attr($background_img).') '.esc_attr($background_repeat).' '.esc_attr($background_position_x).' '.esc_attr($background_position_y).' '.esc_attr($background_fixed).';';
						}
					$custom_css .= '}';
				}
			}
		}
	}else if (is_tax("product_cat") && $cat_layout != "default") {
		if ($cat_layout != "full") {
			if ($cat_full_screen_background == "on") {
				$custom_css .= '.background-cover {';
					if (!empty($background_color)) {
						$custom_css .= 'background-color: '.$background_color.';';
					}
					$custom_css .= 'background-image : url("'.$background_img.'") ;
					filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src="'.$background_img.'",sizingMethod="scale");
					-ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\''.$background_img.'\',sizingMethod=\'scale\')";
				}';
			}else {
				if ($background_type == "patterns" || !empty($custom_background)) {
					$custom_css .= 'body {
						background:';
						if ($background_type == "patterns") {
							if ($background_pattern != "default") {
								$custom_css .= esc_attr($background_color).' url('.esc_attr(get_template_directory_uri()).'/images/patterns/'.esc_attr($background_pattern).'.png) repeat;';
							}
						}
						if (!empty($custom_background)) {
							if ($cat_full_screen_background != "on") {
								$custom_css .= esc_attr($background_color).' url("'.esc_attr($background_img).'") '.esc_attr($background_repeat).' '.esc_attr($background_fixed).' '.esc_attr($background_position).';';
							}
						}
					$custom_css .= '}';
				}
			}
		}
	}else if ((is_tax("product_tag") && $products_layout != "default") || ((is_post_type_archive("product")) && $products_layout != "default")) {
		if ($products_layout != "full") {
			$custom_background = $products_custom_background;
			if ($products_full_screen_background == 'on' && $products_background_type != "patterns") {
				$custom_css .= '.background-cover {';
					if (!empty($products_background_color)) {
						$custom_css .= 'background-color: '.esc_attr($products_background_color) .';';
					}
					$custom_css .= 'background-image : url("'.esc_attr($custom_background["image"]).'") ;
					filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src="'.esc_attr($custom_background["image"]).'",sizingMethod="scale");
					-ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\''.($custom_background["image"]).'\',sizingMethod=\'scale\')";
				}';
			}else {
				if ($products_background_type == "patterns" || !empty($custom_background)) {
					$custom_css .= 'body {
						background:';
						if ($products_background_type == "patterns") {
							if ($products_background_pattern != "default") {
								$custom_css .= esc_attr($products_background_color).' url('.esc_attr(get_template_directory_uri()).'/images/patterns/'.esc_attr($products_background_pattern).'.png) repeat;';
							}
						}
						if (!empty($custom_background)) {
							if ($products_full_screen_background != 'on') {
								$custom_css .= esc_attr($custom_background["color"]).' url('.esc_attr($custom_background["image"]).') '.esc_attr($custom_background["repeat"]).' '.esc_attr($custom_background["position"]).' '.esc_attr($custom_background["attachment"]).';';
							}
						}
					$custom_css .= '}';
				}
			}
		}
	}else if (is_author() && $author_layout != "default") {
		if ($author_layout != "full") {
			$custom_background = $author_custom_background;
			if ($author_full_screen_background == 'on' && $author_background_type != "patterns") {
				$custom_css .= '.background-cover {';
					if (!empty($author_background_color)) {
						$custom_css .= 'background-color:'.esc_attr($author_background_color) .';';
					}
					$custom_css .= 'background-image : url("'.esc_attr($custom_background["image"]).'") ;
					filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src="'.esc_attr($custom_background["image"]).'",sizingMethod="scale");
					-ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\''.($custom_background["image"]).'\',sizingMethod=\'scale\')";
				}';
			}else {
				if ($author_background_type == "patterns" || !empty($custom_background)) {
					$custom_css .= 'body {
						background:';
						if ($author_background_type == "patterns") {
							if ($author_background_pattern != "default") {
								$custom_css .= esc_attr($author_background_color).' url('.esc_attr(get_template_directory_uri()).'/images/patterns/'.esc_attr($author_background_pattern).'.png) repeat;';
							}
						}
						if (!empty($custom_background)) {
							if ($author_full_screen_background != 'on') {
								$custom_css .= esc_attr($custom_background["color"]).' url('.esc_attr($custom_background["image"]).') '.esc_attr($custom_background["repeat"]).' '.esc_attr($custom_background["position"]).' '.esc_attr($custom_background["attachment"]).';';
							}
						}
					$custom_css .= '}';
				}
			}
		}
	}else if ((is_single() || is_page()) && $vbegy_layout != "" && $vbegy_layout != "default"):
		if ($vbegy_layout == "fixed" || $vbegy_layout == "fixed_2"):
			$background_img = rwmb_meta('vbegy_background_img','upload',$post->ID);
			$background_color = rwmb_meta('vbegy_background_color','color',$post->ID);
			$background_repeat = rwmb_meta('vbegy_background_repeat','select',$post->ID);
			$background_fixed = rwmb_meta('vbegy_background_fixed','select',$post->ID);
			$background_position_x = rwmb_meta('vbegy_background_position_x','select',$post->ID);
			$background_position_y = rwmb_meta('vbegy_background_position_y','select',$post->ID);
			$background_full = rwmb_meta('vbegy_background_full','checkbox',$post->ID);
			$background_position = $background_position_x." ".$background_position_y;
			$background_type = "";
			$background_pattern = "";
			$custom_background = "";
			$vbegy_layout = rwmb_meta('vbegy_layout','radio',$post->ID);
			if (is_singular("product")) {
				$vbegy_layout = vpanel_options("products_layout");
				if ($vbegy_layout == "fixed" || $vbegy_layout == "fixed_2"):
					$background_type = vpanel_options("products_background_type");
					$custom_background = vpanel_options("products_custom_background");
					$background_pattern = vpanel_options("products_background_pattern");
					$background_img = $custom_background["image"];
					$background_color = $custom_background["color"];
					$background_repeat = $custom_background["repeat"];
					$background_fixed = $custom_background["attachment"];
					$background_position = $custom_background["position"];
					$background_full = vpanel_options("products_full_screen_background");
					if ($background_full == "on") {
						$background_full = 1;
					}
				endif;
			}
			if ($background_full == 1 && $background_type != "patterns"):
				$custom_css .= '.background-cover {';
					if (!empty($background_color)) {
						$custom_css .= 'background-color: '.esc_attr($background_color).';';
					}
					$custom_css .= 'background-image : url("'.esc_attr($background_img).'") ;
					filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src="'.esc_attr($background_img).'",sizingMethod="scale");
					-ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\''.esc_attr($background_img).'\',sizingMethod=\'scale\')";
				}';
			else:
				if ($background_type == "patterns" || $background_color || $background_img) {
					$custom_css .= 'body {
						background:';
						if ($background_type == "patterns") {
							if ($background_pattern != "default") {
								$custom_css .= esc_attr($background_color).' url('.esc_attr(get_template_directory_uri()).'/images/patterns/'.esc_attr($background_pattern).'.png) repeat;';
							}
						}
						if ($background_color || $background_img) {
							if ($background_full != 1) {
								$custom_css .= esc_attr($background_color).' url("'.esc_attr($background_img).'") '.esc_attr($background_repeat).' '.esc_attr($background_fixed).' '.esc_attr($background_position).';';
							}
						}
					$custom_css .= '}';
				}
			endif;
		endif;
	else:
		if (vpanel_options("home_layout") != "full") {
			$custom_background = vpanel_options("custom_background");
			if (vpanel_options("full_screen_background") == 'on' && vpanel_options("background_type") != "patterns") {
				$custom_css .= '.background-cover {';
					$background_color_s = vpanel_options("background_color");
					if (!empty($background_color_s)) {
						$custom_css .= 'background-color: '.esc_attr($background_color_s) .';';
					}
					$custom_css .= 'background-image : url("'.esc_attr($custom_background["image"]).'") ;
					filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(src="'.esc_attr($custom_background["image"]).'",sizingMethod="scale");
					-ms-filter: "progid:DXImageTransform.Microsoft.AlphaImageLoader(src=\''.esc_attr($custom_background["image"]).'\',sizingMethod=\'scale\')";
				}';
			}else {
				if (vpanel_options("background_type") == "patterns" || !empty($custom_background)) {
					$custom_css .= 'body {
						background:';
						if (vpanel_options("background_type") == "patterns") {
							if (vpanel_options("background_pattern") != "default") {
								$custom_css .= vpanel_options("background_color").' url('.get_template_directory_uri().'/images/patterns/'.vpanel_options("background_pattern").'.png) repeat;';
							}
						}
						if (!empty($custom_background)) {
							if (vpanel_options("full_screen_background") != 'on') {
								$custom_css .= esc_attr($custom_background["color"]).' url('.esc_attr($custom_background["image"]).') '.esc_attr($custom_background["repeat"]).' '.esc_attr($custom_background["position"]).' '.esc_attr($custom_background["attachment"]).';';
							}
						}
					$custom_css .= '}';
				}
			}
		}
	endif;
	
	if (is_category() && ($primary_color_c == "" && $secondary_color_c == "")) {
		if ($cat_skin != "default") {
			if ($cat_skin == "skin") {
				wp_enqueue_style('skin_default', get_template_directory_uri( __FILE__ )."/css/skins/skins.css");
			}else if (!empty($cat_skin)) {
				wp_enqueue_style('skin_'.$cat_skin, get_template_directory_uri( __FILE__ )."/css/skins/".$cat_skin.".css");
			}
		}else {
			$primary_color = vpanel_options("primary_color");
			$secondary_color = vpanel_options("secondary_color");
			if ($primary_color != "" && $secondary_color != "") :
				$custom_css .= all_css_color($primary_color,$secondary_color);
			endif;
		}
	}else if (is_category() && ($primary_color_c != "" && $secondary_color_c != "")) {
		$custom_css .= all_css_color($primary_color_c,$secondary_color_c);
	}else if (is_tax("product_cat") && ($primary_color_c == "" && $secondary_color_c == "")) {
		if ($cat_skin != "default") {
			if ($cat_skin == "skin") {
				wp_enqueue_style('skin_default', get_template_directory_uri( __FILE__ )."/css/skins/skins.css");
			}else if (!empty($cat_skin)) {
				wp_enqueue_style('skin_'.$cat_skin, get_template_directory_uri( __FILE__ )."/css/skins/".$cat_skin.".css");
			}
		}else {
			$primary_color = vpanel_options("primary_color");
			$secondary_color = vpanel_options("secondary_color");
			if ($primary_color != "" && $secondary_color != "") :
				$custom_css .= all_css_color($primary_color,$secondary_color);
			endif;
		}
	}else if (is_tax("product_cat") && ($primary_color_c != "" && $secondary_color_c != "")) {
		$custom_css .= all_css_color($primary_color_c,$secondary_color_c);
	}else if ((is_tax("product_tag") && ($primary_color_c == "" && $secondary_color_c == "")) || ((is_post_type_archive("product")) && ($primary_color_c == "" && $secondary_color_c == ""))) {
		if ($vbegy_skin != "default") {
			if ($vbegy_skin == "skin") {
				wp_enqueue_style('skin_default', get_template_directory_uri( __FILE__ )."/css/skins/skins.css");
			}else if (!empty($vbegy_skin)) {
				wp_enqueue_style('skin_'.$vbegy_skin, get_template_directory_uri( __FILE__ )."/css/skins/".$vbegy_skin.".css");
			}
		}else {
			$primary_color = vpanel_options("primary_color");
			$secondary_color = vpanel_options("secondary_color");
			if ($primary_color != "" && $secondary_color != "") :
				$custom_css .= all_css_color($primary_color,$secondary_color);
			endif;
		}
	}else if ((is_tax("product_tag") && ($primary_color_c != "" && $secondary_color_c != "")) || (is_post_type_archive("product")) && ($primary_color_c != "" && $secondary_color_c != "")) {
		$custom_css .= all_css_color($primary_color_c,$secondary_color_c);
	}else if (is_author() && ($primary_color_a == "" && $secondary_color_a == "")) {
		if ($vbegy_skin != "default") {
			if ($vbegy_skin == "skin") {
				wp_enqueue_style('skin_default', get_template_directory_uri( __FILE__ )."/css/skins/skins.css");
			}else if (!empty($vbegy_skin)) {
				wp_enqueue_style('skin_'.$vbegy_skin, get_template_directory_uri( __FILE__ )."/css/skins/".$vbegy_skin.".css");
			}
		}else {
			$primary_color = vpanel_options("primary_color");
			$secondary_color = vpanel_options("secondary_color");
			if ($primary_color != "" && $secondary_color != "") :
				$custom_css .= all_css_color($primary_color,$secondary_color);
			endif;
		}
	}else if (is_author() && ($primary_color_a != "" && $secondary_color_a != "")) {
		$custom_css .= all_css_color($primary_color_a,$secondary_color_a);
	}else if ((is_single() || is_page()) && ($primary_color_p == "" && $secondary_color_p == "")) {
		if ($vbegy_skin != "default") {
			if ($vbegy_skin == "skin") {
				wp_enqueue_style('skin_default', get_template_directory_uri( __FILE__ )."/css/skins/skins.css");
			}else if (!empty($vbegy_skin)) {
				wp_enqueue_style('skin_'.$vbegy_skin, get_template_directory_uri( __FILE__ )."/css/skins/".$vbegy_skin.".css");
			}
		}else {
			$primary_color = vpanel_options("primary_color");
			$secondary_color = vpanel_options("secondary_color");
			if ($primary_color != "" && $secondary_color != "") :
				$custom_css .= all_css_color($primary_color,$secondary_color);
			endif;
		}
	}else if ((is_single() || is_page()) && ($primary_color_p != "" && $secondary_color_p != "")) {
		$custom_css .= all_css_color($primary_color_p,$secondary_color_p);
	}else {
		$primary_color = vpanel_options("primary_color");
		$secondary_color = vpanel_options("secondary_color");
		if ($primary_color != "" && $secondary_color != "") :
			$custom_css .= all_css_color($primary_color,$secondary_color);
		endif;
	}
	if (is_single() || is_page()) {
		$vbegy_custom_header = rwmb_meta('vbegy_custom_header','checkbox',$post->ID);
		$header_fixed_responsive = rwmb_meta('vbegy_header_fixed_responsive','radio',$post->ID);
	}
	if ((is_single() || is_page()) && isset($vbegy_custom_header) && $vbegy_custom_header == 1) {
		if ($header_fixed_responsive == 1) {
			$custom_css .= '@media only screen and (max-width: 479px) {
				#header.fixed-nav {
					position: relative !important;
				}
			}';
		}
	}else {
		if (vpanel_options("header_fixed_responsive") == 'on') {
			$custom_css .= '@media only screen and (max-width: 479px) {
				#header.fixed-nav {
					position: relative !important;
				}
			}';
		}
	}
	if (vpanel_options("stripe") == 'on') {
		$custom_css .= '#header:before,.post-head:before,.post-wrap:before,.block-box:before,.widget:before,.page-navigation div div:before,.post-style-7.post:before {
			content: "";
			height: 1px;
			width: 100%;
			background-color: #FFF;
			border-bottom: 1px solid #d3d5d7;
			-webkit-box-shadow: 0 0 5px 0 #e2e3e4;
			-moz-box-shadow: 0 0 5px 0 #e2e3e4;
			box-shadow: 0 0 5px 0 #e2e3e4;
			bottom: 2px;
			left: 0;
			position: absolute;
		}
		.post-style-7.post:before {
			height: 0;
			z-index: 1;
		}
		#header:after,.widget:after,.post-wrap:after,.block-box:after,.post-style-7.post:after {
			content: "";
			height: 1px;
			width: 100%;
			background-color: #FFF;
			border-bottom: 1px solid #d3d5d7;
			-webkit-box-shadow: 0 0 5px 0 #e2e3e4;
			-moz-box-shadow: 0 0 5px 0 #e2e3e4;
			box-shadow: 0 0 5px 0 #e2e3e4;
			bottom: 5px;
			left: 0;
			position: absolute;
		}
		.widget:before,.widget:after,.post-head:before,.post-wrap:before,.block-box:before,.post-wrap:after,.block-box:after,.page-navigation div div:before,.post-style-7.post:before,.post-style-7.post:after {
			-moz-border-radius: 0 0 2px 2px;
			-webkit-border-radius: 0 0 2px 2px;
			border-radius: 0 0 2px 2px;
		}
		.post-quote .post-wrap:before,.post-quote .post-wrap:after,.post-link .post-wrap:before,.post-link .post-wrap:after,.widget-about:before,.widget-about:after,#footer-top .widget:before,#footer-top .widget:after,.post-quote.post-style-7.post:after,.post-quote.post-style-7.post:after,.post-link.post-style-7.post:after,.post-link.post-style-7.post:after {
			height: 0;
			width: 0;
		}
		.navigation > div > ul > li:hover > ul,.navigation > div > ul > li.mega-menu:hover ul {
			top: 100%;
		}
		.cart_wrapper {
			top: 63px;
		}
		.header-3 .navigation > div > ul > li:hover > ul {
			top: 100%;
		}
		.header-3 .navigation > div > ul > li.mega-menu:hover ul {
			top: 217px;
		}
		.header-4 .navigation > div > ul > li:hover > ul {
			top: 100%;
		}
		#header.header-4 .cart_wrapper {
			top: 43px;
		}';
	}
	
	/* Fonts */
	
	$main_font = vpanel_options("main_font");
	if (isset($main_font["face"]) && $main_font["face"] != "default") {
		$font_explode = explode(":", $main_font["face"]);
		$custom_css .= '
		body,.qoute p,input,button[type="submit"],.widget_shopping_cart .button.wc-forward,.button-default,label,.more,blockquote,h1, h2, h3, h4, h5, h6,.navigation li ul li,.twitter-follow,.widget .search-submit,.header-3 .logo span {
			font-family: "'.$font_explode[0].'";
		}';
	}
	
	$secondary_font = vpanel_options("secondary_font");
	if (isset($secondary_font["face"]) && $secondary_font["face"] != "default") {
		$font_explode = explode(":", $secondary_font["face"]);
		$custom_css .= '
		.logo,.wrap-search input[type="search"],.widget-title,.post-title,.block-box-title,.post-head > h1,.widget-posts-content > a,.page-404 h2,.page-404 h3,.block-box-1 li .block-box-content > a:first-child,.footer-subscribe h3,.box-slideshow-content > a,.news-ticker-title,ul.products li .product-details h3,.product_title.entry-title {
			font-family: "'.$font_explode[0].'";
		}';
	}
	
	$third_font = vpanel_options("third_font");
	if (isset($third_font["face"]) && $third_font["face"] != "default") {
		$font_explode = explode(":", $third_font["face"]);
		$custom_css .= '
		.navigation li,.header-follow-a {
			font-family: "'.$font_explode[0].'";
		}';
	}
	
	/* General typography */
	
	$custom_css .= vpanel_general_typography("general_typography","body,p");
	
	for ($i = 1; $i <= 6; $i++) {
		$custom_css .= vpanel_general_typography("h".$i,"h".$i);
	}
	
	/* Header */
	
	$custom_css .= vpanel_general_background('header_image','header_full_screen_background','#header');
	$custom_css .= vpanel_general_color('general_link_color','a','color');
	$custom_css .= vpanel_general_color('header_link_color','#header a','color');
	//$custom_css .= vpanel_general_color('header_link_color_hover','#header a:hover','color');
	
	//.header-3 .logo span

	$custom_css .= vpanel_general_typography("nav_menu","#header .navigation > div > ul > li > a");
	
	$custom_css .= vpanel_general_color('nav_menu_hover','#header .navigation > div > ul > li > a:hover,#header .navigation li:hover > a,#header .navigation li ul li:hover > a,#header .navigation li.current_page_item > a,#header .navigation li ul li.current_page_item > a,#header .navigation_mobile > ul li:hover > a,#header .navigation_mobile > ul li:hover:before,#header .navigation_mobile > ul li:hover > a > span i,#header .navigation_mobile_click:hover,#header .navigation_mobile_click:hover:before,#header .navigation > div > ul > li.mega-menu li li > a:hover,#header .navigation > div > ul > li.mega-menu li li:hover:before,#header .navigation li.current-menu-item > a,#header .navigation li.current-menu-parent > a','color');
	
	$custom_css .= vpanel_general_typography("nav_drop_menu","#header .navigation li ul li a");
	$custom_css .= vpanel_general_color("nav_drop_menu_background","#header .navigation li:hover ul,#header .follow-social",'background-color');
	$custom_css .= vpanel_general_color("nav_drop_menu_background","#header .follow-social > i",'color');
	$custom_css .= vpanel_general_color("nav_drop_menu_border","#header .navigation ul > li ul,#header .navigation li ul li a",'border-color');
	$custom_css .= vpanel_general_color('nav_drop_menu_hover','#header .navigation li ul li:hover > a,#header .navigation li ul li.current_page_item > a','color');
	
	$custom_css .= vpanel_general_color("icon_menu_background","#header .header-search-a,#header .header-follow-a,#header .cart-wrapper a.cart_control",'background-color');
	$custom_css .= vpanel_general_color("icon_menu_border","#header .header-search-a,#header .header-follow-a,#header .cart-wrapper a.cart_control",'border-color');
	$custom_css .= vpanel_general_color("icon_menu_link","#header .header-search-a,#header .header-follow-a,#header .cart-wrapper a.cart_control",'color');
	
	$custom_css .= vpanel_general_color("icon_menu_background_hover","#header .header-search-a:hover,#header .header-follow-a:hover,#header .cart-wrapper a.cart_control:hover",'background-color');
	$custom_css .= vpanel_general_color("icon_menu_border_hover","#header .header-search-a:hover,#header .header-follow-a:hover,#header .cart-wrapper a.cart_control:hover",'border-color');
	$custom_css .= vpanel_general_color("icon_menu_link_hover","#header .header-search-a:hover,#header .header-follow-a:hover,#header .cart-wrapper a.cart_control:hover",'color');
	//.cart-wrapper a.cart_control .numofitems
	
	/* Breadcrumbs */
	
	$custom_css .= vpanel_general_typography('breadcrumbs_typography','.breadcrumbs,.crumbs .current,.breadcrumbs a,.breadcrumbs a i,.breadcrumbs span');
	$custom_css .= vpanel_general_color("breadcrumbs_link_color",".breadcrumbs a,.breadcrumbs a i","color");
	$custom_css .= vpanel_general_color('breadcrumbs_link_hover_color','.breadcrumbs a:hover,.breadcrumbs a:hover i',"color",true);
	
	/* News */
	
	$custom_css .= vpanel_general_background('head_background_color','','.news-ticker-title');
	$custom_css .= vpanel_general_typography("head_typography",".news-ticker-title");
	$custom_css .= vpanel_general_background('news_image','','.news-ticker-content');
	$custom_css .= vpanel_general_typography("news_link_typography",".news-ticker li a");
	$custom_css .= vpanel_general_color('news_link_hover_color','.news-ticker li a:hover','color');
	$custom_css .= vpanel_general_color('news_arrow_background','.news-ticker-content .bx-controls-direction a','background-color');
	$custom_css .= vpanel_general_color('news_arrow_color','.news-ticker-content .bx-controls-direction a','color');
	$custom_css .= vpanel_general_color('news_arrow_background_hover','.news-ticker-content .bx-controls-direction a:hover','background-color');
	$custom_css .= vpanel_general_color('news_arrow_color_hover','.news-ticker-content .bx-controls-direction a:hover::before','color',true);
	
	
	/* Slideshow */
	
	$custom_css .= vpanel_general_background('slideshow_image','','.box-slideshow-content');
	$custom_css .= vpanel_general_typography("slideshow_link_typography",".box-slideshow-content > a");
	$custom_css .= vpanel_general_color("slideshow_link_hover_color",".box-slideshow-content > a:hover","color");
	$custom_css .= vpanel_general_typography("slideshow_content_typography",".box-slideshow-content > p");
	$custom_css .= vpanel_general_color('slideshow_meta_border','.box-slideshow-content span','border-color');
	$custom_css .= vpanel_general_color('slideshow_meta_color','.box-slideshow-content span,.box-slideshow-content span i.fa','color');
	$custom_css .= vpanel_general_color('slideshow_meta_link_color','.box-slideshow-content span a','color');
	$custom_css .= vpanel_general_color('slideshow_meta_link_hover_color','.box-slideshow-content span a:hover','color');
	$custom_css .= vpanel_general_color('slideshow_arrow_background','.box-slideshow .bx-controls-direction a','background-color');
	$custom_css .= vpanel_general_color('slideshow_arrow_color','.box-slideshow .bx-controls-direction a','color');
	$custom_css .= vpanel_general_color('slideshow_arrow_background_hover','.box-slideshow .bx-controls-direction a:hover','background-color');
	$custom_css .= vpanel_general_color('slideshow_arrow_color_hover','.box-slideshow .bx-controls-direction a:hover::before','color',true);
	
	/* Page builder */
	
	$custom_css .= vpanel_general_typography("title_box_typography",".block-box-title");
	$custom_css .= vpanel_general_color('under_title_color','.block-box-title:before','background-color');
	$custom_css .= vpanel_general_color('title_box_link_color','.block-box-title a','color');
	$custom_css .= vpanel_general_color('title_box_link_hover_color','.block-box-title a:hover','color');
	$custom_css .= vpanel_general_typography("title_inner_link_typography",".block-box-content > a.not(.post-more)");
	$custom_css .= vpanel_general_color("title_inner_link_hover_color",".block-box-content > a.not(.post-more):hover","color",true);
	$custom_css .= vpanel_general_color("box_meta_color",".block-box-content span,.block-box-content span i","color",true);
	$custom_css .= vpanel_general_color("box_meta_link_color",".block-box-content span a","color",true);
	$custom_css .= vpanel_general_color("box_meta_link_hover_color",".block-box-content span a:hover","color",true);
	$custom_css .= vpanel_general_typography("content_inner_typography",".block-box-content p");
	
	/* Widgets */
	
	$custom_css .= vpanel_general_color("widget_color",".sidebar .widget,.sidebar .widget div,.sidebar .widget p,.sidebar .widget li .widget-span",'color');
	$custom_css .= vpanel_general_color("widget_link_color",".sidebar .widget a",'color');
	$custom_css .= vpanel_general_color("widget_link_hover_color",".sidebar .widget a:hover,.sidebar .widget .widget-posts-content span a:hover",'color');
	$custom_css .= vpanel_general_typography("widget_title",".sidebar .widget .widget-title");
	$custom_css .= vpanel_general_color("widget_title_icon_background",".sidebar .widget .widget-title > i,.sidebar .widget .widget-title:before",'background-color');
	$custom_css .= vpanel_general_color("widget_title_icon_color",".sidebar .widget .widget-title > i",'color');
	
	/* Content */
	
	$custom_css .= vpanel_general_typography("content_title",".post-title,.post-head > h1");
	$custom_css .= vpanel_general_color("content_title_icon_background",".post-title > i,.post-title:before",'background-color');
	$custom_css .= vpanel_general_color("content_title_icon_color",".post-title > i",'color');
	$custom_css .= vpanel_general_color("content_title_link",".post-head > h1 a",'color');
	$custom_css .= vpanel_general_color("content_title_link_hover",".post-head > h1 a:hover",'color');
	
	$custom_css .= vpanel_general_typography("content_typography",".post-inner-content,.post-inner-content p");
	$custom_css .= vpanel_general_color("content_link",".post-inner-content a,.post .post-inner-content a",'color');
	$custom_css .= vpanel_general_color("content_link_hover",".post-inner-content a:hover,.post .post-inner-content a:hover",'color');
	
	/* Footer */
	
	$custom_css .= vpanel_general_background('footer_image','footer_full_screen_background','#footer-top');
	$custom_css .= vpanel_general_color("footer_color","#footer-top",'color');
	$custom_css .= vpanel_general_color("footer_link_color","#footer-top a",'color');
	$custom_css .= vpanel_general_color("footer_widget_color","#footer-top .widget,#footer-top .widget div,#footer-top .widget p,#footer-top .widget li .widget-span",'color');
	$custom_css .= vpanel_general_color("footer_widget_link_color","#footer-top .widget a",'color');
	$custom_css .= vpanel_general_color("footer_widget_link_hover_color","#footer-top .widget a:hover,#footer-top .widget .widget-posts-content span a:hover",'color');
	$custom_css .= vpanel_general_typography("footer_widget_title","#footer-top .widget .widget-title");
	$custom_css .= vpanel_general_color("footer_widget_title_icon_background","#footer-top .widget .widget-title > i,#footer-top .widget .widget-title:before",'background-color');
	$custom_css .= vpanel_general_color("footer_widget_title_icon_color","#footer-top .widget .widget-title > i",'color');
	
	$custom_css .= vpanel_general_background('footer_bottom_image','footer_bottom_full_screen_background','#footer');
	$custom_css .= vpanel_general_color("footer_bottom_color","#footer,#footer .copyrights",'color');
	$custom_css .= vpanel_general_color("footer_bottom_link_color","#footer a",'color');
	$custom_css .= vpanel_general_color("footer_bottom_link_hover_color","#footer a:hover",'color');
	
	/* custom_css */
	if(vpanel_options("custom_css")) {
		$custom_css .= vpanel_options("custom_css");
	}
	if (is_single() || is_page()) {
		$custom_css .= rwmb_meta('vbegy_footer_css','textarea',$post->ID);
	}
	
	wp_add_inline_style('vpanel_custom',$custom_css);
	
	wp_enqueue_script("v_html5", get_template_directory_uri( __FILE__ )."/js/html5.js",array("jquery"),'1.0.0',true);
	wp_enqueue_script("v_nicescroll", get_template_directory_uri( __FILE__ )."/js/jquery.nicescroll.min.js",array("jquery"),'1.0.0',true);
	wp_enqueue_script("v_modernizr", get_template_directory_uri( __FILE__ )."/js/modernizr.js",array("jquery"),'1.0.0',true);
	wp_enqueue_script("v_isotope", get_template_directory_uri( __FILE__ )."/js/jquery.isotope.min.js",array("jquery"),'1.0.0',true);
	wp_enqueue_script("v_tabs", get_template_directory_uri( __FILE__ )."/js/tabs.js",array("jquery"),'1.0.0',true);
	wp_enqueue_script("v_prettyphoto", get_template_directory_uri( __FILE__ )."/js/jquery.prettyPhoto.js",array("jquery"),'1.0.0',true);
	wp_enqueue_script("v_bxslider", get_template_directory_uri( __FILE__ )."/js/jquery.bxslider.min.js",array("jquery"));
	wp_enqueue_script("v_twitter", get_template_directory_uri( __FILE__ )."/js/twitter/jquery.tweet.js",array("jquery"),'1.0.0',true);
	wp_enqueue_script("v_jflickrfeed", get_template_directory_uri( __FILE__ )."/js/jflickrfeed.min.js",array("jquery"),'1.0.0',true);
	wp_enqueue_script("v_jribbble", get_template_directory_uri( __FILE__ )."/js/jquery.jribbble-1.0.1.ugly.js",array("jquery"),'1.0.0',true);
	wp_enqueue_script("v_inview", get_template_directory_uri( __FILE__ )."/js/jquery.inview.min.js",array("jquery"),'1.0.0',true);
	wp_enqueue_script("v_flexslider", get_template_directory_uri( __FILE__ )."/js/jquery.flexslider.js",array("jquery"),'1.0.0',true);
	wp_enqueue_script("v_tags", get_template_directory_uri( __FILE__ )."/js/tags.js",array("jquery"),'1.0.0',true);
	wp_enqueue_script("v_imagesloaded", get_template_directory_uri( __FILE__ )."/js/imagesloaded.pkgd.min.js",array("jquery"),'1.0.0',true);
	wp_enqueue_script("v_stickit", get_template_directory_uri( __FILE__ )."/js/jquery.stickit.js",array("jquery"),'1.0.0',true);
	wp_enqueue_script("v_custom", get_template_directory_uri( __FILE__ )."/js/custom.js",array("jquery"),'1.0.0',true);
	wp_localize_script("v_custom","template_url",get_template_directory_uri( __FILE__ ));
	wp_localize_script("v_custom","go_to",__("Go to...","vbegy"));
	wp_localize_script("v_custom","logger_error_text",__("Please fill the required field.","vbegy"));
	wp_localize_script("v_custom","logger_error_captcha",__("The captcha is incorrect, please try again.","vbegy"));
	wp_localize_script("v_custom","logger_error_empty",__("Fill out all the required fields.","vbegy"));
	wp_localize_script("v_custom","sure_delete",__("Are you sure you want to delete the post?","vbegy"));
	$products_excerpt_title = vpanel_options("products_excerpt_title");
	$products_excerpt_title = (isset($products_excerpt_title)?$products_excerpt_title:40);
	wp_localize_script("v_custom","products_excerpt_title",$products_excerpt_title);
	wp_localize_script("v_custom","v_get_template_directory_uri",get_template_directory_uri());
	wp_localize_script("v_custom","admin_url",admin_url("admin-ajax.php"));
	if (is_singular() && comments_open() && get_option('thread_comments'))
		wp_enqueue_script( 'comment-reply');
}
add_action('wp_enqueue_scripts','vbegy_scripts_styles');
/* vbegy_load_theme */
function vbegy_load_theme() {
	/* Default RSS feed links */
	add_theme_support('automatic-feed-links');

	/* Post Thumbnails */
	/* Post Thumbnails */
	if ( function_exists( 'add_theme_support' ) ){
	    add_theme_support( 'post-thumbnails' );
	    set_post_thumbnail_size( 50, 50, true );
	    set_post_thumbnail_size( 60, 60, true );
	    set_post_thumbnail_size( 80, 80, true );
	    set_post_thumbnail_size( 555,421, true );
	    set_post_thumbnail_size( 360,420, true );
	    set_post_thumbnail_size( 360,202, true );
	    set_post_thumbnail_size( 1140,641, true );
	    set_post_thumbnail_size( 750,422, true );
	}
	if ( function_exists( 'add_image_size' ) ){
	    add_image_size( 'vbegy_img_1', 50, 50, true );
		add_image_size( 'vbegy_img_2', 60, 60, true );
		add_image_size( 'vbegy_img_3', 80, 80, true );
		add_image_size( 'vbegy_img_4', 555,421, true );
		add_image_size( 'vbegy_img_5', 360,420, true );
		add_image_size( 'vbegy_img_6', 360,202, true );
		add_image_size( 'vbegy_img_7', 1140,641, true );
		add_image_size( 'vbegy_img_8', 750,422, true );
	}
	/* Valid HTML5 */
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );
	/* This theme uses its own gallery styles */
	add_filter( 'use_default_gallery_style', '__return_false' );
}
add_action( 'after_setup_theme', 'vbegy_load_theme' );

/* wp head */
function vbegy_head() {
	global $post;
	$default_favicon = get_template_directory_uri()."/images/favicon.png";
	if (vpanel_options("favicon")) {
		echo '<link rel="shortcut icon" href="'.vpanel_options("favicon").'" type="image/x-icon">' ."\n";
	}

	/* Favicon iPhone */
	if (vpanel_options("iphone_icon")) {
		echo '<link rel="apple-touch-icon-precomposed" href="'.vpanel_options("iphone_icon").'">' ."\n";
	}

	/* Favicon iPhone 4 Retina display */
	if (vpanel_options("iphone_icon_retina")) {
		echo '<link rel="apple-touch-icon-precomposed" sizes="114x114" href="'.vpanel_options("iphone_icon_retina").'">' ."\n";
	}

	/* Favicon iPad */
	if (vpanel_options("ipad_icon")) {
		echo '<link rel="apple-touch-icon-precomposed" sizes="72x72" href="'.vpanel_options("ipad_icon").'">' ."\n";
	}

	/* Favicon iPad Retina display */
	if (vpanel_options("ipad_icon_retina")) {
		echo '<link rel="apple-touch-icon-precomposed" sizes="144x144" href="'.vpanel_options("ipad_icon_retina").'">' ."\n";
	}
	
	/* Seo */
	$the_seo = stripslashes(vpanel_options("the_keywords"));
	
	if (vpanel_options("seo_active") == 'on') {
		$fbShareImage = get_option('fb_share_image');
		
		echo '<meta property="og:site_name" content="'.htmlspecialchars(get_bloginfo('name')).'" />'."\n";
		echo '<meta property="og:type" content="website" />'."\n";
		
	    if (is_single() || is_page()) {
	    	wp_reset_query();
	    	if ( have_posts() ) : while ( have_posts() ) : the_post();
	    		$vpanel_image = vpanel_image();
	    		if ((function_exists("has_post_thumbnail") && has_post_thumbnail()) || !empty($vpanel_image)) {
	    			if (has_post_thumbnail()) {
						$image_id = get_post_thumbnail_id($post->ID);
						$image_url = wp_get_attachment_image_src($image_id,"vbegy_img_8");
			        	$post_thumb = $image_url[0];
			        }else {
			        	$post_thumb = $vpanel_image;
			        }
			    }else {
			        $protocol = is_ssl() ? 'https' : 'http';
			        
			        $video_id = rwmb_meta('vbegy_video_post_id',"select",$post->ID);
			        $video_type = rwmb_meta('vbegy_video_post_type',"text",$post->ID);
			
					if (!empty($video_id)) {
			            if ($video_type == 'youtube') {
			                $post_thumb = $protocol.'://img.youtube.com/vi/'.$video_id.'/0.jpg';
			            }else if ($video_type == 'vimeo') {
			                $video_url = $get_meta['video'];
			                $url = $protocol.'://vimeo.com/api/v2/video/'.$video_id.'.php';;
			                $contents = @file_get_contents($url);
			                $thumb = @unserialize(trim($contents));
			                $post_thumb = $thumb[0]['thumbnail_large'];
			            }elseif ($video_type == 'daily') {
			                $video_url = $get_meta['video'];
			                $post_thumb = 'http://www.dailymotion.com/thumbnail/video/'.$video_id;
			            }
		            }
			    }
			    
			    if (!empty($post_thumb)) {
			        echo '<meta property="og:image" content="' . $post_thumb . '" />' . "\n";
			    }else {
			    	$fb_share_image = vpanel_options("fb_share_image");
			    	if (is_single() || is_page()) {
			    		$vbegy_custom_header = rwmb_meta('vbegy_custom_header','checkbox',$post->ID);
			    	}
			    	if ((is_single() || is_page()) && isset($vbegy_custom_header) && $vbegy_custom_header == 1) {
			    		$logo_display = rwmb_meta('vbegy_logo_display','radio',$post->ID);
			    		$logo_img = rwmb_meta('vbegy_logo_img','upload',$post->ID);
			    	}else {
			    		$logo_display = vpanel_options("logo_display");
			    		$logo_img = vpanel_options("logo_img");
			    	}
			    	if (!empty($fb_share_image)) {
			        	echo '<meta property="og:image" content="' . $fb_share_image . '" />' . "\n";
			        }else if ($logo_display == "custom_image" && isset($logo_img) && $logo_img != "") {
			        	echo '<meta property="og:image" content="' . $logo_img . '" />' . "\n";?>
			        <?php }
			    }
	    			
	    		$title = the_title('', '', false);
	    		$php_version = explode('.', phpversion());
	    		if(count($php_version) && $php_version[0]>=5)
	    			$title = html_entity_decode($title,ENT_QUOTES,'UTF-8');
	    		else
	    			$title = html_entity_decode($title,ENT_QUOTES);
	    			echo '<meta property="og:title" content="'.htmlspecialchars($title).'" />'."\n";
	    			echo '<meta property="og:url" content="'.get_permalink().'" />'."\n";
	    				$description = trim(get_the_excerpt());
	    			if ($description != '')
	    			    	echo '<meta property="og:description" content="'.htmlspecialchars($description).'" />'."\n";
	    			    	
	    	    if (is_singular("portfolio")) {
	    	    	if ($terms = wp_get_object_terms( $post->ID, 'portfolio_tags' )) :
	    	    		$the_tags_post = '';
	    	    			$terms_array = array();
	    	    			foreach ($terms as $term) :
	    	    				$the_tags_post .= $term->name . ',';
	    	    			endforeach;
	    	    			echo '<meta name="keywords" content="' . trim($the_tags_post, ',') . '">' ."\n";
	    	    	endif;
	    	    }else if (is_singular("product")) {
	    	    	if ($terms = wp_get_object_terms( $post->ID, 'product_tag' )) :
	    	    		$the_tags_post = '';
	    	    			$terms_array = array();
	    	    			foreach ($terms as $term) :
	    	    				$the_tags_post .= $term->name . ',';
	    	    			endforeach;
	    	    			echo '<meta name="keywords" content="' . trim($the_tags_post, ',') . '">' ."\n";
	    	    	endif;
	    	    }else {
	    	    	$posttags = get_the_tags();
	    		    if ($posttags) {
	    		        $the_tags_post = '';
	    		        foreach ($posttags as $tag) {
	    		            $the_tags_post .= $tag->name . ',';
	    		        }
	    		        echo '<meta name="keywords" content="' . trim($the_tags_post, ',') . '">' ."\n";
	    		    }
	    	    }
	    	endwhile;endif;wp_reset_query();
	    }else {
	    	$fb_share_image = vpanel_options("fb_share_image");
	    	$logo_display = vpanel_options("logo_display");
	    	$logo_img = vpanel_options("logo_img");
	    	if (!empty($fb_share_image)) {
	    		echo '<meta property="og:image" content="' . $fb_share_image . '" />' . "\n";
	    	}else if ($logo_display == "custom_image" && isset($logo_img) && $logo_img != "") {
	    		echo '<meta property="og:image" content="' . $logo_img . '" />' . "\n";
	    	}
	    	echo '<meta property="og:title" content="'.get_bloginfo('name').'" />' . "\n";
	    	echo '<meta property="og:url" content="'.get_bloginfo('url').'" />' . "\n";
	    	echo '<meta property="og:description" content="'.get_bloginfo('description').'" />' . "\n";
	        echo "<meta name='keywords' content='".$the_seo."'>" ."\n";
	    }
	}
	
    /* head_code */
    if(vpanel_options("head_code")) {
        echo stripslashes(vpanel_options("head_code"));
    }
}
add_action('wp_head', 'vbegy_head');

function vbegy_footer() {
    /* footer_code */
    if(vpanel_options("footer_code")) {
        echo stripslashes(vpanel_options("footer_code"));
    }
}
add_action('wp_footer', 'vbegy_footer');

/* wp login head */
function vbegy_login_logo() {
	$login_logo        = vpanel_options("login_logo");
	$login_logo_height = vpanel_options("login_logo_height");
	$login_logo_width  = vpanel_options("login_logo_width");
	if (isset($login_logo) && $login_logo != "") {
		echo '<style type="text/css">
		.login h1 a {
			background-image:url('.$login_logo.')  !important;
			background-size: auto !important;
			'.(isset($login_logo_height) && $login_logo_height != ""?"height: ".$login_logo_height."px !important;":"").'
			'.(isset($login_logo_width) && $login_logo_width != ""?"width: ".$login_logo_width."px !important;":"").'
		}
		</style>';
	}
}
add_action('login_head',  'vbegy_login_logo');

/* all_css_color */
function all_css_color($color_1,$color_2) {
	return '
	::-moz-selection {
		background: '.esc_attr($color_1).';
	}
	::selection {
		background: '.esc_attr($color_1).';
	}
	.social-ul li a:hover,.go-up,.widget-about,.post-type,.button-default,.comment-edit-link,.comment-reply-link,.comment-reply-login,.post-quote .post-wrap,.post-link .post-inner.link,.post-gallery .post-img .bx-controls-direction a:hover,.widget-dribbble .bx-controls-direction a:hover,.related-posts .bx-controls-direction a:hover,.post-soundcloud .post-img,.post-twitter .post-img,.post-facebook .post-img,.widget-posts-img a:before,.widget_tag_cloud a:hover,.tagcloud a:hover,.widget-login-password a:hover,.navigation.navigation-2 li:hover ul,.related-post-one:hover .related-post-type,.blockquote-2,.widget .search-submit,input[type="submit"],button[type="submit"],.widget_shopping_cart .button.wc-forward,input[type="button"],.return-to-shop .button,.portfolio-filter li a:hover,.portfolio-filter li.current a,.portfolio-one:hover .portfolio-content,.block-box-title-more:hover,.block-box-img a:before,.carousel-box-img a:before,#footer-top .widget_tag_cloud a:hover,#footer-top .tagcloud a:hover,.box-slideshow .bx-controls-direction a:hover,.news-ticker-title,.news-ticker-content .bx-controls-direction a:hover,.review_rating,.rating_score,.styled-select::before,.fileinputs span,.post-edit a:hover i,.post-delete a:hover i,.woocommerce input[type="submit"][name="update_cart"]:hover,.woocommerce .widget_price_filter .price_slider_wrapper .ui-widget-content,.woocommerce-page .widget_price_filter .price_slider_wrapper .ui-widget-content,ul.products li .woocommerce_product_thumbnail .woocommerce_woo_cart_bt .button,ul.products li .woocommerce_product_thumbnail .yith-wcwl-add-button .add_to_wishlist,.cart_list .remove,.cart-wrapper .button.wc-forward,.cart-wrapper a.cart_control .numofitems,.full-width-slideshow .bx-controls-direction a:hover,.wc-proceed-to-checkout .button.wc-forward {
		background-color: '.esc_attr($color_1).';
	}
	.color,.logo a,.navigation li:hover > a,.navigation li ul li:hover > a,.navigation li.current_page_item > a,.navigation li ul li.current_page_item > a,.navigation.navigation-2 > ul > li.current_page_item > a,.navigation.navigation-2 > ul > li:hover > a,.copyrights a,.post-meta div a,.post-head > h1 a:hover,.post-meta div span,.widget li a:hover,.widget-posts-content span a,.widget .widget-comments-content > a,.page-404 h2,.related-post-head span a,.commentlist li.comment .comment-body .comment-text .author span,.commentlist li.comment .comment-body .comment-text .author span a,blockquote .author,.post-meta .post-tags a:hover,.post a:hover,.accordion-archive ul li:hover:before,.navigation_mobile > ul li:hover > a,.navigation_mobile > ul li:hover:before,.navigation_mobile > ul li:hover > a > span i,.navigation_mobile_click:hover,.navigation_mobile_click:hover:before,.portfolio-meta h6 a:hover,.portfolio-item-2 .portfolio-meta h6 a,.block-box-title-more,.block-box-title a:hover,.block-box-1 li .block-box-content > a:first-child:hover,.block-box-1 li .block-box-content span a,.carousel-box-1 li .block-box-content > a:first-child:hover,.carousel-box-1 li .block-box-content span a,.carousel-box-2 li .block-box-content span a,.footer-subscribe h3,#footer-top a:hover,#footer-top .widget-posts-content span a,#footer-top .widget .post-content-small span a,.box-slideshow-content > a:hover,.box-slideshow-content span a,.criteria_score,.summary_score,.post .post-inner-content a,.navigation > div > ul > li.mega-menu li li > a:hover,.navigation > div > ul > li.mega-menu li li:hover:before,.navigation li.current-menu-item > a,.navigation li.current-menu-parent > a,.page-navigation div.nav-previous a:hover,.page-navigation div.nav-next a:hover,.woocommerce mark,.woocommerce .product_list_widget ins span,.woocommerce-page .product_list_widget ins span,ul.products li .product-details h3 a:hover,ul.products li .product-details .price,ul.products li .product-details h3 a:hover,ul.products li .product-details > a:hover,.crumbs a:hover,.main_tabs .tabs li.active > a,.widget.woocommerce:not(.widget_product_categories):not(.widget_layered_nav) ul li a:hover,.price > .amount,.woocommerce-page .product .woocommerce-woo-price ins span,.cart_wrapper .widget_shopping_cart_content ul li a:hover,.full-width-image-content span a {
		color: '.esc_attr($color_1).';
	}
	.loader_html,.widget_tag_cloud a:hover,.tagcloud a:hover,.related-posts .bx-controls-direction a:hover,blockquote,.block-box-title-more:hover,#footer-top .widget_tag_cloud a:hover,#footer-top .tagcloud a:hover,ul.products li .out-of-stock.onsale-s:after,.product > .out-of-stock.onsale-s:after {
		border-color: '.esc_attr($color_1).';
	}
	.post-quote-top,.post-quote-bottom,.post-link .post-inner.link .fa-link,.widget .widget-posts-img i.fa,.block-box-img:hover i.fa,.carousel-box-img:hover i.fa {
		color: '.esc_attr($color_2).';
	}
	.widget-about-img {
		border-color: '.esc_attr($color_2).';
	}';
}

/* Content Width */
if (!isset( $content_width ))
	$content_width = 785;

/* Save default options */
$default_options = array(
	"loader" => "on",
	"stripe" => "on",
	"nicescroll" => "on",
	"seo_active" => "on",
	"header_style" => "1",
	"header_menu" => "on",
	"header_menu_style" => "1",
	"header_fixed" => 0,
	"header_fixed_responsive" => 0,
	"header_cart" => "on",
	"header_search" => "on",
	"header_follow" => "on",
	"header_follow_style" => "1",
	"facebook_icon_h" => "#",
	"twitter_icon_h" => "#",
	"gplus_icon_h" => "#",
	"linkedin_icon_h" => "#",
	"dribbble_icon_h" => "#",
	"youtube_icon_h" => "#",
	"skype_icon_h" => "#",
	"vimeo_icon_h" => "#",
	"flickr_icon_h" => "#",
	"breadcrumbs" => "on",
	"logo_display" => "display_title",
	"head_slide" => "none",
	"head_slide_style" => "slideshow_thumbnail",
	"head_top_work" => "home_page",
	"slide_overlay" => "enable",
	"excerpt_title" => "5",
	"excerpt" => "25",
	"slides_number" => "5",
	"head_slide_background" => "transparent",
	"news_ticker" => "on",
	"news_excerpt_title" => "5",
	"news_number" => "5",
	"the_captcha" => 0,
	"the_captcha_register" => 0,
	"the_captcha_comment" => 0,
	"show_captcha_answer" => 0,
	"captcha_style" => "question_answer",
	"captcha_question" => "What is the capital of Egypt ?",
	"captcha_answer" => "Cairo",
	"add_post_no_register" => 0,
	"post_publish" => "draft",
	"tags_post" => "on",
	"attachment_post" => "on",
	"content_post" => "on",
	"can_edit_post" => 0,
	"post_delete" => 0,
	"author_img" => "on",
	"author_post_style" => "slider",
	"author_blog_pages_show" => 4,
	"author_excerpt_title" => 5,
	"author_sidebar_layout" => "default",
	"author_sidebar" => "default",
	"author_layout" => "default",
	"author_template" => "default",
	"author_skin_l" => "default",
	"author_skin" => "default",
	"post_style" => "style_1",
	"category_description" => "on",
	"category_rss" => "on",
	"date_format" => "F j, Y",
	"author_by" => "on",
	"category_post" => "on",
	"post_meta" => "on",
	"post_review" => "on",
	"post_share" => "on",
	"post_views" => "on",
	"post_type" => "on",
	"post_author" => "on",
	"post_pagination" => "standard",
	"excerpt_type" => "words",
	"post_excerpt_title" => 5,
	"post_excerpt" => 40,
	"post_author_box" => "on",
	"related_post" => "on",
	"related_number" => 4,
	"related_number_full" => 6,
	"excerpt_related_title" => 5,
	"post_comments" => "on",
	"post_comments_user" => 0,
	"post_navigation" => "on",
	"404_page" => "Lorem ipsum dolor sit amet, mauris suspendisse viverra eleifend tortor tellus suscipit, tortor aliquet at nulla mus, dignissim neque, nulla neque.",
	"sidebar_layout" => "right",
	"sticky_sidebar" => "on",
	"sidebar_home" => "default",
	"else_sidebar" => "default",
	"home_layout" => "full",
	"home_template" => "grid_1200",
	"site_skin_l" => "site_light",
	"site_skin" => "default",
	"footer_top" => "on",
	"subscribe_f" => "on",
	"feedburner_h3" => "Subscribe for our weekly news letter",
	"feedburner_p" => "Suspendisse non augue tincidunt, ullamcorper odio vel, tempor risus. In cursus lacus at mattis consectetur.",
	"footer_layout_1" => "footer_no",
	"footer_layout_2" => "footer_no",
	"footer_copyrights" => "Copyright 2014 logger | <a href=http://themeforest.net/user/2codeThemes/portfolio?ref=2codeThemes>By 2codeThemes</a>",
	"social_icon_f" => "on",
	"facebook_icon_f" => "#",
	"twitter_icon_f" => "#",
	"gplus_icon_f" => "#",
	"linkedin_icon_f" => "#",
	"dribbble_icon_f" => "#",
	"youtube_icon_f" => "#",
	"skype_icon_f" => "#",
	"vimeo_icon_f" => "#",
	"flickr_icon_f" => "#",
	"rss_icon_f" => "on",
	"rss_icon_f_other" => "",
);

if (!get_option(vpanel_options)) {
	add_option(vpanel_options,$default_options);
}