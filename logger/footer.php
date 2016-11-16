						<?php if (is_single() || is_page()) {
							$vbegy_content_adv_type = rwmb_meta('vbegy_content_adv_type','radio',$post->ID);
							$vbegy_content_adv_code = rwmb_meta('vbegy_content_adv_code','textarea',$post->ID);
							$vbegy_content_adv_href = rwmb_meta('vbegy_content_adv_href','text',$post->ID);
							$vbegy_content_adv_img = rwmb_meta('vbegy_content_adv_img','upload',$post->ID);
						}
						
						if ((is_single() || is_page()) && (($vbegy_content_adv_type == "display_code" && $vbegy_content_adv_code != "") || ($vbegy_content_adv_type == "custom_image" && $vbegy_content_adv_img != ""))) {
							$content_adv_type = $vbegy_content_adv_type;
							$content_adv_code = $vbegy_content_adv_code;
							$content_adv_href = $vbegy_content_adv_href;
							$content_adv_img = $vbegy_content_adv_img;
						}else {
							$content_adv_type = vpanel_options("content_adv_type");
							$content_adv_code = vpanel_options("content_adv_code");
							$content_adv_href = vpanel_options("content_adv_href");
							$content_adv_img = vpanel_options("content_adv_img");
						}
						if (($content_adv_type == "display_code" && $content_adv_code != "") || ($content_adv_type == "custom_image" && $content_adv_img != "")) {
							echo '<div class="clearfix"></div>
							<div class="advertising advertising-footer">';
							if ($content_adv_type == "display_code") {
								echo stripcslashes($content_adv_code);
							}else {
								if ($content_adv_href != "") {
									echo '<a href="'.$content_adv_href.'">';
								}
								echo '<img alt="" src="'.$content_adv_img.'">';
								if ($content_adv_href != "") {
									echo '</a>';
								}
							}
							echo '</div><!-- End advertising -->
							<div class="clearfix"></div>';
						}?>
					</div><!-- End main-content -->
					<?php
					if (is_single() || is_page()) {
						$custom_page_setting = rwmb_meta('vbegy_custom_page_setting','checkbox',$post->ID);
					}
					$sticky_sidebar = "";
					if ((is_single() || is_page()) && isset($custom_page_setting) && $custom_page_setting == 1) {
						$vbegy_sticky_sidebar_s = rwmb_meta('vbegy_sticky_sidebar_s','checkbox',$post->ID);
						if ($vbegy_sticky_sidebar_s == 1) {
							$sticky_sidebar = "on";
						}
					}else {
						$sticky_sidebar = vpanel_options("sticky_sidebar");
					}
					if ($sticky_sidebar == "on") {
						$sticky_sidebar = " sticky-sidebar";
					}
					?>
					<div class="col-md-4 sidebar-col">
						<div class="sidebar<?php echo esc_attr($sticky_sidebar);?>">
							<?php get_sidebar();?>
						</div><!-- End sidebar -->
					</div><!-- End col-md-4 -->
					<div class="clearfix"></div>
				</div><!-- End with-sidebar-container -->
			</div><!-- End row -->
		</div><!-- End container -->
	</div><!-- End sections -->
	
	<div class="clearfix"></div>
	
	<?php
	wp_reset_query();
	if (is_single() || is_page()) {
		$custom_slide_show_style = rwmb_meta('vbegy_custom_slide_show_style','checkbox',$post->ID);
	}
	$head_top_work = vpanel_options("head_top_work");
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
		$excerpt_title_thumbnail = rwmb_meta('vbegy_excerpt_title_thumbnail','text',$post->ID);
		$thumbnail_number = rwmb_meta('vbegy_thumbnail_number','text',$post->ID);
		$orderby_thumbnail = rwmb_meta('vbegy_orderby_thumbnail','select',$post->ID);
		$thumbnail_display = rwmb_meta('vbegy_thumbnail_display','select',$post->ID);
		$thumbnail_single_category = rwmb_meta('vbegy_thumbnail_single_category','select',$post->ID);
		$thumbnail_categories = rwmb_meta('vbegy_thumbnail_categories','type=checkbox_list',$post->ID);
		$thumbnail_posts = get_post_meta($post->ID,'vbegy_thumbnail_posts');
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
	
	if ($head_top_work == "all_pages" && $head_slide == "footer") {
		include(locate_template("includes/head_slide.php"));
	}
	
	if (((is_front_page() || is_home()) || ((is_single() || is_page()) && isset($custom_slide_show_style) && $custom_slide_show_style == 1)) && $head_top_work == "home_page" && $head_slide == "footer") {
		include(locate_template("includes/head_slide.php"));
	}
	
	$footer_top = vpanel_options("footer_top");
	if ($footer_top == "on") {
		$subscribe_f = vpanel_options("subscribe_f");
		$footer_layout_1 = vpanel_options("footer_layout_1");
		$footer_layout_2 = vpanel_options("footer_layout_2");?>
		<footer id="footer-top">
			<div class="container">
				<div class="row">
					<?php if ($subscribe_f == "on") {
						$feedburner_h3 = vpanel_options("feedburner_h3");
						$feedburner_p = vpanel_options("feedburner_p");
						$feedburner_id = vpanel_options("feedburner_id");
						?>
						<div class="col-md-12">
							<div class="footer-subscribe">
								<div class="row">
									<form action="http://feedburner.google.com/fb/a/mailverify" method="post" target="popupwindow" onsubmit="window.open('http://feedburner.google.com/fb/a/mailverify?uri=<?php echo esc_attr($feedburner_id); ?>', 'popupwindow', 'scrollbars=yes,width=550,height=520');return true">
										<div class="col-md-8">
											<?php if ($feedburner_h3 != "") {?>
												<h3><?php echo esc_attr($feedburner_h3)?></h3>
											<?php }
											if ($feedburner_p != "") {?>
												<p><?php echo esc_attr($feedburner_p)?></p>
											<?php }?>
										</div>
										<div class="col-md-4">
										    <input name="email" type="text" value="<?php _e("Email","vbegy");?>" onfocus="if(this.value=='<?php _e("Email","vbegy");?>')this.value='';" onblur="if(this.value=='')this.value='<?php _e("Email","vbegy");?>';">
											<input type="hidden" value="<?php echo esc_attr($feedburner_id); ?>" name="uri">
											<input type="hidden" name="loc" value="en_US">	
											<input name="submit" type="submit" id="submit" class="button-default color small sidebar_submit" value="<?php _e('Subscribe','vbegy')?>">
										</div>
									</form>
								</div>
							</div>
						</div>
					<?php }
					if ($footer_layout_1 != "footer_no") {
						if ($footer_layout_1 == "footer_1c") {?>
							<div class="col-md-12">
								<?php dynamic_sidebar('footer_1c_sidebar_1');?>
							</div>
						<?php }else if ($footer_layout_1 == "footer_2c") {?>
							<div class="col-md-6">
								<?php dynamic_sidebar('footer_1c_sidebar_1');?>
							</div>
							<div class="col-md-6">
								<?php dynamic_sidebar('footer_2c_sidebar_1');?>
							</div>
						<?php }else if ($footer_layout_1 == "footer_3c") {?>
							<div class="col-md-4">
								<?php dynamic_sidebar('footer_1c_sidebar_1');?>
							</div>
							<div class="col-md-4">
								<?php dynamic_sidebar('footer_2c_sidebar_1');?>
							</div>
							<div class="col-md-4">
								<?php dynamic_sidebar('footer_3c_sidebar_1');?>
							</div>
						<?php }else if ($footer_layout_1 == "footer_4c") {?>
							<div class="col-md-3">
								<?php dynamic_sidebar('footer_1c_sidebar_1');?>
							</div>
							<div class="col-md-3">
								<?php dynamic_sidebar('footer_2c_sidebar_1');?>
							</div>
							<div class="col-md-3">
								<?php dynamic_sidebar('footer_3c_sidebar_1');?>
							</div>
							<div class="col-md-3">
								<?php dynamic_sidebar('footer_4c_sidebar_1');?>
							</div>
						<?php }
					}?>
					<div class="clearfix"></div>
					<?php if ($footer_layout_2 != "footer_no") {
						if ($footer_layout_2 == "footer_1c") {?>
							<div class="col-md-12">
								<?php dynamic_sidebar('footer_1c_sidebar_2');?>
							</div>
						<?php }else if ($footer_layout_2 == "footer_2c") {?>
							<div class="col-md-6">
								<?php dynamic_sidebar('footer_1c_sidebar_2');?>
							</div>
							<div class="col-md-6">
								<?php dynamic_sidebar('footer_2c_sidebar_2');?>
							</div>
						<?php }else if ($footer_layout_2 == "footer_3c") {?>
							<div class="col-md-4">
								<?php dynamic_sidebar('footer_1c_sidebar_2');?>
							</div>
							<div class="col-md-4">
								<?php dynamic_sidebar('footer_2c_sidebar_2');?>
							</div>
							<div class="col-md-4">
								<?php dynamic_sidebar('footer_3c_sidebar_2');?>
							</div>
						<?php }else if ($footer_layout_2 == "footer_4c") {?>
							<div class="col-md-3">
								<?php dynamic_sidebar('footer_1c_sidebar_2');?>
							</div>
							<div class="col-md-3">
								<?php dynamic_sidebar('footer_2c_sidebar_2');?>
							</div>
							<div class="col-md-3">
								<?php dynamic_sidebar('footer_3c_sidebar_2');?>
							</div>
							<div class="col-md-3">
								<?php dynamic_sidebar('footer_4c_sidebar_2');?>
							</div>
						<?php }
					}?>
				</div><!-- End row -->
			</div><!-- End container -->
		</footer>
	<?php }?>
	
	<footer id="footer"<?php echo ($footer_top == "on"?"class='footer-no-top'":"")?>>
		<div class="container">
			<div class="copyrights"><?php echo vpanel_options("footer_copyrights").' | Logger中文版由<a rel="nofollow" target="_blank" href="http://themostspecialname.com">NAME</a> <a rel="nofollow" target="_blank" href="http://www.wordpressleaf.com">LEAF</a>联合出品'?></div>
			<div class="social-ul">
				<ul>
					<?php
					$social_icon_f = vpanel_options("social_icon_f");
					if ($social_icon_f == "on") {
						$facebook_icon_f = vpanel_options("facebook_icon_f");
						$twitter_icon_f = vpanel_options("twitter_icon_f");
						$gplus_icon_f = vpanel_options("gplus_icon_f");
						$linkedin_icon_f = vpanel_options("linkedin_icon_f");
						$dribbble_icon_f = vpanel_options("dribbble_icon_f");
						$youtube_icon_f = vpanel_options("youtube_icon_f");
						$skype_icon_f = vpanel_options("skype_icon_f");
						$vimeo_icon_f = vpanel_options("vimeo_icon_f");
						$flickr_icon_f = vpanel_options("flickr_icon_f");
						$soundcloud_icon_f = vpanel_options("soundcloud_icon_f");
						$instagram_icon_f = vpanel_options("instagram_icon_f");
						$pinterest_icon_f = vpanel_options("pinterest_icon_f");
						$rss_icon_f = vpanel_options("rss_icon_f");
						$rss_icon_f_other = vpanel_options("rss_icon_f_other");
						if ($facebook_icon_f) {?>
							<li class="social-facebook"><a href="<?php echo esc_url($facebook_icon_f)?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
						<?php }
						if ($twitter_icon_f) {?>
							<li class="social-twitter"><a href="<?php echo esc_url($twitter_icon_f)?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
						<?php }
						if ($gplus_icon_f) {?>
							<li class="social-google"><a href="<?php echo esc_url($gplus_icon_f)?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
						<?php }
						if ($linkedin_icon_f) {?>
							<li class="social-linkedin"><a href="<?php echo esc_url($linkedin_icon_f)?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
						<?php }
						if ($dribbble_icon_f) {?>
							<li class="social-dribbble"><a href="<?php echo esc_url($dribbble_icon_f)?>" target="_blank"><i class="fa fa-dribbble"></i></a></li>
						<?php }
						if ($youtube_icon_f) {?>
							<li class="social-youtube"><a href="<?php echo esc_url($youtube_icon_f)?>" target="_blank"><i class="fa fa-youtube-play"></i></a></li>
						<?php }
						if ($vimeo_icon_f) {?>
							<li class="social-vimeo"><a href="<?php echo esc_url($vimeo_icon_f)?>" target="_blank"><i class="fa fa-vimeo-square"></i></a></li>
						<?php }
						if ($skype_icon_f) {?>
							<li class="social-skype"><a href="<?php echo esc_url($skype_icon_f)?>" target="_blank"><i class="fa fa-skype"></i></a></li>
						<?php }
						if ($flickr_icon_f) {?>
							<li class="social-flickr"><a href="<?php echo esc_url($flickr_icon_f)?>" target="_blank"><i class="fa fa-flickr"></i></a></li>
						<?php }
						if ($soundcloud_icon_f) {?>
							<li class="social-soundcloud"><a href="<?php echo esc_url($soundcloud_icon_f)?>" target="_blank"><i class="fa fa-soundcloud"></i></a></li>
						<?php }
						if ($instagram_icon_f) {?>
							<li class="social-instagram"><a href="<?php echo esc_url($instagram_icon_f)?>" target="_blank"><i class="fa fa-instagram"></i></a></li>
						<?php }
						if ($pinterest_icon_f) {?>
							<li class="social-pinterest"><a href="<?php echo esc_url($pinterest_icon_f)?>" target="_blank"><i class="fa fa-pinterest"></i></a></li>
						<?php }
						if ($rss_icon_f == "on") {?>
							<li class="social-rss"><a href="<?php echo ($rss_icon_f_other != ""?esc_url($rss_icon_f_other):esc_url(bloginfo('rss2_url')));?>" target="_blank"><i class="fa fa-rss"></i></a></li>
						<?php }
					}?>
				</ul>
			</div><!-- End social-ul -->
		</div><!-- End container -->
	</footer><!-- End footer -->
	
</div><!-- End wrap -->

<div class="go-up"><i class="fa fa-chevron-up"></i></div>

<?php wp_footer(); ?>
</body>
</html>