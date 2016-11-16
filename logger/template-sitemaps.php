<?php ob_start();/* Template Name: Sitemaps */
get_header();
	if ( have_posts() ) : while ( have_posts() ) : the_post();?>
		<div class="post">
			<div class="post-wrap">
				<div class="post-inner">
					<div class="post-title"><i class="fa fa-archive"></i><?php the_title()?></div>
					<?php the_content();?>
					<div class="accordion accordion-archive toggle-accordion">
						<div class="section-content">
						    <h4 class="accordion-title active"><a href="#"><?php _e("Latest Posts","vbegy")?><i class="fa fa-plus"></i></a></h4>
						    <div class="accordion-inner active">
						        <ul>
						        	<?php $args = array('posts_per_page' => 10);
						        	$myposts = get_posts($args);
						        	foreach ($myposts as $post):setup_postdata($post);?>
						        		<li>
						        			<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						        		</li>
						        	<?php endforeach; 
						        	wp_reset_postdata();?>
						        </ul>
						    </div>
						</div>
						<div class="section-content">
						    <h4 class="accordion-title"><a href="#"><?php _e("Archive by Month","vbegy")?><i class="fa fa-minus"></i></a></h4>
						    <div class="accordion-inner">
						        <ul>
							        <?php wp_get_archives('type=monthly');?>
						        </ul>
						    </div>
						</div>
						<div class="section-content">
						    <h4 class="accordion-title"><a href="#"><?php _e("Archive by Year","vbegy")?><i class="fa fa-minus"></i></a></h4>
						    <div class="accordion-inner">
						        <ul>
						            <?php wp_get_archives('type=yearly');?>
						        </ul>
						    </div>
						</div>
						<div class="section-content">
						    <h4 class="accordion-title"><a href="#"><?php _e("Categories","vbegy")?><i class="fa fa-minus"></i></a></h4>
						    <div class="accordion-inner">
						        <ul>
						            <?php wp_list_categories("title_li=");?>
						        </ul>
						    </div>
						</div>
						<div class="section-content">
						    <h4 class="accordion-title"><a href="#"><?php _e("Authors","vbegy")?><i class="fa fa-minus"></i></a></h4>
						    <div class="accordion-inner">
						        <ul>
						            <?php wp_list_authors("optioncount=1");?>
						        </ul>
						    </div>
						</div>
						<div class="section-content">
						    <h4 class="accordion-title"><a href="#"><?php _e("Tags","vbegy")?><i class="fa fa-minus"></i></a></h4>
						    <div class="accordion-inner">
						        <?php
						        echo "<div class='widget_tag_cloud tagcloud'>";
						        	$args = array('smallest' => 8,'largest' => 22,'unit' => 'pt','number' => 0);
						        	wp_tag_cloud($args);
						        echo "</div>";?>
						    </div>
						</div>
					</div><!-- End accordion -->
					<div class="clearfix"></div>
				</div><!-- End post-inner -->
			</div><!-- End post-wrap -->
		</div><!-- End post -->
	<?php endwhile; endif;
get_footer();?>