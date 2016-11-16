<?php
if (($posts_meta == "on" && $post_meta_s == "") || ($posts_meta == "on" && isset($custom_page_setting) && $custom_page_setting == 0) || ($posts_meta == "on" && isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_meta_s) && $post_meta_s != 0) || (isset($custom_page_setting) && $custom_page_setting == 1 && isset($post_meta_s) && $post_meta_s == 1)) {
	if ($meta_post_position == "top_image" && ($vbegy_image_style == "style_1" || $vbegy_image_style == "style_2")) {?>
		<div class="full-width-image-content">
			<h1><?php the_title();?></h1>
			<div class="clearfix"></div>
			<?php if ($author_by == 'on') {?>
				<span><i class="fa fa-user"></i><?php _e("by","vbegy")?> : <?php echo ($post->post_author > 0?the_author_posts_link():$post_username);?></span>
			<?php }?>
			<span><i class="fa fa-clock-o"></i><?php the_time($date_format);?></span>
			<span><i class="fa fa-comments"></i><?php comments_popup_link(__('0 Comments', 'vbegy'), __('1 Comment', 'vbegy'), '% '.__('Comments', 'vbegy'));?></span>
			<?php if ($category_post == 'on') {?>
				<span><i class="fa fa-folder-open"></i><?php _e("in","vbegy")?> : <?php the_category(' , ');?></span>
			<?php }
			$post_like = get_post_meta($post->ID,"post_like",true);
			$like_yes = "";
			if (isset($_COOKIE['logger_post_like'.$post->ID]) && $_COOKIE['logger_post_like'.$post->ID] == "logger_like_yes") {
				$like_yes = "logger_like_yes";
			}
			?>
			<span><a class="post-like <?php echo ($like_yes == "logger_like_yes"?"post-like-done":"")?>" title="<?php echo ($like_yes == "logger_like_yes"?__("You already like this","vbegy"):__("Love","vbegy"))?>" id="post-like-<?php the_ID();?>"><i class="fa <?php echo ($like_yes == "logger_like_yes"?"fa-heart":"fa-heart-o")?>"></i><span><?php echo (isset($post_like) && $post_like != ""?$post_like:0)?></span></a></span>
			<div class="clearfix"></div>
		</div><!-- End full-width-image-content -->
		<div class="clearfix"></div>
	<?php }
}