<?php
function Vpanel_Box_News($box_title,$box_posts_num,$box_display,$box_cats,$categories,$box_style,$excerpt_title,$excerpt,$orderby,$vbegy_sidebar,$animate) {
	global $post;
	$animate_class = (isset($animate) && $animate != "" && $animate != "none"?"animation ":"");
	$data_animate = (isset($animate) && $animate != "" && $animate != "none"?" data-animate='".esc_attr($animate)."'":"");
	$date_format = (vpanel_options("date_format")?vpanel_options("date_format"):get_option("date_format"));
	$excerpt_title = (isset($excerpt_title) && (int)$excerpt_title != ""?$excerpt_title:5);
	$author_by = vpanel_options("author_by");
	$excerpt = (isset($excerpt) && (int)$excerpt != ""?$excerpt:35);
	$rand_box = rand(1,1000);
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
	if ($box_style == "home_1") {
		?>
		<div class="<?php echo ($animate_class)?>block-box<?php echo ($vbegy_sidebar == "full"?" block-box-full block-box-full-1 block-box-full".esc_attr($rand_box):"")?>"<?php echo ($data_animate)?>>
			<?php if (isset($box_title) && $box_title != "" || $box_display == "category") {?>
				<div class="block-box-title"><?php echo (isset($box_title) && $box_title != ""?$box_title:(isset($box_display) && $box_display == "category"?"<a href='".get_category_link($box_cats)."'>".get_the_category_by_ID($box_cats)."</a><a class='block-box-title-more' href='".get_category_link($box_cats)."'>".__("More","vbegy")."</a>":""))?></div>
			<?php }?>
			<div class="block-box-1">
				<ul>
					<?php if ( have_posts() ) :
					$k = 0;
					while ( have_posts() ) : the_post();$k++;
						$vbegy_what_post = rwmb_meta('vbegy_what_post','select',$post->ID);
						$video_type = rwmb_meta('vbegy_video_post_type',"select",$post->ID);
						$post_username = get_post_meta($post->ID, 'post_username',true);
						$post_email = get_post_meta($post->ID, 'post_email',true);
					    if ($k == 1) {?>
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
									<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php excerpt_title($excerpt_title);?></a>
									<?php if ($author_by == 'on') {?>
										<span><i class="fa fa-user"></i><?php _e("by","vbegy")?> : <?php echo ($post->post_author > 0?the_author_posts_link():$post_username);?></span>
									<?php }?>
									<span><i class="fa fa-clock-o"></i><?php the_time($date_format);?></span>
									<div class="clearfix"></div>
									<p><?php excerpt($excerpt);?></p>
									<a class="button-default post-more" href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php _e("Continue Reading","vbegy")?></a>
								</div>
							</li>
						<?php }else {?>
							<li<?php echo ($vbegy_sidebar == "full"?" class='box-full-6'":"")?>>
								<?php if (has_post_thumbnail()) {?>
									<div class="block-box-img">
										<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark">
											<i class="fa fa-<?php if (is_sticky()) {?>thumb-tack<?php }else if ($vbegy_what_post == "google") {?>map-marker<?php }else if ($vbegy_what_post == "audio") {?>volume-up<?php }else if ($vbegy_what_post == "video") {if ($video_type == 'youtube') {?>youtube-play<?php }else if ($video_type == 'vimeo') {?>vimeo-square<?php }else if ($video_type == 'daily' || $video_type == 'embed') {?>video-camera<?php }?><?php }else if ($vbegy_what_post == "slideshow") {?>film<?php }else if ($vbegy_what_post == "quote") {?>quote-left<?php }else if ($vbegy_what_post == "link") {?>link<?php }else if ($vbegy_what_post == "soundcloud") {?>soundcloud<?php }else if ($vbegy_what_post == "twitter") {?>twitter<?php }else if ($vbegy_what_post == "facebook") {?>facebook<?php }else {if (has_post_thumbnail()) {?>image<?php }else {?>file-text<?php }}?>"></i>
											<?php echo get_aq_resize_img('full',130,70);?>
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
							</li>
						<?php }
					endwhile;endif;?>
				</ul>
				<div class="clearfix"></div>
			</div>
		</div><!-- End block-box -->
		<div class="clearfix"></div>
		<?php
	}else if ($box_style == "home_2") {
		?>
		<div class="<?php echo ($animate_class)?>block-box<?php echo ($vbegy_sidebar == "full"?" block-box-full block-box-full-2 block-box-full".esc_attr($rand_box):"")?>"<?php echo ($data_animate)?>>
			<?php if (isset($box_title) && $box_title != "" || $box_display == "category") {?>
				<div class="block-box-title"><?php echo (isset($box_title) && $box_title != ""?$box_title:(isset($box_display) && $box_display == "category"?"<a href='".get_category_link($box_cats)."'>".get_the_category_by_ID($box_cats)."</a><a class='block-box-title-more' href='".get_category_link($box_cats)."'>".__("More","vbegy")."</a>":""))?></div>
			<?php }?>
			<div class="block-box-1 block-box-2">
				<ul>
					<?php if ( have_posts() ) :
					$k = 0;
					while ( have_posts() ) : the_post();$k++;
					    $vbegy_what_post = rwmb_meta('vbegy_what_post','select',$post->ID);
					    $video_type = rwmb_meta('vbegy_video_post_type',"select",$post->ID);
					    $post_username = get_post_meta($post->ID, 'post_username',true);
					    $post_email = get_post_meta($post->ID, 'post_email',true);
					    if ($k == 1) {?>
							<li class="block-box-first">
								<?php if (has_post_thumbnail()) {?>
									<div class="block-box-img">
										<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark">
											<i class="fa fa-<?php if (is_sticky()) {?>thumb-tack<?php }else if ($vbegy_what_post == "google") {?>map-marker<?php }else if ($vbegy_what_post == "audio") {?>volume-up<?php }else if ($vbegy_what_post == "video") {if ($video_type == 'youtube') {?>youtube-play<?php }else if ($video_type == 'vimeo') {?>vimeo-square<?php }else if ($video_type == 'daily' || $video_type == 'embed') {?>video-camera<?php }?><?php }else if ($vbegy_what_post == "slideshow") {?>film<?php }else if ($vbegy_what_post == "quote") {?>quote-left<?php }else if ($vbegy_what_post == "link") {?>link<?php }else if ($vbegy_what_post == "soundcloud") {?>soundcloud<?php }else if ($vbegy_what_post == "twitter") {?>twitter<?php }else if ($vbegy_what_post == "facebook") {?>facebook<?php }else {if (has_post_thumbnail()) {?>image<?php }else {?>file-text<?php }}?>"></i>
											<?php echo get_aq_resize_img('full',345,240);?>
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
									<p><?php excerpt($excerpt);?></p>
									<a class="button-default post-more" href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php _e("Continue Reading","vbegy")?></a>
								</div>
							</li>
						<?php }else {?>
							<li<?php echo ($vbegy_sidebar == "full"?" class='box-full-3'":"")?>>
								<?php if (has_post_thumbnail()) {?>
									<div class="block-box-img">
										<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark">
											<i class="fa fa-<?php if (is_sticky()) {?>thumb-tack<?php }else if ($vbegy_what_post == "google") {?>map-marker<?php }else if ($vbegy_what_post == "audio") {?>volume-up<?php }else if ($vbegy_what_post == "video") {if ($video_type == 'youtube') {?>youtube-play<?php }else if ($video_type == 'vimeo') {?>vimeo-square<?php }else if ($video_type == 'daily' || $video_type == 'embed') {?>video-camera<?php }?><?php }else if ($vbegy_what_post == "slideshow") {?>film<?php }else if ($vbegy_what_post == "quote") {?>quote-left<?php }else if ($vbegy_what_post == "link") {?>link<?php }else if ($vbegy_what_post == "soundcloud") {?>soundcloud<?php }else if ($vbegy_what_post == "twitter") {?>twitter<?php }else if ($vbegy_what_post == "facebook") {?>facebook<?php }else {if (has_post_thumbnail()) {?>image<?php }else {?>file-text<?php }}?>"></i>
											<?php echo get_aq_resize_img('full',130,70);?>
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
							</li>
						<?php }
					endwhile;endif;?>
				</ul>
				<div class="clearfix"></div>
			</div>
		</div><!-- End block-box -->
		<div class="clearfix"></div>
		<?php
	}else if ($box_style == "home_3") {
		?>
		<div class="block-box-3 col-md-6">
			<div class="<?php echo ($animate_class)?>block-box<?php echo ($vbegy_sidebar == "full"?" block-box-full block-box-full-3":"")?>"<?php echo ($data_animate)?>>
			<?php if (isset($box_title) && $box_title != "" || $box_display == "category") {?>
				<div class="block-box-title"><?php echo (isset($box_title) && $box_title != ""?$box_title:(isset($box_display) && $box_display == "category"?"<a href='".get_category_link($box_cats)."'>".get_the_category_by_ID($box_cats)."</a><a class='block-box-title-more' href='".get_category_link($box_cats)."'>".__("More","vbegy")."</a>":""))?></div>
			<?php }?>
				<div class="block-box-1">
					<ul>
						<?php if ( have_posts() ) :
						$k = 0;
						while ( have_posts() ) : the_post();$k++;
							$vbegy_what_post = rwmb_meta('vbegy_what_post','select',$post->ID);
							$video_type = rwmb_meta('vbegy_video_post_type',"select",$post->ID);
							$post_username = get_post_meta($post->ID, 'post_username',true);
							$post_email = get_post_meta($post->ID, 'post_email',true);
						    if ($k == 1) {?>
								<li class="block-box-first">
									<?php if (has_post_thumbnail()) {?>
										<div class="block-box-img">
											<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark">
												<i class="fa fa-<?php if (is_sticky()) {?>thumb-tack<?php }else if ($vbegy_what_post == "google") {?>map-marker<?php }else if ($vbegy_what_post == "audio") {?>volume-up<?php }else if ($vbegy_what_post == "video") {if ($video_type == 'youtube') {?>youtube-play<?php }else if ($video_type == 'vimeo') {?>vimeo-square<?php }else if ($video_type == 'daily' || $video_type == 'embed') {?>video-camera<?php }?><?php }else if ($vbegy_what_post == "slideshow") {?>film<?php }else if ($vbegy_what_post == "quote") {?>quote-left<?php }else if ($vbegy_what_post == "link") {?>link<?php }else if ($vbegy_what_post == "soundcloud") {?>soundcloud<?php }else if ($vbegy_what_post == "twitter") {?>twitter<?php }else if ($vbegy_what_post == "facebook") {?>facebook<?php }else {if (has_post_thumbnail()) {?>image<?php }else {?>file-text<?php }}?>"></i>
												<?php if ($vbegy_sidebar == "full") {
													echo get_aq_resize_img('full',495,200);
												}else {
													echo get_aq_resize_img('full',300,190);
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
										<div class="clearfix"></div>
										<p><?php excerpt($excerpt);?></p>
										<a class="button-default post-more" href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php _e("Continue Reading","vbegy")?></a>
									</div>
								</li>
							<?php }else {?>
								<li>
									<?php if (has_post_thumbnail()) {?>
										<div class="block-box-img">
											<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark">
												<i class="fa fa-<?php if (is_sticky()) {?>thumb-tack<?php }else if ($vbegy_what_post == "google") {?>map-marker<?php }else if ($vbegy_what_post == "audio") {?>volume-up<?php }else if ($vbegy_what_post == "video") {if ($video_type == 'youtube') {?>youtube-play<?php }else if ($video_type == 'vimeo') {?>vimeo-square<?php }else if ($video_type == 'daily' || $video_type == 'embed') {?>video-camera<?php }?><?php }else if ($vbegy_what_post == "slideshow") {?>film<?php }else if ($vbegy_what_post == "quote") {?>quote-left<?php }else if ($vbegy_what_post == "link") {?>link<?php }else if ($vbegy_what_post == "soundcloud") {?>soundcloud<?php }else if ($vbegy_what_post == "twitter") {?>twitter<?php }else if ($vbegy_what_post == "facebook") {?>facebook<?php }else {if (has_post_thumbnail()) {?>image<?php }else {?>file-text<?php }}?>"></i>
												<?php echo get_aq_resize_img('full',130,70);?>
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
								</li>
							<?php }
						endwhile;endif;?>
					</ul>
					<div class="clearfix"></div>
				</div>
			</div><!-- End block-box -->
		</div><!-- End block-box-3 -->
		<?php
	}else if ($box_style == "home_4") {
		?>
		<div class="<?php echo ($animate_class)?>block-box<?php echo ($vbegy_sidebar == "full"?" block-box-full block-box-full-1 block-box-full".esc_attr($rand_box):"")?>"<?php echo ($data_animate)?>>
			<?php if (isset($box_title) && $box_title != "" || $box_display == "category") {?>
				<div class="block-box-title"><?php echo (isset($box_title) && $box_title != ""?$box_title:(isset($box_display) && $box_display == "category"?"<a href='".get_category_link($box_cats)."'>".get_the_category_by_ID($box_cats)."</a><a class='block-box-title-more' href='".get_category_link($box_cats)."'>".__("More","vbegy")."</a>":""))?></div>
			<?php }?>
			<div class="block-box-1">
				<ul>
					<?php if ( have_posts() ) :
					$k = 0;
					while ( have_posts() ) : the_post();$k++;
						$vbegy_what_post = rwmb_meta('vbegy_what_post','select',$post->ID);
						$video_type = rwmb_meta('vbegy_video_post_type',"select",$post->ID);
						$post_username = get_post_meta($post->ID, 'post_username',true);
						$post_email = get_post_meta($post->ID, 'post_email',true);
					    if ($k == 1) {?>
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
									<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php excerpt_title($excerpt_title);?></a>
									<?php if ($author_by == 'on') {?>
										<span><i class="fa fa-user"></i><?php _e("by","vbegy")?> : <?php echo ($post->post_author > 0?the_author_posts_link():$post_username);?></span>
									<?php }?>
									<span><i class="fa fa-clock-o"></i><?php the_time($date_format);?></span>
									<div class="clearfix"></div>
									<p><?php excerpt($excerpt);?></p>
									<a class="button-default post-more" href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php _e("Continue Reading","vbegy")?></a>
								</div>
							</li>
						<?php }else {?>
							<li<?php echo ($vbegy_sidebar == "full"?" class='box-full-6'":"")?>>
								<div class="block-box-content">
									<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php excerpt_title($excerpt_title);?></a>
									<?php if ($author_by == 'on') {?>
										<span><i class="fa fa-user"></i><?php _e("by","vbegy")?> : <?php echo ($post->post_author > 0?the_author_posts_link():$post_username);?></span>
									<?php }?>
									<span><i class="fa fa-clock-o"></i><?php the_time($date_format);?></span>
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
	}else if ($box_style == "home_5") {
		?>
		<div class="<?php echo ($animate_class)?>block-box<?php echo ($vbegy_sidebar == "full"?" block-box-full block-box-full-5":"")?>"<?php echo ($data_animate)?>>
			<?php if (isset($box_title) && $box_title != "" || $box_display == "category") {?>
				<div class="block-box-title"><?php echo (isset($box_title) && $box_title != ""?$box_title:(isset($box_display) && $box_display == "category"?"<a href='".get_category_link($box_cats)."'>".get_the_category_by_ID($box_cats)."</a><a class='block-box-title-more' href='".get_category_link($box_cats)."'>".__("More","vbegy")."</a>":""))?></div>
			<?php }?>
			<div class="block-box-1 block-box-5">
				<ul>
					<?php if ( have_posts() ) :
					while ( have_posts() ) : the_post();
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
								<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php excerpt_title($excerpt_title);?></a>
								<?php if ($author_by == 'on') {?>
										<span><i class="fa fa-user"></i><?php _e("by","vbegy")?> : <?php echo ($post->post_author > 0?the_author_posts_link():$post_username);?></span>
									<?php }?>
								<span><i class="fa fa-clock-o"></i><?php the_time($date_format);?></span>
								<div class="clearfix"></div>
								<p><?php excerpt($excerpt);?></p>
								<a class="button-default post-more" href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php _e("Continue Reading","vbegy")?></a>
							</div>
						</li>
					<?php endwhile;endif;?>
				</ul>
				<div class="clearfix"></div>
			</div>
		</div><!-- End block-box -->
		<div class="clearfix"></div>
		<?php
	}else if ($box_style == "home_6") {
		?>
		<div class="<?php echo ($animate_class)?>block-box<?php echo ($vbegy_sidebar == "full"?" block-box-full block-box-full-2 block-box-full".esc_attr($rand_box):"")?>"<?php echo ($data_animate)?>>
			<?php if (isset($box_title) && $box_title != "" || $box_display == "category") {?>
				<div class="block-box-title"><?php echo (isset($box_title) && $box_title != ""?$box_title:(isset($box_display) && $box_display == "category"?"<a href='".get_category_link($box_cats)."'>".get_the_category_by_ID($box_cats)."</a><a class='block-box-title-more' href='".get_category_link($box_cats)."'>".__("More","vbegy")."</a>":""))?></div>
			<?php }?>
			<div class="block-box-1 block-box-2">
				<ul>
					<?php if ( have_posts() ) :
					$k = 0;
					while ( have_posts() ) : the_post();$k++;
						$vbegy_what_post = rwmb_meta('vbegy_what_post','select',$post->ID);
						$video_type = rwmb_meta('vbegy_video_post_type',"select",$post->ID);
						$post_username = get_post_meta($post->ID, 'post_username',true);
						$post_email = get_post_meta($post->ID, 'post_email',true);
					    if ($k == 1) {?>
							<li class="block-box-first">
								<?php if (has_post_thumbnail()) {?>
									<div class="block-box-img">
										<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark">
											<i class="fa fa-<?php if (is_sticky()) {?>thumb-tack<?php }else if ($vbegy_what_post == "google") {?>map-marker<?php }else if ($vbegy_what_post == "audio") {?>volume-up<?php }else if ($vbegy_what_post == "video") {if ($video_type == 'youtube') {?>youtube-play<?php }else if ($video_type == 'vimeo') {?>vimeo-square<?php }else if ($video_type == 'daily' || $video_type == 'embed') {?>video-camera<?php }?><?php }else if ($vbegy_what_post == "slideshow") {?>film<?php }else if ($vbegy_what_post == "quote") {?>quote-left<?php }else if ($vbegy_what_post == "link") {?>link<?php }else if ($vbegy_what_post == "soundcloud") {?>soundcloud<?php }else if ($vbegy_what_post == "twitter") {?>twitter<?php }else if ($vbegy_what_post == "facebook") {?>facebook<?php }else {if (has_post_thumbnail()) {?>image<?php }else {?>file-text<?php }}?>"></i>
											<?php echo get_aq_resize_img('full',345,240);?>
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
									<p><?php excerpt($excerpt);?></p>
									<a class="button-default post-more" href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php _e("Continue Reading","vbegy")?></a>
								</div>
							</li>
						<?php }else {?>
							<li<?php echo ($vbegy_sidebar == "full"?" class='box-full-3'":"")?>>
								<div class="block-box-content">
									<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php excerpt_title($excerpt_title);?></a>
									<?php if ($author_by == 'on') {?>
										<span><i class="fa fa-user"></i><?php _e("by","vbegy")?> : <?php echo ($post->post_author > 0?the_author_posts_link():$post_username);?></span>
									<?php }?>
									<span><i class="fa fa-clock-o"></i><?php the_time($date_format);?></span>
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
	}else if ($box_style == "home_7" || $box_style == "home_8") {
		?>
		<div class="<?php echo ($animate_class)?>block-box<?php echo ($vbegy_sidebar == "full"?" block-box-full":"")?>"<?php echo ($data_animate)?>>
			<?php if (isset($box_title) && $box_title != "" || $box_display == "category") {?>
				<div class="block-box-title"><?php echo (isset($box_title) && $box_title != ""?$box_title:(isset($box_display) && $box_display == "category"?"<a href='".get_category_link($box_cats)."'>".get_the_category_by_ID($box_cats)."</a><a class='block-box-title-more' href='".get_category_link($box_cats)."'>".__("More","vbegy")."</a>":""))?></div>
			<?php }?>
			<div class="block-box-1 block-box-7">
				<ul>
					<?php if ( have_posts() ) :
					while ( have_posts() ) : the_post();
					    $vbegy_what_post = rwmb_meta('vbegy_what_post','select',$post->ID);
					    $video_type = rwmb_meta('vbegy_video_post_type',"select",$post->ID);
					    $post_username = get_post_meta($post->ID, 'post_username',true);
					    $post_email = get_post_meta($post->ID, 'post_email',true);?>
						<li>
							<?php if ($box_style == "home_7") {
								if (has_post_thumbnail()) {?>
									<div class="block-box-img">
										<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark">
											<i class="fa fa-<?php if (is_sticky()) {?>thumb-tack<?php }else if ($vbegy_what_post == "google") {?>map-marker<?php }else if ($vbegy_what_post == "audio") {?>volume-up<?php }else if ($vbegy_what_post == "video") {if ($video_type == 'youtube') {?>youtube-play<?php }else if ($video_type == 'vimeo') {?>vimeo-square<?php }else if ($video_type == 'daily' || $video_type == 'embed') {?>video-camera<?php }?><?php }else if ($vbegy_what_post == "slideshow") {?>film<?php }else if ($vbegy_what_post == "quote") {?>quote-left<?php }else if ($vbegy_what_post == "link") {?>link<?php }else if ($vbegy_what_post == "soundcloud") {?>soundcloud<?php }else if ($vbegy_what_post == "twitter") {?>twitter<?php }else if ($vbegy_what_post == "facebook") {?>facebook<?php }else {if (has_post_thumbnail()) {?>image<?php }else {?>file-text<?php }}?>"></i>
											<?php echo get_aq_resize_img('full',130,70);?>
										</a>
									</div>
								<?php }
							}?>
							<div class="block-box-content">
								<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php excerpt_title($excerpt_title);?></a>
								<?php if ($author_by == 'on') {?>
									<span><i class="fa fa-user"></i><?php _e("by","vbegy")?> : <?php echo ($post->post_author > 0?the_author_posts_link():$post_username);?></span>
								<?php }?>
								<span><i class="fa fa-clock-o"></i><?php the_time($date_format);?></span>
							</div>
						</li>
					<?php endwhile;endif;?>
				</ul>
				<div class="clearfix"></div>
			</div>
		</div><!-- End block-box -->
		<div class="clearfix"></div>
		<?php
	}else if ($box_style == "home_9" || $box_style == "home_10") {
		?>
		<div class="block-box-3 col-md-6">
			<div class="<?php echo ($animate_class)?>block-box<?php echo ($vbegy_sidebar == "full"?" block-box-full block-box-full-3":"")?>"<?php echo ($data_animate)?>>
				<?php if (isset($box_title) && $box_title != "" || $box_display == "category") {?>
					<div class="block-box-title"><?php echo (isset($box_title) && $box_title != ""?$box_title:(isset($box_display) && $box_display == "category"?"<a href='".get_category_link($box_cats)."'>".get_the_category_by_ID($box_cats)."</a><a class='block-box-title-more' href='".get_category_link($box_cats)."'>".__("More","vbegy")."</a>":""))?></div>
				<?php }?>
				<div class="block-box-1">
					<ul>
						<?php if ( have_posts() ) :
						while ( have_posts() ) : the_post();
							$vbegy_what_post = rwmb_meta('vbegy_what_post','select',$post->ID);
							$video_type = rwmb_meta('vbegy_video_post_type',"select",$post->ID);
							$post_username = get_post_meta($post->ID, 'post_username',true);
							$post_email = get_post_meta($post->ID, 'post_email',true);?>
							<li>
								<?php if ($box_style == "home_9") {
									if (has_post_thumbnail()) {?>
										<div class="block-box-img">
											<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark">
												<i class="fa fa-<?php if (is_sticky()) {?>thumb-tack<?php }else if ($vbegy_what_post == "google") {?>map-marker<?php }else if ($vbegy_what_post == "audio") {?>volume-up<?php }else if ($vbegy_what_post == "video") {if ($video_type == 'youtube') {?>youtube-play<?php }else if ($video_type == 'vimeo') {?>vimeo-square<?php }else if ($video_type == 'daily' || $video_type == 'embed') {?>video-camera<?php }?><?php }else if ($vbegy_what_post == "slideshow") {?>film<?php }else if ($vbegy_what_post == "quote") {?>quote-left<?php }else if ($vbegy_what_post == "link") {?>link<?php }else if ($vbegy_what_post == "soundcloud") {?>soundcloud<?php }else if ($vbegy_what_post == "twitter") {?>twitter<?php }else if ($vbegy_what_post == "facebook") {?>facebook<?php }else {if (has_post_thumbnail()) {?>image<?php }else {?>file-text<?php }}?>"></i>
												<?php echo get_aq_resize_img('full',130,70);?>
											</a>
										</div>
									<?php }
								}?>
								<div class="block-box-content">
									<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php excerpt_title($excerpt_title);?></a>
									<?php if ($author_by == 'on') {?>
									<span><i class="fa fa-user"></i><?php _e("by","vbegy")?> : <?php echo ($post->post_author > 0?the_author_posts_link():$post_username);?></span>
								<?php }?>
									<span><i class="fa fa-clock-o"></i><?php the_time($date_format);?></span>
								</div>
							</li>
						<?php endwhile;endif;?>
					</ul>
					<div class="clearfix"></div>
				</div>
			</div><!-- End block-box -->
		</div><!-- End block-box-3 -->
		<?php
	}else if ($box_style == "home_11") {
		?>
		<div class="block-box-3 col-md-6">
			<div class="<?php echo ($animate_class)?>block-box<?php echo ($vbegy_sidebar == "full"?" block-box-full block-box-full-3":"")?>"<?php echo ($data_animate)?>>
				<?php if (isset($box_title) && $box_title != "" || $box_display == "category") {?>
					<div class="block-box-title"><?php echo (isset($box_title) && $box_title != ""?$box_title:(isset($box_display) && $box_display == "category"?"<a href='".get_category_link($box_cats)."'>".get_the_category_by_ID($box_cats)."</a><a class='block-box-title-more' href='".get_category_link($box_cats)."'>".__("More","vbegy")."</a>":""))?></div>
				<?php }?>
				<div class="block-box-1">
					<ul>
						<?php if ( have_posts() ) :
						$k = 0;
						while ( have_posts() ) : the_post();$k++;
							$vbegy_what_post = rwmb_meta('vbegy_what_post','select',$post->ID);
							$video_type = rwmb_meta('vbegy_video_post_type',"select",$post->ID);
							$post_username = get_post_meta($post->ID, 'post_username',true);
							$post_email = get_post_meta($post->ID, 'post_email',true);
						    if ($k == 1) {?>
								<li class="block-box-first">
									<?php if (has_post_thumbnail()) {?>
										<div class="block-box-img">
											<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark">
												<i class="fa fa-<?php if (is_sticky()) {?>thumb-tack<?php }else if ($vbegy_what_post == "google") {?>map-marker<?php }else if ($vbegy_what_post == "audio") {?>volume-up<?php }else if ($vbegy_what_post == "video") {if ($video_type == 'youtube') {?>youtube-play<?php }else if ($video_type == 'vimeo') {?>vimeo-square<?php }else if ($video_type == 'daily' || $video_type == 'embed') {?>video-camera<?php }?><?php }else if ($vbegy_what_post == "slideshow") {?>film<?php }else if ($vbegy_what_post == "quote") {?>quote-left<?php }else if ($vbegy_what_post == "link") {?>link<?php }else if ($vbegy_what_post == "soundcloud") {?>soundcloud<?php }else if ($vbegy_what_post == "twitter") {?>twitter<?php }else if ($vbegy_what_post == "facebook") {?>facebook<?php }else {if (has_post_thumbnail()) {?>image<?php }else {?>file-text<?php }}?>"></i>
												<?php if ($vbegy_sidebar == "full") {
													echo get_aq_resize_img('full',495,200);
												}else {
													echo get_aq_resize_img('full',300,190);
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
										<div class="clearfix"></div>
										<p><?php excerpt($excerpt);?></p>
										<a class="button-default post-more" href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php _e("Continue Reading","vbegy")?></a>
									</div>
								</li>
							<?php }else {?>
								<li>
									<div class="block-box-content">
										<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php excerpt_title($excerpt_title);?></a>
										<?php if ($author_by == 'on') {?>
										<span><i class="fa fa-user"></i><?php _e("by","vbegy")?> : <?php echo ($post->post_author > 0?the_author_posts_link():$post_username);?></span>
									<?php }?>
										<span><i class="fa fa-clock-o"></i><?php the_time($date_format);?></span>
									</div>
								</li>
							<?php }
						endwhile;endif;?>
					</ul>
					<div class="clearfix"></div>
				</div>
			</div><!-- End block-box -->
		</div><!-- End block-box-3 -->
		<?php
	}
	?>
	<script type="text/javascript">
		(function($) { "use strict";
			jQuery(".block-box-full<?php echo esc_js($rand_box)?>").each(function () {
				var vids_1 = jQuery("li.box-full-6",this);
				for(var i = 0; i < vids_1.length; i+=4) {
				    vids_1.slice(i, i+4).wrapAll('<li></li>');
				}
				var vids_2 = jQuery("li.box-full-3",this);
				for(var i = 0; i < vids_2.length; i+=2) {
				    vids_2.slice(i, i+2).wrapAll('<li></li>');
				}
			});
		})(jQuery);
	</script>
<?php }?>