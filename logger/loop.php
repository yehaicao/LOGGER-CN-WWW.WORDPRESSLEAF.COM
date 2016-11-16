<?php
global $vbegy_sidebar,$post_style,$vbegy_sidebar_all,$posts_meta,$post_type_option,$post_author,$post_excerpt_title,$post_excerpt,$post_share,$post_views,$page_tamplate,$post,$post_display,$post_number,$post_single_category,$post_categories,$vbegy_post_columns,$post_portfolio_type,$vbegy_post_margin,$vbegy_post_options,$post_pagination;
$date_format = (vpanel_options("date_format")?vpanel_options("date_format"):get_option("date_format"));
if ($page_tamplate != true) {
	$posts_meta = vpanel_options("post_meta");
	$post_type_option = vpanel_options("post_type");
	$post_author = vpanel_options("post_author");
	$post_excerpt_title = vpanel_options("post_excerpt_title");
	$post_excerpt = vpanel_options("post_excerpt");
	$post_share = vpanel_options("post_share");
	$post_views = vpanel_options("post_views");
}
$post_excerpt_title = (isset($post_excerpt_title) && $post_excerpt_title != ""?$post_excerpt_title:5);
$post_excerpt = (isset($post_excerpt) && $post_excerpt != ""?$post_excerpt:40);

