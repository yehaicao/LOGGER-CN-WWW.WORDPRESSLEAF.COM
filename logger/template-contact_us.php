<?php /* Template Name: Contact us */
get_header();
	if ( have_posts() ) : while ( have_posts() ) : the_post();
		$contact_form = rwmb_meta('vbegy_contact_form','text',$post->ID);?>
		<div class="post">
			<div class="post-wrap">
				<div class="post-inner">
					<div class="post-title"><i class="fa fa-comment"></i><?php the_title()?></div>
					<?php the_content()?>
					<div class="comment-form contact-form">
						<?php echo do_shortcode($contact_form);?>
					</div>
					<div class="clearfix"></div>
				</div><!-- End post-inner -->
			</div><!-- End post-wrap -->
		</div><!-- End post -->
	<?php endwhile; endif;
get_footer();?>