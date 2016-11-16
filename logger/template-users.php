<?php /* Template Name: Users */
get_header();

	$rows_per_page = get_option("posts_per_page");
	$paged         = (get_query_var("paged") != ""?(int)get_query_var("paged"):(get_query_var("page") != ""?(int)get_query_var("page"):1));
	$offset		   = ($paged-1)*$rows_per_page;
	$users		   = get_users('blog_id=1&orderby=registered');
	$query         = get_users('&offset='.$offset.'&number='.$rows_per_page.'&blog_id=1&orderby=registered');
	$total_users   = count($users);
	$total_query   = count($query);
	$total_pages   = (int)ceil($total_users/$rows_per_page);
	  
	foreach ($query as $user) {
		$you_avatar = get_the_author_meta('you_avatar',$user->ID);
		$twitter = get_the_author_meta('twitter',$user->ID);
		$facebook = get_the_author_meta('facebook',$user->ID);
		$google = get_the_author_meta('google',$user->ID);
		$linkedin = get_the_author_meta('linkedin',$user->ID);
		$youtube = get_the_author_meta('youtube',$user->ID);?>  
		<div class="post post-style-2">
			<div class="post-author">
				<?php if ($you_avatar) {
					$you_avatar_img = get_aq_resize_url(esc_attr($you_avatar),"full",70,70);
					echo "<img alt='".$user->display_name."' src='".$you_avatar_img."'>";
				}else {
					echo get_avatar(get_the_author_meta('user_email'),'70','');
				}?>
			</div>
			<div class="post-wrap">
				<div class="post-inner">
					<div class="post-title"><i class="fa fa-user"></i><?php echo esc_attr($user->display_name)?></div>
					<p><?php echo esc_attr($user->description)?></p>
					<?php if ($facebook || $twitter || $linkedin || $google || $youtube) { ?>
						<div class="social-ul">
							<ul>
								<?php if ($facebook) {?>
									<li class="social-facebook"><a href="<?php echo esc_url($facebook)?>" target="_blank"><i class="fa fa-facebook"></i></a></li>
								<?php }
								if ($twitter) {?>
									<li class="social-twitter"><a href="<?php echo esc_url($twitter)?>" target="_blank"><i class="fa fa-twitter"></i></a></li>
								<?php }
								if ($google) {?>
									<li class="social-google"><a href="<?php echo esc_url($google)?>" target="_blank"><i class="fa fa-google-plus"></i></a></li>
								<?php }
								if ($linkedin) {?>
									<li class="social-linkedin"><a href="<?php echo esc_url($linkedin)?>" target="_blank"><i class="fa fa-linkedin"></i></a></li>
								<?php }
								if ($youtube) {?>
									<li class="social-youtube"><a href="<?php echo esc_url($youtube)?>" target="_blank"><i class="fa fa-youtube-play"></i></a></li>
								<?php }?>
							</ul>
						</div><!-- End social-ul -->
					<?php }?>
					<div class="clearfix"></div>
				</div><!-- End post-inner -->
			</div><!-- End post-wrap -->
		</div><!-- End post -->
	<?php }
	
	if ($total_users > $total_query) {
		echo '<div class="pagination">';
		$current_page = max(1,get_query_var('paged'));
		echo paginate_links(array(
			'base' => get_pagenum_link(1).'%_%',
			'format' => 'page/%#%/',
			'current' => $current_page,
			'total' => $total_pages,
			'prev_text' => '<i class="fa fa-angle-left"></i>',
			'next_text' => '<i class="fa fa-angle-right"></i>',
		));
		echo '</div><div class="clearfix"></div>';
	}
get_footer();?>