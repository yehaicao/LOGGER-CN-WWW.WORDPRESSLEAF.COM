<?php
/* About me */
add_action( 'widgets_init', 'widget_about_me_widget' );
function widget_about_me_widget() {
	register_widget( 'Widget_About_me' );
}
class Widget_About_me extends WP_Widget {

	function Widget_About_me() {
		$widget_ops = array( 'classname' => 'about_me-widget'  );
		$control_ops = array( 'id_base' => 'about_me-widget' );
		parent::__construct( 'about_me-widget','Logger - About me', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title        = apply_filters('widget_title', $instance['title'] );
		$my_name      = esc_attr($instance['my_name']);
		$image_id     = esc_attr($instance['image_id']);
		$description  = esc_attr($instance['description']);
		$facebook     = esc_url($instance['facebook']);
		$twitter      = esc_url($instance['twitter']);
		$google       = esc_url($instance['google']);
		$linkedin     = esc_url($instance['linkedin']);
		$youtube      = esc_url($instance['youtube']);
		$follow_email = esc_attr($instance['follow_email']);?>
		
		<div class="widget widget-about">
			<div class="widget-about-img">
				<?php $you_avatar_img = get_aq_resize_url(esc_attr($instance['you_avatar']),"full",65,65);
				echo "<a href='".esc_attr($instance['you_avatar'])."' rel='prettyPhoto'><img alt='".$my_name."' src='".$you_avatar_img."'></a>";?>
			</div>
			<h3><?php echo $my_name?></h3>
			<p><?php echo $description;?></p>
			<?php if ($facebook || $twitter || $linkedin || $youtube || $google || $follow_email) { ?>
				<div class="social-ul">
					<ul>
						<?php if ($facebook) {?>
							<li class="social-facebook"><a href="<?php echo $facebook?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
						<?php }
						if ($twitter) {?>
							<li class="social-twitter"><a href="<?php echo $twitter?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
						<?php }
						if ($google) {?>
							<li class="social-google"><a href="<?php echo $google?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
						<?php }
						if ($linkedin) {?>
							<li class="social-linkedin"><a href="<?php echo $linkedin?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
						<?php }
						if ($youtube) {?>
							<li class="social-youtube"><a href="<?php echo $youtube?>" target="_blank"><i class="fa fa-youtube-play"></i></a></li>
						<?php }
						if ($follow_email) {?>
							<li class="social-email"><a href="mailto:<?php echo $follow_email?>" target="_blank"><i class="fa fa-envelope"></i></a></li>
						<?php }?>
					</ul>
				</div><!-- End social-ul -->
			<?php }?>
			<div class="clearfix"></div>
		</div>
	<?php }

	function update( $new_instance, $old_instance ) {
		$instance                 = $old_instance;
		$instance['title']        = strip_tags( $new_instance['title'] );
		$instance['description']  = $new_instance['description'];
		$instance['you_avatar']   = $new_instance['you_avatar'];
		$instance['image_id']     = $new_instance['image_id'];
		$instance['my_name']      = $new_instance['my_name'];
		$instance['facebook']     = $new_instance['facebook'];
		$instance['twitter']      = $new_instance['twitter'];
		$instance['linkedin']     = $new_instance['linkedin'];
		$instance['youtube']      = $new_instance['youtube'];
		$instance['google']       = $new_instance['google'];
		$instance['follow_email'] = $new_instance['follow_email'];
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => 'About me' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo (isset($instance['title'])?esc_attr($instance['title']):""); ?>" class="widefat" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'you_avatar' ); ?>">Your avatar : </label>
			<input id="<?php echo $this->get_field_id( 'you_avatar' ); ?>" name="<?php echo $this->get_field_name( 'you_avatar' ); ?>" value="<?php echo (isset($instance['you_avatar'])?$instance['you_avatar']:"");?>" class="widefat upload" type="text">
			<br><br>
			<input class="upload_image_button button upload-button-2 upload-button-widget" type="button" value="Upload">
			<br><br>
			<input id="<?php echo $this->get_field_id( 'image_id' ); ?>" name="<?php echo $this->get_field_name( 'image_id' ); ?>" value="<?php echo (isset($instance['image_id'])?$instance['image_id']:"");?>" class="widefat image_id" type="hidden">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'my_name' ); ?>">Your name : </label>
			<input id="<?php echo $this->get_field_id( 'my_name' ); ?>" name="<?php echo $this->get_field_name( 'my_name' ); ?>" value="<?php echo (isset($instance['my_name'])?esc_attr($instance['my_name']):""); ?>" class="widefat" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'description' ); ?>">Description : </label>
			<textarea id="<?php echo $this->get_field_id( 'description' ); ?>" name="<?php echo $this->get_field_name( 'description' ); ?>" class="widefat"><?php echo (isset($instance['description'])?esc_attr($instance['description']):""); ?></textarea>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'facebook' ); ?>">Facebook : </label>
			<input id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php echo (isset($instance['facebook'])?esc_attr($instance['facebook']):""); ?>" class="widefat" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'twitter' ); ?>">Twitter : </label>
			<input id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php echo (isset($instance['twitter'])?esc_attr($instance['twitter']):""); ?>" class="widefat" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'linkedin' ); ?>">Linkedin : </label>
			<input id="<?php echo $this->get_field_id( 'linkedin' ); ?>" name="<?php echo $this->get_field_name( 'linkedin' ); ?>" value="<?php echo (isset($instance['linkedin'])?esc_attr($instance['linkedin']):""); ?>" class="widefat" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'youtube' ); ?>">Youtube : </label>
			<input id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" value="<?php echo (isset($instance['youtube'])?esc_attr($instance['youtube']):""); ?>" class="widefat" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'google' ); ?>">Google plus : </label>
			<input id="<?php echo $this->get_field_id( 'google' ); ?>" name="<?php echo $this->get_field_name( 'google' ); ?>" value="<?php echo (isset($instance['google'])?esc_attr($instance['google']):""); ?>" class="widefat" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'follow_email' ); ?>">Follow email : </label>
			<input id="<?php echo $this->get_field_id( 'follow_email' ); ?>" name="<?php echo $this->get_field_name( 'follow_email' ); ?>" value="<?php echo (isset($instance['follow_email'])?esc_attr($instance['follow_email']):""); ?>" class="widefat" type="text">
		</p>
	<?php
	}
}
?>