<?php get_header();
	$date_format = (vpanel_options("date_format")?vpanel_options("date_format"):get_option("date_format"));
	$can_edit_post = vpanel_options("can_edit_post");
	$post_delete = vpanel_options("post_delete");
	$vbegy_what_post = rwmb_meta('vbegy_what_post','select',$post->ID);
	$vbegy_image_style = rwmb_meta('vbegy_image_style','select',$post->ID);
	$vbegy_sidebar = rwmb_meta('vbegy_sidebar','select',$post->ID);
	if ($vbegy_sidebar == "default") {
		$sidebar_layout = vpanel_options('sidebar_layout');
		if ($sidebar_layout == 'centered') {
			$vbegy_sidebar = 'page-centered';
		}elseif ($sidebar_layout == 'left') {
			$vbegy_sidebar = 'page-left-sidebar';
		}elseif ($sidebar_layout == 'full') {
			$vbegy_sidebar = 'full';
		}else {
			$vbegy_sidebar = 'page-right-sidebar';
		}
	}
	if ( have_posts() ) : while ( have_posts() ) : the_post();
		$user_login_id_l = get_user_by("id",$post->post_author);
		$user_get_current_user_id = get_current_user_id();
		$post_head_background = rwmb_meta('vbegy_post_head_background',"color",$post->ID);
		$post_head_background_img = rwmb_meta('vbegy_post_head_background_img',"upload",$post->ID);
		$post_head_background_repeat = rwmb_meta('vbegy_post_head_background_repeat',"select",$post->ID);
		$post_head_background_fixed = rwmb_meta('vbegy_post_head_background_fixed',"select",$post->ID);
		$post_head_background_position_x = rwmb_meta('vbegy_post_head_background_position_x',"select",$post->ID);
		$post_head_background_position_y = rwmb_meta('vbegy_post_head_background_position_y',"select",$post->ID);
		$post_head_background_full = rwmb_meta('vbegy_post_head_background_full',"checkbox",$post->ID);
		$vbegy_quote_color = rwmb_meta('vbegy_quote_color',"color",$post->ID);
		$vbegy_link_color = rwmb_meta('vbegy_link_color',"color",$post->ID);
		$post_head_style = "";
		if ((isset($post_head_background) && $post_head_background != "") || (isset($post_head_background_img) && $post_head_background_img != "") || (isset($vbegy_link_color) && $vbegy_link_color != "") || (isset($vbegy_quote_color) && $vbegy_quote_color != "")) {
			$post_head_style .= "style='";
			$post_head_style .= (isset($vbegy_link_color) && $vbegy_link_color != ""?"color:".$vbegy_link_color.";":"");
			$post_head_style .= (isset($vbegy_quote_color) && $vbegy_quote_color != ""?"color:".$vbegy_quote_color.";":"");
			$post_head_style .= (isset($post_head_background) && $post_head_background != ""?"background-color:".$post_head_background.";":"");
			if (isset($post_head_background_img) && $post_head_background_img != "") {
				$post_head_style .= (isset($post_head_background_img) && $post_head_background_img != ""?"background-image:url(".$post_head_background_img.");":"");
				$post_head_style .= (isset($post_head_background_repeat) && $post_head_background_repeat != ""?"background-repeat:".$post_head_background_repeat.";":"");
				$post_head_style .= (isset($post_head_background_fixed) && $post_head_background_fixed != ""?"background-attachment:".$post_head_background_fixed.";":"");
				$post_head_style .= (isset($post_head_background_position_x) && $post_head_background_position_x != ""?"background-position-x:".$post_head_background_position_x.";":"");
				$post_head_style .= (isset($post_head_background_position_y) && $post_head_background_position_y != ""?"background-position-y:".$post_head_background_position_y.";":"");
				$post_head_style .= (isset($post_head_background_full) && $post_head_background_full == 1?"-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;":"");
			}
			$post_head_style .= "'";
		}
		$vbegy_page_style = rwmb_meta('vbegy_page_style','select',$post->ID);
		$vbegy_what_post = rwmb_meta('vbegy_what_post','select',$post->ID);
		$vbegy_google = rwmb_meta('vbegy_google',"textarea",$post->ID);
		$vbegy_quote_author = rwmb_meta('vbegy_quote_author',"text",$post->ID);
		$vbegy_quote_icon_color = rwmb_meta('vbegy_quote_icon_color',"color",$post->ID);
		$quote_icon_color = (isset($vbegy_quote_icon_color) && $vbegy_quote_icon_color != ""?"style='color:".$vbegy_quote_icon_color.";'":(isset($post_head_background) && $post_head_background != "" && empty($post_head_background_img)?"style='color:#FFF;'":""));
		$vbegy_link_target = rwmb_meta('vbegy_link_target',"select",$post->ID);
		$vbegy_link = rwmb_meta('vbegy_link',"text",$post->ID);
		$vbegy_link_title = rwmb_meta('vbegy_link_title',"text",$post->ID);
		$vbegy_link_icon_color = rwmb_meta('vbegy_link_icon_color',"color",$post->ID);
		$link_icon_color = (isset($vbegy_link_icon_color) && $vbegy_link_icon_color != ""?"style='color:".$vbegy_link_icon_color.";'":(isset($post_head_background) && $post_head_background != "" && empty($post_head_background_img)?"style='color:#FFF;'":""));
		$vbegy_link_icon_hover_color = rwmb_meta('vbegy_link_icon_hover_color',"color",$post->ID);
		$vbegy_link_hover_color = rwmb_meta('vbegy_link_hover_color',"color",$post->ID);
		$vbegy_slideshow_type = rwmb_meta('vbegy_slideshow_type','select',$post->ID);
		$video_id = rwmb_meta('vbegy_video_post_id',"text",$post->ID);
		$video_type = rwmb_meta('vbegy_video_post_type',"select",$post->ID);
		if ($video_type == 'youtube') {
			$type = "http://www.youtube.com/embed/".$video_id;
		}else if ($video_type == 'vimeo') {
			$type = "http://player.vimeo.com/video/".$video_id;
		}else if ($video_type == 'daily' || $video_type == 'embed') {
			$type = "http://www.dailymotion.com/swf/video/".$video_id;
		}else if ($video_type == "embed") {
			$post_type = " video_e_post";
		}
		$review_display = rwmb_meta('vbegy_review_display','checkbox',$post->ID);
		$review_position = rwmb_meta('vbegy_review_position','select',$post->ID);
		$meta_post_position = rwmb_meta('vbegy_meta_post_position','select',$post->ID);
		
		if (is_sticky()) {
			$post_type = " sticky_post";
		}else if ($vbegy_what_post == "google") {
			$post_type = " google_post";
		}else if ($vbegy_what_post == "image_lightbox") {
			$post_type = " post-lightbox";
		}else if ($vbegy_what_post == "audio") {
			$post_type = " post-audio";
		}else if ($vbegy_what_post == "video") {
			if ($video_type == 'youtube') {
		    	$post_type = " video_y_post";
			}else if ($video_type == 'vimeo') {
		    	$post_type = " video_v_post";
			}else if ($video_type == 'daily' || $video_type == 'embed') {
		    	$post_type = " video_d_post";
			}else if ($video_type == "embed") {
				$post_type = " video_e_post";
			}
		}else if ($vbegy_what_post == "slideshow") {
			$post_type = " post-gallery";
		}else if ($vbegy_what_post == "quote") {
			$post_type = " post-quote";
		}else if ($vbegy_what_post == "link") {
			$post_type = " post-link";
		}else if ($vbegy_what_post == "soundcloud") {
			$post_type = " post-soundcloud";
		}else if ($vbegy_what_post == "twitter") {
			$post_type = " post-twitter";
		}else if ($vbegy_what_post == "facebook") {
			$post_type = " post-facebook";
		}else {
			if (has_post_thumbnail()) {
		    	$post_type = " image_post";
			}else {
		    	$post_type = " no_image_post";
			}
		}
		if ($post->post_content == "") {
			$post_type = " post-no-content".$post_type;
		}else {
			$post_type = " post--content".$post_type;
		}
		
		$post_style = vpanel_options("post_style");
		if ($post_style == "style_7") {
			$post_type = " post-style-7".$post_type;
		}
		
		if ($vbegy_page_style == "style_2") {
			$post_type = " page-style-2".$post_type;
		}
		
		if ($vbegy_image_style == "style_1" || $vbegy_image_style == "style_2") {
			$post_type = " post-full-image".$post_type;
			if ($meta_post_position == "top_image") {
				$post_type = " post-full-image-top".$post_type;
			}
		}
		
		$custom_page_setting = rwmb_meta('vbegy_custom_page_setting','checkbox',$post->ID);
		$post_meta_s = rwmb_meta('vbegy_post_meta_s','checkbox',$post->ID);
		$post_review_s = rwmb_meta('vbegy_post_review_s','checkbox',$post->ID);
		$post_type_s = rwmb_meta('vbegy_post_type_s','checkbox',$post->ID);
		$post_author_s = rwmb_meta('vbegy_post_author_s','checkbox',$post->ID);
		$post_share_s = rwmb_meta('vbegy_post_share_s','checkbox',$post->ID);
		$post_views_s = rwmb_meta('vbegy_post_views_s','checkbox',$post->ID);
		$post_author_box_s = rwmb_meta('vbegy_post_author_box_s','checkbox',$post->ID);
		$related_post_s = rwmb_meta('vbegy_related_post_s','checkbox',$post->ID);
		$related_number_s = rwmb_meta('vbegy_related_number_s','text',$post->ID);
		$excerpt_related_title_s = rwmb_meta('vbegy_excerpt_related_title_s','text',$post->ID);
		$post_comments_s = rwmb_meta('vbegy_post_comments_s','checkbox',$post->ID);
		$post_navigation_s = rwmb_meta('vbegy_post_navigation_s','checkbox',$post->ID);
		
		$post_username = get_post_meta($post->ID, 'post_username',true);
		$post_email = get_post_meta($post->ID, 'post_email',true);
		
		$post_type_option = vpanel_options("post_type");
		$post_author = vpanel_options("post_author");
		if ((($post_type_option == "on" && $post_author_s == "") || ($post_type_option == "on" && isset($custom_page_setting) && $custom_page_setting == 0) || ($post_type_option == "on" && isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_author_s) && $post_author_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_author_s) && $post_author_s == 1)) && (($post_author == "on" && $post_type_s == "") || ($post_author == "on" && isset($custom_page_setting) && $custom_page_setting == 0) || ($post_author == "on" && isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_type_s) && $post_type_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_type_s) && $post_type_s == 1))) {
			$post_type = " post-style-2".$post_type;
		}?>
		<article <?php post_class('post clearfix '.$post_type);?> role="article" itemscope="" itemtype="http://schema.org/Article">
			<?php
			if ($vbegy_page_style != "style_2") {
				if (($post_type_option == "on" && $post_author_s == "") || ($post_type_option == "on" && isset($custom_page_setting) && $custom_page_setting == 0) || ($post_type_option == "on" && isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_author_s) && $post_author_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_author_s) && $post_author_s == 1)) {?>
					<div class="post-type"><i class="fa fa-<?php if (is_sticky()) {?>thumb-tack<?php }else if ($vbegy_what_post == "google") {?>map-marker<?php }else if ($vbegy_what_post == "audio") {?>volume-up<?php }else if ($vbegy_what_post == "video") {if ($video_type == 'youtube') {?>youtube-play<?php }else if ($video_type == 'vimeo') {?>vimeo-square<?php }else if ($video_type == 'daily' || $video_type == 'embed') {?>video-camera<?php }?><?php }else if ($vbegy_what_post == "slideshow") {?>film<?php }else if ($vbegy_what_post == "quote") {?>quote-left<?php }else if ($vbegy_what_post == "link") {?>link<?php }else if ($vbegy_what_post == "soundcloud") {?>soundcloud<?php }else if ($vbegy_what_post == "twitter") {?>twitter<?php }else if ($vbegy_what_post == "facebook") {?>facebook<?php }else {if (has_post_thumbnail()) {?>image<?php }else {?>file-text<?php }}?>"></i></div>
				<?php }
				if (($post_author == "on" && $post_type_s == "") || ($post_author == "on" && isset($custom_page_setting) && $custom_page_setting == 0) || ($post_author == "on" && isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_type_s) && $post_type_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_type_s) && $post_type_s == 1)) {
					$user_info = get_userdata($post->post_author);?>
					<div class="post-author">
						<?php if (get_the_author_meta('you_avatar', $post->post_author)) {
							$you_avatar_img = get_aq_resize_url(esc_attr(get_the_author_meta('you_avatar', $post->post_author)),"full",70,70);
							echo "<img alt='".$user_info->display_name."' src='".$you_avatar_img."'>";
						}else {
							if ($post->post_author != 0) {
								echo get_avatar($user_info->user_email,'70','');
							}else {
								echo get_avatar($post_email,'70','');
							}
						}?>
					</div>
				<?php }
			}
			
			if ($vbegy_page_style != "style_2") {
				if ($meta_post_position != "top_image" || ($vbegy_image_style != "style_1" && $vbegy_image_style != "style_2")) {?>
					<div class="post-head"><h1>
					<?php
					if ($post->post_author != 0 && $user_login_id_l->ID == $user_get_current_user_id) {
						if ($can_edit_post == "on") {?>
							<span class="post-edit">
								<a href="<?php echo add_query_arg("edit_post", $post->ID,get_page_link(vpanel_options('edit_post')))?>" title="<?php _e("Edit the post","vbegy")?>"><i class="fa fa-edit"></i></a>
							</span>
						<?php }
						if ($post_delete == "on") {
							if (isset($_GET) && isset($_GET["delete"]) && $_GET["delete"] == $post->ID) {
								wp_delete_post($post->ID);
								$redirect_to = strip_tags( 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
								if ( is_ssl() && force_ssl_login() && !force_ssl_admin() && ( 0 !== strpos($redirect_to, 'https') ) && ( 0 === strpos($redirect_to, 'http') ) )$secure_cookie = false; else $secure_cookie = '';
								wp_redirect((is_page()?$redirect_to:home_url()));
							}?>
							<span class="post-delete">
								<a href="<?php echo add_query_arg("delete", $post->ID,get_permalink($post->ID))?>" title="<?php _e("Delete the post","vbegy")?>"><i class="fa fa-trash"></i></a>
							</span>
						<?php }
					}
					the_title();?></h1>
						<?php $posts_meta = vpanel_options("post_meta");
						if (($posts_meta == "on" && $post_meta_s == "") || ($posts_meta == "on" && isset($custom_page_setting) && $custom_page_setting == 0) || ($posts_meta == "on" && isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_meta_s) && $post_meta_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_meta_s) && $post_meta_s == 1)) {
							$author_by = vpanel_options("author_by");
							$category_post = vpanel_options("category_post");?>
				    		<div class="post-meta">
				    			<?php if ($author_by == 'on') {?>
				    				<div><i class="fa fa-user"></i><?php _e("by","vbegy")?> : <?php echo ($post->post_author > 0?the_author_posts_link():$post_username);?></div>
				    			<?php }?>
				    			<div><i class="fa fa-clock-o"></i><?php the_time($date_format);?></div>
				    			<div><i class="fa fa-comments"></i><?php comments_popup_link(__('0 Comments', 'vbegy'), __('1 Comment', 'vbegy'), '% '.__('Comments', 'vbegy'));?></div>
				    			<?php if ($category_post == 'on') {?>
				    				<div><i class="fa fa-folder-open"></i><?php _e("in","vbegy")?> : <?php the_category(' , ');?></div>
				    			<?php }
				    			$post_like = get_post_meta($post->ID,"post_like",true);
				    			$like_yes = "";
				    			if (isset($_COOKIE['logger_post_like'.$post->ID]) && $_COOKIE['logger_post_like'.$post->ID] == "logger_like_yes") {
				    				$like_yes = "logger_like_yes";
				    			}
				    			?>
				    			<div><a class="post-like <?php echo ($like_yes == "logger_like_yes"?"post-like-done":"")?>" title="<?php echo ($like_yes == "logger_like_yes"?__("You already like this","vbegy"):__("Love","vbegy"))?>" id="post-like-<?php the_ID();?>"><i class="fa <?php echo ($like_yes == "logger_like_yes"?"fa-heart":"fa-heart-o")?>"></i><span><?php echo (isset($post_like) && $post_like != ""?$post_like:0)?></span></a></div>
				    		</div><!-- End post-meta -->
						<?php }?>
						<div class="clearfix"></div>
					</div><!-- End post-head -->
				<?php }
			}?>
			<div class="post-wrap">
				<?php if ($vbegy_what_post != "link" && $vbegy_what_post != "quote") {?>
		    		<div <?php echo ($post_head_style)?> class="post-img<?php if ((!isset($vbegy_what_post) || $vbegy_what_post == "none" || $vbegy_what_post == "image" || $vbegy_what_post == "soundcloud" || $vbegy_what_post == "twitter" || $vbegy_what_post == "facebook" || $vbegy_what_post == "audio") && !has_post_thumbnail()) {echo " post-img-0";}else if ($vbegy_what_post == "video" || $vbegy_what_post == "soundcloud" || $vbegy_what_post == "twitter" || $vbegy_what_post == "facebook") {echo " post-iframe";}if ($vbegy_sidebar == "full") {echo " post-img-12";}else {echo " post-img-8";}?>">
		    			<?php if ((has_post_thumbnail() && $vbegy_what_post != "image_lightbox") && $vbegy_what_post != "audio" && $vbegy_what_post != "facebook") {?><a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php }
		    				$vbegy_facebook_embed = rwmb_meta('vbegy_facebook_embed',"textarea",$post->ID);
		    				if ($vbegy_what_post == "facebook") {
		    					echo rwmb_meta('vbegy_facebook_embed',"textarea",$post->ID);
		    				}else {
		    					get_template_part('includes/head');
		    				}
		    			if ((has_post_thumbnail() && $vbegy_what_post != "image_lightbox") && $vbegy_what_post != "audio" && $vbegy_what_post != "facebook") {?></a><?php }?>
		    		</div>
		    		<div class="post-inner">
		    		<?php if ($vbegy_page_style == "style_2") {
		    			if ($meta_post_position != "top_image" || ($vbegy_image_style != "style_1" && $vbegy_image_style != "style_2")) {
			    			$vbegy_post_icon = rwmb_meta('vbegy_post_icon',"text",$post->ID);?>
			    			<div class="post-title"><i class="fa <?php if (isset($vbegy_post_icon) && $vbegy_post_icon != "") {echo esc_attr($vbegy_post_icon);}else {echo "fa-file-text";}?>"></i>
			    			<?php
			    			if ($post->post_author != 0 && $user_login_id_l->ID == $user_get_current_user_id) {
			    				if ($can_edit_post == "on") {?>
			    					<span class="post-edit">
			    						<a href="<?php echo add_query_arg("edit_post", $post->ID,get_page_link(vpanel_options('edit_post')))?>" title="<?php _e("Edit the post","vbegy")?>"><i class="fa fa-edit"></i></a>
			    					</span>
			    				<?php }
			    				if ($post_delete == "on") {
			    					if (isset($_GET) && isset($_GET["delete"]) && $_GET["delete"] == $post->ID) {
			    						wp_delete_post($post->ID);
			    						$redirect_to = strip_tags( 'http://'.$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']);
			    						if ( is_ssl() && force_ssl_login() && !force_ssl_admin() && ( 0 !== strpos($redirect_to, 'https') ) && ( 0 === strpos($redirect_to, 'http') ) )$secure_cookie = false; else $secure_cookie = '';
			    						wp_redirect((is_page()?$redirect_to:home_url()));
			    					}?>
			    					<span class="post-delete">
			    						<a href="<?php echo add_query_arg("delete", $post->ID,get_permalink($post->ID))?>" title="<?php _e("Delete the post","vbegy")?>"><i class="fa fa-trash"></i></a>
			    					</span>
			    				<?php }
			    			}
			    			the_title()?></div>
			    			
			    			<?php $posts_meta = vpanel_options("post_meta");
			    			if (($posts_meta == "on" && $post_meta_s == "") || ($posts_meta == "on" && isset($custom_page_setting) && $custom_page_setting == 0) || ($posts_meta == "on" && isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_meta_s) && $post_meta_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_meta_s) && $post_meta_s == 1)) {
			    				$author_by = vpanel_options("author_by");
			    				$category_post = vpanel_options("category_post");?>
			    				<div class="post-meta">
			    					<?php if ($author_by == 'on') {?>
			    						<div><i class="fa fa-user"></i><?php _e("by","vbegy")?> : <?php echo ($post->post_author > 0?the_author_posts_link():$post_username);?></div>
			    					<?php }?>
			    					<div><i class="fa fa-clock-o"></i><?php the_time($date_format);?></div>
			    				</div><!-- End post-meta -->
			    				<div class="clearfix"></div>
			    			<?php }
			    		}
		    		}
				}
					if ($vbegy_what_post == "quote" || $vbegy_what_post == "link") {
						if ($vbegy_what_post == "quote") {
							if (isset($vbegy_quote_color) && $vbegy_quote_color != "") {?>
								<style type="text/css">
									.post-quote .post-inner p {
										color: <?php echo esc_attr($vbegy_quote_color)?>;
									}
								</style>
							<?php }?>
							<div class="post-inner" <?php echo ($post_head_style)?>>
		    					<div class="post-quote-top"><i <?php echo ($quote_icon_color)?> class="fa fa-quote-left"></i></div>
		    					<div class="post-inner-content"><?php the_content();?></div>
		    					<?php if ($vbegy_quote_author != "") {?>
		    						<span class="author">― <?php echo esc_attr($vbegy_quote_author)?></span>
		    					<?php }?>
		    					<div class="post-quote-bottom"><i <?php echo ($quote_icon_color)?> class="fa fa-quote-right"></i></div>
		    					<div class="clearfix"></div>
							</div><!-- End post-inner -->
						<?php }else if ($vbegy_what_post == "link") {
							if ((isset($vbegy_link_icon_hover_color) && $vbegy_link_icon_hover_color != "") || (isset($vbegy_link_hover_color) && $vbegy_link_hover_color != "")) {?>
								<style type="text/css">
									<?php if (isset($vbegy_link_icon_hover_color) && $vbegy_link_icon_hover_color != "") {?>
										.post-link .post-inner.link:hover .fa-link {
											color: <?php echo esc_attr($vbegy_link_icon_hover_color)?> !important;
										}
									<?php }
									if (isset($vbegy_link_hover_color) && $vbegy_link_hover_color != "") {?>
										.post-link .post-inner.link:hover {
											color: <?php echo esc_attr($vbegy_link_hover_color)?> !important;
										}
									<?php }?>
								</style>
							<?php }?>
							<a <?php echo ($post_head_style)?> href="<?php echo esc_url($vbegy_link)?>" <?php echo ($vbegy_link_target == "style_2"?"target='_blank'":"")?> class="post-inner link">
								<i <?php echo ($link_icon_color)?> class="fa fa-link"></i>
								<div>
									<?php echo esc_attr($vbegy_link_title)?>
									<span><?php echo esc_url($vbegy_link)?></span>
								</div>
							</a><!-- End post-inner -->
						<?php }
					}else {
						if ($vbegy_what_post != "link" && $vbegy_what_post != "quote") {
							$post_review = vpanel_options("post_review");
							if ($review_position == "top_f" && (($post_review == "on" && $post_review_s == "") || ($post_review == "on" && isset($custom_page_setting) && $custom_page_setting == 0) || ($post_review == "on" && isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_review_s) && $post_review_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_review_s) && $post_review_s == 1))) {
								if (isset($review_display) && $review_display == 1) {
									vbegy_review();
								}
							}?>
					    	<div class="post-inner-content">
					    		<?php if ($review_position == "top" && (($post_review == "on" && $post_review_s == "") || ($post_review == "on" && isset($custom_page_setting) && $custom_page_setting == 0) || ($post_review == "on" && isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_review_s) && $post_review_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_review_s) && $post_review_s == 1))) {
					    			if (isset($review_display) && $review_display == 1) {
					    				vbegy_review();
					    			}
					    		}
					    		the_content();?>
					    	</div>
					    	<?php if ($review_position == "bottom" && (($post_review == "on" && $post_review_s == "") || ($post_review == "on" && isset($custom_page_setting) && $custom_page_setting == 0) || ($post_review == "on" && isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_review_s) && $post_review_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_review_s) && $post_review_s == 1))) {
					    		if (isset($review_display) && $review_display == 1) {
						    		vbegy_review();
						    	}
					    	}
							wp_link_pages(array('before' => '<div class="pagination post-pagination">','after' => '</div>','link_before' => '<span>','link_after' => '</span>'));
						}
					}
				if ($vbegy_what_post != "link" && $vbegy_what_post != "quote") {?>
		    			<div class="clearfix"></div>
		    			<?php $post_views = vpanel_options("post_views");
		    			$post_share = vpanel_options("post_share");
		    			if ((($post_views == "on" && $post_views_s == "") || ($post_views == "on" && isset($custom_page_setting) && $custom_page_setting == 0) || ($post_views == "on" && isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_views_s) && $post_views_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_views_s) && $post_views_s == 1)) || (($post_share == "on" && $post_share_s == "") || ($post_share == "on" && isset($custom_page_setting) && $custom_page_setting == 0) || ($post_share == "on" && isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_share_s) && $post_share_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_share_s) && $post_share_s == 1)) || has_tag()) {?>
		    				<div class="post-share-view">
		    					<div class="post-meta">
		    						<?php if (($post_views == "on" && $post_views_s == "") || ($post_views == "on" && isset($custom_page_setting) && $custom_page_setting == 0) || ($post_views == "on" && isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_views_s) && $post_views_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_views_s) && $post_views_s == 1)) {
		    							$post_stats = get_post_meta($post->ID, 'post_stats', true)?>
		    							<div><i class="fa fa-eye"></i><span><?php echo (isset($post_stats) && $post_stats != ""?(int)$post_stats:0)?> </span><?php _e("Views","vbegy")?></div>
		    						<?php }
		    						if (($post_share == "on" && $post_share_s == "") || ($post_share == "on" && isset($custom_page_setting) && $custom_page_setting == 0) || ($post_share == "on" && isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_share_s) && $post_share_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_share_s) && $post_share_s == 1)) {?>
			    					<div class="post-meta-share">
			    						<i class="fa fa-share-alt"></i>
			    						<a href="#"><?php _e("Share This","vbegy")?></a>
			    						<div class="share-social">
			    							<ul>
			    								<li class="social-facebook"><a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode(get_permalink());?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
			    								<li class="social-twitter"><a href="http://twitter.com/home?status=<?php echo urlencode(get_permalink());?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
			    								<li class="social-google"><a href="http://plus.google.com/share?url=<?php echo urlencode(get_permalink());?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
			    							</ul>
			    							<i class="fa fa-caret-down"></i>
			    						</div><!-- End follow-social -->
			    					</div><!-- End post-meta-share -->
			    					<?php }
			    					if (has_tag()) {?>
			    						<div class="post-tags">
			    							<i class="fa fa-tags"></i>
			    							<?php the_tags('',' , ','');?>
			    						</div>
			    					<?php }?>
			    				</div><!-- End post-meta -->
			    			</div><!-- End post-share-view -->
			    		<?php }?>
		    			<div class="clearfix"></div>
		    		</div><!-- End post-inner -->
				<?php }?>
			</div><!-- End post-wrap -->
		</article><!-- End post -->
	<?php endwhile; endif;
	
	$vbegy_custom_sections = get_post_meta($post->ID,"vbegy_custom_sections",true);
	if (isset($vbegy_custom_sections) && $vbegy_custom_sections == 1) {
		$order_sections_li = get_post_meta($post->ID,"order_sections_li");
		if (empty($order_sections_li)) {
			$order_sections_li = array(0 => array(1 => "next_previous",2 => "advertising",3 => "author",4 => "related",5 => "comments"));
		}
		$order_sections = $order_sections_li[0];
	}else {
		$order_sections_li = vpanel_options("order_sections_li");
		if (empty($order_sections_li)) {
			$order_sections_li = array(1 => "next_previous",2 => "advertising",3 => "author",4 => "related",5 => "comments");
		}
		$order_sections = $order_sections_li;
	}
	foreach ($order_sections as $key_r => $value_r) {
		if ($value_r == "") {
			unset($order_sections[$key_r]);
		}else {
			if ($value_r == "next_previous") {
				$post_navigation = vpanel_options("post_navigation");
				if (($post_navigation == "on" && $post_navigation_s == "") || ($post_navigation == "on" && isset($custom_page_setting) && $custom_page_setting == 0) || ($post_navigation == "on" && isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_navigation_s) && $post_navigation_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_navigation_s) && $post_navigation_s == 1)) {?>
					<div class="page-navigation page-navigation-single clearfix row">
						<div class="col-md-6">
							<div class="nav-next"><?php previous_post('%','<span>'.__('Previous article','vbegy').'</span><br>');?></div>
						</div>
						<div class="col-md-6">
							<div class="nav-previous"><?php next_post('%','<span>'.__('Next article','vbegy').'</span><br>')?></div>
						</div>
					</div><!-- End page-navigation -->
				<?php }
			}else if ($value_r == "advertising") {
				$vbegy_share_adv_type = rwmb_meta('vbegy_share_adv_type','radio',$post->ID);
				$vbegy_share_adv_code = rwmb_meta('vbegy_share_adv_code','textarea',$post->ID);
				$vbegy_share_adv_href = rwmb_meta('vbegy_share_adv_href','text',$post->ID);
				$vbegy_share_adv_img = rwmb_meta('vbegy_share_adv_img','upload',$post->ID);
				
				if ((is_single() || is_page()) && (($vbegy_share_adv_type == "display_code" && $vbegy_share_adv_code != "") || ($vbegy_share_adv_type == "custom_image" && $vbegy_share_adv_img != ""))) {
					$share_adv_type = $vbegy_share_adv_type;
					$share_adv_code = $vbegy_share_adv_code;
					$share_adv_href = $vbegy_share_adv_href;
					$share_adv_img = $vbegy_share_adv_img;
				}else {
					$share_adv_type = vpanel_options("share_adv_type");
					$share_adv_code = vpanel_options("share_adv_code");
					$share_adv_href = vpanel_options("share_adv_href");
					$share_adv_img = vpanel_options("share_adv_img");
				}
				if (($share_adv_type == "display_code" && $share_adv_code != "") || ($share_adv_type == "custom_image" && $share_adv_img != "")) {
					echo '<div class="clearfix"></div>
					<div class="advertising">';
					if ($share_adv_type == "display_code") {
						echo stripcslashes($share_adv_code);
					}else {
						if ($share_adv_href != "") {
							echo '<a href="'.$share_adv_href.'">';
						}
						echo '<img alt="" src="'.$share_adv_img.'">';
						if ($share_adv_href != "") {
							echo '</a>';
						}
					}
					echo '</div><!-- End advertising -->
					<div class="clearfix"></div>
					<div class="height_20"></div>';
				}
			}else if ($value_r == "author") {
				$post_author_box = vpanel_options("post_author_box");
				if (($post_author_box == "on" && $post_author_box_s == "") || ($post_author_box == "on" && isset($custom_page_setting) && $custom_page_setting == 0) || ($post_author_box == "on" && isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_author_box_s) && $post_author_box_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_author_box_s) && $post_author_box_s == 1)) {
					if ($post->post_author > 0) {?>
						<div class="post post-style-2">
							<div class="post-author">
								<?php 
								if (get_the_author_meta('you_avatar', get_the_author_meta('ID'))) {
									$you_avatar_img = get_aq_resize_url(esc_attr(get_the_author_meta('you_avatar', get_the_author_meta('ID'))),"full",70,70);
									echo "<img alt='".$authordata->display_name."' src='".$you_avatar_img."'>";
								}else {
									echo get_avatar(get_the_author_meta('user_email',$authordata->ID),'70','');
								}?>
							</div>
							<div class="post-wrap">
								<div class="post-inner">
									<div class="post-title"><i class="fa fa-user"></i><?php the_author();?></div>
									<p><?php the_author_meta('description');?></p>
									<?php
									$twitter = get_the_author_meta('twitter',$authordata->ID);
									$facebook = get_the_author_meta('facebook',$authordata->ID);
									$google = get_the_author_meta('google',$authordata->ID);
									$linkedin = get_the_author_meta('linkedin',$authordata->ID);
									$youtube = get_the_author_meta('youtube',$authordata->ID);
									if ($facebook || $twitter || $linkedin || $google || $youtube) { ?>
										<div class="social-ul">
											<ul>
												<?php if ($facebook) {?>
													<li class="social-facebook"><a href="<?php echo esc_url($facebook)?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
												<?php }
												if ($twitter) {?>
													<li class="social-twitter"><a href="<?php echo esc_url($twitter)?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
												<?php }
												if ($google) {?>
													<li class="social-google"><a href="<?php echo esc_url($google)?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
												<?php }
												if ($linkedin) {?>
													<li class="social-linkedin"><a href="<?php echo esc_url($linkedin)?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
												<?php }
												if ($youtube) {?>
													<li class="social-youtube"><a href="<?php echo esc_url($youtube)?>" target="_blank"><i class="fa fa-youtube-play"></i></a></li>
												<?php }?>
											</ul>
										</div><!-- End social-ul -->
									<?php }?>
									<div class="clearfix"></div>
								</div><!-- End post-inner -->
							</div><!-- End post-wrap -->
						</div><!-- End post -->
					<?php }
				}
			}else if ($value_r == "related") {
				$related_post = vpanel_options("related_post");
				if (($related_post == "on" && $related_post_s == "") || ($related_post == "on" && isset($custom_page_setting) && $custom_page_setting == 0) || ($related_post == "on" && isset($custom_page_setting) && $custom_page_setting == 1 && isset($related_post_s) && $related_post_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($related_post_s) && $related_post_s == 1)) {
					
					if (isset($custom_page_setting) && $custom_page_setting == 1) {
						$related_number = $related_number_s;
					}else {
						$sidebar_post = rwmb_meta('vbegy_sidebar','radio',$post->ID);
						if (isset($sidebar_post) && $sidebar_post == "full") {
							$related_number = vpanel_options('related_number_full');
						}else {
							$related_number = vpanel_options('related_number');
						}
					}
					$related_no = $related_number ? $related_number : 4;
					$post_type  = get_post_type();
					
					if (isset($custom_page_setting) && $custom_page_setting == 1) {
						$excerpt_related_title = $excerpt_related_title_s;
					}else {
						$excerpt_related_title = vpanel_options('excerpt_related_title');
					}
					$excerpt_related_title = $excerpt_related_title ? $excerpt_related_title : 5;
					global $post;
					$orig_post = $post;
					$categories = get_the_category($post->ID);
					$category_ids = array();
					foreach ($categories as $individual_category) $category_ids[] = $individual_category->term_id;
					$args = array('post_type' => $post_type,'post__not_in' => array($post->ID),'posts_per_page'=> $related_no , 'category__in'=> $category_ids );
					$related_query = new wp_query( $args );
					if ($related_query->have_posts()) {
						if ($vbegy_sidebar == "full") {
							$related_post_columns = "col-md-4";
							$related_post_class = "related-posts-full";
							$post_width = 340;
							$post_height = 216;
						}else {
							$related_post_columns = "col-md-6";
							$related_post_class = "related-posts-half";
							$post_width = 330;
							$post_height = 210;
						}?>
						<div class="post related-posts-div">
							<div class="post-wrap">
								<div class="post-inner">
									<div class="post-title"><i class="fa fa-share"></i><?php _e("Related Posts","vbegy");?></div>
									<div class="row">
										<div class="related-posts <?php echo esc_attr($related_post_class)?>">
											<ul>
												<?php while ( $related_query->have_posts() ) : $related_query->the_post();
													$vbegy_what_post = rwmb_meta('vbegy_what_post','select',$post->ID);
													$video_id = rwmb_meta('vbegy_video_post_id',"select",$post->ID);
													$video_type = rwmb_meta('vbegy_video_post_type',"text",$post->ID);
													if ($video_type == 'youtube') {
														$type = "http://www.youtube.com/embed/".$video_id;
													}else if ($video_type == 'vimeo') {
														$type = "http://player.vimeo.com/video/".$video_id;
													}else if ($video_type == 'daily' || $video_type == 'embed') {
														$type = "http://www.dailymotion.com/swf/video/".$video_id;
													}else if ($video_type == "embed") {
														$custom_embed = rwmb_meta('vbegy_custom_embed',"text",$post->ID);
													}
													$vbegy_slideshow_type = rwmb_meta('vbegy_slideshow_type','select',$post->ID);
													if (has_post_thumbnail() || $vbegy_what_post == "video") {?>
														<div class="<?php echo esc_attr($related_post_columns)?> related-post-item">
															<div class="related-post-one">
																<div class="related-post-img">
																	<a itemprop="url" href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark">
																		<?php
																		if ($vbegy_what_post == "image" || $vbegy_what_post == "slideshow" || $vbegy_what_post == "video") {
																			if (has_post_thumbnail() && ($vbegy_what_post == "image" || $vbegy_what_post == "video")) {
																				echo get_aq_resize_img('full',$post_width,$post_height,$img_lightbox = "lightbox");
																			}else if (has_post_thumbnail() && $vbegy_what_post == "slideshow") {
																				echo get_aq_resize_img('full',$post_width,$post_height);
																			}
																		}else {
																			if (has_post_thumbnail()) {
																				echo get_aq_resize_img('full',$post_width,$post_height,$img_lightbox = "lightbox");
																			}
																		}
																		?>
																	</a>
																	<div class="related-post-type">
																		<i class="fa fa-<?php if (is_sticky()) {?>thumb-tack<?php }else if ($vbegy_what_post == "google") {?>map-marker<?php }else if ($vbegy_what_post == "video") {if ($video_type == 'youtube') {?>youtube-play<?php }else if ($video_type == 'vimeo') {?>vimeo-square<?php }else if ($video_type == 'daily' || $video_type == 'embed') {?>video-camera<?php }?><?php }else if ($vbegy_what_post == "slideshow") {?>film<?php }else if ($vbegy_what_post == "quote") {?>quote-left<?php }else if ($vbegy_what_post == "link") {?>link<?php }else if ($vbegy_what_post == "soundcloud") {?>soundcloud<?php }else if ($vbegy_what_post == "twitter") {?>twitter<?php }else if ($vbegy_what_post == "facebook") {?>facebook<?php }else {if (has_post_thumbnail()) {?>image<?php }else {?>file-text<?php }}?>"></i>
																	</div>
																</div>
																<div class="related-post-head">
																	<a itemprop="url" href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php excerpt_title($excerpt_related_title)?></a>
																	<span><i class="fa fa-clock-o"></i><?php the_time($date_format);?></span>
																	<span><i class="fa fa-comments"></i><?php comments_popup_link(__('0 Comments', 'vbegy'), __('1 Comment', 'vbegy'), '% '.__('Comments', 'vbegy'));?></span>
																</div>
															</div>
														</div>
													<?php }
												endwhile;?>
											</ul>
										</div><!-- End related-posts -->
									</div><!-- End row -->
									<div class="clearfix"></div>
								</div><!-- End post-inner -->
							</div><!-- End post-wrap -->
						</div><!-- End post -->
					<?php }
					$post = $orig_post;
					wp_reset_query();
				}
			}else if ($value_r == "comments") {
				$post_comments = vpanel_options("post_comments");
				if (($post_comments == "on" && $post_comments_s == "") || ($post_comments == "on" && isset($custom_page_setting) && $custom_page_setting == 0) || ($post_comments == "on" && isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_comments_s) && $post_comments_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_comments_s) && $post_comments_s == 1)) {
					comments_template();
				}
			}
		}
	}
get_footer();?>