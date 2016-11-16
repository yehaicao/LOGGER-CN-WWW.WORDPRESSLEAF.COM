<?php
$date_format = (vpanel_options("date_format")?vpanel_options("date_format"):get_option("date_format"));

$cats_slideshow = "";
$cats_slideshow = array();
if ($slideshow_display == "single_category") {
	$cats_slideshow = array('cat' => $slideshow_single_category);
}else if ($slideshow_display == "posts") {
	if (isset($slideshow_posts)) {
		$slideshow_posts = explode(",",$slideshow_posts);
	}
	$cats_slideshow = array('post__in' => $slideshow_posts);
}else if ($slideshow_display == "multiple_categories") {
	$cats_slideshow = "";
	if (isset($slideshow_categories) && is_array($slideshow_categories)) {
		foreach ($slideshow_categories as $key => $value) {
			if (isset($custom_slide_show_style) && $custom_slide_show_style == 1) {
				$implode_key_slideshow[] = $value;
			}else {
				if (isset($value) && $value != "") {
					$implode_key_slideshow[] = $key;
				}
			}
		}
		if (isset($implode_key_slideshow) && is_array($implode_key_slideshow)) {
			$cats_slideshow = implode(",",$implode_key_slideshow);
		}
	}
	$cats_slideshow = array('cat' => $cats_slideshow);
}

$implode_thumbnail = "";
$cats_thumbnail = array();
if ($thumbnail_display == "single_category") {
	$cats_thumbnail = array('cat' => $thumbnail_single_category);
}else if ($thumbnail_display == "posts") {
	if (isset($thumbnail_posts)) {
		$thumbnail_posts = explode(",",$thumbnail_posts);
	}
	$cats_thumbnail = array('post__in' => $thumbnail_posts);
}else if ($thumbnail_display == "multiple_categories") {
	$implode_thumbnail = "";
	if (isset($thumbnail_categories) && is_array($thumbnail_categories)) {
		foreach ($thumbnail_categories as $key => $value) {
			if (isset($custom_slide_show_style) && $custom_slide_show_style == 1) {
				$implode_key_thumbnail[] = $value;
			}else {
				if (isset($value) && $value != "") {
					$implode_key_thumbnail[] = $key;
				}
			}
		}
		if (isset($implode_key_thumbnail) && is_array($implode_key_thumbnail)) {
			$implode_thumbnail = implode(",",$implode_key_thumbnail);
		}
	}
	$cats_thumbnail = array('cat' => $implode_thumbnail);
}

$implode_news = "";
$cats_news = array();
if ($news_display == "single_category") {
	$cats_news = array('cat' => $news_single_category);
}else if ($news_display == "posts") {
	$news_posts = explode(",",$news_posts);
	$cats_news = array('post__in' => $news_posts);
}else if ($news_display == "multiple_categories") {
	$implode_news = "";
	if (isset($news_categories) && is_array($news_categories)) {
		foreach ($news_categories as $key => $value) {
			if (isset($custom_slide_show_style) && $custom_slide_show_style == 1) {
				$implode_key_news[] = $value;
			}else {
				if (isset($value) && $value != "") {
					$implode_key_news[] = $key;
				}
			}
		}
		if (isset($implode_key_news) && is_array($implode_key_news)) {
			$implode_news = implode(",",$implode_key_news);
		}
	}
	$cats_news = array('cat' => $implode_news);
}

