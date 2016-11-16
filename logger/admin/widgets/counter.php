<?php
/* Counter */
add_action( 'widgets_init', 'widget_counter_widget' );
function widget_counter_widget() {
	register_widget( 'Widget_Counter' );
}
class Widget_Counter extends WP_Widget {

	function Widget_Counter() {
		$widget_ops = array( 'classname' => 'widget-statistics'  );
		$control_ops = array( 'id_base' => 'widget_counter' );
		parent::__construct( 'widget_counter','Logger - counter', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title					  = apply_filters('widget_title', $instance['title'] );
		$vimeo					  = esc_attr($instance['vimeo']);
		$dribbble                 = esc_attr($instance['dribbble']);
		$facebook				  = esc_attr($instance['facebook']);
		$twitter				  = esc_attr($instance['twitter']);
		$gplus					  = esc_attr($instance['gplus']);
		$youtube				  = esc_attr($instance['youtube']);

		echo $before_widget;
			if ( $title )
				echo $before_title.esc_attr($title).$after_title;?>
			
			<ul>
				<?php if ($facebook != "") {?>
					<li class="statistics-facebook"><a href="<?php echo vpanel_counter_facebook($facebook, 'link')?>" target="_blank"><i class="fa fa-facebook"></i><?php echo formatMoney((int)vpanel_counter_facebook($facebook))?> <span><?php _e("Fans","vbegy")?></span></a></li>
				<?php }
				if ($twitter != "") {?>
					<li class="statistics-twitter"><a href="http://twitter.com/<?php echo $twitter?>" target="_blank"><i class="fa fa-twitter"></i><?php echo formatMoney((int)get_twitter_count($twitter))?> <span><?php _e("Followers","vbegy")?></span></a></li>
				<?php }
				if ($vimeo != "") {?>
					<li class="statistics-vimeo"><a href="<?php echo vpanel_counter_vimeo($vimeo, 'link')?>" target="_blank"><i class="fa fa-vimeo-square"></i><?php echo formatMoney((int)vpanel_counter_vimeo($vimeo))?> <span><?php _e("Subscribers","vbegy")?></span></a></li>
				<?php }
				if ($youtube != "") {?>
					<li class="statistics-youtube"><a href="<?php echo "http://www.youtube.com/channel/".$youtube?>" target="_blank"><i class="fa fa-youtube-play"></i><?php echo formatMoney((int)vpanel_counter_youtube($youtube))?> <span><?php _e("Subscribers","vbegy")?></span></a></li>
				<?php }
				if ($gplus != "") {?>
					<li class="statistics-google"><a href="<?php echo vpanel_counter_googleplus($gplus, 'link')?>" target="_blank"><i class="fa fa-google-plus"></i><?php echo formatMoney((int)vpanel_counter_googleplus($gplus))?> <span><?php _e("Followers","vbegy")?></span></a></li>
				<?php }
				if ($dribbble != "") {?>
					<li class="statistics-dribbble"><a href="<?php echo vpanel_counter_dribbble($dribbble, 'link')?>" target="_blank"><i class="fa fa-dribbble"></i><?php echo formatMoney((int)vpanel_counter_dribbble($dribbble))?> <span><?php _e("Followers","vbegy")?></span></a></li>
				<?php }?>
			</ul>
			<div class="clearfix"></div>
		<?php echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance			         = $old_instance;
		$instance['title']	         = strip_tags( $new_instance['title'] );
		$instance['vimeo']	         = $new_instance['vimeo'];
		$instance['dribbble']        = $new_instance['dribbble'];
		$instance['twitter']         = $new_instance['twitter'];
		$instance['facebook']        = $new_instance['facebook'];
		$instance['gplus']	         = $new_instance['gplus'];
		$instance['youtube']         = $new_instance['youtube'];
		
		delete_transient('vpanel_facebook_followers');
		delete_transient('vpanel_facebook_page_url');
		delete_transient('vpanel_twitter_followers');
		delete_transient('vpanel_vimeo_followers');
		delete_transient('vpanel_vimeo_page_url');
		delete_transient('vpanel_googleplus_followers');
		delete_transient('vpanel_googleplus_page_url');
		delete_transient('vpanel_dribbble_followers');
		delete_transient('vpanel_dribbble_page_url');
		delete_transient('vpanel_youtube_followers');
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => 'Social Statistics','vimeo' => 'vimeo','dribbble' => 'envato','facebook' => '2code.info','twitter' => 'envato','gplus' => '+envato','youtube' => 'UCht9cayN2rRaXk5VgMJtAsA');
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo (isset($instance['title'])?$instance['title']:"");?>" class="widefat" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'facebook' ); ?>">Facebook Page ID/Name : </label>
			<input id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo (isset($instance['facebook'])?esc_attr($instance['facebook']):"");?>" class="widefat" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'twitter' ); ?>">Twitter : </label>
			<input id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo (isset($instance['twitter'])?esc_attr($instance['twitter']):"");?>" class="widefat" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'gplus' ); ?>">Google Plus Page ID/Name: </label>
			<input id="<?php echo $this->get_field_id( 'gplus' ); ?>" name="<?php echo $this->get_field_name( 'gplus' ); ?>" value="<?php echo (isset($instance['gplus'])?esc_attr($instance['gplus']):"");?>" class="widefat" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'youtube' )?>">Channel id: </label>
			<input id="<?php echo $this->get_field_id( 'youtube' )?>" name="<?php echo $this->get_field_name( 'youtube' )?>" value="<?php echo (isset($instance['youtube'])?esc_attr($instance['youtube']):"");?>" class="widefat" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'vimeo' ); ?>">Vimeo Page ID/Name : </label>
			<input id="<?php echo $this->get_field_id( 'vimeo' ); ?>" name="<?php echo $this->get_field_name( 'vimeo' ); ?>" value="<?php echo (isset($instance['vimeo'])?esc_attr($instance['vimeo']):"");?>" class="widefat" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'dribbble' ); ?>">Dribbble Page ID/Name : </label>
			<input id="<?php echo $this->get_field_id( 'dribbble' ); ?>" name="<?php echo $this->get_field_name( 'dribbble' ); ?>" value="<?php echo (isset($instance['dribbble'])?esc_attr($instance['dribbble']):"");?>" class="widefat" type="text">
		</p>
	<?php
	}
}
?>