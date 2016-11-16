<?php
/* Google */
add_action( 'widgets_init', 'widget_google_widget' );
function widget_google_widget() {
	register_widget( 'Widget_Google' );
}
class Widget_Google extends WP_Widget {

	function Widget_Google() {
		$widget_ops = array( 'classname' => 'google-widget'  );
		$control_ops = array( 'id_base' => 'google-widget' );
		parent::__construct( 'google-widget','Logger - google', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title		 = apply_filters('widget_title', $instance['title'] );
		$google_page = esc_attr($instance['google_page']);
			
		echo $before_widget;
			if ( $title )
				echo $before_title.esc_attr($title).$after_title;?>
			<div class="google_widget">
			    <script type="text/javascript">
			    (function() {
			    var po = document.createElement('script'); po.type = 'text/javascript'; po.async = true;
			    po.src = 'https://apis.google.com/js/plusone.js';
			    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
			    })();
			    </script>
			    <a  href="<?php echo $google_page ?>" rel="publisher"></a>
			    <g:plus href="<?php echo $google_page ?>" height="130" width="318" theme="light"></g:plus>
			</div>
		<?php echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance				 = $old_instance;
		$instance['title']		 = strip_tags( $new_instance['title'] );
		$instance['google_page'] = $new_instance['google_page'];
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => 'Google+' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo (isset($instance['title'])?esc_attr($instance['title']):""); ?>" class="widefat" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'google_page' ); ?>">Page : </label>
			<input id="<?php echo $this->get_field_id( 'google_page' ); ?>" name="<?php echo $this->get_field_name( 'google_page' ); ?>" value="<?php echo (isset($instance['google_page'])?esc_attr($instance['google_page']):""); ?>" class="widefat" type="text">
		</p>
	<?php
	}
}
?>