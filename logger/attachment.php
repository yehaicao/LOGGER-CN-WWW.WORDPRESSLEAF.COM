<?php get_header();
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
	if ( have_posts() ) : while ( have_posts() ) : the_post();
		$vbegy_page_style = rwmb_meta('vbegy_page_style','select',$post->ID);
		$post_username = get_post_meta($post->ID, 'post_username',true);
		$post_email = get_post_meta($post->ID, 'post_email',true);
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
		$post_author = vpanel_options("post_author");
		$post_type = " animation".$post_type;?>
		<article <?php post_class('post clearfix '.$post_type);?> data-animate="fadeInUp" role="article" itemscope="" itemtype="http://schema.org/Article">
			<?php if ($vbegy_page_style != "style_2") {?>
				<div class="post-head"><h1><a itemprop="url" href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php the_title();?></a></h1>
					<?php $posts_meta = vpanel_options("post_meta");
					$author_by = vpanel_options("author_by");
					if ($posts_meta == 'on') {
						$date_format = (vpanel_options("date_format")?vpanel_options("date_format"):get_option("date_format"));?>
			    		<div class="post-meta">
			    			<?php if ($author_by == 'on') {?>
			    				<div><i class="fa fa-user"></i><?php _e("by","vbegy")?> : <?php echo ($post->post_author > 0?the_author_posts_link():$post_username);?></div>
			    			<?php }?>
			    			<div><i class="fa fa-clock-o"></i><?php the_time($date_format);?></div>
			    			<div><i class="fa fa-comments"></i><?php comments_popup_link(__('0 Comments', 'vbegy'), __('1 Comment', 'vbegy'), '% '.__('Comments', 'vbegy'));?></div>
			    			<meta itemprop="interactionCount" content="<?php comments_number( 'UserComments: 0', 'UserComments: 1', 'UserComments: %' ); ?>">
			    		</div><!-- End post-meta -->
					<?php }?>
					<div class="clearfix"></div>
				</div><!-- End post-head -->
			<?php }?>
			<div class="post-wrap">
	    		<div <?php if ($vbegy_sidebar == "full") {echo " post-img-12";}else {echo " post-img-8";}?>">
	    			<?php if (has_post_thumbnail() && $vbegy_what_post != "image_lightbox") {?><a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php }
	    				get_template_part('includes/head');
	    			if (has_post_thumbnail() && $vbegy_what_post != "image_lightbox") {?></a><?php }?>
	    		</div>
	    		
	    		<?php
	    		if ($sidebar_layout == "full") {
	    			$img_width = 1100;
	    			$img_height = 600;
	    		}else {
	    			$img_width = 810;
	    			$img_height = 450;
	    		}
	    		$img_url = wp_get_attachment_url(get_post_thumbnail_id(),'full');
	    		$image = aq_resize($img_url,$img_width,$img_height,true);
	    		if ($image) {
	    			echo "<div class='post-img'><img alt='".get_the_title()."' width='".$img_width."' height='".$img_height."' src='".$image."'></div>";
    			}else {
    				echo "<div class='post-img'><img alt='".get_the_title()."' width='".$img_width."' height='".$img_height."' src='".$img_url."'></div>";
    			}
	    		?>
	    		
	    		<div class="post-inner">
	    			<?php if ($vbegy_page_style == "style_2") {
	    				$vbegy_post_icon = rwmb_meta('vbegy_post_icon',"text",$post->ID);?>
	    				<div class="post-title"><i class="fa <?php if (isset($vbegy_post_icon) && $vbegy_post_icon != "") {echo esc_attr($vbegy_post_icon);}else {echo "fa-file-text";}?>"></i><?php the_title()?></div>
	    			<?php }?>
					<div class="post-inner-content"><?php the_content();?></div>
	    			<div class="clearfix"></div>
	    			<div class="post-share-view">
	    				<div class="post-meta">
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
	    				</div><!-- End post-meta -->
	    			</div><!-- End post-share-view -->
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
		if ($post_comments == "on") {
			comments_template();
		}
		
	endwhile; endif;
get_footer();?>