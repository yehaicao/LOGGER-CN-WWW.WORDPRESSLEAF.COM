<?php
global $post,$blog_style,$vbegy_sidebar_all,$post_style;
$vbegy_what_post = rwmb_meta('vbegy_what_post','select',$post->ID);
$vbegy_sidebar = $vbegy_sidebar_all;
$vbegy_google = rwmb_meta('vbegy_google',"textarea",$post->ID);
$vbegy_audio = rwmb_meta('vbegy_audio',"text",$post->ID);
$vbegy_soundcloud_embed = rwmb_meta('vbegy_soundcloud_embed',"text",$post->ID);
$vbegy_soundcloud_height = rwmb_meta('vbegy_soundcloud_height',"text",$post->ID);
$vbegy_twitter_embed = rwmb_meta('vbegy_twitter_embed',"text",$post->ID);
$vbegy_facebook_embed = rwmb_meta('vbegy_facebook_embed',"textarea",$post->ID);
$vbegy_slideshow_type = rwmb_meta('vbegy_slideshow_type','select',$post->ID);
$video_id = rwmb_meta('vbegy_video_post_id',"select",$post->ID);
$video_type = rwmb_meta('vbegy_video_post_type',"text",$post->ID);
if ($video_type == 'youtube') {
	$type = "http://www.youtube.com/embed/".$video_id;
}else if ($video_type == 'vimeo') {
	$type = "http://player.vimeo.com/video/".$video_id;
}else if ($video_type == 'daily' || $video_type == 'embed') {
	$type = "http://www.dailymotion.com/swf/video/".$video_id;
}
if (!is_single() && $post_style == "style_2") {
	$full_width_width = "555";
	$full_width_height = "421";
	$img_width = "360";
	$img_height = "420";
}else if (!is_single() && $post_style == "style_3") {
	$full_width_width = $img_width = "360";
	$full_width_height = $img_height = "202";
}else {
	$full_width_width = "1140";
	$full_width_height = "641";
	$img_width = "750";
	$img_height = "422";
}
if ($vbegy_what_post == "image" || $vbegy_what_post == "video" || $vbegy_what_post == "image_lightbox") {
	if ($vbegy_sidebar == "full") {
		if ($vbegy_what_post == "image" || $vbegy_what_post == "image_lightbox") {
			if (has_post_thumbnail()) {
				$show_featured_image = 1;
				if (vpanel_options("featured_image") == "on" && is_singular()) {
					$show_featured_image = 0;
				}
				if ($show_featured_image == 1) {
					if ($vbegy_what_post == "image_lightbox" || is_singular("portfolio")) {
						echo get_aq_resize_img('full',$full_width_width,$full_width_height,$img_lightbox = "lightbox");
						$thumb = get_post_thumbnail_id();
						$img_url = wp_get_attachment_url($thumb,"full");
						echo '<a class="post-img-lightbox prettyPhoto" href="'.$img_url.'"><i class="fa fa-plus"></i></a>';
					}else {
						echo get_aq_resize_img('full',$full_width_width,$full_width_height);
					}
				}
			}
		}else if ($vbegy_what_post == "video") {
			if ($video_type == "embed") {
				echo rwmb_meta('vbegy_custom_embed',"textarea",$post->ID);
	    	}else {
		    	echo '<iframe frameborder="0" allowfullscreen height="'.$full_width_height.'" src="'.$type.'"></iframe>';
	    	}
		}
	}else {
		if ($vbegy_what_post == "image" || $vbegy_what_post == "image_lightbox") {
			if (has_post_thumbnail()) {
				$show_featured_image = 1;
				if (vpanel_options("featured_image") == "on" && is_singular()) {
					$show_featured_image = 0;
				}
				if ($show_featured_image == 1) {
					if ($vbegy_what_post == "image_lightbox" || is_singular("portfolio")) {
						echo get_aq_resize_img('full',$img_width,$img_height,$img_lightbox = "lightbox");
						$thumb = get_post_thumbnail_id();
						$img_url = wp_get_attachment_url($thumb,"full");
						echo '<a class="post-img-lightbox prettyPhoto" href="'.$img_url.'"><i class="fa fa-plus"></i></a>';
					}else {
						echo get_aq_resize_img('full',$img_width,$img_height);
					}
				}
			}
		}else if ($vbegy_what_post == "video") {
			if ($video_type == "embed") {
				echo rwmb_meta('vbegy_custom_embed',"textarea",$post->ID);
			}else {
				echo '<iframe frameborder="0" allowfullscreen height="'.$img_height.'" src="'.$type.'"></iframe>';
			}
		}
	}
}else if ($vbegy_what_post == "google" || $vbegy_what_post == "slideshow" || $vbegy_what_post == "soundcloud" || $vbegy_what_post == "twitter" || $vbegy_what_post == "facebook" || $vbegy_what_post == "audio") {
	if ($vbegy_what_post == "soundcloud") {
		echo "<div class='post-iframe'>".wp_oembed_get($vbegy_soundcloud_embed, array('height' => ($vbegy_soundcloud_height != ""?$vbegy_soundcloud_height:150)))."</div>";
	}else if ($vbegy_what_post == "google") {
		echo "<div class='post-map post-iframe'>".$vbegy_google."</div>";
	}else if ($vbegy_what_post == "twitter") {
		$post_head_background = rwmb_meta('vbegy_post_head_background',"color",$post->ID);
		$post_head_background_img = rwmb_meta('vbegy_post_head_background_img',"upload",$post->ID);
		$post_head_background_repeat = rwmb_meta('vbegy_post_head_background_repeat',"select",$post->ID);
		$post_head_background_fixed = rwmb_meta('vbegy_post_head_background_fixed',"select",$post->ID);
		$post_head_background_position_x = rwmb_meta('vbegy_post_head_background_position_x',"select",$post->ID);
		$post_head_background_position_y = rwmb_meta('vbegy_post_head_background_position_y',"select",$post->ID);
		$post_head_background_full = rwmb_meta('vbegy_post_head_background_full',"checkbox",$post->ID);
		$post_head_style = "";
		if ((isset($post_head_background) && $post_head_background != "") || (isset($post_head_background_img) && $post_head_background_img != "")) {
			$post_head_style .= "style='";
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
		echo "<div ".$post_head_style." class='post-iframe'>".wp_oembed_get($vbegy_twitter_embed)."</div>";
	}else if ($vbegy_what_post == "audio") {
		if (has_post_thumbnail()) {
			$show_featured_image = 1;
			if (vpanel_options("featured_image") == "on" && is_singular()) {
				$show_featured_image = 0;
			}
			if ($show_featured_image == 1) {
				if ($vbegy_sidebar == "full") {
					echo get_aq_resize_img('full',$full_width_width,$full_width_height);
				}else {
					echo get_aq_resize_img('full',$img_width,$img_height);
				}
			}
		}
		echo "<div class='post-iframe'>".do_shortcode("[audio src='".$vbegy_audio."']")."</div>";
	}else if ($vbegy_what_post == "facebook") {
		echo "<div class='facebook-remove'>".$vbegy_facebook_embed."</div>";
		echo $vbegy_facebook_embed;
	}else if ($vbegy_what_post == "slideshow") {
		global $wpdb;
		$query = $wpdb->prepare("SELECT * FROM {$wpdb->prefix}postmeta WHERE meta_key = 'vbegy_upload_images' AND post_id = %s",(int)$post->ID);
		if ($vbegy_slideshow_type == "custom_slide") {
			$result = $wpdb->get_results($query);?>
		    <ul>
		    	<?php
		    	$builder_slide_item = get_post_meta($post->ID,'builder_slide_item');
		    	if($builder_slide_item){
		    		$builder_slide_item = $builder_slide_item[0];
		    		foreach ($builder_slide_item as $builder_slide) {
		    		    $src = wp_get_attachment_image_src($builder_slide['image_id'],'full');
		    		    $src = $src[0];
		    		    if ($vbegy_sidebar == "full") {
	    		    	    $src = get_aq_resize_img_url(esc_url($src),"full",$full_width_width,$full_width_height);
		    		    }else {
	    		    	    $src = get_aq_resize_img_url(esc_url($src),"full",$img_width,$img_height);
		    		    }
		    		    ?>
		    		    <li>
			    		    <?php if ($builder_slide['slide_link'] != "") {echo "<a href='".$builder_slide['slide_link']."'>";}
				    	        echo $src;
			    	        if ($builder_slide['slide_link'] != "") {echo "</a>";}?>
		    	        </li>
		    		<?php }
		    	}?>
		    </ul>
			<?php
		}else if ($vbegy_slideshow_type == "upload_images") {
			$result = $wpdb->get_results($query);?>
		    <ul>
		    	<?php
		    	foreach ($result as $results) {
		    	    $slideshow_imgs = $results->meta_value.',';
		    	    $slideshow_imgs = explode(",",$slideshow_imgs);
		    	    $images = $wpdb->get_col("SELECT ID FROM {$wpdb->posts} WHERE post_type = 'attachment' AND ID IN ('".implode("','",$slideshow_imgs)."') ORDER BY menu_order ASC");
		    	    foreach ($images as $att) {
		    	    $src = wp_get_attachment_image_src($att,'full');
		    	    $src = $src[0];?>
		    	    <li>
			    	    <?php
			    	    if ($vbegy_sidebar == "full") {
		    	    	    $src = get_aq_resize_img_url(esc_url($src),"full",$full_width_width,$full_width_height);
			    	    }else {
		    	    	    $src = get_aq_resize_img_url(esc_url($src),"full",$img_width,$img_height);
			    	    }
			    	    echo $src;
			    	    ?>
			        </li>
		    	<?php
		    	    }
		    	}?>
		    </ul>
			<?php
		}
	}
}else {
	if (has_post_thumbnail()) {
		$show_featured_image = 1;
		if (vpanel_options("featured_image") == "on" && is_singular()) {
			$show_featured_image = 0;
		}
		if ($show_featured_image == 1) {
			if ($vbegy_sidebar == "full") {
				echo get_aq_resize_img('full',$full_width_width,$full_width_height);
			}else {
				echo get_aq_resize_img('full',$img_width,$img_height);
			}
		}
	}
}
?>