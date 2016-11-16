<?php
/* Twitter */
add_action( 'widgets_init', 'latest_tweet_widget' );
function latest_tweet_widget() {
	register_widget( 'Latest_Tweets' );
}
class Latest_Tweets extends WP_Widget {

	function Latest_Tweets() {
		$widget_ops = array( 'classname' => 'twitter-widget'  );
		$control_ops = array( 'id_base' => 'twitter-widget' );
		parent::__construct( 'twitter-widget','Logger - Twitter', $widget_ops, $control_ops );
	}
	
	function widget( $args, $instance ) {
		extract( $args );
		$title		  = apply_filters('widget_title', $instance['title'] );
		$no_of_tweets = (int)$instance['no_of_tweets'];
		$accounts	  = esc_attr($instance['accounts']);

		echo $before_widget;
			if ( $title )
				echo $before_title.$title.'<a class="twitter-follow" href="https://twitter.com/'.esc_js($accounts).'">'.__("Follow","vbegy").'</a>'.$after_title;
			$rand_w = rand(1,1000);?>
	
			<div class="widget-twitter">
				<div class="twitter_<?php echo esc_attr($rand_w);?>"></div>
			</div>
			<script type='text/javascript'>
				jQuery(document).ready(function(){
					jQuery(".twitter_<?php echo esc_js($rand_w);?>").tweet({
						join_text: "auto",
						modpath: '<?php echo get_template_directory_uri();?>/js/twitter/',
						username: "<?php echo esc_js($accounts);?>",
						avatar_size: false,
						count: <?php echo (int)$no_of_tweets;?>,
						template: "{text} <br> {time}",
						loading_text: '<?php _e('Loading twitter feed...','vbegy')?>',
						seconds_ago_text: "about %d seconds ago",
						a_minutes_ago_text: "about a minute ago",
						minutes_ago_text: "about %d minutes ago",
						a_hours_ago_text: "about an hour ago",
						hours_ago_text: "about %d hours ago",
						a_day_ago_text: "about a day ago",
						days_ago_text: "about %d days ago",
						view_text: "view tweet on twitter"
					});
				});
			</script>
		<?php echo $after_widget;
	}

	function update( $new_instance, $old_instance ) {
		$instance				  = $old_instance;
		$instance['title']		  = strip_tags( $new_instance['title'] );
		$instance['no_of_tweets'] = strip_tags( $new_instance['no_of_tweets'] );
		$instance['accounts']	  = strip_tags( $new_instance['accounts'] );
		return $instance;
	}

	function form( $instance ) {
		$defaults = array( 'title' => 'Latest Tweets' , 'no_of_tweets' => '5' );
		$instance = wp_parse_args( (array) $instance, $defaults ); ?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">Title : </label>
			<input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr($instance['title']); ?>" class="widefat" type="text">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'no_of_tweets' ); ?>">No of Tweets to show : </label>
			<input id="<?php echo $this->get_field_id( 'no_of_tweets' ); ?>" name="<?php echo $this->get_field_name( 'no_of_tweets' ); ?>" value="<?php echo (int)$instance['no_of_tweets']; ?>" type="text" size="3">
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'accounts' ); ?>">Twitter username : </label>
			<input id="<?php echo $this->get_field_id( 'accounts' ); ?>" name="<?php echo $this->get_field_name( 'accounts' ); ?>" value="<?php if (isset($instance['accounts']) && !empty($instance['accounts'])) {echo esc_attr($instance['accounts']);} ?>" class="widefat" type="text">
		</p>
	<?php
	}
}
?>