?>
<div class="head-slide<?php echo ($head_slide == "header"?" head-slide-header":"").($head_slide == "footer"?" head-slide-footer":"").($head_slide_background == "transparent"?" head-slide-transparent":"")?>" <?php if ($head_slide_background == "custom") {?>style='background:<?php if (!empty($head_slide_custom_background)) {?><?php echo esc_attr($head_slide_background_color)?> url(<?php echo esc_attr($head_slide_background_img)?>) <?php echo esc_attr($head_slide_background_repeat)?> <?php echo esc_attr($head_slide_background_position)?> <?php echo esc_attr($head_slide_background_fixed)?>;<?php if ($head_slide_full_screen_background == 'on') {echo "-webkit-background-size: cover;-moz-background-size: cover;-o-background-size: cover;background-size: cover;";} }?>'<?php }?>>
	<div class="container<?php echo ($head_slide_style == "video_full"?" video_full":"")?>">
		<div class="row">
			<?php if ($news_ticker == "on") {?>
				<div class="col-md-12">
					<div class="news-ticker">
						<div class="news-ticker-title"><i class="fa fa-bell"></i><?php _e("Breaking News","vbegy")?></div>
						<div class="news-ticker-content">
							<ul>
								<?php if ($orderby_news == "popular") {
									$orderby_news = array('orderby' => 'comment_count');
								}else if ($orderby_news == "random") {
									$orderby_news = array('orderby' => 'rand');
								}else {
									$orderby_news = array();
								}
								query_posts(array_merge($orderby_news,$cats_news,array('ignore_sticky_posts' => 1,'posts_per_page' => $news_number)));
								if ( have_posts() ) :
								while ( have_posts() ) : the_post();?>
									<li>
										<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php excerpt_title($news_excerpt_title);?></a>
									</li>
								<?php endwhile;endif;wp_reset_query();?>
							</ul>
						</div><!-- End news-ticker-content -->
					</div><!-- End news-ticker -->
				</div><!-- End col-md-12 -->
			<?php }?>
			<div class="<?php echo ($head_slide_style == "slideshow_thumbnail" || $head_slide_style == "thumbnail_slideshow"?"col-md-8":"col-md-12").($head_slide_style == "thumbnail_slideshow"?" thumbnail-slideshow":"")?>">
				<?php if ($head_slide != "none") {
					if ($head_slide_style == "video_full" || $head_slide_style == "video_container") {
						?>
						<div class="video-section">
							<?php if ($video_head == "embed") {
								echo ($custom_embed_head);
							}else {
								if ($video_head == 'youtube') {
									$type = "http://www.youtube.com/embed/".$video_id_head;
								}else if ($video_head == 'vimeo') {
									$type = "http://player.vimeo.com/video/".$video_id_head;
								}else if ($video_head == 'daily') {
									$type = "http://www.dailymotion.com/swf/video/".$video_id_head;
								}
								echo '<iframe frameborder="0" allowfullscreen height="430" src="'.$type.'"></iframe>';
							}?>
						</div>
					<?php }
					if ($head_slide_style == "slideshow_thumbnail" || $head_slide_style == "thumbnail_slideshow" || $head_slide_style == "slideshow") {?>
						<div class="box-slideshow<?php echo ($head_slide_style == "slideshow"?" block-box-full":"")?>">
							<ul>
								<?php if ($orderby_slide == "popular") {
									$orderby_slide = array('orderby' => 'comment_count');
								}else if ($orderby_slide == "random") {
									$orderby_slide = array('orderby' => 'rand');
								}else {
									$orderby_slide = array();
								}
								query_posts(array_merge($orderby_slide,$cats_slideshow,array('ignore_sticky_posts' => 1,'posts_per_page' => $slideshow_number)));
								if ( have_posts() ) :
								while ( have_posts() ) : the_post();
									$post_username = get_post_meta($post->ID, 'post_username',true);
									$post_email = get_post_meta($post->ID, 'post_email',true);
									if (has_post_thumbnail()) {?>
										<li>
											<div class="box-slideshow-main">
												<div class="box-slideshow-img">
													<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark">
														<?php if ($head_slide_style == "slideshow") {
															echo get_aq_resize_img('full',1140,641);
														}else {
															echo get_aq_resize_img('full',750,422);
														}?>
													</a>
												</div>
												<?php if ($slide_overlay == "enable" || $slide_overlay == "title") {
													$author_by = vpanel_options("author_by");?>
													<div class="box-slideshow-content">
														<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php excerpt_title($excerpt_title_slideshow);?></a>
														<div class="clearfix"></div>
														<?php if ($slide_overlay != "title") {?>
															<p><?php excerpt($excerpt_slideshow);?></p>
															<?php if ($author_by == 'on') {?>
																<span><i class="fa fa-user"></i><?php _e("by","vbegy")?> : <?php echo ($post->post_author > 0?the_author_posts_link():$post_username);?></span>
															<?php }?>
															<span><i class="fa fa-clock-o"></i><?php the_time($date_format);?></span>
															<div class="clearfix"></div>
														<?php }?>
													</div>
												<?php }?>
											</div>
										</li>
									<?php }
								endwhile;endif;wp_reset_query();?>
							</ul>
						</div><!-- End box-slideshow -->
					<?php }else if ($head_slide_style == "thumbnail") {?>
						<div class="row">
							<ul>
								<?php if ($orderby_thumbnail == "popular") {
									$orderby_thumbnail = array('orderby' => 'comment_count');
								}else if ($orderby_thumbnail == "random") {
									$orderby_thumbnail = array('orderby' => 'rand');
								}else {
									$orderby_thumbnail = array();
								}
								query_posts(array_merge($orderby_thumbnail,$cats_thumbnail,array('ignore_sticky_posts' => 1,'posts_per_page' => $thumbnail_number)));
								if ( have_posts() ) :
								$post_width = 360;
								$post_height = 196;
								while ( have_posts() ) : the_post();
									$vbegy_what_post = rwmb_meta('vbegy_what_post','select',$post->ID);
									$video_id = rwmb_meta('vbegy_video_post_id',"select",$post->ID);
									$video_type = rwmb_meta('vbegy_video_post_type',"text",$post->ID);
									$post_username = get_post_meta($post->ID, 'post_username',true);
									$post_email = get_post_meta($post->ID, 'post_email',true);
									if ($video_type == 'youtube') {
										$type = "http://www.youtube.com/embed/".$video_id;
									}else if ($video_type == 'vimeo') {
										$type = "http://player.vimeo.com/video/".$video_id;
									}else if ($video_type == 'daily') {
										$type = "http://www.dailymotion.com/swf/video/".$video_id;
									}
									$vbegy_slideshow_type = rwmb_meta('vbegy_slideshow_type','select',$post->ID);
									if (has_post_thumbnail() || $vbegy_what_post == "video") {?>
										<li class="col-md-4">
											<div class="related-post-item">
												<div class="related-post-one">
													<div class="related-post-img">
														<a itemprop="url" href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark">
															<?php
															if ($vbegy_what_post == "image" || $vbegy_what_post == "slideshow") {
																if (has_post_thumbnail() && $vbegy_what_post == "image") {
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
														<a itemprop="url" href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php excerpt_title($excerpt_title_thumbnail)?></a>
														<span><i class="fa fa-clock-o"></i><?php the_time($date_format);?></span>
														<span><i class="fa fa-comments"></i><?php comments_popup_link(__('0 Comments', 'vbegy'), __('1 Comment', 'vbegy'), '% '.__('Comments', 'vbegy'));?></span>
													</div>
												</div>
											</div>
										</li>
									<?php }
								endwhile;endif;wp_reset_query();?>
							</ul>
						</div>
					<?php }
				}?>
			</div>
			<?php if ($head_slide_style == "slideshow_thumbnail" || $head_slide_style == "thumbnail_slideshow") {?>
				<div class="col-md-4">
					<ul class="head-posts">
						<?php if ($orderby_thumbnail == "popular") {
							$orderby_thumbnail = array('orderby' => 'comment_count');
						}else if ($orderby_thumbnail == "random") {
							$orderby_thumbnail = array('orderby' => 'rand');
						}else {
							$orderby_thumbnail = array();
						}
						query_posts(array_merge($orderby_thumbnail,$cats_thumbnail,array('ignore_sticky_posts' => 1,'posts_per_page' => 2)));
						if ( have_posts() ) :
						$post_width = 360;
						$post_height = 196;
						while ( have_posts() ) : the_post();
							$vbegy_what_post = rwmb_meta('vbegy_what_post','select',$post->ID);
							$video_id = rwmb_meta('vbegy_video_post_id',"select",$post->ID);
							$video_type = rwmb_meta('vbegy_video_post_type',"text",$post->ID);
							$post_username = get_post_meta($post->ID, 'post_username',true);
							$post_email = get_post_meta($post->ID, 'post_email',true);
							if ($video_type == 'youtube') {
								$type = "http://www.youtube.com/embed/".$video_id;
							}else if ($video_type == 'vimeo') {
								$type = "http://player.vimeo.com/video/".$video_id;
							}else if ($video_type == 'daily') {
								$type = "http://www.dailymotion.com/swf/video/".$video_id;
							}
							$vbegy_slideshow_type = rwmb_meta('vbegy_slideshow_type','select',$post->ID);
							if (has_post_thumbnail() || $vbegy_what_post == "video") {?>
								<li>
									<div class="related-post-item">
										<div class="related-post-one">
											<div class="related-post-img">
												<a itemprop="url" href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark">
													<?php
													if ($vbegy_what_post == "image" || $vbegy_what_post == "slideshow") {
														if (has_post_thumbnail() && $vbegy_what_post == "image") {
															echo get_aq_resize_img('full',$post_width,$post_height,$img_lightbox = "lightbox");
														}else if (has_post_thumbnail() && $vbegy_what_post == "slideshow") {
															echo get_aq_resize_img('full',$post_width,$post_height);
														}
													}else if ($vbegy_what_post == "video") {
														if ($video_type == "embed") {
															echo rwmb_meta('vbegy_custom_embed',"textarea",$post->ID);
														}else {
															echo '<iframe frameborder="0" allowfullscreen height="'.$post_height.'" src="'.$type.'"></iframe>';
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
												<a itemprop="url" href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php excerpt_title($excerpt_title_thumbnail)?></a>
												<span><i class="fa fa-clock-o"></i><?php the_time($date_format);?></span>
												<span><i class="fa fa-comments"></i><?php comments_popup_link(__('0 Comments', 'vbegy'), __('1 Comment', 'vbegy'), '% '.__('Comments', 'vbegy'));?></span>
											</div>
										</div>
									</div>
								</li>
							<?php }
						endwhile;endif;wp_reset_query();?>
					</ul>
				</div>
				<?php if (isset($thumbnail_number) && $thumbnail_number > 2) {
					$thumbnail_number = $thumbnail_number-2;?>
					<div class="clearfix"></div>
					<ul class="head-posts-thumbnail">
						<?php if ($orderby_thumbnail == "popular") {
							$orderby_thumbnail = array('orderby' => 'comment_count');
						}else if ($orderby_thumbnail == "random") {
							$orderby_thumbnail = array('orderby' => 'rand');
						}else {
							$orderby_thumbnail = array();
						}
						query_posts(array_merge($orderby_thumbnail,$cats_thumbnail,array('ignore_sticky_posts' => 1,'posts_per_page' => $thumbnail_number,'offset' => 2)));
						if ( have_posts() ) :
						$post_width = 360;
						$post_height = 196;
						while ( have_posts() ) : the_post();
							$vbegy_what_post = rwmb_meta('vbegy_what_post','select',$post->ID);
							$video_id = rwmb_meta('vbegy_video_post_id',"select",$post->ID);
							$video_type = rwmb_meta('vbegy_video_post_type',"text",$post->ID);
							$post_username = get_post_meta($post->ID, 'post_username',true);
							$post_email = get_post_meta($post->ID, 'post_email',true);
							if ($video_type == 'youtube') {
								$type = "http://www.youtube.com/embed/".$video_id;
							}else if ($video_type == 'vimeo') {
								$type = "http://player.vimeo.com/video/".$video_id;
							}else if ($video_type == 'daily' || $video_type == 'embed') {
								$type = "http://www.dailymotion.com/swf/video/".$video_id;
							}
							$vbegy_slideshow_type = rwmb_meta('vbegy_slideshow_type','select',$post->ID);
							if (has_post_thumbnail() || $vbegy_what_post == "video") {?>
								<li class="col-md-4 col-sm-6">
									<div class="related-post-item">
										<div class="related-post-one">
											<div class="related-post-img">
												<a itemprop="url" href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark">
													<?php
													if ($vbegy_what_post == "image" || $vbegy_what_post == "slideshow") {
														if (has_post_thumbnail() && $vbegy_what_post == "image") {
															echo get_aq_resize_img('full',$post_width,$post_height,$img_lightbox = "lightbox");
														}else if (has_post_thumbnail() && $vbegy_what_post == "slideshow") {
															echo get_aq_resize_img('full',$post_width,$post_height);
														}
													}else if ($vbegy_what_post == "video") {
														if ($video_type == "embed") {
															echo rwmb_meta('vbegy_custom_embed',"textarea",$post->ID);
														}else {
															echo '<iframe frameborder="0" allowfullscreen height="'.$post_height.'" src="'.$type.'"></iframe>';
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
												<a itemprop="url" href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php excerpt_title($excerpt_title_thumbnail)?></a>
												<span><i class="fa fa-clock-o"></i><?php the_time($date_format);?></span>
												<span><i class="fa fa-comments"></i><?php comments_popup_link(__('0 Comments', 'vbegy'), __('1 Comment', 'vbegy'), '% '.__('Comments', 'vbegy'));?></span>
											</div>
										</div>
									</div>
								</li>
							<?php }
						endwhile;endif;wp_reset_query();?>
					</ul>
				<?php }
			}?>
		</div><!-- End row -->
	</div><!-- End container -->
</div>