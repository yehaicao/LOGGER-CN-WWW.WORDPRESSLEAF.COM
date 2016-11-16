<?php
function Vpanel_Recent_Posts($box_title,$box_posts_num,$box_display,$box_cats,$categories,$box_style,$excerpt_title,$excerpt,$orderby,$vbegy_sidebar,$animate) {
	global $post;
	$animate_class = (isset($animate) && $animate != "" && $animate != "none"?"animation ":"");
	$data_animate = (isset($animate) && $animate != "" && $animate != "none"?" data-animate='".esc_attr($animate)."'":"");
	$date_format = (vpanel_options("date_format")?vpanel_options("date_format"):get_option("date_format"));
	$author_by = vpanel_options("author_by");
	$excerpt_title = (isset($excerpt_title) && (int)$excerpt_title != ""?$excerpt_title:5);
	$excerpt = (isset($excerpt) && (int)$excerpt != ""?$excerpt:35);
	$rand_recent = rand(1,1000);
	$implode_c = "";
	if (isset($categories) && is_array($categories)) {
		$implode_c = implode(",",$categories);
	}
	$cat_array = array();
	if (isset($box_display) && $box_display == "categories") {
		$cat_array = array('cat' => $implode_c);
	}else if (isset($box_display) && $box_display == "category") {
		$cat_array = array('cat' => $box_cats);
	}
	if ($orderby == "popular") {
		$orderby = array('orderby' => 'comment_count');
	}else if ($orderby == "random") {
		$orderby = array('orderby' => 'rand');
	}else {
		$orderby = array();
	}
	query_posts(array_merge($orderby,$cat_array,array('ignore_sticky_posts' => 1,'posts_per_page' => $box_posts_num)));
	if ($box_style == "recent_1" || $box_style == "recent_2") {
		?>
		<div class="<?php echo ($animate_class)?>block-box<?php echo ($vbegy_sidebar == "full"?" block-box-full":"")?>"<?php echo ($data_animate)?>>
			<?php if (isset($box_title) && $box_title != "" || $box_display == "category") {?>
				<div class="block-box-title"><?php echo (isset($box_title) && $box_title != ""?$box_title:(isset($box_display) && $box_display == "category"?"<a href='".get_category_link($box_cats)."'>".get_the_category_by_ID($box_cats)."</a><a class='block-box-title-more' href='".get_category_link($box_cats)."'>".__("More","vbegy")."</a>":""))?></div>
			<?php }?>
			<div class="block-box-1 <?php echo ($box_style == "recent_1"?"block-recent-1":"").($box_style == "recent_2"?" block-box-2 block-box-4":"")?>">
				<ul>
					<?php if ( have_posts() ) : while ( have_posts() ) : the_post();
						$vbegy_what_post = rwmb_meta('vbegy_what_post','select',$post->ID);
						$video_type = rwmb_meta('vbegy_video_post_type',"select",$post->ID);
						$post_username = get_post_meta($post->ID, 'post_username',true);
						$post_email = get_post_meta($post->ID, 'post_email',true);?>
						<li<?php echo ($box_style == "recent_2"?" class='block-box-first'":"")?>>
							<?php if (has_post_thumbnail()) {?>
								<div class="block-box-img">
									<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark">
										<i class="fa fa-<?php if (is_sticky()) {?>thumb-tack<?php }else if ($vbegy_what_post == "google") {?>map-marker<?php }else if ($vbegy_what_post == "audio") {?>volume-up<?php }else if ($vbegy_what_post == "video") {if ($video_type == 'youtube') {?>youtube-play<?php }else if ($video_type == 'vimeo') {?>vimeo-square<?php }else if ($video_type == 'daily' || $video_type == 'embed') {?>video-camera<?php }?><?php }else if ($vbegy_what_post == "slideshow") {?>film<?php }else if ($vbegy_what_post == "quote") {?>quote-left<?php }else if ($vbegy_what_post == "link") {?>link<?php }else if ($vbegy_what_post == "soundcloud") {?>soundcloud<?php }else if ($vbegy_what_post == "twitter") {?>twitter<?php }else if ($vbegy_what_post == "facebook") {?>facebook<?php }else {if (has_post_thumbnail()) {?>image<?php }else {?>file-text<?php }}?>"></i>
										<?php if ($box_style == "recent_2") {
											echo get_aq_resize_img('full',345,240);
										}else {
											echo get_aq_resize_img('full',130,130);
										}
										?>
									</a>
								</div>
							<?php }?>
							<div class="block-box-content">
								<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php excerpt_title($excerpt_title);?></a>
								<?php if ($author_by == 'on') {?>
									<span><i class="fa fa-user"></i><?php _e("by","vbegy")?> : <?php echo ($post->post_author > 0?the_author_posts_link():$post_username);?></span>
								<?php }?>
								<span><i class="fa fa-clock-o"></i><?php the_time($date_format);?></span>
								<div class="clearfix"></div>
								<p><?php excerpt($excerpt);if ($box_style == "recent_1") {?> <a class="color" href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php _e("Continue Reading","vbegy")?></a><?php }?></p>
								<?php if ($box_style == "recent_2") {?>
									<a class="button-default post-more" href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php _e("Continue Reading","vbegy")?></a>
								<?php }?>
							</div>
						</li>
					<?php endwhile;endif;?>
				</ul>
				<div class="clearfix"></div>
			</div>
		</div><!-- End block-box -->
		<div class="clearfix"></div>
	<?php
	}else if ($box_style == "recent_3") {
		?>
		<div class="<?php echo ($animate_class)?>block-box block-recent<?php echo ($vbegy_sidebar == "full"?" block-box-full block-carousel-full":" block-box-half block-carousel-half")?>"<?php echo ($data_animate)?>>
			<?php if (isset($box_title) && $box_title != "" || $box_display == "category") {?>
				<div class="block-box-title"><?php echo (isset($box_title) && $box_title != ""?$box_title:(isset($box_display) && $box_display == "category"?"<a href='".get_category_link($box_cats)."'>".get_the_category_by_ID($box_cats)."</a><a class='block-box-title-more' href='".get_category_link($box_cats)."'>".__("More","vbegy")."</a>":""))?></div>
			<?php }?>
			<div class="carousel-box carousel-box-1 recent-box-3 carousel-box<?php echo esc_attr($rand_recent);?>">
				<ul>
					<?php if ( have_posts() ) :
					while ( have_posts() ) : the_post();
						$vbegy_what_post = rwmb_meta('vbegy_what_post','select',$post->ID);
						$video_type = rwmb_meta('vbegy_video_post_type',"select",$post->ID);
						$post_username = get_post_meta($post->ID, 'post_username',true);
						$post_email = get_post_meta($post->ID, 'post_email',true);?>
						<div class="carousel-one">
							<?php if (has_post_thumbnail()) {?>
								<div class="carousel-box-img">
									<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark">
										<i class="fa fa-<?php if (is_sticky()) {?>thumb-tack<?php }else if ($vbegy_what_post == "google") {?>map-marker<?php }else if ($vbegy_what_post == "audio") {?>volume-up<?php }else if ($vbegy_what_post == "video") {if ($video_type == 'youtube') {?>youtube-play<?php }else if ($video_type == 'vimeo') {?>vimeo-square<?php }else if ($video_type == 'daily' || $video_type == 'embed') {?>video-camera<?php }?><?php }else if ($vbegy_what_post == "slideshow") {?>film<?php }else if ($vbegy_what_post == "quote") {?>quote-left<?php }else if ($vbegy_what_post == "link") {?>link<?php }else if ($vbegy_what_post == "soundcloud") {?>soundcloud<?php }else if ($vbegy_what_post == "twitter") {?>twitter<?php }else if ($vbegy_what_post == "facebook") {?>facebook<?php }else {if (has_post_thumbnail()) {?>image<?php }else {?>file-text<?php }}?>"></i>
										<?php if ($vbegy_sidebar == "full") {
											echo get_aq_resize_img('full',255,165);
										}else {
											echo get_aq_resize_img('full',225,165);
										}?>
									</a>
								</div>
							<?php }?>
							<div class="block-box-content">
								<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php excerpt_title($excerpt_title);?></a>
								<?php if ($author_by == 'on') {?>
									<span><i class="fa fa-user"></i><?php _e("by","vbegy")?> : <?php echo ($post->post_author > 0?the_author_posts_link():$post_username);?></span>
								<?php }?>
								<span><i class="fa fa-clock-o"></i><?php the_time($date_format);?></span>
							</div>
						</div>
					<?php endwhile;endif;?>
				</ul>
				<div class="clearfix"></div>
			</div>
		</div><!-- End block-box -->
		<div class="clearfix"></div>
		<?php
	}else if ($box_style == "recent_4") {
		?>
		<div class="<?php echo ($animate_class)?>block-box block-recent<?php echo ($vbegy_sidebar == "full"?" block-box-full block-carousel-full":" block-box-half block-carousel-half")?>"<?php echo ($data_animate)?>>
			<?php if (isset($box_title) && $box_title != "" || $box_display == "category") {?>
				<div class="block-box-title"><?php echo (isset($box_title) && $box_title != ""?$box_title:(isset($box_display) && $box_display == "category"?"<a href='".get_category_link($box_cats)."'>".get_the_category_by_ID($box_cats)."</a><a class='block-box-title-more' href='".get_category_link($box_cats)."'>".__("More","vbegy")."</a>":""))?></div>
			<?php }?>
			<div class="carousel-box carousel-box-2 recent-box-4 carousel-box<?php echo esc_attr($rand_recent);?>">
				<ul>
					<?php if ( have_posts() ) :
					while ( have_posts() ) : the_post();
						$vbegy_what_post = rwmb_meta('vbegy_what_post','select',$post->ID);
						$video_type = rwmb_meta('vbegy_video_post_type',"select",$post->ID);
						$post_username = get_post_meta($post->ID, 'post_username',true);
						$post_email = get_post_meta($post->ID, 'post_email',true);
						if (has_post_thumbnail()) {?>
							<div class="carousel-one">
								<div class="carousel-box-img">
									<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark">
										<i class="fa fa-<?php if (is_sticky()) {?>thumb-tack<?php }else if ($vbegy_what_post == "google") {?>map-marker<?php }else if ($vbegy_what_post == "audio") {?>volume-up<?php }else if ($vbegy_what_post == "video") {if ($video_type == 'youtube') {?>youtube-play<?php }else if ($video_type == 'vimeo') {?>vimeo-square<?php }else if ($video_type == 'daily' || $video_type == 'embed') {?>video-camera<?php }?><?php }else if ($vbegy_what_post == "slideshow") {?>film<?php }else if ($vbegy_what_post == "quote") {?>quote-left<?php }else if ($vbegy_what_post == "link") {?>link<?php }else if ($vbegy_what_post == "soundcloud") {?>soundcloud<?php }else if ($vbegy_what_post == "twitter") {?>twitter<?php }else if ($vbegy_what_post == "facebook") {?>facebook<?php }else {if (has_post_thumbnail()) {?>image<?php }else {?>file-text<?php }}?>"></i>
										<?php if ($vbegy_sidebar == "full") {
											echo get_aq_resize_img('full',255,165);
										}else {
											echo get_aq_resize_img('full',225,165);
										}?>
									</a>
								</div>
								<div class="block-box-content">
									<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php excerpt_title($excerpt_title);?></a>
									<?php if ($author_by == 'on') {?>
										<span><i class="fa fa-user"></i><?php _e("by","vbegy")?> : <?php echo ($post->post_author > 0?the_author_posts_link():$post_username);?></span>
									<?php }?>
									<span><i class="fa fa-clock-o"></i><?php the_time($date_format);?></span>
								</div>
							</div>
						<?php }
					endwhile;endif;?>
				</ul>
				<div class="clearfix"></div>
			</div>
		</div><!-- End block-box -->
		<?php
	}?>
	<script type="text/javascript">
		(function($) { "use strict";
			jQuery(".block-box-half .carousel-box<?php echo esc_js($rand_recent);?> > ul").each(function () {
				var vids = jQuery(".carousel-one",this);
				for(var i = 0; i < vids.length; i+=3) {
				    vids.slice(i, i+3).wrapAll('<li></li>');
				}
			});
			jQuery(".block-box-full .carousel-box<?php echo esc_js($rand_recent);?> > ul").each(function () {
				var vids = jQuery(".carousel-one",this);
				for(var i = 0; i < vids.length; i+=4) {
				    vids.slice(i, i+4).wrapAll('<li></li>');
				}
			});
		})(jQuery);
	</script>
<?php }?>