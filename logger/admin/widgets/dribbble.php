<?php
/* Dribbble */
add_action( 'widgets_init', 'widget_dribbble_widget' );
function widget_dribbble_widget() {
	register_widget( 'Widget_Dribbble' );
}
class Widget_Dribbble extends WP_Widget {

	function Widget_Dribbble() {
		$widget_ops = array( 'classname' => 'widget-dribbble'  );
		$control_ops = array( 'id_base' => 'dribbble_widget' );
		parent::__construct( 'dribbble_widget','Logger - dribbble', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title		    = apply_filters('widget_title', $instance['title'] );
		$no_of_dribbble = (int)$instance['no_of_dribbble'];
		$accounts	    = esc_attr($instance['accounts']);

		echo $before_widget;
			if ( $title )
				echo $before_title.$title.$after_title;
			$rand_w = rand(1,1000);?>
	
			<div class=" dribbble_<?php echo $rand_w;?>"><ul></ul></div>
			<script type='text/javascript'>
				jQuery(document).ready(function(){
					jQuery.jribbble.getShotsByPlayerId('<?php echo esc_js($accounts);?>', function (playerShots) {
						var html = [];
						jQuery.each(playerShots.shots, function (i, shot) {
							html.push('<li><a target="_blank" href="' + shot.url + '"><img src="' + shot.image_url + '" alt="' + shot.title + '"></a></li>');      
						});
						jQuery('.dribbble_<?php echo esc_js($rand_w);?> ul').html(html.join(''));
						jQuery(".dribbble_<?php echo esc_js($rand_w);?> ul").bxSlider({easing: "linear",tickerHover: true,slideWidth: 1170,adaptiveHeightSpeed: 1500,moveSlides: 1,maxSlides: 1,auto: true});
					},{page: 1, per_page: <?php echo (int)$no_of_dribbble;?>});
				});
			</script>
			<div class="clearfix"></div>
		<?php echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance				    = $old_instance;
		$instance['title']		    = strip_tags( $new_instance['title'] );
		$instance['no_of_dribbble'] = (int)strip_tags( $new_instance['no_of_dribbble'] );
		$instance['accounts']	    = strip_tags( $new_instance['accounts'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => 'Dribbble Gallery' , 'no_of_dribbble' => '4' , 'accounts' => 'envato' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr($instance['title']); ?>" class="widefat" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'no_of_dribbble' ); ?>">No of dribbble to show : </label>
			<input id="<?php echo $this->get_field_id( 'no_of_dribbble' ); ?>" name="<?php echo $this->get_field_name( 'no_of_dribbble' ); ?>" value="<?php echo (int)$instance['no_of_dribbble']; ?>" type="text" size="3">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'accounts' ); ?>">Dribbble username id : </label>
			<input id="<?php echo $this->get_field_id( 'accounts' ); ?>" name="<?php echo $this->get_field_name( 'accounts' ); ?>" value="<?php if (isset($instance['accounts']) && !empty($instance['accounts'])) {echo esc_attr($instance['accounts']);} ?>" class="widefat" type="text">
		</p>
	<?php
	}
}
?>