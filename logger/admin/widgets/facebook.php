<?php
/* Facebook */
add_action( 'widgets_init', 'widget_facebook_widget' );
function widget_facebook_widget() {
	register_widget( 'Widget_Facebook' );
}
class Widget_Facebook extends WP_Widget {

	function Widget_Facebook() {
		$widget_ops = array( 'classname' => 'facebook-widget'  );
		$control_ops = array( 'id_base' => 'facebook-widget' );
		parent::__construct( 'facebook-widget','Logger - facebook', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title		   = apply_filters('widget_title', $instance['title'] );
		$facebook_link = esc_url($instance['facebook_link']);
		$width         = esc_attr($instance['width']);
		$height        = esc_attr($instance['height']);
		$border_color  = esc_attr($instance['border_color']);
		$background    = esc_attr($instance['background']);
			
		echo $before_widget;
			if ( $title )
				echo $before_title.esc_attr($title).$after_title;?>
			<div class="facebook_widget">
			    <iframe src="//www.facebook.com/plugins/likebox.php?href=<?php echo $facebook_link ; ?>&amp;width=<?php echo $width ; ?>&amp;colorscheme=light&amp;show_faces=true&amp;border_color=%23<?php echo $border_color ; ?>&amp;stream=false&amp;header=false&amp;height=<?php echo $height ; ?>" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:<?php echo $width; ?>px; height:<?php echo $height; ?>px;" allowTransparency="true"></iframe>
			</div>
		<?php echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance				   = $old_instance;
		$instance['title']		   = strip_tags( $new_instance['title'] );
		$instance['facebook_link'] = $new_instance['facebook_link'];
		$instance['width']         = $new_instance['width'];
		$instance['height']        = $new_instance['height'];
		$instance['border_color']  = $new_instance['border_color'];
		$instance['background']    = $new_instance['background'];
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => 'Facebook','facebook_link' => 'http://www.facebook.com/2code.info','width' => '318','height' => '271','background' => '#FFFFFF','border_color' => '#dedede' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo (isset($instance['title'])?esc_attr($instance['title']):""); ?>" class="widefat" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'facebook_link' ); ?>">Facebook link : </label>
			<input id="<?php echo $this->get_field_id( 'facebook_link' ); ?>" name="<?php echo $this->get_field_name( 'facebook_link' ); ?>" value="<?php echo (isset($instance['facebook_link'])?esc_attr($instance['facebook_link']):""); ?>" class="widefat" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'width' ); ?>">Width : </label>
			<input id="<?php echo $this->get_field_id( 'width' ); ?>" name="<?php echo $this->get_field_name( 'width' ); ?>" value="<?php echo (isset($instance['width'])?(int)$instance['width']:""); ?>" size="3" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'height' ); ?>">Height : </label>
			<input id="<?php echo $this->get_field_id( 'height' ); ?>" name="<?php echo $this->get_field_name( 'height' ); ?>" value="<?php echo (isset($instance['height'])?(int)$instance['height']:""); ?>" size="3" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'background' ); ?>">Background : </label>
			<input id="<?php echo $this->get_field_id( 'background' ); ?>" name="<?php echo $this->get_field_name( 'background' ); ?>" value="<?php echo (isset($instance['background'])?$instance['background']:""); ?>" size="7" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'border_color' ); ?>">Border color : </label>
			<input id="<?php echo $this->get_field_id( 'border_color' ); ?>" name="<?php echo $this->get_field_name( 'border_color' ); ?>" value="<?php echo (isset($instance['border_color'])?$instance['border_color']:""); ?>" size="7" type="text">
		</p>
	<?php
	}
}
?>