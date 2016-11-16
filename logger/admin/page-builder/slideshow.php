<?php
function Vpanel_Slideshow($box_posts_num,$box_display,$box_cats,$categories,$slide_overlay,$excerpt_title,$excerpt,$orderby,$key_b,$vbegy_sidebar) {
	global $post;
	$excerpt_title = (isset($excerpt_title) && (int)$excerpt_title != ""?$excerpt_title:5);
	$excerpt = (isset($excerpt) && (int)$excerpt != ""?$excerpt:25);
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
	?>
	<div class="box-slideshow<?php echo ($vbegy_sidebar == "full"?" block-box-full":"")?>">
		<ul>
			<?php if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				$post_username = get_post_meta($post->ID, 'post_username',true);
				$post_email = get_post_meta($post->ID, 'post_email',true);?>
				<li>
					<div class="box-slideshow-main">
						<?php if (has_post_thumbnail()) {?>
							<div class="box-slideshow-img">
								<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark">
									<?php if ($vbegy_sidebar == "full") {
										echo get_aq_resize_img('full',1140,641);
									}else {
										echo get_aq_resize_img('full',750,422);
									}?>
								</a>
							</div>
						<?php }
						if ($slide_overlay == "enable" || $slide_overlay == "title") {
							$author_by = vpanel_options("author_by");
							$date_format = (vpanel_options("date_format")?vpanel_options("date_format"):get_option("date_format"));?>
							<div class="box-slideshow-content">
								<a href="<?php the_permalink();?>" title="<?php printf('%s', the_title_attribute('echo=0')); ?>" rel="bookmark"><?php excerpt_title($excerpt_title);?></a>
								<div class="clearfix"></div>
								<?php if ($slide_overlay != "title") {?>
									<p><?php excerpt($excerpt);?></p>
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
			<?php endwhile;endif;?>
		</ul>
	</div><!-- End box-slideshow -->
	<div class="clearfix"></div>
<?php }?>