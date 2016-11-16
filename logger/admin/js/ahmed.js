jQuery(document).ready( function($) {
	    jQuery("input.vpanel_save").click(function(){
    	jQuery("#ajax-saving").fadeIn("slow");
    	jQuery("#loading").show();
    	if (jQuery(".vpanel_editor").length > 0) {
    		tinyMCE.triggerSave();
    	}
    	
		var options_fromform = jQuery('#main_options_form').serialize();
		var options_fromform2 = options_fromform+"&action=update_options";
    	jQuery.post(ajax_a,options_fromform2,function (data) {
    		jQuery(".vpanel_save").blur();
    		//jQuery("body").prepend(data);
    		setTimeout(function(){
    			jQuery("#ajax-saving").fadeOut("slow");
    			jQuery("#loading").hide();
    		},200);
    		if (data == 2) {
    			jQuery("#import_setting").val("");
    			location.reload();
    		}
    	});
    	
    	return false;
    });
	
    jQuery("#reset_c").click(function() {
    	var answer = confirm(confirm_reset);
    	if (answer) {
    		jQuery("#ajax-reset").fadeIn("slow");
    		var defaults = "&action=reset_options";
    		jQuery.post(ajax_a,defaults,function (data) {
    			jQuery("#reset_c").blur();
    			setTimeout(function(){
    				jQuery("#ajax-reset").fadeOut("slow");
    				//jQuery("body").prepend(data);
    				location.reload();
    			},200);
    		});
    	}
    	return false;
    });
    
    jQuery('#sort-sections').sortable();
    
	jQuery('#optionsframework-wrap select[multiple]').select2();
    jQuery(".vpanel_checkbox:checkbox,#vbegy_page_builder:checkbox,#vbegy_background_full,#vbegy_top_menu,#vbegy_header_adv,#vbegy_main_menu,#vbegy_social_icon_h,#vbegy_rss_icon_h,#header_fixed,#vbegy_about_widget,#vbegy_social,#vbegy_rss,#vbegy_header_menu,#vbegy_header_fixed,#vbegy_breadcrumbs,#vbegy_social_icon_f,#vbegy_rss_icon_f,#vbegy_responsive,#vbegy_post_meta,#vbegy_post_share,#vbegy_post_author_box,#vbegy_post_comments,#vbegy_last_posts,#vbegy_post_type,#vbegy_post_author,#vbegy_custom_page_setting,#vbegy_post_meta_s,#vbegy_post_type_s,#vbegy_post_author_s,#vbegy_post_share_s,#vbegy_post_author_box_s,#vbegy_related_post_s,#vbegy_post_comments_s,#vbegy_post_navigation_s,#vbegy_custom_header,#vbegy_header_cart,#vbegy_header_search,#vbegy_header_follow,#vbegy_news_ticker,#vbegy_review_display,#vbegy_post_review_s,#vbegy_pagination,#vbegy_head_slide_background_full,#vbegy_header_fixed_responsive,#vbegy_post_views_s,#vbegy_post_head_background_full,#vbegy_custom_slide_show_style,#vbegy_post_views,#vbegy_breadcrumbs,#vbegy_custom_sections,#vbegy_sticky_sidebar_s").checkbox({cls:'vpanel_checkbox'});
	
    jQuery(".vpanel_multicheck:checkbox,.rwmb-checkbox-list:checkbox").checkbox({cls:'vpanel_multicheck'});
    
    jQuery('input[name="vbegy_sidebar"][value="right"],input[name="categories[cat_sidebar_layout]"][value="right"]').checkbox({cls:'jquery-sidebar-right'});
    jQuery('input[name="vbegy_sidebar"][value="full"],input[name="vbegy_header_skin"][value="header_gray"],input[name="categories[cat_sidebar_layout]"][value="full"]').checkbox({cls:'jquery-sidebar-full'});
    jQuery('input[name="vbegy_sidebar"][value="left"],input[name="categories[cat_sidebar_layout]"][value="left"]').checkbox({cls:'jquery-sidebar-left'});
    jQuery('input[name="vbegy_sidebar"][value="centered"],input[name="categories[cat_sidebar_layout]"][value="centered"]').checkbox({cls:'jquery-sidebar-centered'});
    jQuery('input[name="vbegy_sidebar"][value="default"],input[name="vbegy_layout"][value="default"],input[name="vbegy_site_skin_l"][value="default"],input[name="vbegy_home_template"][value="default"],input[name="categories[cat_layout]"][value="default"],input[name="categories[cat_template]"][value="default"],input[name="categories[cat_sidebar_layout]"][value="default"],input[name="categories[cat_skin_l]"][value="default"]').checkbox({cls:'jquery-sidebar-default'});
    
    jQuery('input[name="vbegy_layout"][value="full"],input[name="categories[cat_layout]"][value="full"]').checkbox({cls:'jquery-layout-full'});
    jQuery('input[name="vbegy_layout"][value="fixed"],input[name="categories[cat_layout]"][value="fixed"]').checkbox({cls:'jquery-layout-fixed'});
    jQuery('input[name="vbegy_layout"][value="fixed_2"],input[name="categories[cat_layout]"][value="fixed_2"]').checkbox({cls:'jquery-layout-fixed_2'});
    
    jQuery('input[name="vbegy_home_template"][value="grid_1200"],input[name="categories[cat_template]"][value="grid_1200"]').checkbox({cls:'jquery-grid_1200'});
    jQuery('input[name="vbegy_home_template"][value="grid_970"],input[name="categories[cat_template]"][value="grid_970"]').checkbox({cls:'jquery-grid_970'});
    jQuery('input[name="vbegy_site_skin_l"][value="site_light"],input[name="vbegy_header_skin"][value="header_light"],input[name="vbegy_footer_skin"][value="footer_light"],input[name="categories[cat_skin_l]"][value="site_light"]').checkbox({cls:'jquery-site_light'});
    jQuery('input[name="vbegy_site_skin_l"][value="site_dark"],input[name="vbegy_header_skin"][value="header_dark"],input[name="vbegy_footer_skin"][value="footer_dark"],input[name="categories[cat_skin_l]"][value="site_dark"]').checkbox({cls:'jquery-site_dark'});
    
    jQuery('input[name="vbegy_skin"],input[name="categories[cat_skin]"]').checkbox({cls:'jquery-skin-default_color'});
    
    jQuery('.radio_no_margin input[name="vbegy_skin"]').each(function () {
    	jQuery(this).parent().addClass(jQuery(this).attr("value"));
    });
    
    jQuery('input[name="vbegy_footer_layout"][value="footer_1c"]').checkbox({cls:'jquery-footer_1c'});
    jQuery('input[name="vbegy_footer_layout"][value="footer_2c"]').checkbox({cls:'jquery-footer_2c'});
    jQuery('input[name="vbegy_footer_layout"][value="footer_3c"]').checkbox({cls:'jquery-footer_3c'});
    jQuery('input[name="vbegy_footer_layout"][value="footer_4c"]').checkbox({cls:'jquery-footer_4c'});
    jQuery('input[name="vbegy_footer_layout"][value="footer_no"]').checkbox({cls:'jquery-footer_no'});
    
    jQuery('.tooltip_n').tipsy({gravity: 'n'});
    jQuery('.tooltip_s').tipsy({gravity: 's'});
    
    if (jQuery('.wp-color-picker').length > 0) {
    	jQuery('.wp-color-picker').wpColorPicker();
    }
    
});