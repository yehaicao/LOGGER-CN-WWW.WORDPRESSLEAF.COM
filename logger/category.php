<?php get_header();
	$vbegy_sidebar_all = vpanel_options("sidebar_layout");
	$category_id       = get_query_var('cat');
	$categories        = get_option("categories_$category_id");
	$category_style    = (isset($categories["post_style"])?$categories["post_style"]:"default");
	$category          = get_category(get_query_var('cat'));
	if ($category_style != "default") {
		$post_style = $category_style;
	}else {
		$post_style = vpanel_options("post_style");
	}
	$category_des = vpanel_options('category_description');
	if ($category_des == "on") { 
		$category_description = category_description();
		if (!empty( $category_description)) {?>
			<div class="post post-style-2 category-description">
				<div class="post-wrap">
					<div class="post-inner">
						<div class="post-title">
							<i class="fa fa-folder-open"></i><?php echo __("About","vbegy")." ".esc_attr($category->cat_name);
							$category_rss = vpanel_options("category_rss");
							if ($category_rss == "on") {?>
								<a href="<?php echo esc_url(get_category_feed_link($category->cat_ID))?>"><i class="fa fa-rss"></i></a>
							<?php }?>
						</div>
						<?php echo ($category_description); ?>
					</div><!-- End post-inner -->
				</div><!-- End post-wrap -->
			</div><!-- End post -->
		<?php }
	}
	if ($post_style == "style_2" || $post_style == "style_3") {echo "<div class='row blog-all isotope'>";}
	get_template_part("loop","category");
	if ($post_style == "style_2" || $post_style == "style_3") {echo "</div>";}
	get_template_part("includes/pagination");
get_footer();?>