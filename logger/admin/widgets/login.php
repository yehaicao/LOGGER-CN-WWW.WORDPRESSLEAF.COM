<?php
/* Login */
add_action( 'widgets_init', 'widget_login_widget' );
function widget_login_widget() {
	register_widget( 'Widget_Login' );
}

class Widget_Login extends WP_Widget {

	function Widget_Login() {
		$widget_ops = array( 'classname' => 'login-widget'  );
		$control_ops = array( 'id_base' => 'login-widget' );
		parent::__construct( 'login-widget','Logger - Login', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title = apply_filters('widget_title', $instance['title'] );
		if (!is_user_logged_in()) {
			echo $before_widget;
				if ( $title )
					echo $before_title.esc_attr($title).$after_title;?>
				<div class="widget_login">
					<?php echo '<div class="form-style form-style-2">
						'.do_shortcode("[logger_login]").'
						<div class="clearfix"></div>
					</div>';?>
				</div>
				<?php
			echo $after_widget;
		}
	}

	function update( $new_instance, $old_instance ) {
		$instance		   = $old_instance;
		$instance['title'] = strip_tags( $new_instance['title'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => __('Login','vbegy') );
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
	<?php
	}
}
?>