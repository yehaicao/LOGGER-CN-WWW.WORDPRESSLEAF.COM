(function($) { "use strict";
	
	/* Mobile */
	
	if( navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || 
		navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || 
		navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || 
		navigator.userAgent.match(/Windows Phone/i) ){ 
		var mobile_device = true; 
	}else{ 
		var mobile_device = false; 
	}
	
	/* Menu */
	
	jQuery(".navigation  ul li ul").parent("li").addClass("parent-list");
	jQuery(".parent-list").find("a:first").append("<span class='menu-nav-arrow'><i class='fa fa-angle-down'></i></span>");
	
	/* Header mobile */
	
	jQuery(".navigation > ul > li").clone().appendTo('.navigation_mobile > ul');
	
	if (jQuery(".navigation_mobile_click").length) {
		jQuery(".navigation_mobile_click").click(function() {
			if (jQuery(this).hasClass("navigation_mobile_click_close")) {
				jQuery(this).next().slideUp(500);
				jQuery(this).removeClass("navigation_mobile_click_close");
			}else {
				jQuery(this).next().slideDown(500);
				jQuery(this).addClass("navigation_mobile_click_close");
			}
		});
		
		jQuery(".navigation_mobile ul li").each(function() {	
			var sub_menu = jQuery(this).find("ul:first");
			jQuery(this).find("> a").click(function() {
				if (jQuery(this).parent().find("ul").length > 0) {
					if (jQuery(this).parent().find("> ul").hasClass("sub_menu")) {
						jQuery(this).parent().find("> ul").removeClass("sub_menu");
						sub_menu.stop().slideUp(250, function() {	
							jQuery(this).css({overflow:"hidden", display:"none"});
						});
					}else {
						jQuery(this).parent().find("> ul").addClass("sub_menu");
						sub_menu.stop().css({overflow:"hidden", height:"auto", display:"none", paddingTop:0}).slideDown(250, function() {
							jQuery(this).css({overflow:"visible", height:"auto"});
						});
					}
					return false;
				}else {
					return true;
				}
			});	
		});
	}
	
	jQuery(".navigation_mobile > ul > li a.button").removeClass("button");
	
	
	var nav = jQuery('.widget');
	var content = jQuery('.post-inner');
	
	nav.find('a').click(function() {
		jQuery('.widget,.pin-wrapper').removeAttr("style");
		nav.find('a').parent().removeClass('current');
		jQuery(this).parent().addClass('current');
		content.children(jQuery(this).attr('href')).fadeIn().siblings('section').hide();
		jQuery('.sidebar').pin ({
		    padding: {top: 30, bottom: 10},
		    containerSelector: ".with-sidebar-container",
		    minWidth: 960
		});
		return false;
	});
	
	/* Go up */
	
	jQuery(window).scroll(function () {
		if(jQuery(this).scrollTop() > 100 ) {
			jQuery(".go-up").css("right","20px");
		}else {
			jQuery(".go-up").css("right","-60px");
		}
	});
	jQuery(".go-up").click(function(){
		jQuery("html,body").animate({scrollTop:0},500);
		return false;
	});
	
	/* niceScroll */
	
	jQuery("html").niceScroll({
		scrollspeed: 60,
		mousescrollstep: 38,
		cursorwidth: 6,
		cursorborder: 0,
		cursorcolor: '#263241',
		autohidemode: false,
		zindex: 9999999,
		horizrailenabled: false,
		cursorborderradius: 0,
	});
	
	/* Lightbox */
	
	var lightboxArgs = {			
		animation_speed: "fast",
		overlay_gallery: true,
		autoplay_slideshow: false,
		slideshow: 5000, // light_rounded / dark_rounded / light_square / dark_square / facebook
		theme: "pp_default", 
		opacity: 0.8,
		show_title: false,
		social_tools: "",
		deeplinking: false,
		allow_resize: true, // Resize the photos bigger than viewport. true/false
		counter_separator_label: "/", // The separator for the gallery counter 1 "of" 2
		default_width: 940,
		default_height: 529
	};
		
	jQuery("a[href$=jpg], a[href$=JPG], a[href$=jpeg], a[href$=JPEG], a[href$=png], a[href$=gif], a[href$=bmp]:has(img)").prettyPhoto(lightboxArgs);
			
	jQuery("a[class^='prettyPhoto'], a[rel^='prettyPhoto']").prettyPhoto(lightboxArgs);
	
	jQuery(window).load(function() {
		
		/* Sticky sidebar */
		
		jQuery('.sidebar').pin ({
	        padding: {top: 30, bottom: 10},
	        containerSelector: ".with-sidebar-container",
	        minWidth: 960
	    });
	    
    });
	
})(jQuery);