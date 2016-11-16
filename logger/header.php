<?php ob_start();?>
<!DOCTYPE html>
<!--[if IE]>          <html class="no-js lt-ie" <?php language_attributes(); ?>> <![endif]-->
<!--[if lt IE 7]>     <html class="no-js lt-ie lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>        <html class="no-js lt-ie lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>        <html class="no-js lt-ie lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]>     <html class="no-js lt-ie lt-ie9" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo('charset'); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="X-UA-Compatible" content="IE=9">
<title><?php wp_title( '|', true, 'right' );?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">
<?php wp_head();?>
</head>
<body <?php body_class();?>>
	<div class="background-cover"></div>
	<?php
	$vbegy_layout = "";
	$cat_layout = "";
	if (is_category()) {
		$category_id = get_query_var('cat');
		$categories = get_option("categories_$category_id");
		$cat_layout = (isset($categories["cat_layout"])?$categories["cat_layout"]:"default");
	}else if (is_tax("product_cat")) {
		$tax_id = get_term_by('slug',get_query_var('term'),"product_cat");
		$tax_id = $tax_id->term_id;
		$categories = get_option("categories_$tax_id");
		$cat_layout = (isset($categories["cat_layout"])?$categories["cat_layout"]:"default");
		if ($cat_layout == "" || $cat_layout == "default") {
			$cat_layout = vpanel_options("products_layout");
		}
	}else if (is_tax("product_tag") || is_post_type_archive("product")) {
		$products_layout = vpanel_options("products_layout");
	}else if (is_single() || is_page()) {
		$vbegy_layout = rwmb_meta('vbegy_layout','radio',$post->ID);
		if (is_singular("product") && ($vbegy_layout == "" || $vbegy_layout == "default")) {
			$vbegy_layout = vpanel_options("products_layout");
		}
		if ($vbegy_layout == "" || $vbegy_layout == "default") {
			$vbegy_layout = vpanel_options("home_layout");
		}
	}
	$home_layout = vpanel_options("home_layout");
	$author_layout = vpanel_options("author_layout");
	if (is_author() && $author_layout != "default" && $author_layout != "") {
		$home_layout = $author_layout;
	}
	$loader_option = vpanel_options("loader");
	if ($loader_option == "on") {?>
		<div class="loader"><i class="loader_html fa-spin"></i></div>
	<?php }
	
	if (is_author()) {
		$grid_template = vpanel_options("author_template");
	}else if (is_category()) {
		$grid_template = (isset($categories["cat_template"])?$categories["cat_template"]:"default");
	}else if (is_tax("product_cat")) {
		$grid_template_c = (isset($categories["cat_template"])?$categories["cat_template"]:"default");
		$grid_template = $grid_template_c;
		if ($grid_template == "" || $grid_template == "default") {
			$grid_template_c = vpanel_options("products_template");
			$grid_template = $grid_template_c;
		}
	}else if (is_tax("product_tag") || is_post_type_archive("product")) {
		$grid_template = vpanel_options("products_template");
	}else if (is_single() || is_page()) {
		$grid_template = rwmb_meta('vbegy_home_template','radio',$post->ID);
		if (is_singular("product") && ($grid_template == "" || $grid_template == "default")) {
			$grid_template = vpanel_options("products_template");
		}
		if ($grid_template == "" || $grid_template == "default") {
			$grid_template = vpanel_options("home_template");
		}
	}else {
		$grid_template = vpanel_options("home_template");
	}
	
	if ((is_author() && ($grid_template == "" || $grid_template == "default")) || ((is_single() || is_page()) && ($grid_template == "" || $grid_template == "default")) || (is_category() && ($grid_template == "" || $grid_template == "default")) || (is_tax("product_cat") && ($grid_template_c == "" || $grid_template_c == "default")) || (is_tax("product_tag") && ($grid_template == "" || $grid_template == "default")) || ((is_post_type_archive("product")) && ($grid_template == "" || $grid_template == "default"))) {
		$grid_template = vpanel_options("home_template");
	}
	
	if (is_single() || is_page()) {
		$vbegy_custom_header = rwmb_meta('vbegy_custom_header','checkbox',$post->ID);
		$custom_slide_show_style = rwmb_meta('vbegy_custom_slide_show_style','checkbox',$post->ID);
	}
	$head_top_work = vpanel_options("head_top_work");
	if ((is_single() || is_page()) && isset($vbegy_custom_header) && $vbegy_custom_header == 1) {
		$vbegy_header_style = rwmb_meta('vbegy_header_style','select',$post->ID);
		$vbegy_header_menu = rwmb_meta('vbegy_header_menu','checkbox',$post->ID);
		$vbegy_header_menu_style = rwmb_meta('vbegy_header_menu_style','radio',$post->ID);
		$vbegy_header_fixed = rwmb_meta('vbegy_header_fixed','checkbox',$post->ID);
		$vbegy_logo_display = rwmb_meta('vbegy_logo_display','radio',$post->ID);
		$vbegy_logo_img = rwmb_meta('vbegy_logo_img','upload',$post->ID);
		$vbegy_retina_logo = rwmb_meta('vbegy_retina_logo','upload',$post->ID);
		$vbegy_header_cart = rwmb_meta('vbegy_header_cart','checkbox',$post->ID);
		$vbegy_header_search = rwmb_meta('vbegy_header_search','checkbox',$post->ID);
		$vbegy_header_follow = rwmb_meta('vbegy_header_follow','checkbox',$post->ID);
		$vbegy_header_follow_style = rwmb_meta('vbegy_header_follow_style','radio',$post->ID);
		$vbegy_facebook_icon_h = rwmb_meta('vbegy_facebook_icon_h','text',$post->ID);
		$vbegy_twitter_icon_h = rwmb_meta('vbegy_twitter_icon_h','text',$post->ID);
		$vbegy_gplus_icon_h = rwmb_meta('vbegy_gplus_icon_h','text',$post->ID);
		$vbegy_linkedin_icon_h = rwmb_meta('vbegy_linkedin_icon_h','text',$post->ID);
		$vbegy_dribbble_icon_h = rwmb_meta('vbegy_dribbble_icon_h','text',$post->ID);
		$vbegy_youtube_icon_h = rwmb_meta('vbegy_youtube_icon_h','text',$post->ID);
		$vbegy_vimeo_icon_h = rwmb_meta('vbegy_vimeo_icon_h','text',$post->ID);
		$vbegy_skype_icon_h = rwmb_meta('vbegy_skype_icon_h','text',$post->ID);
		$vbegy_flickr_icon_h = rwmb_meta('vbegy_flickr_icon_h','text',$post->ID);
		$vbegy_soundcloud_icon_h = rwmb_meta('vbegy_soundcloud_icon_h','text',$post->ID);
		$vbegy_instagram_icon_h = rwmb_meta('vbegy_instagram_icon_h','text',$post->ID);
		$vbegy_pinterest_icon_h = rwmb_meta('vbegy_pinterest_icon_h','text',$post->ID);
		$vbegy_menu_header = rwmb_meta('vbegy_menu_header','select',$post->ID);
		$header_style = $vbegy_header_style;
		$header_menu = $vbegy_header_menu;
		if ($vbegy_header_menu == 1) {
			$header_menu = "on";
		}
		$header_menu_style = $vbegy_header_menu_style;
		$header_fixed = $vbegy_header_fixed;
		if ($vbegy_header_fixed == 1) {
			$header_fixed = "on";
		}
		$logo_display = $vbegy_logo_display;
		$logo_img = $vbegy_logo_img;
		$retina_logo = $vbegy_retina_logo;
		$header_cart = $vbegy_header_cart;
		if ($vbegy_header_cart == 1) {
			$header_cart = "on";
		}
		$header_search = $vbegy_header_search;
		if ($vbegy_header_search == 1) {
			$header_search = "on";
		}
		$header_follow = $vbegy_header_follow;
		if ($vbegy_header_follow == 1) {
			$header_follow = "on";
		}
		$header_follow_style = $vbegy_header_follow_style;
		$facebook_icon_h = $vbegy_facebook_icon_h;
		$twitter_icon_h = $vbegy_twitter_icon_h;
		$gplus_icon_h = $vbegy_gplus_icon_h;
		$linkedin_icon_h = $vbegy_linkedin_icon_h;
		$dribbble_icon_h = $vbegy_dribbble_icon_h;
		$youtube_icon_h = $vbegy_youtube_icon_h;
		$vimeo_icon_h = $vbegy_vimeo_icon_h;
		$skype_icon_h = $vbegy_skype_icon_h;
		$flickr_icon_h = $vbegy_flickr_icon_h;
		$soundcloud_icon_h = $vbegy_soundcloud_icon_h;
		$instagram_icon_h = $vbegy_instagram_icon_h;
		$pinterest_icon_h = $vbegy_pinterest_icon_h;
	}else {
		$header_style = vpanel_options("header_style");
		$header_menu = vpanel_options("header_menu");
		$header_menu_style = vpanel_options("header_menu_style");
		$header_fixed = vpanel_options("header_fixed");
		$logo_display = vpanel_options("logo_display");
		$logo_img = vpanel_options("logo_img");
		$retina_logo = vpanel_options("retina_logo");
		$header_cart = vpanel_options("header_cart");
		$header_search = vpanel_options("header_search");
		$header_follow = vpanel_options("header_follow");
		$header_follow_style = vpanel_options("header_follow_style");
		$facebook_icon_h = vpanel_options("facebook_icon_h");
		$twitter_icon_h = vpanel_options("twitter_icon_h");
		$gplus_icon_h = vpanel_options("gplus_icon_h");
		$linkedin_icon_h = vpanel_options("linkedin_icon_h");
		$dribbble_icon_h = vpanel_options("dribbble_icon_h");
		$youtube_icon_h = vpanel_options("youtube_icon_h");
		$skype_icon_h = vpanel_options("skype_icon_h");
		$vimeo_icon_h = vpanel_options("vimeo_icon_h");
		$flickr_icon_h = vpanel_options("flickr_icon_h");
		$instagram_icon_h = vpanel_options("instagram_icon_h");
		$soundcloud_icon_h = vpanel_options("soundcloud_icon_h");
		$pinterest_icon_h = vpanel_options("pinterest_icon_h");
	}
	if ((is_single() || is_page()) && isset($custom_slide_show_style) && $custom_slide_show_style == 1) {
		$head_slide = rwmb_meta('vbegy_head_slide','select',$post->ID);
		$head_slide_style = rwmb_meta('vbegy_head_slide_style','select',$post->ID);
		$slide_overlay = rwmb_meta('vbegy_slide_overlay','select',$post->ID);
		$orderby_slide = rwmb_meta('vbegy_orderby_slide','select',$post->ID);
		$excerpt_title_slideshow = rwmb_meta('vbegy_excerpt_title_slideshow','text',$post->ID);
		$excerpt_slideshow = rwmb_meta('vbegy_excerpt_slideshow','text',$post->ID);
		$slideshow_number = rwmb_meta('vbegy_slideshow_number','text',$post->ID);
		$slideshow_display = rwmb_meta('vbegy_slideshow_display','select',$post->ID);
		$slideshow_single_category = rwmb_meta('vbegy_slideshow_single_category','select',$post->ID);
		$slideshow_categories = rwmb_meta('vbegy_slideshow_categories','type=checkbox_list',$post->ID);
		$slideshow_posts = get_post_meta($post->ID,'vbegy_slideshow_posts');
		if (isset($slideshow_posts) && is_array($slideshow_posts)) {
			$slideshow_posts = $slideshow_posts[0];
		}
		$excerpt_title_thumbnail = rwmb_meta('vbegy_excerpt_title_thumbnail','text',$post->ID);
		$thumbnail_number = rwmb_meta('vbegy_thumbnail_number','text',$post->ID);
		$orderby_thumbnail = rwmb_meta('vbegy_orderby_thumbnail','select',$post->ID);
		$thumbnail_display = rwmb_meta('vbegy_thumbnail_display','select',$post->ID);
		$thumbnail_single_category = rwmb_meta('vbegy_thumbnail_single_category','select',$post->ID);
		$thumbnail_categories = rwmb_meta('vbegy_thumbnail_categories','type=checkbox_list',$post->ID);
		$thumbnail_posts = get_post_meta($post->ID,'vbegy_thumbnail_posts');
		if (isset($thumbnail_posts) && is_array($thumbnail_posts)) {
			$thumbnail_posts = $thumbnail_posts[0];
		}
		$head_slide_background = rwmb_meta('vbegy_head_slide_background','select',$post->ID);
		$head_slide_background_color = rwmb_meta('vbegy_head_slide_background_color','color',$post->ID);
		$head_slide_background_img = rwmb_meta('vbegy_head_slide_background_img','upload',$post->ID);
		$head_slide_background_repeat = rwmb_meta('vbegy_head_slide_background_repeat','select',$post->ID);
		$head_slide_background_fixed = rwmb_meta('vbegy_head_slide_background_fixed','select',$post->ID);
		$head_slide_background_position_x = rwmb_meta('vbegy_head_slide_background_position_x','select',$post->ID);
		$head_slide_background_position_y = rwmb_meta('vbegy_head_slide_background_position_y','select',$post->ID);
		$head_slide_background_position = $head_slide_background_position_x." ".$head_slide_background_position_y;
		$head_slide_full_screen_background = rwmb_meta('vbegy_head_slide_background_full','checkbox',$post->ID);
		if ($head_slide_full_screen_background == 1) {
			$head_slide_full_screen_background = "on";
		}
		$head_slide_custom_background = "on";
		$news_ticker = rwmb_meta('vbegy_news_ticker','checkbox',$post->ID);
		if ($news_ticker == 1) {
			$news_ticker = "on";
		}
		$news_excerpt_title = rwmb_meta('vbegy_news_excerpt_title','text',$post->ID);
		$news_number = rwmb_meta('vbegy_news_number','text',$post->ID);
		$orderby_news = rwmb_meta('vbegy_orderby_news','select',$post->ID);
		$news_display = rwmb_meta('vbegy_news_display','select',$post->ID);
		$news_single_category = rwmb_meta('vbegy_news_single_category','select',$post->ID);
		$news_categories = rwmb_meta('vbegy_news_categories','type=checkbox_list',$post->ID);
		$news_posts = get_post_meta($post->ID,'vbegy_news_posts');
		if (isset($news_posts) && is_array($news_posts)) {
			$news_posts = $news_posts[0];
		}
		$video_head = rwmb_meta('vbegy_video_head','select',$post->ID);
		$video_id_head = rwmb_meta('vbegy_video_id_head','text',$post->ID);
		$custom_embed_head = rwmb_meta('vbegy_custom_embed_head','textarea',$post->ID);
	}else {
		$head_slide = vpanel_options('head_slide');
		$head_slide_style = vpanel_options("head_slide_style");
		$slide_overlay = vpanel_options("slide_overlay");
		$orderby_slide = vpanel_options("orderby_slide");
		$excerpt_title_slideshow = vpanel_options("excerpt_title_slideshow");
		$excerpt_slideshow = vpanel_options("excerpt_slideshow");
		$slideshow_number = vpanel_options("slideshow_number");
		$slideshow_display = vpanel_options("slideshow_display");
		$slideshow_single_category = vpanel_options("slideshow_single_category");
		$slideshow_categories = vpanel_options("slideshow_categories");
		$slideshow_posts = vpanel_options("slideshow_posts");
		$excerpt_title_thumbnail = vpanel_options("excerpt_title_thumbnail");
		$thumbnail_number = vpanel_options("thumbnail_number");
		$orderby_thumbnail = vpanel_options("orderby_thumbnail");
		$thumbnail_display = vpanel_options("thumbnail_display");
		$thumbnail_single_category = vpanel_options("thumbnail_single_category");
		$thumbnail_categories = vpanel_options("thumbnail_categories");
		$thumbnail_posts = vpanel_options("thumbnail_posts");
		$head_slide_background = vpanel_options('head_slide_background');
		$head_slide_custom_background = vpanel_options('head_slide_custom_background');
		$head_slide_background_color = $head_slide_custom_background["color"];
		$head_slide_background_img = $head_slide_custom_background["image"];
		$head_slide_background_repeat = $head_slide_custom_background["repeat"];
		$head_slide_background_position = $head_slide_custom_background["position"];
		$head_slide_background_fixed = $head_slide_custom_background["attachment"];
		$head_slide_full_screen_background = vpanel_options('head_slide_full_screen_background');
		$news_ticker = vpanel_options('news_ticker');
		$news_excerpt_title = vpanel_options('news_excerpt_title');
		$news_number = vpanel_options('news_number');
		$orderby_news = vpanel_options("orderby_news");
		$news_display = vpanel_options("news_display");
		$news_single_category = vpanel_options("news_single_category");
		$news_categories = vpanel_options("news_categories");
		$news_posts = vpanel_options("news_posts");
		$slideshow_display = vpanel_options('slideshow_display');
		$slideshow_posts = vpanel_options('slideshow_posts');
		$video_head = vpanel_options('video_head');
		$video_id_head = vpanel_options('video_id_head');
		$custom_embed_head = vpanel_options('custom_embed_head');
	}
	
	$nicescroll = vpanel_options("nicescroll");
	?>
	<div id="wrap" class="<?php echo esc_attr($grid_template)." ";if ($header_fixed == 'on') {echo "fixed-enabled ";}if (is_category() && $cat_layout != "default" && $cat_layout != "") {if ($cat_layout == "fixed") {echo "boxed ";}else if ($cat_layout == "fixed_2") {echo "boxed-2 ";}}else if (is_tax("product_cat") && $cat_layout != "default" && $cat_layout != "") {if ($cat_layout == "fixed") {echo "boxed ";}else if ($cat_layout == "fixed_2") {echo "boxed-2 ";}}else if (is_tax("product_tag") && $products_layout != "default" && $products_layout != "") {if ($products_layout == "fixed") {echo "boxed ";}else if ($products_layout == "fixed_2") {echo "boxed-2 ";}}else if ((is_post_type_archive("product")) && $products_layout != "default" && $products_layout != "") {if ($products_layout == "fixed") {echo "boxed ";}else if ($products_layout == "fixed_2") {echo "boxed-2 ";}}else if ((is_single() || is_page()) && $vbegy_layout != "default" && $vbegy_layout != "") {if ($vbegy_layout == "fixed") {echo "boxed ";}else if ($vbegy_layout == "fixed_2") {echo "boxed-2 ";}}else {if ($home_layout == "fixed") {echo "boxed ";}else if ($home_layout == "fixed_2") {echo "boxed-2 ";}}if ($nicescroll == "on") {echo "wrap-nicescroll";}?>">
		<?php if ($header_search == 'on') {?>
			<div class="wrap-search">
				<form role="search" method="get" class="searchform" action="<?php echo home_url('/'); ?>">
					<input type="search" name="s" value="<?php if (get_search_query() != "") {echo the_search_query();}else {_e("Search here ...","vbegy");}?>" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;">
					<div class="header-search"><div class="header-search-a"><i class="fa fa-times"></i></div></div>
				</form>
			</div><!-- End wrap-search -->
		<?php }?>
		<header id="header" class="<?php echo ($header_style == 2?'header-2':'').($header_style == 3 || $header_style == 5?'header-3':'').($header_style == 4?'header-4':'').($header_style == 5?' header-5':'').($head_slide == "header"?" header-slide-header":"")?>">
			<?php if ($header_style == 1 || $header_style == 3 || $header_style == 4) {?>
				<div class="container clearfix">
			<?php }?>
				<div class="logo">
					<?php
					if ($logo_display == "custom_image") {?>
					    <a class="logo-img" href="<?php echo esc_url(home_url('/'));?>" itemprop="url" title="<?php echo esc_attr(get_bloginfo('name','display'))?>">
					    	<?php if (isset($logo_img) && $logo_img != "") {?>
					    		<img class="default_logo" itemprop="logo" alt="<?php echo esc_attr(get_bloginfo('name','display'))?>" src="<?php echo esc_attr($logo_img)?>">
					    	<?php }
					    	if (isset($retina_logo) && $retina_logo != "") {?>
					    		<img class="retina_logo" itemprop="logo" alt="<?php echo esc_attr(get_bloginfo('name','display'))?>" src="<?php echo esc_attr($retina_logo)?>">
					    	<?php }?>
					    </a>
					<?php }else {?>
						<a href="<?php echo esc_url(home_url('/'));?>" itemprop="url" title="<?php echo esc_attr(get_bloginfo('name','display'))?>"<?php echo ($header_style == 3 || $header_style == 5?" class='logo-name'":"");?>><?php bloginfo('name');?></a>
						<?php if ($header_style == 3 || $header_style == 5) {
							echo "<span>";bloginfo('description');echo "</span>";
						}
					}?>
				</div><!-- End logo -->
				
				<?php 
				if ($header_style == 3 || $header_style == 5) {
					if (is_single() || is_page()) {
						$vbegy_header_adv_type_3 = rwmb_meta('vbegy_header_adv_type_3','radio',$post->ID);
						$vbegy_header_adv_code_3 = rwmb_meta('vbegy_header_adv_code_3','textarea',$post->ID);
						$vbegy_header_adv_href_3 = rwmb_meta('vbegy_header_adv_href_3','text',$post->ID);
						$vbegy_header_adv_img_3 = rwmb_meta('vbegy_header_adv_img_3','upload',$post->ID);
					}
					
					if ((is_single() || is_page()) && (($vbegy_header_adv_type_3 == "display_code" && $vbegy_header_adv_code_3 != "") || ($vbegy_header_adv_type_3 == "custom_image" && $vbegy_header_adv_img_3 != ""))) {
						$header_adv_type_3 = $vbegy_header_adv_type_3;
						$header_adv_code_3 = $vbegy_header_adv_code_3;
						$header_adv_href_3 = $vbegy_header_adv_href_3;
						$header_adv_img_3 = $vbegy_header_adv_img_3;
					}else {
						$header_adv_type_3 = vpanel_options("header_adv_type_3");
						$header_adv_code_3 = vpanel_options("header_adv_code_3");
						$header_adv_href_3 = vpanel_options("header_adv_href_3");
						$header_adv_img_3 = vpanel_options("header_adv_img_3");
					}
					if (($header_adv_type_3 == "display_code" && $header_adv_code_3 != "") || ($header_adv_type_3 == "custom_image" && $header_adv_img_3 != "")) {
						echo '
						<div class="advertising advertising-header-1">';
						if ($header_adv_type_3 == "display_code") {
							echo stripcslashes($header_adv_code_3);
						}else {
							if ($header_adv_href_3 != "") {
								echo '<a href="'.esc_url($header_adv_href_3).'">';
							}
							echo '<img alt="" src="'.$header_adv_img_3.'">';
							if ($header_adv_href_3 != "") {
								echo '</a>';
							}
						}
						echo '</div><!-- End advertising -->
						<div class="advertising-clearfix clearfix"></div>';
					}
				}
				
				if ($header_follow == 'on') {?>
					<div class="header-follow">
						<div class="header-follow-a"><?php _e("Follow Us","vbegy")?></div>
						<div class="follow-social<?php echo ($header_follow_style == 2?' follow-social-2':'')?>">
							<i class="fa fa-caret-up"></i>
							<ul>
								<?php
								if ($facebook_icon_h) {?>
									<li class="social-facebook"><a href="<?php echo esc_url($facebook_icon_h)?>" target="_blank"><i class="fa fa-facebook"></i><?php _e("Facebook","vbegy")?></a></li>
								<?php }
								if ($twitter_icon_h) {?>
									<li class="social-twitter"><a href="<?php echo esc_url($twitter_icon_h)?>" target="_blank"><i class="fa fa-twitter"></i><?php _e("Twitter","vbegy")?></a></li>
								<?php }
								if ($gplus_icon_h) {?>
									<li class="social-google"><a href="<?php echo esc_url($gplus_icon_h)?>" target="_blank"><i class="fa fa-google-plus"></i><?php _e("Google Plus","vbegy")?></a></li>
								<?php }
								if ($linkedin_icon_h) {?>
									<li class="social-linkedin"><a href="<?php echo esc_url($linkedin_icon_h)?>" target="_blank"><i class="fa fa-linkedin"></i><?php _e("Linkedin","vbegy")?></a></li>
								<?php }
								if ($dribbble_icon_h) {?>
									<li class="social-dribbble"><a href="<?php echo esc_url($dribbble_icon_h)?>" target="_blank"><i class="fa fa-dribbble"></i><?php _e("Dribbble","vbegy")?></a></li>
								<?php }
								if ($youtube_icon_h) {?>
									<li class="social-youtube"><a href="<?php echo esc_url($youtube_icon_h)?>" target="_blank"><i class="fa fa-youtube-play"></i><?php _e("Youtube","vbegy")?></a></li>
								<?php }
								if ($vimeo_icon_h) {?>
									<li class="social-vimeo"><a href="<?php echo esc_url($vimeo_icon_h)?>" target="_blank"><i class="fa fa-vimeo-square"></i><?php _e("Vimeo","vbegy")?></a></li>
								<?php }
								if ($skype_icon_h) {?>
									<li class="social-skype"><a href="<?php echo esc_url($skype_icon_h)?>" target="_blank"><i class="fa fa-skype"></i><?php _e("Skype","vbegy")?></a></li>
								<?php }
								if ($flickr_icon_h) {?>
									<li class="social-flickr"><a href="<?php echo esc_url($flickr_icon_h)?>" target="_blank"><i class="fa fa-flickr"></i><?php _e("Flickr","vbegy")?></a></li>
								<?php }
								if ($soundcloud_icon_h) {?>
									<li class="social-soundcloud"><a href="<?php echo esc_url($soundcloud_icon_h)?>" target="_blank"><i class="fa fa-soundcloud"></i><?php _e("Soundcloud","vbegy")?></a></li>
								<?php }
								if ($instagram_icon_h) {?>
									<li class="social-instagram"><a href="<?php echo esc_url($instagram_icon_h)?>" target="_blank"><i class="fa fa-instagram"></i><?php _e("Instagram","vbegy")?></a></li>
								<?php }
								if ($pinterest_icon_h) {?>
									<li class="social-pinterest"><a href="<?php echo esc_url($pinterest_icon_h)?>" target="_blank"><i class="fa fa-pinterest"></i><?php _e("Pinterest","vbegy")?></a></li>
								<?php }?>
							</ul>
						</div><!-- End follow-social -->
					</div><!-- End header-follow -->
				<?php }
				
				if ($header_search == 'on') {?>
					<div class="header-search">
						<div class="header-search-a"><i class="fa fa-search"></i></div>
					</div><!-- End header-search -->
				<?php }
				
				if (class_exists('woocommerce') && $header_cart == 'on') {
					echo "<div class='cart-wrapper'>";
						global $woocommerce;
						$cart_url = $woocommerce->cart->get_cart_url();
						$num = $woocommerce->cart->cart_contents_count;
						echo '<a href="'.$cart_url.'" class="cart_control nav-button nav-cart"><i class="enotype-icon-cart"></i>';
							echo '<span class="numofitems" data-num="'.$num.'">'.$num.'</span>';
						echo '</a>';
						echo '<div class="cart_wrapper'.(sizeof($woocommerce->cart->get_cart()) < 1?" cart_wrapper_empty":"").'"><div class="widget_shopping_cart_content"></div></div>';
					echo "</div>";
				}
				
				if ($header_menu == 'on') {?>
					<nav class="navigation<?php echo ($header_menu_style == 2?' navigation-2':'')?>">
						<?php if ((is_single() || is_page()) && isset($vbegy_custom_header) && $vbegy_custom_header == 1) {
							wp_nav_menu(array('container_class' => 'header-menu','menu_class' => '','menu' => $vbegy_menu_header,'fallback_cb' => 'vpanel_nav_fallback'));
						}else { 
							wp_nav_menu(array('container_class' => 'header-menu','menu_class' => '','theme_location' => 'header_menu','fallback_cb' => 'vpanel_nav_fallback'));
						}?>
					</nav><!-- End navigation -->
					<nav class="navigation_mobile navigation_mobile_main">
						<div class="navigation_mobile_click"><?php _e("Go to...","vbegy")?></div>
						<ul></ul>
					</nav><!-- End navigation_mobile -->
				<?php }
			if ($header_style == 1 || $header_style == 3 || $header_style == 4) {?>
				</div><!-- End container -->
			<?php }?>
			<div class="clearfix"></div>
		</header><!-- End header -->
		
		<?php
		if ($head_top_work == "all_pages" && $head_slide == "header") {
			include(locate_template("includes/head_slide.php"));
		}
		
		if (((is_front_page() || is_home()) || ((is_single() || is_page()) && isset($custom_slide_show_style) && $custom_slide_show_style == 1)) && $head_top_work == "home_page" && $head_slide == "header") {
			include(locate_template("includes/head_slide.php"));
		}
		
		if (is_single() || is_page()) {
			$vbegy_image_style = rwmb_meta('vbegy_image_style','select',$post->ID);
			if ($vbegy_image_style == "style_1" || $vbegy_image_style == "style_2") {
				$vbegy_what_post = rwmb_meta('vbegy_what_post','select',$post->ID);
				$vbegy_slideshow_type = rwmb_meta('vbegy_slideshow_type','select',$post->ID);
				$posts_meta = vpanel_options("post_meta");
				$meta_post_position = rwmb_meta('vbegy_meta_post_position','select',$post->ID);
				$date_format = (vpanel_options("date_format")?vpanel_options("date_format"):get_option("date_format"));
				$author_by = vpanel_options("author_by");
				$category_post = vpanel_options("category_post");
				$post_meta_s = rwmb_meta('vbegy_post_meta_s','checkbox',$post->ID);
				$custom_page_setting = rwmb_meta('vbegy_custom_page_setting','checkbox',$post->ID);
				
				if ($vbegy_what_post == "slideshow") {
					if ($vbegy_slideshow_type == "custom_slide") {
						$builder_slide_item = get_post_meta($post->ID,'builder_slide_item');
						$builder_slide_item = $builder_slide_item[0];
						if ($vbegy_image_style == "style_2") {
							echo "<div class='container'>";
						}
						if (!empty($builder_slide_item) && is_array($builder_slide_item)) {?>
							<div class="full-width-slideshow<?php echo ($vbegy_image_style == "style_2"?" full-width-image-2":"")?>">
								<ul>
									<?php foreach ($builder_slide_item as $builder_slide) {
										$src = wp_get_attachment_image_src($builder_slide['image_id'],'full');
										$src = $src[0];
										echo "<li class='full-width-image".($vbegy_image_style == "style_1"?" full-width-image-1":"").($vbegy_image_style == "style_2"?" full-width-image-2":"")."' style='background-image: url(".$src.")'></li>";
									}?>
								</ul>
								<div class='container'><div class='row'><div class='col-sm-12'>
									<?php include(locate_template("includes/head_full.php"));?>
									<div class="clearfix"></div>
								</div></div></div>
							</div>
						<?php }else if (has_post_thumbnail()) {
							$thumb = get_post_thumbnail_id();
							$img_url = wp_get_attachment_url($thumb,"full");
							if ($vbegy_image_style == "style_2") {
								echo "<div class='container'>";
							}
							echo "<div class='full-width-image".($vbegy_image_style == "style_1"?" full-width-image-1":"").($vbegy_image_style == "style_2"?" full-width-image-2":"")."' style='background-image: url(".$img_url.")'><div class='container'><div class='row'><div class='col-sm-12'>";
								include(locate_template("includes/head_full.php"));
							echo "</div></div></div></div>";
							if ($vbegy_image_style == "style_2") {
								echo "</div>";
							}
						}
						if ($vbegy_image_style == "style_2") {
							echo "</div>";
						}
					}else if ($vbegy_slideshow_type == "upload_images") {
						global $wpdb;
						$query = $wpdb->prepare("SELECT * FROM {$wpdb->prefix}postmeta WHERE meta_key = 'vbegy_upload_images' AND post_id = %s",(int)$post->ID);
						$result = $wpdb->get_results($query);
						if ($vbegy_image_style == "style_2") {
							echo "<div class='container'>";
						}
						if (!empty($result) && is_array($result)) {?>
							<div class="full-width-slideshow<?php echo ($vbegy_image_style == "style_2"?" full-width-image-2":"")?>">
								<ul>
									<?php foreach ($result as $results) {
										$slideshow_imgs = $results->meta_value.',';
										$slideshow_imgs = explode(",",$slideshow_imgs);
										$images = $wpdb->get_col("SELECT ID FROM {$wpdb->posts} WHERE post_type = 'attachment' AND ID IN ('".implode("','",$slideshow_imgs)."') ORDER BY menu_order ASC");
										foreach ($images as $att) {
											$src = wp_get_attachment_image_src($att,'full');
											$src = $src[0];
											echo "<li class='full-width-image".($vbegy_image_style == "style_1"?" full-width-image-1":"").($vbegy_image_style == "style_2"?" full-width-image-2":"")."' style='background-image: url(".$src.")'></li>";
										}
									}?>
								</ul>
								<div class='container'><div class='row'><div class='col-sm-12'>
									<?php include(locate_template("includes/head_full.php"));?>
									<div class="clearfix"></div>
								</div></div></div>
							</div>
					    <?php }else if (has_post_thumbnail()) {
					    	$thumb = get_post_thumbnail_id();
					    	$img_url = wp_get_attachment_url($thumb,"full");
					    	if ($vbegy_image_style == "style_2") {
					    		echo "<div class='container'>";
					    	}
					    	echo "<div class='full-width-image".($vbegy_image_style == "style_1"?" full-width-image-1":"").($vbegy_image_style == "style_2"?" full-width-image-2":"")."' style='background-image: url(".$img_url.")'><div class='container'><div class='row'><div class='col-sm-12'>";
					    		include(locate_template("includes/head_full.php"));
					    	echo "</div></div></div></div>";
					    	if ($vbegy_image_style == "style_2") {
					    		echo "</div>";
					    	}
					    }
					    if ($vbegy_image_style == "style_2") {
					    	echo "</div>";
					    }
					}
				}else if (has_post_thumbnail()) {
					$thumb = get_post_thumbnail_id();
					$img_url = wp_get_attachment_url($thumb,"full");
					if ($vbegy_image_style == "style_2") {
						echo "<div class='container'>";
					}
					echo "<div class='full-width-image".($vbegy_image_style == "style_1"?" full-width-image-1":"").($vbegy_image_style == "style_2"?" full-width-image-2":"")."' style='background-image: url(".$img_url.")'><div class='container'><div class='row'><div class='col-sm-12'>";
						include(locate_template("includes/head_full.php"));
					echo "</div></div></div></div>";
					if ($vbegy_image_style == "style_2") {
						echo "</div>";
					}
				}
			}
		}
		
		$sidebar_layout = "";
		$container_span = "col-md-8";
		$full_span = "col-md-12";
		$page_right = "page-right-sidebar";
		$page_left = "sections-left-sidebar";
		$page_full_width = "sections-full-width";
		wp_reset_query();
		
		if (is_author()) {
			$author_sidebar_layout = vpanel_options('author_sidebar_layout');
			if ($author_sidebar_layout == 'centered') {
				$sidebar_dir = 'sections-centered';
				$homepage_content_span = $container_span;
			}elseif ($author_sidebar_layout == 'left') {
				$sidebar_dir = $page_left;
				$homepage_content_span = $container_span;
			}elseif ($author_sidebar_layout == 'full') {
				$sidebar_dir = $page_full_width;
				$homepage_content_span = $full_span;
			}else {
				$sidebar_dir = $page_right;
				$homepage_content_span = $container_span;
			}
		}else if (is_tax("product_cat")) {
			$cat_sidebar_layout = (isset($categories["cat_sidebar_layout"])?$categories["cat_sidebar_layout"]:"default");
			if ($cat_sidebar_layout == "" || $cat_sidebar_layout == "default") {
				$cat_sidebar_layout = vpanel_options("products_sidebar_layout");
			}
			if ($cat_sidebar_layout == 'centered') {
				$sidebar_dir = 'sections-centered';
				$homepage_content_span = $container_span;
			}elseif ($cat_sidebar_layout == 'left') {
				$sidebar_dir = $page_left;
				$homepage_content_span = $container_span;
			}elseif ($cat_sidebar_layout == 'full') {
				$sidebar_dir = $page_full_width;
				$homepage_content_span = $full_span;
			}else {
				$sidebar_dir = $page_right;
				$homepage_content_span = $container_span;
			}
		}else if (is_tax("product_tag") || is_post_type_archive("product")) {
			$products_sidebar_layout = vpanel_options('products_sidebar_layout');
			if ($products_sidebar_layout == 'centered') {
				$sidebar_dir = 'sections-centered';
				$homepage_content_span = $container_span;
			}elseif ($products_sidebar_layout == 'left') {
				$sidebar_dir = $page_left;
				$homepage_content_span = $container_span;
			}elseif ($products_sidebar_layout == 'full') {
				$sidebar_dir = $page_full_width;
				$homepage_content_span = $full_span;
			}else {
				$sidebar_dir = $page_right;
				$homepage_content_span = $container_span;
			}
		}else if (is_category()) {
			$cat_sidebar_layout = (isset($categories["cat_sidebar_layout"])?$categories["cat_sidebar_layout"]:"default");
			if ($cat_sidebar_layout == 'centered') {
				$sidebar_dir = 'sections-centered';
				$homepage_content_span = $container_span;
			}elseif ($cat_sidebar_layout == 'left') {
				$sidebar_dir = $page_left;
				$homepage_content_span = $container_span;
			}elseif ($cat_sidebar_layout == 'full') {
				$sidebar_dir = $page_full_width;
				$homepage_content_span = $full_span;
			}else {
				$sidebar_dir = $page_right;
				$homepage_content_span = $container_span;
			}
		}else if (is_single() || is_page()) {
			$sidebar_post = rwmb_meta('vbegy_sidebar','radio',$post->ID);
			if (is_singular("product") && ($sidebar_post == "" || $sidebar_post == "default")) {
				$sidebar_post = vpanel_options("products_sidebar_layout");
			}
			if ($sidebar_post == "" || $sidebar_post == "default") {
				$sidebar_post = vpanel_options("sidebar_layout");
			}
			$sidebar_dir = '';
			if (isset($sidebar_post) && $sidebar_post != "default" && $sidebar_post != "") {
				if ($sidebar_post == 'centered') {
					$sidebar_dir = 'sections-centered';
					$sidebar_dir = 'sections-centered';
					$homepage_content_span = $container_span;
				}elseif ($sidebar_post == 'left') {
					$sidebar_dir = $page_left;
					$homepage_content_span = $container_span;
				}elseif ($sidebar_post == 'full') {
					$sidebar_dir = $page_full_width;
					$homepage_content_span = $full_span;
				}else {
					$sidebar_dir = $page_right;
					$homepage_content_span = $container_span;
				}
			}else {
				$sidebar_dir = $page_right;
				$homepage_content_span = $container_span;
			}
		}else {
			$sidebar_layout = vpanel_options('sidebar_layout');
			if ($sidebar_layout == 'centered') {
				$sidebar_dir = 'sections-centered';
				$homepage_content_span = $container_span;
			}elseif ($sidebar_layout == 'left') {
				$sidebar_dir = $page_left;
				$homepage_content_span = $container_span;
			}elseif ($sidebar_layout == 'full') {
				$sidebar_dir = $page_full_width;
				$homepage_content_span = $full_span;
			}else {
				$sidebar_dir = $page_right;
				$homepage_content_span = $container_span;
			}
		}
		
		if (is_single() || is_page()) {
			$vbegy_header_adv_type_1 = rwmb_meta('vbegy_header_adv_type_1','radio',$post->ID);
			$vbegy_header_adv_code_1 = rwmb_meta('vbegy_header_adv_code_1','textarea',$post->ID);
			$vbegy_header_adv_href_1 = rwmb_meta('vbegy_header_adv_href_1','text',$post->ID);
			$vbegy_header_adv_img_1 = rwmb_meta('vbegy_header_adv_img_1','upload',$post->ID);
		}
		
		if ((is_single() || is_page()) && (($vbegy_header_adv_type_1 == "display_code" && $vbegy_header_adv_code_1 != "") || ($vbegy_header_adv_type_1 == "custom_image" && $vbegy_header_adv_img_1 != ""))) {
			$header_adv_type_1 = $vbegy_header_adv_type_1;
			$header_adv_code_1 = $vbegy_header_adv_code_1;
			$header_adv_href_1 = $vbegy_header_adv_href_1;
			$header_adv_img_1 = $vbegy_header_adv_img_1;
		}else {
			$header_adv_type_1 = vpanel_options("header_adv_type_1");
			$header_adv_code_1 = vpanel_options("header_adv_code_1");
			$header_adv_href_1 = vpanel_options("header_adv_href_1");
			$header_adv_img_1 = vpanel_options("header_adv_img_1");
		}
		if (($header_adv_type_1 == "display_code" && $header_adv_code_1 != "") || ($header_adv_type_1 == "custom_image" && $header_adv_img_1 != "")) {
			echo '<div class="clearfix"></div>
			<div class="advertising advertising-header-2">';
			if ($header_adv_type_1 == "display_code") {
				echo stripcslashes($header_adv_code_1);
			}else {
				if ($header_adv_href_1 != "") {
					echo '<a href="'.esc_url($header_adv_href_1).'">';
				}
				echo '<img alt="" src="'.$header_adv_img_1.'">';
				if ($header_adv_href_1 != "") {
					echo '</a>';
				}
			}
			echo '</div><!-- End advertising -->
			<div class="clearfix"></div>';
		}
		?>
		<div class="clearfix"></div>
		<div class="sections <?php echo esc_attr($sidebar_dir);?>">
			<div class="container">
				<div class="row">
					<div class="<?php echo ($sidebar_dir == 'sections-centered'?"col-md-8 col-md-offset-2":"col-md-12")?>"><?php breadcrumbs()?></div>
					
					<div class="with-sidebar-container">
						<div class="<?php echo esc_attr($homepage_content_span).($sidebar_dir == 'sections-centered'?" col-md-offset-2":"");?> main-content">
						
						<?php $post_publish = vpanel_options("post_publish");
						if ($post_publish == "draft") {
							vbegy_session();
						}
						vbegy_session_edit();
						
						if (isset($_POST["post_add"]) && $_POST["post_add"] == "post_add") {
							do_action('new_post');
						}else if (isset($_POST["post_edit"]) && $_POST["post_edit"] == "post_edit") {
							do_action('vpanel_edit_post');
						}
						
						
						if (is_single() || is_page()) {
							$vbegy_header_adv_type = rwmb_meta('vbegy_header_adv_type','radio',$post->ID);
							$vbegy_header_adv_code = rwmb_meta('vbegy_header_adv_code','textarea',$post->ID);
							$vbegy_header_adv_href = rwmb_meta('vbegy_header_adv_href','text',$post->ID);
							$vbegy_header_adv_img = rwmb_meta('vbegy_header_adv_img','upload',$post->ID);
						}
						
						if ((is_single() || is_page()) && (($vbegy_header_adv_type == "display_code" && $vbegy_header_adv_code != "") || ($vbegy_header_adv_type == "custom_image" && $vbegy_header_adv_img != ""))) {
							$header_adv_type = $vbegy_header_adv_type;
							$header_adv_code = $vbegy_header_adv_code;
							$header_adv_href = $vbegy_header_adv_href;
							$header_adv_img = $vbegy_header_adv_img;
						}else {
							$header_adv_type = vpanel_options("header_adv_type");
							$header_adv_code = vpanel_options("header_adv_code");
							$header_adv_href = vpanel_options("header_adv_href");
							$header_adv_img = vpanel_options("header_adv_img");
						}
						if (($header_adv_type == "display_code" && $header_adv_code != "") || ($header_adv_type == "custom_image" && $header_adv_img != "")) {
							echo '<div class="clearfix"></div>
							<div class="advertising">';
							if ($header_adv_type == "display_code") {
								echo stripcslashes($header_adv_code);
							}else {
								if ($header_adv_href != "") {
									echo '<a href="'.esc_url($header_adv_href).'">';
								}
								echo '<img alt="" src="'.$header_adv_img.'">';
								if ($header_adv_href != "") {
									echo '</a>';
								}
							}
							echo '</div><!-- End advertising -->
							<div class="clearfix"></div>';
						}
						?>