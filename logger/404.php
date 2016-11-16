<?php get_header();?>
	<div class="post">
		<div class="post-wrap">
			<div class="post-inner">
				<div class="page-404">
					<h2><?php _e("404","vbegy")?></h2>
					<h3><?php _e("We Are Sorry, Page Not Found","vbegy")?></h3>
					<p><?php echo vpanel_options("404_page");?></p>
					<a class="button-default" href="<?php echo esc_url(home_url('/'));?>"><?php _e("Back To Homepage","vbegy")?></a>
				</div>
				<div class="clearfix"></div>
			</div><!-- End post-inner -->
		</div><!-- End post-wrap -->
	</div><!-- End post -->
<?php get_footer();?>