$page_id = "";
if (isset($post->ID) && (int)$post->ID > 0) {
	$page_id = $post->ID;
}
if ($page_tamplate == true || is_page() || is_category()) {
	$page_category = "yes";
}else {
	$page_category = "";
}
$vbegy_sidebar = $vbegy_sidebar_all;
$author_by = vpanel_options("author_by");
$taxonomy = 'category';
if ($post_style == "portfolio_style") {
	if ($vbegy_sidebar == "full") {
		if (isset($vbegy_post_columns) && $vbegy_post_columns == "2_columns") {
			$post_columns = "col-md-6";
			if (isset($vbegy_post_margin) && $vbegy_post_margin == "yes") {
				$portfolio_width = 555;
				$portfolio_height = 370;
			}else {
				$portfolio_width = 570;
				$portfolio_height = 380;
			}
		}else if (isset($vbegy_post_columns) && $vbegy_post_columns == "4_columns") {
			$post_columns = "col-md-3";
			if (isset($vbegy_post_margin) && $vbegy_post_margin == "yes") {
				$portfolio_width = 265;
				$portfolio_height = 175;
			}else {
				$portfolio_width = 285;
				$portfolio_height = 189;
			}
		}else {
			$post_columns = "col-md-4";
			if (isset($vbegy_post_margin) && $vbegy_post_margin == "yes") {
				$portfolio_width = 360;
				$portfolio_height = 275;
			}else {
				$portfolio_width = 380;
				$portfolio_height = 255;
			}
		}
	}else {
		if (isset($vbegy_post_columns) && $vbegy_post_columns == "2_columns") {
			$post_columns = "col-md-6";
			if (isset($vbegy_post_margin) && $vbegy_post_margin == "yes") {
				$portfolio_width = 360;
				$portfolio_height = 201;
			}else {
				$portfolio_width = 371;
				$portfolio_height = 206;
			}
		}else if (isset($vbegy_post_columns) && $vbegy_post_columns == "4_columns") {
			$post_columns = "col-md-3";
			if (isset($vbegy_post_margin) && $vbegy_post_margin == "yes") {
				$portfolio_width = 165;
				$portfolio_height = 144;
			}else {
				$portfolio_width = 184;
				$portfolio_height = 121;
			}
		}else {
			$post_columns = "col-md-4";
			if (isset($vbegy_post_margin) && $vbegy_post_margin == "yes") {
				$portfolio_width = 230;
				$portfolio_height = 176;
			}else {
				$portfolio_width = 246;
				$portfolio_height = 166;
			}
		}
	}
	if (isset($vbegy_post_options) && ($vbegy_post_options == "filter" || $vbegy_post_options == "filter_pagination") && ($post_display == "lasts" || $post_display == "multiple_categories")) {?>
		<div class="row">
			<div class="col-md-12 portfolio-filter">
				<ul>
					<li class="current"><a href="#" data-filter="*"><?php _e('All', 'vbegy'); ?></a></li>
					<?php
					$args = array();
					if (isset($post_display) && $post_display == "multiple_categories") {
						$args = array("include" => $post_categories);
					}
					$portfolio_filter = get_terms($taxonomy,$args);
					$count = count($portfolio_filter);
					if ($count > 0) {
						foreach ($portfolio_filter as $portfolio_filter_item) {
							echo '<li><a href="#" data-filter=".term-'.$portfolio_filter_item->term_id.'">'.$portfolio_filter_item->name.'</a></li>';
						}
					}
					?>
				</ul>
			</div>
		</div><!-- End row -->
	<?php }
	if (have_posts()) :?>
		<div class="row portfolio-all <?php echo (isset($vbegy_post_margin) && $vbegy_post_margin == "yes"?"":"portfolio-no-margin")?> portfolio-0">
			<ul>
				<?php while ( have_posts() ) : the_post();
					$terms = get_the_terms( $post->ID, $taxonomy);
					$portfolio_category = wp_get_post_terms($post->ID,$taxonomy,array("fields" => "all"));
					$vbegy_what_post = rwmb_meta('vbegy_what_post','select',$post->ID);?>
					<li class="<?php echo esc_attr($post_columns)?> col-sm-6 <?php if (isset($terms) && is_array($terms)) {foreach ($terms as $term ) {echo 'term-'.$term->term_id.' ';}}?> portfolio-item <?php echo (isset($post_portfolio_type) && $post_portfolio_type == "style_2"?"portfolio-item-2":"")?> isotope-portfolio-item">
						<div class="portfolio-one">
							<?php if (has_post_thumbnail()) {?>
								<div class="portfolio-head">
									<div class="portfolio-img">
										<?php echo get_aq_resize_img('full',$portfolio_width,$portfolio_height,$img_lightbox = "lightbox");?>
									</div>
									<?php if (isset($post_portfolio_type) && $post_portfolio_type == "style_2") {?>
										<div class="portfolio-hover">
											<div class="portfolio-meta">
												<div class="portfolio-name"><h6><a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title()?></a></h6></div>
												<div class="portfolio-desc"><p><?php excerpt($post_excerpt)?></p></div>
											</div><!-- End portfolio-meta -->
										</div>
									<?php }?>
								</div><!-- End portfolio-head -->
							<?php }?>
							<?php if (isset($post_portfolio_type) && $post_portfolio_type == "style_1") {?>
								<div class="portfolio-content">
									<div class="portfolio-meta">
										<div class="portfolio-name"><h6><a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title()?></a></h6></div>
										<?php if (isset($portfolio_category[0])) {?>
											<div class="portfolio-cat"><?php echo get_the_term_list( $post->ID, $taxonomy, '', ', ', '' )?></div>
										<?php }?>
									</div><!-- End portfolio-meta -->
								</div><!-- End portfolio-content -->
							<?php }?>
						</div><!-- End portfolio-item -->
					</li>
				<?php endwhile;?>
			</ul>
		</div><!-- End portfolio-0 -->
	<?php else:?>
		<div class="post">
			<div class="post-wrap">
				<div class="post-inner">
					<div class="page-404">
						<h3><?php _e("Sorry, no posts yet .","vbegy")?></h3><a class="button-default" href="<?php echo esc_url(home_url('/'));?>"><?php _e("Back To Homepage","vbegy")?></a>
					</div>
					<div class="clearfix"></div>
				</div><!-- End post-inner -->
			</div><!-- End post-wrap -->
		</div><!-- End post -->
	<?php endif;
}else if ($post_style == "style_4" || $post_style == "style_5") {
	if ( have_posts() ) : ?>
		<div class="block-box<?php echo ($vbegy_sidebar == "full"?" block-box-full":"")?>">
			<?php if ($page_category == "yes") {?>
				<div class="block-box-title"><?php echo ($page_tamplate == true || is_page()?get_the_title($page_id):single_cat_title( '', false ));?></div>
			<?php }?>
			<div class="block-box-1 <?php echo ($post_style == "style_4"?"block-recent-1":"").($post_style == "style_5"?" block-box-2 block-box-4":"")?>">
				<ul>
					<?php while ( have_posts() ) : the_post();
						$vbegy_what_post = rwmb_meta('vbegy_what_post','select',$post->ID);
						$video_type = rwmb_meta('vbegy_video_post_type',"select",$post->ID);
						$post_username = get_post_meta($post->ID, 'post_username',true);
						$post_email = get_post_meta($post->ID, 'post_email',true);?>
						<li<?php echo ($post_style == "style_5"?" class='block-box-first'":"")?>>
							<?php if (has_post_thumbnail()) {?>
								<div class="block-box-img">
									<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark">
										<i class="fa fa-<?php if (is_sticky()) {?>thumb-tack<?php }else if ($vbegy_what_post == "google") {?>map-marker<?php }else if ($vbegy_what_post == "audio") {?>volume-up<?php }else if ($vbegy_what_post == "video") {if ($video_type == 'youtube') {?>youtube-play<?php }else if ($video_type == 'vimeo') {?>vimeo-square<?php }else if ($video_type == 'daily' || $video_type == 'embed') {?>video-camera<?php }?><?php }else if ($vbegy_what_post == "slideshow") {?>film<?php }else if ($vbegy_what_post == "quote") {?>quote-left<?php }else if ($vbegy_what_post == "link") {?>link<?php }else if ($vbegy_what_post == "soundcloud") {?>soundcloud<?php }else if ($vbegy_what_post == "twitter") {?>twitter<?php }else if ($vbegy_what_post == "facebook") {?>facebook<?php }else {if (has_post_thumbnail()) {?>image<?php }else {?>file-text<?php }}?>"></i>
										<?php if ($post_style == "style_5") {
											echo get_aq_resize_img('full',345,240);
										}else {
											echo get_aq_resize_img('full',130,130);
										}
										?>
									</a>
								</div>
							<?php }?>
							<div class="block-box-content">
								<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title();?></a>
								<?php if ($posts_meta == "on") {
									if ($author_by == 'on') {?>
										<span><i class="fa fa-user"></i><?php _e("by","vbegy")?> : <?php echo ($post->post_author > 0?the_author_posts_link():$post_username);?></span>
									<?php }?>
									<span><i class="fa fa-clock-o"></i><?php the_time($date_format);?></span>
								<?php }?>
								<div class="clearfix"></div>
								<p><?php excerpt($post_excerpt);if ($post_style == "style_4") {?> <a class="color" href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php _e("Continue Reading","vbegy")?></a><?php }?></p>
								<?php if ($post_style == "style_5") {?>
									<a class="button-default post-more" href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php _e("Continue Reading","vbegy")?></a>
								<?php }?>
							</div>
						</li>
					<?php endwhile;?>
				</ul>
				<div class="clearfix"></div>
			</div>
		</div><!-- End block-box -->
		<div class="clearfix"></div>
	<?php else :?>
		<div class="post">
			<div class="post-wrap">
				<div class="post-inner">
					<div class="page-404">
						<h3><?php _e("Sorry, no posts yet .","vbegy")?></h3><a class="button-default" href="<?php echo esc_url(home_url('/'));?>"><?php _e("Back To Homepage","vbegy")?></a>
					</div>
					<div class="clearfix"></div>
				</div><!-- End post-inner -->
			</div><!-- End post-wrap -->
		</div><!-- End post -->
		<div class="clearfix"></div>
	<?php endif;
}else if ($post_style == "style_6") {
	if ( have_posts() ) :?>
		<div class="block-box<?php echo ($vbegy_sidebar == "full"?" block-box-full block-box-full-5":"")?>">
			<?php if ($page_category == "yes") {?>
				<div class="block-box-title"><?php echo ($page_tamplate == true || is_page()?get_the_title($page_id):single_cat_title( '', false ));?></div>
			<?php }?>
			<div class="block-box-1 block-box-5">
				<ul>
					<?php while ( have_posts() ) : the_post();
						$vbegy_what_post = rwmb_meta('vbegy_what_post','select',$post->ID);
						$video_type = rwmb_meta('vbegy_video_post_type',"select",$post->ID);
						$post_username = get_post_meta($post->ID, 'post_username',true);
						$post_email = get_post_meta($post->ID, 'post_email',true);?>
						<li class="block-box-first">
							<?php if (has_post_thumbnail()) {?>
								<div class="block-box-img">
									<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark">
										<i class="fa fa-<?php if (is_sticky()) {?>thumb-tack<?php }else if ($vbegy_what_post == "google") {?>map-marker<?php }else if ($vbegy_what_post == "audio") {?>volume-up<?php }else if ($vbegy_what_post == "video") {if ($video_type == 'youtube') {?>youtube-play<?php }else if ($video_type == 'vimeo') {?>vimeo-square<?php }else if ($video_type == 'daily' || $video_type == 'embed') {?>video-camera<?php }?><?php }else if ($vbegy_what_post == "slideshow") {?>film<?php }else if ($vbegy_what_post == "quote") {?>quote-left<?php }else if ($vbegy_what_post == "link") {?>link<?php }else if ($vbegy_what_post == "soundcloud") {?>soundcloud<?php }else if ($vbegy_what_post == "twitter") {?>twitter<?php }else if ($vbegy_what_post == "facebook") {?>facebook<?php }else {if (has_post_thumbnail()) {?>image<?php }else {?>file-text<?php }}?>"></i>
										<?php echo get_aq_resize_img('full',345,165);?>
									</a>
								</div>
							<?php }?>
							<div class="block-box-content">
								<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php excerpt_title($post_excerpt_title);?></a>
								<?php if ($posts_meta == "on") {
									if ($author_by == 'on') {?>
										<span><i class="fa fa-user"></i><?php _e("by","vbegy")?> : <?php echo ($post->post_author > 0?the_author_posts_link():$post_username);?></span>
									<?php }?>
									<span><i class="fa fa-clock-o"></i><?php the_time($date_format);?></span>
								<?php }?>
								<div class="clearfix"></div>
								<p><?php excerpt($post_excerpt);?></p>
								<a class="button-default post-more" href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php _e("Continue Reading","vbegy")?></a>
							</div>
						</li>
					<?php endwhile;?>
				</ul>
				<div class="clearfix"></div>
			</div>
		</div><!-- End block-box -->
		<div class="clearfix"></div>
	<?php else :?>
		<div class="post">
			<div class="post-wrap">
				<div class="post-inner">
					<div class="page-404">
						<h3><?php _e("Sorry, no posts yet .","vbegy")?></h3><a class="button-default" href="<?php echo esc_url(home_url('/'));?>"><?php _e("Back To Homepage","vbegy")?></a>
					</div>
					<div class="clearfix"></div>
				</div><!-- End post-inner -->
			</div><!-- End post-wrap -->
		</div><!-- End post -->
	<?php endif;
}else {
	if (have_posts() ) : while (have_posts() ) : the_post();
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
		$vbegy_what_post = rwmb_meta('vbegy_what_post','select',$post->ID);
		$vbegy_google = rwmb_meta('vbegy_google',"textarea",$post->ID);
		$vbegy_quote_author = rwmb_meta('vbegy_quote_author',"text",$post->ID);
		$vbegy_quote_icon_color = rwmb_meta('vbegy_quote_icon_color',"color",$post->ID);
		$quote_icon_color = (isset($vbegy_quote_icon_color) && $vbegy_quote_icon_color != ""?"style='color:".$vbegy_quote_icon_color.";'":"");
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
			$custom_embed = rwmb_meta('vbegy_custom_embed',"text",$post->ID);
		}
		
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
	    if ($post_type_option == 'on' && $post_author == 'on' && ($post_style == 'style_1' || $post_style == 'style_7')) {
	    	$post_type = " post-2".$post_type;
	    }
	    if ($post_style == "style_2" || ($post_style == "style_3" && $vbegy_sidebar != "full")) {
	    	$post_type = " post-3 col-md-6".$post_type;
	    }
	    if ($post_style == "style_3" && $vbegy_sidebar == "full") {
	    	$post_type = " post-3 col-md-4".$post_type;
	    }
	    if ($post_style != "style_2" && $post_style != "style_3") {
	    	$post_type = " animation".$post_type;
	    }
	    if ($post_style == "style_7") {
	    	$post_type = " animation post-style-7".$post_type;
	    }
	    
	    $post_username = get_post_meta($post->ID, 'post_username',true);
	    $post_email = get_post_meta($post->ID, 'post_email',true);?>
	    <article <?php post_class('post clearfix '.$post_type);?> data-animate="fadeInUp" role="article" itemscope="" itemtype="http://schema.org/Article">
	    	<?php if ($post_type_option == 'on') {?>
		    	<div class="post-type"><i class="fa fa-<?php if (is_sticky()) {?>thumb-tack<?php }else if ($vbegy_what_post == "google") {?>map-marker<?php }else if ($vbegy_what_post == "audio") {?>volume-up<?php }else if ($vbegy_what_post == "video") {if ($video_type == 'youtube') {?>youtube-play<?php }else if ($video_type == 'vimeo') {?>vimeo-square<?php }else if ($video_type == 'daily' || $video_type == 'embed') {?>video-camera<?php }?><?php }else if ($vbegy_what_post == "slideshow") {?>film<?php }else if ($vbegy_what_post == "quote") {?>quote-left<?php }else if ($vbegy_what_post == "link") {?>link<?php }else if ($vbegy_what_post == "soundcloud") {?>soundcloud<?php }else if ($vbegy_what_post == "twitter") {?>twitter<?php }else if ($vbegy_what_post == "facebook") {?>facebook<?php }else {if (has_post_thumbnail()) {?>image<?php }else {?>file-text<?php }}?>"></i></div>
	    	<?php }
	    	if ($post_author == 'on') {
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
	    	<?php }?>
	    	<div class="post-head"><h1><a itemprop="url" href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title();?></a></h1>
	    		<?php if ($posts_meta == 'on') {
	    			$category_post = vpanel_options("category_post");?>
		    		<div class="post-meta">
		    			<?php if ($author_by == 'on') {?>
		    				<div><i class="fa fa-user"></i><?php _e("by","vbegy")?> : <?php echo ($post->post_author > 0?the_author_posts_link():$post_username);?></div>
		    			<?php }?>
		    			<div><i class="fa fa-clock-o"></i><?php the_time($date_format);?></div>
		    			<?php if ((($post_style == "style_2" && $vbegy_sidebar == "full") && $post_style != "style_3") || ($post_style == 'style_1' || $post_style == 'style_7')) {?>
			    			<div><i class="fa fa-comments"></i><?php comments_popup_link(__('0 Comments', 'vbegy'), __('1 Comment', 'vbegy'), '% '.__('Comments', 'vbegy'));?></div>
		    			<?php }
		    			if ($post_style != "style_2" && $post_style != "style_3") {
		    				if ($category_post == 'on') {?>
			    				<div><i class="fa fa-folder-open"></i><?php _e("in","vbegy")?> : <?php the_category(' , ');?></div>
		    				<?php }
		    			}
		    			if ((($post_style == "style_2" && $vbegy_sidebar == "full") && $post_style != "style_3") || ($post_style == 'style_1' || $post_style == 'style_7')) {
			    			$post_like = get_post_meta($post->ID,"post_like",true);
			    			$like_yes = "";
			    			if (isset($_COOKIE['logger_post_like'.$post->ID]) && $_COOKIE['logger_post_like'.$post->ID] == "logger_like_yes") {
			    				$like_yes = "logger_like_yes";
			    			}
			    			?>
			    			<div><a class="post-like <?php echo ($like_yes == "logger_like_yes"?"post-like-done":"")?>" title="<?php echo ($like_yes == "logger_like_yes"?__("You already like this","vbegy"):__("Love","vbegy"))?>" id="post-like-<?php the_ID();?>"><i class="fa <?php echo ($like_yes == "logger_like_yes"?"fa-heart":"fa-heart-o")?>"></i><span><?php echo (isset($post_like) && $post_like != ""?$post_like:0)?></span></a></div>
			    		<?php }?>
		    		</div><!-- End post-meta -->
	    		<?php }?>
	    		<div class="clearfix"></div>
	    	</div><!-- End post-head -->
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
	    		<?php }
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
		    					<?php the_content();?>
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
	    							<span><?php echo esc_attr($vbegy_link)?></span>
	    						</div>
	    					</a><!-- End post-inner -->
	    				<?php }
	    			}else {
	    				if ($vbegy_what_post != "link" && $vbegy_what_post != "quote") {?>
	    			    	<p><?php excerpt($post_excerpt);?></p>
	    				<?php }
	    			}
	    		if ($vbegy_what_post != "link" && $vbegy_what_post != "quote") {?>
		    			<div class="clearfix"></div>
		    			<div class="post-share-view">
		    				<div class="post-meta">
		    					<?php if ($post_views == "on") {
			    					$post_stats = get_post_meta($post->ID, 'post_stats', true)?>
			    					<div><i class="fa fa-eye"></i><span><?php echo (isset($post_stats) && $post_stats != ""?(int)$post_stats:0)?> </span><?php _e("Views","vbegy")?></div>
	    						<?php }
	    						if ((($post_style == "style_2" && $vbegy_sidebar == "full") && $post_style != "style_3") || ($post_style == 'style_1' || $post_style == 'style_7')) {
		    						if ($post_share == "on") {?>
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
			    				}?>
		    					<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark" class="button-default post-more"><?php _e("Continue Reading","vbegy");?></a>
		    				</div><!-- End post-meta -->
		    			</div><!-- End post-share-view -->
		    			<div class="clearfix"></div>
		    		</div><!-- End post-inner -->
	    		<?php }?>
	    	</div><!-- End post-wrap -->
	    </article><!-- End post -->
	<?php endwhile;else :?>
		<div class="post">
			<div class="post-wrap">
				<div class="post-inner">
					<div class="page-404">
						<h3><?php _e("Sorry, no posts yet .","vbegy")?></h3><a class="button-default" href="<?php echo esc_url(home_url('/'));?>"><?php _e("Back To Homepage","vbegy")?></a>
					</div>
					<div class="clearfix"></div>
				</div><!-- End post-inner -->
			</div><!-- End post-wrap -->
		</div><!-- End post -->
	<?php endif;
}?>