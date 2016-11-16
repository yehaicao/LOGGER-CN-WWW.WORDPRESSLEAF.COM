<?php /* Template Name: Edit a post */
get_header();
$get_post = (isset($_GET["edit_post"])?(int)$_GET["edit_post"]:0);
$get_post_p = get_post($get_post);
$can_edit_post = vpanel_options("can_edit_post");
	if ( have_posts() ) : while ( have_posts() ) : the_post();?>
		<div class="post">
			<div class="post-wrap">
				<div class="post-inner">
					<div class="post-title"><i class="fa fa-comment"></i><?php the_title()?></div>
					<?php the_content()?>
					<div class="comment-form contact-form">
						<?php the_content();
						if (isset($get_post) && $get_post != 0 && $get_post_p && get_post_type($get_post) == "post") {
							if ($can_edit_post == "on" && $get_post_p->post_author != 0) {
								$user_login_id_l = get_user_by("id",$get_post_p->post_author);
								if ($user_login_id_l->ID == get_current_user_id()) {
									echo do_shortcode("[vpanel_edit_post]");
								}else {
									_e("Sorry you can't edit this post .","vbegy");
								}
							}else {
								_e("Sorry you can't edit this post .","vbegy");
							}
						}else {
							_e("Sorry no post has you select or not found .","vbegy");
						}?>
					</div>
					<div class="clearfix"></div>
				</div><!-- End post-inner -->
			</div><!-- End post-wrap -->
		</div><!-- End post -->
	<?php endwhile; endif;
get_footer();?>