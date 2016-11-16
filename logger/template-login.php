<?php ob_start();/* Template Name: Login */
get_header();
	if ( have_posts() ) : while ( have_posts() ) : the_post();?>
		<div <?php post_class('post clearfix '.$post_type);?> data-animate="fadeInUp" role="article" itemscope="" itemtype="http://schema.org/Article">
			<div class="post-wrap">
				<div class="post-inner">
					<div class="post-title"><i class="fa fa-tags"></i><?php the_title()?></div>
					<?php the_content();
					if (!is_user_logged_in()) {
						echo do_shortcode("[logger_login]");
					}else {
						echo '<div class="page-404">
							<h3>'.__("You are already logged !","vbegy").'</h3><a class="button-default" href="'.esc_url(home_url('/')).'">'.__("Back To Homepage","vbegy").'</a>
						</div>
						<div class="clearfix"></div>';
					}?>
					<div class="clearfix"></div>
				</div><!-- End post-inner -->
			</div><!-- End post-wrap -->
		</div><!-- End post -->
	<?php endwhile; endif;
get_footer();?>