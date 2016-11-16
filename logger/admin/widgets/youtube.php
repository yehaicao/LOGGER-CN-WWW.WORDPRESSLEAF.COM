<?php
/* Youtube */
add_action( 'widgets_init', 'widget_youtube_widget' );
function widget_youtube_widget() {
	register_widget( 'Widget_Youtube' );
}
class Widget_Youtube extends WP_Widget {

	function Widget_Youtube() {
		$widget_ops = array( 'classname' => 'youtube-widget'  );
		$control_ops = array( 'id_base' => 'youtube-widget' );
		parent::__construct( 'youtube-widget','Logger - youtube', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title		  = apply_filters('widget_title', $instance['title'] );
		$youtube_user = esc_attr($instance['youtube_user']);
			
		echo $before_widget;
			if ( $title )
				echo $before_title.esc_attr($title).$after_title;?>
			<div class="youtube_widget">
			    <iframe id="fr" src="http://www.youtube.com/subscribe_widget?p=<?php echo $youtube_user ?>" style="overflow: hidden;height: 72px;border: 0;width: 100%;" scrolling="no" frameBorder="0"></iframe>
			</div>
		<?php echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance				  = $old_instance;
		$instance['title']		  = strip_tags( $new_instance['title'] );
		$instance['youtube_user'] = $new_instance['youtube_user'];
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => 'Youtube' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo (isset($instance['title'])?esc_attr($instance['title']):""); ?>" class="widefat" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'youtube_user' ); ?>">User : </label>
			<input id="<?php echo $this->get_field_id( 'youtube_user' ); ?>" name="<?php echo $this->get_field_name( 'youtube_user' ); ?>" value="<?php echo (isset($instance['youtube_user'])?esc_attr($instance['youtube_user']):""); ?>" class="widefat" type="text">
		</p>
	<?php
	}
}
?>