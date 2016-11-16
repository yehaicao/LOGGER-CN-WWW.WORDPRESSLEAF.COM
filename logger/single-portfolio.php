<?php get_header();
	$vbegy_what_post = rwmb_meta('vbegy_what_post','select',$post->ID);
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
	$vbegy_what_post = rwmb_meta('vbegy_what_post','select',$post->ID);
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
	
	if ($vbegy_what_post == "video") {
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
	
	$vbegy_page_style = rwmb_meta('vbegy_page_style','select',$post->ID);
	if ($vbegy_page_style == "style_2") {
		$post_type = " page-style-2".$post_type;
	}
	
	$vbegy_project_style = rwmb_meta('vbegy_project_style',"select",$post->ID);
	$vbegy_client = rwmb_meta('vbegy_client',"text",$post->ID);
	$vbegy_skills = rwmb_meta('vbegy_skills',"text",$post->ID);
	$vbegy_url = rwmb_meta('vbegy_url',"url",$post->ID);
	
	$portfolio_category = wp_get_post_terms($post->ID,'portfolio-category',array("fields" => "all"));
	if (isset($portfolio_category[0])) {
		$get_portfolio_category = get_option("portfolio_category_".$portfolio_category[0]->term_id);
	}
	
	$custom_page_setting = rwmb_meta('vbegy_custom_page_setting','checkbox',$post->ID);
	$post_meta_s = rwmb_meta('vbegy_post_meta_s','checkbox',$post->ID);
	$post_share_s = rwmb_meta('vbegy_post_share_s','checkbox',$post->ID);
	$post_views_s = rwmb_meta('vbegy_post_views_s','checkbox',$post->ID);
	$related_post_s = rwmb_meta('vbegy_related_post_s','checkbox',$post->ID);
	$related_number_s = rwmb_meta('vbegy_related_number_s','text',$post->ID);
	$excerpt_related_title_s = rwmb_meta('vbegy_excerpt_related_title_s','text',$post->ID);
	$post_comments_s = rwmb_meta('vbegy_post_comments_s','checkbox',$post->ID);
	$post_navigation_s = rwmb_meta('vbegy_post_navigation_s','checkbox',$post->ID);
	
	if ( have_posts() ) : while ( have_posts() ) : the_post();?>
		<article <?php post_class('post single-portfolio clearfix '.$post_type);?> role="article" itemscope="" itemtype="http://schema.org/Article">
			<div class="post-head"><h1><a itemprop="url" href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title();?></a></h1>
				<?php $posts_meta = vpanel_options("post_meta");
				$category_post = vpanel_options("category_post");
				if (($posts_meta == "on" && $post_meta_s == "") || ($posts_meta == "on" && isset($custom_page_setting) && $custom_page_setting == 0) || ($posts_meta == "on" && isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_meta_s) && $post_meta_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_meta_s) && $post_meta_s == 1)) {
					$date_format = (vpanel_options("date_format")?vpanel_options("date_format"):get_option("date_format"));?>
		    		<div class="post-meta">
		    			<?php if (isset($vbegy_client) && $vbegy_client != "") {?>
		    				<div><i class="fa fa-user"></i><?php _e("Client","vbegy")?> : <?php echo esc_attr($vbegy_client)?></div>
		    			<?php }?>
		    			<div><i class="fa fa-clock-o"></i><?php the_time($date_format);?></div>
		    			<div><i class="fa fa-comments"></i><?php comments_popup_link(__('0 Comments', 'vbegy'), __('1 Comment', 'vbegy'), '% '.__('Comments', 'vbegy'));?></div>
		    			<?php if (isset($portfolio_category[0])) {
		    				if ($category_post == 'on') {?>
		    					<div><i class="fa fa-folder-open"></i><?php _e("in","vbegy")?> : <?php echo get_the_term_list( $post->ID, 'portfolio-category', '', ', ', '' )?></div>
		    				<?php }
		    			}
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
			<div class="post-wrap">
	    		<div <?php echo ($vbegy_what_post == "soundcloud"?$soundcloud_background:"").($vbegy_what_post == "twitter"?$twitter_background:"").($vbegy_what_post == "facebook"?$facebook_background:"")?> class="post-img<?php if ((!isset($vbegy_what_post) || $vbegy_what_post == "none" || $vbegy_what_post == "image" || $vbegy_what_post == "soundcloud" || $vbegy_what_post == "twitter" || $vbegy_what_post == "facebook" || $vbegy_what_post == "audio") && !has_post_thumbnail()) {echo " post-img-0";}else if ($vbegy_what_post == "video" || $vbegy_what_post == "soundcloud" || $vbegy_what_post == "twitter" || $vbegy_what_post == "facebook") {echo " post-iframe";}if ($vbegy_sidebar == "full") {echo " post-img-12";}else {echo " post-img-8";}?>">
	    			<?php if ((has_post_thumbnail() && $vbegy_what_post != "image_lightbox") && $vbegy_what_post != "audio") {?><a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php }
	    				get_template_part('includes/head');
	    			if ((has_post_thumbnail() && $vbegy_what_post != "image_lightbox") && $vbegy_what_post != "audio") {?></a><?php }?>
	    		</div>
	    		<div class="post-inner">
			    	<div class="post-inner-content"><?php the_content();?></div>
					<?php wp_link_pages(array('before' => '<div class="pagination post-pagination">','after' => '</div>','link_before' => '<span>','link_after' => '</span>'));?>
	    			<div class="clearfix"></div>
	    			<div class="post-share-view">
	    				<div class="post-meta">
	    					<?php $post_views = vpanel_options("post_views");
	    					if (($post_views == "on" && $post_views_s == "") || ($post_views == "on" && isset($custom_page_setting) && $custom_page_setting == 0) || ($post_views == "on" && isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_views_s) && $post_views_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_views_s) && $post_views_s == 1)) {
		    					$post_stats = get_post_meta($post->ID, 'post_stats', true)?>
		    					<div><i class="fa fa-eye"></i><span><?php echo (isset($post_stats) && $post_stats != ""?(int)$post_stats:0)?> </span><?php _e("Views","vbegy")?></div>
	    					<?php }
	    					$post_share = vpanel_options("post_share");
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
	    					if ($terms = wp_get_object_terms( $post->ID, 'portfolio_tags' )) :?>
	    						<div class="post-tags">
	    							<i class="fa fa-tags"></i>
	    							<?php $terms_array = array();
	    							foreach ($terms as $term) :
	    								$terms_array[] = '<a href="'.get_term_link($term->slug, 'portfolio_tags').'">'.$term->name.'</a>';
	    							endforeach;
	    							echo implode(' , ', $terms_array);?>
	    						</div>
	    					<?php endif;?>
	    					<div class="clearfix"></div>
	    					<?php if (isset($vbegy_skills) && $vbegy_skills != "") {?>
    							<div class="post-tags portfolio-skills">
    								<i class="fa fa-globe"></i>
	    							<span><?php _e("Skills :","vbegy")?></span> <?php echo esc_attr($vbegy_skills)?>
    							</div>
    						<?php }
    						if (isset($vbegy_url) && $vbegy_url != "") {?>
    							<a href="<?php echo esc_url($vbegy_url)?>" target="_blank" class="button-default post-more"><?php _e("View Project","vbegy");?></a>
    						<?php }?>
	    				</div><!-- End post-meta -->
	    			</div><!-- End post-share-view -->
	    			<div class="clearfix"></div>
	    		</div><!-- End post-inner -->
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
							<div class="nav-next"><?php previous_post('%','<span>'.__('Previous project','vbegy').'</span><br>');?></div>
						</div>
						<div class="col-md-6">
							<div class="nav-previous"><?php next_post('%','<span>'.__('Next project','vbegy').'</span><br>')?></div>
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
			}else if ($value_r == "related") {
				$related_post = vpanel_options("related_post");
				if (($related_post == "on" && $related_post_s == "") || ($related_post == "on" && isset($custom_page_setting) && $custom_page_setting == 0) || ($related_post == "on" && isset($custom_page_setting) && $custom_page_setting == 1 && isset($related_post_s) && $related_post_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($related_post_s) && $related_post_s == 1)) {
					if ($vbegy_sidebar == "full") {
						$portfolio_columns = "col-md-4";
						$related_portfolio_class = "related-posts-full";
						$portfolio_width = 340;
						$portfolio_height = 216;
					}else {
						$portfolio_columns = "col-md-6";
						$related_portfolio_class = "related-posts-half";
						$portfolio_width = 330;
						$portfolio_height = 210;
					}
					
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
					$excerpt_related_title = $excerpt_related_title ? $excerpt_related_title : 10;
					global $post;
					$orig_post = $post;
					
					$categories = get_the_terms($post->ID,"portfolio-category");
					$category_ids = array();
					foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
					$args = array('post_type' => $post_type,'post__not_in' => array($post->ID),'posts_per_page'=> $related_no,'post_type'=> "portfolio" , 'tax_query' => array(
							array(
								'taxonomy' => 'portfolio-category',
								'field'    => 'id',
								'terms'    => $category_ids,
								'operator' => 'IN',
							),
						), );
					$related_query = new wp_query( $args );
					if ($related_query->have_posts()) : ;?>
						<div class="post related-posts-div related-portfolio">
							<div class="post-wrap">
								<div class="post-inner">
									<div class="post-title"><i class="fa fa-share"></i><?php _e("Related Projects","vbegy");?></div>
									<div class="row">
										<div class="related-posts <?php echo esc_attr($related_portfolio_class)?>">
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
														$post_type = " video_e_post";
													}
													$vbegy_slideshow_type = rwmb_meta('vbegy_slideshow_type','select',$post->ID);?>
													<div class="<?php echo esc_attr($portfolio_columns)?> col-sm-6 related-post-item portfolio-item portfolio-item-2">
														<div class="portfolio-one">
															<div class="portfolio-head">
																<div class="portfolio-img">
																	<?php
																	if ($vbegy_what_post == "image" || $vbegy_what_post == "slideshow" || $vbegy_what_post == "video") {
																		if (has_post_thumbnail() && ($vbegy_what_post == "image" || $vbegy_what_post == "video")) {
																			echo get_aq_resize_img('full',$portfolio_width,$portfolio_height,$img_lightbox = "lightbox");
																		}else if (has_post_thumbnail() && $vbegy_what_post == "slideshow") {
																			echo get_aq_resize_img('full',$portfolio_width,$portfolio_height);
																		}
																	}
																	?>
																</div>
																<div class="portfolio-hover">
																	<div class="portfolio-meta">
																		<div class="portfolio-name"><h6><a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title()?></a></h6></div>
																		<div class="portfolio-desc"><p><?php excerpt($excerpt_related_title)?></p></div>
																	</div><!-- End portfolio-meta -->
																</div>
															</div><!-- End portfolio-head -->
														</div><!-- End portfolio-item -->
													</div>
												<?php endwhile;?>
											</ul>
										</div><!-- End related-posts -->
									</div><!-- End row -->
									<div class="clearfix"></div>
								</div><!-- End post-inner -->
							</div><!-- End post-wrap -->
						</div><!-- End post -->
					<?php endif;
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