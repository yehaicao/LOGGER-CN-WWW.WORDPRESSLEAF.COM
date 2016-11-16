<?php ob_start();/* Template Name: Tags */
get_header();
	if ( have_posts() ) : while ( have_posts() ) : the_post();?>
		<div <?php post_class('post clearfix '.$post_type);?> data-animate="fadeInUp" role="article" itemscope="" itemtype="http://schema.org/Article">
			<div class="post-wrap">
				<div class="post-inner">
					<div class="post-title"><i class="fa fa-tags"></i><?php the_title()?></div>
					<?php the_content();
					echo "<div class='widget_tag_cloud tagcloud'>";
						$args = array('smallest' => 8,'largest' => 22,'unit' => 'pt','number' => 0);
						wp_tag_cloud($args);
					echo "</div>";?>
					<div class="clearfix"></div>
				</div><!-- End post-inner -->
			</div><!-- End post-wrap -->
		</div><!-- End post -->
	<?php endwhile; endif;
get_footer();?>