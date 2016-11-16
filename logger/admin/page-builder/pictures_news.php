<?php
function Vpanel_Pictures_News($box_title,$box_posts_num,$box_display,$box_cats,$categories,$box_style,$orderby,$key_b,$vbegy_sidebar,$animate) {
	global $post;
	$animate_class = (isset($animate) && $animate != "" && $animate != "none"?"animation ":"");
	$data_animate = (isset($animate) && $animate != "" && $animate != "none"?" data-animate='".esc_attr($animate)."'":"");
	$rand_pictures = rand(1,1000);
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
	if ($box_style == "pictures_1") {?>
		<div class="<?php echo ($animate_class)?>block-box block-gallery<?php echo ($vbegy_sidebar == "full"?" block-box-full":"")?>"<?php echo ($data_animate)?>>
			<?php if (isset($box_title) && $box_title != "" || $box_display == "category") {?>
				<div class="block-box-title"><?php echo (isset($box_title) && $box_title != ""?$box_title:(isset($box_display) && $box_display == "category"?"<a href='".get_category_link($box_cats)."'>".get_the_category_by_ID($box_cats)."</a><a class='block-box-title-more' href='".get_category_link($box_cats)."'>".__("More","vbegy")."</a>":""))?></div>
			<?php }?>
			<div class="block-box-1 block-gallery-1">
				<ul>
					<?php if ( have_posts() ) :
					$k = 0;
					while ( have_posts() ) : the_post();$k++;
						$vbegy_what_post = rwmb_meta('vbegy_what_post','select',$post->ID);
						$video_type = rwmb_meta('vbegy_video_post_type',"select",$post->ID);
					    if ($k == 1) {
					    	if (has_post_thumbnail()) {?>
								<li class="block-box-first">
									<div class="block-box-img">
										<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark">
											<i class="fa fa-<?php if (is_sticky()) {?>thumb-tack<?php }else if ($vbegy_what_post == "google") {?>map-marker<?php }else if ($vbegy_what_post == "audio") {?>volume-up<?php }else if ($vbegy_what_post == "video") {if ($video_type == 'youtube') {?>youtube-play<?php }else if ($video_type == 'vimeo') {?>vimeo-square<?php }else if ($video_type == 'daily' || $video_type == 'embed') {?>video-camera<?php }?><?php }else if ($vbegy_what_post == "slideshow") {?>film<?php }else if ($vbegy_what_post == "quote") {?>quote-left<?php }else if ($vbegy_what_post == "link") {?>link<?php }else if ($vbegy_what_post == "soundcloud") {?>soundcloud<?php }else if ($vbegy_what_post == "twitter") {?>twitter<?php }else if ($vbegy_what_post == "facebook") {?>facebook<?php }else {if (has_post_thumbnail()) {?>image<?php }else {?>file-text<?php }}?>"></i>
											<?php if ($vbegy_sidebar == "full") {
												echo get_aq_resize_img('full',346,310);
											}else {
												echo get_aq_resize_img('full',345,310);
											}?>
										</a>
									</div>
								
								</li>
							<?php }
						}else {
							if (has_post_thumbnail()) {?>
								<li>
									<div class="block-box-img">
										<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark">
											<i class="fa fa-<?php if (is_sticky()) {?>thumb-tack<?php }else if ($vbegy_what_post == "google") {?>map-marker<?php }else if ($vbegy_what_post == "audio") {?>volume-up<?php }else if ($vbegy_what_post == "video") {if ($video_type == 'youtube') {?>youtube-play<?php }else if ($video_type == 'vimeo') {?>vimeo-square<?php }else if ($video_type == 'daily' || $video_type == 'embed') {?>video-camera<?php }?><?php }else if ($vbegy_what_post == "slideshow") {?>film<?php }else if ($vbegy_what_post == "quote") {?>quote-left<?php }else if ($vbegy_what_post == "link") {?>link<?php }else if ($vbegy_what_post == "soundcloud") {?>soundcloud<?php }else if ($vbegy_what_post == "twitter") {?>twitter<?php }else if ($vbegy_what_post == "facebook") {?>facebook<?php }else {if (has_post_thumbnail()) {?>image<?php }else {?>file-text<?php }}?>"></i>
											<?php echo get_aq_resize_img('full',71,71);?>
										</a>
									</div>
								</li>
							<?php }
						}
					endwhile;endif;?>
				</ul>
				<div class="clearfix"></div>
			</div>
		</div><!-- End block-box -->
		<div class="clearfix"></div>
		<?php
	}else if ($box_style == "pictures_2") {?>
		<div class="<?php echo ($animate_class)?>block-box block-gallery<?php echo ($vbegy_sidebar == "full"?" block-box-full":"")?>"<?php echo ($data_animate)?>>
			<?php if (isset($box_title) && $box_title != "" || $box_display == "category") {?>
				<div class="block-box-title"><?php echo (isset($box_title) && $box_title != ""?$box_title:(isset($box_display) && $box_display == "category"?"<a href='".get_category_link($box_cats)."'>".get_the_category_by_ID($box_cats)."</a><a class='block-box-title-more' href='".get_category_link($box_cats)."'>".__("More","vbegy")."</a>":""))?></div>
			<?php }?>
			<div class="block-box-1 block-gallery-1 block-gallery-2">
				<ul>
					<?php if ( have_posts() ) :
					while ( have_posts() ) : the_post();
						$vbegy_what_post = rwmb_meta('vbegy_what_post','select',$post->ID);
						$video_type = rwmb_meta('vbegy_video_post_type',"select",$post->ID);
						if (has_post_thumbnail()) {?>
							<li>
								<div class="block-box-img">
									<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark">
										<i class="fa fa-<?php if (is_sticky()) {?>thumb-tack<?php }else if ($vbegy_what_post == "google") {?>map-marker<?php }else if ($vbegy_what_post == "audio") {?>volume-up<?php }else if ($vbegy_what_post == "video") {if ($video_type == 'youtube') {?>youtube-play<?php }else if ($video_type == 'vimeo') {?>vimeo-square<?php }else if ($video_type == 'daily' || $video_type == 'embed') {?>video-camera<?php }?><?php }else if ($vbegy_what_post == "slideshow") {?>film<?php }else if ($vbegy_what_post == "quote") {?>quote-left<?php }else if ($vbegy_what_post == "link") {?>link<?php }else if ($vbegy_what_post == "soundcloud") {?>soundcloud<?php }else if ($vbegy_what_post == "twitter") {?>twitter<?php }else if ($vbegy_what_post == "facebook") {?>facebook<?php }else {if (has_post_thumbnail()) {?>image<?php }else {?>file-text<?php }}?>"></i>
										<?php echo get_aq_resize_img('full',70,70);?>
									</a>
								</div>
							</li>
						<?php }
					endwhile;endif;?>
				</ul>
				<div class="clearfix"></div>
			</div>
		</div><!-- End block-box -->
		<div class="clearfix"></div>
		<?php
	}
}
?>