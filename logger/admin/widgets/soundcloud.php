<?php
/* Soundcloud */
add_action( 'widgets_init', 'widget_soundcloud_widget' );
function widget_soundcloud_widget() {
	register_widget( 'Widget_Soundcloud' );
}
class Widget_Soundcloud extends WP_Widget {

	function Widget_Soundcloud() {
		$widget_ops = array( 'classname' => 'soundcloud-widget'  );
		$control_ops = array( 'id_base' => 'soundcloud-widget' );
		parent::__construct( 'soundcloud-widget','Logger - soundcloud', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title		     = apply_filters('widget_title', $instance['title'] );
		$soundcloud_link = esc_attr($instance['soundcloud_link']);
		$autoplay        = esc_attr($instance['autoplay']);
			
		echo $before_widget;
			if ( $title )
				echo $before_title.esc_attr($title).$after_title;?>
			<div class="soundcloud_widget">
			    <iframe width="100%" height="160" scrolling="no" frameborder="no" src="https://w.soundcloud.com/player/?url=<?php echo $soundcloud_link;?>&amp;auto_play=<?php echo (isset($autoplay) && $autoplay == "on"?true:"false");?>&amp;show_artwork=true"></iframe>
			</div>
		<?php echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance				     = $old_instance;
		$instance['title']		     = strip_tags( $new_instance['title'] );
		$instance['soundcloud_link'] = $new_instance['soundcloud_link'];
		$instance['autoplay']        = $new_instance['autoplay'];
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => 'Soundcloud' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo (isset($instance['title'])?esc_attr($instance['title']):""); ?>" class="widefat" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'soundcloud_link' ); ?>">Soundcloud link : </label>
			<input id="<?php echo $this->get_field_id( 'soundcloud_link' ); ?>" name="<?php echo $this->get_field_name( 'soundcloud_link' ); ?>" value="<?php echo (isset($instance['soundcloud_link'])?esc_attr($instance['soundcloud_link']):""); ?>" class="widefat" type="text">
		</p>
		<p>
			<input class="checkbox" type="checkbox" <?php echo (isset($instance['autoplay']) && $instance['autoplay'] == "on"?' checked="checked"':"");?> id="<?php echo $this->get_field_id( 'autoplay' ); ?>" name="<?php echo $this->get_field_name( 'autoplay' ); ?>">
			<label for="<?php echo $this->get_field_id( 'autoplay' ); ?>">Autoplay?</label>
		</p>
	<?php
	}
}
?>