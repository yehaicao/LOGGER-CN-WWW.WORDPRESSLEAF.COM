jQuery(function() {
	jQuery(".builder_select").live('mouseup',function () {
		jQuery(this).select();
	});
	
	function builder_label_key() {
		jQuery(".builder_box_display").each(function () {
			var builder_box_display = jQuery(this);
			if (builder_box_display.val() == "category") {
				builder_box_display.parent().parent().parent().find(".label_category").slideDown(500);
				builder_box_display.parent().parent().parent().find(".label_categories").hide(10);
			}else if (builder_box_display.val() == "categories") {
				builder_box_display.parent().parent().parent().find(".label_categories").slideDown(500);
					builder_box_display.parent().parent().parent().find(".label_category").hide(10);
			}else {
				builder_box_display.parent().parent().parent().find(".label_category").slideUp(500);
				builder_box_display.parent().parent().parent().find(".label_categories").slideUp(500);
			}
			builder_box_display.change(function () {
				var builder_box_display_s = jQuery(this);
				if (builder_box_display_s.val() == "category") {
					builder_box_display_s.parent().parent().parent().find(".label_category").slideDown(500);
					builder_box_display_s.parent().parent().parent().find(".label_categories").hide(10);
				}else if (builder_box_display_s.val() == "categories") {
					builder_box_display_s.parent().parent().parent().find(".label_categories").slideDown(500);
						builder_box_display_s.parent().parent().parent().find(".label_category").hide(10);
				}else {
					builder_box_display_s.parent().parent().parent().find(".label_category").slideUp(500);
					builder_box_display_s.parent().parent().parent().find(".label_categories").slideUp(500);
				}
			});
		});
		jQuery(".builder_label_key").each(function () {
			var builder_label_key = jQuery(this);
			var widget_head_span = builder_label_key.parent().parent().parent().find(".widget-head > span > span");
			builder_label_key.parent().parent().parent().find(".builder_box_display").change(function () {
				if (builder_label_key.val() == "" && builder_label_key.parent().parent().parent().find(".builder_select_name").length > 0 && builder_label_key.parent().parent().parent().find(".builder_box_display").val() == "category") {
					widget_head_span.text(builder_label_key.parent().parent().parent().find(".builder_select_name option:selected").text());
				}
			});
			builder_label_key.keyup(function () {
				widget_head_span.text(builder_label_key.val());
				if (builder_label_key.val() == "" && builder_label_key.parent().parent().parent().find(".builder_select_name").length > 0 && builder_label_key.parent().parent().parent().find(".builder_box_display").val() == "category") {
					widget_head_span.text(builder_label_key.parent().parent().parent().find(".builder_select_name option:selected").text());
					builder_label_key.parent().parent().parent().find(".builder_select_name").change(function () {
						if (builder_label_key.val() == "" && builder_label_key.parent().parent().parent().find(".builder_select_name").length > 0 && builder_label_key.parent().parent().parent().find(".builder_box_display").val() == "category") {
							widget_head_span.text(builder_label_key.parent().parent().parent().find(".builder_select_name option:selected").text());
						}
					});
				}
			});
		});
	}
	
	function checkbox_select() {
		jQuery(".checkbox_select").each(function () {
			var checkbox_select = jQuery(this);
			jQuery("input:checked",checkbox_select).parent().addClass("selected");
			var input_r = checkbox_select.parent().find('input:checked');
			if (input_r.val() != undefined) {
				input_r.parent().addClass("selected");
				input_r.parent().find(":radio").attr("checked","checked");
			}
			checkbox_select.find(".checkbox-select").live("click",function () {
				jQuery(this).parent().parent().find(":radio").removeAttr('checked');
				jQuery(this).parent().parent().find("li").removeClass("selected");
				jQuery(this).parent().addClass("selected");
				jQuery(this).parent().find(":radio").attr("checked","checked");
				return false;
			});
		});
	}
	
	function checkbox_checkbox() {
		jQuery(".checkbox_checkbox").each(function () {
			var checkbox_checkbox = jQuery(this);
			jQuery("input:checked",checkbox_checkbox).parent().addClass("selected");
			checkbox_checkbox.find(".checkbox-select").click(function () {
				jQuery(this).parent().toggleClass("selected");
				jQuery(this).parent().find(":checkbox").attr('checked', !jQuery(this).parent().find(":checkbox").attr('checked'));
				return false;
			});
		});
	}
	
	function checkbox_checkbox_id(id) {
		jQuery("#"+id+" input:checked").parent().addClass("selected");
		jQuery("#"+id+" .checkbox-select").live("click" , function() {
			var input_c = jQuery(this).parent().find(':checkbox');
			input_c.attr('checked', !input_c.attr('checked'));
			jQuery(this).parent().toggleClass("selected");
			return false;
		});
	}
	
	function uploaded_image() {
		jQuery(".adv-label").each(function () {
			var adv_label = jQuery(this);
			if (jQuery("input[type='radio']:checked",adv_label).val() == "custom_image") {
				jQuery(".image-url",adv_label.parent()).show(10);
				jQuery(".adv-url",adv_label.parent()).show(10);
				jQuery(".adv-code",adv_label.parent()).hide(10);
			}else if (jQuery("input[type='radio']:checked",adv_label).val() == "display_code") {
				jQuery(".image-url",adv_label.parent()).hide(10);
				jQuery(".adv-url",adv_label.parent()).hide(10);
				jQuery(".adv-code",adv_label.parent()).show(10);
			}
			jQuery("input[type='radio']",adv_label).click(function () {
				if (jQuery(this).val() == "custom_image") {
					jQuery(".image-url",jQuery(this).parent().parent()).slideDown(500);
					jQuery(".adv-url",jQuery(this).parent().parent()).slideDown(500);
					jQuery(".adv-code",jQuery(this).parent().parent()).slideUp(500);
				}else if (jQuery(this).val() == "display_code") {
					jQuery(".image-url",jQuery(this).parent().parent()).slideUp(500);
					jQuery(".adv-url",jQuery(this).parent().parent()).slideUp(500);
					jQuery(".adv-code",jQuery(this).parent().parent()).slideDown(500);
				}
			});
		});
	}
	
	function rating_score() {
		jQuery(".rating_score").each(function () {
			jQuery("#vbegy_final_review").attr("readonly","readonly");
			jQuery(this).keyup(function () {
				var rating = jQuery(this);
				var rating_val = rating.val();
				var intRegex = /^\d+$/;
				if (intRegex.test(rating_val)) {
					if (rating_val <= 10) {
						var percent = rating_val * 10;
						rating.parent().find(".preview_rating_em").text(" (" +percent + "%)");
						var final_score = 0;
						var item_length = rating.parent().parent().parent().parent().find(" > li .rating_score");
						
						for(var i=0;i<item_length.length;i++) {
				            final_score += parseInt(item_length[i].value);
						}
						
						final_score = final_score / item_length.length;
						final_score = Math.round(final_score*5)/5;
						percentage = final_score * 10;
						
						jQuery("#vbegy_final_review").val(final_score);		
						jQuery("#vbegy_final_review_description > em").text(percentage);
					}else {
						rating.parent().find(".preview_rating_em").text("This number is maximal than 10");
					}
				}else {
					rating.parent().find(".preview_rating_em").text("Sorry not integer");
				}
			});
		});
		var init_rating = jQuery("#vbegy_final_review").val();
		init_percentage = init_rating * 10;
		jQuery("#vbegy_final_review_description > em").text(init_percentage);
	}
	
    jQuery("#builder").sortable({placeholder: "ui-state-highlight"});
	
	jQuery(".builder-toggle-open").live("click" ,function () {
		jQuery(this).parent().parent().find(".widget-content").slideToggle(300);
		jQuery(this).css("display","none");
		jQuery(this).parent().find(".builder-toggle-close").css("display","block");
    });

	jQuery(".builder-toggle-close").live("click" ,function () {
		jQuery(this).parent().parent().find(".widget-content").slideToggle("fast");
		jQuery(this).css("display","none");
		jQuery(this).parent().find(".builder-toggle-open").css("display","block");
    });
    
    jQuery("#expand-all .expand-all").live("click" ,function () {
    	jQuery(".widget-content").slideDown(300);
    	jQuery(".builder-toggle-close").css("display","block");
    	jQuery(".builder-toggle-open").css("display","none");
    	jQuery(".expand-all").css("display","none");
    	jQuery(".expand-all2").css("display","block");
    });
    
    jQuery("#expand-all .expand-all2").live("click" ,function () {
    	jQuery(".widget-content").slideUp(300);
    	jQuery(".builder-toggle-close").css("display","none");
    	jQuery(".builder-toggle-open").css("display","block");
    	jQuery(".expand-all").css("display","block");
    	jQuery(".expand-all2").css("display","none");
    });
    
    jQuery("#sidebar_add").click(function() {
		var sidebar_name = jQuery('#sidebar_name').val();
		if (sidebar_name != "" ) {
			if( sidebar_name.length > 0){
				jQuery('#sidebars_list').append('<li><div class="widget-head">'+sidebar_name+' <input id="sidebars" name="sidebars[]" type="hidden" value="'+sidebar_name+'"><a class="del-builder-item del-sidebar-item">x</a></div></li>');
			}
		}else {
			alert("Please write the name !");
		}
		jQuery('#sidebar_name').val("");

	});
    
	var categories_select  = jQuery('#categories_select').html();
	var product_cat_select = jQuery('#product_cat').html();
	jQuery(".add-item").live("click" , function() {
		var builder_item = jQuery(this).attr("add-item");
		if (builder_item == "add_slide") {
			jQuery('#vbegy_slideshow_post ul').append('<li id="builder_slide_'+ builder_slide_j +'" class="ui-state-default"><div class="widget-head text"><span class="vpanel'+ builder_slide_j +'">Slide item - '+ builder_slide_j +'</span><a class="builder-toggle-open" style="display:none">+</a><a class="builder-toggle-close" style="display:block">-</a></div><div class="widget-content" style="display:block"><label for="builder_slide_item['+ builder_slide_j +'][image_url]"><span>Image URL :</span><input id="builder_slide_item['+ builder_slide_j +'][image_url]" name="builder_slide_item['+ builder_slide_j +'][image_url]" placeholder="No file chosen" type="text" class="upload upload_image_'+ builder_slide_j +'"><input class="upload_image_button button upload-button-2" rel="'+ builder_slide_j +'" type="button" value="Upload"><input type="hidden" class="image_id" name="builder_slide_item['+ builder_slide_j +'][image_id]" value=""><div class="clear"></div></label><label for="builder_slide_item['+ builder_slide_j +'][slide_link]"><span>Slide Link :</span><input id="builder_slide_item['+ builder_slide_j +'][slide_link]" name="builder_slide_item['+ builder_slide_j +'][slide_link]" value="#" type="text"></label></div><a class="del-builder-item">x</a></li>');
		}
		if (builder_item == "slideshow") {
			jQuery('#builder').append('<li id="builder_'+ builder_j +'" class="ui-state-default"><div class="widget-head text"><span class="vpanel'+ builder_j +'">Slideshow - <span>Slideshow title</span></span><a class="builder-toggle-open" style="display:none">+</a><a class="builder-toggle-close" style="display:block">-</a></div><div class="widget-content" style="display:block"><label for="builder_item['+ builder_j +'][box_title]"><span>Slideshow title :</span><input id="builder_item['+ builder_j +'][box_title]" class="builder_label_key" name="builder_item['+ builder_j +'][box_title]" value="Slideshow title" type="text"></label><label for="builder_item['+ builder_j +'][box_posts_num]"><span>Number of posts :</span><input id="builder_item['+ builder_j +'][box_posts_num]" name="builder_item['+ builder_j +'][box_posts_num]" value="5" type="text"></label><label for="builder_item['+ builder_j +'][box_display]"><span>Display :</span><div class="styled-select"> <select class="builder_box_display" id="builder_item['+ builder_j +'][box_display]" name="builder_item['+ builder_j +'][box_display]"><option value="">Latest Posts</option><option value="category">Single Category</option><option value="categories">Multiple categories</option></select></div></label><label class="label_category" for="builder_item['+ builder_j +'][box_cats]"><span>Category :</span><div class="styled-select"><select class="builder_select_name" class="builder_select_name" id="builder_item['+ builder_j +'][box_cats]" name="builder_item['+ builder_j +'][box_cats]">'+ categories_select +'</select></div></label><label class="label_categories" for="builder_item['+ builder_j +'][categories]"><span>Categories :</span><select multiple="multiple" id="builder_item['+ builder_j +'][categories][]" name="builder_item['+ builder_j +'][categories][]">'+ categories_select +'</select><div class="clear"></div></label><label for="builder_item['+ builder_j +'][slide_overlay]"><span>Slideshow overlay :</span><div class="styled-select"><select id="builder_item['+ builder_j +'][slide_overlay]" name="builder_item['+ builder_j +'][slide_overlay]"><option value="enable">Enable</option><option value="title">Show title only</option><option value="disable">Disable</option></select></div></label><label for="builder_item['+ builder_j +'][excerpt_title]"><span>Excerpt title :</span><input id="builder_item['+ builder_j +'][excerpt_title]" name="builder_item['+ builder_j +'][excerpt_title]" value="5" type="text"></label><label for="builder_item['+ builder_j +'][excerpt]"><span>Excerpt :</span><input id="builder_item['+ builder_j +'][excerpt]" name="builder_item['+ builder_j +'][excerpt]" value="25" type="text"></label><label for="builder_item['+ builder_j +'][order_by]"><span>Order by :</span><div class="styled-select"><select id="builder_item['+ builder_j +'][order_by]" name="builder_item['+ builder_j +'][order_by]"><option value="recent">Recent</option><option value="popular">Popular</option><option value="random">Random</option></select></div></label><input id="builder_item['+ builder_j +'][type]" name="builder_item['+ builder_j +'][type]" value="slideshow" type="hidden"></div><a class="del-builder-item">x</a></li>');
		}else if (builder_item == "box_news") {
			jQuery('#builder').append('<li id="builder_'+ builder_j +'" class="ui-state-default"><div class="widget-head text"><span class="vpanel'+ builder_j +'">Box news - <span>Box title</span></span><a class="builder-toggle-open" style="display:none">+</a><a class="builder-toggle-close" style="display:block">-</a></div><div class="widget-content" style="display:block"><label for="builder_item['+ builder_j +'][box_title]"><span>Box title :</span><input id="builder_item['+ builder_j +'][box_title]" class="builder_label_key" name="builder_item['+ builder_j +'][box_title]" value="Box title" type="text"><div class="explain vpanel_help"><div class="tooltip_s" data-title="Leave field blank if you want show the category name ."><i class="dashicons dashicons-info"></i></div></div></label><label for="builder_item['+ builder_j +'][box_posts_num]"><span>Number of posts :</span><input id="builder_item['+ builder_j +'][box_posts_num]" name="builder_item['+ builder_j +'][box_posts_num]" value="5" type="text"></label><label for="builder_item['+ builder_j +'][box_display]"><span>Display :</span><div class="styled-select"> <select class="builder_box_display" id="builder_item['+ builder_j +'][box_display]" name="builder_item['+ builder_j +'][box_display]"><option value="">Latest Posts</option><option value="category">Single Category</option><option value="categories">Multiple categories</option></select></div></label><label class="label_category" for="builder_item['+ builder_j +'][box_cats]"><span>Category :</span><div class="styled-select"><select class="builder_select_name" class="builder_select_name" id="builder_item['+ builder_j +'][box_cats]" name="builder_item['+ builder_j +'][box_cats]">'+ categories_select +'</select></div></label><label class="label_categories" for="builder_item['+ builder_j +'][categories]"><span>Categories :</span><select multiple="multiple" id="builder_item['+ builder_j +'][categories][]" name="builder_item['+ builder_j +'][categories][]">'+ categories_select +'</select><div class="clear"></div></label><label><span>Box style :</span><ul class="checkbox_select"><li><input type="radio" checked="checked" value="home_1" id="builder_item['+ builder_j +'][home_1]" name="builder_item['+ builder_j +'][box_style]"><a class="checkbox-select" href="#"><img src="'+ images_url +'home_1.png"></a></li><li><input type="radio" value="home_2" id="builder_item['+ builder_j +'][home_2]" name="builder_item['+ builder_j +'][box_style]"><a class="checkbox-select" href="#"><img src="'+ images_url +'home_2.png"></a></li><li><input type="radio" value="home_3" id="builder_item['+ builder_j +'][home_3]" name="builder_item['+ builder_j +'][box_style]"><a class="checkbox-select" href="#"><img src="'+ images_url +'home_3.png"></a></li><li><input type="radio" value="home_4" id="builder_item['+ builder_j +'][home_4]" name="builder_item['+ builder_j +'][box_style]"><a class="checkbox-select" href="#"><img src="'+ images_url +'home_4.png"></a></li><li><input type="radio" value="home_5" id="builder_item['+ builder_j +'][home_5]" name="builder_item['+ builder_j +'][box_style]"><a class="checkbox-select" href="#"><img src="'+ images_url +'home_5.png"></a></li><li><input type="radio" value="home_6" id="builder_item['+ builder_j +'][home_6]" name="builder_item['+ builder_j +'][box_style]"><a class="checkbox-select" href="#"><img src="'+ images_url +'home_6.png"></a></li><li><input type="radio" value="home_7" id="builder_item['+ builder_j +'][home_7]" name="builder_item['+ builder_j +'][box_style]"><a class="checkbox-select" href="#"><img src="'+ images_url +'home_7.png"></a></li><li><input type="radio" value="home_8" id="builder_item['+ builder_j +'][home_8]" name="builder_item['+ builder_j +'][box_style]"><a class="checkbox-select" href="#"><img src="'+ images_url +'home_8.png"></a></li><li><input type="radio" value="home_9" id="builder_item['+ builder_j +'][home_9]" name="builder_item['+ builder_j +'][box_style]"><a class="checkbox-select" href="#"><img src="'+ images_url +'home_9.png"></a></li><li><input type="radio" value="home_10" id="builder_item['+ builder_j +'][home_10]" name="builder_item['+ builder_j +'][box_style]"><a class="checkbox-select" href="#"><img src="'+ images_url +'home_10.png"></a></li><li><input type="radio" value="home_11" id="builder_item['+ builder_j +'][home_11]" name="builder_item['+ builder_j +'][box_style]"><a class="checkbox-select" href="#"><img src="'+ images_url +'home_11.png"></a></li></ul><div class="explain vpanel_help"><div class="tooltip_s" data-title="Box layout style ."><i class="dashicons dashicons-info"></i></div></div><div class="clear"></div></label><label for="builder_item['+ builder_j +'][excerpt_title]"><span>Excerpt title :</span><input id="builder_item['+ builder_j +'][excerpt_title]" name="builder_item['+ builder_j +'][excerpt_title]" value="5" type="text"></label><label for="builder_item['+ builder_j +'][excerpt]"><span>Excerpt :</span><input id="builder_item['+ builder_j +'][excerpt]" name="builder_item['+ builder_j +'][excerpt]" value="35" type="text"></label><label for="builder_item['+ builder_j +'][order_by]"><span>Order by :</span><div class="styled-select"><select id="builder_item['+ builder_j +'][order_by]" name="builder_item['+ builder_j +'][order_by]"><option value="recent">Recent</option><option value="popular">Popular</option><option value="random">Random</option></select></div></label><label for="builder_item['+ builder_j +'][animate]"><span>Box animate :</span><div class="styled-select"><select id="builder_item['+ builder_j +'][animate]" name="builder_item['+ builder_j +'][animate]"><option value="none">none</option><option value="bounce">bounce</option><option value="bounceIn">bounceIn</option><option value="bounceInDown">bounceInDown</option><option value="bounceInUp">bounceInUp</option><option value="bounceInLeft">bounceInLeft</option><option value="bounceInRight">bounceInRight</option><option value="fadeIn">fadeIn</option><option value="fadeInUp">fadeInUp</option><option value="fadeInDown">fadeInDown</option><option value="fadeInLeft">fadeInLeft</option><option value="fadeInRight">fadeInRight</option><option value="fadeInUpBig">fadeInUpBig</option><option value="fadeInDownBig">fadeInDownBig</option><option value="fadeInLeftBig">fadeInLeftBig</option><option value="fadeInRightBig">fadeInRightBig</option><option value="flash">flash</option><option value="flip">flip</option><option value="flipInX">flipInX</option><option value="flipInY">flipInY</option><option value="lightSpeedIn">lightSpeedIn</option><option value="pulse">pulse</option><option value="rotateIn">rotateIn</option><option value="rotateInDownLeft">rotateInDownLeft</option><option value="rotateInDownRight">rotateInDownRight</option><option value="rotateInUpLeft">rotateInUpLeft</option><option value="rotateInUpRight">rotateInUpRight</option><option value="rollIn">rollIn</option><option value="shake">shake</option><option value="swing">swing</option><option value="tada">tada</option><option value="wobble">wobble</option><option value="wiggle">wiggle</option></select></div></label><input id="builder_item['+ builder_j +'][type]" name="builder_item['+ builder_j +'][type]" value="box_news" type="hidden"></div><a class="del-builder-item">x</a></li>');
		}else if (builder_item == "pictures_news") {
			jQuery('#builder').append('<li id="builder_'+ builder_j +'" class="ui-state-default"><div class="widget-head text"><span class="vpanel'+ builder_j +'">Pictures news - <span>Pictures title</span></span><a class="builder-toggle-open" style="display:none">+</a><a class="builder-toggle-close" style="display:block">-</a></div><div class="widget-content" style="display:block"><label for="builder_item['+ builder_j +'][box_title]"><span>Pictures title :</span><input id="builder_item['+ builder_j +'][box_title]" class="builder_label_key" name="builder_item['+ builder_j +'][box_title]" value="Pictures title" type="text"></label><label for="builder_item['+ builder_j +'][box_posts_num]"><span>Number of posts :</span><input id="builder_item['+ builder_j +'][box_posts_num]" name="builder_item['+ builder_j +'][box_posts_num]" value="8" type="text"></label><label for="builder_item['+ builder_j +'][box_display]"><span>Display :</span><div class="styled-select"> <select class="builder_box_display" id="builder_item['+ builder_j +'][box_display]" name="builder_item['+ builder_j +'][box_display]"><option value="">Latest Posts</option><option value="category">Single Category</option><option value="categories">Multiple categories</option></select></div></label><label class="label_category" for="builder_item['+ builder_j +'][box_cats]"><span>Category :</span><div class="styled-select"><select class="builder_select_name" class="builder_select_name" id="builder_item['+ builder_j +'][box_cats]" name="builder_item['+ builder_j +'][box_cats]">'+ categories_select +'</select></div></label><label class="label_categories" for="builder_item['+ builder_j +'][categories]"><span>Categories :</span><select multiple="multiple" id="builder_item['+ builder_j +'][categories][]" name="builder_item['+ builder_j +'][categories][]">'+ categories_select +'</select><div class="clear"></div></label><label><span>Pictures news style :</span><ul class="checkbox_select"><li><input type="radio" checked="checked" value="pictures_1" id="builder_item['+ builder_j +'][pictures_1]" name="builder_item['+ builder_j +'][box_style]"><a class="checkbox-select" href="#"><img src="'+ images_url +'pictures_1.png"></a></li><li><input type="radio" value="pictures_2" id="builder_item['+ builder_j +'][pictures_2]" name="builder_item['+ builder_j +'][box_style]"><a class="checkbox-select" href="#"><img src="'+ images_url +'pictures_2.png"></a></li></ul><div class="explain vpanel_help"><div class="tooltip_s" data-title="Pictures news layout style ."><i class="dashicons dashicons-info"></i></div></div><div class="clear"></div></label><label for="builder_item['+ builder_j +'][order_by]"><span>Order by :</span><div class="styled-select"><select id="builder_item['+ builder_j +'][order_by]" name="builder_item['+ builder_j +'][order_by]"><option value="recent">Recent</option><option value="popular">Popular</option><option value="random">Random</option></select></div></label><label for="builder_item['+ builder_j +'][animate]"><span>Box animate :</span><div class="styled-select"><select id="builder_item['+ builder_j +'][animate]" name="builder_item['+ builder_j +'][animate]"><option value="none">none</option><option value="bounce">bounce</option><option value="bounceIn">bounceIn</option><option value="bounceInDown">bounceInDown</option><option value="bounceInUp">bounceInUp</option><option value="bounceInLeft">bounceInLeft</option><option value="bounceInRight">bounceInRight</option><option value="fadeIn">fadeIn</option><option value="fadeInUp">fadeInUp</option><option value="fadeInDown">fadeInDown</option><option value="fadeInLeft">fadeInLeft</option><option value="fadeInRight">fadeInRight</option><option value="fadeInUpBig">fadeInUpBig</option><option value="fadeInDownBig">fadeInDownBig</option><option value="fadeInLeftBig">fadeInLeftBig</option><option value="fadeInRightBig">fadeInRightBig</option><option value="flash">flash</option><option value="flip">flip</option><option value="flipInX">flipInX</option><option value="flipInY">flipInY</option><option value="lightSpeedIn">lightSpeedIn</option><option value="pulse">pulse</option><option value="rotateIn">rotateIn</option><option value="rotateInDownLeft">rotateInDownLeft</option><option value="rotateInDownRight">rotateInDownRight</option><option value="rotateInUpLeft">rotateInUpLeft</option><option value="rotateInUpRight">rotateInUpRight</option><option value="rollIn">rollIn</option><option value="shake">shake</option><option value="swing">swing</option><option value="tada">tada</option><option value="wobble">wobble</option><option value="wiggle">wiggle</option></select></div></label><input id="builder_item['+ builder_j +'][type]" name="builder_item['+ builder_j +'][type]" value="pictures_news" type="hidden"></div><a class="del-builder-item">x</a></li>');
		}else if (builder_item == "tabs_news") {
			jQuery('#builder').append('<li id="builder_'+ builder_j +'" class="ui-state-default"><div class="widget-head text"><span class="vpanel'+ builder_j +'">Tabs box news - <span>Tabs title</span></span><a class="builder-toggle-open" style="display:none">+</a><a class="builder-toggle-close" style="display:block">-</a></div><div class="widget-content" style="display:block"><label for="builder_item['+ builder_j +'][box_title]"><span>Tabs title :</span><input id="builder_item['+ builder_j +'][box_title]" class="builder_label_key" name="builder_item['+ builder_j +'][box_title]" value="Tabs title" type="text"></label><label for="builder_item['+ builder_j +'][box_posts_num]"><span>Number of posts :</span><input id="builder_item['+ builder_j +'][box_posts_num]" name="builder_item['+ builder_j +'][box_posts_num]" value="5" type="text"></label><label for="builder_item['+ builder_j +'][box_cats]"><span>Category :</span><select multiple="multiple" id="builder_item['+ builder_j +'][box_cats][]" name="builder_item['+ builder_j +'][box_cats][]">'+ categories_select +'</select><div class="clear"></div></label><label><span>Tabs box news style :</span><ul class="checkbox_select"><li><input type="radio" checked="checked" value="home_1" id="builder_item['+ builder_j +'][home_1]" name="builder_item['+ builder_j +'][box_style]"><a class="checkbox-select" href="#"><img src="'+ images_url +'home_1.png"></a></li><li><input type="radio" value="home_2" id="builder_item['+ builder_j +'][home_2]" name="builder_item['+ builder_j +'][box_style]"><a class="checkbox-select" href="#"><img src="'+ images_url +'home_2.png"></a></li><li><input type="radio" value="home_3" id="builder_item['+ builder_j +'][home_3]" name="builder_item['+ builder_j +'][box_style]"><a class="checkbox-select" href="#"><img src="'+ images_url +'home_3.png"></a></li><li><input type="radio" value="home_4" id="builder_item['+ builder_j +'][home_4]" name="builder_item['+ builder_j +'][box_style]"><a class="checkbox-select" href="#"><img src="'+ images_url +'home_4.png"></a></li><li><input type="radio" value="home_5" id="builder_item['+ builder_j +'][home_5]" name="builder_item['+ builder_j +'][box_style]"><a class="checkbox-select" href="#"><img src="'+ images_url +'home_5.png"></a></li><li><input type="radio" value="home_6" id="builder_item['+ builder_j +'][home_6]" name="builder_item['+ builder_j +'][box_style]"><a class="checkbox-select" href="#"><img src="'+ images_url +'home_6.png"></a></li><li><input type="radio" value="home_7" id="builder_item['+ builder_j +'][home_7]" name="builder_item['+ builder_j +'][box_style]"><a class="checkbox-select" href="#"><img src="'+ images_url +'home_7.png"></a></li><li><input type="radio" value="home_8" id="builder_item['+ builder_j +'][home_8]" name="builder_item['+ builder_j +'][box_style]"><a class="checkbox-select" href="#"><img src="'+ images_url +'home_8.png"></a></li><li><input type="radio" value="home_9" id="builder_item['+ builder_j +'][home_9]" name="builder_item['+ builder_j +'][box_style]"><a class="checkbox-select" href="#"><img src="'+ images_url +'home_9.png"></a></li><li><input type="radio" value="home_10" id="builder_item['+ builder_j +'][home_10]" name="builder_item['+ builder_j +'][box_style]"><a class="checkbox-select" href="#"><img src="'+ images_url +'home_10.png"></a></li><li><input type="radio" value="home_11" id="builder_item['+ builder_j +'][home_11]" name="builder_item['+ builder_j +'][box_style]"><a class="checkbox-select" href="#"><img src="'+ images_url +'home_11.png"></a></li></ul><div class="explain vpanel_help"><div class="tooltip_s" data-title="Tabs box news layout style ."><i class="dashicons dashicons-info"></i></div></div><div class="clear"></div></label><label for="builder_item['+ builder_j +'][excerpt_title]"><span>Excerpt title :</span><input id="builder_item['+ builder_j +'][excerpt_title]" name="builder_item['+ builder_j +'][excerpt_title]" value="5" type="text"></label><label for="builder_item['+ builder_j +'][excerpt]"><span>Excerpt :</span><input id="builder_item['+ builder_j +'][excerpt]" name="builder_item['+ builder_j +'][excerpt]" value="35" type="text"></label><label for="builder_item['+ builder_j +'][order_by]"><span>Order by :</span><div class="styled-select"><select id="builder_item['+ builder_j +'][order_by]" name="builder_item['+ builder_j +'][order_by]"><option value="recent">Recent</option><option value="popular">Popular</option><option value="random">Random</option></select></div></label><label for="builder_item['+ builder_j +'][animate]"><span>Box animate :</span><div class="styled-select"><select id="builder_item['+ builder_j +'][animate]" name="builder_item['+ builder_j +'][animate]"><option value="none">none</option><option value="bounce">bounce</option><option value="bounceIn">bounceIn</option><option value="bounceInDown">bounceInDown</option><option value="bounceInUp">bounceInUp</option><option value="bounceInLeft">bounceInLeft</option><option value="bounceInRight">bounceInRight</option><option value="fadeIn">fadeIn</option><option value="fadeInUp">fadeInUp</option><option value="fadeInDown">fadeInDown</option><option value="fadeInLeft">fadeInLeft</option><option value="fadeInRight">fadeInRight</option><option value="fadeInUpBig">fadeInUpBig</option><option value="fadeInDownBig">fadeInDownBig</option><option value="fadeInLeftBig">fadeInLeftBig</option><option value="fadeInRightBig">fadeInRightBig</option><option value="flash">flash</option><option value="flip">flip</option><option value="flipInX">flipInX</option><option value="flipInY">flipInY</option><option value="lightSpeedIn">lightSpeedIn</option><option value="pulse">pulse</option><option value="rotateIn">rotateIn</option><option value="rotateInDownLeft">rotateInDownLeft</option><option value="rotateInDownRight">rotateInDownRight</option><option value="rotateInUpLeft">rotateInUpLeft</option><option value="rotateInUpRight">rotateInUpRight</option><option value="rollIn">rollIn</option><option value="shake">shake</option><option value="swing">swing</option><option value="tada">tada</option><option value="wobble">wobble</option><option value="wiggle">wiggle</option></select></div></label><input id="builder_item['+ builder_j +'][type]" name="builder_item['+ builder_j +'][type]" value="tabs_news" type="hidden"></div><a class="del-builder-item">x</a></li>');
		}else if (builder_item == "scroll_news") {
			jQuery('#builder').append('<li id="builder_'+ builder_j +'" class="ui-state-default"><div class="widget-head text"><span class="vpanel'+ builder_j +'">Scroll news - <span>Scroll title</span></span><a class="builder-toggle-open" style="display:none">+</a><a class="builder-toggle-close" style="display:block">-</a></div><div class="widget-content" style="display:block"><label for="builder_item['+ builder_j +'][box_title]"><span>Scroll title :</span><input id="builder_item['+ builder_j +'][box_title]" class="builder_label_key" name="builder_item['+ builder_j +'][box_title]" value="Scroll title" type="text"></label><label for="builder_item['+ builder_j +'][box_posts_num]"><span>Number of posts :</span><input id="builder_item['+ builder_j +'][box_posts_num]" name="builder_item['+ builder_j +'][box_posts_num]" value="6" type="text"></label><label for="builder_item['+ builder_j +'][box_display]"><span>Display :</span><div class="styled-select"> <select class="builder_box_display" id="builder_item['+ builder_j +'][box_display]" name="builder_item['+ builder_j +'][box_display]"><option value="">Latest Posts</option><option value="category">Single Category</option><option value="categories">Multiple categories</option></select></div></label><label class="label_category" for="builder_item['+ builder_j +'][box_cats]"><span>Category :</span><div class="styled-select"><select class="builder_select_name" class="builder_select_name" id="builder_item['+ builder_j +'][box_cats]" name="builder_item['+ builder_j +'][box_cats]">'+ categories_select +'</select></div></label><label class="label_categories" for="builder_item['+ builder_j +'][categories]"><span>Categories :</span><select multiple="multiple" id="builder_item['+ builder_j +'][categories][]" name="builder_item['+ builder_j +'][categories][]">'+ categories_select +'</select><div class="clear"></div></label><label><span>Scroll news style :</span><ul class="checkbox_select"><li><input type="radio" checked="checked" value="scroll_1" id="builder_item['+ builder_j +'][scroll_1]" name="builder_item['+ builder_j +'][box_style]"><a class="checkbox-select" href="#"><img src="'+ images_url +'scroll_1.png"></a></li><li><input type="radio" value="scroll_2" id="builder_item['+ builder_j +'][scroll_2]" name="builder_item['+ builder_j +'][box_style]"><a class="checkbox-select" href="#"><img src="'+ images_url +'scroll_2.png"></a></li></ul><div class="explain vpanel_help"><div class="tooltip_s" data-title="Scroll news layout style ."><i class="dashicons dashicons-info"></i></div></div><div class="clear"></div></label><label for="builder_item['+ builder_j +'][excerpt_title]"><span>Excerpt title :</span><input id="builder_item['+ builder_j +'][excerpt_title]" name="builder_item['+ builder_j +'][excerpt_title]" value="5" type="text"></label><label for="builder_item['+ builder_j +'][order_by]"><span>Order by :</span><div class="styled-select"><select id="builder_item['+ builder_j +'][order_by]" name="builder_item['+ builder_j +'][order_by]"><option value="recent">Recent</option><option value="popular">Popular</option><option value="random">Random</option></select></div></label><label for="builder_item['+ builder_j +'][animate]"><span>Box animate :</span><div class="styled-select"><select id="builder_item['+ builder_j +'][animate]" name="builder_item['+ builder_j +'][animate]"><option value="none">none</option><option value="bounce">bounce</option><option value="bounceIn">bounceIn</option><option value="bounceInDown">bounceInDown</option><option value="bounceInUp">bounceInUp</option><option value="bounceInLeft">bounceInLeft</option><option value="bounceInRight">bounceInRight</option><option value="fadeIn">fadeIn</option><option value="fadeInUp">fadeInUp</option><option value="fadeInDown">fadeInDown</option><option value="fadeInLeft">fadeInLeft</option><option value="fadeInRight">fadeInRight</option><option value="fadeInUpBig">fadeInUpBig</option><option value="fadeInDownBig">fadeInDownBig</option><option value="fadeInLeftBig">fadeInLeftBig</option><option value="fadeInRightBig">fadeInRightBig</option><option value="flash">flash</option><option value="flip">flip</option><option value="flipInX">flipInX</option><option value="flipInY">flipInY</option><option value="lightSpeedIn">lightSpeedIn</option><option value="pulse">pulse</option><option value="rotateIn">rotateIn</option><option value="rotateInDownLeft">rotateInDownLeft</option><option value="rotateInDownRight">rotateInDownRight</option><option value="rotateInUpLeft">rotateInUpLeft</option><option value="rotateInUpRight">rotateInUpRight</option><option value="rollIn">rollIn</option><option value="shake">shake</option><option value="swing">swing</option><option value="tada">tada</option><option value="wobble">wobble</option><option value="wiggle">wiggle</option></select></div></label><input id="builder_item['+ builder_j +'][type]" name="builder_item['+ builder_j +'][type]" value="scroll_news" type="hidden"></div><a class="del-builder-item">x</a></li>');
		}else if (builder_item == "recent_posts") {
			jQuery('#builder').append('<li id="builder_'+ builder_j +'" class="ui-state-default"><div class="widget-head text"><span class="vpanel'+ builder_j +'">Recent posts - <span>Recent posts title</span></span><a class="builder-toggle-open" style="display:none">+</a><a class="builder-toggle-close" style="display:block">-</a></div><div class="widget-content" style="display:block"><label for="builder_item['+ builder_j +'][box_title]"><span>Recent posts title :</span><input id="builder_item['+ builder_j +'][box_title]" class="builder_label_key" name="builder_item['+ builder_j +'][box_title]" value="Recent posts title" type="text"></label><label for="builder_item['+ builder_j +'][box_posts_num]"><span>Number of posts :</span><input id="builder_item['+ builder_j +'][box_posts_num]" name="builder_item['+ builder_j +'][box_posts_num]" value="3" type="text"></label><label for="builder_item['+ builder_j +'][box_display]"><span>Display :</span><div class="styled-select"> <select class="builder_box_display" id="builder_item['+ builder_j +'][box_display]" name="builder_item['+ builder_j +'][box_display]"><option value="">Latest Posts</option><option value="category">Single Category</option><option value="categories">Multiple categories</option></select></div></label><label class="label_category" for="builder_item['+ builder_j +'][box_cats]"><span>Category :</span><div class="styled-select"><select class="builder_select_name" class="builder_select_name" id="builder_item['+ builder_j +'][box_cats]" name="builder_item['+ builder_j +'][box_cats]">'+ categories_select +'</select></div></label><label class="label_categories" for="builder_item['+ builder_j +'][categories]"><span>Categories :</span><select multiple="multiple" id="builder_item['+ builder_j +'][categories][]" name="builder_item['+ builder_j +'][categories][]">'+ categories_select +'</select><div class="clear"></div></label><label><span>Recent posts style :</span><ul class="checkbox_select"><li><input type="radio" checked="checked" value="recent_1" id="builder_item['+ builder_j +'][recent_1]" name="builder_item['+ builder_j +'][box_style]"><a class="checkbox-select" href="#"><img src="'+ images_url +'recent_1.png"></a></li><li><input type="radio" value="recent_2" id="builder_item['+ builder_j +'][recent_2]" name="builder_item['+ builder_j +'][box_style]"><a class="checkbox-select" href="#"><img src="'+ images_url +'recent_2.png"></a></li><li><input type="radio" value="recent_3" id="builder_item['+ builder_j +'][recent_3]" name="builder_item['+ builder_j +'][box_style]"><a class="checkbox-select" href="#"><img src="'+ images_url +'recent_3.png"></a></li><li><input type="radio" value="recent_4" id="builder_item['+ builder_j +'][recent_4]" name="builder_item['+ builder_j +'][box_style]"><a class="checkbox-select" href="#"><img src="'+ images_url +'recent_4.png"></a></li></ul><div class="explain vpanel_help"><div class="tooltip_s" data-title="Recent posts layout style ."><i class="dashicons dashicons-info"></i></div></div><div class="clear"></div></label><label for="builder_item['+ builder_j +'][excerpt_title]"><span>Excerpt title :</span><input id="builder_item['+ builder_j +'][excerpt_title]" name="builder_item['+ builder_j +'][excerpt_title]" value="5" type="text"></label><label for="builder_item['+ builder_j +'][excerpt]"><span>Excerpt :</span><input id="builder_item['+ builder_j +'][excerpt]" name="builder_item['+ builder_j +'][excerpt]" value="35" type="text"></label><label for="builder_item['+ builder_j +'][order_by]"><span>Order by :</span><div class="styled-select"><select id="builder_item['+ builder_j +'][order_by]" name="builder_item['+ builder_j +'][order_by]"><option value="recent">Recent</option><option value="popular">Popular</option><option value="random">Random</option></select></div></label><label for="builder_item['+ builder_j +'][animate]"><span>Box animate :</span><div class="styled-select"><select id="builder_item['+ builder_j +'][animate]" name="builder_item['+ builder_j +'][animate]"><option value="none">none</option><option value="bounce">bounce</option><option value="bounceIn">bounceIn</option><option value="bounceInDown">bounceInDown</option><option value="bounceInUp">bounceInUp</option><option value="bounceInLeft">bounceInLeft</option><option value="bounceInRight">bounceInRight</option><option value="fadeIn">fadeIn</option><option value="fadeInUp">fadeInUp</option><option value="fadeInDown">fadeInDown</option><option value="fadeInLeft">fadeInLeft</option><option value="fadeInRight">fadeInRight</option><option value="fadeInUpBig">fadeInUpBig</option><option value="fadeInDownBig">fadeInDownBig</option><option value="fadeInLeftBig">fadeInLeftBig</option><option value="fadeInRightBig">fadeInRightBig</option><option value="flash">flash</option><option value="flip">flip</option><option value="flipInX">flipInX</option><option value="flipInY">flipInY</option><option value="lightSpeedIn">lightSpeedIn</option><option value="pulse">pulse</option><option value="rotateIn">rotateIn</option><option value="rotateInDownLeft">rotateInDownLeft</option><option value="rotateInDownRight">rotateInDownRight</option><option value="rotateInUpLeft">rotateInUpLeft</option><option value="rotateInUpRight">rotateInUpRight</option><option value="rollIn">rollIn</option><option value="shake">shake</option><option value="swing">swing</option><option value="tada">tada</option><option value="wobble">wobble</option><option value="wiggle">wiggle</option></select></div></label><input id="builder_item['+ builder_j +'][type]" name="builder_item['+ builder_j +'][type]" value="recent_posts" type="hidden"></div><a class="del-builder-item">x</a></li>');
		}else if (builder_item == "shop_box") {
			jQuery('#builder').append('<li id="builder_'+ builder_j +'" class="ui-state-default"><div class="widget-head text"><span class="vpanel'+ builder_j +'">Shop box - <span>Shop box title</span></span><a class="builder-toggle-open" style="display:none">+</a><a class="builder-toggle-close" style="display:block">-</a></div><div class="widget-content" style="display:block"><label for="builder_item['+ builder_j +'][box_title]"><span>Shop box title :</span><input id="builder_item['+ builder_j +'][box_title]" class="builder_label_key" name="builder_item['+ builder_j +'][box_title]" value="Shop box title" type="text"><div class="explain vpanel_help"><div class="tooltip_s" data-title="Leave field blank if you want show the category name ."><i class="dashicons dashicons-info"></i></div></div></label><label for="builder_item['+ builder_j +'][box_posts_num]"><span>Number of posts :</span><input id="builder_item['+ builder_j +'][box_posts_num]" name="builder_item['+ builder_j +'][box_posts_num]" value="5" type="text"></label><label for="builder_item['+ builder_j +'][box_display]"><span>Display :</span><div class="styled-select"> <select class="builder_box_display" id="builder_item['+ builder_j +'][box_display]" name="builder_item['+ builder_j +'][box_display]"><option value="">Latest Posts</option><option value="category">Single Category</option><option value="categories">Multiple categories</option></select></div></label><label class="label_category" for="builder_item['+ builder_j +'][box_cats]"><span>Category :</span><div class="styled-select"><select class="builder_select_name" class="builder_select_name" id="builder_item['+ builder_j +'][box_cats]" name="builder_item['+ builder_j +'][box_cats]">'+ product_cat_select +'</select></div></label><label class="label_categories" for="builder_item['+ builder_j +'][categories]"><span>Categories :</span><select multiple="multiple" id="builder_item['+ builder_j +'][categories][]" name="builder_item['+ builder_j +'][categories][]">'+ product_cat_select +'</select><div class="clear"></div></label><label for="builder_item['+ builder_j +'][order_by]"><span>Order by :</span><div class="styled-select"><select id="builder_item['+ builder_j +'][order_by]" name="builder_item['+ builder_j +'][order_by]"><option value="recent">Recent</option><option value="popular">Popular</option><option value="random">Random</option></select></div></label><label for="builder_item['+ builder_j +'][scroll]"><span>Scroll :</span><div class="styled-select"><select id="builder_item['+ builder_j +'][scroll]" name="builder_item['+ builder_j +'][scroll]"><option value="no">No</option><option value="yes">Yes</option></select></div></label><label for="builder_item['+ builder_j +'][animate]"><span>Box animate :</span><div class="styled-select"><select id="builder_item['+ builder_j +'][animate]" name="builder_item['+ builder_j +'][animate]"><option value="none">none</option><option value="bounce">bounce</option><option value="bounceIn">bounceIn</option><option value="bounceInDown">bounceInDown</option><option value="bounceInUp">bounceInUp</option><option value="bounceInLeft">bounceInLeft</option><option value="bounceInRight">bounceInRight</option><option value="fadeIn">fadeIn</option><option value="fadeInUp">fadeInUp</option><option value="fadeInDown">fadeInDown</option><option value="fadeInLeft">fadeInLeft</option><option value="fadeInRight">fadeInRight</option><option value="fadeInUpBig">fadeInUpBig</option><option value="fadeInDownBig">fadeInDownBig</option><option value="fadeInLeftBig">fadeInLeftBig</option><option value="fadeInRightBig">fadeInRightBig</option><option value="flash">flash</option><option value="flip">flip</option><option value="flipInX">flipInX</option><option value="flipInY">flipInY</option><option value="lightSpeedIn">lightSpeedIn</option><option value="pulse">pulse</option><option value="rotateIn">rotateIn</option><option value="rotateInDownLeft">rotateInDownLeft</option><option value="rotateInDownRight">rotateInDownRight</option><option value="rotateInUpLeft">rotateInUpLeft</option><option value="rotateInUpRight">rotateInUpRight</option><option value="rollIn">rollIn</option><option value="shake">shake</option><option value="swing">swing</option><option value="tada">tada</option><option value="wobble">wobble</option><option value="wiggle">wiggle</option></select></div></label><input id="builder_item['+ builder_j +'][type]" name="builder_item['+ builder_j +'][type]" value="shop_box" type="hidden"></div><a class="del-builder-item">x</a></li>');
		}else if (builder_item == "adv") {
			jQuery('#builder').append('<li id="builder_'+ builder_j +'" class="ui-state-default"><div class="widget-head text"><span class="vpanel'+ builder_j +'">Advertising</span><a class="builder-toggle-open" style="display:none">+</a><a class="builder-toggle-close" style="display:block">-</a></div><div class="widget-content" style="display:block"><label class="adv-label"><span>Advertising type :</span><input type="radio" value="display_code" id="builder_item['+ builder_j +'][display_code]" name="builder_item['+ builder_j +'][adv_type]"><label for="builder_item['+ builder_j +'][display_code]">Display code</label><input type="radio" checked="checked" value="custom_image" id="builder_item['+ builder_j +'][custom_image]" name="builder_item['+ builder_j +'][adv_type]"><label for="builder_item['+ builder_j +'][custom_image]">Custom Image</label></label><label class="image-url" for="builder_item['+ builder_j +'][image_url]"><span>Image URL :</span><input id="builder_item['+ builder_j +'][image_url]" name="builder_item['+ builder_j +'][image_url]" placeholder="No file chosen" type="text" class="upload upload_image_'+ builder_j +'"><input class="upload_image_button button upload-button-2" rel="'+ builder_j +'" type="button" value="Upload"><input type="hidden" class="image_id" name="builder_item['+ builder_j +'][image_id]" value=""><div class="clear"></div></label><label class="adv-url" for="builder_item['+ builder_j +'][adv_url]"><span>Advertising url :</span><input id="builder_item['+ builder_j +'][adv_url]" name="builder_item['+ builder_j +'][adv_url]" value="#" type="text"></label><label class="adv-code" for="builder_item['+ builder_j +'][adv_code]"><span>Advertising Code html ( Ex: Google ads) :</span><textarea id="builder_item['+ builder_j +'][adv_code]" name="builder_item['+ builder_j +'][adv_code]"></textarea></label><label for="builder_item['+ builder_j +'][adv_box]"><span>Advertising box :</span><div class="styled-select"><select id="builder_item['+ builder_j +'][adv_box]" name="builder_item['+ builder_j +'][adv_box]"><option value="enable">Enable</option><option value="disable">Disable</option></select></div></label><input id="builder_item['+ builder_j +'][type]" name="builder_item['+ builder_j +'][type]" value="adv" type="hidden"></div><a class="del-builder-item">x</a></li>');
		}else if (builder_item == "clear") {
			jQuery('#builder').append('<li id="builder_'+ builder_j +'" class="ui-state-default"><div class="widget-head text"><span class="vpanel'+ builder_j +'">Clear</span></div><input id="builder_item['+ builder_j +'][type]" name="builder_item['+ builder_j +'][type]" value="clear" type="hidden"><a class="del-builder-item">x</a></li>');
		}else if (builder_item == "gap") {
			jQuery('#builder').append('<li id="builder_'+ builder_j +'" class="ui-state-default"><div class="widget-head text"><span class="vpanel'+ builder_j +'">Gap - <span>30px</span></span><a class="builder-toggle-open" style="display:none">+</a><a class="builder-toggle-close" style="display:block">-</a></div><div class="widget-content" style="display:block"><label for="builder_item['+ builder_j +'][box_title]"><span>Gap height :</span><input id="builder_item['+ builder_j +'][box_title]" class="builder_label_key" name="builder_item['+ builder_j +'][box_title]" value="30px" type="text"></label><input id="builder_item['+ builder_j +'][type]" name="builder_item['+ builder_j +'][type]" value="gap" type="hidden"></div><a class="del-builder-item">x</a></li>');
		}else if (builder_item == "add_slide") {
			jQuery('#builder_slide_'+ builder_slide_j).hide().fadeIn();
			builder_slide_j ++ ;
		}else if (builder_item == "add_rating") {
			jQuery('#vbegy_ratings_post ul').append('<li id="builder_rating_'+ builder_rating_j +'" class="ui-state-default"><div class="widget-head text"><span class="vpanel'+ builder_rating_j +'">Rating item - '+ builder_rating_j +'</span><a class="builder-toggle-open" style="display:none">+</a><a class="builder-toggle-close" style="display:block">-</a></div><div class="widget-content" style="display:block"><label for="builder_rating_item['+ builder_rating_j +'][rating_description]"><span>Rating description :</span><input id="builder_rating_item['+ builder_rating_j +'][rating_description]" name="builder_rating_item['+ builder_rating_j +'][rating_description]" value="" type="text"></label><label for="builder_rating_item['+ builder_rating_j +'][rating_score]"><span>Rating score :</span><input class="rating_score" id="builder_rating_item['+ builder_rating_j +'][rating_score]" name="builder_rating_item['+ builder_rating_j +'][rating_score]" value="" type="text"> <em class="preview_rating_em" id="preview_rating_'+ builder_rating_j +'"> </em></label></div><a class="del-builder-item">x</a></li>');
		}
		if (builder_item != "add_slide" && builder_item != "add_rating") {
			jQuery('#builder_'+ builder_j).hide().fadeIn();
			builder_j ++ ;
			builder_label_key();
			checkbox_select();
			uploaded_image();
		}else if (builder_item == "add_rating") {
			jQuery('#builder_rating_'+ builder_rating_j).hide().fadeIn();
			builder_rating_j ++ ;
			rating_score();
		}
		jQuery('.tooltip_s').tipsy({gravity: 's'});
		return false;
	});
	
	jQuery(".del-builder-item").live("click" , function() {
		if (jQuery(this).hasClass("del-sidebar-item")) {
			jQuery(this).parent().parent().addClass('removered').fadeOut(function() {
				jQuery(this).remove();
			});
		}else {
			jQuery(this).parent().addClass('removered').fadeOut(function() {
				jQuery(this).remove();
			});
		}
		return false;
	});
	
	jQuery(".del-cat").live("click" , function() {
		jQuery(this).parent().parent().addClass('removered').fadeOut(function() {
			jQuery(this).remove();
		});
	});
	
	builder_label_key();
	checkbox_select();
	checkbox_checkbox();
	uploaded_image();
	rating_score();
	
	jQuery(".builder_import").click(function () {
		var answer = confirm("If you press will import data !");
		if (answer) {
			var builder_import = jQuery(this);
			var builder_textarea = jQuery("#builder_textarea").val();
			var post_id = jQuery("#post_ID").val();
			jQuery.post(builder_ajax,"action=save_builder_import&builder_textarea="+builder_textarea+"&post_id="+post_id,function (result) {
				location.reload();
			});
		}
		return false;
	});
	
});