<?php get_header();
	$vbegy_page_builder = rwmb_meta('vbegy_page_builder','checkbox',$post->ID);
	$vbegy_what_post = rwmb_meta('vbegy_what_post','select',$post->ID);
	$vbegy_sidebar = rwmb_meta('vbegy_sidebar','select',$post->ID);
	$post_share_s = rwmb_meta('vbegy_post_share_s','checkbox',$post->ID);
	$post_views_s = rwmb_meta('vbegy_post_views_s','checkbox',$post->ID);
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
	$vbegy_pagination = get_post_meta($post->ID,"vbegy_pagination",true);
	if ($vbegy_page_builder == 1) {
		$paged = (get_query_var("paged") != ""?(int)get_query_var("paged"):(get_query_var("page") != ""?(int)get_query_var("page"):1));
		if ($paged > 1 && isset($vbegy_pagination) && $vbegy_pagination == 1) {
			query_posts(array('paged' => $paged,'post_type' => 'post'));
			$post_style = vpanel_options("post_style");
			if ($post_style == "style_2" || $post_style == "style_3") {echo "<div class='row blog-all isotope'>";}
			get_template_part("loop","index");
			if ($post_style == "style_2" || $post_style == "style_3") {echo "</div>";}
		}else {
			$builder_item = get_post_meta($post->ID,'builder_item');
			$builder_item = (isset($builder_item[0])?$builder_item[0]:"");
			if($builder_item) {
				foreach ($builder_item as $key_b => $builder)	{
					Vpanel_Builder($builder,$vbegy_sidebar,$key_b);
				}
			}
		}
		if (isset($vbegy_pagination) && $vbegy_pagination == 1) {
			query_posts(array('paged' => $paged,'post_type' => 'post'));
			get_template_part("includes/pagination");
		}
		wp_reset_query();
	}else {
		if ( have_posts() ) : while ( have_posts() ) : the_post();
			$vbegy_page_style = rwmb_meta('vbegy_page_style','select',$post->ID);
			if (has_post_thumbnail()) {
		    	$post_type = " image_post";
			}else {
		    	$post_type = " no_image_post";
			}
			if ($post->post_content == "") {
				$post_type = " post-no-content".$post_type;
			}else {
				$post_type = " post--content".$post_type;
			}
			
			if ($vbegy_page_style == "style_2") {
				$post_type = " page-style-2".$post_type;
			}
			
			$custom_page_setting = rwmb_meta('vbegy_custom_page_setting','checkbox',$post->ID);
			$post_meta_s = rwmb_meta('vbegy_post_meta_s','checkbox',$post->ID);
			$post_comments_s = rwmb_meta('vbegy_post_comments_s','checkbox',$post->ID);
			$post_navigation_s = rwmb_meta('vbegy_post_navigation_s','checkbox',$post->ID);?>
			<article <?php post_class('post clearfix '.$post_type);?> role="article" itemscope="" itemtype="http://schema.org/Article">
				<?php if ($vbegy_page_style != "style_2") {?>
					<div class="post-head"><h1><a itemprop="url" href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title();?></a></h1>
						<?php $posts_meta = vpanel_options("post_meta");
						if (($posts_meta == "on" && $post_meta_s == "") || ($posts_meta == "on" && isset($custom_page_setting) && $custom_page_setting == 0) || ($posts_meta == "on" && isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_meta_s) && $post_meta_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_meta_s) && $post_meta_s == 1)) {
							$author_by = vpanel_options("author_by");
							$date_format = (vpanel_options("date_format")?vpanel_options("date_format"):get_option("date_format"));?>
				    		<div class="post-meta">
				    			<?php if ($author_by == 'on') {?>
				    				<div><i class="fa fa-user"></i><?php _e("by","vbegy")?> : <?php the_author_posts_link();?></div>
				    			<?php }?>
				    			<div><i class="fa fa-clock-o"></i><?php the_time($date_format);?></div>
				    			<div><i class="fa fa-comments"></i><?php comments_popup_link(__('0 Comments', 'vbegy'), __('1 Comment', 'vbegy'), '% '.__('Comments', 'vbegy'));?></div>
				    		</div><!-- End post-meta -->
						<?php }?>
						<div class="clearfix"></div>
					</div><!-- End post-head -->
				<?php }?>
				<div class="post-wrap">
		    		<div <?php echo ($vbegy_what_post == "soundcloud"?$soundcloud_background:"").($vbegy_what_post == "twitter"?$twitter_background:"").($vbegy_what_post == "facebook"?$facebook_background:"")?> class="post-img<?php if ((!isset($vbegy_what_post) || $vbegy_what_post == "none" || $vbegy_what_post == "image" || $vbegy_what_post == "soundcloud" || $vbegy_what_post == "twitter" || $vbegy_what_post == "facebook") && !has_post_thumbnail()) {echo " post-img-0";}else if ($vbegy_what_post == "video" || $vbegy_what_post == "soundcloud" || $vbegy_what_post == "twitter" || $vbegy_what_post == "facebook") {echo " post-iframe";}if ($vbegy_sidebar == "full") {echo " post-img-12";}else {echo " post-img-8";}?>">
		    			<?php if (has_post_thumbnail() && $vbegy_what_post != "image_lightbox") {?><a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php }
		    				get_template_part('includes/head');
		    			if (has_post_thumbnail() && $vbegy_what_post != "image_lightbox") {?></a><?php }?>
		    		</div>
		    		<div class="post-inner">
		    			<?php if ($vbegy_page_style == "style_2") {
		    				$vbegy_post_icon = rwmb_meta('vbegy_post_icon',"text",$post->ID);?>
		    				<div class="post-title"><i class="fa <?php if (isset($vbegy_post_icon) && $vbegy_post_icon != "") {echo esc_attr($vbegy_post_icon);}else {echo "fa-file-text";}?>"></i><?php the_title()?></div>
		    			<?php }?>
						<div class="post-inner-content">
							<?php the_content();
							wp_link_pages(array('before' => '<div class="pagination post-pagination">','after' => '</div>','link_before' => '<span>','link_after' => '</span>'));?>
						</div>
		    			<div class="clearfix"></div>
		    			<?php $post_views = vpanel_options("post_views");
		    			$post_share = vpanel_options("post_share");
		    			if ((($post_views == "on" && $post_views_s == "") || ($post_views == "on" && isset($custom_page_setting) && $custom_page_setting == 0) || ($post_views == "on" && isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_views_s) && $post_views_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_views_s) && $post_views_s == 1)) || (($post_share == "on" && $post_share_s == "") || ($post_share == "on" && isset($custom_page_setting) && $custom_page_setting == 0) || ($post_share == "on" && isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_share_s) && $post_share_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_share_s) && $post_share_s == 1))) {?>
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
			    					<?php }?>
			    				</div><!-- End post-meta -->
			    			</div><!-- End post-share-view -->
		    			<?php }?>
		    			<div class="clearfix"></div>
		    		</div><!-- End post-inner -->
				</div><!-- End post-wrap -->
			</article><!-- End post -->
			
			<?php
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
				<div class="clearfix"></div>';
			}
			
			$post_comments = vpanel_options("post_comments");
			if (($post_comments == "on" && $post_comments_s == "") || ($post_comments == "on" && isset($custom_page_setting) && $custom_page_setting == 0) || ($post_comments == "on" && isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_comments_s) && $post_comments_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_comments_s) && $post_comments_s == 1)) {
				comments_template();
			}
			
		endwhile; endif;
	}
get_footer();?>