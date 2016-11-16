<?php get_header();
	$vbegy_sidebar_all = vpanel_options("author_sidebar_layout");
	$post_style = vpanel_options("author_post_style");
	$author_img = vpanel_options("author_img");
	$vbegy_sidebar = $vbegy_sidebar_all;
	if (is_author()) {
		$get_query_var = get_query_var("author");
	}else {
		$get_query_var = esc_attr($_GET['u']);
	}
	$user_login = get_userdata($get_query_var);
	$you_avatar = get_the_author_meta('you_avatar',$user_login->ID);
	$twitter = get_the_author_meta('twitter',$user_login->ID);
	$facebook = get_the_author_meta('facebook',$user_login->ID);
	$google = get_the_author_meta('google',$user_login->ID);
	$linkedin = get_the_author_meta('linkedin',$user_login->ID);
	$youtube = get_the_author_meta('youtube',$user_login->ID);
	
	$owner = false;
	if($user_ID == $user_login->ID){
		$owner = true;
	}
	?>
	<div class="post post-style-2">
		<?php if ($author_img == "on") {?>
			<div class="post-author">
				<?php if ($you_avatar) {
					$you_avatar_img = get_aq_resize_url(esc_attr($you_avatar),"full",70,70);
					echo "<img alt='".$user_login->display_name."' src='".$you_avatar_img."'>";
				}else {
					echo get_avatar(get_the_author_meta('user_email'),'70','');
				}?>
			</div>
		<?php }?>
		<div class="post-wrap">
			<div class="post-inner">
				<div class="post-title"><i class="fa fa-user"></i><?php echo esc_attr($user_login->display_name)?></div>
				<p><?php echo esc_attr($user_login->description)?></p>
				<?php if ($facebook || $twitter || $linkedin || $google || $youtube) { ?>
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
	
	<?php
	if ($post_style != "slider") {
		if ($post_style == "style_2" || $post_style == "style_3") {echo "<div class='row blog-all isotope'>";}
		get_template_part("loop","author");
		if ($post_style == "style_2" || $post_style == "style_3") {echo "</div>";}
		get_template_part("includes/pagination");
	}else {
		$author_blog_pages_show = vpanel_options('author_blog_pages_show') ? vpanel_options('author_blog_pages_show') : 4;
		$author_excerpt_title = vpanel_options('author_excerpt_title') ? vpanel_options('author_excerpt_title') : 5;
		query_posts(array("posts_per_page" => $author_blog_pages_show,"author" => $user_login->ID));
		if (have_posts()) {
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
						<div class="post-title"><i class="fa fa-share"></i><?php _e("Posts","vbegy");?></div>
						<div class="row">
							<div class="related-posts <?php echo esc_attr($related_post_class)?>">
								<ul>
									<?php while ( have_posts() ) : the_post();
										$vbegy_what_post = rwmb_meta('vbegy_what_post','select',$post->ID);
										$video_id = rwmb_meta('vbegy_video_post_id',"select",$post->ID);
										$video_type = rwmb_meta('vbegy_video_post_type',"text",$post->ID);
										if ($video_type == 'youtube') {
											$type = "http://www.youtube.com/embed/".$video_id;
										}else if ($video_type == 'vimeo') {
											$type = "http://player.vimeo.com/video/".$video_id;
										}else if ($video_type == 'daily' || $video_type == 'embed') {
											$type = "http://www.dailymotion.com/swf/video/".$video_id;
										}
										$vbegy_slideshow_type = rwmb_meta('vbegy_slideshow_type','select',$post->ID);
										if (has_post_thumbnail() || $vbegy_what_post == "video") {?>
											<div class="<?php echo esc_attr($related_post_columns)?> related-post-item">
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
																echo '<iframe frameborder="0" allowfullscreen height="'.$post_height.'" src="'.$type.'"></iframe>';
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
														<a itemprop="url" href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php excerpt_title($author_excerpt_title)?></a>
														<?php $date_format = (vpanel_options("date_format")?vpanel_options("date_format"):get_option("date_format"));?>
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
	}
get_footer();?>