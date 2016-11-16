(function($) { "use strict";
	
	/* Menu */
	jQuery("#header .menu-item-has-children").find("a:first").append("<span class='menu-nav-arrow'><i class='fa fa-angle-down'></i></span>");
	
	/* Header fixed */
	
	var aboveHeight   = jQuery("#header").outerHeight();
	var fixed_enabled = jQuery("#wrap").hasClass("fixed-enabled");
	if(fixed_enabled){
		jQuery(window).scroll(function(){
			if(jQuery(window).scrollTop() > aboveHeight ){
				jQuery("#header").css({"top":"0"}).addClass("fixed-nav");
			}else{
				jQuery("#header").css({"top":"auto"}).removeClass("fixed-nav");
			}
		});
	}else {
		jQuery("#header").removeClass("fixed-nav");
	}
	
	/* Mobile */
	
	if( navigator.userAgent.match(/Android/i) || navigator.userAgent.match(/webOS/i) || 
		navigator.userAgent.match(/iPhone/i) || navigator.userAgent.match(/iPad/i) || 
		navigator.userAgent.match(/iPod/i) || navigator.userAgent.match(/BlackBerry/i) || 
		navigator.userAgent.match(/Windows Phone/i) ){ 
		var mobile_device = true; 
	}else{ 
		var mobile_device = false; 
	}
	
	jQuery(".navigation > div > ul > li").clone().appendTo('.navigation_mobile > ul');
	
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
			jQuery(this).find("> a > .menu-nav-arrow").click(function() {
				if (jQuery(this).parent().parent().find("ul").length > 0) {
					if (jQuery(this).parent().parent().find("> ul").hasClass("sub_menu")) {
						jQuery(this).parent().parent().find("> ul").removeClass("sub_menu");
						sub_menu.stop().slideUp(250,function() {	
							jQuery(this).css({overflow:"hidden",display:"none"});
						});
					}else {
						jQuery(this).parent().parent().find("> ul").addClass("sub_menu");
						sub_menu.stop().css({overflow:"hidden",height:"auto",display:"none",paddingTop:0}).slideDown(250,function() {
							jQuery(this).css({overflow:"visible",height:"auto"});
						});
					}
					return false;
				}else {
					return true;
				}
			});	
		});
	}
	
	/* Search */
	
	jQuery(".header-search").click(function (){
		var header_search = jQuery(".header-search");
		if (header_search.hasClass("header-search-active")) {
			header_search.removeClass("header-search-active");
			header_search.find("i").addClass("fa-search").removeClass("fa-times");
			jQuery(".wrap-search").slideUp(300);
		}else {
			var header = jQuery("#header").height();
			header_search.addClass("header-search-active");
			header_search.find("i").addClass("fa-times").removeClass("fa-search");
			jQuery(".wrap-search").css({"padding-top":header+50});
			jQuery(".wrap-search").slideDown(300);
		}
	});
	
	/* Header follow */
	
	jQuery(".header-follow-a").click(function (){
		var header_follow = jQuery(this).parent();
		if (header_follow.hasClass("header-follow-active")) {
			header_follow.removeClass("header-follow-active");
		}else {
			header_follow.addClass("header-follow-active");
		}
	});
	
	/* Share follow */
	
	jQuery(".post-meta-share > a").click(function (){
		var share_social = jQuery(this).parent();
		if (share_social.hasClass("share-active")) {
			share_social.removeClass("share-active");
		}else {
			share_social.addClass("share-active");
		}
		return false;
	});
	
	jQuery(".facebook-remove").remove();
	
	/* bxSlider */
	
	jQuery(".related-posts.related-posts-full > ul").each(function () {
		var vids = jQuery(".related-post-item",this);
		for(var i = 0; i < vids.length; i+=3) {
		    vids.slice(i,i+3).wrapAll('<li></li>');
		}
	});
	
	jQuery(".related-posts.related-posts-half > ul").each(function () {
		var vids = jQuery(".related-post-item",this);
		for(var i = 0; i < vids.length; i+=2) {
		    vids.slice(i,i+2).wrapAll('<li></li>');
		}
	});
	
	jQuery(".post-gallery .post-img ul,.related-posts > ul,.box-slideshow > ul,.related-posts > div").bxSlider({easing: "linear",tickerHover: true,slideWidth: 1170,adaptiveHeightSpeed: 1500,moveSlides: 1,maxSlides: 1,auto: true});
	
	jQuery(".full-width-slideshow > ul").bxSlider({easing: "linear",tickerHover: true,adaptiveHeightSpeed: 1500,moveSlides: 1,maxSlides: 1,auto: true});
	
	jQuery(".news-ticker-content > ul").bxSlider({easing: "linear",tickerHover: true,slideWidth: 1170,adaptiveHeightSpeed: 1500,moveSlides: 1,maxSlides: 1,auto: true,mode: 'fade'});
	
	/* News */
	
	var vids = jQuery(".block-box-3.col-md-6");
	for(var i = 0; i < vids.length; i+=2) {
	    vids.slice(i,i+2).wrapAll('<div class="row"></div>');
	}

	/* Portfolio */
	
	jQuery(".portfolio-filter ul").each(function() {
		var $this = jQuery(this);
		$this.find("li a").click(function() {
			$this.find("li").removeClass("current");
			jQuery(this).parent().addClass("current");
		});
	});
	
	jQuery(window).load(function() {
		if (jQuery(".portfolio-filter").length > 0) {
			jQuery(".portfolio-filter ul li:first-child a").click();
		}
	});
	
	if (jQuery(".portfolio-filter").length > 0) {
		var $container = jQuery(".portfolio-0 ul");
		$container.isotope({
			filter: "*",
			animationOptions: {
				duration: 750,
				itemSelector: '.isotope-portfolio-item',
				easing: "linear",
				queue: false,
			}
		});
	}
	
	jQuery(".portfolio-filter ul li a").click(function() {
		var selector = jQuery(this).attr("data-filter");
		$container.isotope({
			filter: selector,
			animationOptions: {
				duration: 750,
				itemSelector: '.isotope-portfolio-item',
				easing: "linear",
				queue: false,
			}
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
	
	/* Accordion & Toggle */
	
	jQuery(".accordion .accordion-title").each(function(){
		jQuery(this).click(function() {
			if (jQuery(this).parent().parent().hasClass("toggle-accordion")) {
				jQuery(this).parent().find("li:first .accordion-title").addClass("active");
				jQuery(this).parent().find("li:first .accordion-title").next(".accordion-inner").addClass("active");
				jQuery(this).toggleClass("active");
				jQuery(this).next(".accordion-inner").slideToggle().toggleClass("active");
				jQuery(this).find("i").toggleClass("fa-minus").toggleClass("fa-plus");
			}else {
				if (jQuery(this).next().is(":hidden")) {
					jQuery(this).parent().parent().find(".accordion-title").removeClass("active").next().slideUp(200);
					jQuery(this).parent().parent().find(".accordion-title").next().removeClass("active").slideUp(200);
					jQuery(this).toggleClass("active").next().slideDown(200);
					jQuery(this).next(".accordion-inner").toggleClass("active");
					jQuery(this).parent().parent().find("i").removeClass("fa-plus").addClass("fa-minus");
					jQuery(this).find("i").removeClass("fa-minus").addClass("fa-plus");
				}
			}
			return false;
		});
	});
	
	/* NiceScroll */
	
	if (jQuery(".wrap-nicescroll").length) {
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
	}
	
	/* animation */
	
	if(!mobile_device && jQuery(window).width() > 960) {
		jQuery(".animation").each( function() {
			var $this = jQuery(this);
			var animation = $this.attr("data-animate");
			$this.bind("inview",function(event,isInView,visiblePartX,visiblePartY) {
				if (isInView) {
					$this.css("visibility","visible");
					$this.addClass(animation);
					if(animation.indexOf("fade") === -1) {
						$this.css("opacity","1");
					}
				}
			});
		});
	}else {
		jQuery('.animation').removeClass("animation");
	}
	
	/* post like */
	
	jQuery(".post-like").live("click" ,function() {
		var post_like = jQuery(this);
		var id = post_like.attr('id');
		id = id.replace('post-like-',"");
		post_like.hide();
		
		if (jQuery(this).hasClass("post-like-done")) {
			post_like.show();
		}else {
			jQuery.ajax({
				url: admin_url,
				type: "POST",
				data: { action : 'post_like',id : id },
				success:function(data) {
					post_like.addClass("post-like-done");
					post_like.find("span").html(data);
					post_like.find("i").removeClass("fa-heart-o").addClass("fa-heart");
					post_like.show();
				}
			});
		}
		return false;
	});
	
	/* Post 3 */
	
	if (jQuery(".post-3").length > 0) {
		var $container = jQuery(".blog-all");
		$container.isotope({
			filter: "*",
			animationOptions: {
				duration: 750,
				itemSelector: '.post-3',
				easing: "linear",
				queue: false,
			}
		});
	}
	
	/* Add post */
	
	jQuery(".fileinputs input[type='file']").change(function () {
		var file_fake = jQuery(this);
		file_fake.parent().find("button").text(file_fake.val());
	});
	
	jQuery(".fakefile").click(function () {
		jQuery(this).parent().find("input[type='file']").click();
	});
	
	jQuery('.post_tag').tag();
	
	jQuery(".post-delete").click(function () {
		if (confirm(sure_delete)) {
			return true;
		}else {
			return false;
		}
	});
	
	/* Login */
	
	jQuery(".login-form").submit(function() {
		var thisform = jQuery(this);
		jQuery('.required-error',thisform).remove();
		jQuery('input[type="submit"]',thisform).hide();
		jQuery('.loader_2',thisform).show();
		var fields = jQuery('.inputs',thisform);
		jQuery('.required-item',thisform).each(function () {
			var required = jQuery(this);
			if (required.val() == '') {
				required.after('<span class=required-error>'+logger_error_text+'</span>');
				return false;
			}
		});
	    var data = {
			action: 		'logger_ajax_login_process',
			security: 		jQuery('input[name=\"login_nonce\"]',thisform).val(),
			log: 			jQuery('input[name=\"log\"]',thisform).val(),
			pwd: 			jQuery('input[name=\"pwd\"]',thisform).val(),
			redirect_to:	jQuery('input[name=\"redirect_to\"]',thisform).val()
		};
		jQuery.post(jQuery('input[name=\"ajax_url\"]',thisform).val(),data,function(response) {
			var result = jQuery.parseJSON(response);
			if (result.success == 1) {
				window.location = result.redirect;
			}else if (result.error) {
				jQuery(".logger_error",thisform).hide(10).slideDown(300).html('<strong>'+result.error+'</strong>').delay(2000).slideUp(300);
			}else {
				return true;
			}
			jQuery('.loader_2',thisform).hide();
			jQuery('input[type="submit"]',thisform).show();
		});
		return false;
	});
	
	/* Select */
	
	jQuery(".widget select,select#calc_shipping_country,.woocommerce-sort-by select").wrap('<div class="styled-select"></div>');
	
	/* Widget */
	
	jQuery(".widget li.cat-item,.widget.widget_archive li").each(function(){var e= jQuery(this).contents();e.length>1&&(e.eq(1).wrap('<span class="widget-span"></span>'),e.eq(1).each(function(){}))}).contents();jQuery(".widget li.cat-item .widget-span,.widget.widget_archive li .widget-span").each(function(){jQuery(this).html(jQuery(this).text().substring(2));jQuery(this).html(jQuery(this).text().replace(/\)/gi,""))});jQuery(".widget li.cat-item").length&&jQuery(".widget li.cat-item .widget-span");
	
	/* Woocommerce */
	
	if (jQuery(".woocommerce").length > 0) {
		jQuery("#calc_shipping_state,#calc_shipping_postcode").parent().addClass("col-md-6").addClass("woocommerce-input");
		jQuery(".woocommerce .woocommerce-input").wrapAll('<div class="row"></div>');
		
		jQuery("ul.products li .product-details h3 a").each(function () {
			var shortlink = jQuery(this);
			var txt = shortlink.text();
			shortlink.html(trunc(txt,products_excerpt_title));
		});
	}
	
	function trunc(str,n) {
		return str.substr(0,n-1);
	}
	
	jQuery(document).on('click','.cart_control',function() {
		if (jQuery(this).next('.cart_wrapper').hasClass('cart_wrapper_active')) {
			jQuery(this).next('.cart_wrapper').removeClass('cart_wrapper_active');
			jQuery(this).next('.cart_wrapper').slideUp();
		}else {
			jQuery(this).next('.cart_wrapper').slideDown();
			jQuery(this).next('.cart_wrapper').addClass('cart_wrapper_active');
		}
		return false;
	});
	
	/* Lightbox */
	
	var lightboxArgs = {			
		animation_speed: "fast",
		overlay_gallery: true,
		autoplay_slideshow: false,
		slideshow: 5000,// light_rounded / dark_rounded / light_square / dark_square / facebook
		theme: "pp_default",
		opacity: 0.8,
		show_title: false,
		social_tools: "",
		deeplinking: false,
		allow_resize: true,// Resize the photos bigger than viewport. true/false
		counter_separator_label: "/",// The separator for the gallery counter 1 "of" 2
		default_width: 940,
		default_height: 529
	};
		
	jQuery("a[href$=jpg],a[href$=JPG],a[href$=jpeg],a[href$=JPEG],a[href$=png],a[href$=gif],a[href$=bmp]:has(img)").prettyPhoto(lightboxArgs);
			
	jQuery("a[class^='prettyPhoto'],a[rel^='prettyPhoto']").prettyPhoto(lightboxArgs);
	
	/* Load */
	
	jQuery(window).load(function() {
		
		/* Loader */
		
		jQuery(".loader").fadeOut(500);
		
		/* Post 3 */
		
		if (jQuery(".post-3").length > 0) {
			var $container = jQuery(".blog-all");
			$container.imagesLoaded( function() {
				$container.isotope({
					filter: "*",
					animationOptions: {
						duration: 750,
						itemSelector: '.post-3',
						easing: "linear",
						queue: false,
					}
				});
			});
			setInterval(function() {
		        $container.isotope({
		        	filter: "*",
		        	animationOptions: {
		        		duration: 750,
		        		itemSelector: '.post-3',
		        		easing: "linear",
		        		queue: false,
		        	}
		        });
		    },3000);
		}
		
		/* Sticky sidebar */
		
		if(!mobile_device && jQuery(".sidebar-col .sticky-sidebar").length > 0 && jQuery(window).width() > 960) {
			jQuery(".sidebar-col").stickit({scope: StickScope.Parent});
		}
		
	});
	
})(jQuery);
function logger_get_captcha(captcha_file,captcha_id) {
	var img = jQuery("#"+captcha_id).attr("src",captcha_file+'?'+Math.random());
}