jQuery(document).ready( function($) {
	
	/* Logo */
	if (jQuery("#"+vpanel_name+"-logo_display-custom_image:checked").length > 0) {
		jQuery("#logo_img").parent().parent().parent().show(10);
		jQuery("#retina_logo").parent().parent().parent().show(10);
	}else {
		jQuery("#logo_img").parent().parent().parent().hide(10);
		jQuery("#retina_logo").parent().parent().parent().hide(10);
	}
	jQuery("#"+vpanel_name+"-logo_display-custom_image").click(function () {
		jQuery("#logo_img").parent().parent().parent().slideDown(500);
		jQuery("#retina_logo").parent().parent().parent().slideDown(500);
	});
	jQuery("#"+vpanel_name+"-logo_display-display_title").click(function () {
		jQuery("#logo_img").parent().parent().parent().slideUp(500);
		jQuery("#retina_logo").parent().parent().parent().slideUp(500);
	});
	
	/* Home background */
	if (jQuery("#"+vpanel_name+"-background_type-custom_background:checked").length > 0 && jQuery("#"+vpanel_name+"-background_type-patterns:checked").length == 0) {
		jQuery("#section-custom_background").slideDown(500);
		jQuery("#section-full_screen_background").slideDown(500);
		jQuery("#section-background_color").hide(10);
		jQuery("#section-background_pattern").hide(10);
	}else if (jQuery("#"+vpanel_name+"-background_type-patterns:checked").length > 0 && jQuery("#"+vpanel_name+"-background_type-custom_background:checked").length == 0) {
		jQuery("#section-background_color").slideDown(500);
		jQuery("#section-background_pattern").slideDown(500);
		jQuery("#section-custom_background").hide(10);
		jQuery("#section-full_screen_background").hide(10);
	}
	jQuery("#"+vpanel_name+"-background_type-custom_background").click(function () {
		jQuery("#section-custom_background").slideDown(500);
		jQuery("#section-full_screen_background").slideDown(500);
		jQuery("#section-background_pattern").slideUp(500);
		jQuery("#section-background_color").slideUp(500);
	});
	jQuery("#"+vpanel_name+"-background_type-patterns").click(function () {
		jQuery("#section-custom_background").slideUp(500);
		jQuery("#section-full_screen_background").slideUp(500);
		jQuery("#section-background_pattern").slideDown(500);
		jQuery("#section-background_color").slideDown(500);
	});
	
	/* user background */
	if (jQuery("#"+vpanel_name+"-author_background_type-custom_background:checked").length > 0 && jQuery("#"+vpanel_name+"-author_background_type-patterns:checked").length == 0) {
		jQuery("#section-author_custom_background").slideDown(500);
		jQuery("#section-author_full_screen_background").slideDown(500);
		jQuery("#section-author_background_color").hide(10);
		jQuery("#section-author_background_pattern").hide(10);
	}else if (jQuery("#"+vpanel_name+"-author_background_type-patterns:checked").length > 0 && jQuery("#"+vpanel_name+"-author_background_type-custom_background:checked").length == 0) {
		jQuery("#section-author_background_color").slideDown(500);
		jQuery("#section-author_background_pattern").slideDown(500);
		jQuery("#section-author_custom_background").hide(10);
		jQuery("#section-author_full_screen_background").hide(10);
	}
	jQuery("#"+vpanel_name+"-author_background_type-custom_background").click(function () {
		jQuery("#section-author_custom_background").slideDown(500);
		jQuery("#section-author_full_screen_background").slideDown(500);
		jQuery("#section-author_background_pattern").slideUp(500);
		jQuery("#section-author_background_color").slideUp(500);
	});
	jQuery("#"+vpanel_name+"-author_background_type-patterns").click(function () {
		jQuery("#section-author_custom_background").slideUp(500);
		jQuery("#section-author_full_screen_background").slideUp(500);
		jQuery("#section-author_background_pattern").slideDown(500);
		jQuery("#section-author_background_color").slideDown(500);
	});
	
	/* Categories Design */
	if (jQuery(".cat_background_type:checked").length > 0 && jQuery("#"+vpanel_name+"-background_type-patterns:checked").length == 0) {
		jQuery("#section-custom_background").slideDown(500);
		jQuery("#section-full_screen_background").slideDown(500);
		jQuery("#section-background_color").hide(10);
		jQuery("#section-background_pattern").hide(10);
	}else if (jQuery("#"+vpanel_name+"-background_type-patterns:checked").length > 0 && jQuery("#"+vpanel_name+"-background_type-custom_background:checked").length == 0) {
		jQuery("#section-background_color").slideDown(500);
		jQuery("#section-background_pattern").slideDown(500);
		jQuery("#section-custom_background").hide(10);
		jQuery("#section-full_screen_background").hide(10);
	}
	jQuery("#"+vpanel_name+"-background_type-custom_background").click(function () {
		jQuery("#section-custom_background").slideDown(500);
		jQuery("#section-full_screen_background").slideDown(500);
		jQuery("#section-background_pattern").slideUp(500);
		jQuery("#section-background_color").slideUp(500);
	});
	jQuery("#"+vpanel_name+"-background_type-patterns").click(function () {
		jQuery("#section-custom_background").slideUp(500);
		jQuery("#section-full_screen_background").slideUp(500);
		jQuery("#section-background_pattern").slideDown(500);
		jQuery("#section-background_color").slideDown(500);
	});
	
	/* Social header */
	if (jQuery("#header_follow:checked").val() == "on") {
		jQuery("#section-facebook_icon_h").show(10);
		jQuery("#section-twitter_icon_h").show(10);
		jQuery("#section-gplus_icon_h").show(10);
		jQuery("#section-dribbble_icon_h").show(10);
		jQuery("#section-linkedin_icon_h").show(10);
		jQuery("#section-youtube_icon_h").show(10);
		jQuery("#section-vimeo_icon_h").show(10);
		jQuery("#section-skype_icon_h").show(10);
		jQuery("#section-flickr_icon_h").show(10);
		jQuery("#section-soundcloud_icon_h").show(10);
		jQuery("#section-instagram_icon_h").show(10);
		jQuery("#section-pinterest_icon_h").show(10);
	}else {
		jQuery("#section-facebook_icon_h").hide(10);
		jQuery("#section-twitter_icon_h").hide(10);
		jQuery("#section-gplus_icon_h").hide(10);
		jQuery("#section-dribbble_icon_h").hide(10);
		jQuery("#section-linkedin_icon_h").hide(10);
		jQuery("#section-youtube_icon_h").hide(10);
		jQuery("#section-vimeo_icon_h").hide(10);
		jQuery("#section-skype_icon_h").hide(10);
		jQuery("#section-flickr_icon_h").hide(10);
		jQuery("#section-soundcloud_icon_h").hide(10);
		jQuery("#section-instagram_icon_h").hide(10);
		jQuery("#section-pinterest_icon_h").hide(10);
	}
	jQuery("#header_follow").click(function () {
		if (jQuery("#header_follow:checked").val() == "on") {
			jQuery("#section-facebook_icon_h").slideDown(500);
			jQuery("#section-twitter_icon_h").slideDown(500);
			jQuery("#section-gplus_icon_h").slideDown(500);
			jQuery("#section-dribbble_icon_h").slideDown(500);
			jQuery("#section-linkedin_icon_h").slideDown(500);
			jQuery("#section-youtube_icon_h").slideDown(500);
			jQuery("#section-vimeo_icon_h").slideDown(500);
			jQuery("#section-skype_icon_h").slideDown(500);
			jQuery("#section-flickr_icon_h").slideDown(500);
			jQuery("#section-soundcloud_icon_h").slideDown(500);
			jQuery("#section-instagram_icon_h").slideDown(500);
			jQuery("#section-pinterest_icon_h").slideDown(500);
		}else {
			jQuery("#section-facebook_icon_h").slideUp(500);
			jQuery("#section-twitter_icon_h").slideUp(500);
			jQuery("#section-gplus_icon_h").slideUp(500);
			jQuery("#section-dribbble_icon_h").slideUp(500);
			jQuery("#section-linkedin_icon_h").slideUp(500);
			jQuery("#section-youtube_icon_h").slideUp(500);
			jQuery("#section-vimeo_icon_h").slideUp(500);
			jQuery("#section-skype_icon_h").slideUp(500);
			jQuery("#section-flickr_icon_h").slideUp(500);
			jQuery("#section-soundcloud_icon_h").slideUp(500);
			jQuery("#section-instagram_icon_h").slideUp(500);
			jQuery("#section-pinterest_icon_h").slideUp(500);
		}
	});
	
	/* Slideshow display */
	
	function multiple_categories_change (value) {
		if (jQuery("#"+value+"_display").val() == "single_category") {
			jQuery("#section-"+value+"_single_category").show(10);
			jQuery("#section-"+value+"_categories").hide(10);
			jQuery("#section-"+value+"_posts").hide(10);
		}else if (jQuery("#"+value+"_display").val() == "multiple_categories") {
			jQuery("#section-"+value+"_categories").show(10);
			jQuery("#section-"+value+"_single_category").hide(10);
			jQuery("#section-"+value+"_posts").hide(10);
		}else if (jQuery("#"+value+"_display").val() == "posts") {
			jQuery("#section-"+value+"_posts").show(10);
			jQuery("#section-"+value+"_categories").hide(10);
			jQuery("#section-"+value+"_single_category").hide(10);
		}else {
			jQuery("#section-"+value+"_single_category").hide(10);
			jQuery("#section-"+value+"_posts").hide(10);
			jQuery("#section-"+value+"_categories").hide(10);
		}
		
		jQuery("#"+value+"_display").change(function () {
			if (jQuery(this).val() == "single_category") {
				jQuery("#section-"+value+"_single_category").slideDown(500);
				jQuery("#section-"+value+"_categories").slideUp(500);
				jQuery("#section-"+value+"_posts").slideUp(500);
			}else if (jQuery(this).val() == "multiple_categories") {
				jQuery("#section-"+value+"_categories").slideDown(500);
				jQuery("#section-"+value+"_posts").slideUp(500);
				jQuery("#section-"+value+"_single_category").slideUp(500);
			}else if (jQuery(this).val() == "posts") {
				jQuery("#section-"+value+"_posts").slideDown(500);
				jQuery("#section-"+value+"_categories").slideUp(500);
				jQuery("#section-"+value+"_single_category").slideUp(500);
			}else {
				jQuery("#section-"+value+"_single_category").slideUp(500);
				jQuery("#section-"+value+"_posts").slideUp(500);
				jQuery("#section-"+value+"_categories").slideUp(500);
			}
		});
	}
	
	multiple_categories_change("news");
	multiple_categories_change("slideshow");
	multiple_categories_change("thumbnail");
	
	if (jQuery("#head_slide_style").val() == "slideshow" || jQuery("#head_slide_style").val() == "slideshow_thumbnail" || jQuery("#head_slide_style").val() == "thumbnail_slideshow" || jQuery("#head_slide_style").val() == "thumbnail") {
		jQuery(".thumbnail_setting").show(10);
		jQuery("#section-excerpt_title_thumbnail").show(10);
		jQuery("#section-thumbnail_number").show(10);
		jQuery("#section-orderby_thumbnail").show(10);
		jQuery("#section-thumbnail_display").show(10);
		jQuery("#section-thumbnail_single_category").show(10);
		jQuery("#section-thumbnail_categories").show(10);
		jQuery("#section-thumbnail_posts").show(10);
		
		multiple_categories_change("thumbnail");
		if (jQuery("#head_slide_style").val() == "slideshow" || jQuery("#head_slide_style").val() == "slideshow_thumbnail" || jQuery("#head_slide_style").val() == "thumbnail_slideshow") {
			jQuery("#section-slide_overlay").show(10);
			jQuery("#section-excerpt_title_slideshow").show(10);
			jQuery("#section-excerpt_slideshow").show(10);
			jQuery("#section-slideshow_number").show(10);
			jQuery("#section-orderby_slide").show(10);
			jQuery("#section-slideshow_display").show(10);
			jQuery("#section-slideshow_single_category").show(10);
			jQuery("#section-slideshow_categories").show(10);
			jQuery("#section-slideshow_posts").show(10);
			if (jQuery("#head_slide_style").val() == "slideshow") {
				jQuery(".thumbnail_setting").hide(10);
				jQuery("#section-excerpt_title_thumbnail").hide(10);
				jQuery("#section-thumbnail_number").hide(10);
				jQuery("#section-orderby_thumbnail").hide(10);
				jQuery("#section-thumbnail_display").hide(10);
				jQuery("#section-thumbnail_single_category").hide(10);
				jQuery("#section-thumbnail_categories").hide(10);
				jQuery("#section-thumbnail_single_category").hide(10);
				jQuery("#section-thumbnail_categories").hide(10);
				jQuery("#section-thumbnail_posts").hide(10);
			}
			multiple_categories_change("slideshow");
		}
		if (jQuery("#head_slide_style").val() == "thumbnail") {
			jQuery("#section-slide_overlay").hide(10);
			jQuery("#section-excerpt_title_slideshow").hide(10);
			jQuery("#section-excerpt_slideshow").hide(10);
			jQuery("#section-slideshow_number").hide(10);
			jQuery("#section-orderby_slide").hide(10);
			jQuery("#section-slideshow_display").hide(10);
			jQuery("#section-slideshow_single_category").hide(10);
			jQuery("#section-slideshow_categories").hide(10);
			jQuery("#section-slideshow_posts").hide(10);
		}
		jQuery("#section-video_head").hide(10);
		jQuery("#section-video_id_head").hide(10);
		jQuery("#section-custom_embed_head").hide(10);
	}else {
		if (jQuery("#head_slide_style").val() == "video_container" || jQuery("#head_slide_style").val() == "video_full") {
			jQuery("#section-video_head").show(10);
			if (jQuery("#video_head").val() == "embed") {
				jQuery("#section-custom_embed_head").show(10);
				jQuery("#section-video_id_head").hide(10);
			}else {
				jQuery("#section-video_id_head").show(10);
				jQuery("#section-custom_embed_head").hide(10);
			}
			jQuery("#video_head").change(function () {
				if (jQuery("#video_head").val() == "embed") {
					jQuery("#section-custom_embed_head").slideDown(500);
					jQuery("#section-video_id_head").slideUp(500);
				}else {
					jQuery("#section-video_id_head").slideDown(500);
					jQuery("#section-custom_embed_head").slideUp(500);
				}
			});
		}
		jQuery("#section-slide_overlay").hide(10);
		jQuery("#section-excerpt_title_slideshow").hide(10);
		jQuery("#section-excerpt_slideshow").hide(10);
		jQuery("#section-slideshow_number").hide(10);
		jQuery("#section-orderby_slide").hide(10);
		jQuery("#section-slideshow_display").hide(10);
		jQuery("#section-slideshow_single_category").hide(10);
		jQuery("#section-slideshow_categories").hide(10);
		jQuery("#section-slideshow_posts").hide(10);
		jQuery(".thumbnail_setting").hide(10);
		jQuery("#section-excerpt_title_thumbnail").hide(10);
		jQuery("#section-thumbnail_number").hide(10);
		jQuery("#section-orderby_thumbnail").hide(10);
		jQuery("#section-thumbnail_display").hide(10);
		jQuery("#section-thumbnail_single_category").hide(10);
		jQuery("#section-thumbnail_categories").hide(10);
		jQuery("#section-thumbnail_single_category").hide(10);
		jQuery("#section-thumbnail_categories").hide(10);
		jQuery("#section-thumbnail_posts").hide(10);
	}
	jQuery("#head_slide_style").change(function () {
		if (jQuery("#head_slide_style").val() == "slideshow" || jQuery("#head_slide_style").val() == "slideshow_thumbnail" || jQuery("#head_slide_style").val() == "thumbnail_slideshow" || jQuery("#head_slide_style").val() == "thumbnail") {
			jQuery(".thumbnail_setting").slideDown(500);
			jQuery("#section-excerpt_title_thumbnail").slideDown(500);
			jQuery("#section-thumbnail_number").slideDown(500);
			jQuery("#section-orderby_thumbnail").slideDown(500);
			jQuery("#section-thumbnail_display").slideDown(500);
			jQuery("#section-thumbnail_single_category").slideDown(500);
			jQuery("#section-thumbnail_categories").slideDown(500);
			jQuery("#section-thumbnail_single_category").slideDown(500);
			jQuery("#section-thumbnail_categories").slideDown(500);
			jQuery("#section-thumbnail_posts").slideDown(500);
			
			multiple_categories_change("thumbnail");
			if (jQuery("#head_slide_style").val() == "slideshow" || jQuery("#head_slide_style").val() == "slideshow_thumbnail" || jQuery("#head_slide_style").val() == "thumbnail_slideshow") {
				jQuery("#section-slide_overlay").slideDown(500);
				jQuery("#section-excerpt_title_slideshow").slideDown(500);
				jQuery("#section-excerpt_slideshow").slideDown(500);
				jQuery("#section-slideshow_number").slideDown(500);
				jQuery("#section-orderby_slide").slideDown(500);
				jQuery("#section-slideshow_display").slideDown(500);
				jQuery("#section-slideshow_single_category").slideDown(500);
				jQuery("#section-slideshow_categories").slideDown(500);
				jQuery("#section-slideshow_posts").slideDown(500);
				if (jQuery("#head_slide_style").val() == "slideshow") {
					jQuery(".thumbnail_setting").slideUp(500);
					jQuery("#section-excerpt_title_thumbnail").slideUp(500);
					jQuery("#section-thumbnail_number").slideUp(500);
					jQuery("#section-orderby_thumbnail").slideUp(500);
					jQuery("#section-thumbnail_display").slideUp(500);
					jQuery("#section-thumbnail_single_category").slideUp(500);
					jQuery("#section-thumbnail_categories").slideUp(500);
					jQuery("#section-thumbnail_single_category").slideUp(500);
					jQuery("#section-thumbnail_categories").slideUp(500);
					jQuery("#section-thumbnail_posts").slideUp(500);
				}
				multiple_categories_change("slideshow");
			}
			if (jQuery("#head_slide_style").val() == "thumbnail") {
				jQuery("#section-slide_overlay").slideUp(500);
				jQuery("#section-excerpt_title_slideshow").slideUp(500);
				jQuery("#section-excerpt_slideshow").slideUp(500);
				jQuery("#section-slideshow_number").slideUp(500);
				jQuery("#section-orderby_slide").slideUp(500);
				jQuery("#section-slideshow_display").slideUp(500);
				jQuery("#section-slideshow_single_category").slideUp(500);
				jQuery("#section-slideshow_categories").slideUp(500);
				jQuery("#section-slideshow_posts").slideUp(500);
			}
			jQuery("#section-video_head").slideUp(500);
			jQuery("#section-video_id_head").slideUp(500);
			jQuery("#section-custom_embed_head").slideUp(500);
		}else {
			if (jQuery("#head_slide_style").val() == "video_container" || jQuery("#head_slide_style").val() == "video_full") {
				jQuery("#section-video_head").show(10);
				if (jQuery("#video_head").val() == "embed") {
					jQuery("#section-custom_embed_head").show(10);
					jQuery("#section-video_id_head").hide(10);
				}else {
					jQuery("#section-video_id_head").show(10);
					jQuery("#section-custom_embed_head").hide(10);
				}
				jQuery("#video_head").change(function () {
					if (jQuery("#video_head").val() == "embed") {
						jQuery("#section-custom_embed_head").slideDown(500);
						jQuery("#section-video_id_head").slideUp(500);
					}else {
						jQuery("#section-video_id_head").slideDown(500);
						jQuery("#section-custom_embed_head").slideUp(500);
					}
				});
			}
			jQuery("#section-slide_overlay").slideUp(500);
			jQuery("#section-excerpt_title_slideshow").slideUp(500);
			jQuery("#section-excerpt_slideshow").slideUp(500);
			jQuery("#section-slideshow_number").slideUp(500);
			jQuery("#section-orderby_slide").slideUp(500);
			jQuery("#section-slideshow_display").slideUp(500);
			jQuery("#section-slideshow_single_category").slideUp(500);
			jQuery("#section-slideshow_categories").slideUp(500);
			jQuery("#section-slideshow_posts").slideUp(500);
			jQuery(".thumbnail_setting").slideUp(500);
			jQuery("#section-excerpt_title_thumbnail").slideUp(500);
			jQuery("#section-thumbnail_number").slideUp(500);
			jQuery("#section-orderby_thumbnail").slideUp(500);
			jQuery("#section-thumbnail_display").slideUp(500);
			jQuery("#section-thumbnail_single_category").slideUp(500);
			jQuery("#section-thumbnail_categories").slideUp(500);
			jQuery("#section-thumbnail_single_category").slideUp(500);
			jQuery("#section-thumbnail_categories").slideUp(500);
			jQuery("#section-thumbnail_posts").slideUp(500);
		}
	});
	
	/* Home page */
	var home_display = jQuery("#section-home_display input[type='radio']:checked").val();
	if (home_display != "page_builder") {
		jQuery("#home_page_display").hide(10);
	}
	
	jQuery("#section-home_display input[type='radio']").change(function () {
		var home_display = jQuery(this).val();
		if (home_display == "page_builder") {
			jQuery("#home_page_display").slideDown(500);
		}else {
			jQuery("#home_page_display").slideUp(500);
		}
	});
	
	/* Sidebar */
	var sidebar_layout = jQuery("#section-sidebar_layout input[type='radio']:checked").val();
	if (sidebar_layout == "full" || sidebar_layout == "centered") {
		jQuery("#section-sidebar_home").hide(10);
		jQuery("#section-else_sidebar").hide(10);
	}else {
		jQuery("#section-sidebar_home").show(10);
		jQuery("#section-else_sidebar").show(10);
	}
	
	jQuery("#section-sidebar_layout img").click(function () {
		var img_this = jQuery(this);
		var sidebar_layout_c = img_this.prev().text();
		if (sidebar_layout_c == "full" || sidebar_layout_c == "centered") {
			jQuery("#section-sidebar_home").slideUp(500);
			jQuery("#section-else_sidebar").slideUp(500);
		}else {
			jQuery("#section-sidebar_home").slideDown(500);
			jQuery("#section-else_sidebar").slideDown(500);
		}
	});
	
	/* Author Sidebar */
	var author_sidebar_layout = jQuery("#section-author_sidebar_layout input[type='radio']:checked").val();
	if (author_sidebar_layout == "full" || author_sidebar_layout == "centered") {
		jQuery("#section-author_sidebar").hide(10);
	}else {
		jQuery("#section-author_sidebar").show(10);
	}
	
	jQuery("#section-author_sidebar_layout img").click(function () {
		var img_this = jQuery(this);
		var author_sidebar_layout_c = img_this.prev().text();
		if (author_sidebar_layout_c == "full" || author_sidebar_layout_c == "centered") {
			jQuery("#section-author_sidebar").slideUp(500);
		}else {
			jQuery("#section-author_sidebar").slideDown(500);
		}
	});
	
	/* Meta box (Sidebar) */
	
	var sidebar_layout_m = jQuery("input[name='vbegy_sidebar']:checked").val();
	if (sidebar_layout_m == "full" || sidebar_layout_m == "centered") {
		jQuery("#vbegy_what_sidebar").parent().parent().parent().hide(10);
	}else {
		jQuery("#vbegy_what_sidebar").parent().parent().parent().show(10);
	}
	
	jQuery("input[name='vbegy_sidebar']").change(function () {
		var sidebar_layout_c_m = jQuery(this).val();
		if (sidebar_layout_c_m == "full" || sidebar_layout_c_m == "centered") {
			jQuery("#vbegy_what_sidebar").parent().parent().parent().slideUp(500);
		}else {
			jQuery("#vbegy_what_sidebar").parent().parent().parent().slideDown(500);
		}
	});
	
	/* Meta box */
	if (jQuery("#vbegy_page_builder:checked").val() == 1) {
		jQuery("#builder_meta").show(10);
	}else {
		jQuery("#builder_meta").hide(10);
	}
	jQuery("#vbegy_page_builder").click(function () {
		if (jQuery("#vbegy_page_builder:checked").val() == 1) {
			jQuery("#builder_meta").slideDown(500);
			jQuery('html,body').animate({scrollTop: jQuery("#builder_meta").offset().top},"slow");
		}else {
			jQuery("#builder_meta").slideUp(500);
		}
	});
	
	var post_type = jQuery("#post_type").val();
	if (post_type == "post") {
		jQuery("#vbegy_page_builder").parent().parent().remove();
	}else if (post_type == "page") {
		jQuery("#vbegy_post_navigation_s").parent().parent().remove();
		jQuery("#vbegy_related_post_s").parent().parent().remove();
		jQuery("#vbegy_related_number_s").parent().parent().remove();
		jQuery("#vbegy_excerpt_related_title_s").parent().parent().remove();
		jQuery("#vbegy_post_type_s").parent().parent().remove();
		jQuery("#vbegy_post_author_s").parent().parent().remove();
		jQuery("#vbegy_post_author_box_s").parent().parent().remove();
		jQuery("#vbegy_post_review_s").parent().parent().remove();
	}else if (post_type == "portfolio") {
		jQuery("#vbegy_post_type_s").parent().parent().remove();
		jQuery("#vbegy_post_author_s").parent().parent().remove();
		jQuery("#vbegy_post_author_box_s").parent().parent().remove();
		jQuery("#vbegy_page_builder").parent().parent().remove();
		jQuery("#vbegy_post_review_s").parent().parent().remove();
	}else if (post_type == "product") {
		jQuery("#vbegy_post_type_s").parent().parent().remove();
		jQuery("#vbegy_post_author_s").parent().parent().remove();
		jQuery("#vbegy_post_author_box_s").parent().parent().remove();
		jQuery("#vbegy_page_builder").parent().parent().remove();
		jQuery("#vbegy_post_views_s").parent().parent().remove();
		jQuery("#vbegy_post_review_s").parent().parent().remove();
		jQuery("#vbegy_post_author_box_s").parent().parent().remove();
		jQuery("#vbegy_excerpt_related_title_s").parent().parent().remove();
		jQuery("#vbegy_post_comments_s").parent().parent().remove();
	}
	
	jQuery(".vpanel_checkbox").each(function () {
		var vpanel_checkbox = jQuery(this);
		if (vpanel_checkbox.length > 0) {
			vpanel_checkbox.parent().addClass("vpanel_checkbox_input");
		}
	});
	
	function multiple_categories_change_meta (value) {
		if (jQuery("#vbegy_"+value+"_display").val() == "single_category") {
			jQuery("#vbegy_"+value+"_single_category").parent().parent().parent().show(10);
			jQuery("#vbegy_"+value+"_categories_description").parent().parent().hide(10);
			jQuery("#vbegy_"+value+"_posts_description").parent().parent().hide(10);
		}else if (jQuery("#vbegy_"+value+"_display").val() == "multiple_categories") {
			jQuery("#vbegy_"+value+"_categories_description").parent().parent().parent().show(10);
			jQuery("#vbegy_"+value+"_single_category").parent().parent().parent().hide(10);
			jQuery("#vbegy_"+value+"_posts_description").parent().parent().hide(10);
		}
		else if (jQuery("#vbegy_"+value+"_display").val() == "posts") {
			jQuery("#vbegy_"+value+"_posts_description").parent().parent().parent().show(10);
			jQuery("#vbegy_"+value+"_single_category").parent().parent().parent().hide(10);
			jQuery("#vbegy_"+value+"_categories_description").parent().parent().hide(10);
		}else {
			jQuery("#vbegy_"+value+"_posts_description").parent().parent().hide(10);
			jQuery("#vbegy_"+value+"_categories_description").parent().parent().hide(10);
			jQuery("#vbegy_"+value+"_single_category").parent().parent().parent().hide(10);
		}
		
		jQuery("#vbegy_"+value+"_display").change(function () {
			if (jQuery(this).val() == "single_category") {
				jQuery("#vbegy_"+value+"_single_category").parent().parent().parent().slideDown(500);
				jQuery("#vbegy_"+value+"_categories_description").parent().parent().slideUp(500);
				jQuery("#vbegy_"+value+"_posts_description").parent().parent().slideUp(500);
			}else if (jQuery(this).val() == "multiple_categories") {
				jQuery("#vbegy_"+value+"_categories_description").parent().parent().slideDown(500);
				jQuery("#vbegy_"+value+"_single_category").parent().parent().parent().slideUp(500);
				jQuery("#vbegy_"+value+"_posts_description").parent().parent().slideUp(500);
			}else if (jQuery(this).val() == "posts") {
				jQuery("#vbegy_"+value+"_posts_description").parent().parent().slideDown(500);
				jQuery("#vbegy_"+value+"_categories_description").parent().parent().slideUp(500);
				jQuery("#vbegy_"+value+"_single_category").parent().parent().parent().slideUp(500);
			}else {
				jQuery("#vbegy_"+value+"_posts_description").parent().parent().slideUp(500);
				jQuery("#vbegy_"+value+"_categories_description").parent().parent().slideUp(500);
				jQuery("#vbegy_"+value+"_single_category").parent().parent().parent().slideUp(500);
			}
		});
	}
	
	multiple_categories_change_meta("news");
	multiple_categories_change_meta("slideshow");
	multiple_categories_change_meta("thumbnail");
	multiple_categories_change_meta("post");
	
	jQuery("label[for='vbegy_slide_overlay']").parent().parent().show(10);
	jQuery("label[for='vbegy_excerpt_title_slideshow']").parent().parent().show(10);
	jQuery("label[for='vbegy_excerpt_slideshow']").parent().parent().show(10);
	jQuery("label[for='vbegy_slideshow_number']").parent().parent().show(10);
	jQuery("label[for='vbegy_orderby_slide']").parent().parent().show(10);
	jQuery("label[for='vbegy_slideshow_display']").parent().parent().show(10);
	jQuery("label[for='vbegy_slideshow_single_category']").parent().parent().show(10);
	jQuery("label[for='vbegy_slideshow_categories']").parent().parent().show(10);
	jQuery("label[for='vbegy_slideshow_posts']").parent().parent().show(10);
	
	multiple_categories_change_meta("slideshow");
	
	if (jQuery("#vbegy_head_slide_style").val() == "slideshow" || jQuery("#vbegy_head_slide_style").val() == "slideshow_thumbnail" || jQuery("#vbegy_head_slide_style").val() == "thumbnail_slideshow" || jQuery("#vbegy_head_slide_style").val() == "thumbnail") {
		jQuery("label[for='vbegy_excerpt_title_thumbnail']").parent().parent().show(10);
		jQuery("label[for='vbegy_thumbnail_number']").parent().parent().show(10);
		jQuery("label[for='vbegy_orderby_thumbnail']").parent().parent().show(10);
		jQuery("label[for='vbegy_thumbnail_display']").parent().parent().show(10);
		jQuery("label[for='vbegy_thumbnail_single_category']").parent().parent().show(10);
		jQuery("label[for='vbegy_thumbnail_categories']").parent().parent().show(10);
		jQuery("label[for='vbegy_thumbnail_posts']").parent().parent().show(10);
		
		multiple_categories_change_meta("thumbnail");
		if (jQuery("#vbegy_head_slide_style").val() == "slideshow" || jQuery("#vbegy_head_slide_style").val() == "slideshow_thumbnail" || jQuery("#vbegy_head_slide_style").val() == "thumbnail_slideshow") {
			jQuery("label[for='vbegy_slide_overlay']").parent().parent().show(10);
			jQuery("label[for='vbegy_excerpt_title_slideshow']").parent().parent().show(10);
			jQuery("label[for='vbegy_excerpt_slideshow']").parent().parent().show(10);
			jQuery("label[for='vbegy_slideshow_number']").parent().parent().show(10);
			jQuery("label[for='vbegy_orderby_slide']").parent().parent().show(10);
			jQuery("label[for='vbegy_slideshow_display']").parent().parent().show(10);
			jQuery("label[for='vbegy_slideshow_single_category']").parent().parent().show(10);
			jQuery("label[for='vbegy_slideshow_categories']").parent().parent().show(10);
			jQuery("label[for='vbegy_slideshow_posts']").parent().parent().show(10);
			if (jQuery("#vbegy_head_slide_style").val() == "slideshow") {
				jQuery("label[for='vbegy_excerpt_title_thumbnail']").parent().parent().hide(10);
				jQuery("label[for='vbegy_thumbnail_number']").parent().parent().hide(10);
				jQuery("label[for='vbegy_orderby_thumbnail']").parent().parent().hide(10);
				jQuery("label[for='vbegy_thumbnail_display']").parent().parent().hide(10);
				jQuery("label[for='vbegy_thumbnail_single_category']").parent().parent().hide(10);
				jQuery("label[for='vbegy_thumbnail_categories']").parent().parent().hide(10);
				jQuery("label[for='vbegy_thumbnail_single_category']").parent().parent().hide(10);
				jQuery("label[for='vbegy_thumbnail_categories']").parent().parent().hide(10);
				jQuery("label[for='vbegy_thumbnail_posts']").parent().parent().hide(10);
			}
			multiple_categories_change_meta("slideshow");
		}
		if (jQuery("#vbegy_head_slide_style").val() == "thumbnail") {
			jQuery("label[for='vbegy_slide_overlay']").parent().parent().hide(10);
			jQuery("label[for='vbegy_excerpt_title_slideshow']").parent().parent().hide(10);
			jQuery("label[for='vbegy_excerpt_slideshow']").parent().parent().hide(10);
			jQuery("label[for='vbegy_slideshow_number']").parent().parent().hide(10);
			jQuery("label[for='vbegy_orderby_slide']").parent().parent().hide(10);
			jQuery("label[for='vbegy_slideshow_display']").parent().parent().hide(10);
			jQuery("label[for='vbegy_slideshow_single_category']").parent().parent().hide(10);
			jQuery("label[for='vbegy_slideshow_categories']").parent().parent().hide(10);
			jQuery("label[for='vbegy_slideshow_posts']").parent().parent().hide(10);
		}
		jQuery("label[for='vbegy_video_head']").parent().parent().hide(10);
		jQuery("label[for='vbegy_video_id_head']").parent().parent().hide(10);
		jQuery("label[for='vbegy_custom_embed_head']").parent().parent().hide(10);
	}else {
		if (jQuery("#vbegy_head_slide_style").val() == "video_container" || jQuery("#vbegy_head_slide_style").val() == "video_full") {
			jQuery("label[for='vbegy_video_head']").parent().parent().show(10);
			if (jQuery("#vbegy_video_head").val() == "embed") {
				jQuery("label[for='vbegy_custom_embed_head']").parent().parent().show(10);
				jQuery("label[for='vbegy_video_id_head']").parent().parent().hide(10);
			}else {
				jQuery("label[for='vbegy_video_id_head']").parent().parent().show(10);
				jQuery("label[for='vbegy_custom_embed_head']").parent().parent().hide(10);
			}
			jQuery("#vbegy_video_head").change(function () {
				if (jQuery("#vbegy_video_head").val() == "embed") {
					jQuery("label[for='vbegy_custom_embed_head']").parent().parent().slideDown(500);
					jQuery("label[for='vbegy_video_id_head']").parent().parent().slideUp(500);
				}else {
					jQuery("label[for='vbegy_video_id_head']").parent().parent().slideDown(500);
					jQuery("label[for='vbegy_custom_embed_head']").parent().parent().slideUp(500);
				}
			});
		}
		jQuery("label[for='vbegy_slide_overlay']").parent().parent().hide(10);
		jQuery("label[for='vbegy_excerpt_title_slideshow']").parent().parent().hide(10);
		jQuery("label[for='vbegy_excerpt_slideshow']").parent().parent().hide(10);
		jQuery("label[for='vbegy_slideshow_number']").parent().parent().hide(10);
		jQuery("label[for='vbegy_orderby_slide']").parent().parent().hide(10);
		jQuery("label[for='vbegy_slideshow_display']").parent().parent().hide(10);
		jQuery("label[for='vbegy_slideshow_single_category']").parent().parent().hide(10);
		jQuery("label[for='vbegy_slideshow_categories']").parent().parent().hide(10);
		jQuery("label[for='vbegy_slideshow_posts']").parent().parent().hide(10);
		jQuery("label[for='vbegy_excerpt_title_thumbnail']").parent().parent().hide(10);
		jQuery("label[for='vbegy_thumbnail_number']").parent().parent().hide(10);
		jQuery("label[for='vbegy_orderby_thumbnail']").parent().parent().hide(10);
		jQuery("label[for='vbegy_thumbnail_display']").parent().parent().hide(10);
		jQuery("label[for='vbegy_thumbnail_single_category']").parent().parent().hide(10);
		jQuery("label[for='vbegy_thumbnail_categories']").parent().parent().hide(10);
		jQuery("label[for='vbegy_thumbnail_single_category']").parent().parent().hide(10);
		jQuery("label[for='vbegy_thumbnail_categories']").parent().parent().hide(10);
		jQuery("label[for='vbegy_thumbnail_posts']").parent().parent().hide(10);
	}
	jQuery("#vbegy_head_slide_style").change(function () {
		if (jQuery("#vbegy_head_slide_style").val() == "slideshow" || jQuery("#vbegy_head_slide_style").val() == "slideshow_thumbnail" || jQuery("#vbegy_head_slide_style").val() == "thumbnail_slideshow" || jQuery("#vbegy_head_slide_style").val() == "thumbnail") {
			jQuery("label[for='vbegy_excerpt_title_thumbnail']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_thumbnail_number']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_orderby_thumbnail']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_thumbnail_display']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_thumbnail_single_category']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_thumbnail_categories']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_thumbnail_single_category']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_thumbnail_categories']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_thumbnail_posts']").parent().parent().slideDown(500);
			
			multiple_categories_change_meta("thumbnail");
			if (jQuery("#vbegy_head_slide_style").val() == "slideshow" || jQuery("#vbegy_head_slide_style").val() == "slideshow_thumbnail" || jQuery("#vbegy_head_slide_style").val() == "thumbnail_slideshow") {
				jQuery("label[for='vbegy_slide_overlay']").parent().parent().slideDown(500);
				jQuery("label[for='vbegy_excerpt_title_slideshow']").parent().parent().slideDown(500);
				jQuery("label[for='vbegy_excerpt_slideshow']").parent().parent().slideDown(500);
				jQuery("label[for='vbegy_slideshow_number']").parent().parent().slideDown(500);
				jQuery("label[for='vbegy_orderby_slide']").parent().parent().slideDown(500);
				jQuery("label[for='vbegy_slideshow_display']").parent().parent().slideDown(500);
				jQuery("label[for='vbegy_slideshow_single_category']").parent().parent().slideDown(500);
				jQuery("label[for='vbegy_slideshow_categories']").parent().parent().slideDown(500);
				jQuery("label[for='vbegy_slideshow_posts']").parent().parent().slideDown(500);
				if (jQuery("#vbegy_head_slide_style").val() == "slideshow") {
					jQuery("label[for='vbegy_excerpt_title_thumbnail']").parent().parent().slideUp(500);
					jQuery("label[for='vbegy_thumbnail_number']").parent().parent().slideUp(500);
					jQuery("label[for='vbegy_orderby_thumbnail']").parent().parent().slideUp(500);
					jQuery("label[for='vbegy_thumbnail_display']").parent().parent().slideUp(500);
					jQuery("label[for='vbegy_thumbnail_single_category']").parent().parent().slideUp(500);
					jQuery("label[for='vbegy_thumbnail_categories']").parent().parent().slideUp(500);
					jQuery("label[for='vbegy_thumbnail_single_category']").parent().parent().slideUp(500);
					jQuery("label[for='vbegy_thumbnail_categories']").parent().parent().slideUp(500);
					jQuery("label[for='vbegy_thumbnail_posts']").parent().parent().slideUp(500);
				}
				multiple_categories_change_meta("slideshow");
			}
			if (jQuery("#vbegy_head_slide_style").val() == "thumbnail") {
				jQuery("label[for='vbegy_slide_overlay']").parent().parent().slideUp(500);
				jQuery("label[for='vbegy_excerpt_title_slideshow']").parent().parent().slideUp(500);
				jQuery("label[for='vbegy_excerpt_slideshow']").parent().parent().slideUp(500);
				jQuery("label[for='vbegy_slideshow_number']").parent().parent().slideUp(500);
				jQuery("label[for='vbegy_orderby_slide']").parent().parent().slideUp(500);
				jQuery("label[for='vbegy_slideshow_display']").parent().parent().slideUp(500);
				jQuery("label[for='vbegy_slideshow_single_category']").parent().parent().slideUp(500);
				jQuery("label[for='vbegy_slideshow_categories']").parent().parent().slideUp(500);
				jQuery("label[for='vbegy_slideshow_posts']").parent().parent().slideUp(500);
			}
			jQuery("label[for='vbegy_video_head']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_video_id_head']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_custom_embed_head']").parent().parent().slideUp(500);
		}else {
			if (jQuery("#vbegy_head_slide_style").val() == "video_container" || jQuery("#vbegy_head_slide_style").val() == "video_full") {
				jQuery("label[for='vbegy_video_head']").parent().parent().slideDown(500);
				if (jQuery("#vbegy_video_head").val() == "embed") {
					jQuery("label[for='vbegy_custom_embed_head']").parent().parent().slideDown(500);
					jQuery("label[for='vbegy_video_id_head']").parent().parent().slideUp(500);
				}else {
					jQuery("label[for='vbegy_video_id_head']").parent().parent().slideDown(500);
					jQuery("label[for='vbegy_custom_embed_head']").parent().parent().slideUp(500);
				}
				jQuery("#vbegy_video_head").change(function () {
					if (jQuery("#vbegy_video_head").val() == "embed") {
						jQuery("label[for='vbegy_custom_embed_head']").parent().parent().slideDown(500);
						jQuery("label[for='vbegy_video_id_head']").parent().parent().slideUp(500);
					}else {
						jQuery("label[for='vbegy_video_id_head']").parent().parent().slideDown(500);
						jQuery("label[for='vbegy_custom_embed_head']").parent().parent().slideUp(500);
					}
				});
			}
			jQuery("label[for='vbegy_slide_overlay']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_excerpt_title_slideshow']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_excerpt_slideshow']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_slideshow_number']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_orderby_slide']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_slideshow_display']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_slideshow_single_category']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_slideshow_categories']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_slideshow_posts']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_excerpt_title_thumbnail']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_thumbnail_number']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_orderby_thumbnail']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_thumbnail_display']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_thumbnail_single_category']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_thumbnail_categories']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_thumbnail_single_category']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_thumbnail_categories']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_thumbnail_posts']").parent().parent().slideUp(500);
		}
	});
	
	jQuery("#vbegy_google").parent().parent().hide(10);
	jQuery("#vbegy_audio").parent().parent().hide(10);
	jQuery("#vbegy_video_post_type").parent().parent().parent().hide(10);
	jQuery("#vbegy_video_post_id").parent().parent().hide(10);
	jQuery("#vbegy_custom_embed").parent().parent().hide(10);
	jQuery("#vbegy_quote_author").parent().parent().hide(10);
	jQuery("#vbegy_quote_icon_color_description").parent().parent().hide(10);
	jQuery("#vbegy_quote_color_description").parent().parent().hide(10);
	jQuery("#vbegy_link").parent().parent().hide(10);
	jQuery("#vbegy_link_target").parent().parent().parent().hide(10);
	jQuery("#vbegy_link_title").parent().parent().hide(10);
	jQuery("#vbegy_link_icon_color_description").parent().parent().hide(10);
	jQuery("#vbegy_link_color_description").parent().parent().hide(10);
	jQuery("#vbegy_link_icon_hover_color_description").parent().parent().hide(10);
	jQuery("#vbegy_link_hover_color_description").parent().parent().hide(10);
	jQuery("#vbegy_soundcloud_embed").parent().parent().hide(10);
	jQuery("#vbegy_soundcloud_height").parent().parent().hide(10);
	jQuery("#vbegy_twitter_embed").parent().parent().hide(10);
	jQuery("#vbegy_facebook_embed").parent().parent().hide(10);
	jQuery("#vbegy_slideshow_type").parent().parent().parent().hide(10);
	jQuery("[data-field_id='vbegy_upload_images']").parent().parent().hide();
	jQuery("label[for='vbegy_post_head_background']").parent().parent().hide(10);
	jQuery("label[for='vbegy_post_head_background_img']").parent().parent().hide(10);
	jQuery("label[for='vbegy_post_head_background_repeat']").parent().parent().hide(10);
	jQuery("label[for='vbegy_post_head_background_fixed']").parent().parent().hide(10);
	jQuery("label[for='vbegy_post_head_background_position_x']").parent().parent().hide(10);
	jQuery("label[for='vbegy_post_head_background_position_y']").parent().parent().hide(10);
	jQuery("label[for='vbegy_post_head_background_full']").parent().parent().hide(10);
	
	var builder_slide_warp = jQuery("#builder_slide_warp").html();
	jQuery("#builder_slide_warp").remove();
	jQuery("#vbegy_slideshow_post").html(builder_slide_warp).hide(10);
	if (jQuery("#vbegy_slideshow_post").length > 0) {
		jQuery("#vbegy_slideshow_post ul").sortable({placeholder: "ui-state-highlight"});
	}
	
	var builder_rating_warp = jQuery("#builder_rating_warp").html();
	jQuery("#builder_rating_warp").remove();
	jQuery("#vbegy_ratings_post").html(builder_rating_warp);
	if (jQuery("#vbegy_ratings_post").length > 0) {
		jQuery("#vbegy_ratings_post ul").sortable({placeholder: "ui-state-highlight"});
	}
	
	jQuery("#vbegy_slideshow_type").change(function () {
		var slideshow_type = jQuery(this).val();
		if (slideshow_type == "custom_slide") {
			jQuery("#vbegy_slideshow_post").slideDown(500);
			jQuery("[data-field_id='vbegy_upload_images']").parent().parent().slideUp(500);
		}else {
			jQuery("#vbegy_slideshow_post").slideUp(500);
			jQuery("[data-field_id='vbegy_upload_images']").parent().parent().slideDown(500);
		}
	});
	jQuery("#vbegy_what_post").change(function () {
		var what_post = jQuery(this).val();
		if (what_post == "google") {
			jQuery("#vbegy_google").parent().parent().slideDown(500);
			jQuery("#vbegy_audio").parent().parent().slideUp(500);
			jQuery("#vbegy_video_post_type").parent().parent().parent().slideUp(500);
			jQuery("#vbegy_video_post_id").parent().parent().slideUp(500);
			jQuery("#vbegy_custom_embed").parent().parent().slideUp(500);
			jQuery("#vbegy_quote_author").parent().parent().slideUp(500);
			jQuery("#vbegy_quote_icon_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_quote_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_link").parent().parent().slideUp(500);
			jQuery("#vbegy_link_target").parent().parent().parent().slideUp(500);
			jQuery("#vbegy_link_title").parent().parent().slideUp(500);
			jQuery("#vbegy_link_icon_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_link_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_link_icon_hover_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_link_hover_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_soundcloud_embed").parent().parent().slideUp(500);
			jQuery("#vbegy_soundcloud_height").parent().parent().slideUp(500);
			jQuery("#vbegy_twitter_embed").parent().parent().slideUp(500);
			jQuery("#vbegy_facebook_embed").parent().parent().slideUp(500);
			jQuery("#vbegy_slideshow_type").parent().parent().parent().slideUp(500);
			jQuery("#vbegy_slideshow_post").slideUp(500);
			jQuery("[data-field_id='vbegy_upload_images']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background_img']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background_repeat']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background_fixed']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background_position_x']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background_position_y']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background_full']").parent().parent().slideUp(500);
		}else if (what_post == "audio") {
			jQuery("#vbegy_google").parent().parent().slideUp(500);
			jQuery("#vbegy_audio").parent().parent().slideDown(500);
			jQuery("#vbegy_video_post_type").parent().parent().parent().slideUp(500);
			jQuery("#vbegy_video_post_id").parent().parent().slideUp(500);
			jQuery("#vbegy_custom_embed").parent().parent().slideUp(500);
			jQuery("#vbegy_quote_author").parent().parent().slideUp(500);
			jQuery("#vbegy_quote_icon_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_quote_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_link").parent().parent().slideUp(500);
			jQuery("#vbegy_link_target").parent().parent().parent().slideUp(500);
			jQuery("#vbegy_link_title").parent().parent().slideUp(500);
			jQuery("#vbegy_link_icon_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_link_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_link_icon_hover_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_link_hover_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_soundcloud_embed").parent().parent().slideUp(500);
			jQuery("#vbegy_soundcloud_height").parent().parent().slideUp(500);
			jQuery("#vbegy_twitter_embed").parent().parent().slideUp(500);
			jQuery("#vbegy_facebook_embed").parent().parent().slideUp(500);
			jQuery("#vbegy_slideshow_type").parent().parent().parent().slideUp(500);
			jQuery("#vbegy_slideshow_post").slideUp(500);
			jQuery("[data-field_id='vbegy_upload_images']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background_img']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background_repeat']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background_fixed']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background_position_x']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background_position_y']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background_full']").parent().parent().slideUp(500);
		}else if (what_post == "slideshow") {
			jQuery("#vbegy_google").parent().parent().slideUp(500);
			jQuery("#vbegy_audio").parent().parent().slideUp(500);
			jQuery("#vbegy_video_post_type").parent().parent().parent().slideUp(500);
			jQuery("#vbegy_video_post_id").parent().parent().slideUp(500);
			jQuery("#vbegy_custom_embed").parent().parent().slideUp(500);
			jQuery("#vbegy_quote_author").parent().parent().slideUp(500);
			jQuery("#vbegy_quote_icon_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_quote_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_link").parent().parent().slideUp(500);
			jQuery("#vbegy_link_target").parent().parent().parent().slideUp(500);
			jQuery("#vbegy_link_title").parent().parent().slideUp(500);
			jQuery("#vbegy_link_icon_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_link_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_link_icon_hover_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_link_hover_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_soundcloud_embed").parent().parent().slideUp(500);
			jQuery("#vbegy_soundcloud_height").parent().parent().slideUp(500);
			jQuery("#vbegy_twitter_embed").parent().parent().slideUp(500);
			jQuery("#vbegy_facebook_embed").parent().parent().slideUp(500);
			jQuery("#vbegy_slideshow_type").parent().parent().parent().slideDown(500);
			jQuery("#vbegy_slideshow_post").slideUp(500);
			jQuery("[data-field_id='vbegy_upload_images']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background_img']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background_repeat']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background_fixed']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background_position_x']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background_position_y']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background_full']").parent().parent().slideUp(500);
			
			var vbegy_slideshow_type = jQuery("#vbegy_slideshow_type").val();
			if (vbegy_slideshow_type == "custom_slide") {
				jQuery("#vbegy_slideshow_post").slideDown(500);
				jQuery("[data-field_id='vbegy_upload_images']").parent().parent().slideUp(500);
			}else {
				jQuery("#vbegy_slideshow_post").slideUp(500);
				jQuery("[data-field_id='vbegy_upload_images']").parent().parent().slideDown(500);
			}
		}else if (what_post == "video") {
			jQuery("#vbegy_google").parent().parent().slideUp(500);
			jQuery("#vbegy_audio").parent().parent().slideUp(500);
			jQuery("#vbegy_video_post_type").parent().parent().parent().slideDown(500);
			if (jQuery("#vbegy_video_post_type").val() == "embed") {
				jQuery("#vbegy_custom_embed").parent().parent().slideDown(500);
				jQuery("#vbegy_video_post_id").parent().parent().slideUp(500);
			}else {
				jQuery("#vbegy_video_post_id").parent().parent().slideDown(500);
				jQuery("#vbegy_custom_embed").parent().parent().slideUp(500);
			}
			jQuery("#vbegy_quote_author").parent().parent().slideUp(500);
			jQuery("#vbegy_quote_icon_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_quote_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_link").parent().parent().slideUp(500);
			jQuery("#vbegy_link_target").parent().parent().parent().slideUp(500);
			jQuery("#vbegy_link_title").parent().parent().slideUp(500);
			jQuery("#vbegy_link_icon_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_link_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_link_icon_hover_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_link_hover_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_soundcloud_embed").parent().parent().slideUp(500);
			jQuery("#vbegy_soundcloud_height").parent().parent().slideUp(500);
			jQuery("#vbegy_twitter_embed").parent().parent().slideUp(500);
			jQuery("#vbegy_facebook_embed").parent().parent().slideUp(500);
			jQuery("#vbegy_slideshow_type").parent().parent().parent().slideUp(500);
			jQuery("#vbegy_slideshow_post").slideUp(500);
			jQuery("[data-field_id='vbegy_upload_images']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background_img']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background_repeat']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background_fixed']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background_position_x']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background_position_y']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background_full']").parent().parent().slideUp(500);
		}else if (what_post == "quote") {
			jQuery("#vbegy_google").parent().parent().slideUp(500);
			jQuery("#vbegy_audio").parent().parent().slideUp(500);
			jQuery("#vbegy_video_post_type").parent().parent().parent().slideUp(500);
			jQuery("#vbegy_video_post_id").parent().parent().slideUp(500);
			jQuery("#vbegy_custom_embed").parent().parent().slideUp(500);
			jQuery("#vbegy_quote_author").parent().parent().slideDown(500);
			jQuery("#vbegy_quote_icon_color_description").parent().parent().slideDown(500);
			jQuery("#vbegy_quote_color_description").parent().parent().slideDown(500);
			jQuery("#vbegy_link").parent().parent().slideUp(500);
			jQuery("#vbegy_link_target").parent().parent().parent().slideUp(500);
			jQuery("#vbegy_link_title").parent().parent().slideUp(500);
			jQuery("#vbegy_link_icon_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_link_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_link_icon_hover_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_link_hover_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_soundcloud_embed").parent().parent().slideUp(500);
			jQuery("#vbegy_soundcloud_height").parent().parent().slideUp(500);
			jQuery("#vbegy_twitter_embed").parent().parent().slideUp(500);
			jQuery("#vbegy_slideshow_type").parent().parent().parent().slideUp(500);
			jQuery("#vbegy_facebook_embed").parent().parent().slideUp(500);
			jQuery("#vbegy_slideshow_post").slideUp(500);
			jQuery("[data-field_id='vbegy_upload_images']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_post_head_background_img']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_post_head_background_repeat']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_post_head_background_fixed']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_post_head_background_position_x']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_post_head_background_position_y']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_post_head_background_full']").parent().parent().slideDown(500);
		}else if (what_post == "link") {
			jQuery("#vbegy_google").parent().parent().slideUp(500);
			jQuery("#vbegy_audio").parent().parent().slideUp(500);
			jQuery("#vbegy_video_post_type").parent().parent().parent().slideUp(500);
			jQuery("#vbegy_video_post_id").parent().parent().slideUp(500);
			jQuery("#vbegy_custom_embed").parent().parent().slideUp(500);
			jQuery("#vbegy_quote_author").parent().parent().slideUp(500);
			jQuery("#vbegy_quote_icon_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_quote_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_link").parent().parent().slideDown(500);
			jQuery("#vbegy_link_target").parent().parent().parent().slideDown(500);
			jQuery("#vbegy_link_title").parent().parent().slideDown(500);
			jQuery("#vbegy_link_icon_color_description").parent().parent().slideDown(500);
			jQuery("#vbegy_link_color_description").parent().parent().slideDown(500);
			jQuery("#vbegy_link_icon_hover_color_description").parent().parent().slideDown(500);
			jQuery("#vbegy_link_hover_color_description").parent().parent().slideDown(500);
			jQuery("#vbegy_soundcloud_embed").parent().parent().slideUp(500);
			jQuery("#vbegy_soundcloud_height").parent().parent().slideUp(500);
			jQuery("#vbegy_twitter_embed").parent().parent().slideUp(500);
			jQuery("#vbegy_facebook_embed").parent().parent().slideUp(500);
			jQuery("#vbegy_slideshow_type").parent().parent().parent().slideUp(500);
			jQuery("#vbegy_slideshow_post").slideUp(500);
			jQuery("[data-field_id='vbegy_upload_images']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_post_head_background_img']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_post_head_background_repeat']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_post_head_background_fixed']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_post_head_background_position_x']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_post_head_background_position_y']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_post_head_background_full']").parent().parent().slideDown(500);
		}else if (what_post == "soundcloud") {
			jQuery("#vbegy_google").parent().parent().slideUp(500);
			jQuery("#vbegy_audio").parent().parent().slideUp(500);
			jQuery("#vbegy_video_post_type").parent().parent().parent().slideUp(500);
			jQuery("#vbegy_video_post_id").parent().parent().slideUp(500);
			jQuery("#vbegy_custom_embed").parent().parent().slideUp(500);
			jQuery("#vbegy_quote_author").parent().parent().slideUp(500);
			jQuery("#vbegy_quote_icon_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_quote_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_link").parent().parent().slideUp(500);
			jQuery("#vbegy_link_target").parent().parent().parent().slideUp(500);
			jQuery("#vbegy_link_title").parent().parent().slideUp(500);
			jQuery("#vbegy_link_icon_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_link_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_link_icon_hover_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_link_hover_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_soundcloud_embed").parent().parent().slideDown(500);
			jQuery("#vbegy_soundcloud_height").parent().parent().slideDown(500);
			jQuery("#vbegy_twitter_embed").parent().parent().slideUp(500);
			jQuery("#vbegy_facebook_embed").parent().parent().slideUp(500);
			jQuery("#vbegy_slideshow_type").parent().parent().parent().slideUp(500);
			jQuery("#vbegy_slideshow_post").slideUp(500);
			jQuery("[data-field_id='vbegy_upload_images']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_post_head_background_img']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_post_head_background_repeat']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_post_head_background_fixed']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_post_head_background_position_x']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_post_head_background_position_y']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_post_head_background_full']").parent().parent().slideDown(500);
		}else if (what_post == "twitter") {
			jQuery("#vbegy_google").parent().parent().slideUp(500);
			jQuery("#vbegy_audio").parent().parent().slideUp(500);
			jQuery("#vbegy_video_post_type").parent().parent().parent().slideUp(500);
			jQuery("#vbegy_video_post_id").parent().parent().slideUp(500);
			jQuery("#vbegy_custom_embed").parent().parent().slideUp(500);
			jQuery("#vbegy_quote_author").parent().parent().slideUp(500);
			jQuery("#vbegy_quote_icon_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_quote_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_link").parent().parent().slideUp(500);
			jQuery("#vbegy_link_target").parent().parent().parent().slideUp(500);
			jQuery("#vbegy_link_title").parent().parent().slideUp(500);
			jQuery("#vbegy_link_icon_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_link_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_link_icon_hover_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_link_hover_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_soundcloud_embed").parent().parent().slideUp(500);
			jQuery("#vbegy_soundcloud_height").parent().parent().slideUp(500);
			jQuery("#vbegy_twitter_embed").parent().parent().slideDown(500);
			jQuery("#vbegy_facebook_embed").parent().parent().slideUp(500);
			jQuery("#vbegy_slideshow_type").parent().parent().parent().slideUp(500);
			jQuery("#vbegy_slideshow_post").slideUp(500);
			jQuery("[data-field_id='vbegy_upload_images']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_post_head_background_img']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_post_head_background_repeat']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_post_head_background_fixed']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_post_head_background_position_x']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_post_head_background_position_y']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_post_head_background_full']").parent().parent().slideDown(500);
		}else if (what_post == "facebook") {
			jQuery("#vbegy_google").parent().parent().slideUp(500);
			jQuery("#vbegy_audio").parent().parent().slideUp(500);
			jQuery("#vbegy_video_post_type").parent().parent().parent().slideUp(500);
			jQuery("#vbegy_video_post_id").parent().parent().slideUp(500);
			jQuery("#vbegy_custom_embed").parent().parent().slideUp(500);
			jQuery("#vbegy_quote_author").parent().parent().slideUp(500);
			jQuery("#vbegy_quote_icon_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_quote_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_link").parent().parent().slideUp(500);
			jQuery("#vbegy_link_target").parent().parent().parent().slideUp(500);
			jQuery("#vbegy_link_title").parent().parent().slideUp(500);
			jQuery("#vbegy_link_icon_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_link_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_link_icon_hover_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_link_hover_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_soundcloud_embed").parent().parent().slideUp(500);
			jQuery("#vbegy_soundcloud_height").parent().parent().slideUp(500);
			jQuery("#vbegy_twitter_embed").parent().parent().slideUp(500);
			jQuery("#vbegy_facebook_embed").parent().parent().slideDown(500);
			jQuery("#vbegy_slideshow_type").parent().parent().parent().slideUp(500);
			jQuery("#vbegy_slideshow_post").slideUp(500);
			jQuery("[data-field_id='vbegy_upload_images']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_post_head_background_img']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_post_head_background_repeat']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_post_head_background_fixed']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_post_head_background_position_x']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_post_head_background_position_y']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_post_head_background_full']").parent().parent().slideDown(500);
		}else {
			jQuery("#vbegy_google").parent().parent().slideUp(500);
			jQuery("#vbegy_audio").parent().parent().slideUp(500);
			jQuery("#vbegy_video_post_type").parent().parent().parent().slideUp(500);
			jQuery("#vbegy_video_post_id").parent().parent().slideUp(500);
			jQuery("#vbegy_custom_embed").parent().parent().slideUp(500);
			jQuery("#vbegy_quote_author").parent().parent().slideUp(500);
			jQuery("#vbegy_quote_icon_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_quote_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_link").parent().parent().slideUp(500);
			jQuery("#vbegy_link_target").parent().parent().parent().slideUp(500);
			jQuery("#vbegy_link_title").parent().parent().slideUp(500);
			jQuery("#vbegy_link_icon_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_link_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_link_icon_hover_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_link_hover_color_description").parent().parent().slideUp(500);
			jQuery("#vbegy_soundcloud_embed").parent().parent().slideUp(500);
			jQuery("#vbegy_soundcloud_height").parent().parent().slideUp(500);
			jQuery("#vbegy_twitter_embed").parent().parent().slideUp(500);
			jQuery("#vbegy_facebook_embed").parent().parent().slideUp(500);
			jQuery("#vbegy_slideshow_type").parent().parent().parent().slideUp(500);
			jQuery("#vbegy_slideshow_post").slideUp(500);
			jQuery("[data-field_id='vbegy_upload_images']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background_img']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background_repeat']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background_fixed']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background_position_x']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background_position_y']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_post_head_background_full']").parent().parent().slideUp(500);
		}
	});
	
	var vbegy_what_post = jQuery("#vbegy_what_post").val();
	var vbegy_slideshow_type = jQuery("#vbegy_slideshow_type").val();

	if (vbegy_what_post == "google") {
		jQuery("#vbegy_google").parent().parent().show(10);
	}else if (vbegy_what_post == "audio") {
		jQuery("#vbegy_audio").parent().parent().show(10);
	}else if (vbegy_what_post == "slideshow") {
		jQuery("#vbegy_slideshow_type").parent().parent().parent().show(10);
		if (vbegy_slideshow_type == "custom_slide") {
			jQuery("#vbegy_slideshow_post").show(10);
			jQuery("[data-field_id='vbegy_upload_images']").parent().parent().hide();
		}else {
			jQuery("#vbegy_slideshow_post").hide(10);
			jQuery("[data-field_id='vbegy_upload_images']").parent().parent().show(10);
		}
	}else if (vbegy_what_post == "video") {
		jQuery("#vbegy_video_post_type").change(function () {
			if (jQuery("#vbegy_video_post_type").val() == "embed") {
				jQuery("#vbegy_video_post_id").parent().parent().slideUp(500);
				jQuery("#vbegy_custom_embed").parent().parent().slideDown(500);
			}else {
				jQuery("#vbegy_video_post_id").parent().parent().slideDown(500);
				jQuery("#vbegy_custom_embed").parent().parent().slideUp(500);
			}
		});
		
		jQuery("#vbegy_video_post_type").parent().parent().parent().show(10);
		if (jQuery("#vbegy_video_post_type").val() == "embed") {
			jQuery("#vbegy_video_post_id").parent().parent().hide(10);
			jQuery("#vbegy_custom_embed").parent().parent().show(10);
		}else {
			jQuery("#vbegy_video_post_id").parent().parent().show(10);
			jQuery("#vbegy_custom_embed").parent().parent().hide(10);
		}
	}else if (vbegy_what_post == "quote") {
		jQuery("#vbegy_quote_author").parent().parent().show(10);
		jQuery("#vbegy_quote_icon_color_description").parent().parent().show(10);
		jQuery("#vbegy_quote_color_description").parent().parent().show(10);
		jQuery("label[for='vbegy_post_head_background']").parent().parent().show(10);
		jQuery("label[for='vbegy_post_head_background_img']").parent().parent().show(10);
		jQuery("label[for='vbegy_post_head_background_repeat']").parent().parent().show(10);
		jQuery("label[for='vbegy_post_head_background_fixed']").parent().parent().show(10);
		jQuery("label[for='vbegy_post_head_background_position_x']").parent().parent().show(10);
		jQuery("label[for='vbegy_post_head_background_position_y']").parent().parent().show(10);
		jQuery("label[for='vbegy_post_head_background_full']").parent().parent().show(10);
	}else if (vbegy_what_post == "link") {
		jQuery("#vbegy_link").parent().parent().show(10);
		jQuery("#vbegy_link_target").parent().parent().parent().show(10);
		jQuery("#vbegy_link_title").parent().parent().show(10);
		jQuery("#vbegy_link_icon_color_description").parent().parent().show(10);
		jQuery("#vbegy_link_color_description").parent().parent().show(10);
		jQuery("#vbegy_link_icon_hover_color_description").parent().parent().show(10);
		jQuery("#vbegy_link_hover_color_description").parent().parent().show(10);
		jQuery("label[for='vbegy_post_head_background']").parent().parent().show(10);
		jQuery("label[for='vbegy_post_head_background_img']").parent().parent().show(10);
		jQuery("label[for='vbegy_post_head_background_repeat']").parent().parent().show(10);
		jQuery("label[for='vbegy_post_head_background_fixed']").parent().parent().show(10);
		jQuery("label[for='vbegy_post_head_background_position_x']").parent().parent().show(10);
		jQuery("label[for='vbegy_post_head_background_position_y']").parent().parent().show(10);
		jQuery("label[for='vbegy_post_head_background_full']").parent().parent().show(10);
	}else if (vbegy_what_post == "soundcloud") {
		jQuery("#vbegy_soundcloud_embed").parent().parent().show(10);
		jQuery("#vbegy_soundcloud_height").parent().parent().show(10);
		jQuery("label[for='vbegy_post_head_background']").parent().parent().show(10);
		jQuery("label[for='vbegy_post_head_background_img']").parent().parent().show(10);
		jQuery("label[for='vbegy_post_head_background_repeat']").parent().parent().show(10);
		jQuery("label[for='vbegy_post_head_background_fixed']").parent().parent().show(10);
		jQuery("label[for='vbegy_post_head_background_position_x']").parent().parent().show(10);
		jQuery("label[for='vbegy_post_head_background_position_y']").parent().parent().show(10);
		jQuery("label[for='vbegy_post_head_background_full']").parent().parent().show(10);
	}else if (vbegy_what_post == "twitter") {
		jQuery("#vbegy_twitter_embed").parent().parent().show(10);
		jQuery("label[for='vbegy_post_head_background']").parent().parent().show(10);
		jQuery("label[for='vbegy_post_head_background_img']").parent().parent().show(10);
		jQuery("label[for='vbegy_post_head_background_repeat']").parent().parent().show(10);
		jQuery("label[for='vbegy_post_head_background_fixed']").parent().parent().show(10);
		jQuery("label[for='vbegy_post_head_background_position_x']").parent().parent().show(10);
		jQuery("label[for='vbegy_post_head_background_position_y']").parent().parent().show(10);
		jQuery("label[for='vbegy_post_head_background_full']").parent().parent().show(10);
	}else if (vbegy_what_post == "facebook") {
		jQuery("#vbegy_facebook_embed").parent().parent().show(10);
		jQuery("label[for='vbegy_post_head_background']").parent().parent().show(10);
		jQuery("label[for='vbegy_post_head_background_img']").parent().parent().show(10);
		jQuery("label[for='vbegy_post_head_background_repeat']").parent().parent().show(10);
		jQuery("label[for='vbegy_post_head_background_fixed']").parent().parent().show(10);
		jQuery("label[for='vbegy_post_head_background_position_x']").parent().parent().show(10);
		jQuery("label[for='vbegy_post_head_background_position_y']").parent().parent().show(10);
		jQuery("label[for='vbegy_post_head_background_full']").parent().parent().show(10);
	}
		
	var video_description = jQuery("#vpanel_video_description:checked").length;
	if (video_description == 1) {
		jQuery(".video_description").slideDown(300);
	}else {
		jQuery(".video_description").slideUp(300);
	}
	
	jQuery("#vpanel_video_description").click(function () {
		var video_description_c = jQuery("#vpanel_video_description:checked").length;
		if (video_description_c == 1) {
			jQuery(".video_description").slideDown(300);
		}else {
			jQuery(".video_description").slideUp(300);
		}
	});
	
	var page_style = jQuery("#vbegy_page_style").val();
	if (page_style == "style_2") {
		jQuery("#vbegy_post_icon").parent().parent().show(10);
	}else {
		jQuery("#vbegy_post_icon").parent().parent().hide(10);
	}
	jQuery("#vbegy_page_style").change(function () {
		var page_style = jQuery(this).val();
		if (page_style == "style_2") {
			jQuery("#vbegy_post_icon").parent().parent().slideDown(500);
		}else {
			jQuery("#vbegy_post_icon").parent().parent().slideUp(500);
		}
	});
	
	var custom_page_setting = jQuery("#vbegy_custom_page_setting:checked").length;
	if (custom_page_setting == 1) {
		jQuery("#vbegy_post_meta_s").parent().parent().show(10);
		jQuery("#vbegy_sticky_sidebar_s").parent().parent().show(10);
		jQuery("#vbegy_post_review_s").parent().parent().show(10);
		jQuery("#vbegy_post_type_s").parent().parent().show(10);
		jQuery("#vbegy_post_author_s").parent().parent().show(10);
		jQuery("#vbegy_post_share_s").parent().parent().show(10);
		jQuery("#vbegy_post_author_box_s").parent().parent().show(10);
		jQuery("#vbegy_related_post_s").parent().parent().show(10);
		jQuery("#vbegy_related_number_s").parent().parent().show(10);
		jQuery("#vbegy_excerpt_related_title_s").parent().parent().show(10);
		jQuery("#vbegy_post_comments_s").parent().parent().show(10);
		jQuery("#vbegy_post_navigation_s").parent().parent().show(10);
		jQuery("#vbegy_post_views_s").parent().parent().show(10);
	}else {
		jQuery("#vbegy_post_meta_s").parent().parent().hide(10);
		jQuery("#vbegy_sticky_sidebar_s").parent().parent().hide(10);
		jQuery("#vbegy_post_review_s").parent().parent().hide(10);
		jQuery("#vbegy_post_type_s").parent().parent().hide(10);
		jQuery("#vbegy_post_author_s").parent().parent().hide(10);
		jQuery("#vbegy_post_share_s").parent().parent().hide(10);
		jQuery("#vbegy_post_author_box_s").parent().parent().hide(10);
		jQuery("#vbegy_related_post_s").parent().parent().hide(10);
		jQuery("#vbegy_related_number_s").parent().parent().hide(10);
		jQuery("#vbegy_excerpt_related_title_s").parent().parent().hide(10);
		jQuery("#vbegy_post_comments_s").parent().parent().hide(10);
		jQuery("#vbegy_post_navigation_s").parent().parent().hide(10);
		jQuery("#vbegy_post_views_s").parent().parent().hide(10);
	}
	jQuery("#vbegy_custom_page_setting").click(function () {
		var custom_page_setting = jQuery("#vbegy_custom_page_setting:checked").length;
		if (custom_page_setting == 1) {
			jQuery("#vbegy_post_meta_s").parent().parent().slideDown(500);
			jQuery("#vbegy_sticky_sidebar_s").parent().parent().slideDown(500);
			jQuery("#vbegy_post_review_s").parent().parent().slideDown(500);
			jQuery("#vbegy_post_type_s").parent().parent().slideDown(500);
			jQuery("#vbegy_post_author_s").parent().parent().slideDown(500);
			jQuery("#vbegy_post_share_s").parent().parent().slideDown(500);
			jQuery("#vbegy_post_author_box_s").parent().parent().slideDown(500);
			jQuery("#vbegy_related_post_s").parent().parent().slideDown(500);
			jQuery("#vbegy_related_number_s").parent().parent().slideDown(500);
			jQuery("#vbegy_excerpt_related_title_s").parent().parent().slideDown(500);
			jQuery("#vbegy_post_comments_s").parent().parent().slideDown(500);
			jQuery("#vbegy_post_navigation_s").parent().parent().slideDown(500);
			jQuery("#vbegy_post_views_s").parent().parent().slideDown(500);
		}else {
			jQuery("#vbegy_post_meta_s").parent().parent().slideUp(500);
			jQuery("#vbegy_sticky_sidebar_s").parent().parent().slideUp(500);
			jQuery("#vbegy_post_review_s").parent().parent().slideUp(500);
			jQuery("#vbegy_post_type_s").parent().parent().slideUp(500);
			jQuery("#vbegy_post_author_s").parent().parent().slideUp(500);
			jQuery("#vbegy_post_share_s").parent().parent().slideUp(500);
			jQuery("#vbegy_post_author_box_s").parent().parent().slideUp(500);
			jQuery("#vbegy_related_post_s").parent().parent().slideUp(500);
			jQuery("#vbegy_related_number_s").parent().parent().slideUp(500);
			jQuery("#vbegy_excerpt_related_title_s").parent().parent().slideUp(500);
			jQuery("#vbegy_post_comments_s").parent().parent().slideUp(500);
			jQuery("#vbegy_post_navigation_s").parent().parent().slideUp(500);
			jQuery("#vbegy_post_views_s").parent().parent().slideUp(500);
		}
	});
	
	var custom_header = jQuery("#vbegy_custom_header:checked").length;
	if (custom_header == 1) {
		jQuery("label[for='vbegy_header_style']").parent().parent().show(10);
		jQuery("#vbegy_header_menu").parent().parent().show(10);
		jQuery("label[for='vbegy_header_menu_style']").parent().parent().show(10);
		jQuery("#vbegy_header_fixed").parent().parent().show(10);
		jQuery("#vbegy_header_fixed_responsive").parent().parent().show(10);
		jQuery("#vbegy_soundcloud_icon_h").parent().parent().show(10);
		jQuery("#vbegy_instagram_icon_h").parent().parent().show(10);
		jQuery("#vbegy_pinterest_icon_h").parent().parent().show(10);
		jQuery("label[for='vbegy_logo_display']").parent().parent().show(10);
		jQuery("#vbegy_logo_img").parent().parent().show(10);
		jQuery("#vbegy_retina_logo").parent().parent().show(10);
		jQuery("#vbegy_header_cart").parent().parent().show(10);
		jQuery("#vbegy_header_search").parent().parent().show(10);
		jQuery("#vbegy_header_follow").parent().parent().show(10);
		jQuery("label[for='vbegy_header_follow_style']").parent().parent().show(10);
		jQuery("label[for='vbegy_menu_header']").parent().parent().show(10);
		jQuery("#vbegy_facebook_icon_h").parent().parent().show(10);
		jQuery("#vbegy_twitter_icon_h").parent().parent().show(10);
		jQuery("#vbegy_gplus_icon_h").parent().parent().show(10);
		jQuery("#vbegy_linkedin_icon_h").parent().parent().show(10);
		jQuery("#vbegy_dribbble_icon_h").parent().parent().show(10);
		jQuery("#vbegy_youtube_icon_h").parent().parent().show(10);
		jQuery("#vbegy_vimeo_icon_h").parent().parent().show(10);
		jQuery("#vbegy_skype_icon_h").parent().parent().show(10);
		jQuery("#vbegy_flickr_icon_h").parent().parent().show(10);
		jQuery("#vbegy_breadcrumbs").parent().parent().show(10);
	}else {
		jQuery("label[for='vbegy_header_style']").parent().parent().hide(10);
		jQuery("#vbegy_header_menu").parent().parent().hide(10);
		jQuery("label[for='vbegy_header_menu_style']").parent().parent().hide(10);
		jQuery("#vbegy_header_fixed").parent().parent().hide(10);
		jQuery("#vbegy_header_fixed_responsive").parent().parent().hide(10);
		jQuery("#vbegy_soundcloud_icon_h").parent().parent().hide(10);
		jQuery("#vbegy_instagram_icon_h").parent().parent().hide(10);
		jQuery("#vbegy_pinterest_icon_h").parent().parent().hide(10);
		jQuery("label[for='vbegy_logo_display']").parent().parent().hide(10);
		jQuery("#vbegy_logo_img").parent().parent().hide(10);
		jQuery("#vbegy_retina_logo").parent().parent().hide(10);
		jQuery("#vbegy_header_cart").parent().parent().hide(10);
		jQuery("#vbegy_header_search").parent().parent().hide(10);
		jQuery("#vbegy_header_follow").parent().parent().hide(10);
		jQuery("label[for='vbegy_header_follow_style']").parent().parent().hide(10);
		jQuery("label[for='vbegy_menu_header']").parent().parent().hide(10);
		jQuery("#vbegy_facebook_icon_h").parent().parent().hide(10);
		jQuery("#vbegy_twitter_icon_h").parent().parent().hide(10);
		jQuery("#vbegy_gplus_icon_h").parent().parent().hide(10);
		jQuery("#vbegy_linkedin_icon_h").parent().parent().hide(10);
		jQuery("#vbegy_dribbble_icon_h").parent().parent().hide(10);
		jQuery("#vbegy_youtube_icon_h").parent().parent().hide(10);
		jQuery("#vbegy_vimeo_icon_h").parent().parent().hide(10);
		jQuery("#vbegy_skype_icon_h").parent().parent().hide(10);
		jQuery("#vbegy_flickr_icon_h").parent().parent().hide(10);
		jQuery("#vbegy_breadcrumbs").parent().parent().hide(10);
	}
	jQuery("#vbegy_custom_header").click(function () {
		var custom_header = jQuery("#vbegy_custom_header:checked").length;
		if (custom_header == 1) {
			jQuery("label[for='vbegy_header_style']").parent().parent().slideDown(500);
			jQuery("#vbegy_header_menu").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_header_menu_style']").parent().parent().slideDown(500);
			jQuery("#vbegy_header_fixed").parent().parent().slideDown(500);
			jQuery("#vbegy_header_fixed_responsive").parent().parent().slideDown(500);
			jQuery("#vbegy_soundcloud_icon_h").parent().parent().slideDown(500);
			jQuery("#vbegy_instagram_icon_h").parent().parent().slideDown(500);
			jQuery("#vbegy_pinterest_icon_h").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_logo_display']").parent().parent().slideDown(500);
			jQuery("#vbegy_logo_img").parent().parent().slideDown(500);
			jQuery("#vbegy_retina_logo").parent().parent().slideDown(500);
			jQuery("#vbegy_header_cart").parent().parent().slideDown(500);
			jQuery("#vbegy_header_search").parent().parent().slideDown(500);
			jQuery("#vbegy_header_follow").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_header_follow_style']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_menu_header']").parent().parent().slideDown(500);
			jQuery("#vbegy_facebook_icon_h").parent().parent().slideDown(500);
			jQuery("#vbegy_twitter_icon_h").parent().parent().slideDown(500);
			jQuery("#vbegy_gplus_icon_h").parent().parent().slideDown(500);
			jQuery("#vbegy_linkedin_icon_h").parent().parent().slideDown(500);
			jQuery("#vbegy_dribbble_icon_h").parent().parent().slideDown(500);
			jQuery("#vbegy_youtube_icon_h").parent().parent().slideDown(500);
			jQuery("#vbegy_vimeo_icon_h").parent().parent().slideDown(500);
			jQuery("#vbegy_skype_icon_h").parent().parent().slideDown(500);
			jQuery("#vbegy_flickr_icon_h").parent().parent().slideDown(500);
			jQuery("#vbegy_breadcrumbs").parent().parent().slideDown(500);
		}else {
			jQuery("label[for='vbegy_header_style']").parent().parent().slideUp(500);
			jQuery("#vbegy_header_menu").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_header_menu_style']").parent().parent().slideUp(500);
			jQuery("#vbegy_header_fixed").parent().parent().slideUp(500);
			jQuery("#vbegy_header_fixed_responsive").parent().parent().slideUp(500);
			jQuery("#vbegy_soundcloud_icon_h").parent().parent().slideUp(500);
			jQuery("#vbegy_instagram_icon_h").parent().parent().slideUp(500);
			jQuery("#vbegy_pinterest_icon_h").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_logo_display']").parent().parent().slideUp(500);
			jQuery("#vbegy_logo_img").parent().parent().slideUp(500);
			jQuery("#vbegy_retina_logo").parent().parent().slideUp(500);
			jQuery("#vbegy_header_cart").parent().parent().slideUp(500);
			jQuery("#vbegy_header_search").parent().parent().slideUp(500);
			jQuery("#vbegy_header_follow").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_header_follow_style']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_menu_header']").parent().parent().slideUp(500);
			jQuery("#vbegy_facebook_icon_h").parent().parent().slideUp(500);
			jQuery("#vbegy_twitter_icon_h").parent().parent().slideUp(500);
			jQuery("#vbegy_gplus_icon_h").parent().parent().slideUp(500);
			jQuery("#vbegy_linkedin_icon_h").parent().parent().slideUp(500);
			jQuery("#vbegy_dribbble_icon_h").parent().parent().slideUp(500);
			jQuery("#vbegy_youtube_icon_h").parent().parent().slideUp(500);
			jQuery("#vbegy_vimeo_icon_h").parent().parent().slideUp(500);
			jQuery("#vbegy_skype_icon_h").parent().parent().slideUp(500);
			jQuery("#vbegy_flickr_icon_h").parent().parent().slideUp(500);
			jQuery("#vbegy_breadcrumbs").parent().parent().slideUp(500);
		}
	});
	
	var custom_sections = jQuery("#vbegy_custom_sections:checked").length;
	if (custom_sections == 1) {
		jQuery("#sort-sections").show(10);
	}else {
		jQuery("#sort-sections").hide(10);
	}
	jQuery("#vbegy_custom_sections").click(function () {
		var custom_sections = jQuery("#vbegy_custom_sections:checked").length;
		if (custom_sections == 1) {
			jQuery("#sort-sections").slideDown(500);
		}else {
			jQuery("#sort-sections").slideUp(500);
		}
	});
	
	var vbegy_image_style = jQuery("#vbegy_image_style").val();
	if (vbegy_image_style != "default") {
		jQuery("label[for='vbegy_meta_post_position']").parent().parent().show(10);
	}else {
		jQuery("label[for='vbegy_meta_post_position']").parent().parent().hide(10);
	}
	jQuery("#vbegy_image_style").change(function () {
		var vbegy_image_style = jQuery("#vbegy_image_style").val();
		if (vbegy_image_style != "default") {
			jQuery("label[for='vbegy_meta_post_position']").parent().parent().slideDown(500);
		}else {
			jQuery("label[for='vbegy_meta_post_position']").parent().parent().slideUp(500);
		}
	});
		
	var vbegy_head_slide_background = jQuery("#vbegy_head_slide_background").val();
	if (vbegy_head_slide_background == "custom") {
		jQuery("label[for='vbegy_head_slide_background_color']").parent().parent().show(10);
		jQuery("label[for='vbegy_head_slide_background_img']").parent().parent().show(10);
		jQuery("label[for='vbegy_head_slide_background_repeat']").parent().parent().show(10);
		jQuery("label[for='vbegy_head_slide_background_fixed']").parent().parent().show(10);
		jQuery("label[for='vbegy_head_slide_background_position_x']").parent().parent().show(10);
		jQuery("label[for='vbegy_head_slide_background_position_y']").parent().parent().show(10);
		jQuery("label[for='vbegy_head_slide_background_full']").parent().parent().show(10);
	}else {
		jQuery("label[for='vbegy_head_slide_background_color']").parent().parent().hide(10);
		jQuery("label[for='vbegy_head_slide_background_img']").parent().parent().hide(10);
		jQuery("label[for='vbegy_head_slide_background_repeat']").parent().parent().hide(10);
		jQuery("label[for='vbegy_head_slide_background_fixed']").parent().parent().hide(10);
		jQuery("label[for='vbegy_head_slide_background_position_x']").parent().parent().hide(10);
		jQuery("label[for='vbegy_head_slide_background_position_y']").parent().parent().hide(10);
		jQuery("label[for='vbegy_head_slide_background_full']").parent().parent().hide(10);
	}
	
	jQuery("#vbegy_head_slide_background").change(function () {
		var vbegy_head_slide_background = jQuery(this).val();
		
		if (vbegy_head_slide_background == "custom") {
			jQuery("label[for='vbegy_head_slide_background_color']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_head_slide_background_img']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_head_slide_background_repeat']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_head_slide_background_fixed']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_head_slide_background_position_x']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_head_slide_background_position_y']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_head_slide_background_full']").parent().parent().slideDown(500);
		}else {
			jQuery("label[for='vbegy_head_slide_background_color']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_head_slide_background_img']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_head_slide_background_repeat']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_head_slide_background_fixed']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_head_slide_background_position_x']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_head_slide_background_position_y']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_head_slide_background_full']").parent().parent().slideUp(500);
		}
	});
	
	var vbegy_review_display = jQuery("#vbegy_review_display:checked").val();
	if (vbegy_review_display == 1) {
		jQuery("#vbegy_ratings_post").parent().show(10);
		jQuery("#vbegy_review_type").parent().parent().parent().show(10);
		jQuery("#vbegy_final_review").parent().parent().show(10);
		jQuery("#vbegy_review_title").parent().parent().show(10);
		jQuery("#vbegy_brief_summary").parent().parent().show(10);
		jQuery("#vbegy_review_summary").parent().parent().show(10);
		jQuery("#vbegy_review_position").parent().parent().parent().show(10);
	}else {
		jQuery("#vbegy_ratings_post").parent().hide(10);
		jQuery("#vbegy_review_type").parent().parent().parent().hide(10);
		jQuery("#vbegy_final_review").parent().parent().hide(10);
		jQuery("#vbegy_review_title").parent().parent().hide(10);
		jQuery("#vbegy_brief_summary").parent().parent().hide(10);
		jQuery("#vbegy_review_summary").parent().parent().hide(10);
		jQuery("#vbegy_review_position").parent().parent().parent().hide(10);
	}
	jQuery("#vbegy_review_display").click(function () {
		var vbegy_review_display = jQuery("#vbegy_review_display:checked").val();
		if (vbegy_review_display == 1) {
			jQuery("#vbegy_ratings_post").parent().slideDown(500);
			jQuery("#vbegy_review_type").parent().parent().parent().slideDown(500);
			jQuery("#vbegy_final_review").parent().parent().slideDown(500);
			jQuery("#vbegy_review_title").parent().parent().slideDown(500);
			jQuery("#vbegy_brief_summary").parent().parent().slideDown(500);
			jQuery("#vbegy_review_summary").parent().parent().slideDown(500);
			jQuery("#vbegy_review_position").parent().parent().parent().slideDown(500);
		}else {
			jQuery("#vbegy_ratings_post").parent().slideUp(500);
			jQuery("#vbegy_review_type").parent().parent().parent().slideUp(500);
			jQuery("#vbegy_final_review").parent().parent().slideUp(500);
			jQuery("#vbegy_review_title").parent().parent().slideUp(500);
			jQuery("#vbegy_brief_summary").parent().parent().slideUp(500);
			jQuery("#vbegy_review_summary").parent().parent().slideUp(500);
			jQuery("#vbegy_review_position").parent().parent().parent().slideUp(500);
		}
	});
	
	/* Page template */
	
	var page_template = jQuery("#page_template").val();
	if (page_template == "template-contact_us.php") {
		jQuery("#contact_us").show(10);
	}else {
		jQuery("#contact_us").hide(10);
	}
	
	if (page_template == "template-blog.php") {
		jQuery("#blog").show(10);
	}else {
		jQuery("#blog").hide(10);
	}
	
	if (page_template == "template-portfolio.php") {
		jQuery("#portfolio_meta").show(10);
	}else {
		jQuery("#portfolio_meta").hide(10);
	}
	
	jQuery("#page_template").change(function () {
		var page_template = jQuery(this).val();
		
		if (page_template == "template-contact_us.php") {
			jQuery("#contact_us").show(10);
			jQuery("#blog").hide(10);
			jQuery("#portfolio_meta").hide(10);
		}else if (page_template == "template-blog.php") {
			jQuery("#blog").show(10);
			jQuery("#contact_us").hide(10);
			jQuery("#portfolio_meta").hide(10);
		}else if (page_template == "template-portfolio.php") {
			jQuery("#portfolio_meta").show(10);
			jQuery("#contact_us").hide(10);
			jQuery("#blog").hide(10);
		}else {
			jQuery("#blog").hide(10);
			jQuery("#contact_us").hide(10);
			jQuery("#portfolio_meta").hide(10);
		}
	});
	
	if (jQuery(".rwmb-input input[value='style_4'][name='vbegy_post_style']:checked").length == 1 || jQuery(".rwmb-input input[value='style_5'][name='vbegy_post_style']:checked").length == 1 || jQuery(".rwmb-input input[value='style_6'][name='vbegy_post_style']:checked").length == 1) {
		jQuery("#vbegy_post_author").parent().parent().hide(10);
		jQuery("#vbegy_post_type").parent().parent().hide(10);
		jQuery("#vbegy_post_share").parent().parent().hide(10);
	}else {
		jQuery("#vbegy_post_author").parent().parent().show(10);
		jQuery("#vbegy_post_type").parent().parent().show(10);
		jQuery("#vbegy_post_share").parent().parent().show(10);
	}
	
	if (jQuery(".rwmb-input input[value='portfolio_style'][name='vbegy_post_style']:checked").length == 1) {
		jQuery("#vbegy_post_author").parent().parent().hide(10);
		jQuery("#vbegy_post_type").parent().parent().hide(10);
		jQuery("#vbegy_post_share").parent().parent().hide(10);
		jQuery("#vbegy_post_meta").parent().parent().hide(10);
		jQuery("#vbegy_post_views").parent().parent().hide(10);
		jQuery("#vbegy_post_columns").parent().parent().parent().show(10);
		jQuery("#vbegy_post_portfolio_type").parent().parent().parent().show(10);
		jQuery("#vbegy_post_margin").parent().parent().parent().show(10);
		jQuery("#vbegy_post_options").parent().parent().parent().show(10);
	}else {
		jQuery("#vbegy_post_author").parent().parent().show(10);
		jQuery("#vbegy_post_type").parent().parent().show(10);
		jQuery("#vbegy_post_share").parent().parent().show(10);
		jQuery("#vbegy_post_meta").parent().parent().show(10);
		jQuery("#vbegy_post_views").parent().parent().show(10);
		jQuery("#vbegy_post_columns").parent().parent().parent().hide(10);
		jQuery("#vbegy_post_portfolio_type").parent().parent().parent().hide(10);
		jQuery("#vbegy_post_margin").parent().parent().parent().hide(10);
		jQuery("#vbegy_post_options").parent().parent().parent().hide(10);
	}
	
	if (jQuery(".rwmb-input input[value='style_2'][name='vbegy_post_style']:checked").length == 1) {
		jQuery("#vbegy_post_author").parent().parent().hide(10);
		jQuery("#vbegy_post_type").parent().parent().hide(10);
	}
	
	if (jQuery(".rwmb-input input[value='style_3'][name='vbegy_post_style']:checked").length == 1) {
		jQuery("#vbegy_post_share").parent().parent().hide(10);
		jQuery("#vbegy_post_author").parent().parent().hide(10);
		jQuery("#vbegy_post_type").parent().parent().hide(10);
	}
	
	if (jQuery(".rwmb-input input[value='style_4'][name='vbegy_post_style']:checked").length == 1) {
		jQuery("#vbegy_post_share").parent().parent().hide(10);
		jQuery("#vbegy_post_author").parent().parent().hide(10);
		jQuery("#vbegy_post_type").parent().parent().hide(10);
		jQuery("#vbegy_post_views").parent().parent().hide(10);
	}
	
	if (jQuery(".rwmb-input input[value='style_5'][name='vbegy_post_style']:checked").length == 1 || jQuery(".rwmb-input input[value='style_6'][name='vbegy_post_style']:checked").length == 1) {
		jQuery("#vbegy_post_share").parent().parent().hide(10);
		jQuery("#vbegy_post_author").parent().parent().hide(10);
		jQuery("#vbegy_post_type").parent().parent().hide(10);
		jQuery("#vbegy_post_views").parent().parent().hide(10);
	}
	
	jQuery(".rwmb-input input[value='style_1'][name='vbegy_post_style'],.rwmb-input input[value='style_7'][name='vbegy_post_style']").click(function () {
		jQuery("#vbegy_post_author").parent().parent().slideDown(500);
		jQuery("#vbegy_post_type").parent().parent().slideDown(500);
		jQuery("#vbegy_post_share").parent().parent().slideDown(500);
		jQuery("#vbegy_post_columns").parent().parent().parent().slideUp(500);
		jQuery("#vbegy_post_portfolio_type").parent().parent().parent().slideUp(500);
		jQuery("#vbegy_post_margin").parent().parent().parent().slideUp(500);
		jQuery("#vbegy_post_options").parent().parent().parent().slideUp(500);
		jQuery("#vbegy_post_meta").parent().parent().slideDown(500);
		jQuery("#vbegy_post_views").parent().parent().slideDown(500);
	});
	
	jQuery(".rwmb-input input[value='style_2'][name='vbegy_post_style']").click(function () {
		jQuery("#vbegy_post_author").parent().parent().slideUp(500);
		jQuery("#vbegy_post_type").parent().parent().slideUp(500);
		jQuery("#vbegy_post_share").parent().parent().slideDown(500);
		jQuery("#vbegy_post_columns").parent().parent().parent().slideUp(500);
		jQuery("#vbegy_post_portfolio_type").parent().parent().parent().slideUp(500);
		jQuery("#vbegy_post_margin").parent().parent().parent().slideUp(500);
		jQuery("#vbegy_post_options").parent().parent().parent().slideUp(500);
		jQuery("#vbegy_post_meta").parent().parent().slideDown(500);
		jQuery("#vbegy_post_views").parent().parent().slideDown(500);
	});
	
	jQuery(".rwmb-input input[value='style_3'][name='vbegy_post_style']").click(function () {
		jQuery("#vbegy_post_views").parent().parent().slideDown(500);
	});
	
	jQuery(".rwmb-input input[value='style_3'][name='vbegy_post_style'],.rwmb-input input[value='style_4'][name='vbegy_post_style'],.rwmb-input input[value='style_5'][name='vbegy_post_style'],.rwmb-input input[value='style_6'][name='vbegy_post_style']").click(function () {
		jQuery("#vbegy_post_author").parent().parent().slideUp(500);
		jQuery("#vbegy_post_type").parent().parent().slideUp(500);
		jQuery("#vbegy_post_share").parent().parent().slideUp(500);
		jQuery("#vbegy_post_columns").parent().parent().parent().slideUp(500);
		jQuery("#vbegy_post_portfolio_type").parent().parent().parent().slideUp(500);
		jQuery("#vbegy_post_margin").parent().parent().parent().slideUp(500);
		jQuery("#vbegy_post_options").parent().parent().parent().slideUp(500);
		jQuery("#vbegy_post_meta").parent().parent().slideDown(500);
	});
	
	jQuery(".rwmb-input input[value='style_4'][name='vbegy_post_style'],.rwmb-input input[value='style_5'][name='vbegy_post_style'],.rwmb-input input[value='style_6'][name='vbegy_post_style']").click(function () {
		jQuery("#vbegy_post_views").parent().parent().slideUp(500);
	});
	
	jQuery(".rwmb-input input[value='portfolio_style'][name='vbegy_post_style']").click(function () {
		jQuery("#vbegy_post_author").parent().parent().slideUp(500);
		jQuery("#vbegy_post_type").parent().parent().slideUp(500);
		jQuery("#vbegy_post_share").parent().parent().slideUp(500);
		jQuery("#vbegy_post_meta").parent().parent().slideUp(500);
		jQuery("#vbegy_post_views").parent().parent().slideUp(500);
		jQuery("#vbegy_post_columns").parent().parent().parent().slideDown(500);
		jQuery("#vbegy_post_portfolio_type").parent().parent().parent().slideDown(500);
		jQuery("#vbegy_post_margin").parent().parent().parent().slideDown(500);
		jQuery("#vbegy_post_options").parent().parent().parent().slideDown(500);
	});
	
	if (jQuery("#vbegy_portfolio_display").val() == "multiple_categories") {
		jQuery("label[for='vbegy_multiple_categories']").parent().parent().show(10);
		jQuery("label[for='vbegy_single_category']").parent().parent().hide(10);
	}else if (jQuery("#vbegy_portfolio_display").val() == "single_category") {
		jQuery("label[for='vbegy_single_category']").parent().parent().show(10);
		jQuery("label[for='vbegy_multiple_categories']").parent().parent().hide(10);
	}else {
		jQuery("label[for='vbegy_single_category']").parent().parent().hide(10);
		jQuery("label[for='vbegy_multiple_categories']").parent().parent().hide(10);
	}
	
	jQuery("#vbegy_portfolio_display").change(function () {
		if (jQuery(this).val() == "multiple_categories") {
			jQuery("label[for='vbegy_multiple_categories']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_single_category']").parent().parent().slideUp(500);
		}else if (jQuery(this).val() == "single_category") {
			jQuery("label[for='vbegy_single_category']").parent().parent().slideDown(500);
			jQuery("label[for='vbegy_multiple_categories']").parent().parent().slideUp(500);
		}else {
			jQuery("label[for='vbegy_single_category']").parent().parent().slideUp(500);
			jQuery("label[for='vbegy_multiple_categories']").parent().parent().slideUp(500);
		}
	});
	
	var head_slide_background = jQuery("#head_slide_background").val();
	if (head_slide_background == "custom") {
		jQuery("#section-head_slide_custom_background").show(10);
		jQuery("#section-head_slide_full_screen_background").show(10);
	}else {
		jQuery("#section-head_slide_custom_background").hide(10);
		jQuery("#section-head_slide_full_screen_background").hide(10);
	}
	
	jQuery("#head_slide_background").change(function () {
		var head_slide_background = jQuery(this).val();
		
		if (head_slide_background == "custom") {
			jQuery("#section-head_slide_custom_background").slideDown(500);
			jQuery("#section-head_slide_full_screen_background").slideDown(500);
		}else {
			jQuery("#section-head_slide_custom_background").slideUp(500);
			jQuery("#section-head_slide_full_screen_background").slideUp(500);
		}
	});
	
    /* Header advertising */
    
    if (jQuery("#"+vpanel_name+"-header_adv_type_1-custom_image:checked").length > 0 && jQuery("#"+vpanel_name+"-header_adv_type_1-display_code:checked").length == 0) {
    	jQuery("#header_adv_img_1").parent().parent().parent().slideDown(500);
    	jQuery("#header_adv_href_1").parent().parent().parent().slideDown(500);
    	jQuery("#header_adv_code_1").parent().parent().parent().hide(10);
    }else if (jQuery("#"+vpanel_name+"-header_adv_type_1-display_code:checked").length > 0 && jQuery("#"+vpanel_name+"-header_adv_type_1-custom_image:checked").length == 0) {
    	jQuery("#header_adv_code_1").parent().parent().parent().slideDown(500);
    	jQuery("#header_adv_img_1").parent().parent().parent().hide(10);
    	jQuery("#header_adv_href_1").parent().parent().parent().hide(10);
    }
    jQuery("#"+vpanel_name+"-header_adv_type_1-custom_image").click(function () {
    	jQuery("#header_adv_img_1").parent().parent().parent().slideDown(500);
    	jQuery("#header_adv_href_1").parent().parent().parent().slideDown(500);
    	jQuery("#header_adv_code_1").parent().parent().parent().slideUp(500);
    });
    jQuery("#"+vpanel_name+"-header_adv_type_1-display_code").click(function () {
    	jQuery("#header_adv_img_1").parent().parent().parent().slideUp(500);
    	jQuery("#header_adv_href_1").parent().parent().parent().slideUp(500);
    	jQuery("#header_adv_code_1").parent().parent().parent().slideDown(500);
    });
    
    if (jQuery(".rwmb-input input[value='custom_image'][name='vbegy_header_adv_type_1']:checked").length > 0 && jQuery(".rwmb-input input[value='display_code'][name='vbegy_header_adv_type_1']:checked").length == 0) {
    	jQuery("#vbegy_header_adv_img_1").parent().parent().slideDown(500);
    	jQuery("#vbegy_header_adv_href_1").parent().parent().slideDown(500);
    	jQuery("#vbegy_header_adv_code_1").parent().parent().hide(10);
    }else if (jQuery(".rwmb-input input[value='display_code'][name='vbegy_header_adv_type_1']:checked").length > 0 && jQuery(".rwmb-input input[value='custom_image'][name='vbegy_header_adv_type_1']:checked").length == 0) {
    	jQuery("#vbegy_header_adv_code_1").parent().parent().slideDown(500);
    	jQuery("#vbegy_header_adv_img_1").parent().parent().hide(10);
    	jQuery("#vbegy_header_adv_href_1").parent().parent().hide(10);
    }
    jQuery(".rwmb-input input[value='custom_image'][name='vbegy_header_adv_type_1']").click(function () {
    	jQuery("#vbegy_header_adv_img_1").parent().parent().slideDown(500);
    	jQuery("#vbegy_header_adv_href_1").parent().parent().slideDown(500);
    	jQuery("#vbegy_header_adv_code_1").parent().parent().slideUp(500);
    });
    jQuery(".rwmb-input input[value='display_code'][name='vbegy_header_adv_type_1']").click(function () {
    	jQuery("#vbegy_header_adv_img_1").parent().parent().slideUp(500);
    	jQuery("#vbegy_header_adv_href_1").parent().parent().slideUp(500);
    	jQuery("#vbegy_header_adv_code_1").parent().parent().slideDown(500);
    });
    
    if (jQuery("#"+vpanel_name+"-header_adv_type_3-custom_image:checked").length > 0 && jQuery("#"+vpanel_name+"-header_adv_type_3-display_code:checked").length == 0) {
    	jQuery("#header_adv_img_3").parent().parent().parent().slideDown(500);
    	jQuery("#header_adv_href_3").parent().parent().parent().slideDown(500);
    	jQuery("#header_adv_code_3").parent().parent().parent().hide(10);
    }else if (jQuery("#"+vpanel_name+"-header_adv_type_3-display_code:checked").length > 0 && jQuery("#"+vpanel_name+"-header_adv_type_3-custom_image:checked").length == 0) {
    	jQuery("#header_adv_code_3").parent().parent().parent().slideDown(500);
    	jQuery("#header_adv_img_3").parent().parent().parent().hide(10);
    	jQuery("#header_adv_href_3").parent().parent().parent().hide(10);
    }
    jQuery("#"+vpanel_name+"-header_adv_type_3-custom_image").click(function () {
    	jQuery("#header_adv_img_3").parent().parent().parent().slideDown(500);
    	jQuery("#header_adv_href_3").parent().parent().parent().slideDown(500);
    	jQuery("#header_adv_code_3").parent().parent().parent().slideUp(500);
    });
    jQuery("#"+vpanel_name+"-header_adv_type_3-display_code").click(function () {
    	jQuery("#header_adv_img_3").parent().parent().parent().slideUp(500);
    	jQuery("#header_adv_href_3").parent().parent().parent().slideUp(500);
    	jQuery("#header_adv_code_3").parent().parent().parent().slideDown(500);
    });
    
    if (jQuery("#"+vpanel_name+"-header_adv_type-custom_image:checked").length > 0 && jQuery("#"+vpanel_name+"-header_adv_type-display_code:checked").length == 0) {
    	jQuery("#header_adv_img").parent().parent().parent().slideDown(500);
    	jQuery("#header_adv_href").parent().parent().parent().slideDown(500);
    	jQuery("#header_adv_code").parent().parent().parent().hide(10);
    }else if (jQuery("#"+vpanel_name+"-header_adv_type-display_code:checked").length > 0 && jQuery("#"+vpanel_name+"-header_adv_type-custom_image:checked").length == 0) {
    	jQuery("#header_adv_code").parent().parent().parent().slideDown(500);
    	jQuery("#header_adv_img").parent().parent().parent().hide(10);
    	jQuery("#header_adv_href").parent().parent().parent().hide(10);
    }
    jQuery("#"+vpanel_name+"-header_adv_type-custom_image").click(function () {
    	jQuery("#header_adv_img").parent().parent().parent().slideDown(500);
    	jQuery("#header_adv_href").parent().parent().parent().slideDown(500);
    	jQuery("#header_adv_code").parent().parent().parent().slideUp(500);
    });
    jQuery("#"+vpanel_name+"-header_adv_type-display_code").click(function () {
    	jQuery("#header_adv_img").parent().parent().parent().slideUp(500);
    	jQuery("#header_adv_href").parent().parent().parent().slideUp(500);
    	jQuery("#header_adv_code").parent().parent().parent().slideDown(500);
    });
    
    
	if (jQuery(".rwmb-input input[value='custom_image'][name='vbegy_header_adv_type']:checked").length > 0 && jQuery(".rwmb-input input[value='display_code'][name='vbegy_header_adv_type']:checked").length == 0) {
		jQuery("#vbegy_header_adv_img").parent().parent().slideDown(500);
		jQuery("#vbegy_header_adv_href").parent().parent().slideDown(500);
		jQuery("#vbegy_header_adv_code").parent().parent().hide(10);
	}else if (jQuery(".rwmb-input input[value='display_code'][name='vbegy_header_adv_type']:checked").length > 0 && jQuery(".rwmb-input input[value='custom_image'][name='vbegy_header_adv_type']:checked").length == 0) {
		jQuery("#vbegy_header_adv_code").parent().parent().slideDown(500);
		jQuery("#vbegy_header_adv_img").parent().parent().hide(10);
		jQuery("#vbegy_header_adv_href").parent().parent().hide(10);
	}
    jQuery(".rwmb-input input[value='custom_image'][name='vbegy_header_adv_type']").click(function () {
    	jQuery("#vbegy_header_adv_img").parent().parent().slideDown(500);
    	jQuery("#vbegy_header_adv_href").parent().parent().slideDown(500);
    	jQuery("#vbegy_header_adv_code").parent().parent().slideUp(500);
    });
    jQuery(".rwmb-input input[value='display_code'][name='vbegy_header_adv_type']").click(function () {
    	jQuery("#vbegy_header_adv_img").parent().parent().slideUp(500);
    	jQuery("#vbegy_header_adv_href").parent().parent().slideUp(500);
    	jQuery("#vbegy_header_adv_code").parent().parent().slideDown(500);
    });
    
    /* Share advertising */
    
    if (jQuery("#"+vpanel_name+"-share_adv_type-custom_image:checked").length > 0 && jQuery("#"+vpanel_name+"-share_adv_type-display_code:checked").length == 0) {
    	jQuery("#share_adv_img").parent().parent().parent().slideDown(500);
    	jQuery("#share_adv_href").parent().parent().parent().slideDown(500);
    	jQuery("#share_adv_code").parent().parent().parent().hide(10);
    }else if (jQuery("#"+vpanel_name+"-share_adv_type-display_code:checked").length > 0 && jQuery("#"+vpanel_name+"-share_adv_type-custom_image:checked").length == 0) {
    	jQuery("#share_adv_code").parent().parent().parent().slideDown(500);
    	jQuery("#share_adv_img").parent().parent().parent().hide(10);
    	jQuery("#share_adv_href").parent().parent().parent().hide(10);
    }
    jQuery("#"+vpanel_name+"-share_adv_type-custom_image").click(function () {
    	jQuery("#share_adv_img").parent().parent().parent().slideDown(500);
    	jQuery("#share_adv_href").parent().parent().parent().slideDown(500);
    	jQuery("#share_adv_code").parent().parent().parent().slideUp(500);
    });
    jQuery("#"+vpanel_name+"-share_adv_type-display_code").click(function () {
    	jQuery("#share_adv_img").parent().parent().parent().slideUp(500);
    	jQuery("#share_adv_href").parent().parent().parent().slideUp(500);
    	jQuery("#share_adv_code").parent().parent().parent().slideDown(500);
    });
    
    
    if (jQuery(".rwmb-input input[value='custom_image'][name='vbegy_share_adv_type']:checked").length > 0 && jQuery(".rwmb-input input[value='display_code'][name='vbegy_share_adv_type']:checked").length == 0) {
    	jQuery("#vbegy_share_adv_img").parent().parent().slideDown(500);
    	jQuery("#vbegy_share_adv_href").parent().parent().slideDown(500);
    	jQuery("#vbegy_share_adv_code").parent().parent().hide(10);
    }else if (jQuery(".rwmb-input input[value='display_code'][name='vbegy_share_adv_type']:checked").length > 0 && jQuery(".rwmb-input input[value='custom_image'][name='vbegy_share_adv_type']:checked").length == 0) {
    	jQuery("#vbegy_share_adv_code").parent().parent().slideDown(500);
    	jQuery("#vbegy_share_adv_img").parent().parent().hide(10);
    	jQuery("#vbegy_share_adv_href").parent().parent().hide(10);
    }
    jQuery(".rwmb-input input[value='custom_image'][name='vbegy_share_adv_type']").click(function () {
    	jQuery("#vbegy_share_adv_img").parent().parent().slideDown(500);
    	jQuery("#vbegy_share_adv_href").parent().parent().slideDown(500);
    	jQuery("#vbegy_share_adv_code").parent().parent().slideUp(500);
    });
    jQuery(".rwmb-input input[value='display_code'][name='vbegy_share_adv_type']").click(function () {
    	jQuery("#vbegy_share_adv_img").parent().parent().slideUp(500);
    	jQuery("#vbegy_share_adv_href").parent().parent().slideUp(500);
    	jQuery("#vbegy_share_adv_code").parent().parent().slideDown(500);
    });
    
    /* Content advertising */
    
    if (jQuery("#"+vpanel_name+"-content_adv_type-custom_image:checked").length > 0 && jQuery("#"+vpanel_name+"-content_adv_type-display_code:checked").length == 0) {
    	jQuery("#content_adv_img").parent().parent().parent().slideDown(500);
    	jQuery("#content_adv_href").parent().parent().parent().slideDown(500);
    	jQuery("#content_adv_code").parent().parent().parent().hide(10);
    }else if (jQuery("#"+vpanel_name+"-content_adv_type-display_code:checked").length > 0 && jQuery("#"+vpanel_name+"-content_adv_type-custom_image:checked").length == 0) {
    	jQuery("#content_adv_code").parent().parent().parent().slideDown(500);
    	jQuery("#content_adv_img").parent().parent().parent().hide(10);
    	jQuery("#content_adv_href").parent().parent().parent().hide(10);
    }
    jQuery("#"+vpanel_name+"-content_adv_type-custom_image").click(function () {
    	jQuery("#content_adv_img").parent().parent().parent().slideDown(500);
    	jQuery("#content_adv_href").parent().parent().parent().slideDown(500);
    	jQuery("#content_adv_code").parent().parent().parent().slideUp(500);
    });
    jQuery("#"+vpanel_name+"-content_adv_type-display_code").click(function () {
    	jQuery("#content_adv_img").parent().parent().parent().slideUp(500);
    	jQuery("#content_adv_href").parent().parent().parent().slideUp(500);
    	jQuery("#content_adv_code").parent().parent().parent().slideDown(500);
    });
    
    
    if (jQuery(".rwmb-input input[value='custom_image'][name='vbegy_content_adv_type']:checked").length > 0 && jQuery(".rwmb-input input[value='display_code'][name='vbegy_content_adv_type']:checked").length == 0) {
    	jQuery("#vbegy_content_adv_img").parent().parent().slideDown(500);
    	jQuery("#vbegy_content_adv_href").parent().parent().slideDown(500);
    	jQuery("#vbegy_content_adv_code").parent().parent().hide(10);
    }else if (jQuery(".rwmb-input input[value='display_code'][name='vbegy_content_adv_type']:checked").length > 0 && jQuery(".rwmb-input input[value='custom_image'][name='vbegy_content_adv_type']:checked").length == 0) {
    	jQuery("#vbegy_content_adv_code").parent().parent().slideDown(500);
    	jQuery("#vbegy_content_adv_img").parent().parent().hide(10);
    	jQuery("#vbegy_content_adv_href").parent().parent().hide(10);
    }
    jQuery(".rwmb-input input[value='custom_image'][name='vbegy_content_adv_type']").click(function () {
    	jQuery("#vbegy_content_adv_img").parent().parent().slideDown(500);
    	jQuery("#vbegy_content_adv_href").parent().parent().slideDown(500);
    	jQuery("#vbegy_content_adv_code").parent().parent().slideUp(500);
    });
    jQuery(".rwmb-input input[value='display_code'][name='vbegy_content_adv_type']").click(function () {
    	jQuery("#vbegy_content_adv_img").parent().parent().slideUp(500);
    	jQuery("#vbegy_content_adv_href").parent().parent().slideUp(500);
    	jQuery("#vbegy_content_adv_code").parent().parent().slideDown(500);
    });
    
});