<?php
/* Tabs */
add_action( 'widgets_init', 'widget_tabs_widget' );
function widget_tabs_widget() {
	register_widget( 'Widget_Tabs' );
}
class Widget_Tabs extends WP_Widget {

	function Widget_Tabs() {
		$widget_ops = array( 'classname' => 'tabs-widget'  );
		$control_ops = array( 'id_base' => 'tabs-widget' );
		parent::__construct( 'tabs-widget','Logger - Tabs', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title			      = apply_filters('widget_title', $instance['title'] );
		$show_images          = esc_attr($instance['show_images']);
		$orderby		      = esc_attr($instance['orderby']);
		$posts_per_page_p     = esc_attr((int)$instance['posts_per_page_p']);
		$comments_number      = esc_attr((int)$instance['comments_number']);
		$display_posts        = esc_attr($instance['display_posts']);
		$display_comments     = esc_attr($instance['display_comments']);
		$display_tags         = esc_attr($instance['display_tags']);
		$excerpt_title        = esc_attr((int)$instance['excerpt_title']);
		$excerpt_comment      = esc_attr((int)$instance['excerpt_comment']);
		$post_or_portfolio    = esc_attr($instance['post_or_portfolio']);
		$rand_w               = rand(1,1000);
		$display	       	  = esc_attr($instance['display']);
		$category	       	  = esc_attr($instance['category']);
		$categories	       	  = ($instance['categories']);
		$category_portfolio	  = esc_attr($instance['category_portfolio']);
		$categories_portfolio = ($instance['categories_portfolio']);
		
		if ($display_posts == "on" || $display_comments == "on" || $display_tags == "on") {
			echo "<div class='widget tabs-warp widget-tabs'>";?>
				<div class="widget-title">
					<ul class="tabs tabs<?php echo esc_attr($rand_w);?>">
						<?php if ($display_posts == "on") {?>
						<li class="tab"><a href="#"><?php if ($orderby == "popular") {_e('Popular','vbegy');}elseif ($orderby == "random") {_e('Rand','vbegy');}else {_e('Recent','vbegy');}?></a></li>
						<?php }
						if ($display_comments == "on") {?>
						<li class="tab"><a href="#"><?php _e('Comments','vbegy')?></a></li>
						<?php }
						if ($display_tags == "on") {?>
						<li class="tab"><a href="#"><?php _e('Tags','vbegy')?></a></li>
						<?php }?>
					</ul>
				</div>
				<?php
				if ($display_posts == "on") {
					echo "<div class='tab-inner-warp tab-inner-warp".esc_attr($rand_w)."'>";
						Vpanel_posts($posts_per_page_p,$orderby,"on",12,$excerpt_title,$show_images,$post_or_portfolio,$display,$category,$categories,$category_portfolio,$categories_portfolio);
					echo "</div>";
				}
				if ($display_comments == "on") {
					echo "<div class='tab-inner-warp tab-inner-warp".esc_attr($rand_w)."'>";
						Vpanel_comments($post_or_portfolio,$comments_number,$excerpt_comment,$show_images);
					echo "</div>";
				}
				if ($display_tags == "on") {
					echo "<div class='tab-inner-warp tab-inner-warp".esc_attr($rand_w)."'><div class='widget_tag_cloud'>";
						if ($post_or_portfolio == 'portfolio') {
							$tag_type = array('taxonomy' => 'portfolio_tags');
						}else {
							$tag_type = array();
						}
						$args = array_merge(array('smallest' => 8,'largest' => 22,'unit' => 'pt','number' => 0),$tag_type);
						wp_tag_cloud($args);
					echo "</div></div>";
				}
				?>
				<script type='text/javascript'>
					jQuery(document).ready(function(){
						jQuery("ul.tabs<?php echo esc_js($rand_w);?>").tabs(".tab-inner-warp<?php echo esc_js($rand_w)?>",{effect:"slide",fadeInSpeed:100});
					});
				</script>
			<?php echo $after_widget;
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance					      = $old_instance;
		$instance['title']			      = strip_tags( $new_instance['title'] );
		$instance['show_images']          = $new_instance['show_images'];
		$instance['posts_per_page_p']     = $new_instance['posts_per_page_p'];
		$instance['comments_number']      = $new_instance['comments_number'];
		$instance['orderby']		      = $new_instance['orderby'];
		$instance['display_posts']        = $new_instance['display_posts'];
		$instance['display_comments']     = $new_instance['display_comments'];
		$instance['display_tags']         = $new_instance['display_tags'];
		$instance['excerpt_title']        = $new_instance['excerpt_title'];
		$instance['excerpt_comment']      = $new_instance['excerpt_comment'];
		$instance['post_or_portfolio']    = $new_instance['post_or_portfolio'];
		$instance['display']              = $new_instance['display'];
		$instance['category']	          = $new_instance['category'];
		$instance['categories']	          = $new_instance['categories'];
		$instance['category_portfolio']	  = $new_instance['category_portfolio'];
		$instance['categories_portfolio'] = $new_instance['categories_portfolio'];
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => 'Tabs','posts_per_page_p' => '5','comments_number' => '5','display_posts' => 'on','show_images' => 'on','display_comments' => 'on','display_tags' => 'on','excerpt_title' => '5','excerpt_comment' => '30','post_or_portfolio' => 'post','orderby' => 'popular' );
		$instance = wp_parse_args( (array) $instance, $defaults );
		
		$categories_obj = get_categories('hide_empty=0');
		$categories_obj = get_categories('hide_empty=0');
		$categories = array();
		foreach ($categories_obj as $pn_cat) {
			$categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
		}
		
		$portfolio_cat_obj = get_categories('hide_empty=0&taxonomy=portfolio-category');
		$portfolio_cat = array();
		foreach ($portfolio_cat_obj as $p_cat) {
			$portfolio_cat[$p_cat->cat_ID] = $p_cat->cat_name;
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo (isset($instance['title'])?esc_attr($instance['title']):""); ?>" class="widefat" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'post_or_portfolio' ); ?>">Post or portfolio : </label>
			<select class="post_or_portfolio" id="<?php echo $this->get_field_id( 'post_or_portfolio' ); ?>" name="<?php echo $this->get_field_name( 'post_or_portfolio' ); ?>">
				<option value="post" <?php if( isset($instance['post_or_portfolio']) && $instance['post_or_portfolio'] == 'post' ) echo "selected=\"selected\""; else echo ""; ?>>Post</option>
				<option value="portfolio" <?php if( isset($instance['post_or_portfolio']) && $instance['post_or_portfolio'] == 'portfolio' ) echo "selected=\"selected\""; else echo ""; ?>>Portfolio</option>
			</select>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo (isset($instance['show_images']) && $instance['show_images'] == "on"?' checked="checked"':"");?> id="<?php echo $this->get_field_id( 'show_images' ); ?>" name="<?php echo $this->get_field_name( 'show_images' ); ?>">
			<label for="<?php echo $this->get_field_id( 'show_images' ); ?>">Show images?</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'excerpt_title' ); ?>">The number of words excerpt title</label>
			<input id="<?php echo $this->get_field_id( 'excerpt_title' ); ?>" name="<?php echo $this->get_field_name( 'excerpt_title' ); ?>" value="<?php echo (isset($instance['excerpt_title'])?(int)$instance['excerpt_title']:""); ?>" size="3" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'excerpt_comment' ); ?>">The number of words excerpt comments</label>
			<input id="<?php echo $this->get_field_id( 'excerpt_comment' ); ?>" name="<?php echo $this->get_field_name( 'excerpt_comment' ); ?>" value="<?php echo (isset($instance['excerpt_comment'])?(int)$instance['excerpt_comment']:""); ?>" size="3" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'posts_per_page_p' ); ?>">Number of popular to show : </label>
			<input id="<?php echo $this->get_field_id( 'posts_per_page_p' ); ?>" name="<?php echo $this->get_field_name( 'posts_per_page_p' ); ?>" value="<?php echo (isset($instance['posts_per_page_p'])?(int)$instance['posts_per_page_p']:""); ?>" size="3" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'comments_number' ); ?>">Number of comments to show : </label>
			<input id="<?php echo $this->get_field_id( 'comments_number' ); ?>" name="<?php echo $this->get_field_name( 'comments_number' ); ?>" value="<?php echo (isset($instance['comments_number'])?(int)$instance['comments_number']:""); ?>" size="3" type="text">
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo (isset($instance['display_posts']) && $instance['display_posts'] == "on"?' checked="checked"':"");?> id="<?php echo $this->get_field_id( 'display_posts' ); ?>" name="<?php echo $this->get_field_name( 'display_posts' ); ?>">
			<label for="<?php echo $this->get_field_id( 'display_posts' ); ?>">Display posts?</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'orderby' ); ?>">Order by : </label>
			<select id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>">
				<option value="popular" <?php if( isset($instance['orderby']) && $instance['orderby'] == 'popular' ) echo "selected=\"selected\""; else echo ""; ?>>Popular</option>
				<option value="recent" <?php if( isset($instance['orderby']) && $instance['orderby'] == 'recent' ) echo "selected=\"selected\""; else echo ""; ?>>Recent</option>
				<option value="random" <?php if( isset($instance['orderby']) && $instance['orderby'] == 'random' ) echo "selected=\"selected\""; else echo ""; ?>>Random</option>
			</select>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo (isset($instance['display_comments']) && $instance['display_comments'] == "on"?' checked="checked"':"");?> id="<?php echo $this->get_field_id( 'display_comments' ); ?>" name="<?php echo $this->get_field_name( 'display_comments' ); ?>">
			<label for="<?php echo $this->get_field_id( 'display_comments' ); ?>">Display comments?</label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo (isset($instance['display_tags']) && $instance['display_tags'] == "on"?' checked="checked"':"");?> id="<?php echo $this->get_field_id( 'display_tags' ); ?>" name="<?php echo $this->get_field_name( 'display_tags' ); ?>">
			<label for="<?php echo $this->get_field_id( 'display_tags' ); ?>">Display tags?</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'display' ); ?>">Display :</label>
		    <select class="widget_display" id="<?php echo $this->get_field_id( 'display' ); ?>" name="<?php echo $this->get_field_name( 'display' ); ?>">
				<option value="">Latest Posts</option>
				<option value="category" <?php if (isset($instance['display']) && $instance['display'] == "category") {echo ' selected="selected"';}?>>Single Category</option>
				<option value="categories" <?php if (isset($instance['display']) && $instance['display'] == "categories") {echo ' selected="selected"';}?>>Multiple categories</option>
		    </select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'category' ); ?>">Category :</label>
		    <select class="widget_category" id="<?php echo $this->get_field_id( 'category' ); ?>" name="<?php echo $this->get_field_name( 'category' ); ?>">
		    <?php foreach ($categories as $key => $option) {?>
				<option value="<?php echo esc_attr($key);?>" <?php if (isset($instance['category']) && $instance['category'] == $key) {echo ' selected="selected"';}?>><?php echo esc_attr($option);?></option>
			<?php }?>
		    </select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'categories' ); ?>">Categories :</label>
		    <select class="widget_categories" multiple="multiple" id="<?php echo $this->get_field_id( 'categories' ); ?>[]" name="<?php echo $this->get_field_name( 'categories' ); ?>[]">
		    	<?php foreach ($categories as $key => $option) {?>
		    		<option value="<?php echo esc_attr($key) ?>" <?php if (isset($instance['categories']) && is_array($instance['categories']) && in_array($key,$instance['categories'])) {echo ' selected="selected"';} ?>><?php echo esc_attr($option); ?></option>
		    	<?php } ?>
		    </select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'category_portfolio' ); ?>">Category :</label>
		    <select class="category_portfolio" id="<?php echo $this->get_field_id( 'category_portfolio' ); ?>" name="<?php echo $this->get_field_name( 'category_portfolio' ); ?>">
		    <?php foreach ($portfolio_cat as $key => $option) {?>
				<option value="<?php echo esc_attr($key);?>" <?php if (isset($instance['category_portfolio']) && $instance['category_portfolio'] == $key) {echo ' selected="selected"';}?>><?php echo esc_attr($option);?></option>
			<?php }?>
		    </select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'categories_portfolio' ); ?>">Categories :</label>
		    <select class="categories_portfolio" multiple="multiple" id="<?php echo $this->get_field_id( 'categories_portfolio' ); ?>[]" name="<?php echo $this->get_field_name( 'categories_portfolio' ); ?>[]">
		    	<?php foreach ($portfolio_cat as $key => $option) {?>
		    		<option value="<?php echo esc_attr($key) ?>" <?php if (isset($instance['categories_portfolio']) && is_array($instance['categories_portfolio']) && in_array($key,$instance['categories_portfolio'])) {echo ' selected="selected"';} ?>><?php echo esc_attr($option); ?></option>
		    	<?php } ?>
		    </select>
		</p>
		
		<script type="text/javascript">
			jQuery(document).ready( function($) {
				if (jQuery(".widget_display").length > 0) {
					jQuery(".widget_display").each(function () {
						var widget_display       = jQuery(this);
						var post_or_portfolio    = jQuery(this).parent().parent().find(".post_or_portfolio");
						var widget_category      = jQuery(this).parent().parent().find(".widget_category");
						var widget_categories    = jQuery(this).parent().parent().find(".widget_categories");
						var category_portfolio   = jQuery(this).parent().parent().find(".category_portfolio");
						var categories_portfolio = jQuery(this).parent().parent().find(".categories_portfolio");
						widget_category.parent().hide();
						widget_categories.parent().hide();
						category_portfolio.parent().hide();
						categories_portfolio.parent().hide();
						
						widget_display.change(function () {
							if (jQuery(this).parent().parent().find(".post_or_portfolio").val() == "post") {
								if (widget_display.val() == "category") {
									widget_category.parent().slideDown(500);
									widget_categories.parent().slideUp(500);
									category_portfolio.parent().slideUp(500);
									categories_portfolio.parent().slideUp(500);
								}else if (widget_display.val() == "categories") {
									widget_categories.parent().slideDown(500);
									widget_category.parent().slideUp(500);
									category_portfolio.parent().slideUp(500);
									categories_portfolio.parent().slideUp(500);
								}else {
									widget_category.parent().slideUp(500);
									widget_categories.parent().slideUp(500);
									category_portfolio.parent().slideUp(500);
									categories_portfolio.parent().slideUp(500);
								}
							}else {
								if (widget_display.val() == "category") {
									category_portfolio.parent().slideDown(500);
									categories_portfolio.parent().slideUp(500);
									widget_category.parent().slideUp(500);
									widget_categories.parent().slideUp(500);
								}else if (widget_display.val() == "categories") {
									categories_portfolio.parent().slideDown(500);
									category_portfolio.parent().slideUp(500);
									widget_category.parent().slideUp(500);
									widget_categories.parent().slideUp(500);
								}else {
									category_portfolio.parent().slideUp(500);
									categories_portfolio.parent().slideUp(500);
									widget_category.parent().slideUp(500);
									widget_categories.parent().slideUp(500);
								}
							}
						});
						
						if (post_or_portfolio.val() == "post") {
							if (widget_display.val() == "category") {
								widget_category.parent().slideDown(500);
							}else if (widget_display.val() == "categories") {
								widget_categories.parent().slideDown(500);
							}else {
								widget_category.parent().slideUp(500);
								widget_categories.parent().slideUp(500);
							}
						}else if (post_or_portfolio.val() == "portfolio") {
							if (widget_display.val() == "category") {
								category_portfolio.parent().slideDown(500);
							}else if (widget_display.val() == "categories") {
								categories_portfolio.parent().slideDown(500);
							}else {
								category_portfolio.parent().slideUp(500);
								categories_portfolio.parent().slideUp(500);
							}
						}
						post_or_portfolio.change(function () {
							if (post_or_portfolio.val() == "post") {
								if (widget_display.val() == "category") {
									widget_category.parent().slideDown(500);
									category_portfolio.parent().slideUp(500);
									categories_portfolio.parent().slideUp(500);
								}else if (widget_display.val() == "categories") {
									widget_categories.parent().slideDown(500);
									category_portfolio.parent().slideUp(500);
									categories_portfolio.parent().slideUp(500);
								}else {
									widget_category.parent().slideUp(500);
									widget_categories.parent().slideUp(500);
									category_portfolio.parent().slideUp(500);
									categories_portfolio.parent().slideUp(500);
								}
							}else if (post_or_portfolio.val() == "portfolio") {
								if (widget_display.val() == "category") {
									category_portfolio.parent().slideDown(500);
									widget_category.parent().slideUp(500);
									widget_categories.parent().slideUp(500);
								}else if (widget_display.val() == "categories") {
									categories_portfolio.parent().slideDown(500);
									widget_category.parent().slideUp(500);
									widget_categories.parent().slideUp(500);
								}else {
									category_portfolio.parent().slideUp(500);
									categories_portfolio.parent().slideUp(500);
									widget_category.parent().slideUp(500);
									widget_categories.parent().slideUp(500);
								}
							}
						});
					});
				}
			});
		</script>
	<?php
	}
}
?>