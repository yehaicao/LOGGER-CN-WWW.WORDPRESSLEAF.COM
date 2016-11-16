<?php
/* Comments */
add_action( 'widgets_init', 'widget_comments_widget' );
function widget_comments_widget() {
	register_widget( 'Widget_Comments' );
}
class Widget_Comments extends WP_Widget {

	function Widget_Comments() {
		$widget_ops = array( 'classname' => 'comments-post-widget'  );
		$control_ops = array( 'id_base' => 'comments-post-widget' );
		parent::__construct( 'comments-post-widget','Logger - Comments', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title			   = apply_filters('widget_title', $instance['title'] );
		$comments_number   = esc_attr((int)$instance['comments_number']);
		$comment_excerpt   = esc_attr((int)$instance['comment_excerpt']);
		$show_images       = esc_attr($instance['show_images']);
		$post_or_portfolio = esc_attr($instance['post_or_portfolio']);
			
		echo $before_widget;
			if ( $title )
				echo $before_title.esc_attr($title).$after_title;
			Vpanel_comments($post_or_portfolio,$comments_number,$comment_excerpt,$show_images,$post_or_portfolio);
		echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance					   = $old_instance;
		$instance['title']			   = strip_tags( $new_instance['title'] );
		$instance['comments_number']   = esc_attr($new_instance['comments_number']);
		$instance['comment_excerpt']   = esc_attr($new_instance['comment_excerpt']);
		$instance['show_images']       = esc_attr($new_instance['show_images']);
		$instance['post_or_portfolio'] = $new_instance['post_or_portfolio'];
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => 'Comments','comments_number' => '5','show_images' => 'on','comment_excerpt' => '50','post_or_portfolio' => 'post' );
		$instance = wp_parse_args( (array) $instance, $defaults );
		
		$categories_obj = get_categories('hide_empty=0');
		$categories = array();
		foreach ($categories_obj as $pn_cat) {
			$categories[$pn_cat->cat_ID] = $pn_cat->cat_name;
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo (isset($instance['title'])?esc_attr($instance['title']):""); ?>" class="widefat" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'post_or_portfolio' ); ?>">Post or portfolio : </label>
			<select id="<?php echo $this->get_field_id( 'post_or_portfolio' ); ?>" name="<?php echo $this->get_field_name( 'post_or_portfolio' ); ?>">
				<option value="post" <?php if( isset($instance['post_or_portfolio']) && $instance['post_or_portfolio'] == 'post' ) echo "selected=\"selected\""; else echo ""; ?>>Post</option>
				<option value="portfolio" <?php if( isset($instance['post_or_portfolio']) && $instance['post_or_portfolio'] == 'portfolio' ) echo "selected=\"selected\""; else echo ""; ?>>Portfolio</option>
			</select>
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo (isset($instance['show_images']) && $instance['show_images'] == "on"?' checked="checked"':"");?> id="<?php echo $this->get_field_id( 'show_images' ); ?>" name="<?php echo $this->get_field_name( 'show_images' ); ?>">
			<label for="<?php echo $this->get_field_id( 'show_images' ); ?>">Show images?</label>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'comments_number' ); ?>">Number of comments to show : </label>
			<input id="<?php echo $this->get_field_id( 'comments_number' ); ?>" name="<?php echo $this->get_field_name( 'comments_number' ); ?>" value="<?php echo (isset($instance['comments_number'])?esc_attr($instance['comments_number']):""); ?>" size="3" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'comment_excerpt' ); ?>">The number of words excerpt</label>
			<input id="<?php echo $this->get_field_id( 'comment_excerpt' ); ?>" name="<?php echo $this->get_field_name( 'comment_excerpt' ); ?>" value="<?php echo (isset($instance['comment_excerpt'])?esc_attr($instance['comment_excerpt']):""); ?>" size="3" type="text">
		</p>
	<?php
	}
}
?>