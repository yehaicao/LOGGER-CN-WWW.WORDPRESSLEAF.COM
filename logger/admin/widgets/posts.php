<?php
/* Posts */
add_action( 'widgets_init', 'widget_posts_widget' );
function widget_posts_widget() {
	register_widget( 'Widget_posts' );
}
class Widget_posts extends WP_Widget {

	function Widget_posts() {
		$widget_ops = array( 'classname' => 'widget-posts'  );
		$control_ops = array( 'id_base' => 'widget_posts' );
		parent::__construct( 'widget_posts','Logger - posts', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title                = apply_filters('widget_title', $instance['title'] );
		$orderby		  	  = esc_attr($instance['orderby']);
		$posts_per_page	  	  = esc_attr($instance['posts_per_page']);
		$display_date	  	  = esc_attr($instance['display_date']);
		$display_review	   	  = esc_attr($instance['display_review']);
		$display_author	  	  = esc_attr($instance['display_author']);
		$excerpt_title	  	  = esc_attr($instance['excerpt_title']);
		$show_images	  	  = esc_attr($instance['show_images']);
		$post_or_portfolio	  = esc_attr($instance['post_or_portfolio']);
		$display	       	  = esc_attr($instance['display']);
		$category	       	  = esc_attr($instance['category']);
		$categories	       	  = ($instance['categories']);
		$category_portfolio	  = esc_attr($instance['category_portfolio']);
		$categories_portfolio = ($instance['categories_portfolio']);
			
		echo $before_widget;
			if ( $title )
				echo $before_title.esc_attr($title).$after_title;
			Vpanel_posts($posts_per_page,$orderby,$display_date,12,$excerpt_title,$show_images,$post_or_portfolio,$display_review,$display_author,$display,$category,$categories,$category_portfolio,$categories_portfolio);
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance					      = $old_instance;
		$instance['title']			      = strip_tags( $new_instance['title'] );
		$instance['orderby']		      = $new_instance['orderby'];
		$instance['posts_per_page']       = $new_instance['posts_per_page'];
		$instance['display_date']	      = $new_instance['display_date'];
		$instance['display_review']	      = $new_instance['display_review'];
		$instance['display_author']	      = $new_instance['display_author'];
		$instance['excerpt_title']	      = $new_instance['excerpt_title'];
		$instance['show_images']	      = $new_instance['show_images'];
		$instance['post_or_portfolio']    = $new_instance['post_or_portfolio'];
		$instance['display']              = $new_instance['display'];
		$instance['category']	          = $new_instance['category'];
		$instance['categories']	          = $new_instance['categories'];
		$instance['category_portfolio']	  = $new_instance['category_portfolio'];
		$instance['categories_portfolio'] = $new_instance['categories_portfolio'];
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __('Recent','vbegy'),'orderby' => 'recent','display_date' => 'on','display_review' => 'on','display_author' => 'on','show_images' => 'on','posts_per_page' => '5','excerpt_title' => '5','post_or_portfolio' => 'post' );
		$instance = wp_parse_args( (array) $instance, $defaults );
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
			<label for="<?php echo $this->get_field_id( 'orderby' ); ?>">Order by : </label>
			<select id="<?php echo $this->get_field_id( 'orderby' ); ?>" name="<?php echo $this->get_field_name( 'orderby' ); ?>">
				<option value="popular" <?php if( isset($instance['orderby']) && $instance['orderby'] == 'popular' ) echo "selected=\"selected\""; else echo ""; ?>>Popular</option>
				<option value="recent" <?php if( isset($instance['orderby']) && $instance['orderby'] == 'recent' ) echo "selected=\"selected\""; else echo ""; ?>>Recent</option>
				<option value="random" <?php if( isset($instance['orderby']) && $instance['orderby'] == 'random' ) echo "selected=\"selected\""; else echo ""; ?>>Random</option>
				<option value="most_visited" <?php if( isset($instance['orderby']) && $instance['orderby'] == 'most_visited' ) echo "selected=\"selected\""; else echo ""; ?>>Most visited</option>
				<option value="most_rated" <?php if( isset($instance['orderby']) && $instance['orderby'] == 'most_rated' ) echo "selected=\"selected\""; else echo ""; ?>>Most rated</option>
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'posts_per_page' ); ?>">Number of items to show : </label>
			<input id="<?php echo $this->get_field_id( 'posts_per_page' ); ?>" name="<?php echo $this->get_field_name( 'posts_per_page' ); ?>" value="<?php echo (isset($instance['posts_per_page'])?(int)$instance['posts_per_page']:""); ?>" size="3" type="text">
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
		<p>
			<input class="checkbox" type="checkbox" <?php echo (isset($instance['display_date']) && $instance['display_date'] == "on"?' checked="checked"':"");?> id="<?php echo $this->get_field_id( 'display_date' ); ?>" name="<?php echo $this->get_field_name( 'display_date' ); ?>">
			<label for="<?php echo $this->get_field_id( 'display_date' ); ?>">Display date?</label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo (isset($instance['display_author']) && $instance['display_author'] == "on"?' checked="checked"':"");?> id="<?php echo $this->get_field_id( 'display_author' ); ?>" name="<?php echo $this->get_field_name( 'display_author' ); ?>">
			<label for="<?php echo $this->get_field_id( 'display_author' ); ?>">Display author?</label>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo (isset($instance['display_review']) && $instance['display_review'] == "on"?' checked="checked"':"");?> id="<?php echo $this->get_field_id( 'display_review' ); ?>" name="<?php echo $this->get_field_name( 'display_review' ); ?>">
			<label for="<?php echo $this->get_field_id( 'display_review' ); ?>">Display review?</label>
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