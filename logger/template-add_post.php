<?php /* Template Name: Add a post */
get_header();
	if ( have_posts() ) : while ( have_posts() ) : the_post();?>
		<div class="post">
			<div class="post-wrap">
				<div class="post-inner">
					<div class="post-title"><i class="fa fa-comment"></i><?php the_title()?></div>
					<?php the_content()?>
					<div class="comment-form contact-form">
						<?php the_content();
						echo do_shortcode("[add_post]");?>
					</div>
					<div class="clearfix"></div>
				</div><!-- End post-inner -->
			</div><!-- End post-wrap -->
		</div><!-- End post -->
	<?php endwhile; endif;
get_footer();?>